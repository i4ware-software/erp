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
                url: '/zf/public/tes/json/index',
                reader: new Ext.data.JsonReader({root: 'tes',
                    totalProperty: 'totalCount',id: 'tes_id'}, 
                        [{name: 'tes_id',type: 'int'},
                         {name: 'tes',type: 'string'},
                         {name: 'la',type: 'float'},
                         {name: 'su',type: 'float'},
                         {name: 'lisat_ilta',type: 'float'},
                         {name: 'lisat_yo',type: 'float'},
                         {name: 'date_start',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'date_effective',type: 'date', dateFormat:'Y-m-d'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'tes_id', direction: "DESC"},
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
                        id       :'tes_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'tes_id'
                    },{
                        id       :'tes',
                        header   : '<?= $this->tes ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'tes',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'la',
                        header   : '<?= $this->la ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'la',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'su',
                        header   : '<?= $this->su ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'su',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'lisat_ilta',
                        header   : '<?= $this->lisat_ilta ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'lisat_ilta',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'lisat_yo',
                        header   : '<?= $this->lisat_yo ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'lisat_yo',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'date_start',
                        header   : '<?= $this->start_date ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'date_start',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            //minValue: '01/01/1970',
                            //minText: '<?= $this->min_date ?>',
                            //maxValue: '12/31/2999'
                        }
                    },{
                        id       :'date_effective',
                        header   : '<?= $this->effective_date ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'date_effective',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            //minValue: '01/01/1970',
                            //minText: '<?= $this->min_date ?>',
                            //maxValue: '12/31/2999'
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
                    emptyMsg: '<?= $this->notes ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['tes_id']
                        ,disableIndexes:['tes_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['tes']
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
                //autoExpandColumn: 'tes_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-tes',
                renderTo: 'TesGrid',
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
	                        	Ext.getCmp('delete-tes-grid').disable();
                        	    grid.selModel.clearSelections();
                        	    //Ext.getCmp('download').disable();
	                            store.reload();
	                        }},
	                        {
		                        id: 'new-new-grid',
	                        	text: '<?= $this->new_tes ?>',
		                        tooltip: '<?= $this->new_tes_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: newTes
		                     },
		                        {
			                        id: 'delete-tes-grid',
		                        	text: '<?= $this->delete_tes ?>',
			                        tooltip: '<?= $this->delete_tes_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteTes
			                     }
                        ]
            });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/tes/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.tes_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){   
                    	Ext.getCmp('delete-tes-grid').disable();
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            var newtes = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/tes/json/createnew",
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
                    fieldLabel : '<?= $this->tes ?>',
                    name : 'tes',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->start_date ?>',
                    name : 'date_start',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y',
                    anchor:'95%'
                },{
                	fieldLabel : '<?= $this->effective_date ?>',
                    name : 'date_effective',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y',
                    anchor:'95%'
                }
                ]
                    }]
                }
            });

            function newTes() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-tes',
                                //layout : 'fit',
                                width : 500,
                                height : 280,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_tes ?>',
                                items : [newtes],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/tes/json/createnew";
                                                if(newtes.getForm().isValid()){
            									newwin.hide();
            									newtes
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newtes
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('delete-tes-grid').disable();
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
            
            function deleteTes() {
				
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
					, url: '/zf/public/tes/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'tes_id'
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
						Ext.getCmp('delete-tes-grid').disable();
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
				
            	Ext.getCmp('delete-tes-grid').enable();
				
             });
            
 });