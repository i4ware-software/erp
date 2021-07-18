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

 Ext.BLANK_IMAGE_URL = '/zf/public/ext/resources/images/default/s.gif';
 
 Ext.onReady(function() {
    
            Ext.QuickTips.init();
            var fm = Ext.form;
            //var newwin;
            
            createCookie("storeLoaded", "false", 31);
            
            var store = new Ext.data.Store({
                url: '/zf/public/timesheetsarm/json/index',
                reader: new Ext.data.JsonReader({root: 'timesheets',
                    totalProperty: 'totalCount',id: 'order_number'}, 
                        [{name: 'order_number',type: 'int'},
                         {name: 'customer_id',type: 'int'},
                         {name: 'timesheet_id',type: 'int'},
                         {name: 'username',type: 'string'},
                         {name: 'workplace_name',type: 'string'},
                         {name: 'timesheet_name',type: 'string'},
                         {name: 'next',type: 'string'},
                         {name: 'next_user',type: 'int'},
                         {name: 'status_name',type: 'string'},
                         {name: 'occupation',type: 'string'},
                         {name: 'memo',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'order_number', direction: "DESC"},
                        remoteSort: true
             });
            
            store.load({params: { "start":0, "limit":50, "query":"" }});
            
            var storeSalary = new Ext.data.Store({
                url: '/zf/public/timesheetsarm/json/salary',
                reader: new Ext.data.JsonReader({root: 'timesheets',
                    totalProperty: 'totalCount',id: 'timesheet_id'}, 
                        [{name: 'timesheet_id',type: 'int'},
                         {name: 'username',type: 'string'},
                         {name: 'timesheet_name',type: 'string'},
                         {name: 'next',type: 'string'},
                         {name: 'next_user',type: 'int'},
                         {name: 'status',type: 'string'},
                         {name: 'occupation',type: 'string'},
                         {name: 'memo',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'timesheet_id', direction: "DESC"},
                        remoteSort: true
             });
            
            //storeSalary.load({params: { "start":0, "limit":50, "query":"" }});
            
            var storeHistory = new Ext.data.Store({
                url: '/zf/public/timesheetsarm/json/history',
                reader: new Ext.data.JsonReader({root: 'histories',
                    totalProperty: 'totalCount',id: 'history_id'}, 
                        [{name: 'history_id',type: 'int'},
                         {name: 'username',type: 'string'},
                         {name: 'timesheet_id',type: 'int'},
                         {name: 'datetime_created',type: 'date', dateFormat:'Y-m-d H:i:s'},
                         {name: 'description',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'history_id', direction: "DESC"},
                        remoteSort: true
             });
            
            storeHistory.load({params: { "start":0, "limit":50 }});
            
            var storeStatus = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/timesheetsarm/json/status',
					scope: this
				})
				, baseParams: {
					task: "status"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'status_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}, 
						{name: 'DisplayField'}
					]
				})
			});		
				
            storeStatus.loadData;
            storeStatus.load();
            
            // create the Grid
            var grid = new Ext.grid.EditorGridPanel({
                store: store,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'order_number',
                        header   : '#', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'order_number'
                    },{
                        id       :'timesheet_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'timesheet_id'
                    },{
                        id       :'customer_id',
                        header   : 'PID', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'customer_id'
                    },{
                        id       : 'workplace_name',
                        header   : '<?= $this->workplace_name ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'workplace_name'
                    },{
                        id       : 'timesheet_name',
                        header   : '<?= $this->timesheet_name ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'timesheet_name'
                    },{
                        id       : 'username',
                        header   : '<?= $this->username ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'username'
                    },{
                        id       :'occupation',
                        header   : '<?= $this->occupation ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'occupation'
                    },{
                        id       :'status_name',
                        header   : '<?= $this->status ?>', 
                        width    : 160, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'status_name'
                    },/*{
                        id       :'memo',
                        header   : '<?= $this->memo ?>', 
                        width    : 600, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'memo'
                    },*/{
                        id       :'next',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'next'
                    },{
                        id       :'next_user',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'next_user'
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: store,           
                    pageSize: 50,
                    id:'paging-toolbar',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->notimesheets ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['timesheet_id']
                        ,disableIndexes:['order_number','timesheet_id','customer_id','next_user']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                        ,checkIndexes:['workplace_name']
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
                waitMsg: '',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'timesheet_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                title: '<?= $this->invoicing ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-timesheets',
                //renderTo: 'TimesheetsGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    }),
                tbar: [
                        '-',                         
                        {
	                        id: 'refresh-grid-invoice',
                        	text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: false,
	                        handler: function () {
	                        	grid.store.clearData();
	    		                grid.view.refresh();
	                            grid.selModel.clearSelections();
	                            store.reload();
	                            storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
	                        	gridHistory.store.clearData();
	                            gridHistory.view.refresh();
	                            storeHistory.reload();
	                            Ext.getCmp('edit-timesheet-grid-invoice').disable();
	                            Ext.getCmp('pdf-timesheet-grid-invoising').disable();
	                        }},{
	                        id: 'edit-timesheet-grid-invoice',
                        	text: '<?= $this->edit_timesheet ?>',
	                        tooltip: '<?= $this->edit_timesheet_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
	                        	var timesheet_id = readCookie('timesheet_id');
	                        	var customer_id = readCookie('customer_id');
                        	    //var next_user = readCookie('next_user');
                        	    //if (next_user != '<?= $this->user_id ?>') {
                        	    //Ext.MessageBox.alert('<?= $this->access_denied ?>', '<?= $this->access_denied_text ?>');
                        	    //} else {
                        	    window.location = "/zf/public/timesheetsarm/index/timesheet?timesheet_id=" + timesheet_id + "&customer_id=" + customer_id;
                        	    //}
	                        }},{
		                        id: 'pdf-timesheet-grid-invoising',
	                        	text: '<?= $this->pdf_timesheet ?>',
		                        tooltip: '<?= $this->pdf_timesheet_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: true,
		                        handler: function () {
		                        	var timesheet_id = readCookie('timesheet_id');
		                        	var customer_id = readCookie('customer_id');
	                        	    window.location = "/zf/public/timesheetsarm/json/timesheettcpdfinvoising?timesheet_id=" + timesheet_id + "&customer_id=" + customer_id;;
		                        }
		                        }
                        ]
            });
            
            var sm = new Ext.grid.CheckboxSelectionModel();
            
            // create the Grid
            var gridSalary = new Ext.grid.EditorGridPanel({
                store: storeSalary,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        sm, {
                        id       :'timesheet_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'timesheet_id'
                    },{
                        id       : 'timesheet_name',
                        header   : '<?= $this->timesheet_name ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'timesheet_name'
                    },{
                        id       : 'username',
                        header   : '<?= $this->username ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'username'
                    },{
                        id       :'occupation',
                        header   : '<?= $this->occupation ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'occupation'
                    },{
                        id       :'status_name',
                        header   : '<?= $this->status ?>', 
                        width    : 160, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'status',
                        editor: new Ext.form.ComboBox({									    
							store: storeStatus,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false								
						}), 
						renderer: function(data) {
							record = storeStatus.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
						}
                    },/*{
                        id       :'memo',
                        header   : '<?= $this->memo ?>', 
                        width    : 600, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'memo'
                    },*/{
                        id       :'next',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'next'
                    },
                    {
                        id       :'next_user',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'next_user'
                    }
                    ],
					isCellEditable: function(col, row) {
			         var record = storeSalary.getAt(row);
					 //alert(record.get('status'));
			        if (record.get('status') == '6' || record.get('status') == '7') { // replace with your condition
			           Ext.MessageBox.alert('<?= $this->nopermission ?>', '<?= $this->nopermission_text ?>');
			           return false;
			       }
			           return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, col, row);
			       }
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: storeSalary,           
                    pageSize: 50,
                    id:'paging-toolbar-salary',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->notimesheets ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['timesheet_id']
                        ,disableIndexes:['timesheet_id','next_user']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                        ,checkIndexes:['timesheet_name']
                        ,width:'500'
                    })],
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                waitMsg: '',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'timesheet_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                title: '<?= $this->salary ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-timesheets-salary',
                //renderTo: 'TimesheetsGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
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
	                        	gridSalary.store.clearData();
	    		                gridSalary.view.refresh();
	                            gridSalary.selModel.clearSelections();
	                            storeSalary.reload();
	                            storeHistory.reload();
	                            storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
	                        	gridHistory.store.clearData();
	                            gridHistory.view.refresh();
	                            storeHistory.reload();
	                            //Ext.getCmp('delete-timesheet-grid').disable();
	    						Ext.getCmp('edit-timesheet-grid-salary').disable();
	    						//Ext.getCmp('pay-timesheet-grid').disable();
	    						Ext.getCmp('pdf-timesheet-grid').disable();
	                        }},{
	                        id: 'edit-timesheet-grid-salary',
                        	text: '<?= $this->edit_timesheet ?>',
	                        tooltip: '<?= $this->edit_timesheet_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
	                        	var timesheet_id = readCookie('timesheet_id');
	                        	//var customer_id = readCookie('customer_id');
                        	    //var next_user = readCookie('next_user');
                        	    //if (next_user != '<?= $this->user_id ?>') {
                        	    //Ext.MessageBox.alert('<?= $this->access_denied ?>', '<?= $this->access_denied_text ?>');
                        	    //} else {
                        	    window.location = "/zf/public/timesheetsarm/index/timesheet?timesheet_id=" + timesheet_id + "&type=salary";
                        	    //}
	                        }},
	                        /*{
		                        id: 'delete-timesheet-grid',
	                        	text: '<?= $this->delete_timesheet ?>',
		                        tooltip: '<?= $this->delete_timesheet_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: true,
		                        handler: handleDeleteTimesheet
		                        },*/
		                        {
			                        id: 'pay-timesheet-grid',
		                        	text: '<?= $this->pay_timesheet ?>',
			                        tooltip: '<?= $this->pay_timesheet_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: false,
			                        handler: handlePayTimesheet
			                        },{
				                        id: 'pdf-timesheet-grid',
			                        	text: '<?= $this->pdf_timesheet ?>',
				                        tooltip: '<?= $this->pdf_timesheet_tooltip ?>',
				                        iconCls: 'refresh-icon',
				                        disabled: true,
				                        handler: function () {
				                        	var timesheet_id = readCookie('timesheet_id');
			                        	    window.location = "/zf/public/timesheetsarm/json/timesheettcpdf?timesheet_id=" + timesheet_id + "&type=salary";
				                        }
				                        }
                        ]
            });
            
            // create the data store
            var storeSalaryCards = new Ext.data.Store({
                    url: '/zf/public/timesheetsarm/json/salarycards',
                    reader: new Ext.data.JsonReader({root: 'carts',
                        totalProperty: 'totalCount',id: 'card_id'}, 
                            [{name: 'card_id',type: 'int'},
                             {name: 'timesheet_id',type: 'int'},
                             {name: 'employee_id',type: 'int'},
                             {name: 'fullname',type: 'string'},
                             {name: 'sotu',type: 'float'},
                             {name: 'TyEL',type: 'float'},
                             //{name: 'TyEL53',type: 'float'},
                             {name: 'unemployment',type: 'float'},
                             {name: 'datepayment',type: 'float'},
                             {name: 'responsibility',type: 'float'},
                             {name: 'group',type: 'float'},
                             {name: 'accident',type: 'float'},
                             {name: 'tax',type: 'float'},
                             {name: 'TyELTT',type: 'float'},
                             //{name: 'TyELTT53',type: 'float'},
                             {name: 'unemploymentTT',type: 'float'},
                             {name: 'AY',type: 'float'},
                             {name: 'norm_sum',type: 'float'},
                             {name: 'norm_hours',type: 'float'},
                             {name: 'la_sum',type: 'float'},
                             {name: 'la_hours',type: 'float'},
                             {name: 'su_sum',type: 'float'},
                             {name: 'su_hours',type: 'float'},
                             {name: 'ilta_sum',type: 'float'},
                             {name: 'ilta_hours',type: 'float'},
                             {name: 'yo_sum',type: 'float'},
                             {name: 'yo_hours',type: 'float'},
                             {name: 'vrk_50_sum',type: 'float'},
                             {name: 'vrk_50_hours',type: 'float'},
                             {name: 'vrk_100_sum',type: 'float'},
                             {name: 'vrk_100_hours',type: 'float'},
                             {name: 'vko_50_sum',type: 'float'},
                             {name: 'vko_50_hours',type: 'float'},
                             {name: 'vko_100_sum',type: 'float'},
                             {name: 'vko_100_hours',type: 'float'},
                             {name: 'atv_sum',type: 'float'},
                             {name: 'atv_hours',type: 'float'},
                             {name: 'traveling_sum',type: 'float'},
                             {name: 'traveling_hours',type: 'float'},
                             {name: 'osa_sum',type: 'float'},
                             {name: 'koko_sum',type: 'float'},
                             {name: 'ateria_sum',type: 'float'},
                             {name: 'km_sum',type: 'float'},
                             {name: 'tyokalu_sum',type: 'float'},
                             {name: 'total_sum',type: 'float'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'card_id', direction: "DESC"}
                        });
                        
            storeSalaryCards.load({params: { "start":0, "limit":50, "query":"" }});
            
            // create the Grid
            var gridSalarycards = new Ext.grid.EditorGridPanel({
                store: storeSalaryCards,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                            id       :'card_id',
                            header   : 'CID', 
                            width    : 40, 
                            sortable : true,
                            locked:true,
                            dataIndex: 'card_id'
                        },{
                        id       :'timesheet_id',
                        header   : 'TID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'timesheet_id'
                    },{
                        id       : 'employee_id',
                        header   : 'EID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'employee_id'
                    },{
                        id       : 'fullname',
                        header   : '<?= $this->username ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'fullname'
                    },{
                        id       : 'norm_hours',
                        header   : 'norm. Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'norm_hours'
                    },{
                        id       : 'norm',
                        header   : 'norm. EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'norm_sum'
                    },{
                        id       : 'la_hours',
                        header   : 'la Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'la_hours'
                    },{
                        id       : 'la_sum',
                        header   : 'la EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'la_sum'
                    },{
                        id       : 'su_hours',
                        header   : 'su Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'su_hours'
                    },{
                        id       : 'su_sum',
                        header   : 'su EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'su_sum'
                    },{
                        id       : 'ilta_hours',
                        header   : 'ilta Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'ilta_hours'
                    },{
                        id       : 'ilta_sum',
                        header   : 'ilta EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'ilta_sum'
                    },{
                        id       : 'yo_hours',
                        header   : 'yo Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'yo_hours'
                    },{
                        id       : 'yo_sum',
                        header   : 'yo EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'yo_sum'
                    },{
                        id       : 'vrk_50_hours',
                        header   : 'vrk 50 % Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vrk_50_hours'
                    },{
                        id       : 'vrk_50_sum',
                        header   : 'vrk 50 % EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vrk_50_sum'
                    },{
                        id       : 'vrk_100_hours',
                        header   : 'vrk 100 % Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vrk_100_hours'
                    },{
                        id       : 'vrk_100_sum',
                        header   : 'vrk 100 % EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vrk_100_sum'
                    },{
                        id       : 'vko_50_hours',
                        header   : 'vko 50 % Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vko_50_hours'
                    },{
                        id       : 'vko_50_sum',
                        header   : 'vko 50 % EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vko_50_sum'
                    },{
                        id       : 'vko_100_hours',
                        header   : 'vko 100 % Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vko_100_hours'
                    },{
                        id       : 'vko_100_sum',
                        header   : 'vko 100 % EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'vko_100_sum'
                    },{
                        id       : 'atv_hours',
                        header   : 'ATV Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'atv_hours'
                    },{
                        id       : 'atv_sum',
                        header   : 'ATV EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'atv_sum'
                    },{
                        id       : 'traveling_hours',
                        header   : 'Matkatunnit Tunnit', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'traveling_hours'
                    },{
                        id       : 'traveling_sum',
                        header   : 'Matkatunnit EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'traveling_sum'
                    },{
                        id       : 'osa_sum',
                        header   : 'OSA EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'osa_sum'
                    },{
                        id       : 'koko_sum',
                        header   : 'Koko EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'koko_sum'
                    },{
                        id       : 'ateria_sum',
                        header   : 'Atriakorvaus EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'ateria_sum'
                    },{
                        id       : 'km_sum',
                        header   : 'KM EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'km_sum'
                    },{
                        id       : 'tyokalu_sum',
                        header   : 'Tyokalukorvaus EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'tyokalu_sum'
                    },{
                        id       : 'total_sum',
                        header   : 'Kokonaispalkka EUR', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'total_sum'
                    },{
                        id       : 'sotu',
                        header   : 'SOTU', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'sotu'
                    },{
                        id       : 'TyEL',
                        header   : 'TyEL', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'TyEL'
                    },/*{
                        id       : 'TyEL53',
                        header   : 'TyEL, yli 53-vuotias', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'TyEL53'
                    },*/{
                        id       : 'unemployment',
                        header   : '<?= $this->unemployment ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'unemployment'
                    },{
                        id       : 'datepayment',
                        header   : '<?= $this->datepayment ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'datepayment'
                    },{
                        id       : 'responsibility',
                        header   : '<?= $this->responsibility ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'responsibility'
                    },{
                        id       : 'group',
                        header   : '<?= $this->group ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'group'
                    },{
                        id       : 'tax',
                        header   : '<?= $this->tax ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'tax'
                    },{
                        id       : 'TyELTT',
                        header   : '<?= $this->TyELTT ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'TyELTT'
                    },/*{
                        id       : 'TyELTT53',
                        header   : '<?= $this->TyELTT53 ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'TyELTT53'
                    },*/{
                        id       : 'unemploymentTT',
                        header   : '<?= $this->unemploymentTT ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'unemploymentTT'
                    },{
                        id       : 'AY',
                        header   : '<?= $this->AY ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'AY'
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: storeSalaryCards,           
                    pageSize: 50,
                    id:'paging-toolbar-salary-cards',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->nocards ?>'}
                ),
                /*plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['timesheet_id']
                        ,disableIndexes:['timesheet_id','next_user']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                        ,checkIndexes:['timesheet_name']
                        ,width:'500'
                    })],*/
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                waitMsg: '',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'timesheet_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                title: '<?= $this->salarycards ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-cards-salary',
                //renderTo: 'TimesheetsGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    }),
                tbar: [
                        '-',
                        {
	                        id: 'refresh-grid-cards',
                        	text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: false,
	                        handler: function () {
	                        	
	                        	Ext.getCmp('download-grid-cards').disable();
	                        	//Ext.getCmp('delete-grid-cards').disable();
	                        	
	                        	gridSalarycards.store.clearData();
	                        	gridSalarycards.view.refresh();
	                        	gridSalarycards.selModel.clearSelections();
	                        	storeSalaryCards.reload();
	                        	
	                        }
                        },{
	                        id: 'download-grid-cards',
                        	text: '<?= $this->download ?>',
	                        tooltip: '<?= $this->download_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
	                        	var card_id = readCookie('card_id');
	                        	 window.location = '/zf/public/timesheetsarm/json/salarycardspdf?card_id='+card_id;
	                        }
                        }
                        /*,/*{
	                        id: 'delete-grid-cards',
                        	text: '<?= $this->delete_salary_card ?>',
	                        tooltip: '<?= $this->delete_salary_card_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: handleDeleteSalaryCard
                        }*/
                        ]
            });
            
            // create the data store
            var storePaymentHistory = new Ext.data.Store({
                    url: '/zf/public/timesheetsarm/json/paymenthistory',
                    reader: new Ext.data.JsonReader({root: 'payment_history',
                        totalProperty: 'totalCount',id: 'payment_id'}, 
                            [{name: 'payment_id',type: 'int'},
                             {name: 'username',type: 'string'},
                             {name: 'payment_date',type: 'date', dateFormat:'Y-m-d H:i:s'},
                             {name: 'payment_file',type: 'string'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'payment_id', direction: "DESC"}
                        });
                        
            storePaymentHistory.load({params: { "start":0, "limit":50, "query":"" }});
            
            // create the Grid
            var paymentHistory = new Ext.grid.EditorGridPanel({
                store: storePaymentHistory,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        sm, {
                        id       :'payment_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'payment_id'
                    },{
                        id       : 'user_id',
                        header   : '<?= $this->username ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'username'
                    },{
                        id       :'payment_date',
                        header   : '<?= $this->payment_date ?>', 
                        width    : 150, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'payment_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y H:i:s'),
                    },{
                        id       : 'payment_file',
                        header   : '<?= $this->payment_file ?>', 
                        width    : 300, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'payment_file'
                    },
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: storePaymentHistory,           
                    pageSize: 50,
                    id:'paging-toolbar-payment',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->nopayments ?>'}
                ),
                /*plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['payment_id']
                        ,disableIndexes:['payment_id','payment_file']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                        ,checkIndexes:['payment_date']
                        ,width:'500'
                    })],*/
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                waitMsg: '',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'timesheet_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                title: '<?= $this->payment_history ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-payment-history',
                //renderTo: 'TimesheetsGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    }),
                tbar: [
                        '-',                         
                        {
	                        id: 'refresh-grid-payment',
                        	text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: false,
	                        handler: function () {
	                        	//gridSalary.store.clearData();
	    		                //gridSalary.view.refresh();
	                            //gridSalary.selModel.clearSelections();
	                            //storeSalary.reload();
	                            //storeHistory.reload();
	                            //storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
	                        	//gridHistory.store.clearData();
	                            //gridHistory.view.refresh();
	                            //storeHistory.reload();
	                            //Ext.getCmp('delete-timesheet-grid').disable();
	    						//Ext.getCmp('edit-timesheet-grid-salary').disable();
	    						//Ext.getCmp('pay-timesheet-grid').disable();
	    						//Ext.getCmp('pdf-timesheet-grid').disable();
	                        	paymentHistory.store.clearData();
	                        	paymentHistory.view.refresh();
	                        	paymentHistory.selModel.clearSelections();
	                            storePaymentHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/paymenthistory?timesheet_id=0";
	                        	storePaymentHistory.reload();
	                        	
	                        }
                        },{
	                        id: 'load-grid-payment',
                        	text: '<?= $this->load_payment_file ?>',
	                        tooltip: '<?= $this->load_payment_file_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
	                        	//var timesheet_id = readCookie('timesheet_id');
	                        	
	                        	var selectedRows = paymentHistory.selModel.selections.items;
	                            
                                var selectedKeys = paymentHistory.selModel.selections.keys; 

                                var encoded_keys = Ext.encode(selectedKeys); 
                                
                                encoded_keys = encoded_keys.replace('["', '');
                                encoded_keys = encoded_keys.replace('"]', '');
	                        	
	                        	var payment_id = encoded_keys;
                        	    window.location = "/zf/public/timesheetsarm/json/loadpaymentfile?payment_id=" + payment_id;
	                        }
                        }
                        ]
            });
            
            var tabs = new Ext.TabPanel({
            	renderTo: 'TimesheetsGrid',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                activeTab: 0,
                deferredRender: false,
                autoTabs: true,
                frame:true,
                defaults:{autoHeight: false},
                items:[
                    //grid,
                    gridSalary,
                    /*{
                        layout: 'fit',
                        border: true,
                        frame: false,
                        title: '<?= $this->salary_settings ?>',
                        id: 'salaryframe',
                        defaultType: 'iframepanel',
                        width: Ext.lib.Dom.getViewWidth(),
                        defaults: {
                            loadMask: {hideOnReady :true,msg:'Loading...'},
                            border: false,
                            header: false
                        },
                        items: [{
                        	width: Ext.lib.Dom.getViewWidth(),
                            id: 'salary_settings_iframe',
                            defaultSrc: '/zf/public/salary/index/index'
                           
                        }]
                    },*/
                    gridSalarycards
                ]
            });
            
            gridSalary.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/timesheetsarm/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.timesheet_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        storeStatus.commitChanges();
						storeStatus.reload();
                    }      
                    , scope: this
                });
            };
            
            /*
            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/timesheet/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [
                     {fieldLabel : '<?= $this->timesheet_name ?>',
                     name : 'timesheet_name',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },
                 {
                     fieldLabel : '<?= $this->agreement ?>',
                     name : 'agreement_id',
             		hiddenName: 'agreement_id',
                     allowBlank : false,
             		xtype:'combo',
             		//value:'1',
             		store: storeAgreement,
 					displayField: 'DisplayField',
 	                valueField: 'KeyField',
                     mode: 'local',
                     triggerAction: 'all'
             		}
                ]
            });
            
            function createNewTimesheet() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-career',
                                //layout : 'fit',
                                width : 480,
                                height : 180,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_timesheet ?>',
                                items : [newform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/timesheet/json/createnew";
                                               // alert('moi');
                                                if(newform.getForm().isValid()){
            									newwin.hide();
                                                newform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        newform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															newform
                                                                                .getForm()
                                                                                .reset();
            															//viitenumero_auto.getForm().reset();
            															//myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->error ?>',
                                                                                        json.msg);
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                                newform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newwin.show(this);
            }*/
            
            /*function handleDeleteTimesheet() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridSalary.selModel.selections.items;
				var selectedKeys = gridSalary.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/timesheetsarm/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'timesheet_id'
						}
					, callback: function (options, success, response) {
						if (success) { 
							
						} else {							
							Ext.MessageBox.alert('<?= $this->error ?>',response.responseText);
						}
					}
					, failure:function(response,options){
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...');
					}                                      
					, success:function(response,options){
						var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						gridSalary.store.clearData();
						gridSalary.view.refresh();
						gridSalary.selModel.clearSelections();
						storeSalary.reload();
						Ext.getCmp('delete-timesheet-grid').disable();
						Ext.getCmp('edit-timesheet-grid-salary').disable();Ext.getCmp('pay-timesheet-grid').disable();
						//Ext.getCmp('pay-timesheet-grid').disable();
						Ext.getCmp('pdf-timesheet-grid').disable();
						storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
                    	gridHistory.store.clearData();
                        gridHistory.view.refresh();
                        storeHistory.reload();				
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};*/
			
            function handlePayTimesheet() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				/*var selectedRows = gridSalary.selModel.selections.items;
				var selectedKeys = gridSalary.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);*/
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/timesheetsarm/json/postpaysalary'
					, params: { 
						task: "paysalary"
						//, deleteKeys: encoded_keys
						//, key: 'timesheet_id'
						}
					, callback: function (options, success, response) {
						if (success) { 
							
						} else {							
							Ext.MessageBox.alert('<?= $this->error ?>',response.responseText);
						}
					}
					, failure:function(response,options){
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...');
					}                                      
					, success:function(response,options){
						var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						//Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						    document.location = "/zf/public/timesheetsarm/json/paysalary?selectedRows="+Ext.encode(json.timesheets);
							//document.location = "/zf/public/timesheetsarm/json/paysalary";
						} else { // else then do this
						} // end if
						gridSalary.store.clearData();
		                gridSalary.view.refresh();
                        gridSalary.selModel.clearSelections();
						storeSalary.reload();
						//Ext.getCmp('delete-timesheet-grid').disable();
						Ext.getCmp('edit-timesheet-grid-salary').disable();
						//Ext.getCmp('pay-timesheet-grid').disable();
						Ext.getCmp('pdf-timesheet-grid').disable();
						storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
                    	gridHistory.store.clearData();
                        gridHistory.view.refresh();
                        storeHistory.reload();				
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
            /*function handleDeleteSalaryCard() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridSalarycards.selModel.selections.items;
				var selectedKeys = gridSalarycards.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/timesheetsarm/json/deletecard'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'card_id'
						}
					, callback: function (options, success, response) {
						if (success) { 
							
						} else {							
							Ext.MessageBox.alert('<?= $this->error ?>',response.responseText);
						}
					}
					, failure:function(response,options){
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...');
					}                                      
					, success:function(response,options){
						var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						gridSalarycards.store.clearData();
						gridSalarycards.view.refresh();
						gridSalarycards.selModel.clearSelections();
						storeSalaryCards.reload();
						//Ext.getCmp('delete-timesheet-grid').disable();
						//Ext.getCmp('edit-timesheet-grid-salary').disable();Ext.getCmp('pay-timesheet-grid').disable();
						//Ext.getCmp('pay-timesheet-grid').disable();
						//Ext.getCmp('pdf-timesheet-grid').disable();
						//storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id=0";
                    	//gridHistory.store.clearData();
                        //gridHistory.view.refresh();
                        //storeHistory.reload();
						Ext.getCmp('download-grid-cards').disable();
		            	Ext.getCmp('delete-grid-cards').disable();
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};*/
            
            store.on('load', function() {
            	
            	//Ext.getCmp('edit-timesheet-grid').disable();
            	
			});
            
            var gridHistory = new Ext.grid.GridPanel({
            	 store: storeHistory,
                 cm: new Ext.ux.grid.LockingColumnModel({
                     defaults: {
                         //width: 40,
                         sortable: true
                     },
                     columns: [
                         {
                         id       :'history_id',
                         header   : 'ID', 
                         width    : 40, 
                         sortable : true,
                         locked:false,
                         dataIndex: 'history_id'
                     },{
                         header   : 'TID', 
                         width    : 200, 
                         sortable : false,
                         locked:false,
                         dataIndex: 'timesheet_id'
                     },{
                         header   : '<?= $this->username ?>', 
                         width    : 150, 
                         sortable : false,
                         locked:false,
                         dataIndex: 'username'
                     },{
                         header   : '<?= $this->datetime_created ?>', 
                         width    : 150, 
                         sortable : false,
                         locked:false,
                         dataIndex: 'datetime_created',
                         renderer:  Ext.util.Format.dateRenderer('d.m.Y H:i:s'),
                     },{
                         header   : '<?= $this->description ?>', 
                         width    : 800, 
                         sortable : false,
                         locked:false,
                         dataIndex: 'description'
                     }
                     ]
                 }),
                 //colModel: colModel,
                  bbar: new Ext.PagingToolbar({
                     store: storeHistory,           
                     pageSize: 50,
                     id:'paging-toolbar-history',
                     prependButtons: true,
                     beforePageText: '<?= $this->page ?>',
                     displayInfo: '{0} / {1} - {2}',
                     displayMsg: '{0} / {1} - {2}',
                     emptyMsg: '<?= $this->nohistory ?>'}
                 ),
                 /*plugins:[ new Ext.ux.grid.Search({
                         iconCls:'icon-zoom'
                         ,readonlyIndexes:['timesheet_id']
                         ,disableIndexes:['timesheet_id']
                         ,minChars:3
                         //,xtype:'combo'
                         ,searchText:'<?= $this->search ?>'
                         ,autoFocus:true
                         ,menuStyle:'radio'
                     })],*/
                 collapsible: false,
                 animCollapse: false,
                 enableDragDrop: false,
                 selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                 enableColumnResize: false,
                 enableColumnMove: false,
                 enableHdMenu: false,
                 loadMask:true,
                 waitMsg: '',
                 clicksToEdit: 2,
                 stripeRows: true,
                 //autoExpandColumn: 'history_id',
                 width: Ext.lib.Dom.getViewWidth(),
                 height: Ext.lib.Dom.getViewHeight() * 0.5,
                 title: '<?= $this->history ?>',
                 // config options for stateful behavior
                 stateful: true,
                 stateId: 'grid-history',
                 //renderTo: 'TimesheetsGrid',
                 view: new Ext.ux.grid.LockingGridView({
                     forceFit: false
                     //showGroupName: false,
                     //enableNoGroups: false,
                     //enableGroupingMenu: false,
                     //hideGroupedColumn: true
                     })
            });
            
            var tabsHistory = new Ext.TabPanel({
            	renderTo: 'TimesheetsGrid',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                activeTab: 0,
                deferredRender: false,
                autoTabs: true,
                frame:true,
                defaults:{autoHeight: false},
                items:[
                    gridHistory,
                    paymentHistory
                ]
            });
            
            storeStatus.on('load', function() {
            	
            	var storeLoaded = readCookie('storeLoaded');
            	
            	if (storeLoaded==="false") {
                   storeSalary.load({params: { "start":0, "limit":50, "query":"" }});
            	   createCookie("storeLoaded", "true", 31);
            	}
            	
			});
            
            storePaymentHistory.on('load', function() {
            	paymentHistory.selModel.clearSelections();
            	Ext.getCmp('load-grid-payment').disable();
			});
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	
            	Ext.getCmp('edit-timesheet-grid-invoice').enable();
            	Ext.getCmp('pdf-timesheet-grid-invoising').enable();
      
            	createCookie("next_user", r.get('next_user'), 31);
            	createCookie("timesheet_id", r.get('timesheet_id'), 31);
            	createCookie("customer_id", r.get('customer_id'), 31);
            	
            	storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id="+r.get('timesheet_id');
            	gridHistory.store.clearData();
                gridHistory.view.refresh();
            	storeHistory.reload();
				
             });
            
            gridSalary.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	
            	Ext.getCmp('edit-timesheet-grid-salary').enable();
            	//Ext.getCmp('delete-timesheet-grid').enable();
            	//Ext.getCmp('pay-timesheet-grid').enable();
            	Ext.getCmp('pdf-timesheet-grid').enable();
            	createCookie("next_user", r.get('next_user'), 31);
            	createCookie("timesheet_id", r.get('timesheet_id'), 31);
            	//createCookie("customer_id", r.get('customer_id'), 31);
            	
            	storeHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/history?timesheet_id="+r.get('timesheet_id');
            	gridHistory.store.clearData();
                gridHistory.view.refresh();
            	storeHistory.reload();
            	
            	//storePaymentHistory.proxy.conn.url = "/zf/public/timesheetsarm/json/paymenthistory?timesheet_id="+r.get('timesheet_id');
            	//paymentHistory.store.clearData();
            	//paymentHistory.view.refresh();
                //storePaymentHistory.reload();
				
             });
            
            paymentHistory.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	Ext.getCmp('load-grid-payment').enable();
            });
            
            gridSalarycards.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	Ext.getCmp('download-grid-cards').enable();
            	//Ext.getCmp('delete-grid-cards').enable();
            	createCookie("card_id", r.get('card_id'), 31);
            });
 });
 
 