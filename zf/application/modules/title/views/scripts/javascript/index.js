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
	 
	 function years(val) {               
         if (val<=0) {
         return '-'; 
         } else if (val==1) {
         return '<span style="color:#880000;">' + val + '<?= $this->year ?></span>';
         } else if (val>1) {
         return '<span style="color:#008800;">' + val + '<?= $this->years ?></span>';
         }    
     }
    
            Ext.QuickTips.init();
            var fm = Ext.form;
            var newwin;
            var eduwin;
            
            var store = new Ext.data.Store({
                url: '/zf/public/title/json/index',
                reader: new Ext.data.JsonReader({root: 'titles',
                    totalProperty: 'totalCount',id: 'title_id'}, 
                        [{name: 'title_id',type: 'int'},
                         {name: 'title_name',type: 'string'},
                         {name: 'experience',type: 'int'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'title_id', direction: "DESC"},
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
                        id       :'title_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'title_id'
                    },{
                        id       :'title_name',
                        header   : '<?= $this->title ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'title_name',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'experience_in_years',
                        header   : '<?= $this->experience_in_years ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'experience',
                        renderer : years,
                        editor: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 150000
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
                    emptyMsg: '<?= $this->notitles ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['title_id']
                        ,disableIndexes:['title_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['title_name']
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
                autoExpandColumn: 'title_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-title',
                renderTo: 'TitleGrid',
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
	                        	Ext.getCmp('delete-title-grid').disable();
                        	    grid.selModel.clearSelections();
                        	    //Ext.getCmp('download').disable();
	                            store.reload();
	                        }},
	                        {
		                        id: 'new-title-grid',
	                        	text: '<?= $this->new_title ?>',
		                        tooltip: '<?= $this->new_title_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: newTitle
		                     },
		                        {
			                        id: 'delete-title-grid',
		                        	text: '<?= $this->delete_title ?>',
			                        tooltip: '<?= $this->delete_title_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteTitle
			                     }
                        ]
            });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/title/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.title_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){   
                    	Ext.getCmp('delete-title-grid').disable();
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            var newtitle = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/title/json/createnew",
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
                items : [{
                    fieldLabel : '<?= $this->title ?>',
                    name : 'title_name',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->experience_in_years ?>',
                    name : 'experience',
                    allowBlank : false,
                    anchor:'95%'
                }
                ]
                    }]
                }
            });

            function newTitle() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-title',
                                //layout : 'fit',
                                width : 500,
                                height : 280,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_title ?>',
                                items : [newtitle],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/title/json/createnew";
                                                if(newtitle.getForm().isValid()){
            									newwin.hide();
            									newtitle
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                    	newtitle
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('delete-title-grid').disable();
                                                                        //storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newtitle
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
                                            	newtitle.getForm().reset();
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
            
            function deleteTitle() {
				
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
					, url: '/zf/public/title/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'title_id'
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
						Ext.getCmp('delete-title-grid').disable();
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
            
            var educationsStore = new Ext.data.Store({
                url: '/zf/public/title/json/education',
                reader: new Ext.data.JsonReader({root: 'educations',
                    totalProperty: 'totalCount',id: 'relation_id'}, 
                        [{name: 'relation_id',type: 'int'},
                         {name: 'education_id',type: 'int'},
                         {name: 'title_id',type: 'int'},
                         {name: 'education_name',type: 'string'}]),
                        sortInfo:{field: 'relation_id', direction: "DESC"}
             });
            
            educationsStore.load();
            
            var storeEducations = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/title/json/educations',
					scope: this
				})
				, baseParams: {
					task: "educations"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'educations_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
          storeEducations.loadData;
          storeEducations.load();
          
          // create the Grid
          var educationsGrid = new Ext.grid.GridPanel({
               store: educationsStore,
               cm: new Ext.grid.ColumnModel({
                   defaults: {
                       //width: 40,
                       sortable: true
                   },
                   columns: [
                            { id : 'relation_id', header: "RID", width: 40, sortable: false, dataIndex: 'relation_id'},
                            { header: "EID", width: 40, sortable: false, dataIndex: 'education_id'},
                       		{ header: "TID", width: 40, sortable: false, dataIndex: 'title_id'},
                       		{header: "<?= $this->education_name ?>", width: 200, sortable: false, dataIndex: 'education_name'}
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
               autoExpandColumn: 'relation_id',
               width: Ext.lib.Dom.getViewWidth(),
               height: Ext.lib.Dom.getViewHeight() * 0.5,
               //title: '<?= $this->module ?>',
               // config options for stateful behavior
               stateful: true,
               stateId: 'grid-educations',
               renderTo: 'TitleGrid',
               view: new Ext.grid.GridView({
                   forceFit: false
                   //showGroupName: false,
                   //enableNoGroups: false,
                   //enableGroupingMenu: false,
                   //hideGroupedColumn: true
                   }),
               tbar: [
                       '-',                         
	                       {
		                        id: 'education_title-grid',
	                        	text: '<?= $this->education_title ?>',
		                        tooltip: '<?= $this->education_title_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: true,
		                        handler: addEDU
		                     },
	 	                       {
			                        id: 'delete-education_title-grid',
		                        	text: '<?= $this->delete_education_title ?>',
			                        tooltip: '<?= $this->delete_education_title_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: deleteEDU
			                     }
                       ]
           });
          
          function deleteEDU() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletetext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = educationsGrid.selModel.selections.items;
				var selectedKeys = educationsGrid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/title/json/deleteeducation'
					, params: { 
						task: "deleteeducation"
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
						Ext.getCmp('delete-education_title-grid').disable();
		            	//grid.selModel.clearSelections();
		            	//grid.store.clearData();
		                //grid.view.refresh();
		            	//store.reload();
						educationsStore.proxy.conn.url = "/zf/public/title/json/education?title_id="+json.title_id;
						educationsGrid.store.clearData();
						educationsGrid.view.refresh();
						educationsStore.reload();
                      
						storeEducations.proxy.conn.url = "/zf/public/title/json/educations?title_id="+json.title_id;
						storeEducations.reload();
		            	
                    }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
			var addeducationform = new Ext.FormPanel( {
              id : Ext.id(),
              labelWidth : 200,
              url : "/zf/public/title/json/addeducation",
              frame : false,
              bodyStyle : 'padding:5px 5px 0 0',
              width : 470,
              height : 280,
              border : false,
              items:[{
                  fieldLabel : 'ID',
                  id: 'title_id_form',
                  name : 'title_id',
                  hiddenName: 'title_id',
                  xtype:'textfield',
                  allowBlank : false,
                  anchor:'95%',
                  hidden: true
              },{
                fieldLabel : '<?= $this->education_name ?>',
                name : 'education_id',
          		hiddenName: 'education_id',
                allowBlank : false,
          		xtype:'combo',
          		//value:'1',
          		store: storeEducations,
			      displayField: 'DisplayField',
	              valueField: 'KeyField',
                  mode: 'local',
                  triggerAction: 'all',
                  anchor:'95%'
          		}
              ]
          });

          function addEDU() {

              // create the window on the first click and reuse on subsequent
              // clicks
              if (!eduwin) {
            	  eduwin = new Ext.Window({
              		width        : 480,
              		height       : 280,
              		closeAction : 'hide',
                      plain : true,
                      title : '<?= $this->addeducation ?>',
                      items : [addeducationform],
                      buttons     : [{
                          text : '<?= $this->submit ?>',
                          handler : function() {
                              var url = "/zf/public/title/json/addeducation";
                              if(addeducationform.getForm().isValid()){
                            	eduwin.hide();
								addeducationform
                                      .getForm()
                                      .submit(
                                              {
                                                  waitMsg : '<?= $this->sending ?>',
                                                  url : url,
                                                  success : function(
                                                          form, action) {
                                                	  addeducationform
                                                              .getForm()
                                                              .reset();
                                                      //myaccount_password_auto.getForm().reset();
														var json = Ext.util.JSON.decode(action.response.responseText); 
                                                      Ext.MessageBox
                                                      .alert(
                                                              '<?= $this->success ?>',
                                                              json.msg);
                                                    educationsStore.proxy.conn.url = "/zf/public/title/json/education?title_id="+json.title_id;
                              						educationsGrid.store.clearData();
                              						educationsGrid.view.refresh();
                              						educationsStore.reload();
                                                    
                              						storeEducations.proxy.conn.url = "/zf/public/title/json/educations?title_id="+json.title_id;
                              						storeEducations.reload();
                                                  },
                                                  failure : function(
                                                          form, action) {
                                                	  addeducationform
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
                            	addeducationform.getForm().reset();
                                  //myaccount_password_auto.getForm().reset();
                                  //store.reload();
                            	eduwin.hide();
                              }
                          }
              		]
              	});
          				
              }
              eduwin.show(this);
          }
          
          grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
        	  Ext.getCmp('delete-title-grid').enable();
              Ext.getCmp('education_title-grid').enable();
              Ext.getCmp('delete-education_title-grid').disable();
              
              Ext.getCmp('title_id_form').setValue(r.get('title_id'));
              
              educationsStore.proxy.conn.url = "/zf/public/title/json/education?title_id="+r.get('title_id');
			  educationsGrid.store.clearData();
			  educationsGrid.view.refresh();
			  educationsStore.reload();
              
			  storeEducations.proxy.conn.url = "/zf/public/title/json/educations?title_id="+r.get('title_id');
			  storeEducations.reload();
				
           });
           
           educationsGrid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
           	Ext.getCmp('delete-education_title-grid').enable();
				
           });
            
 });