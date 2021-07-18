<?php 
header('Content-type: text/javascript');
?>

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for ( var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}

var orig_onLoad = Ext.grid.GridView.prototype.onLoad;

Ext.override(Ext.ux.grid.LockingGridView, {
        /*
         * Override the Ext.grid.GridView onLoad method.
         * The original one in ExtJs 3 "resets the scrollbar" every time new items
         * are added. This is especially uncomfortable when doing a large, slow,
         * search.
         * The original onLoad is now replaced by something which checks if the
         * scroll position is below the actual bottom grid row. If that's the case,
         * then and only then we reset the scroll position to the top of the grid.
         * It is thought that the original scroll-to-the-top behaviour was only
         * intended to prevent the situation where the user was left with a white
         * screen when a grid was reloaded with less items than before (- when the
         * scroll was done).
         */
        onLoad : function()
        {
                var rowCount = this.getRows().length;


                // Count the content hight in pixels.
                var totalPixels = 0;
                for(var rowNr=0; rowNr<rowCount; rowNr++) {
                        totalPixels += this.getRow(rowNr).clientHeight;
                }


                /*
                 * If the current scroll position is below the bottom of
                 * the grid-items, then scroll all the way up
                 * In theory we could also just move to [bottom - window size] but that
                 * might be confusing.
                 * We let the original onLoad take care of the scrolling: in case it
                 * has other things to do so besides the this.scrollToTop() call.
                 */
                if (this.el.getScroll().top >= totalPixels) {
                        orig_onLoad.apply(this, arguments);
                }
        }
});

 Ext.BLANK_IMAGE_URL = '/zf/public/ext/resources/images/default/s.gif';
 
 Ext.onReady(function() {
	 
	 
            Ext.QuickTips.init();
            var fm = Ext.form;
            
            var newwin;
            
            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 60,
                url : "/zf/public/dailymoney/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 180,
                border : false,
                defaults : {
                    width : 80
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'Vuosi',
                    name : 'year',
                    allowBlank : false
                }
                ]
            });

            function createNT() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new',
                                //layout : 'fit',
                                width : 200,
                                height : 100,
                                closeAction : 'hide',
                                plain : true,
                                title : 'Uusi päiväraha rivi',
                                items : [newform],
                                buttons : [
                                        {
                                            text : 'Lisää',
                                            handler : function() {
                                                var url = "/zf/public/dailymoney/json/createnew";
                                                if(newform.getForm().isValid()){
            									newwin.hide();
                                                newform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : 'Tallentaa',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        newform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															newform
                                                                                .getForm()
                                                                                .reset();
            															//myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                                .alert(
                                                                                        'Virhe',
                                                                                        json.msg);
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : 'Sulje',
                                            handler : function() {
                                                newform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newwin.show(this);
            }
            
            var store = new Ext.data.Store({
                url: '/zf/public/dailymoney/json/index',
                reader: new Ext.data.JsonReader({root: 'dailymoney',
                    totalProperty: 'totalCount',id: 'dailymoney_id'}, 
                        [{name: 'dailymoney_id',type: 'int'},
                         {name: 'year',type: 'int'},
                         {name: 'sairaanhoitomaksu',type: 'float'},
                         {name: 'etuustulot',type: 'float'},
                         {name: 'paivarahamaksu',type: 'float'},
                         {name: 'lisarahoitusosuus',type: 'float'},
                         {name: 'yhteismaara',type: 'float'},
                         {name: 'sairausvakuutusmaksu',type: 'float'}
                         ]),
                        baseParams: { "start":0, "limit":50, "query":""},
                        sortInfo:{field: 'year', direction: "DESC"},
                        remoteSort: true
                    });
                    
          store.load({params: { "start":0, "limit":50, "query":"" }});
            
         // create the Grid
            var grid = new Ext.grid.EditorGridPanel({
            	renderTo: 'DailymoneyGrid',
            	store: store,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'dailymoney_id',
                        header   : 'DID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'dailymoney_id'
                    },{
                        id       :'year',
                        header   : 'Vuosi', 
                        width    : 100, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'year'
                    },{
                        id       :'sairaanhoitomaksu',
                        header   : 'Sairaanhoitomaksu', 
                        width    : 400, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'sairaanhoitomaksu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'etuustulot',
                        header   : 'Verotettavat eläke- ja etuustulot', 
                        width    : 400, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'etuustulot',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'paivarahamaksu',
                        header   : 'Päivärahamaksu', 
                        width    : 400, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'paivarahamaksu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'lisarahoitusosuus',
                        header   : 'Yrittäjien maksama lisärahoitusosuus', 
                        width    : 500, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'lisarahoitusosuus',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'yhteismaara',
                        header   : 'Palkka- ja työtulon yhteismäärä', 
                        width    : 500, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'yhteismaara',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'sairausvakuutusmaksu',
                        header   : 'Työnantajan sairausvakuutusmaksu', 
                        width    : 500, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'sairausvakuutusmaksu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    }                    
                    ]
                }),
                //colModel: colModel,
                 bbar: [ new Ext.PagingToolbar({
                    store: store,           
                    pageSize: 200,
                    id:'paging-toolbar',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->nomoney ?>'}
                )],
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['dailymoney_id']
                        ,disableIndexes:['dailymoney_id', 'yhteismaara', 'paivarahamaksu', 'sairaanhoitomaksu']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['year']
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                        ,width:'500'
                    })],
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                waitMsg: 'Lataa...',
                clicksToEdit: 2,
                stripeRows: true,
                autoExpandColumn: 'dailymoney_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                height: Ext.lib.Dom.getViewHeight(),
                //autoHeight: true,
                title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-dailymoney',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false 
                    }),
                tbar: [
                        '-',                         
                        {
	                        id: 'refresh-grid',
                        	text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: false,
	                        handler: function () {
	                        	grid.selModel.clearSelections();
	                        	grid.store.clearData();
                                grid.view.refresh();
                                store.reload();
	                        }},
	                        {
		                        id: 'clear-grid',
	                        	text: '<?= $this->clear ?>',
		                        tooltip: '<?= $this->clear_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: function () {
		                        	grid.selModel.clearSelections();
		                        }},
		                        {
			                        id: 'new-grid',
		                        	text: 'Uusi päiväraha rivi',
			                        tooltip: 'Uusi päiväraha rivi tästä napista',
			                        iconCls: 'refresh-icon',
			                        disabled: false,
			                        handler: createNT
		                        }
                        ]
            }); 
             
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/dailymoney/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.dailymoney_id
                        //, start_date: Grid_Event.record.data.start_date.format('Y-m-d')
						//, effective_date: Grid_Event.record.data.effective_date.format('Y-m-d')
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
      
				
             });
            
        
            
 });