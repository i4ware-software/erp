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
            
            // turn on validation errors beside the field globally
            Ext.form.Field.prototype.msgTarget = 'side';	
            
            var myRecord = new Ext.data.Record.create([
            {
                name: 'aid'
            },
            {
                name: 'text'
            }
            ]);

            var myReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'agreements',
                id: 'aid'
            },
            myRecord);
            
            var fs = new Ext.FormPanel({
                frame: false,
                title:'<?= $this->title_config ?>',
                labelAlign: 'right',
                labelWidth: 180,
                //width: 800,
                //height: 240,
                waitMsgTarget: true,
                reader: myReader,
                items: [
                    new Ext.form.FieldSet({
                        title: '<?= $this->agreement_information ?>',
                        autoHeight: true,
                        defaultType: 'textfield',
                        items: [{
                                fieldLabel: '<?= $this->text ?>',
                                name: 'text',
                                width:190,
                                allowBlank : false,
                                xtype: 'htmleditor',
                                width: 1000,
                                height: 500
                            }
                        ]
                    })
                ]
            });

            // explicit add
            var submit = fs.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	var url = "/zf/public/erpagreements/json/saveconfig";
        
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
                                             url: '/zf/public/erpagreements/json/index',
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
            
            fs.render('AgreementsFrom');
            
            fs.getForm().load({
                url: '/zf/public/erpagreements/json/index',
                waitMsg: '<?= $this->loading ?>',
                failure: function (form, action) {
                    var json = Ext.util.JSON.decode(action.response.responseText);
                    Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                }
            });
            
            var myCustomerRecord = new Ext.data.Record.create([
                {
                    name: 'aid'
                },
                {
                    name: 'text'
                }
                ]);

                var myCustomerReader = new Ext.data.JsonReader({
                    successProperty: 'success',
                    totalProperty: 'results',
                    root: 'agreements',
                    id: 'aid'
                },
                myCustomerRecord);
                
                var fsCustomer = new Ext.FormPanel({
                    frame: false,
                    title:'<?= $this->title_config_customer ?>',
                    labelAlign: 'right',
                    labelWidth: 180,
                    //width: 800,
                    //height: 240,
                    waitMsgTarget: true,
                    reader: myCustomerReader,
                    items: [
                        new Ext.form.FieldSet({
                            title: '<?= $this->agreement_information ?>',
                            autoHeight: true,
                            defaultType: 'textfield',
                            items: [{
                                    fieldLabel: '<?= $this->text ?>',
                                    name: 'text',
                                    width:190,
                                    allowBlank : false,
                                    xtype: 'htmleditor',
                                    width: 1000,
                                    height: 500
                                }
                            ]
                        })
                    ]
                });

                // explicit add
                var submit = fsCustomer.addButton({
                    text: '<?= $this->submit ?>',
                    handler: function(){
                    	var url = "/zf/public/erpagreements/json/saveconfigcustomer";
            
                         if(fsCustomer.getForm().isValid()){
                        	 fsCustomer.getForm().submit(
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
                                             fsCustomer.getForm().load({
                                                 url: '/zf/public/erpagreements/json/indexcustomer',
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
                
                fsCustomer.render('AgreementsFrom');
                
                fsCustomer.getForm().load({
                    url: '/zf/public/erpagreements/json/indexcustomer',
                    waitMsg: '<?= $this->loading ?>',
                    failure: function (form, action) {
                        var json = Ext.util.JSON.decode(action.response.responseText);
                        Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                    }
                });
            
 });