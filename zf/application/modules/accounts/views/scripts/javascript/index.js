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
            var replacewin;
            
            // create the data store
            var store = new Ext.data.Store({
                    url: '/zf/public/accounts/json/index',
                    reader: new Ext.data.JsonReader({root: 'accounts',
                        totalProperty: 'totalCount',id: 'tili_id'}, 
                            [{name: 'tili_id',type: 'int'},
                            {name: 'tili_nimi',type: 'string'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'tili_id', direction: "DESC"},
                            remoteSort: true
                        });
                        
             store.load({params: { "start":0, "limit":50, "query":"" }});
            
            function saveEdit (Grid_Event) {
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/accounts/json/edit'
					, params: { 
						task: "edit"
						, key: 'tili_id' 
						, keyID: Grid_Event.record.data.tili_id
						, originalValue: Grid_Event.record.modified
						, field: Grid_Event.field
						, value: Grid_Event.value
						}
					, failure:function(response,options){
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...');
					}                            
					, success:function(response,options){
					    var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...'); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						store.commitChanges();
						}      
					, scope: this
				});
			};
			
			function handleDelete() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/accounts/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'tili_id'
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
						Ext.MessageBox.alert('<?= $this->error ?>','Oops...'); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						  Ext.getCmp('delete').disable();
						  grid.selModel.clearSelections();
						  store.reload();
						//storechart.reload();
					    //storechart.loadData();					
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};

            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/accounts/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->tili_id ?>',
                    name : 'tili_id',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->tili_nimi ?>',
                    name : 'tili_nimi',
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
                                width : 480,
                                height : 200,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new ?>',
                                items : [newform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/accounts/json/createnew";
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
                                                                        /*Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);*/
            															Ext.getCmp('delete').disable();
            															grid.selModel.clearSelections();
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
                                                                                        '<?= $this->error ?>',
                                                                                        'Oops...');
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
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
            
            var replaceform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/accounts/json/import",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: true,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    xtype: 'fileuploadfield',
                    id: 'form-file-replace',
                    emptyText: '<?= $this->select_xls ?>',
                    fieldLabel: '<?= $this->select_xls_label ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
                    name: 'importfile',
                    anchor:'95%',
                    validator: function(v){
                        if(!/\.xls$/.test(v)){
                        return '<?= $this->only_xls_allowed ?>';
                        }
                     return true;
                    },
                    buttonText: '<?= $this->browse ?>'
                }
                ]
            });

            function importNT() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replacewin) {
                    replacewin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'replace-new',
                                //layout : 'fit',
                                width : 480,
                                height : 120,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->import ?>',
                                items : [replaceform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/accounts/json/import";
                                                if(replaceform.getForm().isValid()){
            									replacewin.hide();
                                                replaceform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        replaceform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText);
            															Ext.getCmp('delete').disable();
            															grid.selModel.clearSelections();
                                                						store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															replaceform
                                                                                .getForm()
                                                                                .reset();
            															//myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->error ?>',
                                                                                        'Oops...');
                                                                        grid.selModel.clearSelections();
                                                                        Ext.getCmp('delete').disable();
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                                replaceform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                replacewin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replacewin.show(this);
     }
    
    // create the Grid
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: new Ext.grid.ColumnModel({
            defaults: {
                width: 40,
                sortable: true
            },
            columns: [
                {
                id       :'tili_id',
                header   : 'ID', 
                width    : 40, 
                sortable : true,
                locked:true,
                dataIndex: 'tili_id'
            },
            {
                header   : '<?= $this->nimi ?>', 
                width    : 140, 
                sortable : true,
                locked:true, 
                dataIndex: 'tili_nimi',
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
            displayInfo: '{0} - {1} of {2}',
            displayMsg: '{0} - {1} of {2}',
            emptyMsg: 'No data to display'}
        ),
        plugins:[ new Ext.ux.grid.Search({
                iconCls:'icon-zoom'
                //,readonlyIndexes:['tili_id']
                //,disableIndexes:[]
                ,minChars:3
                //,xtype:'combo'
                ,autoFocus:true
                ,menuStyle:'radio'
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
        //autoExpandColumn: 'tili_id',
        width: Ext.lib.Dom.getViewWidth(),
        height: Ext.lib.Dom.getViewHeight(),
        title: '<?= $this->module ?>',
        // config options for stateful behavior
        stateful: true,
        stateId: 'grid',
        view: new Ext.grid.GridView({
            forceFit: true
            //showGroupName: false,
            //enableNoGroups: false,
            //enableGroupingMenu: false,
            //hideGroupedColumn: true
            }),
        tbar: [
                '-',
                 {
                text: '<?= $this->deselect ?>'
                , tooltip: '<?= $this->deselect_tooltip ?>'
                , iconCls:'refresh-icon'
                , handler: function () {
                    grid.selModel.clearSelections();
                    //Ext.getCmp('download').disable();
                    Ext.getCmp('delete').disable();
                }},
                {
                text: '<?= $this->refresh ?>',
                tooltip: '<?= $this->refresh_tooltip ?>',
                iconCls: 'refresh-icon',
                handler: function () {
                    store.reload();
                    grid.selModel.clearSelections();
                    Ext.getCmp('delete').disable();
                }},
                {
                    text: '<?= $this->export ?>',
                    tooltip: '<?= $this->export_tooltip ?>',
                    iconCls: 'refresh-icon',
                    handler: function () {
                    	window.location = '/zf/public/accounts/json/export';
                }},
                {
                    text: '<?= $this->import ?>',
                    tooltip: '<?= $this->import_tooltip ?>',
                    iconCls: 'refresh-icon',
                    handler: importNT
                },
                {
                    text: '<?= $this->addnew ?>',
                    tooltip: '<?= $this->addnew_tooltip ?>',
                    iconCls: 'refresh-icon',
                    handler: createNT
                },{
                    id: 'delete',
                	text: '<?= $this->delete ?>',
                    tooltip: '<?= $this->delete_tooltip ?>',
                    iconCls: 'refresh-icon',
                    disabled:true,
                    handler: handleDelete
                }]
    });
    
    grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
       
       Ext.getCmp('delete').enable();
       
    });
    
    grid.addListener('afteredit', saveEdit, this);

    // render the grid to the specified div in the page
    grid.render('AccountsForm'); 
            
 });