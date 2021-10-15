/*!
 * Ext JS Library 3.4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */
Ext.ns('Ext.ux');

Ext.ux.GridTotals = Ext.extend(Ext.util.Observable, {
    constructor: function(config) {
        config = config || {};
        this.showHeaderInTotals = config.showHeaderInTotals;
        this.divideRowHeightBy2 = config.divideRowHeightBy2;

        Ext.ux.GridTotals.superclass.constructor.call(this, config);
    },

    init: function(g) {
        var v = g.getView();
        this.grid = g;
        this.store = g.getStore();

        //Need to override GridView's findRow to not consider total's row as normal grid row.
        v.findRow = function(el) {
            if (!el) {
                return false;
            }

            if (this.fly(el).findParent('.x-grid-total-row', this.rowSelectorDepth)) {
                return (false);
            } else {
                return this.fly(el).findParent(this.rowSelector, this.rowSelectorDepth);
            }
        }

        g.cls = (g.cls || '') + 'x-grid3-simple-totals';
        g.gridTotals = this;

        this.store.on({
            reconfigure: { fn: this.onGridReconfigure, scope: this },
            add: { fn: this.updateTotals, scope: this },
            remove: { fn: this.updateTotals, scope: this },
            update: { fn: this.updateTotals, scope: this },
            datachanged: { fn: this.updateTotals, scope: this }
        });

        v.onLayout = v.onLayout.createSequence(this.onLayout, this);
        v.initElements = v.initElements.createSequence(this.initElements, this);
        v.onAllColumnWidthsUpdated = v.onAllColumnWidthsUpdated.createSequence(this.onLayout, this);
        v.onColumnWidthUpdated = v.onColumnWidthUpdated.createSequence(this.onLayout, this);
    },

    initElements: function() {
        var v = this.grid.getView();
        v.scroller.on('scroll', function() {
            v.totalsRow.setStyle({
                left: -v.scroller.dom.scrollLeft + 'px'
            });
        });
    },

    onLayout: function() {
        this.updateTotals();
        this.fixScrollerPosition();
    },

    fixScrollerPosition: function() {
        var v = this.grid.getView();
        var bottomScrollbarWidth = v.scroller.getHeight() - v.scroller.dom.clientHeight;
        v.totalsRow.setStyle({
            bottom: bottomScrollbarWidth + 'px',
            width: Math.min(v.mainBody.getWidth(), v.scroller.dom.clientWidth) + 'px'
        });

        //Reduce the height of the scroller to create spce for totals row to avoid overlapping.
        var height = (this.divideRowHeightBy2 !== false) ? v.totalsRow.dom.clientHeight / 2 : v.totalsRow.dom.clientHeight;
        v.scroller.setHeight(v.scroller.dom.clientHeight - height);
    },

    getTotals: function() {
        var v = this.grid.getView();

        var cs = v.getColumnData();
        var totals = new Array(cs.length);
        var store = v.grid.store;
        var fields = store.recordType.prototype.fields;
        var columns = v.cm.config;

        for (var i = 0, l = v.grid.store.getCount(); i < l; i++) {
            var rec = store.getAt(i);
            for (var c = 0, nc = cs.length; c < nc; c++) {
                var f = cs[c].name;
                var t = !Ext.isEmpty(f) ? fields.get(f).type : '';
                if (columns[c].totalsText) {
                    totals[c] = columns[c].totalsText;
                    //} else if (t.type == 'int' || t.type == 'float') {
                } else if (columns[c].summaryType) {
                    var v = rec.get(f);
                    if (Ext.isDefined(totals[c])) {
                        switch (columns[c].summaryType) {
                            case 'sum':
                                totals[c] += v;
                                break;
                            case 'min':
                                if (v < totals[c]) {
                                    totals[c] = v;
                                }
                                break;
                            case 'max':
                                if (v > totals[c]) {
                                    totals[c] = v;
                                }
                                break;
                        }
                    } else {
                        switch (columns[c].summaryType) {
                            case 'count':
                                totals[c] = l;
                                break;

                            default:
                                totals[c] = v;
                                break;
                        }
                    }
                }
            }
        }

        return totals;
    },

    getRenderedTotals: function() {
        var v = this.grid.getView();
        var totals = this.getTotals();

        var cs = v.getColumnData();
        var store = v.grid.store;
        var columns = v.cm.config;

        var cells = '', p = {};
        for (var c = 0, nc = cs.length, last = nc - 1; c < nc; c++) {
            if (columns[c].roundToPlaces) {
                totals[c] = Math.roundToPlaces(totals[c], columns[c].roundToPlaces);
            }

            if (this.showHeaderInTotals) {
                if (Ext.isEmpty(totals[c])) {
                    totals[c] = '&nbsp;';
                } else {
                    totals[c] += ': ' + cs[c].scope.header;
                }
            }

            var v = Ext.isDefined(totals[c]) ? totals[c] : '';

            if (columns[c].summaryType && columns[c].summaryRenderer) {
                var renderer = columns[c].summaryRenderer;
                if (Ext.isString(renderer)) {
                    renderer = Ext.util.Format[renderer];
                }
                totals[c] = renderer(v, p, undefined, undefined, c, store);
            }
        }

        return (totals);
    },

    updateTotals: function() {
        if (!this.grid.rendered) {
            return;
        }

        var v = this.grid.getView();

        if (!v.totalsRow) {
            v.mainWrap.setStyle('position', 'relative');
            v.totalsRow = v.templates.row.append(v.mainWrap, {
                tstyle: 'width:' + v.mainBody.getWidth(),
                cells: ''
            }, true);
            v.totalsRow.addClass('x-grid-total-row');
            v.totalsTr = v.totalsRow.child('tr').dom;
        }

        var totals = this.getRenderedTotals();

        var cs = v.getColumnData();

        var cells = '', p = {};
        for (var c = 0, nc = cs.length, last = nc - 1; c < nc; c++) {
            p.id = cs[c].id;
            p.style = cs[c].style;
            p.css = c == 0 ? 'x-grid3-cell-first ' : (c == last ? 'x-grid3-cell-last ' : '');

            cells += v.templates.cell.apply(Ext.apply({
                value: totals[c]
            }, cs[c]));
        }
        while (v.totalsTr.hasChildNodes()) {
            v.totalsTr.removeChild(v.totalsTr.lastChild);
        }
        Ext.DomHelper.insertHtml('afterBegin', v.totalsTr, cells);
    },

    onGridReconfigure: Ext.emptyFn
});