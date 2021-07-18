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
            var newqawin;
            
            var store = new Ext.data.Store({
                url: '/zf/public/qualifications/json/index',
                reader: new Ext.data.JsonReader({root: 'qualifications',
                    totalProperty: 'totalCount',id: 'education_id'}, 
                        [{name: 'education_id',type: 'int'},
                         {name: 'education_name',type: 'string'},
                         {name: 'education_type',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'education_id', direction: "DESC"},
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
                        id       :'education_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'education_id'
                    },{
                        id       :'education_name',
                        header   : '<?= $this->education_name ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'education_name',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'education_type',
                        header   : '<?= $this->education_type ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'education_type',
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
                    emptyMsg: '<?= $this->noqualifications ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['education_id']
                        ,disableIndexes:['education_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['education_name']
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
                waitMsg: 'Lataa pätevyyksiä uudestaan...',
                clicksToEdit: 2,
                stripeRows: true,
                autoExpandColumn: 'education_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-qualifications',
                renderTo: 'QualificationsGrid',
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
	                        	Ext.getCmp('delete-qualification-grid').disable();
	                        	grid.selModel.clearSelections();
                        	    //Ext.getCmp('download').disable();
	                            store.reload();
	                        }},
	                        {
		                        id: 'new-qualification-grid',
	                        	text: '<?= $this->new_qualification ?>',
		                        tooltip: '<?= $this->new_qualification_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: newQA
		                     },
		                        {
			                        id: 'delete-qualification-grid',
		                        	text: '<?= $this->delete_qualification ?>',
			                        tooltip: '<?= $this->delete_qualification_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteQA
			                     }
                        ]
            });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/qualifications/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.education_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){
                    	Ext.getCmp('delete-qualification-grid').disable();
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            var newqualification = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/qualifications/json/createnew",
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
                    fieldLabel : '<?= $this->education_name ?>',
                    name : 'education_name',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->education_type ?>',
                    name : 'education_type',
                    allowBlank : false,
                    anchor:'95%'
                }
                ]
                    }]
                }
            });

            function newQA() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newqawin) {
                    newqawin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-qa',
                                //layout : 'fit',
                                width : 500,
                                height : 280,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_education ?>',
                                items : [newqualification],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/qualifications/json/createnew";
                                                if(newqualification.getForm().isValid()){
            									newqawin.hide();
            									newqualification
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newqualification
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        Ext.getCmp('delete-qualification-grid').disable();
                                                                        store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newqualification
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
                                                newqawin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newqawin.show(this);
            }
            
            function deleteQA() {
				
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
					, url: '/zf/public/qualifications/json/deleteqa'
					, params: { 
						task: "deleteqa"
						, deleteKeys: encoded_keys
						, key: 'education_id'
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
						Ext.getCmp('delete-qualification-grid').disable();
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
				
            	Ext.getCmp('delete-qualification-grid').enable();
				
             });
            
 });