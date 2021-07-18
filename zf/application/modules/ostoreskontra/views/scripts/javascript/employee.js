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
 
var viitenumeroTest = /^[0-9]{4,20}$/i;
Ext.apply(Ext.form.VTypes, {
    //  vtype validation function
    viitenumero: function(val, field) {
        return viitenumeroTest.test(val);
    },
    // vtype Text property: The error text to display when the validation function returns false
    viitenumeroText: 'Viitenumero ei ole oikeassa muodossa',
    // vtype Mask property: The keystroke filter mask
    viitenumeroMask: /[\d\s:amp]/i
});

Ext.util.Format.CurrencyFactory = function(dp, dSeparator, tSeparator, symbol) {
    return function(n) {
        dp = Math.abs(dp) + 1 ? dp : 2;
        dSeparator = dSeparator || ".";
        tSeparator = tSeparator || ",";

        var m = /(\d+)(?:(\.\d+)|)/.exec(n + ""),
            x = m[1].length > 3 ? m[1].length % 3 : 0;

        return (n < 0? '-' : '') // preserve minus sign
                + (x ? m[1].substr(0, x) + tSeparator : "")
                + m[1].substr(x).replace(/(\d{3})(?=\d)/g, "$1" + tSeparator)
                + (dp? dSeparator + (+m[2] || 0).toFixed(dp).substr(2) : "")
                + " " + symbol;
    };
};

