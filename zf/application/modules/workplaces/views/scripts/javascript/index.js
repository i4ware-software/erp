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
            var newwin;
            var rewin;
            var newwithoutwin;
            var changeaccepterwin;
            
            var store = new Ext.data.Store({
                url: '/zf/public/workplaces/json/index',
                reader: new Ext.data.JsonReader({root: 'workplaces',
                    totalProperty: 'totalCount',id: 'workplace_id'}, 
                        [{name: 'workplace_id',type: 'int'},
                         {name: 'customer_id',type: 'int'},
                         {name: 'order_id',type: 'string'},
                         {name: 'workplace_name',type: 'string'},
                         {name: 'contact_person_name',type: 'string'},
                         {name: 'contact_person_phone',type: 'string'},
                         {name: 'contact_person_email',type: 'string'},
                         {name: 'customer_address',type: 'string'},
                         {name: 'start_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'date_completed',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'permanent',type: 'string'},
                         {name: 'project_id',type: 'string'},
                         {name: 'profitcenter_id',type: 'string'},
						 {name: 'target',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'workplace_id', direction: "DESC"},
                        remoteSort: true
             });
            
            store.load({params: { "start":0, "limit":50, "query":"" }});
            
            var storeCustomer = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/workplaces/json/customers',
					scope: this
				})
				, baseParams: {
					task: "customers"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'customers_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
           storeCustomer.loadData;
           storeCustomer.load();
            
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
                        id       :'workplace_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'workplace_id'
                    },{
                        id       :'customer_id',
                        header   : 'CID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_id'
                    },{
                        id       :'profitcenter_id',
                        header   : '<?= $this->profitcenter_id ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'profitcenter_id',
                        editor: new fm.TextField({
    						allowBlank: true
    					})
                    },{
                        id       :'project_id',
                        header   : '<?= $this->project_id ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'project_id',
                        editor: new fm.TextField({
    						allowBlank: true
    					})
                    },{
                        id       :'order_id',
                        header   : '<?= $this->order_id ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'order_id',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'workplace_name',
                        header   : '<?= $this->workplace_name ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'workplace_name',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'contact_person_name',
                        header   : '<?= $this->contact_person_name ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'contact_person_name',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'contact_person_phone',
                        header   : '<?= $this->contact_person_phone ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'contact_person_phone',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'contact_person_email',
                        header   : '<?= $this->contact_person_email ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'contact_person_email',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'customer_address',
                        header   : '<?= $this->customer_address ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_address',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'customer_target',
                        header   : '<?= $this->target ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'target',
                        editor: {
                        	xtype:'textarea',
                        	allowBlank: false
                    }},{
                        id       :'start_date',
                        header   : '<?= $this->start_date ?>', 
                        width    : 120, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'start_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: true
                        }
                    },{
                        id       :'date_completed',
                        header   : '<?= $this->date_completed ?>', 
                        width    : 120, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'date_completed',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: true
                        }
                    },{
                        id       :'permanent',
                        header   : '<?= $this->permanent ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'permanent',
                        xtype: 'booleancolumn',
                        trueText: '<?= $this->true ?>',
                        falseText: '<?= $this->false ?>',
                        editor: {
                        	xtype:'combo',
                        	allowBlank: false,
                    		store: new Ext.data.SimpleStore({
                                                    fields: ['id','value'],
                                                    data:[
                    								["true","<?= $this->true ?>"],
                    								["false","<?= $this->false ?>"]
                    								]
                                                }),
                                                displayField: 'value',
                                                valueField: 'id',
                                                mode: 'local',
                                                triggerAction: 'all'
                        }
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
                    emptyMsg: '<?= $this->noworkplaces ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['workplace_id']
                        ,disableIndexes:['workplace_id','customer_id', 'permanent', 'start_date','date_completed']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['profitcenter_id']
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
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'workplace_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-workplaces',
                renderTo: 'WorkplacesGrid',
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
                        	    Ext.getCmp('delete-workplace-grid').disable();
                        	    Ext.getCmp('resouce-workplace-grid').disable();
                        	    //Ext.getCmp('refresh-grid-employees').disable();
                        	    Ext.getCmp('delete-resouce-workplace-grid').disable();
        		            	grid.selModel.clearSelections();
        		            	grid.store.clearData();
        		                grid.view.refresh();
	                            store.reload();
	                            employeesGrid.store.clearData();
	                        	employeesGrid.view.refresh();
	                        }},
	                        {
		                        id: 'new-workplace-grid',
	                        	text: '<?= $this->new_workplace ?>',
		                        tooltip: '<?= $this->new_workplace_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: newWP
		                     },
		                        {
			                        id: 'new-without-workplace-grid',
		                        	text: '<?= $this->new_without_workplace ?>',
			                        tooltip: '<?= $this->new_without_workplace_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: false,
			                        handler: newWWP
			                     },
		                        {
			                        id: 'delete-workplace-grid',
		                        	text: '<?= $this->delete_workplace ?>',
			                        tooltip: '<?= $this->delete_workplace_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteWP
			                     },
			                        {
				                        id: 'change-accepter-grid',
			                        	text: '<?= $this->change_accepter ?>',
				                        tooltip: '<?= $this->change_accepter_tooltip ?>',
				                        iconCls: 'refresh-icon',
				                        disabled: true,
				                        handler: changeA
				                     }
                        ]
            });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/workplaces/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.workplace_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        store.commitChanges();
                        Ext.getCmp('delete-workplace-grid').disable();
                        Ext.getCmp('resouce-workplace-grid').disable();
                        //Ext.getCmp('refresh-grid-employees').disable();
                        Ext.getCmp('delete-resouce-workplace-grid').disable();
		            	grid.selModel.clearSelections();
		            	grid.store.clearData();
		                grid.view.refresh();
						store.reload();
						employeesGrid.store.clearData();
                    	employeesGrid.view.refresh();
                    }      
                    , scope: this
                });
            };
            
            var changeaccepter = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/workplaces/json/changeacceper",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 80,
                border : false,
                fileUpload: false,
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->accepter ?>',
                    name : 'customer_id',
            		hiddenName: 'customer_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeCustomer,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all',
                    anchor:'95%'
            		}
                ]
            });
            
            function changeA() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!changeaccepterwin) {
                	changeaccepterwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'changeaccpeter',
                                //layout : 'fit',
                                width : 500,
                                height : 100,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->change_accepter ?>',
                                items : [changeaccepter],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/workplaces/json/changeaccepter";
                                                if(changeaccepter.getForm().isValid()){
                                                changeaccepterwin.hide();
                                                changeaccepter
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                    	changeaccepter
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        Ext.getCmp('delete-workplace-grid').disable();
                                                                        Ext.getCmp('resouce-workplace-grid').disable();
                                                                        //Ext.getCmp('refresh-grid-employees').disable();
                                                                        Ext.getCmp('delete-resouce-workplace-grid').disable();
                                                                        Ext.getCmp('change-accepter-grid').disable();
                                                		            	grid.selModel.clearSelections();
                                                		            	grid.store.clearData();
                                                		                grid.view.refresh();
                                                                        store.reload();
                                                                        employeesGrid.store.clearData();
                                        	                        	employeesGrid.view.refresh();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	changeaccepter
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
                                                //newform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	changeaccepterwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                changeaccepterwin.show(this);
            }
            
            var newworkwithoutplace = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/workplaces/json/createnewwithout",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 340,
                border : false,
                fileUpload: false,
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->order_id ?>',
                    name : 'order_id',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->project_id ?>',
                    name : 'project_id',
                    allowBlank : true,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->profitcenter_id ?>',
                    name : 'profitcenter_id',
                    allowBlank : true,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->customer_address ?>',
                    name : 'customer_address',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    xtype : 'textarea',
					fieldLabel : '<?= $this->target ?>',
                    name : 'target',
                    allowBlank : false,
					height: 50,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->accepter ?>',
                    name : 'customer_id',
            		hiddenName: 'customer_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeCustomer,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all',
                    anchor:'95%'
            		},{
                        fieldLabel : '<?= $this->start_date ?>',
                        name : 'start_date',
                        allowBlank : true,
                        xtype: 'datefield',
                        format: 'd.m.Y',
                        anchor:'95%'
                    },{
                        fieldLabel : '<?= $this->date_completed ?>',
                        name : 'date_completed',
                        allowBlank : true,
                        xtype: 'datefield',
                        format: 'd.m.Y',
                        anchor:'95%'
                    },
                    {
                    	xtype: 'checkbox',
                    	fieldLabel: '<?= $this->permanent ?>',
                        boxLabel: '',
                        name: 'permanent'
                    }
                ]
            });
            
            function newWWP() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwithoutwin) {
                	newwithoutwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-workplace-without',
                                //layout : 'fit',
                                width : 500,
                                height : 450,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_without_workplace ?>',
                                items : [newworkwithoutplace],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/workplaces/json/createnewwithout";
                                                if(newworkwithoutplace.getForm().isValid()){
                                                newwithoutwin.hide();
                                                newworkwithoutplace
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newworkplace
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        Ext.getCmp('delete-workplace-grid').disable();
                                                                        Ext.getCmp('resouce-workplace-grid').disable();
                                                                        //Ext.getCmp('refresh-grid-employees').disable();
                                                                        Ext.getCmp('delete-resouce-workplace-grid').disable();
                                                                        Ext.getCmp('change-accepter-grid').disable();
                                                                        grid.selModel.clearSelections();
                                                		            	grid.store.clearData();
                                                		                grid.view.refresh();
                                                                        store.reload();
                                                                        employeesGrid.store.clearData();
                                        	                        	employeesGrid.view.refresh();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newworkwithoutplace
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
                                                //newform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	newwithoutwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newwithoutwin.show(this);
            }
            
            var newworkplace = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/workplaces/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 340,
                border : false,
                fileUpload: false,
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->workplace_name ?>',
                    name : 'workplace_name',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->contact_person_firstname ?>',
                    name : 'contact_person_firstname',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->contact_person_lastname ?>',
                    name : 'contact_person_lastname',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->contact_person_phone ?>',
                    name : 'contact_person_phone',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->contact_person_email ?>',
                    name : 'contact_person_email',
                    vtype:'email',
                    allowBlank : false,
                    anchor:'95%'
                }
                ]
            });

            function newWP() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-workplace',
                                //layout : 'fit',
                                width : 500,
                                height : 450,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_workplace ?>',
                                items : [newworkplace],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/workplaces/json/createnew";
                                                if(newworkplace.getForm().isValid()){
            									newwin.hide();
            									newworkplace
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newworkplace
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        Ext.getCmp('delete-workplace-grid').disable();
                                                                        Ext.getCmp('resouce-workplace-grid').disable();
                                                                        //Ext.getCmp('refresh-grid-employees').disable();
                                                                        Ext.getCmp('delete-resouce-workplace-grid').disable();
                                                                        Ext.getCmp('change-accepter-grid').disable();
                                                                        grid.selModel.clearSelections();
                                                		            	grid.store.clearData();
                                                		                grid.view.refresh();
                                                                        store.reload();
                                                                        storeCustomer.reload();
                                                                        employeesGrid.store.clearData();
                                        	                        	employeesGrid.view.refresh();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newworkplace
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
                                                //newform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newwin.show(this);
            }
            
            var employeesStore = new Ext.data.Store({
                url: '/zf/public/workplaces/json/employees',
                reader: new Ext.data.JsonReader({root: 'employees',
                    totalProperty: 'totalCount',id: 'relation_id'}, 
                        [{name: 'relation_id',type: 'int'},
                         {name: 'workplace_id',type: 'int'},
                         {name: 'employee_id',type: 'int'},
                         {name: 'fullname',type: 'string'}]),
                        sortInfo:{field: 'relation_id', direction: "DESC"}
             });
            
            employeesStore.load();
            
            var storeEmployee = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/workplaces/json/resources',
					scope: this
				})
				, baseParams: {
					task: "resources"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'resources_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
        storeEmployee.loadData;
        storeEmployee.load();
            
            // create the Grid
            var employeesGrid = new Ext.grid.GridPanel({
                 store: employeesStore,
                 cm: new Ext.grid.ColumnModel({
                     defaults: {
                         //width: 40,
                         sortable: true
                     },
                     columns: [
                               { id : 'relation_id', header: "RID", width: 40, sortable: false, dataIndex: 'relation_id'},
                               { header: "WID", width: 40, sortable: false, dataIndex: 'workplace_id'},
                         		{ header: "EID", width: 40, sortable: false, dataIndex: 'employee_id'},
                         		{header: "<?= $this->fullname ?>", width: 200, sortable: false, dataIndex: 'fullname'}
                         	]
                 }),
                 collapsible: false,
                 animCollapse: false,
                 enableDragDrop: false,
                 selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                 enableColumnResize: false,
                 enableColumnMove: false,
                 enableHdMenu: false,
                 loadMask:true,
                 //waitMsg: 'Lataa voimassaolevia koulutuksia uudestaan...',
                 //clicksToEdit: 2,
                 stripeRows: true,
                 //autoExpandColumn: 'relation_id',
                 width: Ext.lib.Dom.getViewWidth(),
                 height: Ext.lib.Dom.getViewHeight() * 0.5,
                 //title: '<?= $this->module ?>',
                 // config options for stateful behavior
                 stateful: true,
                 stateId: 'grid-employees',
                 renderTo: 'WorkplacesGrid',
                 view: new Ext.grid.GridView({
                     forceFit: false
                     //showGroupName: false,
                     //enableNoGroups: false,
                     //enableGroupingMenu: false,
                     //hideGroupedColumn: true
                     }),
                 tbar: [
                         '-',                         
                         /*{
 	                        id: 'refresh-grid-employees',
                         	text: '<?= $this->refresh_employees ?>',
 	                        tooltip: '<?= $this->refresh_employees_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: function () {
 	                         employeesGrid.store.clearData();
                        	 employeesGrid.view.refresh();
                             employeesStore.reload();
                             Ext.getCmp('delete-resouce-workplace-grid').disable();
 	                        }},*/
 	                       {
		                        id: 'resouce-workplace-grid',
	                        	text: '<?= $this->resourse_workplace ?>',
		                        tooltip: '<?= $this->resourse_workplace_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: true,
		                        handler: addRE
		                     },
	 	                       {
			                        id: 'delete-resouce-workplace-grid',
		                        	text: '<?= $this->delete_resourse_workplace ?>',
			                        tooltip: '<?= $this->delete_resourse_workplace_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteRE
			                     }
                         ]
             });
            
            function deleteWP() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletetext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/workplaces/json/delete'
					, params: { 
						task: "deletewp"
						, deleteKeys: encoded_keys
						, key: 'workplace_id'
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
						
		            	//Ext.getCmp('download-grid-certificates').disable();
		            	//Ext.getCmp('delete-grid-qualifications').disable();
						Ext.getCmp('delete-workplace-grid').disable();
						Ext.getCmp('resouce-workplace-grid').disable();
						//Ext.getCmp('refresh-grid-employees').disable();
						Ext.getCmp('delete-resouce-workplace-grid').disable();
						Ext.getCmp('change-accepter-grid').disable();
		            	grid.selModel.clearSelections();
		            	grid.store.clearData();
		                grid.view.refresh();
		            	store.reload();
		            	employeesGrid.store.clearData();
                    	employeesGrid.view.refresh();
                      }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
            function deleteRE() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletetext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = employeesGrid.selModel.selections.items;
				var selectedKeys = employeesGrid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/workplaces/json/deleteresource'
					, params: { 
						task: "deleteresource"
						, deleteKeys: encoded_keys
						, key: 'relation_id'
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
						
		            	//Ext.getCmp('download-grid-certificates').disable();
		            	//Ext.getCmp('delete-grid-qualifications').disable();
						//Ext.getCmp('delete-workplace-grid').disable();
						//Ext.getCmp('resouce-workplace-grid').disable();
						//Ext.getCmp('refresh-grid-employees').disable();
						Ext.getCmp('delete-resouce-workplace-grid').disable();
		            	//grid.selModel.clearSelections();
		            	//grid.store.clearData();
		                //grid.view.refresh();
		            	//store.reload();
						employeesStore.proxy.conn.url = "/zf/public/workplaces/json/employees?workplace_id="+json.workplace_id;
                        employeesGrid.store.clearData();
                        employeesGrid.view.refresh();
                        employeesStore.reload();
                        
                        storeEmployee.proxy.conn.url = "/zf/public/workplaces/json/resources?workplace_id="+json.workplace_id;
                        storeEmployee.reload();
		            	
                      }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
			var addresourceform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/workplaces/json/addresource",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 280,
                border : false,
                items:[{
                    fieldLabel : 'ID',
                    id: 'workplace_id_form',
                    name : 'workplace_id',
                    hiddenName: 'workplace_id',
                    xtype:'textfield',
                    allowBlank : false,
                    anchor:'95%',
                    hidden: true
                },{
                    fieldLabel : '<?= $this->employee_name ?>',
                    name : 'employee_id',
            		hiddenName: 'employee_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeEmployee,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all',
                    anchor:'95%'
            		}
                ]
            });

            function addRE() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!rewin) {
                    rewin = new Ext.Window({
                		width        : 480,
                		height       : 280,
                		closeAction : 'hide',
                        plain : true,
                        title : '<?= $this->addresourse ?>',
                        items : [addresourceform],
                        buttons     : [{
                            text : '<?= $this->submit ?>',
                            handler : function() {
                                var url = "/zf/public/workplaces/json/addresource";
                                if(addresourceform.getForm().isValid()){
								rewin.hide();
								addresourceform
                                        .getForm()
                                        .submit(
                                                {
                                                    waitMsg : '<?= $this->sending ?>',
                                                    url : url,
                                                    success : function(
                                                            form, action) {
                                                    	addresourceform
                                                                .getForm()
                                                                .reset();
                                                        //myaccount_password_auto.getForm().reset();
														var json = Ext.util.JSON.decode(action.response.responseText); 
                                                        Ext.MessageBox
                                                        .alert(
                                                                '<?= $this->success ?>',
                                                                json.msg);
                                                        employeesStore.proxy.conn.url = "/zf/public/workplaces/json/employees?workplace_id="+json.workplace_id;
                                                        employeesGrid.store.clearData();
                                                        employeesGrid.view.refresh();
                                                        employeesStore.reload();
                                                        
                                                        storeEmployee.proxy.conn.url = "/zf/public/workplaces/json/resources?workplace_id="+json.workplace_id;
                                                        storeEmployee.reload();
                                                    },
                                                    failure : function(
                                                            form, action) {
                                                    	addresourceform
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
                        },
                			{
                                text : '<?= $this->close ?>',
                                handler : function() {
                                	addresourceform.getForm().reset();
                                    //myaccount_password_auto.getForm().reset();
                                    //store.reload();
                                	rewin.hide();
                                }
                            }
                		]
                	});
            				
                }
                rewin.show(this);
            }
			
             grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
            	Ext.getCmp('delete-workplace-grid').enable();
                Ext.getCmp('resouce-workplace-grid').enable();
                //Ext.getCmp('refresh-grid-employees').enable();
                Ext.getCmp('delete-resouce-workplace-grid').disable();
                Ext.getCmp('change-accepter-grid').enable();
                
                Ext.getCmp('workplace_id_form').setValue(r.get('workplace_id'));
                
            	employeesStore.proxy.conn.url = "/zf/public/workplaces/json/employees?workplace_id="+r.get('workplace_id');
            	employeesGrid.store.clearData();
            	employeesGrid.view.refresh();
                employeesStore.reload();
                
                storeEmployee.proxy.conn.url = "/zf/public/workplaces/json/resources?workplace_id="+r.get('workplace_id');
                storeEmployee.reload();
				
             });
             
             employeesGrid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
 				
             	Ext.getCmp('delete-resouce-workplace-grid').enable();
 				
             });
            
 });