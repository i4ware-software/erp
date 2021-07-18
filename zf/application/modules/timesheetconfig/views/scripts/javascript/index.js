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
            
         // turn on validation errors beside the field globally
            Ext.form.Field.prototype.msgTarget = 'side';	
            
            var myRecord = new Ext.data.Record.create([
            {
                name: 'financialId'
            },
            {
                name: 'salary'
            }
            ]);

            var myReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'timesheet',
                id: 'financialId'
            },
            myRecord);
            
            var fs = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_information ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->financial_id ?>',
                                name: 'financialId',
                                width:190,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->salary ?>',
                                name: 'salary',
                                width:190,
                                allowBlank : false
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submit = fs.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/saveconfig";
        
                     if(fs.getForm().isValid()){
                    	 fs.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fs.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/index',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fs.render('ConfigGrid');
            
            fs.getForm().load({
                url: '/zf/public/timesheetconfig/json/index',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
			
			var myHRMCompilationRecord = new Ext.data.Record.create([
            {
                name: 'email_id'
            },
            {
                name: 'subject'
            },
            {
                name: 'bodyhtml'
            },
            {
                name: 'bodytext'
            }
            ]);

            var myHRMCompilationReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'email',
                id: 'email_id'
            },
            myHRMCompilationRecord);
            
            var fsHRMCompilation = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myHRMCompilationReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_compilation ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->subject ?>',
                                name: 'subject',
                                width:400,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->bodyhtml ?>',
                                name: 'bodyhtml',
                                width:600,
                                allowBlank : false,
								xtype: 'htmleditor'
                            }, {
                                fieldLabel: '<?= $this->bodytext ?>',
                                name: 'bodytext',
                                width:600,
                                allowBlank : false,
								xtype:'textarea'
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submitHRMCompilation = fsHRMCompilation.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/saveconmpilation";
        
                     if(fsHRMCompilation.getForm().isValid()){
                    	 fsHRMCompilation.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fsHRMCompilation.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/compilation',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fsHRMCompilation.render('CompilationGrid');
            
            fsHRMCompilation.getForm().load({
                url: '/zf/public/timesheetconfig/json/compilation',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
			
			var myHRMTimesheetRecord = new Ext.data.Record.create([
            {
                name: 'email_id'
            },
            {
                name: 'subject'
            },
            {
                name: 'bodyhtml'
            },
            {
                name: 'bodytext'
            }
            ]);

            var myHRMTimesheetReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'email',
                id: 'email_id'
            },
            myHRMTimesheetRecord);
            
            var fsHRMTimesheet = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myHRMTimesheetReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_timesheet ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->subject ?>',
                                name: 'subject',
                                width:400,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->bodyhtml ?>',
                                name: 'bodyhtml',
                                width:600,
                                allowBlank : false,
								xtype: 'htmleditor'
                            }, {
                                fieldLabel: '<?= $this->bodytext ?>',
                                name: 'bodytext',
                                width:600,
                                allowBlank : false,
								xtype:'textarea'
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submitHRMTimesheet = fsHRMTimesheet.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/savetimesheet";
        
                     if(fsHRMTimesheet.getForm().isValid()){
                    	 fsHRMTimesheet.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fsHRMTimesheet.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/timesheet',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fsHRMTimesheet.render('TimesheetGrid');
            
            fsHRMTimesheet.getForm().load({
                url: '/zf/public/timesheetconfig/json/timesheet',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
            
            var myHRMCustomerAgreesRecord = new Ext.data.Record.create([
                {
                    name: 'email_id'
                },
                {
                    name: 'subject'
                },
                {
                    name: 'bodyhtml'
                },
                {
                    name: 'bodytext'
                }
                ]);

                var myHRMCustomerAgreesReader = new Ext.data.JsonReader({
                    successProperty: 'success',
                    totalProperty: 'results',
                    root: 'email',
                    id: 'email_id'
                },
                myHRMCustomerAgreesRecord);
                
                var fsHRMCustomerAgrees = new Ext.FormPanel({
                    frame: false,
                    //title:'<?= $this->timesheet_config ?>',
                    labelAlign: 'right',
                    labelWidth: 180,
                    //width: 800,
                    //height: 240,
                    waitMsgTarget: true,
                    reader: myHRMCustomerAgreesReader,
                    items: [
                        new Ext.form.FieldSet({
                            title: '<?= $this->config_customer_agrees ?>',
                            autoHeight: true,
                            defaultType: 'textfield',
                            items: [{
                                    fieldLabel: '<?= $this->subject ?>',
                                    name: 'subject',
                                    width:400,
                                    allowBlank : false
                                }, {
                                    fieldLabel: '<?= $this->bodyhtml ?>',
                                    name: 'bodyhtml',
                                    width:600,
                                    allowBlank : false,
    								xtype: 'htmleditor'
                                }, {
                                    fieldLabel: '<?= $this->bodytext ?>',
                                    name: 'bodytext',
                                    width:600,
                                    allowBlank : false,
    								xtype:'textarea'
                                }
                            ]
                        })
                    ]
                });

                // explicit add
                var submitHRMCustomerAgrees = fsHRMCustomerAgrees.addButton({
                    text: '<?= $this->submit ?>',
                    handler: function(){
                    	var url = "/zf/public/timesheetconfig/json/savecustomeragrees";
            
                         if(fsHRMCustomerAgrees.getForm().isValid()){
                        	 fsHRMCustomerAgrees.getForm().submit(
                                     {
                                         waitMsg : '<?= $this->sending ?>',
                                         url : url,
                                         success : function(
                                                 form, action) {
    									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                             Ext.MessageBox
                                             .alert(
                                                     '<?= $this->success ?>',
                                                     json.msg);
                                             fsHRMCustomerAgrees.getForm().load({
                                                 url: '/zf/public/timesheetconfig/json/customeragrees',
                                                 waitMsg: '<?= $this->loading ?>',
                                                 failure: function (form, action) {
                                                     var json = Ext.util.JSON.decode(action.response.responseText);
                                                     Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                                 }
                                             });
                                         },
                                         failure : function(
                                                 form, action) {
    										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                             Ext.MessageBox
                                                     .alert(
                                                             '<?= $this->error ?>',
                                                             json.msg);
                                         }
                                     });
                         }
                    }
                });
                
                fsHRMCustomerAgrees.render('CustomerAgreesGrid');
                
                fsHRMCustomerAgrees.getForm().load({
                    url: '/zf/public/timesheetconfig/json/customeragrees',
                    waitMsg: '<?= $this->loading ?>',
                    failure: function (form, action) {
                        var json = Ext.util.JSON.decode(action.response.responseText);
                        Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                    }
                });
                
                var myHRMCustomerDisagreesRecord = new Ext.data.Record.create([
                    {
                        name: 'email_id'
                    },
                    {
                        name: 'subject'
                    },
                    {
                        name: 'bodyhtml'
                    },
                    {
                        name: 'bodytext'
                    }
                    ]);

                    var myHRMCustomerDisagreesReader = new Ext.data.JsonReader({
                        successProperty: 'success',
                        totalProperty: 'results',
                        root: 'email',
                        id: 'email_id'
                    },
                    myHRMCustomerDisagreesRecord);
                    
                    var fsHRMCustomerDisagrees = new Ext.FormPanel({
                        frame: false,
                        //title:'<?= $this->timesheet_config ?>',
                        labelAlign: 'right',
                        labelWidth: 180,
                        //width: 800,
                        //height: 240,
                        waitMsgTarget: true,
                        reader: myHRMCustomerDisagreesReader,
                        items: [
                            new Ext.form.FieldSet({
                                title: '<?= $this->config_customer_disagrees ?>',
                                autoHeight: true,
                                defaultType: 'textfield',
                                items: [{
                                        fieldLabel: '<?= $this->subject ?>',
                                        name: 'subject',
                                        width:400,
                                        allowBlank : false
                                    }, {
                                        fieldLabel: '<?= $this->bodyhtml ?>',
                                        name: 'bodyhtml',
                                        width:600,
                                        allowBlank : false,
        								xtype: 'htmleditor'
                                    }, {
                                        fieldLabel: '<?= $this->bodytext ?>',
                                        name: 'bodytext',
                                        width:600,
                                        allowBlank : false,
        								xtype:'textarea'
                                    }
                                ]
                            })
                        ]
                    });

                    // explicit add
                    var submitHRMCustomerDisagrees = fsHRMCustomerDisagrees.addButton({
                        text: '<?= $this->submit ?>',
                        handler: function(){
                        	var url = "/zf/public/timesheetconfig/json/savecustomerdisagrees";
                
                             if(fsHRMCustomerDisagrees.getForm().isValid()){
                            	 fsHRMCustomerDisagrees.getForm().submit(
                                         {
                                             waitMsg : '<?= $this->sending ?>',
                                             url : url,
                                             success : function(
                                                     form, action) {
        									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                                 Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->success ?>',
                                                         json.msg);
                                                 fsHRMCustomerDisagrees.getForm().load({
                                                     url: '/zf/public/timesheetconfig/json/customerdisagrees',
                                                     waitMsg: '<?= $this->loading ?>',
                                                     failure: function (form, action) {
                                                         var json = Ext.util.JSON.decode(action.response.responseText);
                                                         Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                                     }
                                                 });
                                             },
                                             failure : function(
                                                     form, action) {
        										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                                 Ext.MessageBox
                                                         .alert(
                                                                 '<?= $this->error ?>',
                                                                 json.msg);
                                             }
                                         });
                             }
                        }
                    });
                    
                    fsHRMCustomerDisagrees.render('CustomerDisagreesGrid');
                    
                    fsHRMCustomerDisagrees.getForm().load({
                        url: '/zf/public/timesheetconfig/json/customerdisagrees',
                        waitMsg: '<?= $this->loading ?>',
                        failure: function (form, action) {
                            var json = Ext.util.JSON.decode(action.response.responseText);
                            Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                        }
                    });
                    
                    var myHRMAdminAgreesRecord = new Ext.data.Record.create([
                        {
                            name: 'email_id'
                        },
                        {
                            name: 'subject'
                        },
                        {
                            name: 'bodyhtml'
                        },
                        {
                            name: 'bodytext'
                        }
                        ]);

                        var myHRMAdminAgreesReader = new Ext.data.JsonReader({
                            successProperty: 'success',
                            totalProperty: 'results',
                            root: 'email',
                            id: 'email_id'
                        },
                        myHRMAdminAgreesRecord);
                        
                        var fsHRMAdminAgrees = new Ext.FormPanel({
                            frame: false,
                            //title:'<?= $this->timesheet_config ?>',
                            labelAlign: 'right',
                            labelWidth: 180,
                            //width: 800,
                            //height: 240,
                            waitMsgTarget: true,
                            reader: myHRMAdminAgreesReader,
                            items: [
                                new Ext.form.FieldSet({
                                    title: '<?= $this->config_admin_agrees ?>',
                                    autoHeight: true,
                                    defaultType: 'textfield',
                                    items: [{
                                            fieldLabel: '<?= $this->subject ?>',
                                            name: 'subject',
                                            width:400,
                                            allowBlank : false
                                        }, {
                                            fieldLabel: '<?= $this->bodyhtml ?>',
                                            name: 'bodyhtml',
                                            width:600,
                                            allowBlank : false,
            								xtype: 'htmleditor'
                                        }, {
                                            fieldLabel: '<?= $this->bodytext ?>',
                                            name: 'bodytext',
                                            width:600,
                                            allowBlank : false,
            								xtype:'textarea'
                                        }
                                    ]
                                })
                            ]
                        });

                        // explicit add
                        var submitHRMAdminAgrees = fsHRMAdminAgrees.addButton({
                            text: '<?= $this->submit ?>',
                            handler: function(){
                            	var url = "/zf/public/timesheetconfig/json/saveadminagrees";
                    
                                 if(fsHRMAdminAgrees.getForm().isValid()){
                                	 fsHRMAdminAgrees.getForm().submit(
                                             {
                                                 waitMsg : '<?= $this->sending ?>',
                                                 url : url,
                                                 success : function(
                                                         form, action) {
            									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                                     Ext.MessageBox
                                                     .alert(
                                                             '<?= $this->success ?>',
                                                             json.msg);
                                                     fsHRMAdminAgrees.getForm().load({
                                                         url: '/zf/public/timesheetconfig/json/adminagrees',
                                                         waitMsg: '<?= $this->loading ?>',
                                                         failure: function (form, action) {
                                                             var json = Ext.util.JSON.decode(action.response.responseText);
                                                             Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                                         }
                                                     });
                                                 },
                                                 failure : function(
                                                         form, action) {
            										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                                     Ext.MessageBox
                                                             .alert(
                                                                     '<?= $this->error ?>',
                                                                     json.msg);
                                                 }
                                             });
                                 }
                            }
                        });
                        
                        fsHRMAdminAgrees.render('AdminAgreesGrid');
                        
                        fsHRMAdminAgrees.getForm().load({
                            url: '/zf/public/timesheetconfig/json/adminagrees',
                            waitMsg: '<?= $this->loading ?>',
                            failure: function (form, action) {
                                var json = Ext.util.JSON.decode(action.response.responseText);
                                Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                            }
                        });
                        
                        var myHRMAdminDisagreesRecord = new Ext.data.Record.create([
                            {
                                name: 'email_id'
                            },
                            {
                                name: 'subject'
                            },
                            {
                                name: 'bodyhtml'
                            },
                            {
                                name: 'bodytext'
                            }
                            ]);

                            var myHRMAdminDisagreesReader = new Ext.data.JsonReader({
                                successProperty: 'success',
                                totalProperty: 'results',
                                root: 'email',
                                id: 'email_id'
                            },
                            myHRMAdminDisagreesRecord);
                            
                            var fsHRMAdminDisagrees = new Ext.FormPanel({
                                frame: false,
                                //title:'<?= $this->timesheet_config ?>',
                                labelAlign: 'right',
                                labelWidth: 180,
                                //width: 800,
                                //height: 240,
                                waitMsgTarget: true,
                                reader: myHRMAdminDisagreesReader,
                                items: [
                                    new Ext.form.FieldSet({
                                        title: '<?= $this->config_admin_disagrees ?>',
                                        autoHeight: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: '<?= $this->subject ?>',
                                                name: 'subject',
                                                width:400,
                                                allowBlank : false
                                            }, {
                                                fieldLabel: '<?= $this->bodyhtml ?>',
                                                name: 'bodyhtml',
                                                width:600,
                                                allowBlank : false,
                								xtype: 'htmleditor'
                                            }, {
                                                fieldLabel: '<?= $this->bodytext ?>',
                                                name: 'bodytext',
                                                width:600,
                                                allowBlank : false,
                								xtype:'textarea'
                                            }
                                        ]
                                    })
                                ]
                            });

                            // explicit add
                            var submitHRMAdminDisagrees = fsHRMAdminDisagrees.addButton({
                                text: '<?= $this->submit ?>',
                                handler: function(){
                                	var url = "/zf/public/timesheetconfig/json/saveadmindisagrees";
                        
                                     if(fsHRMAdminDisagrees.getForm().isValid()){
                                    	 fsHRMAdminDisagrees.getForm().submit(
                                                 {
                                                     waitMsg : '<?= $this->sending ?>',
                                                     url : url,
                                                     success : function(
                                                             form, action) {
                									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                                         Ext.MessageBox
                                                         .alert(
                                                                 '<?= $this->success ?>',
                                                                 json.msg);
                                                         fsHRMAdminDisagrees.getForm().load({
                                                             url: '/zf/public/timesheetconfig/json/admindisagrees',
                                                             waitMsg: '<?= $this->loading ?>',
                                                             failure: function (form, action) {
                                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                                             }
                                                         });
                                                     },
                                                     failure : function(
                                                             form, action) {
                										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                                         Ext.MessageBox
                                                                 .alert(
                                                                         '<?= $this->error ?>',
                                                                         json.msg);
                                                     }
                                                 });
                                     }
                                }
                            });
                            
                            fsHRMAdminDisagrees.render('AdminDisagreesGrid');
                            
                            fsHRMAdminDisagrees.getForm().load({
                                url: '/zf/public/timesheetconfig/json/admindisagrees',
                                waitMsg: '<?= $this->loading ?>',
                                failure: function (form, action) {
                                    var json = Ext.util.JSON.decode(action.response.responseText);
                                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                }
                            });
			
			var myOstotCronRecord = new Ext.data.Record.create([
            {
                name: 'email_id'
            },
            {
                name: 'subject'
            },
            {
                name: 'bodyhtml'
            },
            {
                name: 'bodytext'
            }
            ]);

            var myOstotCronReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'email',
                id: 'email_id'
            },
            myOstotCronRecord);
            
            var fsOstotCron = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myOstotCronReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_cron ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->subject ?>',
                                name: 'subject',
                                width:400,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->bodyhtml ?>',
                                name: 'bodyhtml',
                                width:600,
                                allowBlank : false,
								xtype: 'htmleditor'
                            }, {
                                fieldLabel: '<?= $this->bodytext ?>',
                                name: 'bodytext',
                                width:600,
                                allowBlank : false,
								xtype:'textarea'
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submitOsototCron = fsOstotCron.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/savecron";
        
                     if(fsOstotCron.getForm().isValid()){
                    	 fsOstotCron.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fsOsototCron.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/cron',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fsOstotCron.render('CronGrid');
            
            fsOstotCron.getForm().load({
                url: '/zf/public/timesheetconfig/json/cron',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
			
			var myOstotDueDatesRecord = new Ext.data.Record.create([
            {
                name: 'email_id'
            },
            {
                name: 'subject'
            },
            {
                name: 'bodyhtml'
            },
            {
                name: 'bodytext'
            }
            ]);

            var myOstotDueDatesReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'email',
                id: 'email_id'
            },
            myOstotDueDatesRecord);
            
            var fsOstotDueDates = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myOstotCronReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_due_dates ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->subject ?>',
                                name: 'subject',
                                width:400,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->bodyhtml ?>',
                                name: 'bodyhtml',
                                width:600,
                                allowBlank : false,
								xtype: 'htmleditor'
                            }, {
                                fieldLabel: '<?= $this->bodytext ?>',
                                name: 'bodytext',
                                width:600,
                                allowBlank : false,
								xtype:'textarea'
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submitOsototDueDates = fsOstotDueDates.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/saveduedates";
        
                     if(fsOstotDueDates.getForm().isValid()){
                    	 fsOstotDueDates.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fsOsototCron.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/duedates',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fsOstotDueDates.render('DueDatesGrid');
            
            fsOstotDueDates.getForm().load({
                url: '/zf/public/timesheetconfig/json/duedates',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
			
			
            var myHRMEmployeeRecord = new Ext.data.Record.create([
            {
                name: 'email_id'
            },
            {
                name: 'subject'
            },
            {
                name: 'bodyhtml'
            },
            {
                name: 'bodytext'
            }
            ]);

            var myHRMEmployeeReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'email',
                id: 'email_id'
            },
            myHRMEmployeeRecord);
            
            var fsHRMEmployee = new Ext.FormPanel({
                frame: false,
                //title:'<?= $this->timesheet_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myHRMEmployeeReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->config_employee?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->subject ?>',
                                name: 'subject',
                                width:400,
                                allowBlank : false
                            }, {
                                fieldLabel: '<?= $this->bodyhtml ?>',
                                name: 'bodyhtml',
                                width:600,
                                allowBlank : false,
								xtype: 'htmleditor'
                            }, {
                                fieldLabel: '<?= $this->bodytext ?>',
                                name: 'bodytext',
                                width:600,
                                allowBlank : false,
								xtype:'textarea'
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submitHRMEmployee = fsHRMEmployee.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/timesheetconfig/json/saveemployee";
        
                     if(fsHRMEmployee.getForm().isValid()){
                    	 fsHRMEmployee.getForm().submit(
                                 {
                                     waitMsg : '<?= $this->sending ?>',
                                     url : url,
                                     success : function(
                                             form, action) {
									     var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                         .alert(
                                                 '<?= $this->success ?>',
                                                 json.msg);
                                         fsOsototCron.getForm().load({
                                             url: '/zf/public/timesheetconfig/json/employee',
                                             waitMsg: '<?= $this->loading ?>',
                                             failure: function (form, action) {
                                                 var json = Ext.util.JSON.decode(action.response.responseText);
                                                 Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                                             }
                                         });
                                     },
                                     failure : function(
                                             form, action) {
										 var json = Ext.util.JSON.decode(action.response.responseText); 
                                         Ext.MessageBox
                                                 .alert(
                                                         '<?= $this->error ?>',
                                                         json.msg);
                                     }
                                 });
                     }
                }
            });
            
            fsHRMEmployee.render('EmployeeGrid');
            
            fsHRMEmployee.getForm().load({
                url: '/zf/public/timesheetconfig/json/employee',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
 });