var euroFormatter = Ext.util.Format.CurrencyFactory(2, ",", ".", "<?= $this->euro ?>");
 
 Ext.onReady(function() {
    
            //Ext.QuickTips.init();
            var fm = Ext.form;
            var acceptwin;
            var failwin;
            var laterwin;
            
            createCookie("storeLoaded", "false", 31);
            createCookie("ostoreskontra_id_invoice", 0, 31);
            
         // create the data store
            var storeHyvaksyjat = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/hyvaksyjatemployee?ostoreskontra_id=0',
                    reader: new Ext.data.JsonReader({root: 'hyvaksyjat',
                        totalProperty: 'totalCount',id: 'relation_id'}, 
                            [{name: 'relation_id',type: 'int'},
                             {name: 'order_id',type: 'int'},
                             {name: 'user',type: 'string'},
                             {name: 'kasitelty',type: 'string'}]),
                            sortInfo:{field: 'order_id', direction: "ASC"}
                        });
                        
            //storeHyvaksyjat.load();
            
            // create the data store
            var storeAsiatarkastajat = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/asiatarkastajatemployee?ostoreskontra_id=0',
                    reader: new Ext.data.JsonReader({root: 'asiatarkastajat',
                        totalProperty: 'totalCount',id: 'relation_id'}, 
                            [{name: 'relation_id',type: 'int'},
                             {name: 'order_id',type: 'int'},
                             {name: 'user',type: 'string'},
                             {name: 'kasitelty',type: 'string'}]),
                            sortInfo:{field: 'order_id', direction: "ASC"}
                        });
                        
            //storeAsiatarkastajat.load();
            
            var conn = new Ext.data.Connection();
            
            conn 
    		.request( { 
    		url : '/zf/public/ostoreskontra/json/seuraavainvoice', 
    		method : 'POST', 
    		success : function(responseObject) { 
    		 
    		var json = Ext.util.JSON.decode(responseObject.responseText); 
    		 
    		if (json.success == true) {
    			
    			createCookie("ostoreskontra_id_invoice", json.ostoreskontra_id, 31);
    			
    			if (json.ostoreskontra_id==0) {
    				
    				Ext.getCmp('hyvaksy').disable();
    				Ext.getCmp('hyvaksymyohemmin').disable();
    				Ext.getCmp('hylkaa').disable();
    				
    			} else {
    				
    				Ext.getCmp('hyvaksy').enable();
    				Ext.getCmp('hyvaksymyohemmin').enable();
    				Ext.getCmp('hylkaa').enable();
    			
    			}
            
    			var ostoreskontra_id = readCookie('ostoreskontra_id_invoice');
    			
    			storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajatemployee?ostoreskontra_id="+ostoreskontra_id;
                storeAsiatarkastajat.load();
                storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjatemployee?ostoreskontra_id="+ostoreskontra_id;
                storeHyvaksyjat.load();
    			
    			<?php if ($this->redirect) { ?>
    			
    			<?php } else { ?>
    			Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoiceemployee?os_location='+ostoreskontra_id);
                <?php } ?>
    			
    			Ext.Ajax.request({
                    method: 'POST',
                    url: '/zf/public/ostoreskontra/json/statusbar',
                    params: { ostoreskontra_id : ostoreskontra_id },
                    success: function( result, request ){
                        Ext.get('StatusBar').dom.innerHTML = result.responseText;
                    }
                });

    		} else {
    			//document.location = '/zf/public/index/logout';
    		} 
    		 
    		}, 
    		failure : function(responseObject) {
    		 
    		} 
    		});
            
            var storeSeuraavakasittelija = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/seuraavaemployee',
					scope: this
				})
				, baseParams: {
					task: "seuraavaa"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'seuraava_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});
            
            var storeMaksuehto = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/maksuehto',
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
            
            var acceptform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/acceptinvoice",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                //fileUpload: true,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [/*{
                    fieldLabel : '<?= $this->seuraava_kasittelija ?>',
                    name : 'seuraava_kasittelija_id',
            		hiddenName: 'seuraava_kasittelija_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeSeuraavakasittelija,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		},*/{
                        //id:'ostoreskontra_id',
                    	fieldLabel : 'ID',
                        name : 'seuraava_kasittelija_id',
                        allowBlank : false,
                        xtype:'textfield',
                        value:'10',
                        hidden:true
                    },{
                        id:'ostoreskontra_id',
                    	fieldLabel : 'ID',
                        name : 'ostoreskontra_id',
                        allowBlank : false,
                        xtype:'textfield',
                        hidden:true
                    }
                ]
            });

            function acceptINV() {
            	
            	var ostoreskontra_id = readCookie('ostoreskontra_id_invoice');
            	
            	Ext.getCmp('ostoreskontra_id').setValue(ostoreskontra_id);

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!acceptwin) {
                	acceptwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'accept-inv',
                                //layout : 'fit',
                                width : 480,
                                height : 80,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->are_you_sure ?>',
                                items : [acceptform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/acceptinvoice";
                                                if(acceptform.getForm().isValid()){
                                                acceptwin.hide();
                                                acceptform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        acceptform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //store.reload();
                                                                        document.location = '/zf/public/ostoreskontra/index/index';
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															acceptform
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
                                                acceptform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                acceptwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                acceptwin.show(this);
            }
            
            var laterform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/laterinvoice",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                //fileUpload: true,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [/*{
                    fieldLabel : '<?= $this->seuraava_kasittelija ?>',
                    name : 'seuraava_kasittelija_id',
            		hiddenName: 'seuraava_kasittelija_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeSeuraavakasittelija,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		},*//*{
                        //id:'ostoreskontra_id',
                    	fieldLabel : 'ID',
                        name : 'seuraava_kasittelija_id',
                        allowBlank : false,
                        xtype:'textfield',
                        value:'10',
                        hidden:true
                    },*/{
                        id:'later_id',
                    	fieldLabel : 'ID',
                        name : 'ostoreskontra_id',
                        allowBlank : false,
                        xtype:'textfield',
                        hidden:true
                    }/*,{
                        id:'later_date_id',
                    	fieldLabel : '<?= $this->later_date ?>',
                        name : 'later_date',
                        allowBlank : false,
                        xtype:'datefield',
                        hidden:false
                    }*/
                ]
            });

            function laterINV() {
            	
            	var ostoreskontra_id = readCookie('ostoreskontra_id_invoice');
            	
            	Ext.getCmp('later_id').setValue(ostoreskontra_id);

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!laterwin) {
                	laterwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'later-inv',
                                //layout : 'fit',
                                width : 480,
                                height : 80,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->laterinvoice ?>',
                                items : [laterform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/laterinvoice";
                                                if(laterform.getForm().isValid()){
                                                laterwin.hide();
                                                laterform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        laterform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //store.reload();
                                                                        document.location = '/zf/public/ostoreskontra/index/index';
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															laterform
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
                                                laterform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                laterwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                laterwin.show(this);
            }
            
            var Radio1 = new Ext.form.Radio({
            	 id:'radio1',
            	 //xtype: 'radio',
                 checked: true,
                 fieldLabel: '',
                 labelSeparator: '',
                 boxLabel: '<?= $this->i_am_not ?>',
                 name: 'option1',
                 inputValue: 'option1',
                 height:20
            });
            
            var Radio2 = new Ext.form.Radio({
            	id:'radio2',
            	//xtype: 'radio',
                fieldLabel: '',
                labelSeparator: '',
                boxLabel: '<?= $this->something_else ?>',
                name: 'option1',
                inputValue: 'option2',
                height:32
            });
            
            var failform = new Ext.FormPanel({
                id:'failpanel',
                //renderTo: 'ApplicationForm',
                //labelAlign: 'top',
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 5px 5px;',
                //region: 'north',
                border:false,
                frame:false,
                //fileUpload: true,
                //height: 780,
                //width:400,
                buttonAlign: 'left',
                items: [{
                    layout:'column',
                    border:false,
                    items:[{
                        columnWidth:.70,
                        layout: 'form',
                        border:false,
                        labelWidth : 140,
                        //autoHeight: true,
                        items: [{
                            xtype: "radiogroup",
                            fieldLabel: "<?= $this->fail_select ?>",
                            id: "optionsgroup",
                            vertical: true,
                            columns: 1,
                            items: [Radio1, Radio2]
                        },{
                        	id:'option3',
                        	xtype: 'checkbox',
                        	fieldLabel: '',
                            boxLabel: '<?= $this->wrong_terms ?>',
                            name: 'option3',
                            disabled:true,
                            height:20
                        },{
                        	id:'option4',
                        	xtype: 'checkbox',
                        	fieldLabel: '',
                            boxLabel: '<?= $this->invoicing_address ?>',
                            name: 'option4',
                            disabled:true,
                            height:20
                        }, {
                        	id:'option5',
                        	xtype: 'checkbox',
                        	fieldLabel: '',
                            labelSeparator: '',
                            boxLabel: '<?= $this->invoicing_lines ?>',
                            name: 'option5',
                            disabled:true,
                            height:20
                        }, {
                        	id:'option6',
                        	xtype: 'checkbox',
                        	//checked: true,
                            fieldLabel: '',
                            labelSeparator: '',
                            boxLabel: '<?= $this->prices ?>',
                            name: 'option6',
                            disabled:true,
                            height:20
                        },{
                        	id:'option7',
                        	xtype: 'checkbox',
                        	fieldLabel: '',
                        	labelSeparator: '',
                            boxLabel: '<?= $this->vat ?>',
                            name: 'option7',
                            disabled:true,
                            height:20
                        }, {
                        	id:'option8',
                        	xtype: 'checkbox',
                        	fieldLabel: '',
                            labelSeparator: '',
                            boxLabel: '<?= $this->reference_details ?>',
                            name: 'option8',
                            disabled:true,
                            height:32
                        }, {
                        	id:'option9',
                        	xtype: 'checkbox',
                        	//checked: true,
                            fieldLabel: '',
                            labelSeparator: '',
                            boxLabel: '<?= $this->something_else_what ?>',
                            name: 'option9',
                            disabled:true,
                            height:32
                        },{
                            id:'ostoreskontra_id_fail',
                        	fieldLabel : 'ID',
                            name : 'ostoreskontra_id',
                            allowBlank : false,
                            xtype:'textfield',
                            hidden:true,
                            flex: 1  // Take up all *remaining* vertical space
                        }]
                    },{
                        columnWidth:.30,
                        layout: 'form',
                        border:false,
                        labelWidth : 1,
                        items: [{
                            id:'combo1',
                        	fieldLabel : '',
                            name : 'seuraava_kasittelija_id',
                    		hiddenName: 'seuraava_kasittelija_id',
                            allowBlank : false,
                    		xtype:'combo',
                    		//value:'1',
                    		anchor:'95%',
                    		store: storeSeuraavakasittelija,
        					displayField: 'DisplayField',
        	                valueField: 'KeyField',
                            mode: 'local',
                            triggerAction: 'all'
                    		},{
                                fieldLabel : ' ',
            					name : 'empty1',
            					xtype:'label',
                                allowBlank : true,
                                hidden: false
                            },{
                                id:'combo2',
                            	fieldLabel : '',
                                name : 'maksuehto',
                                allowBlank : true,
                                xtype:'combo',
                                //value:'1',
                        		store: storeMaksuehto,
            					displayField: 'DisplayField',
            	                valueField: 'KeyField',
                                mode: 'local',
                                anchor:'95%',
                                disabled:true,
                                triggerAction: 'all'
                            },{
                                fieldLabel : ' ',
            					name : 'empty2',
            					xtype:'label',
                                allowBlank : true,
                                hidden: false
                            },{
                                fieldLabel : ' ',
            					name : 'empty3',
            					xtype:'label',
                                allowBlank : true,
                                hidden: false
                            },{
                                fieldLabel : ' ',
            					name : 'empty4',
            					xtype:'label',
                                allowBlank : true,
                                hidden: false
                            },{
                                fieldLabel : ' ',
            					name : 'empty5',
            					xtype:'label',
                                allowBlank : true,
                                hidden: false
                            },{
                                id:'option10',
                            	fieldLabel : '',
            					name : 'reason',
            					maxLength: 500,
            					xtype:'textfield',
                                allowBlank : true,
                                anchor:'95%',
                                disabled:true,
                                hidden: false
                            }]
                    }]
                 
                }]

            });

            function failINV() {
            	
            	var ostoreskontra_id = readCookie('ostoreskontra_id_invoice');
            	
            	Ext.getCmp('ostoreskontra_id_fail').setValue(ostoreskontra_id);
            	
            	storeSeuraavakasittelija.loadData;
                storeSeuraavakasittelija.load();
            	
            	Ext.getCmp('combo1').enable();
            	Ext.getCmp('combo2').disable();

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!failwin) {
                	failwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'fail-inv',
                                //layout : 'fit',
                                width : 600,
                                height : 400,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->fail_invoice ?>',
                                items : [failform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/failinvoice";
                                                if(failform.getForm().isValid()){
                                                failwin.hide();
                                                failform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        failform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        //store.reload();
                                                                        failwin.hide();
                                                                        Ext.getCmp('combo1').enable();
                                                                    	Ext.getCmp('combo2').disable();
                                                                    	
                                                                    	Ext.getCmp('option3').disable();
                                                                    	Ext.getCmp('option4').disable();
                                                                    	Ext.getCmp('option5').disable();
                                                                    	Ext.getCmp('option6').disable();
                                                                    	Ext.getCmp('option7').disable();
                                                                    	Ext.getCmp('option8').disable();
                                                                    	Ext.getCmp('option9').disable();
                                                                    	Ext.getCmp('option10').disable();
                                                                    	
                                                                        document.location = '/zf/public/ostoreskontra/index/index';
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															failform
                                                                                .getForm()
                                                                                .reset();
            															//myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->error ?>',
                                                                                        json.msg);
                                                                        failwin.hide();
                                                                        Ext.getCmp('combo1').enable();
                                                                    	Ext.getCmp('combo2').disable();
                                                                    	
                                                                    	Ext.getCmp('option3').disable();
                                                                    	Ext.getCmp('option4').disable();
                                                                    	Ext.getCmp('option5').disable();
                                                                    	Ext.getCmp('option6').disable();
                                                                    	Ext.getCmp('option7').disable();
                                                                    	Ext.getCmp('option8').disable();
                                                                    	Ext.getCmp('option9').disable();
                                                                    	Ext.getCmp('option10').disable();
                                                                    	
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                                failform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                failwin.hide();
                                                Ext.getCmp('combo1').enable();
                                            	Ext.getCmp('combo2').disable();
                                            	
                                            	Ext.getCmp('option3').disable();
                                            	Ext.getCmp('option4').disable();
                                            	Ext.getCmp('option5').disable();
                                            	Ext.getCmp('option6').disable();
                                            	Ext.getCmp('option7').disable();
                                            	Ext.getCmp('option8').disable();
                                            	Ext.getCmp('option9').disable();
                                            	Ext.getCmp('option10').disable();
                                            	
                                            }
                                        } ]
                            });
            				
                }
                failwin.show(this);
            }
            
            /*Radio1.on('focus', function(){
            
            	//alert('test1');
            	Ext.getCmp('combo1').enable();
            	Ext.getCmp('combo2').disable();
            	
            	Ext.getCmp('option3').disable();
            	Ext.getCmp('option4').disable();
            	Ext.getCmp('option5').disable();
            	Ext.getCmp('option6').disable();
            	Ext.getCmp('option7').disable();
            	Ext.getCmp('option8').disable();
            	Ext.getCmp('option9').disable();
            	Ext.getCmp('option10').disable();
            
            });
            
            Radio2.on('focus', function(){
                
            	//alert('test2');
            	Ext.getCmp('combo1').disable();
            	Ext.getCmp('combo2').enable();
            	
            	Ext.getCmp('option3').enable();
            	Ext.getCmp('option4').enable();
            	Ext.getCmp('option5').enable();
            	Ext.getCmp('option6').enable();
            	Ext.getCmp('option7').enable();
            	Ext.getCmp('option8').enable();
            	Ext.getCmp('option9').enable();
            	Ext.getCmp('option10').enable();
            
            });*/
            
            Radio1.addListener('check',function() {
                //alert("yihuuu");
            	Ext.getCmp('combo1').disable();
            	Ext.getCmp('combo2').enable();
            	
            	Ext.getCmp('option3').enable();
            	Ext.getCmp('option4').enable();
            	Ext.getCmp('option5').enable();
            	Ext.getCmp('option6').enable();
            	Ext.getCmp('option7').enable();
            	Ext.getCmp('option8').enable();
            	Ext.getCmp('option9').enable();
            	Ext.getCmp('option10').enable();
            	
            });
            
            Radio2.addListener('check',function() {
                //alert("yihuuu");
            	
            	Ext.getCmp('combo1').enable();
            	Ext.getCmp('combo2').disable();
            	
            	Ext.getCmp('option3').disable();
            	Ext.getCmp('option4').disable();
            	Ext.getCmp('option5').disable();
            	Ext.getCmp('option6').disable();
            	Ext.getCmp('option7').disable();
            	Ext.getCmp('option8').disable();
            	Ext.getCmp('option9').disable();
            	Ext.getCmp('option10').disable();
            });
            
           //alert(readCookie('ostoreskontra_id_invoice'));
            
            var gridHyvaksyjat = new Ext.grid.GridPanel({
                store: storeHyvaksyjat,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        width: 40,
                        sortable: false
                    },
                    columns: [
                        {
                        id       :'hyvaksyjat_relation_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'relation_id'
                    },{
                        id       :'hyvaksyjat_order_id',
                        header   : '<>', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'order_id'
                    },{
                        id       :'hyvaksyjat_user',
                        header   : '<?= $this->user ?>', 
                        width    : 300, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'user'
                    },{
                        header   : '<?= $this->handled ?>', 
                        width    : 180, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'kasitelty',
                        renderer: function(data) {
							
                        	if(data=="open") {
								return '<?= $this->open ?>';
							} else if (data=="accepted") {
								return '<?= $this->accepted ?>';
							} else if (data=="acceptlater") {
								return '<?= $this->acceptlater ?>';
							} else if (data=="nonaccepted") {
								return '<?= $this->nonaccepted ?>';
							} else if (data=="nonacceptednoinformation") {
								return '<?= $this->nonacceptednoinformation ?>';
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
							
						}
                    }
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
                //clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'relation_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: 200,
                title: '<?= $this->hyvaksyjat ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-hyvaksyjat',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    })
            });
            
            // create the Grid
            var gridAsiatarkastajat = new Ext.grid.GridPanel({
                store: storeAsiatarkastajat,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        width: 40,
                        sortable: false
                    },
                    columns: [
                        {
                        id       :'asiatarkastajat_relation_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'relation_id'
                    },{
                        id       :'asiatarkastajat_order_id',
                        header   : '<>', 
                        width    : 40, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'order_id'
                    },{
                        id       :'asiatarkastajat_user',
                        header   : '<?= $this->user ?>', 
                        width    : 300, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'user'
                    },{
                        header   : '<?= $this->handled ?>', 
                        width    : 180, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'kasitelty',
                        renderer: function(data) {
							
							if(data=="open") {
								return '<?= $this->open ?>';
							} else if (data=="accepted") {
								return '<?= $this->accepted ?>';
							} else if (data=="acceptlater") {
								return '<?= $this->acceptlater ?>';
							} else if (data=="nonaccepted") {
								return '<?= $this->nonaccepted ?>';
							} else if (data=="nonacceptednoinformation") {
								return '<?= $this->nonacceptednoinformation ?>';
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
							
						}
                    }
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
                //clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'relation_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: 200,
                title: '<?= $this->asiatarkastajat ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-asiatarkastajat',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    })
            });
           
            
            var tabs_left = new Ext.TabPanel({
                renderTo: 'ApplicationForm',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight()-50,
                activeTab: 0,
                frame:true,
                deferredRender: false,
                autoTabs: true,
                defaults:{autoHeight: false},
                rowspan:3,
                items:[
                    {
                        layout: 'fit',
                        border: true,
                        frame: false,
                        title: '<?= $this->view_invoice ?>',
                        id: 'invoiceframe',
                        defaultType: 'iframepanel',
                        defaults: {
                            loadMask: {hideOnReady :true,msg:'Loading...'},
                            border: false,
                            header: false
                        },
                        items: [{
                            id: 'view_invoice_iframe',
                            <?php if ($this->redirect) { ?>
                            defaultSrc: '/zf/public/ostoreskontra/json/viewinvoiceemployee?os_location=<?= $this->redirect ?>'
                            <?php } else { ?>
                            defaultSrc: '/zf/public/ostoreskontra/json/viewinvoiceemployee'
                            <?php } ?>
                        }]
                    },gridAsiatarkastajat,gridHyvaksyjat
                ],
                bbar: [
                   	'-',                         
                   {
                       id:'hyvaksy',
                   	text: '<?= $this->hyvaksy ?>',
                       tooltip: '<?= $this->hyvaksy_tooltip ?>',
                       iconCls: 'refresh-icon',
                       disabled:false,
                       handler: acceptINV
                   },
                   {
                       id:'hyvaksymyohemmin',
                   	text: '<?= $this->hyvaksymyohemmin ?>',
                       tooltip: '<?= $this->hyvaksymyohemmin_tooltip ?>',
                       iconCls: 'refresh-icon',
                       disabled:false,
                       handler: laterINV
                   },
                   {
                       id:'hylkaa',
                   	text: '<?= $this->hylkaa ?>',
                       tooltip: '<?= $this->hylkaa_tooltip ?>',
                       iconCls: 'refresh-icon',
                       disabled:false,
                       handler: failINV
                   }
                   ]
            });
            
                    
 });