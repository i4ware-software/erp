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
            var newcategorywin;
            var newmaksuehtowin;
            
            createCookie("storeLoaded", "false", 31);
            
         // create the data store
            var store = new Ext.data.Store({
                    url: '/zf/public/toimittaja/json/index',
                    reader: new Ext.data.JsonReader({root: 'toimittaja',
                        totalProperty: 'totalCount',id: 'toimittaja_id'}, 
                            [{name: 'toimittaja_id',type: 'int'},
                            {name: 'nimi',type: 'string'},
                            {name: 'y_tunnus',type: 'string'},
                            {name: 'osoite',type: 'string'},
                            {name: 'puhelinnumero',type: 'string'},
                            {name: 'sahkoposti',type: 'string'},
                            {name: 'iban',type: 'string'},
                            {name: 'bic',type: 'string'},
                            {name: 'muut_maksutiedot',type: 'string'},
                            {name: 'maksuehto',type: 'string'},
                            {name: 'toimitusehto',type: 'string'},
                            {name: 'kategoria_id',type: 'int'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'toimittaja_id', direction: "DESC"},
                            remoteSort: true
                        });
                        
                        //store.load({params: { "start":0, "limit":50, "query":"" }});
                        
                        var storeKategoria = new Ext.data.Store ({
            				proxy: new Ext.data.HttpProxy ({ 
            					url: '/zf/public/toimittaja/json/kategoria',
            					scope: this
            				})
            				, baseParams: {
            					task: "kategoria"
            				}
            				, reader: new Ext.data.JsonReader ({
            					root: 'kategoria_root'
            					, id: 'KeyField'
            					, fields: [
            						{name: 'KeyField'}
            						, {name: 'DisplayField'}
            					]
            				})
            			});		
            				
                        storeKategoria.loadData;
                        storeKategoria.load();
                        
                        var storeMaksuehto = new Ext.data.Store ({
            				proxy: new Ext.data.HttpProxy ({ 
            					url: '/zf/public/toimittaja/json/maksuehto',
            					scope: this
            				})
            				, baseParams: {
            					task: "maksuehto"
            				}
            				, reader: new Ext.data.JsonReader ({
            					root: 'maksuehto_root'
            					, id: 'KeyField'
            					, fields: [
            						{name: 'KeyField'}
            						, {name: 'DisplayField'}
            					]
            				})
            			});		
            				
                        storeMaksuehto.loadData;
                        storeMaksuehto.load();
            
            function saveEdit (Grid_Event) {
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/toimittaja/json/edit'
					, params: { 
						task: "edit"
						, key: 'toimittaja_id' 
						, keyID: Grid_Event.record.data.toimittaja_id
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
						Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						store.commitChanges();
						}      
					, scope: this
				});
			};
			
			function saveCategoryEdit (Grid_Event) {
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/toimittaja/json/editcategory'
					, params: { 
						task: "edit"
						, key: 'kategoria_id' 
						, keyID: Grid_Event.record.data.kategoria_id
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
						Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						storecategory.commitChanges();
						}      
					, scope: this
				});
			};
			
			function saveMaksuehtoEdit (Grid_Event) {
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/toimittaja/json/editmaksuehto'
					, params: { 
						task: "edit"
						, key: 'maksuehto_id' 
						, keyID: Grid_Event.record.data.maksuehto_id
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
						Ext.MessageBox.alert('<?= $this->error ?>',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
						} else { // else then do this
						} // end if
						storemaksuehto.commitChanges();
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
					, url: '/zf/public/toimittaja/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'id'
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
			
           function handleDeleteCategory() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretextcategory ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridcategory.selModel.selections.items;
				var selectedKeys = gridcategory.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/toimittaja/json/deletecategory'
					, params: { 
						task: "deletecategory"
						, deleteKeys: encoded_keys
						, key: 'kategoria_id'
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
						storecategory.reload();
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
			
            function handleDeleteMaksuehto() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretextcategory ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridmaksuehto.selModel.selections.items;
				var selectedKeys = gridmaksuehto.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/toimittaja/json/deletemaksuehto'
					, params: { 
						task: "deletemaksuehto"
						, deleteKeys: encoded_keys
						, key: 'maksuehto_id'
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
						storemaksuehto.reload();
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
			
			var ibanNumero = new Ext.data.Record.create([{
		        name: 'iban'
		    }]);

		    var ibanGenerate = new Ext.data.JsonReader({
		        successProperty: 'success',
		        totalProperty: 'results',
		        root: 'iban',
		        id: 'iban'
		    },
		    ibanNumero);

		    var iban_auto = new Ext.FormPanel({
		        frame: false,
		        border: false,
		        labelAlign: 'left',
		        labelWidth: 85,
		        waitMsgTarget: true,
		        reader: ibanGenerate,
		        items: [
		        new Ext.form.FieldSet({
		            title: '<?= $this->iban_laskuri ?>',
		            autoHeight: true,
		            defaultType: 'textfield',
		            items: [{
		                fieldLabel: '<?= $this->tilinumero ?>',
		                name: 'tili',
		                width: 140,
		                'id': 'tili'
		            }]
		        })]
		    });

		    // simple button add
		    iban_auto.addButton('<?= $this->laske_iban ?>', function () {
		        iban_auto.getForm().submit({
		            url: '/zf/public/toimittaja/json/iban',
		            waitMsg: '<?= $this->loading ?>',
					success: function (form, action) {
		                var json = Ext.util.JSON.decode(action.response.responseText);
		                //Ext.MessageBox.alert('<?= $this->error ?>', json.msg);
						Ext.getCmp('iban').setValue(json.iban);
						Ext.getCmp('bic').setValue(json.bic);
		            },
		            failure: function (form, action) {
		                var json = Ext.util.JSON.decode(action.response.responseText);
		                Ext.MessageBox.alert('<?= $this->error ?>', json.msg);
		            }
		        });
		    });

            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/toimittaja/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->nimi ?>',
                    name : 'nimi',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->ytunnus ?>',
                    name : 'y-tunnus',
                    allowBlank : false
                },{
                	xtype: 'textarea',
                	fieldLabel : '<?= $this->osoite ?>',
                    name : 'osoite',
                    allowBlank : false,
                    height:50
                },{
                    fieldLabel : '<?= $this->puhelinnumero ?>',
                    name : 'puhelinnumero',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->sahkoposti ?>',
                    name : 'sahkoposti',
            		vtype:'email',
                    allowBlank : false
                },{
                    id:'iban',
                	fieldLabel : 'IBAN',
                    name : 'iban',
                    allowBlank : false
                },{
                    id:'bic',
                	fieldLabel : 'BIC',
                    name : 'bic',
                    allowBlank : false
                },{
                	xtype: 'textarea',
                	fieldLabel : '<?= $this->muut_maksutiedot ?>',
                    name : 'muut_maksutiedot',
                    allowBlank : true,
                    height:50
                },{
                    fieldLabel : '<?= $this->maksuehto ?>',
                    name : 'maksuehto',
                    hiddenName: 'maksuehto',
                    allowBlank : false,
                    xtype:'combo',
                    //value:'1',
            		store: storeMaksuehto,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
                },{
                    fieldLabel : '<?= $this->toimitusehto ?>',
                    name : 'toimitusehto',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->kategoria ?>',
                    name : 'kategoria_id',
            		hiddenName: 'kategoria_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeKategoria,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
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
                                height : 520,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new ?>',
                                items : [newform,iban_auto],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/toimittaja/json/createnew";
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
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newwin.show(this);
            }

            var newcategoryform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/toimittaja/json/createnewcategory",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->nimi ?>',
                    name : 'kategoria_nimi',
                    allowBlank : false
                }
                ]
            });

            function createKT() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newcategorywin) {
                    newcategorywin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-category',
                                //layout : 'fit',
                                width : 440,
                                height : 120,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->newcategory ?>',
                                items : [newcategoryform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/toimittaja/json/createnewcategory";
                                                if(newcategoryform.getForm().isValid()){
                                                newcategorywin.hide();
                                                newcategoryform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        newcategoryform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        storecategory.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															newcategoryform
                                                                                .getForm()
                                                                                .reset();
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
                                                newcategoryform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newcategorywin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newcategorywin.show(this);
            }
            
            var newmaksuehtoform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/toimittaja/json/createnewmaksuehto",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : '<?= $this->maksuehtopaivaa ?>',
                    name : 'maksuehto_paivaa',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->maksuehtotyyppi ?>',
                    name : 'maksuehto_tyyppi',
                    allowBlank : false
                }
                ]
            });

            function createME() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newmaksuehtowin) {
                	newmaksuehtowin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-maksuehto',
                                //layout : 'fit',
                                width : 440,
                                height : 120,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->maksuehtonew ?>',
                                items : [newmaksuehtoform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/toimittaja/json/createnewmaksuehto";
                                                if(newmaksuehtoform.getForm().isValid()){
                                                newmaksuehtowin.hide();
                                                newmaksuehtoform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        newcategoryform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        storecategory.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															newcategoryform
                                                                                .getForm()
                                                                                .reset();
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
                                                newcategoryform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newmaksuehtowin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newmaksuehtowin.show(this);
            }
    
    // create the Grid
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: new Ext.ux.grid.LockingColumnModel({
            defaults: {
                width: 40,
                sortable: true
            },
            columns: [
                {
                id       :'toimittaja_id',
                header   : 'ID', 
                width    : 40, 
                sortable : true,
                locked:true,
                dataIndex: 'toimittaja_id'
            },
            {
                header   : '<?= $this->nimi ?>', 
                width    : 140, 
                sortable : true,
                locked:true, 
                dataIndex: 'nimi',
                editor: new fm.TextField({
					allowBlank: false
				})
            },{
                header   : '<?= $this->ytunnus ?>', 
                width    : 75, 
                sortable : true,
                locked:true, 
                dataIndex: 'y_tunnus',
                editor: new fm.TextField({
					allowBlank: false
				})
            },{header: '<?= $this->kategoria ?>',
				dataIndex: 'kategoria_id',
				width: 120,
				sortable: true,
				locked:true,
				hidden:false,
				editor: new Ext.form.ComboBox({									    
										store: storeKategoria,
										displayField: 'DisplayField',
						                valueField: 'KeyField',
										typeAhead: false,
										lazyRender: true,
										triggerAction: 'all',
										disabled:false									
									})
					, renderer: function(data) {
						record = storeKategoria.getById(data);
						if(record) {
							return record.data.DisplayField;
						} else {
							return '( <?= $this->puuttuu ?> )';
						}
					}
				},
            {
                header   : '<?= $this->osoite ?>', 
                width    : 200, 
                sortable : true,
                locked:false, 
                dataIndex: 'osoite',
                editor: new fm.TextArea({
					allowBlank: false
				})
            },
            {
                header   : '<?= $this->puhelinnumero ?>', 
                width    : 120, 
                sortable : true,
                locked:false, 
                dataIndex: 'puhelinnumero',
                editor: new fm.TextField({
					allowBlank: false
				})
            },
            {
                header   : '<?= $this->sahkoposti ?>', 
                width    : 120, 
                sortable : true,
                locked:false, 
                dataIndex: 'sahkoposti',
                editor: new fm.TextField({
					allowBlank: false
				})
            },
            {
                header   : 'IBAN',
                hideable : false,
                width    : 160, 
                sortable : true,
                locked   :false, 
                dataIndex: 'iban',
                editor: new fm.TextField({
					allowBlank: false
				})
            },
            {
                header   : 'BIC',
                hideable : false,
                width    : 75, 
                sortable : true,
                locked   :false, 
                dataIndex: 'bic',
                editor: new fm.TextField({
					allowBlank: false
				})
            },
            {
                header   : '<?= $this->muut_maksutiedot ?>',
                hideable : false,
                width    : 200, 
                sortable : true,
                locked   :false, 
                dataIndex: 'muut_maksutiedot',
                editor: new fm.TextArea({
					allowBlank: true
				})
            },
            {
                header   : '<?= $this->maksuehto ?>',
                hideable : false,
                width    : 160, 
                sortable : true,
                locked   :false, 
                dataIndex: 'maksuehto',
                editor: new Ext.form.ComboBox({									    
					store: storeMaksuehto,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
					typeAhead: false,
					lazyRender: true,
					triggerAction: 'all',
					disabled:false									
				})
                , renderer: function(data) {
				record = storeMaksuehto.getById(data);
				if(record) {
					return record.data.DisplayField;
				} else {
					return '( <?= $this->puuttuu ?> )';
				}
			  }
            },
            {
                header   : '<?= $this->toimitusehto ?>',
                hideable : false,
                width    : 160, 
                sortable : true,
                locked   :false, 
                dataIndex: 'toimitusehto',
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
            emptyMsg: 'No tasks to display'}
        ),
        plugins:[ new Ext.ux.grid.Search({
                iconCls:'icon-zoom'
                ,readonlyIndexes:['toimittaja_id']
                ,disableIndexes:['toimittaja_id', 'sahkoposti', 'osoite', 'puhelinnumero', 'maksuehto', 'toimitusehto', 'muut_maksutiedot', 'bic', 'iban']
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
        //autoExpandColumn: 'toimittaja_id',
        width: Ext.lib.Dom.getViewWidth(),
        height: Ext.lib.Dom.getViewHeight(),
        title: '<?= $this->module ?>',
        // config options for stateful behavior
        stateful: true,
        stateId: 'grid',
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
                    storeKategoria.loadData;
                    storeKategoria.reload();
                }},
                {
                    text: '<?= $this->lisaatoimittaja ?>',
                    tooltip: '<?= $this->lisaatoimittaja_tooltip ?>',
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
       //Ext.getCmp('download').enable();
       Ext.getCmp('delete').enable();
       
    });
    
    grid.addListener('afteredit', saveEdit, this);
    
    var storecategory = new Ext.data.Store({
        url: '/zf/public/toimittaja/json/category',
        reader: new Ext.data.JsonReader({root: 'toimittaja_kategoriat',
            totalProperty: 'totalCount',id: 'kategoria_id'}, 
                [{name: 'kategoria_id',type: 'int'},
                {name: 'kategoria_nimi',type: 'string'}]),
                baseParams: { "limit":50 },
                sortInfo:{field: 'kategoria_id', direction: "DESC"},
                remoteSort: true
            });
            
    storecategory.load({params: { "start":0, "limit":50, "query":"" }});
    
    var storemaksuehto = new Ext.data.Store({
        url: '/zf/public/toimittaja/json/maksuehtogrid',
        reader: new Ext.data.JsonReader({root: 'toimittaja_maksuehto',
            totalProperty: 'totalCount',id: 'maksuehto_id'}, 
                [{name: 'maksuehto_id',type: 'int'},
                {name: 'maksuehto_paivaa',type: 'int'},
                {name: 'maksuehto_tyyppi',type: 'string'}]),
                baseParams: { "limit":50 },
                sortInfo:{field: 'maksuehto_id', direction: "DESC"}
            });
            
    storemaksuehto.load({params: { "start":0, "limit":50, "query":"" }});
    
 // create the Grid
    var gridcategory = new Ext.grid.EditorGridPanel({
        store: storecategory,
        cm: new Ext.ux.grid.LockingColumnModel({
            defaults: {
                width: 40,
                sortable: true
            },
            columns: [
                {
                id       :'kategoria_id',
                header   : 'ID', 
                width    : 40, 
                sortable : true,
                locked:false,
                dataIndex: 'kategoria_id'
            },
            {
                header   : '<?= $this->nimi ?>', 
                width    : 140, 
                sortable : true,
                locked:false, 
                dataIndex: 'kategoria_nimi',
                editor: new fm.TextField({
					allowBlank: false
				})
            }
            ]
        }),
        //colModel: colModel,
         bbar: new Ext.PagingToolbar({
            store: storecategory,           
            pageSize: 50,
            id:'paging-toolbar-kategoria',
            prependButtons: true,
            displayInfo: '{0} - {1} of {2}',
            displayMsg: '{0} - {1} of {2}',
            emptyMsg: 'No tasks to display'}
        ),
        plugins:[ new Ext.ux.grid.Search({
                iconCls:'icon-zoom'
                ,readonlyIndexes:['kategoria_id']
                ,disableIndexes:['toimittaja_id']
                ,minChars:3
                ,autoFocus:true
//              ,menuStyle:'radio'
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
        //autoExpandColumn: 'kategoria_id',
        width: Ext.lib.Dom.getViewWidth(),
        height: Ext.lib.Dom.getViewHeight(),
        title: '<?= $this->categories ?>',
        // config options for stateful behavior
        stateful: true,
        stateId: 'gridcategory',
        view: new Ext.ux.grid.LockingGridView({
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
                	gridcategory.selModel.clearSelections();
                    //Ext.getCmp('download').disable();
                    //Ext.getCmp('delete').disable();
                	Ext.getCmp('delete_category').disable();
                }},
                {
                text: '<?= $this->refresh ?>',
                tooltip: '<?= $this->refresh_tooltip ?>',
                iconCls: 'refresh-icon',
                handler: function () {
                	storecategory.reload();
                    //storeKategoria.loadData;
                    //storeKategoria.reload();
                }},{
                    text: '<?= $this->categorynew ?>',
                    tooltip: '<?= $this->categorynew_tooltip ?>',
                    iconCls: 'refresh-icon',
                    handler: createKT
                    },{
                        id: 'delete_category',
                    	text: '<?= $this->delete_category ?>',
                        tooltip: '<?= $this->delete_category_tooltip ?>',
                        iconCls: 'refresh-icon',
                        disabled:true,
                        handler: handleDeleteCategory
                    }]
    });
    
    gridcategory.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
       //Ext.getCmp('download').enable();
       Ext.getCmp('delete_category').enable();
       
    });
    
    gridcategory.addListener('afteredit', saveCategoryEdit, this);
    
    var gridmaksuehto = new Ext.grid.EditorGridPanel({
        store: storemaksuehto,
        cm: new Ext.ux.grid.LockingColumnModel({
            defaults: {
                width: 40,
                sortable: true
            },
            columns: [
                {
                id       :'maksuehto_id',
                header   : 'ID', 
                width    : 40, 
                sortable : true,
                locked:false,
                dataIndex: 'maksuehto_id'
            },
            {
                header   : '<?= $this->maksuehtopaivaa ?>', 
                width    : 140, 
                sortable : true,
                locked:false, 
                dataIndex: 'maksuehto_paivaa',
                editor: new fm.TextField({
					allowBlank: false
				})
            },
            {
                header   : '<?= $this->maksuehtotyyppi ?>', 
                width    : 140, 
                sortable : true,
                locked:false, 
                dataIndex: 'maksuehto_tyyppi',
                editor: new fm.TextField({
					allowBlank: false
				})
            }
            ]
        }),
        //colModel: colModel,
         bbar: new Ext.PagingToolbar({
            store: storecategory,           
            pageSize: 50,
            id:'paging-toolbar-maksuehto',
            prependButtons: true,
            displayInfo: '{0} - {1} of {2}',
            displayMsg: '{0} - {1} of {2}',
            emptyMsg: 'No tasks to display'}
        ),
        plugins:[ new Ext.ux.grid.Search({
                iconCls:'icon-zoom'
                ,readonlyIndexes:['maksuehto_id']
                ,disableIndexes:['maksuehto_id']
                ,minChars:3
                ,autoFocus:true
//              ,menuStyle:'radio'
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
        //autoExpandColumn: 'kategoria_id',
        width: Ext.lib.Dom.getViewWidth(),
        height: Ext.lib.Dom.getViewHeight(),
        title: '<?= $this->maksuehto ?>',
        // config options for stateful behavior
        stateful: true,
        stateId: 'gridcategory',
        view: new Ext.ux.grid.LockingGridView({
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
                	gridcategory.selModel.clearSelections();
                    //Ext.getCmp('download').disable();
                    //Ext.getCmp('delete').disable();
                	Ext.getCmp('delete_category').disable();
                }},
                {
                text: '<?= $this->refresh ?>',
                tooltip: '<?= $this->refresh_tooltip ?>',
                iconCls: 'refresh-icon',
                handler: function () {
                	storemaksuehto.reload();
                    //storeKategoria.loadData;
                    //storeKategoria.reload();
                }},{
                    text: '<?= $this->maksuehtonew ?>',
                    tooltip: '<?= $this->maksuehtonew_tooltip ?>',
                    iconCls: 'refresh-icon',
                    handler: createME
                    },{
                        id: 'delete_maksuehto',
                    	text: '<?= $this->delete_maksuehto ?>',
                        tooltip: '<?= $this->delete_maksuehto_tooltip ?>',
                        iconCls: 'refresh-icon',
                        disabled:true,
                        handler: handleDeleteMaksuehto
                    }]
    });
    
    gridmaksuehto.addListener('afteredit', saveMaksuehtoEdit, this);
    
    gridmaksuehto.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
        //Ext.getCmp('download').enable();
        Ext.getCmp('delete_maksuehto').enable();
        
     });
    
    var tabs = new Ext.TabPanel({
        renderTo: 'ApplicationForm',
        width: Ext.lib.Dom.getViewWidth(),
        height: Ext.lib.Dom.getViewHeight(),
        activeTab: 0,
        frame:true,
        defaults:{autoHeight: false},
        items:[
            grid
            <?php
            if ($this->viewcategory) {
            ?>
            , gridcategory
            <?php } ?>
            , gridmaksuehto
        ]
    });
    
    storeMaksuehto.on('load', function() {
    	
    	var storeLoaded = readCookie('storeLoaded');
    	
    	if (storeLoaded==="false") {
    	store.load({params: { "start":0, "limit":50, "query":"" }});
    	createCookie("storeLoaded", "true", 31);
    	}
    	
	});

// render the grid to the specified div in the page
    //grid.render('ApplicationForm'); 
            
 });