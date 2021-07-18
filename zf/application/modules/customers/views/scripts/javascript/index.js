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
            
            var store = new Ext.data.Store({
                url: '/zf/public/customers/json/index',
                reader: new Ext.data.JsonReader({root: 'customers',
                    totalProperty: 'totalCount',id: 'customer_id'}, 
                        [{name: 'customer_id',type: 'int'},
                         {name: 'customer_name',type: 'string'},
						 {name: 'VAT-ID',type: 'string'},
						 {name: 'customer_address',type: 'string'},
						 {name: 'customer_zip',type: 'string'},
						 {name: 'customer_city',type: 'int'},
						 {name: 'customer_phone',type: 'string'},
						 {name: 'customer_email',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'customer_id', direction: "DESC"},
                        remoteSort: true
             });
            
            store.load({params: { "start":0, "limit":50, "query":"" }});
            
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
                        id       :'customer_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_id'
                    },{
                        id       :'customer_name',
                        header   : '<?= $this->customer_name ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_name',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'VAT_ID',
                        header   : '<?= $this->vat_id ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'VAT-ID',
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
                    }
					,{
                        id       :'customer_zip',
                        header   : '<?= $this->customer_zip ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_zip',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'customer_city',
                        header   : '<?= $this->customer_city ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_city',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    }
					,{
                        id       :'customer_phone',
                        header   : '<?= $this->customer_phone ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_phone',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'customer_email',
                        header   : '<?= $this->customer_email ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'customer_email',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
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
                    emptyMsg: '<?= $this->nocustomers ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['customer_id']
                        ,disableIndexes:['customer_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['customer_name']
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
                autoExpandColumn: 'customer_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-customers',
                renderTo: 'CustomerGrid',
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
	                        	Ext.getCmp('delete-customer-grid').disable();
                        	    grid.selModel.clearSelections();
                        	    //Ext.getCmp('download').disable();
	                            store.reload();
	                        }},
	                        {
		                        id: 'new-customer-grid',
	                        	text: '<?= $this->new_customer ?>',
		                        tooltip: '<?= $this->new_customer_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: newCustomer
		                     },
		                        {
			                        id: 'delete-customer-grid',
		                        	text: '<?= $this->delete_customer ?>',
			                        tooltip: '<?= $this->delete_customer_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteCustomer
			                     }
                        ]
            });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/customers/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.customer_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){   
                    	Ext.getCmp('delete-customer-grid').disable();
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            var newcustomer = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/customer/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 280,
                border : false,
                fileUpload: false,
                items: {
                    xtype:'tabpanel',
                    activeTab: 0,
                    border : false,
                    frame : false,
                    defaults:{autoHeight:true, bodyStyle:'padding:4px'},
                    items:[{
                        title:'Tab 1',
                        layout:'form',
                        defaults: {width: 450},
                        defaultType: 'textfield',
                        fileUpload: true,
                items : [{
                    fieldLabel : '<?= $this->customer_name ?>',
                    name : 'customer_name',
                    allowBlank : false,
                    anchor:'95%'
                }
                ]
                    }]
                }
            });

            function newCustomer() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-customer',
                                //layout : 'fit',
                                width : 500,
                                height : 280,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_customer ?>',
                                items : [newcustomer],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/customers/json/createnew";
                                                if(newcustomer.getForm().isValid()){
            									newwin.hide();
            									newcustomer
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                    	newcustomer
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('delete-customer-grid').disable();
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newtes
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
            
            function deleteCustomer() {
				
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
					, url: '/zf/public/customers/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'customer_id'
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
						Ext.getCmp('delete-customer-grid').disable();
		            	//Ext.getCmp('download-grid-certificates').disable();
		            	//Ext.getCmp('delete-grid-qualifications').disable();
		            	grid.selModel.clearSelections();
		            	grid.store.clearData();
		                grid.view.refresh();
		            	store.reload();
                      }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
            	Ext.getCmp('delete-customer-grid').enable();
				
             });
            
 });