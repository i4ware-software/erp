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
Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
 
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

function isInt(n) {
	   return typeof n === 'number' && parseFloat(n) == parseInt(n, 10) && !isNaN(n);
} // 6 characters

Ext.util.Format.CurrencyFactory = function(dp, dSeparator, tSeparator, symbol) {
    return function(n,count) {
        dp = Math.abs(dp) + 1 ? dp : 2;
        dSeparator = dSeparator || ".";
        tSeparator = tSeparator || ",";
        
        var total_sum = parseFloat(readCookie('total_sum'));
    	var sum = parseFloat(readCookie('TotalSum'));
    	//alert(readCookie("TotalRowIndex"));
    	
    	var green_start = '<div style="color:green;">';
    	var red_start = '<div style="color:red;">';
    	var div_end = "</div>";
    	
    	//var ColorBlack = readCookie("ColorBlack");
    	
    	//var row = parseInt(readCookie("RowIndex"));
    	
    	//alert(count);
    	
    	var final_value;
    	
    	//alert(n);
    	
    	/*if (isInt(n)) {
    	
    		n = parseFloat(n);
            
    	} else {
    	    
    		n = parseFloat("0.00");
    	}*/
    	
    	//if (isInt(count)) { var m = "0.00,0,.00"; alert("1"); } else { var m = "0,0,"; alert("2"); }
    	
    	//if (n=="") { 
    		
    		//if (isInt(count)) { var m = "0.00,0,.00"; alert("1"); } else { var m = "0,0,"; alert("2"); }
    		
    		//var m = "0.00,0,.00";
    		
    		/*var final_val = (n < 0? '-' : '') // preserve minus sign
            + (x ? m[1].substr(0, x) + tSeparator : "")
            + m[1].substr(x).replace(/(\d{3})(?=\d)/g, "$1" + tSeparator)
            + (dp? dSeparator + (+m[2] || 0).toFixed(dp).substr(2) : "")
            + " " + symbol;*/
            
    	//} else {
    		
    		//alert("3");
    		/*var m = /(\d+)(?:(\.\d+)|)/.exec(n + ""),
            x = m[1].length > 3 ? m[1].length % 3 : 0;
            
            var final_val = (n < 0? '-' : '') // preserve minus sign
            + (x ? m[1].substr(0, x) + tSeparator : "")
            + m[1].substr(x).replace(/(\d{3})(?=\d)/g, "$1" + tSeparator)
            + (dp? dSeparator + (+m[2] || 0).toFixed(dp).substr(2) : "")
            + " " + symbol;*/
    	
    	//n.replace(",", ".");
    	
    	var m = parseFloat(n);
    	
    	/*if (typeof n == "string") {
    		
    		m = parseFloat("0.0");
    		
    	} else {
    		
    		m = parseFloat(n);
    		
    	}*/
    	
    	var final_val = m.toFixed(2) + " " + symbol;
            
    	//}
            
    	//alert(m);
            
    	//var m = /(\d+)(?:(\.\d+)|)/.exec(n + ""),
        //x = m[1].length > 3 ? m[1].length % 3 : 0;
    	
        //alert(i++);
            
        /*var final_val = (n < 0? '-' : '') // preserve minus sign
            + (x ? m[1].substr(0, x) + tSeparator : "")
            + m[1].substr(x).replace(/(\d{3})(?=\d)/g, "$1" + tSeparator)
            + (dp? dSeparator + (+m[2] || 0).toFixed(dp).substr(2) : "")
            + " " + symbol;*/
        
        //var ColorCheck = parseFloat(n);
            
       var sum_sum;
        
        if (isInt(count)) {
        
           final_value = final_val; 
        
        } else {
        	
        	 if (sum==0) {
        		 
        		sum_sum = total_sum - sum;
            	
                final_value = green_start + sum_sum.toFixed(2) + " " + symbol + " (" + total_sum.toFixed(2) + " " + symbol + ")" + div_end;
             
             } else {

            	 sum_sum = total_sum - sum;
            	 
            	 final_value = red_start + sum_sum.toFixed(2) + " " + symbol + " (" + total_sum.toFixed(2) + " " + symbol + ")" + div_end;
             	
             }
        	
        }
        
        return final_value;
    };
};

var euroFormatter = Ext.util.Format.CurrencyFactory(2, ",", ".", "<?= $this->euro ?>");
 
Ext.onReady(function() {
    
            Ext.QuickTips.init();
            var fm = Ext.form;
            var newwin;
            var exporttilitwin;
            var replacewin;
            var newaswin;
            var newhywin;
            var replaceaswin;
            var replacenextaswin;
            var replacenexthywin;
            
            createCookie("storeLoaded", "false", 31);
            createCookie("ostoreskontra_id", 0, 31);
            
            // create the data store
            var store = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/index',
                    reader: new Ext.data.JsonReader({root: 'ostoreskontra',
                        totalProperty: 'totalCount',id: 'ostoreskontra_id'}, 
                            [{name: 'ostoreskontra_id',type: 'int'},
                             {name: 'toimittaja_id',type: 'int'},
                             {name: 'mml_viite',type: 'string'},
                             {name: 'pankkimaksu_viite',type: 'string'},
                             {name: 'laskun_pvm',type: 'date', dateFormat:'Y-m-d'},
                             {name: 'laskunera_pvm',type: 'date', dateFormat:'Y-m-d'},
                             {name: 'toimitusehto',type: 'string'},
                             {name: 'laskun_summa_verollinen',type: 'double'},
                             {name: 'summa_debet',type: 'int'},
                             {name: 'laskun_status',type: 'int'},
                             {name: 'laskun_nro',type: 'string'},
                             {name: 'laskun_summa_veroton',type: 'double'},
                             {name: 'veron_osuus',type: 'double'},
                             {name: 'rahti',type: 'double'},
                             {name: 'created_by_user',type: 'string'},
                             {name: 'maksuehto_string',type: 'string'},
                             {name: 'y-tunnus',type: 'string'},
                             {name: 'message',type: 'string'},
                             {name: 'booked_by_fullname',type: 'string'},
                             {name: 'maksuehto_paivaa',type: 'int'},
                             {name: 'seuraava_kasittelija_fullname',type: 'string'},
                             {name: 'accepting_status',type: 'string'}]),
                            baseParams: { "limit":1000 },
                            remoteSort: true,
                            sortInfo:{field: 'ostoreskontra_id', direction: "DESC"}
                        });
                        
            //store.load({params: { "start":0, "limit":50, "query":"" }});
			
			// create the data store
            var storeHistory = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/history',
                    reader: new Ext.data.JsonReader({root: 'historia',
                        totalProperty: 'totalCount',id: 'historia_id'}, 
                            [{name: 'historia_id',type: 'int'},
							 {name: 'laskun_nro',type: 'string'},
                             {name: 'user',type: 'string'},
                             {name: 'message',type: 'string'},
                             {name: 'date',type: 'date', dateFormat:'Y-m-d H:i:s'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'historia_id', direction: "DESC"}
                        });
                        
            storeHistory.load({params: { "start":0, "limit":50, "query":"" }});
            
             // create the data store
            var storeMaksatus = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/maksatus',
                    reader: new Ext.data.JsonReader({root: 'maksatus',
                        totalProperty: 'totalCount',id: 'maksatus_id'}, 
                            [{name: 'maksatus_id',type: 'int'},
                             {name: 'maksatus_user',type: 'string'},
                             {name: 'maksatus_date',type: 'date', dateFormat:'Y-m-d H:i:s'}]),
                            baseParams: { "limit":50 },
                            sortInfo:{field: 'maksatus_id', direction: "DESC"}
                        });
                        
            storeMaksatus.load({params: { "start":0, "limit":50, "query":"" }});
            
            /*var writer = new Ext.data.JsonWriter({
                encode: true,
                writeAllFields: true // write all fields, not just those that changed
            });*/
            
            // create the data store
            var storeTilit = new Ext.data.GroupingStore({
                url: '/zf/public/ostoreskontra/json/summa',
                reader: new Ext.data.JsonReader({root: 'summat',
                    totalProperty: 'totalCount',id: 'summat_id'}, 
                        [{name: 'summat_id',type: 'int'},
                         {name: 'rowIndex',type: 'int'},
                         {name: 'order_id',type: 'int'},
                         {name: 'laskun_id',type: 'int'},
                         {name: 'kustannuspaikka_id'}, //,type: 'int'},
                         {name: 'projekti_id'}, //,type: 'int'},
                         //{name: 'vero_id',type: 'int'},
                         {name: 'tili_id'}, //,type: 'int'},
                         {name: 'veroton_summa',type: 'string'} //,
                         /*{name: 'laskun_id',type: 'int'}*/]),
                        //autoSave: true,
                        //baseParams: { "limit":50 },
                        //writer: writer,
                        sortInfo:{field: 'order_id', direction: "ASC"},
                        groupField:'laskun_id'
                    });
                        
            //storeTilit.load();
            
            var storeToimittaja = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/toimittaja',
					scope: this
				})
				, baseParams: {
					task: "toimittaja"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'toimittaja_root'
					, id: 'ToimKeyField'
					, fields: [
						{name: 'ToimKeyField'}
						, {name: 'ToimDisplayField'}
					]
				})
			});		
				
            storeToimittaja.loadData;
            storeToimittaja.load();
            
            var storeStatus = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/status',
					scope: this
				})
				, baseParams: {
					task: "status"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'status_root'
					, id: 'StatKeyField'
					, fields: [
						{name: 'StatKeyField'}
						, {name: 'StatDisplayField'}
					]
				})
			});		
				
            storeStatus.loadData;
            storeStatus.load();
            
            /*var storeVero = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/vero',
					scope: this
				})
				, baseParams: {
					task: "vero"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'vero_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
            storeVero.loadData;
            storeVero.load();*/
            
            var storeTili = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/tili',
					scope: this
				})
				, baseParams: {
					task: "tili"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'tili_root'
					, id: 'TiliKeyField'
					, fields: [
						{name: 'TiliKeyField'}
						, {name: 'TiliDisplayField'}
					]
				})
			});		
				
            storeTili.loadData;
            storeTili.load();
            
            var storeKustannuspaikka = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/kustannuspaikka',
					scope: this
				})
				, baseParams: {
					task: "kustannuspaikka"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'kustannuspaikka_root'
					, id: 'KustKeyField'
					, fields: [
						{name: 'KustKeyField'}
						, {name: 'KustDisplayField'}
					]
				})
			});		
				
            storeKustannuspaikka.loadData;
            storeKustannuspaikka.load();
      
            var storeProjektit = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/projektit',
					scope: this
				})
				, baseParams: {
					task: "projektit"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'projektit_root'
					, id: 'ProjKeyField'
					, fields: [
						{name: 'ProjKeyField'}
						, {name: 'ProjDisplayField'}
					]
				})
			});		
				
            storeProjektit.loadData;
            storeProjektit.load();
            
            var storeMonths = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/months',
					scope: this
				})
				, baseParams: {
					task: "months"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'months_root'
					, id: 'MontKeyField'
					, fields: [
						{name: 'MontKeyField'}
						, {name: 'MontDisplayField'}
					]
				})
			});		
				
            storeMonths.loadData;
            storeMonths.load({params: { "year": "<?= $this->thisyear ?>" }});
            
            /*var storeSeuraavakasittelija = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/seuraava',
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
				
            storeSeuraavakasittelija.loadData;
            storeSeuraavakasittelija.load();*/
			
	var viiteNumero = new Ext.data.Record.create([{
        name: 'viitenumero'
    }]);

    var viitenumeroGenerate = new Ext.data.JsonReader({
        successProperty: 'success',
        totalProperty: 'results',
        root: 'viitenumero',
        id: 'viitenumero'
    },
    viiteNumero);

    var viitenumero_auto = new Ext.FormPanel({
        frame: false,
        border: false,
        labelAlign: 'left',
        labelWidth: 85,
        waitMsgTarget: true,
        reader: viitenumeroGenerate,
        items: [
        new Ext.form.FieldSet({
            title: '<?= $this->viite_laskuri ?>',
            autoHeight: true,
            defaultType: 'textfield',
            items: [{
                fieldLabel: '<?= $this->laskun_numero ?>',
                name: 'viitenumero',
                width: 140,
                'id': 'viitenumero'
            }]
        })]
    });

    // simple button add
    viitenumero_auto.addButton('<?= $this->laske_viite ?>', function () {
        viitenumero_auto.getForm().submit({
            url: '/zf/public/ostoreskontra/json/viitenumero',
            waitMsg: '<?= $this->loading ?>',
			success: function (form, action) {
                var json = Ext.util.JSON.decode(action.response.responseText);
                //Ext.MessageBox.alert('<?= $this->error ?>', json.msg);
				Ext.getCmp('pankkimaksu_viite_form').setValue(json.viitenumero);
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
                url : "/zf/public/ostoreskontra/json/createnew",
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
                    fieldLabel : '<?= $this->toimittaja ?>',
                    name : 'toimittaja_id',
            		hiddenName: 'toimittaja_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeToimittaja,
					displayField: 'ToimDisplayField',
	                valueField: 'ToimKeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		},{
                    fieldLabel : '<?= $this->mml_viite ?>',
                    name : 'mml_viite',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->pankkimaksu_viite ?>',
                    id: 'pankkimaksu_viite_form',
					name : 'pankkimaksu_viite',
                    allowBlank : true,
					vtype: 'viitenumero'
                },{
                    fieldLabel : '<?= $this->laskun_nro ?>',
                    id: 'laskunnumero_form',
					name : 'laskunnumero',
                    allowBlank : false
                },{
                    xtype: 'textarea',
                    fieldLabel: '<?= $this->message ?>',
                    hideLabel: false,
                    name: 'message',
                    anchor:'95%',
                    height:40,
                    allowBlank: true,
                    maxLength: 50,
                    flex: 1  // Take up all *remaining* vertical space
                 },{
                    fieldLabel : '<?= $this->laskun_summa_varoton ?>',
                    id: 'laskun_summa_varoton_form',
					name : 'laskun_summa_varoton',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->laskun_vero ?>',
                    id: 'laskun_veron_osuus_form',
					name : 'laskun_veron_osuus',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->laskun_summa_verollinen ?>',
                    id: 'laskun_summa_verollinen_form',
					name : 'laskun_summa_verollinen',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->laskun_rahti ?>',
                    id: 'laskun_rahti_form',
					name : 'laskun_rahti',
                    allowBlank : false
                },{
                    fieldLabel : '<?= $this->laskunpvm ?>',
                    name : 'laskun_pvm',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y'
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file',
                    emptyText: '<?= $this->select_pdf ?>',
                    fieldLabel: '<?= $this->select_pdf_label ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
                    name: 'cvpath',
                    anchor:'95%',
                    validator: function(v){
                        if(!/\.pdf$/.test(v)){
                        return '<?= $this->only_pdf_allowed ?>';
                        }
                     return true;
                    },
                    buttonText: 'Browse...'
                }
                ]/*,
                listeners : {
           	      submit : function(field, viiteValue, viestiValue, options) {
       	   
       	          //alert("NEW");
                 	
                 	alert(filed);
       	   
           	      /*if(newValue)
           	      {
           	         //code executed when checkbox is checked
           	    	 //alert("true");
           	    	 Ext.getCmp('period').disable();
           	    	 Ext.getCmp('parttime').disable();
           	    	 Ext.getCmp('period').setValue({
           	    	     period: false
           	    	 });
           	    	 Ext.getCmp('parttime').setValue({
           	    	     parttime: false
           	    	 });
           	    	 
           	      }
           	      else
           	      {
           	         //code executed when checkbox is not checked
           	    	 //alert("false");
           	    	 Ext.getCmp('period').enable();
            	    	 Ext.getCmp('parttime').enable();
           	      }*/
           	      
           	   //}
          	 //}
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
                                height : 480,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new ?>',
                                items : [newform,viitenumero_auto],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/createnew";
                                                
                                                var textFieldValue=newform.items.items[2].getValue();
                                                var textAreaValue=newform.items.items[4].getValue();
                                                if(textFieldValue!=""||textAreaValue!=""){
                                                  //alert("you can submit the data");
                                                	
                                                	
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
                    															viitenumero_auto.getForm().reset();
                    															//myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                        .alert(
                                                                                                '<?= $this->error ?>',
                                                                                                json.msg);
                                                                                }
                                                                        });
                    													}
                                                	
                                                  } else {
                                                	   
                                                	 Ext.MessageBox
                                                      .alert(
                                                              '<?= $this->you_can_not_submit_a_message ?>',
                                                              '<?= $this->you_can_not_submit_a_message_text ?>');
                                                  }
                                                	
                                                
                                                //}
                                                
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                                newform.getForm().reset();
                                                viitenumero_auto.getForm().reset();
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
                url : "/zf/public/ostoreskontra/json/replace",
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
                xtype: 'textfield',
                id:'replace_id',
                name: 'replace_id',
                hidden:true
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file-replace',
                    emptyText: '<?= $this->select_pdf ?>',
                    fieldLabel: '<?= $this->select_pdf_label ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
                    name: 'cvpath',
                    anchor:'95%',
                    validator: function(v){
                        if(!/\.pdf$/.test(v)){
                        return '<?= $this->only_pdf_allowed ?>';
                        }
                     return true;
                    },
                    buttonText: 'Browse...'
                }
                ]
            });

            function replaceNT() {

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
                                title : '<?= $this->replace ?>',
                                items : [replaceform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/replace";
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
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('download').disable();
                                                                        Ext.getCmp('replace').disable();
                                                                        //Ext.getCmp('tilit-submit').disable();
                                                                    	//Ext.getCmp('tilit-reset').disable();
                                                						Ext.getCmp('invoice-submit').disable();
                                                						Ext.getCmp('lisaa-uusi-tili').disable();
                                                						Ext.getCmp('poista-tili').disable();
                                                						Ext.getCmp('xls').disable();
                                                						//Ext.getCmp('delete-invoice').disable();
                                                						Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=0');
                                                						grid.selModel.clearSelections();
                                                						forminvoicedetails.getForm().reset();
                                                						storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id=0";
                                                						storeHistory.reload();
                                                						storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id=0";
                                                						storeTilit.reload();
                                                						Ext.getCmp('add_asiatarkastajat-grid').disable();
                                        								Ext.getCmp('delete_asiatarkastajat-grid').disable();
                                        								Ext.getCmp('add_hyvaksyjat-grid').disable();
                                        								Ext.getCmp('delete_hyvaksyjat-grid').disable();
                                                						storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id=0";
                                        								storeAsiatarkastajat.reload();
                                        								storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id=0";
                                                        				storeHyvaksyjat.reload();
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
                                                                                        json.msg);
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
                id: 'grid-invoices',
            	store: store,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'ostoreskontra_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'ostoreskontra_id'
                    },
                    {
                        header   : '<?= $this->toimittaja ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:true, 
                        dataIndex: 'toimittaja_id',
                        editor: new Ext.form.ComboBox({									    
							store: storeToimittaja,
							displayField: 'ToimDisplayField',
			                valueField: 'ToimKeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:true								
						})
						, renderer: function(data) {
							record = storeToimittaja.getById(data);
							if(record) {
								return record.data.ToimDisplayField;
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
						}
                    },
                    {
                        header   : '<?= $this->laskunpvm ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:false,
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        dataIndex: 'laskun_pvm',
                        editor: new fm.DateField({
    						allowBlank: false,
    						disabled: true
    					})
                    },
                    {
                        header   : '<?= $this->laskun_nro ?>', 
                        width    : 100, 
                        sortable : true,
                        locked:false, 
                        dataIndex: 'laskun_nro',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },
                    {
                        header   : '<?= $this->mml_viite ?>', 
                        width    : 140, 
                        sortable : true,
                        locked:false, 
                        dataIndex: 'mml_viite',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->pankkimaksu_viite ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'pankkimaksu_viite',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->laskun_status ?>', 
                        width    : 160, 
                        sortable : true,
                        locked:false, 
                        dataIndex: 'laskun_status',
                        editor: new Ext.form.ComboBox({									    
							store: storeStatus,
							displayField: 'StatDisplayField',
			                valueField: 'StatKeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeStatus.getById(data);
							if(record) {
								return record.data.StatDisplayField;
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
						}
                    },
                    {
                        header   : '<?= $this->laskunerapvm ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        dataIndex: 'laskunera_pvm',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->toimitusehto ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'toimitusehto',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->maksuehto ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'maksuehto_paivaa',
                        hidden:true
                    },{
                        header   : '<?= $this->maksuehto ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'maksuehto_string',
                        hidden:true
                    },{
                        header   : '<?= $this->y_tunnus ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'y-tunnus',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->laskun_summa_varoton ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'laskun_summa_veroton'
                    },{
                        header   : '<?= $this->laskun_vero ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'veron_osuus',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->laskun_summa_verollinen ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'laskun_summa_verollinen'
                    },
                    {
                        header   : '<?= $this->laskun_rahti ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'rahti'
                    },
                    {
                        header   : '<?= $this->created_by ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:false,
                        dataIndex: 'created_by_user'
                    },
                    {
                        header   : '<?= $this->seuraava_kasittelija ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:false,
                        dataIndex: 'seuraava_kasittelija_fullname'
                    },{
                        header   : '<?= $this->booked_by ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false,
                        hidden:false,
                        dataIndex: 'booked_by_fullname'
                    },
                    {
                        header   : '<?= $this->message ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'message',
                        hidden:true
                    },
                    {
                        header   : '<?= $this->accepting_status ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'accepting_status',
                        hidden:false,
                        editor: {
                        	xtype:'combo',
                    		store: new Ext.data.SimpleStore({
                                                    fields: ['id','value'],
                                                    data:[
                    								["checking","<?= $this->checking ?>"],
                    								["accepting","<?= $this->accepting ?>"]
                    								]
                                                }),
                                                displayField: 'value',
                                                valueField: 'id',
                                                mode: 'local',
                                                triggerAction: 'all'
                        }
                        , renderer: function(data) {
							
							if(data=='checking') {
								return '<?= $this->checking ?>';
							} else if (data=='accepting') { 
							    return '<?= $this->accepting ?>';
                            } else {
								return '( <?= $this->puuttuu ?> )';
							}
                        	
						}
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: [new Ext.PagingToolbar({
                    store: store,           
                    pageSize: 1000,
                    id:'paging-toolbar',
                    prependButtons: true,
                    beforePageText: 'Sivu',
                    displayInfo: '{0} - {1} of {2}',
                    displayMsg: '{0} - {1} of {2}',
                    emptyMsg: 'Ei laskuja'}
                )],
                buttons: [
				{
				    id: 'xml',
				  	text: '<?= $this->xml ?> ',
				      tooltip: '<?= $this->xml_tooltip ?> ',
				      iconCls: 'refresh-icon',
				      disabled:true,
				      handler: handleMaksata
				  },{
				      id: 'month-xls',
				    	text: '<?= $this->month_xls ?> ',
				        tooltip: '<?= $this->month_xls_tooltip ?> ',
				        iconCls: 'refresh-icon',
				        disabled:false,
				        handler: exportTilit
				    }
                ],
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['ostoreskontra_id']
                        ,disableIndexes:['ostoreskontra_id','maksuehto_paivaa','seuraava_kasittelija_id','message','rahti','accepting_status']
                        ,minChars:1
                        ,minLength:1
                        ,xtype:'radio'
                        ,searchText:'Etsi'
                        ,checkIndexes:['toimittaja_id']
                        ,autoFocus:true
                        ,menuStyle:'radio'
                    })],
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:true,moveEditorOnEnter:true}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'ostoreskontra_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid',
               
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
	                            grid.selModel.clearSelections();
	                            Ext.getCmp('download').disable();
	                            Ext.getCmp('replace').disable();
	                            //Ext.getCmp('tilit-submit').disable();
	                        	//Ext.getCmp('tilit-reset').disable();
								Ext.getCmp('invoice-submit').disable();
								Ext.getCmp('lisaa-uusi-tili').disable();
								Ext.getCmp('lisaa-uusi-tili-kymmenen').disable();
								Ext.getCmp('poista-tili').disable();
								Ext.getCmp('xls').disable();
								//Ext.getCmp('delete-invoice').disable();
								Ext.getCmp('refresh-history').disable();
								Ext.getCmp('refresh-tilit').disable();
								Ext.getCmp('add_asiatarkastajat-grid').disable();
								Ext.getCmp('delete_asiatarkastajat-grid').disable();
								Ext.getCmp('add_hyvaksyjat-grid').disable();
								Ext.getCmp('delete_hyvaksyjat-grid').disable();
								Ext.getCmp('replace_asiatarkastajat-grid').disable();
								Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
								Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
								Ext.getCmp('remove_all-grid').disable();
								//Ext.getCmp('tilit').disable();
								//Ext.getCmp('ostoreskontra_id').disable();
	                            //formtilit.getForm().reset();
								forminvoicedetails.getForm().reset();
								//Ext.getCmp('tilit').setValue("");
								//Ext.getCmp('ostoreskontra_id').setValue("");
								Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=0');
								storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id=0";
								storeTilit.reload();
								storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id=0";
								storeHistory.reload();
								storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id=0";
								storeAsiatarkastajat.reload();
								storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id=0";
                				storeHyvaksyjat.reload();
                				createCookie("ostoreskontra_id", 0, 31);
	                        }},
                        {
	                        text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        handler: function () {
	                            store.reload();
	                            grid.selModel.clearSelections();
	                            Ext.getCmp('download').disable();
	                            Ext.getCmp('replace').disable();
	                            //Ext.getCmp('tilit-submit').disable();
	                        	//Ext.getCmp('tilit-reset').disable();
								Ext.getCmp('invoice-submit').disable();
								Ext.getCmp('lisaa-uusi-tili').disable();
								Ext.getCmp('lisaa-uusi-tili-kymmenen').disable();
								Ext.getCmp('poista-tili').disable();
								Ext.getCmp('xls').disable();
								//Ext.getCmp('delete-invoice').disable();
								Ext.getCmp('refresh-history').disable();
								Ext.getCmp('refresh-tilit').disable();
								Ext.getCmp('add_asiatarkastajat-grid').disable();
								Ext.getCmp('delete_asiatarkastajat-grid').disable();
								Ext.getCmp('add_hyvaksyjat-grid').disable();
								Ext.getCmp('delete_hyvaksyjat-grid').disable();
								Ext.getCmp('replace_asiatarkastajat-grid').disable();
								Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
								Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
								Ext.getCmp('remove_all-grid').disable();
								//Ext.getCmp('tilit').disable();
								//Ext.getCmp('ostoreskontra_id').disable();
	                            //formtilit.getForm().reset();
								forminvoicedetails.getForm().reset();
								//Ext.getCmp('tilit').setValue("");
								//Ext.getCmp('ostoreskontra_id').setValue("");
								Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=0');
								storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id=0";
								storeTilit.reload();
								storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id=0";
								storeHistory.reload();
								storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id=0";
								storeAsiatarkastajat.reload();
								storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id=0";
                				storeHyvaksyjat.reload();
                				createCookie("ostoreskontra_id", 0, 31);
	                        }},
                        {
                            text: '<?= $this->new ?>',
                            tooltip: '<?= $this->new_tooltip ?>',
                            iconCls: 'refresh-icon',
                            handler: createNT
                        },
                        {
                            id: 'download',
                        	text: '<?= $this->download ?>',
                            tooltip: '<?= $this->download_tooltip ?>',
                            iconCls: 'refresh-icon',
                            disabled:true,
                            handler: function () {
                                //store.reload();
                                var selectedRows = grid.selModel.selections.items;
                    
                                var selectedKeys = grid.selModel.selections.keys; 

                                var encoded_keys = Ext.encode(selectedKeys);
                                
                                //encoded_keys = 
                                
                                encoded_keys = encoded_keys.replace('["', '');
                                encoded_keys = encoded_keys.replace('"]', '');

                                //alert(encoded_keys[0]);                 
                                                 
                                window.location = '/zf/public/ostoreskontra/download.' + encoded_keys + '.pdf';
                                
                            }
                        },
                        {
                            id: 'replace',
                        	text: '<?= $this->replace ?>',
                            tooltip: '<?= $this->replace_tooltip ?>',
                            iconCls: 'refresh-icon',
                            disabled:true,
                            handler: replaceNT
                        } /*,
                        {
                            id: 'delete-invoice',
                        	text: '<?= $this->delete_invoice ?>',
                            tooltip: '<?= $this->delete_invoice_tooltip ?>',
                            iconCls: 'refresh-icon',
                            disabled:true,
                            handler: handleDeleteLasku
                        }*/]
            });
			
			// create the Grid
            var gridHistory = new Ext.grid.EditorGridPanel({
                id: 'history-grid',
            	store: storeHistory,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'historia_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'historia_id'
                    },{
                        id       :'historia_date',
                        header   : '<?= $this->date ?>', 
                        width    : 120, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'date',
						renderer:  Ext.util.Format.dateRenderer('d.m.Y H:i:s'),
                    },{
                        id       :'historia_user',
                        header   : '<?= $this->user ?>', 
                        width    : 90, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'user'
                    },{
                        id       :'historia_invoice',
                        header   : '<?= $this->laskun_nro ?>', 
                        width    : 100, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'laskun_nro'
                    },{
                        id       :'historia_massage',
                        header   : '<?= $this->msg ?>', 
                        width    : 4800, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'message'
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: storeHistory,           
                    pageSize: 50,
                    id:'paging-toolbar-history',
                    prependButtons: true,
                    beforePageText: 'Sivu',
                    displayInfo: '{0} - {1} of {2}',
                    displayMsg: '{0} - {1} of {2}',
                    emptyMsg: 'Ei historiaa'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['historia_id']
                        ,disableIndexes:['historia_id','date','laskun_nro']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'Etsi'
                        ,checkIndexes:['user']
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
                //autoExpandColumn: 'historia_id',
                width: Ext.lib.Dom.getViewWidth()-550,
                //height: Ext.lib.Dom.getViewHeight(),
                title: '<?= $this->history ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-history',
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
	                        id: 'refresh-history',
                        	text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_history_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
                        		var storeHistoryId = readCookie('ostoreskontra_id');
                        		storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+storeHistoryId;
	                            storeHistory.reload();
	                        }}]
            });
			
			var forminvoicedetails = new Ext.form.FormPanel({
                id:'invoiceForm',
    			//renderTo: 'f1',
                labelAlign: 'top',
                buttonAlign: 'left',
                title:'<?= $this->invoice_details ?>',
                autoHeight: true,
                height: Ext.lib.Dom.getViewHeight(),
    			bodyStyle: 'padding:2px;',
    			width: 400,
    			items: [{
    	            layout:'column',
    	            border:false,
    	            width: 400,
    	            items:[{
    	                columnWidth:.50,
    	                layout: 'form',
    	                border:false,
                items: [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_invoice_id',
                    name : 'ostoreskontra_id',
                    allowBlank : false,
                    anchor:'95%',
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->mml_viite ?>',
                    id : 'mml_viite_invoice',
                    name : 'mml_viite',
                    allowBlank : false,
                    anchor:'95%',
                    xtype:'textfield',
                    hidden:false
                },{
                    fieldLabel : '<?= $this->pankkimaksu_viite ?>',
                    id : 'pankkimaksu_viite_invoice',
                    name : 'pankkimaksu_viite',
                    allowBlank : true,
                    anchor:'95%',
                    xtype:'textfield',
                    /*vtype: 'viitenumero',*/
                    hidden:false
                },{
                    id: 'toimitusehto_invoice',
        			xtype: 'textarea',
                    fieldLabel: 'Toimitusehto',
					allowBlank : false,
					anchor:'95%',
                    name: 'toimitusehto'
                },{
                    id: 'message_invoice',
        			xtype: 'textarea',
                    fieldLabel: 'Viesti maksun saajalle',
					allowBlank : true,
					anchor:'95%',
					maxLengh: 50,
                    name: 'message'
                }/*,{
                    fieldLabel : '<?= $this->kustannuspaikka ?>',
                    id: 'kustannuspaikka_id_invoice',
                    name : 'kustannuspaikka_id',
            		hiddenName: 'kustannuspaikka_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		anchor:'95%',
            		store: storeKustannuspaikka,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		},{
                        fieldLabel : '<?= $this->projekti ?>',
                        id : 'projekti_id_invoice',
                        name : 'projekti_id',
                		hiddenName: 'projekti_id',
                        allowBlank : false,
                		xtype:'combo',
                		//value:'1',
                		anchor:'95%',
                		store: storeProjektit,
    					displayField: 'DisplayField',
    	                valueField: 'KeyField',
                        mode: 'local',
                        triggerAction: 'all'
                		},{
                            fieldLabel : 'Laskun summa (0 % ALV)',
                            id : 'laskun_summa_veroton_invoice',
                            name : 'laskun_summa_veroton',
                            allowBlank : false,
                            anchor:'95%',
                            xtype:'textfield',
                            hidden:false,
                            listeners: {
                                change: function(field, newVal, oldVal) {
                                    //alert(newVal);
		                			var alv = 0.24;
		            				var sum = parseFloat(newVal);
		            				var tax = sum * alv;
		            				var sum_total = sum + tax;
		            				
		            				Ext.getCmp('laskun_veron_osuus_invoice').setValue(tax);
		            				Ext.getCmp('laskun_summa_verollinen_invoice').setValue(sum_total);
            				
                                }
                            }
                        },{
                            fieldLabel : 'Veron osuus',
                            id : 'laskun_veron_osuus_invoice',
                            name : 'laskun_veron_osuus',
                            allowBlank : false,
                            anchor:'95%',
                            xtype:'textfield',
                            hidden:false
                        },{
                            fieldLabel : 'Laskun summa (24 % ALV)',
                            id : 'laskun_summa_verollinen_invoice',
                            name : 'laskun_summa_verollinen',
                            allowBlank : false,
                            anchor:'95%',
                            xtype:'textfield',
                            hidden:false
                        }*/
                ]
    	            },{
    	                columnWidth:.50,
    	                layout: 'form',
    	                border:false,
    	                items: [{
                            fieldLabel : '<?= $this->maksuehto ?>',
                            id : 'maksuehto_string_invoice',
                            name : 'maksuehto_string',
                            allowBlank : false,
                            anchor:'95%',
                            xtype:'textfield',
                            disabled:true,
                            hidden:false
                        },{
                                    id: 'laskun_pvm_invoice',
                        			xtype: 'datefield',
                                    fieldLabel: '<?= $this->laskunpvm ?>',
                					allowBlank : false,
                                    name: 'laskun_pvm',
                                    anchor:'98%',
                					format: 'd.m.Y',
                					listeners: {
                					    change: function (combo, value) {
                        	                 var days = parseInt(readCookie('maksuehto'));
                        	                 var dueDate = new Date(value).add(Date.DAY, + days);
                        			         Ext.getCmp('laskunera_pvm_invoice').setValue(dueDate);
                					    }
                					}
                                },{
                                    id: 'laskunera_pvm_invoice',
                        			xtype: 'datefield',
                                    fieldLabel: '<?= $this->laskunerapvm ?>',
                					allowBlank : false,
                                    name: 'laskunera_pvm',
                                    anchor:'98%',
                					format: 'd.m.Y'
                                },
                                {
                                    fieldLabel : '<?= $this->summa ?>',
                                    id : 'laskun_summa_veroton_invoice',
                                    name : 'laskun_veron_osuus',
                                    allowBlank : false,
                                    anchor:'95%',
                                    xtype:'textfield',
                                    hidden:false
                                },{
                                    fieldLabel : '<?= $this->laskun_vero ?>',
                                    id : 'veron_osuus_invoice',
                                    name : 'veron_osuus',
                                    allowBlank : false,
                                    anchor:'95%',
                                    xtype:'textfield',
                                    hidden:false
                                },{
                                    fieldLabel : '<?= $this->laskun_summa_verollinen ?>',
                                    id : 'laskun_summa_verollinen_invoice',
                                    name : 'laskun_summa_verollinen',
                                    allowBlank : false,
                                    anchor:'95%',
                                    xtype:'textfield',
                                    hidden:false
                                },{
                                    fieldLabel : '<?= $this->laskun_rahti ?>',
                                    id : 'laskun_rahti_invoice',
                                    name : 'laskun_rahti',
                                    allowBlank : false,
                                    anchor:'95%',
                                    xtype:'textfield',
                                    hidden:false
                                }]
    	            }]
                }],
    			buttons: [{
                    text: "<?= $this->submit ?>",
                    id:'invoice-submit',
                    disabled:true,
                    scope: this,
                    handler: function(){
                        if(forminvoicedetails.getForm().isValid()){
                        	var url = "/zf/public/ostoreskontra/json/tallennalasku";
                        	forminvoicedetails
                            .getForm()
                            .submit(
                                    {
                                    	waitTitle : '<?= $this->sending ?>',
                                    	waitMsg : '<?= $this->sending ?>',
                                        url : url,
                                        success : function(
                                                form, action) {
                                            //myaccount_password_auto.getForm().reset();
											var json = Ext.util.JSON.decode(action.response.responseText); 
                                            Ext.MessageBox
                                            .alert(
                                                    '<?= $this->success ?>',
                                                    json.msg);
                                            createCookie("total_sum", parseFloat(json.laskun_summa_verollinen), 31);
                                            storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
                            				storeHistory.reload();
                            				storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+json.ostoreskontra_id;
                            				storeTilit.reload();
                                            store.reload();
                                      
                                        },
                                        failure : function(
                                                form, action) {
											//myaccount_password_auto.getForm().reset();
											var json = Ext.util.JSON.decode(action.response.responseText); 
                                            Ext.MessageBox
                                                    .alert(
                                                            '<?= $this->error ?>',
                                                            json.msg);
                                            store.reload();
                                            }
                                    });
                        	
                        }
                    }
                }]
            });
			
			// define a custom summary function
		    /*Ext.ux.grid.GroupSummary.Calculations['totalCost'] = function(v, record, field){
		        return v + record.data.veroton_summa + (record.data.veroprosentti * record.data.veroton_summa);
		    };*/
			
			// utilize custom extension for Group Summary
		    //var summary = new Ext.ux.grid.GroupSummary();
			
			//var oldData;
		    /*storeProjektit.on('load', function() {
			    //oldData = storeTilit.getRange(); // Grabs an array of all current records
				//storeProjektit.reload();
	            //storeKustannuspaikka.reload();
	            //storeTili.reload();
		    	var tilitLoaded = readCookie('tilitLoaded');
		    	
		    	if (tilitLoaded=="false") {
		    		createCookie("tilitLoaded", "true", 31);
				    var storeOstoreskontraId = readCookie('ostoreskontra_id');  
      		        storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+storeOstoreskontraId;
				    storeTilit.reload();
		    	}
			});*/
			
			storeTilit.on('load', function() {
				
	        	    var total = gridTilit.getStore().getTotalCount();
	        	    
	        	    if (total == "0") {
	        	    	Ext.getCmp('lisaa-uusi-tili').disable();
	        	    } else {
	        	    	Ext.getCmp('lisaa-uusi-tili').enable();
	        	    }
	        	
			});
			
			/*var newtiliform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/createnewtili",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                //fileUpload: true,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_tili',
                    name : 'ostoreskontra_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->tili ?>',
                    name : 'tili_id',
            		hiddenName: 'tili_id',
                    allowBlank : false,
            		xtype:'combo',
            		tpl: '<tpl for="."><div ext:qtip="<?= $this->tili ?> # {KeyField}." class="x-combo-list-item">{DisplayField}</div></tpl>',
                	store: storeTili,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
					typeAhead: true,
					lazyRender: true,
					triggerAction: 'all',
					disabled:false,
					minChars:1,
					forceSelection:true,
					mode: 'remote',
					valueNotFoundText:'<?= $this->account_not_found ?>'
            		},{
                        fieldLabel : '<?= $this->kustannuspaikka ?>',
                        name : 'kustannuspaikka_id',
                		hiddenName: 'kustannuspaikka_id',
                        allowBlank : false,
                		xtype:'combo',
                    	store: storeKustannuspaikka,
    					displayField: 'DisplayField',
    	                valueField: 'KeyField',
    					typeAhead: false,
    					lazyRender: true,
    					triggerAction: 'all',
    					disabled:false,
    					mode: 'remote'
                		},{
                            fieldLabel : '<?= $this->projekti ?>',
                            name : 'projekti_id',
                    		hiddenName: 'projekti_id',
                            allowBlank : true,
                    		xtype:'combo',
                        	store: storeProjektit,
        					displayField: 'DisplayField',
        	                valueField: 'KeyField',
        					typeAhead: false,
        					lazyRender: true,
        					triggerAction: 'all',
        					disabled:false,
        					mode: 'remote'
                    		},{
                        fieldLabel : '<?= $this->summa ?>',
                        name : 'summa',
                        allowBlank : false,
                        xtype:'textfield',
                        hidden:false
                    },{
                        id:'ordernumber',
                    	fieldLabel : '<?= $this->ordernumber ?>',
                        name : 'ordernumber',
                        allowBlank : false,
                        xtype:'textfield',
                        hidden:false
                    }
                ]
            });*/

            /*function createTili() {
            	
            	var count = gridTilit.getStore().getTotalCount() + 1;
            	
            	Ext.getCmp('ordernumber').setValue(count);
            	//alert(count);
                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newtiliwin) {
                    newtiliwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-tili',
                                //layout : 'fit',
                                width : 480,
                                height : 450,
                                closeAction : 'hide',
                                plain : true,
                                modal : true,
                                title : '<?= $this->uusi ?>',
                                items : [newtiliform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/createnewtili";
                                                if(newtiliform.getForm().isValid()){
            									newtiliwin.hide();
                                                newtiliform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newtiliform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        /*Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);*/
            															/*Ext.getCmp('ostoreskontra_id_tili').setValue(json.ostoreskontra_id);
            															
            															storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+json.ostoreskontra_id;
                                                        				storeTilit.reload();
                                                        				
                                                        				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
                                                        				storeHistory.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
            															newtiliform
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
                                                newtiliform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                newtiliwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newtiliwin.show(this);
            }*/
			
			var yearsCombo = new Ext.form.ComboBox({
                fieldLabel : '<?= $this->year ?>',
                name : 'year',
        		hiddenName: 'year',
                allowBlank : false,
        		xtype:'combo',
            	store: new Ext.data.SimpleStore({
                    fields: ['id','value'],
                    data: <?= $this->years ?>
                }),
				displayField: 'value',
                valueField: 'id',
				typeAhead: false,
				lazyRender: true,
				triggerAction: 'all',
				disabled:false,
				mode: 'local',
				value: '<?= $this->thisyear ?>'
        	});
			
			var exporttilitform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/postdownloadmonthxls",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 400,
                border : false,
                //fileUpload: true,
                defaults : {
                    width : 180
                },
                defaultType : 'textfield',
                items : [
                yearsCombo,{
                    fieldLabel : '<?= $this->month ?>',
                    name : 'month',
            		hiddenName: 'month',
                    allowBlank : false,
            		xtype:'combo',
            		store: storeMonths,
					displayField: 'MontDisplayField',
	                valueField: 'MontKeyField',
					typeAhead: false,
					lazyRender: true,
					triggerAction: 'all',
					disabled:false,
					mode: 'local'
            	}
                ]
            });
			
			yearsCombo.on('select', function() {
			     //doWork(this.getValue());
				 //alert(this.getValue());
				storeMonths.reload({params: { "year": this.getValue() }});
			}); 

            function exportTilit() {
            	
                // create the window on the first click and reuse on subsequent
                // clicks
                if (!exporttilitwin) {
                	exporttilitwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'export-tilit',
                                //layout : 'fit',
                                width : 400,
                                height : 200,
                                closeAction : 'hide',
                                plain : true,
                                modal : true,
                                title : '<?= $this->month_xls ?>',
                                items : [exporttilitform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/postdownloadmonthxls";
                                                if(exporttilitform.getForm().isValid()){
                                                exporttilitwin.hide();
            									exporttilitform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                    	exporttilitform
                                                                                .getForm()
                                                                                .reset();
                                                                    	var json = Ext.util.JSON.decode(action.response.responseText);
                                                                    	document.location = '/zf/public/ostoreskontra/json/downloadmonthxls?month='+json.month+'&year='+json.year;
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	exporttilitform
                                                                                .getForm()
                                                                                .reset();
                                                                        }
                                                                });
            													}
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                            	exporttilitform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	exporttilitwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                exporttilitwin.show(this);
            }
            
            function dump(obj) {
                var out = '';
                for (var i in obj) {
                    out += i + ": " + obj[i] + "\n";
                }
                
                alert(out);
                
            }
            
            Ext.ux.grid.GroupSummary.Calculations['veroton_summa'] = function(v, record, field){
            	//var total_sum = parseFloat(readCookie('total_sum'));
            	//alert(v + record.data.veroton_summa);
            	//alert(total_sum);
            	//var i = 1;
            	//i++;
            	//alert(i);
            	var count = gridTilit.getStore().getTotalCount();
            	
            	//gridTilit.getView().getRow(count).style.display = 'none';
            	//var rowIndex = gridTilit.getStore().getIndex();
            	//createCookie("TotalRowIndex", count, 31);
                //alert(count);
            	//var sum;
            	//createCookie("RowIndex", record.data.rowIndex, 31);
            	
            	//createCookie("ColorBlack", "false", 31);
            	//if (parseFloat(v + record.data.veroton_summa)==total_sum) {
            	//var sum = parseFloat(readCookie('account_sum'));
            	//}
            	//alert(sum);
            	//createCookie("rowIDX", record.data.order_id, 31);
            	
            	//var rows = record.data.order_id;
            	//var total;
            	
            	//var rowIndex = record.store.data.items;
            	//var TotalRows = rowIndex.length;
            	//var rowKey = rowIndex.valueOf();
            	
            	//alert(field);
            	//dump(record.data);
            	
            	/*if (rows == count) {
            	
            	if (total_sum==sum) {
            		
            		//alert('true');
            		total = parseFloat(v+record.data.veroton_summa);
            		
            	} else {
            		
            		//alert('false');
            		total = parseFloat(v+record.data.veroton_summa) - parseFloat(total_sum);
            		
            	} 
            	
            	return total;
            	
            	} else {
            		
            		//alert(parseFloat(readCookie('account_sum')));
            		
            		return parseFloat(v+record.data.veroton_summa);
            	
            	}*/
            	
            	var value;
            	
            	value = String(v);
            	
            	value.replace(",", "."); 
            	
            	//if (isNaN(v)) {
            	   createCookie("TotalSum", parseFloat(value)+parseFloat(record.data.veroton_summa), 31);
            	   //createCookie("ColorBlack", "true", 31);
            	   //Ext.Msg.alert('TotalSum', readCookie('TotalSum'));
            	//}
            	//value = v.replace(",", ".");
            	return parseFloat(value)+parseFloat(record.data.veroton_summa);
            	
            };
			
            var summary = new Ext.ux.grid.GroupSummary();
            
            //var summary = new Ext.ux.GridTotals();
            var gridnavication = new Rahul.ux.EditableGridPanel();
            
            /*var editor = new Ext.ux.grid.RowEditor({
                saveText: '<?= $this->update ?>',
        		cancelText: '<?= $this->cancel ?>'
            });*/
            
            
            var tilitCombo = new Ext.form.ComboBox({
            	//tpl: '<tpl for="."><div ext:qtip="<?= $this->tili ?> # {TiliKeyField}." class="x-combo-list-item">{TiliDisplayField}</div></tpl>',
            	store: storeTili,
				displayField: 'TiliDisplayField',
                valueField: 'TiliKeyField',
				typeAhead: false,
				lazyRender: false,
				triggerAction: 'all',
				disabled:false,
				minChars:1,
				forceSelection:false,
				mode: 'local',
				hiddenName: 'tili_id',
				name: 'tili_id',
				selectOnFocus: true,
				listeners: {
			        beforequery: function(q) {
			            // we don't want to crash if there's nothing in there
			            if (q.query) {
			                // we need the length later in the doQuery function,
			                // for respecting minChars
			                var length = q.query.length;
			                q.query = new RegExp(Ext.escapeRe(q.query), "i");
			                // pretend I am a string, eh eh
			                q.query.length = length;
			            }
			        }
			    }
            });
            
            var kustannuspaikkaCombo = new Ext.form.ComboBox({
            	store: storeKustannuspaikka,
				displayField: 'KustDisplayField',
                valueField: 'KustKeyField',
				typeAhead: false,
				lazyRender: false,
				triggerAction: 'all',
				disabled:false,
				minChars:1,
				forceSelection:false,
				mode: 'local',
				hiddenName: 'kustannuspaikka_id',
				name: 'kustannuspaikka_id',
				selectOnFocus: true,
				listeners: {
			        beforequery: function(q) {
			            // we don't want to crash if there's nothing in there
			            if (q.query) {
			                // we need the length later in the doQuery function,
			                // for respecting minChars
			                var length = q.query.length;
			                q.query = new RegExp(Ext.escapeRe(q.query), "i");
			                // pretend I am a string, eh eh
			                q.query.length = length;
			            }
			        }
			    }
            });
            
            var projectitCombo = new Ext.form.ComboBox({
            	store: storeProjektit,
				displayField: 'ProjDisplayField',
                valueField: 'ProjKeyField',
				typeAhead: false,
				lazyRender: false,
				triggerAction: 'all',
				disabled:false,
				minChars:1,
				forceSelection:false,
				mode: 'local',
				hiddenName: 'projekti_id',
				name: 'projekti_id',
				selectOnFocus: true,
				listeners: {
			        beforequery: function(q) {
			            // we don't want to crash if there's nothing in there
			            if (q.query) {
			                // we need the length later in the doQuery function,
			                // for respecting minChars
			                var length = q.query.length;
			                q.query = new RegExp(Ext.escapeRe(q.query));
			                // pretend I am a string, eh eh
			                q.query.length = length;
			            }
			        }
			    }
            });
            
			// create the Grid
            var gridTilit = new Ext.grid.EditorGridPanel({
            	//ddGroup: 'GridDD',
            	plugins: [gridnavication, summary],
            	id: 'grid-tilit',
            	//enableDragDrop: false,
                store: storeTilit,
                cm: new Ext.grid.ColumnModel({
                    defaults: {
                        width: 40,
                        sortable: false
                    },
                    columns: [
                        {
                        id       :'rowIndex',
                        //id: Ext.id(),
                        header   : 'ID', 
                        width    : 40, 
                        sortable : false,
                        dataIndex: 'rowIndex',
                        hidden:true
                    },{
                        id       :'summat_id',
                        //id: Ext.id(),
                        header   : 'ID', 
                        width    : 40, 
                        sortable : false,
                        dataIndex: 'summat_id',
                        hidden:true
                    },{
                        //id       :'order_id',
                    	//id: Ext.id(),
                        header   : '<>', 
                        width    : 40, 
                        sortable : false,
                        dataIndex: 'order_id',
                        hidden:false /*,
                        editor: new fm.TextField({
    						allowBlank: false
    					})*/
                        /*renderer: function(v, meta, rec, rowIndex) {
                            var oldRec = oldData[rowIndex];
                            // do your comparison
                            return rec.data.order_id + 1;
                        }*/
                    },{
                        id       :'tili_id',
                    	//id: Ext.id(),
                        header   : '<?= $this->tili ?>', 
                        width    : 300, 
                        sortable : false,
                        dataIndex: 'tili_id',
                        editor: tilitCombo,
                        renderer: function(data) {
							var record = tilitCombo.findRecord(tilitCombo.valueField, data);
							//dump(record);
			                return record ? record.get(tilitCombo.displayField) : '<?= $this->puuttuu ?>';
							//return record.get(tilitCombo.displayField);
						}
                    },{
                        id       :'kustannuspaikka_id',
                    	//id: Ext.id(),
                        header   : '<?= $this->kustannuspaikka ?>', 
                        width    : 140, 
                        sortable : false,
                        dataIndex: 'kustannuspaikka_id',
                        editor: kustannuspaikkaCombo,
                        renderer: function(data) {
							var record = kustannuspaikkaCombo.findRecord(kustannuspaikkaCombo.valueField, data);
							//dump(record);
			                return record ? record.get(kustannuspaikkaCombo.displayField) : '<?= $this->puuttuu ?>';
							//return record.get(kustannuspaikkaCombo.displayField);
						}
                    },{
                        id       :'projekti_id',
                    	//id: Ext.id(),
                        header   : '<?= $this->projekti ?>', 
                        width    : 140, 
                        sortable : false,
                        dataIndex: 'projekti_id',
                        editor: projectitCombo,
						renderer: function(data) {
							var record = projectitCombo.findRecord(projectitCombo.valueField, data);
							//dump(record);
			                return record ? record.get(projectitCombo.displayField) : '<?= $this->puuttuu ?>';
							//return record.get(projectitCombo.displayField);
						}
                    },/*{
                        id       :'vero_id',
                    	//id: Ext.id(),
                        header   : 'ALV %', 
                        width    : 100, 
                        sortable : false,
                        dataIndex: 'vero_id',
                        hidden: true
                    },*/{
                        id       :'laskun_id',
                    	//id: Ext.id(),
                        header   : 'ID', 
                        width    : 100, 
                        sortable : false,
                        dataIndex: 'laskun_id',
                        hidden: true
                    },{
                        id       :'veroton_summa',
                    	//id: Ext.id(),
                        header   : '<?= $this->summa ?>', 
                        width    : 140, 
                        sortable : false,
                        dataIndex: 'veroton_summa',
                        hidden: false,
                        renderer: function(v, params, record){
                        	
                        	//var count = gridTilit.getStore().getTotalCount();
                        	
                        	//gridTilit.getView().getRow(count).style.display = 'none';
                        	
                        	var value;
                        	
                        	//v = v.replace(",", ".");
                        	
                        	value = String(v);
                        	
                        	value.replace(",", ".");
                        	
                        	//if (v=="") {
                        		//value = parseFloat("0.0");
                        	//} else {
                        		//value = parseFloat(value);
                        	//}
                        	
                            return euroFormatter(value,record.data.rowIndex);
                        },
                        editor: new fm.TextField({
    						allowBlank: false,
    						selectOnFocus: true
    					}),
                        summaryType: 'veroton_summa'
                    }/*,{
                        id: 'cost',
                        header: 'Summa',
                        width: 100,
                        sortable: false,
                        groupable: false,
                        renderer: function(v, params, record){
                            return euroFormatter(record.data.veroton_summa);
                        },
                        dataIndex: 'cost',
                        summaryType: 'totalCost',
                        summaryRenderer: euroFormatter
                    }*/
                    ]
                }),
                collapsible: false,
                animCollapse: false,
                //enableDragDrop: true,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:false,moveEditorOnEnter:true}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                clicksToEdit: 2,
                stripeRows: false,
                //autoExpandColumn: 'summat_id',
                width: Ext.lib.Dom.getViewWidth()-650,
                //height: Ext.lib.Dom.getViewHeight(),
                title: '<?= $this->tilit ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-tilit-state',
                view: new Ext.grid.GroupingView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
        			//enableGroupingMenu: false,
                    //hideGroupedColumn: false
                }),
                listeners: {
                    /*'celldblclick' : function(grid, rowIndex, columnIndex, e) {
                    	//var rec = grid.store.getAt(rowIndex);
                        //dump(rec);
                    	//colname = grid.getColumnModel().getDataIndex(columnIndex);
                    	//alert(colname);
                    	//alert(grid.store.getAt(rowIndex).get(colname));
                    	//rec.set(colname, "");
                    	var cm = Ext.getCmp('grid-tilit').getColumnModel();
                    	var valCol = cm.getColumnAt(columnIndex);
                    	var cellXtype = valCol.getEditor().getXType();
                    	
                    	if (cellXtype=="textfield") {
                    		//alert(gridTilit.store.getAt(rowIndex).get(colname));
                    		//valCol.getEditor().selectText(0,1);
                    		//$("input[type=text]").focus(function() { $(this).select(); });
                    		$(this).select();
                    	} else if (cellXtype=="combo") {
                    		//$("option").focus(function() { $(this).select(); });
                    		$(this).select();
                    		//rec.set(colname, "");
                    	} else {
                    		//rec.set(colname, "");
                    		//$("input[type=text]").focus(function() { $(this).select(); });
                    	}
                    	
                    },*/
                    /*'beforeedit' : function(object) {
                    	var rec = gridTilit.store.getAt(object.row);
                        //dump(rec);
                    	
                    	var colIndex = object.column;
                    	var rowIndex = object.row;
                    	var cm = Ext.getCmp('grid-tilit').getColumnModel();
                    	var valCol = cm.getColumnAt(colIndex);
                    	var count = gridTilit.getStore().getTotalCount();
                    	
                    	var cellXtype = valCol.getEditor().getXType();
                    	
                    	//alert(count);
                    	//alert(rowIndex);
                    	
                    	var cell = gridTilit.getView().getCell(rowIndex, colIndex);
                    	//cell.focus();
                        //var cellXtype = cell.getCellEditor().getXType();
                        //dump(cell.properties.names);
                    	
                    	colname = object.field;
                    	
                    	//alert(cellXtype);
                    	
                    	if (cellXtype=="textfield") {
                    		//alert(gridTilit.store.getAt(rowIndex).get(colname));
                    		//valCol.getEditor().selectText(0,1);
                    		//$("input[type=text]").click(function() { $(this).select(); });
                    		//$("input[type=text]").focus(function() { alert("ttt"); });
                    		//$("input[type=text]").click(function() { $(this).select(); });
                    		$("input[type=text]").focus(function() { $(this).select(); });
                    		//$("input[type=text]").select();
                    	} else if (cellXtype=="combo") {
                    		//$("option").click(function() { $(this).select(); });
                    		$("option").focus(function() { $(this).select(); });
                    		//$("option").select();
                    		//rec.set(colname, "");
                    	} else {
                    		//rec.set(colname, "");
                    		//$("input[type=text]").focus(function() { $(this).select(); });
                    	}
                    	
                    	
                    	//alert(colname);
                    	//alert(grid.store.getAt(rowIndex).get(colname));
                    } */ /*,
                    'celldblclick': function(grid, rowIndex, columnIndex) {
                    	//var record = grid.getStore().getAt(rowIndex);
                    	//var field = record.get('veroton_summa');
                    	//field.selectText(0,field.getValue().length);
                    	//alert(field.getValue());
                        //dump(field.getValue());
                    	//var selected = gridTilit.getSelectionModel().getSelection();
                    	//dump(selected);
                    }*/
                    
                    /*,
                    'beforerowmove': function(objThis, oldIndex, newIndex, records) {
                    }
                    ,'afterrowmove': function(objThis, oldIndex, newIndex, records) {
                        alert("Row moved successfully");
                    }
                    ,'beforerowcopy': function(objThis, oldIndex, newIndex, records) {
                    }
                    ,'afterrowcopy': function(objThis, oldIndex, newIndex, records) {
                        alert("Row copied successfully");
                    }*/
                },
                /*render: function(g) {
                    var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    	ddGroup:"GridDD",
                    	copy: false
                        ,listeners: {
                            beforerowmove: function(objThis, oldIndex, newIndex, records) {
                            }
                            ,afterrowmove: function(objThis, oldIndex, newIndex, records) {
                                alert("Row moved successfully");
                            }
                            ,beforerowcopy: function(objThis, oldIndex, newIndex, records) {
                            }
                            ,afterrowcopy: function(objThis, oldIndex, newIndex, records) {
                                alert("Row copied successfully");
                            }
                        }
                    });

                    Ext.dd.ScrollManager.register(g.getView().getEditorParent());
                }
                ,beforedestroy: function(g) {
                    Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
                },*/
                // ... the rest of the setup for the grid
                tbar: [
                        	'-',                         
                        	{
    	                        id:'refresh-tilit',
                            	text: '<?= $this->refresh ?>',
    	                        tooltip: '<?= $this->refresh_tooltip ?>',
    	                        iconCls: 'refresh-icon',
    	                        disabled:true,
    	                        handler: function () {
    	                          storeTili.reload();
    	            	          storeKustannuspaikka.reload();
    	            	          storeProjektit.reload();
    	                          var storeOstoreskontraId = readCookie('ostoreskontra_id');  
                        		  storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+storeOstoreskontraId;
                        		  gridTilit.store.clearData();
                        		  gridTilit.view.refresh();
                        		  storeTilit.reload();
                        	    }
    	                    },{
	                        id:'lisaa-uusi-tili',
                        	text: '<?= $this->lisaa ?>',
	                        tooltip: '<?= $this->lisaa_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled:true,
	                        handler: createTili
	                    },{
	                        id:'lisaa-uusi-tili-kymmenen',
                        	text: '<?= $this->lisaa_kymmenen ?>',
	                        tooltip: '<?= $this->lisaa_kymmenen_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled:true,
	                        handler: addTenNew
	                    },{
	                        id:'poista-tili',
                        	text: '<?= $this->poista_tili ?>',
	                        tooltip: '<?= $this->poista_tili_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled:true,
	                        handler: handleDeleteTiliointi
	                    },{
	                        id: 'xls',
	                      	text: 'XLS',
	                          tooltip: 'XLS',
	                          iconCls: 'refresh-icon',
	                          disabled:true,
	                          handler: function () {             
	                    	      var storeOstoreskontraId = readCookie('ostoreskontra_id');                 
	                              window.location = '/zf/public/ostoreskontra/json/xls?ostoreskontra_id='+storeOstoreskontraId;
	                              
	                          }
	                      }]
            });
            
            function createTili() {	
            	
            	/**/
            	var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
            	
				Ext.Ajax.request({
					waitMsg: 'Tallentaa...'
					, url: '/zf/public/ostoreskontra/json/createnewtili'
					, params: { 
						task: "createnewtili"
						, deleteKeys: encoded_keys
						, key: 'ostoreskontra_id'
					}
					, callback: function (options, success, response) {
						if (success) {
							
						} else {
							Ext.MessageBox.alert('Sorry [Q304]',response.responseText);
						}
					}
					, failure:function(response,options){
						Ext.MessageBox.alert('Varoitus','Oops...');
					}                                      
					, success:function(response,options){
                        var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						Ext.MessageBox.alert('Varoitus',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
							var summaId = json.ostoreskontra_id;
							//alert(summaId);
							storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+summaId;
							//storeTilit.reload();
							storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+summaId;
							storeHistory.reload();
						} else { // else then do this
						} // end if
						storeTilit.reload();
						}
					, scope: this
				});
			};
            
            function addTenNew() {	
            	
            	/**/
            	var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
            	
				Ext.Ajax.request({
					waitMsg: 'Tallentaa...'
					, url: '/zf/public/ostoreskontra/json/addtenaccounts'
					, params: { 
						task: "addtenaccounts"
						, deleteKeys: encoded_keys
						, key: 'ostoreskontra_id'
					}
					, callback: function (options, success, response) {
						if (success) {
							
						} else {
							Ext.MessageBox.alert('Sorry [Q304]',response.responseText);
						}
					}
					, failure:function(response,options){
						Ext.MessageBox.alert('Varoitus','Oops...');
					}                                      
					, success:function(response,options){
                        var json = Ext.util.JSON.decode(response.responseText); // decode resoponse text
						if (json.success===false) { // if json success is false then do this
						Ext.MessageBox.alert('Varoitus',json.msg); // makes alert box with response text
						} else if (json.success===true) { // if json success is true then do this
							var summaId = json.ostoreskontra_id;
							//alert(summaId);
							storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+summaId;
							//storeTilit.reload();
							storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+summaId;
							storeHistory.reload();
						} else { // else then do this
						} // end if
						storeTilit.reload();
						}
					, scope: this
				});
			};
            
            /*var formtilit = new Ext.form.FormPanel({
                id:'tilitForm',
    			//renderTo: 'f1',
                title:'<?= $this->tilit ?>',
                autoHeight: true,
    			bodyStyle: 'padding:10px;',
    			width: 550,
                items: [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id',
                    name : 'ostoreskontra_id',
                    allowBlank : false,
                    anchor:'100%',
                    xtype:'textfield',
                    hidden:true
                },{
                    allowBlank:true,
                    id:'tilit',
                    xtype:'superboxselect',
                    fieldLabel: '<?= $this->tilit ?>',
                    emptyText: '<?= $this->empty_text_tilit ?>',
                    resizable: true,
    				minChars: 2,
                    name: 'tilit',
                    anchor:'100%',
                    store: storeTili,
                    mode: 'remote',
                    displayField: 'DisplayField',
                    displayFieldTpl: '{DisplayField}',
                    valueField: 'KeyField',
                    //value: 'CA,NY',
    				queryDelay: 0,
    				triggerAction: 'all'
                 }
                ],
    			buttons: [{
                    text: "<?= $this->submit ?>",
                    id:'tilit-submit',
                    disabled:true,
                    scope: this,
                    handler: function(){
                        if(formtilit.getForm().isValid()){
                        	var value = Ext.getCmp('tilit').getValue();
                        	var url = "/zf/public/ostoreskontra/json/tallennatilit?value="+value;
                        	formtilit
                            .getForm()
                            .submit(
                                    {
                                    	waitTitle : '<?= $this->sending ?>',
                                    	waitMsg : '<?= $this->sending ?>',
                                        url : url,
                                        success : function(
                                                form, action) {
                                            //myaccount_password_auto.getForm().reset();
											var json = Ext.util.JSON.decode(action.response.responseText); 
                                            Ext.MessageBox
                                            .alert(
                                                    '<?= $this->success ?>',
                                                    json.msg);
                                            store.reload();
                                            storeHistory.reload();
                                        },
                                        failure : function(
                                                form, action) {
											//myaccount_password_auto.getForm().reset();
											var json = Ext.util.JSON.decode(action.response.responseText); 
                                            Ext.MessageBox
                                                    .alert(
                                                            '<?= $this->error ?>',
                                                            json.msg);
                                            store.reload();
                                            storeHistory.reload();
                                            }
                                    });
                        	
                        }
                    }
                }/*,{
                    text: "<?= $this->reset ?>",
                    id:'tilit-reset',
                    disabled:true,
                    scope: this,
                    handler: function(){
                        Ext.getCmp('tilit').reset();
                    }
                }*//*]
            });*/
            
         // create the Grid
            var gridMaksatus = new Ext.grid.EditorGridPanel({
                store: storeMaksatus,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'maksatus_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'maksatus_id'
                    },{
                        id       :'maksatus_date',
                        header   : '<?= $this->date ?>', 
                        width    : 300, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'maksatus_date',
						renderer:  Ext.util.Format.dateRenderer('d.m.Y H:i:s'),
                    },{
                        id       :'maksatus_user',
                        header   : '<?= $this->user ?>', 
                        width    : 300, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'maksatus_user'
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: storeMaksatus,           
                    pageSize: 50,
                    id:'paging-toolbar-maksatus',
                    prependButtons: true,
                    beforePageText: 'Sivu',
                    displayInfo: '{0} - {1} of {2}',
                    displayMsg: '{0} - {1} of {2}',
                    emptyMsg: 'Ei historiaa'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['maksatus_id']
                        ,disableIndexes:['maksatus_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'Etsi'
                        ,checkIndexes:['maksatus_date']
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
                autoExpandColumn: 'maksatus_id',
                //width: Ext.lib.Dom.getViewWidth()-550,
                //height: Ext.lib.Dom.getViewHeight(),
                title: '<?= $this->maksatushistory ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-maksatus',
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
	                        text: '<?= $this->refresh ?>',
	                        tooltip: '<?= $this->refresh_maksatus_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        handler: function () {
	                            storeMaksatus.reload();
	                        }},{
		                        text: '<?= $this->download_maksatus ?>',
		                        tooltip: '<?= $this->download_maksatus_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        handler: function () {
		                            //storeMaksatus.reload();
		                        	var selectedRows = gridMaksatus.selModel.selections.items;
		                            
	                                var selectedKeys = gridMaksatus.selModel.selections.keys; 
	
	                                var encoded_keys = Ext.encode(selectedKeys);
	                                
	                                //encoded_keys = 
	                                
	                                encoded_keys = encoded_keys.replace('["', '');
	                                encoded_keys = encoded_keys.replace('"]', '');
                                
	                        	    window.location = '/zf/public/ostoreskontra/json/downloadmaksatus?maksatus_id='+encoded_keys;
		                        }},{
			                        text: '<?= $this->download_maksatus_pdf ?>',
			                        tooltip: '<?= $this->download_maksatus_pdf_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        handler: function () {
			                            //storeMaksatus.reload();
			                        	var selectedRows = gridMaksatus.selModel.selections.items;
			                            
		                                var selectedKeys = gridMaksatus.selModel.selections.keys; 
		
		                                var encoded_keys = Ext.encode(selectedKeys);
		                                
		                                //encoded_keys = 
		                                
		                                encoded_keys = encoded_keys.replace('["', '');
		                                encoded_keys = encoded_keys.replace('"]', '');
	                                
		                        	    window.location = '/zf/public/ostoreskontra/json/downloadmaksatuspdf?maksatus_id='+encoded_keys;
			                        }}]
            });
            
            var tabs_left = new Ext.TabPanel({
                //renderTo: 'ApplicationForm',
                width: 550,
                height: Ext.lib.Dom.getViewHeight(),
                activeTab: 0,
                frame:true,
                deferredRender: false,
                autoTabs: true,
                defaults:{autoHeight: false},
                rowspan:3,
                items:[
                    grid,
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
                            defaultSrc: '/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=<?= $this->redirect ?>'
                            <?php } else { ?>
                            defaultSrc: '/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=0'
                            <?php } ?>
                        }]
                    },
                    gridMaksatus //,
                    //gridTilit
                ]
            });
            
            // create the data store
            var storeAsiatarkastajat = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/asiatarkastajat',
                    reader: new Ext.data.JsonReader({root: 'asiatarkastajat',
                        totalProperty: 'totalCount',id: 'relation_id'}, 
                            [{name: 'relation_id',type: 'int'},
                             {name: 'order_id',type: 'int'},
                             {name: 'user',type: 'string'},
                             {name: 'kasitelty',type: 'string'}]),
                            sortInfo:{field: 'order_id', direction: "ASC"}
                        });
                        
            storeAsiatarkastajat.load();
            
            var storeAddasiatarkastaja = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/addasiatarkastajat',
					scope: this
				})
				, baseParams: {
					task: "addasiatarkastaja"
				}
				, reader: new Ext.data.JsonReader ({
					totalProperty: 'totalCount'
					, root: 'asiatarkastajat_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
            storeAddasiatarkastaja.loadData;
            storeAddasiatarkastaja.load();
            
            var storeReplaceasiatarkastaja = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/replaceasiatarkastajat',
					scope: this
				})
				, baseParams: {
					task: "replaceasiatarkastaja"
				}
				, reader: new Ext.data.JsonReader ({
					totalProperty: 'totalCount'
					, root: 'asiatarkastajat_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
            storeReplaceasiatarkastaja.loadData;
            storeReplaceasiatarkastaja.load();
            
            // create the Grid
            var gridAsiatarkastajat = new Ext.grid.EditorGridPanel({
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
                width: Ext.lib.Dom.getViewWidth()-550,
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
                    }),
                tbar: ['-',
                       {
                    id: 'add_asiatarkastajat-grid',
                	text: '<?= $this->add_asiatarkastaja ?>',
                    tooltip: '<?= $this->add_asiatarkastaja_tooltip ?>',
                    disabled: true,
                    iconCls: 'refresh-icon',
                    handler: createAS
                    },
                    {
                        id: 'delete_asiatarkastajat-grid',
                    	text: '<?= $this->delete_asiatarkastaja ?>',
                        tooltip: '<?= $this->delete_asiatarkastaja_tooltip ?>',
                        disabled: true,
                        iconCls: 'refresh-icon',
                        handler: deleteAS
                        },
                        {
                            id: 'replace_asiatarkastajat-grid',
                        	text: '<?= $this->replace_asiatarkastaja ?>',
                            tooltip: '<?= $this->replace_asiatarkastaja_tooltip ?>',
                            disabled: true,
                            iconCls: 'refresh-icon',
                            handler: replaceAS
                            },
                            {
                                id: 'replace_and_next_user_asiatarkastajat-grid',
                            	text: '<?= $this->replace_and_next_user_asiatarkastaja ?>',
                                tooltip: '<?= $this->replace_and_next_user_asiatarkastaja_tooltip ?>',
                                disabled: true,
                                iconCls: 'refresh-icon',
                                handler: replaceASN
                                }
                       ]
            });
            
            var newasiatarkastajaform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/addasiatarkastaja",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_asiatarkastaja',
                    name : 'ostoreskontra_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->asiatarkastaja ?>',
                    id: 'ostoreskontra_user_id_asiatarkastaja',
                    name : 'user_id',
            		hiddenName: 'user_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeAddasiatarkastaja,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		}
                ]
            });

            function createAS() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newaswin) {
                    newaswin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'as-new',
                                //layout : 'fit',
                                width : 480,
                                height : 200,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->newasiatarkastaja ?>',
                                items : [newasiatarkastajaform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/addasiatarkastaja";
                                                	
                                                	if(newasiatarkastajaform.getForm().isValid()){
                    									newaswin.hide();
                    									newasiatarkastajaform
                                                                .getForm()
                                                                .submit(
                                                                        {
                                                                            waitMsg : '<?= $this->sending ?>',
                                                                            url : url,
                                                                            success : function(
                                                                                    form, action) {
                                                                            	//newasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
                                                                                //myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->success ?>',
                                                                                        json.msg);
                                                                                //store.reload();
                                                                                var ostoreskontra_id = readCookie('ostoreskontra_id');
                                                                                Ext.getCmp('ostoreskontra_id_asiatarkastaja').setValue(ostoreskontra_id);
                                                                				Ext.getCmp('ostoreskontra_id_hyvaksyja').setValue(ostoreskontra_id);
                                                                                Ext.getCmp('delete_asiatarkastajat-grid').disable();
                                                                                storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeAsiatarkastajat.reload();
                                                                				storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeAddasiatarkastaja.reload();
                                                                				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeHistory.reload();
                                                                				Ext.getCmp('ostoreskontra_user_id_asiatarkastaja').setValue("");
                                                                				
                                                                            },
                                                                            failure : function(
                                                                                    form, action) {
                                                                            	//newasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
                    															//viitenumero_auto.getForm().reset();
                    															//myaccount_password_auto.getForm().reset();
                                                                            	Ext.getCmp('ostoreskontra_user_id_asiatarkastaja').setValue("");
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
                                            	//newasiatarkastajaform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	Ext.getCmp('ostoreskontra_user_id_asiatarkastaja').setValue("");
                                                newaswin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newaswin.show(this);
            }
            
            var replaceasiatarkastajaform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/replaceasiatarkastaja",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_replace_asiatarkastaja',
                    name : 'relation_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->asiatarkastaja ?>',
                    name : 'user_id',
            		hiddenName: 'user_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeReplaceasiatarkastaja,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		}
                ]
            });

            function replaceAS() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replaceaswin) {
                	replaceaswin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'as-replace',
                                //layout : 'fit',
                                width : 480,
                                height : 100,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->replaceasiatarkastaja ?>',
                                items : [replaceasiatarkastajaform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/replaceasiatarkastaja";
                                                	
                                                	if(replaceasiatarkastajaform.getForm().isValid()){
                                                		replaceaswin.hide();
                    									replaceasiatarkastajaform
                                                                .getForm()
                                                                .submit(
                                                                        {
                                                                            waitMsg : '<?= $this->sending ?>',
                                                                            url : url,
                                                                            success : function(
                                                                                    form, action) {
                                                                            	//replaceasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
                                                                                //myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->success ?>',
                                                                                        json.msg);
                                                                                //store.reload();
                                                                                Ext.getCmp('delete_asiatarkastajat-grid').disable();
                                                                                Ext.getCmp('replace_asiatarkastajat-grid').disable();
                                                                                Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
                                                                                storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeAsiatarkastajat.reload();
                                                                				storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeAddasiatarkastaja.reload();
                                                                				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeHistory.reload();
                                                                				gridAsiatarkastajat.selModel.clearSelections();
                                                                				
                                                                            },
                                                                            failure : function(
                                                                                    form, action) {
                                                                            	//replaceasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
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
                                            	//replaceasiatarkastajaform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                replaceaswin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replaceaswin.show(this);
            }
            
            var replacenextasiatarkastajaform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/replacenextasiatarkastaja",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_replace_and_next_user_asiatarkastaja',
                    name : 'relation_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->asiatarkastaja ?>',
                    name : 'user_id',
            		hiddenName: 'user_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeReplaceasiatarkastaja,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		}
                ]
            });

            function replaceASN() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replacenextaswin) {
                	replacenextaswin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'asn-replace',
                                //layout : 'fit',
                                width : 480,
                                height : 100,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->replaceasiatarkastaja ?>',
                                items : [replacenextasiatarkastajaform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/replacenextasiatarkastaja";
                                                	
                                                	if(replacenextasiatarkastajaform.getForm().isValid()){
                                                		replacenextaswin.hide();
                                                		replacenextasiatarkastajaform
                                                                .getForm()
                                                                .submit(
                                                                        {
                                                                            waitMsg : '<?= $this->sending ?>',
                                                                            url : url,
                                                                            success : function(
                                                                                    form, action) {
                                                                            	//replacenextasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
                                                                                //myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->success ?>',
                                                                                        json.msg);
                                                                                //store.reload();
                                                                                Ext.getCmp('delete_asiatarkastajat-grid').disable();
                                                                                Ext.getCmp('replace_asiatarkastajat-grid').disable();
                                                                                Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
                                                                                storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeAsiatarkastajat.reload();
                                                                				storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeAddasiatarkastaja.reload();
                                                                				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeHistory.reload();
                                                                				gridAsiatarkastajat.selModel.clearSelections();
                                                                				
                                                                            },
                                                                            failure : function(
                                                                                    form, action) {
                                                                            	//replacenextasiatarkastajaform
                                                                                //        .getForm()
                                                                                //        .reset();
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
                                            	//replacenextasiatarkastajaform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                replacenextaswin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replacenextaswin.show(this);
            }
            
            // create the data store
            var storeHyvaksyjat = new Ext.data.Store({
                    url: '/zf/public/ostoreskontra/json/hyvaksyjat',
                    reader: new Ext.data.JsonReader({root: 'hyvaksyjat',
                        totalProperty: 'totalCount',id: 'relation_id'}, 
                            [{name: 'relation_id',type: 'int'},
                             {name: 'order_id',type: 'int'},
                             {name: 'user',type: 'string'},
                             {name: 'kasitelty',type: 'string'}]),
                            sortInfo:{field: 'order_id', direction: "ASC"}
                        });
                        
            storeHyvaksyjat.load();
            
            var storeReplacehyvaksyja = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/replacehyvaksyjat',
					scope: this
				})
				, baseParams: {
					task: "replacehyvaksyjat"
				}
				, reader: new Ext.data.JsonReader ({
					totalProperty: 'totalCount'
					, root: 'hyvaksyjat_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
            storeReplacehyvaksyja.loadData;
            storeReplacehyvaksyja.load();
            
           // create the Grid
            var gridHyvaksyjat = new Ext.grid.EditorGridPanel({
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
                width: Ext.lib.Dom.getViewWidth()-550,
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
                    }),
                tbar: ['-',{
                    id: 'add_hyvaksyjat-grid',
                	text: '<?= $this->add_hyvaksyja ?>',
                    tooltip: '<?= $this->add_hyvaksyja_tooltip ?>',
                    disabled: true,
                    iconCls: 'refresh-icon',
                    handler: createHY
                    },
                    {
                        id: 'delete_hyvaksyjat-grid',
                    	text: '<?= $this->delete_hyvaksyja ?>',
                        tooltip: '<?= $this->delete_hyvaksyja_tooltip ?>',
                        disabled: true,
                        iconCls: 'refresh-icon',
                        handler: deleteHY
                        },
                        {
                            id: 'replace_and_next_user_hyvaksyja-grid',
                        	text: '<?= $this->replace_and_next_user_hyvaksyja ?>',
                            tooltip: '<?= $this->replace_and_next_user_hyvaksyja_tooltip ?>',
                            disabled: true,
                            iconCls: 'refresh-icon',
                            handler: replaceHYN
                            }],
                   bbar: ['-',
                	   {
                        id: 'remove_all-grid',
                       	text: '<?= $this->remove_all ?>',
                           tooltip: '<?= $this->remove_all_tooltip ?>',
                           disabled: true,
                           iconCls: 'refresh-icon',
                           handler: removeALL
                           }]
            });
            
            var storeAddhyvaksyja = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/ostoreskontra/json/addhyvaksyjat',
					scope: this
				})
				, baseParams: {
					task: "addhyvaksyja"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'hyvaksyjat_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
            storeAddhyvaksyja.loadData;
            storeAddhyvaksyja.load();
            
            var newhyvaksyjatform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/addhyvaksyja",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_hyvaksyja',
                    name : 'ostoreskontra_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->hyvaksyja ?>',
                    id: 'ostoreskontra_user_id_hyvaksyja',
                    name : 'user_id',
            		hiddenName: 'user_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeAddhyvaksyja,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		}
                ]
            });

            function createHY() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newhywin) {
                    newhywin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'hy-new',
                                //layout : 'fit',
                                width : 480,
                                height : 200,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->newhyvaksyja ?>',
                                items : [newhyvaksyjatform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/addhyvaksyja";
                                                	
                                                	if(newhyvaksyjatform.getForm().isValid()){
                    									newhywin.hide();
                    									newhyvaksyjatform
                                                                .getForm()
                                                                .submit(
                                                                        {
                                                                            waitMsg : '<?= $this->sending ?>',
                                                                            url : url,
                                                                            success : function(
                                                                                    form, action) {
                                                                            	//newhyvaksyjatform
                                                                                //        .getForm()
                                                                                //        .reset();
                                                                                //myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->success ?>',
                                                                                        json.msg);
                                                                                //store.reload();
                                                                                var ostoreskontra_id = readCookie('ostoreskontra_id');
                                                                                Ext.getCmp('ostoreskontra_id_asiatarkastaja').setValue(ostoreskontra_id);
                                                                				Ext.getCmp('ostoreskontra_id_hyvaksyja').setValue(ostoreskontra_id);
                                                                                Ext.getCmp('delete_hyvaksyjat-grid').disable();
                                                                                Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
                                                                                storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeHyvaksyjat.reload();
                                                                				storeAddhyvaksyja.proxy.conn.url = "/zf/public/ostoreskontra/json/addhyvaksyjat?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeAddhyvaksyja.reload();
                                                                				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+ostoreskontra_id;
                                                                				storeHistory.reload();
                                                                				Ext.getCmp('ostoreskontra_user_id_hyvaksyja').setValue("");
                                                                				
                                                                            },
                                                                            failure : function(
                                                                                    form, action) {
                                                                            	//newhyvaksyjatform
                                                                                //        .getForm()
                                                                                //        .reset();
                    															//viitenumero_auto.getForm().reset();
                    															//myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                        .alert(
                                                                                                '<?= $this->error ?>',
                                                                                                json.msg);
                                                                                Ext.getCmp('ostoreskontra_user_id_hyvaksyja').setValue("");
                                                                                }
                                                                        });
                    													}
                                                	
                                                
                                            }
                                        }, {
                                            text : '<?= $this->close ?>',
                                            handler : function() {
                                            	//newhyvaksyjatform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	Ext.getCmp('ostoreskontra_user_id_hyvaksyja').setValue("");
                                                newhywin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newhywin.show(this);
            }
            
            var replacenexthyvaksyjaform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/ostoreskontra/json/replacenextasiatarkastaja",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [{
                    fieldLabel : 'ID',
                    id : 'ostoreskontra_id_replace_and_next_user_hyvaksyja',
                    name : 'relation_id',
                    allowBlank : false,
                    xtype:'textfield',
                    hidden:true
                },{
                    fieldLabel : '<?= $this->hyvaksyja ?>',
                    name : 'user_id',
            		hiddenName: 'user_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeReplacehyvaksyja,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		}
                ]
            });

            function replaceHYN() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replacenexthywin) {
                	replacenexthywin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'hyn-replace',
                                //layout : 'fit',
                                width : 480,
                                height : 100,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->replacehyvaksyja ?>',
                                items : [replacenexthyvaksyjaform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/ostoreskontra/json/replacenexthyvaksyja";
                                                	
                                                	if(replacenexthyvaksyjaform.getForm().isValid()){
                                                		replacenexthywin.hide();
                                                		replacenexthyvaksyjaform
                                                                .getForm()
                                                                .submit(
                                                                        {
                                                                            waitMsg : '<?= $this->sending ?>',
                                                                            url : url,
                                                                            success : function(
                                                                                    form, action) {
                                                                            	//replacenexthyvaksyjaform
                                                                                //        .getForm()
                                                                                //        .reset();
                                                                                //myaccount_password_auto.getForm().reset();
                    															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                                Ext.MessageBox
                                                                                .alert(
                                                                                        '<?= $this->success ?>',
                                                                                        json.msg);
                                                                                //store.reload();
                                                                                Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
                                                                                Ext.getCmp('delete_hyvaksyjat-grid').disable();
                                                                                storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeHyvaksyjat.reload();
                                                                				storeAddhyvaksyja.proxy.conn.url = "/zf/public/ostoreskontra/json/addhyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeAddhyvaksyja.reload();
                                                                				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
                                                                				storeHistory.reload();
                                                                				gridHyvaksyjat.selModel.clearSelections();
                                                                				
                                                                            },
                                                                            failure : function(
                                                                                    form, action) {
                                                                            	//replacenexthyvaksyjaform
                                                                                //        .getForm()
                                                                                //        .reset();
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
                                            	//replacenexthyvaksyjaform.getForm().reset();
                                                //viitenumero_auto.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                            	replacenexthywin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replacenexthywin.show(this);
            }
            
            var invoice_handlers = new Ext.Panel({
                id:'invoice-handlers-panel',
                title: '<?= $this->invoice_handlers ?>',
                //width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight(),
                baseCls:'x-plain',
                //renderTo: 'ApplicationForm',
                //layout:'table',
                //layoutConfig: {columns:1},
                // applied to child components'
                //height: Ext.lib.Dom.getViewHeight(),
                layout:'column',
                defaults: {frame:false},
                items:[gridAsiatarkastajat, gridHyvaksyjat ]
            });
            
            var tabs_right = new Ext.TabPanel({
                //renderTo: 'ApplicationForm',
                width: Ext.lib.Dom.getViewWidth() - 550,
                height: Ext.lib.Dom.getViewHeight(),
                activeTab: 0,
                deferredRender: false,
                autoTabs: true,
                frame:true,
                defaults:{autoHeight: false},
                items:[
                    //gridTilit,
                    forminvoicedetails,
                    invoice_handlers,
                    gridTilit,
                    gridHistory
                ]
            });
            
            var panel = new Ext.Panel({
                id:'main-panel',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                //baseCls:'x-plain',
                renderTo: 'ApplicationForm',
                layout:'table',
                layoutConfig: {columns:2},
                // applied to child components
                defaults: {frame:false},
                items:[tabs_left,tabs_right]
            });
            
            gridAsiatarkastajat.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	Ext.getCmp('delete_asiatarkastajat-grid').enable();
            	Ext.getCmp('replace_asiatarkastajat-grid').enable();
            	Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').enable();
            	Ext.getCmp('ostoreskontra_id_replace_asiatarkastaja').setValue(r.get('relation_id'));
            	Ext.getCmp('ostoreskontra_id_replace_and_next_user_asiatarkastaja').setValue(r.get('relation_id'));
            });
            
            gridHyvaksyjat.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	Ext.getCmp('delete_hyvaksyjat-grid').enable();
            	Ext.getCmp('replace_and_next_user_hyvaksyja-grid').enable();
            	Ext.getCmp('ostoreskontra_id_replace_and_next_user_hyvaksyja').setValue(r.get('relation_id'));
            });
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {

            	Ext.getCmp('download').enable();
            	Ext.getCmp('replace').enable();
            	//Ext.getCmp('tilit-submit').enable();
            	//Ext.getCmp('tilit-reset').enable();
            	Ext.getCmp('download').enable();
				Ext.getCmp('invoice-submit').enable();
				//Ext.getCmp('lisaa-uusi-tili').enable();
				Ext.getCmp('poista-tili').disable();
				//Ext.getCmp('delete-invoice').enable();
				Ext.getCmp('refresh-history').enable();
				//Ext.getCmp('refresh-tilit').enable();
				Ext.getCmp('add_asiatarkastajat-grid').enable();
				Ext.getCmp('add_hyvaksyjat-grid').enable();
				Ext.getCmp('replace_asiatarkastajat-grid').disable();
				Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
				Ext.getCmp('delete_asiatarkastajat-grid').disable();
				Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
				Ext.getCmp('delete_hyvaksyjat-grid').disable();
				Ext.getCmp('xls').enable();
				Ext.getCmp('refresh-tilit').enable();
				Ext.getCmp('remove_all-grid').enable();
				//alert('test');
				Ext.getCmp('lisaa-uusi-tili-kymmenen').enable();
				//Ext.getCmp('tilit').enable();
            	//Ext.getCmp('tilit').setValue(r.get('tili_id'));
            	//Ext.getCmp('ostoreskontra_id').setValue(r.get('ostoreskontra_id'));
				Ext.getCmp('ostoreskontra_invoice_id').setValue(r.get('ostoreskontra_id'));
				//Ext.getCmp('ostoreskontra_id_tili').setValue(r.get('ostoreskontra_id'));
				Ext.getCmp('mml_viite_invoice').setValue(r.get('mml_viite'));
				Ext.getCmp('pankkimaksu_viite_invoice').setValue(r.get('pankkimaksu_viite'));
				//Ext.getCmp('kustannuspaikka_id_invoice').setValue(r.get('kustannuspaikka_id'));
				//Ext.getCmp('projekti_id_invoice').setValue(r.get('projekti_id'));
				//Ext.getCmp('created_by_invoice').setValue(r.get('created_by_user'));
				//Ext.getCmp('seuraava_kasittelija_id_invoice').setValue(r.get('seuraava_kasittelija_id'));
				Ext.getCmp('toimitusehto_invoice').setValue(r.get('toimitusehto'));
				Ext.getCmp('laskun_rahti_invoice').setValue(r.get('rahti'));
				Ext.getCmp('laskun_pvm_invoice').setValue(r.get('laskun_pvm'));
				Ext.getCmp('laskun_summa_veroton_invoice').setValue(r.get('laskun_summa_veroton'));
				Ext.getCmp('maksuehto_string_invoice').setValue(r.get('maksuehto_string'));
				Ext.getCmp('veron_osuus_invoice').setValue(r.get('veron_osuus'));
				Ext.getCmp('message_invoice').setValue(r.get('message'));
				Ext.getCmp('ostoreskontra_id_asiatarkastaja').setValue(r.get('ostoreskontra_id'));
				Ext.getCmp('ostoreskontra_id_hyvaksyja').setValue(r.get('ostoreskontra_id'));
				
				//var alv = r.get('veroprosentti');
				//var sum = r.get('laskun_summa_veroton');
				//var tax = sum * alv;
				//var sum_total = sum + tax;
				
				//Ext.getCmp('laskun_veron_osuus_invoice').setValue(tax);
				Ext.getCmp('laskun_summa_verollinen_invoice').setValue(r.get('laskun_summa_verollinen'));
				
				//Ext.getCmp('laskun_summa_verollinen_invoice').label.update('Laskun summa ('+100*alv+' % ALV)');
				
				//alert(r.get('laskun_pvm'));
				
				//var dueDate = new Date(r.get('laskun_pvm')).add(Date.DAY, +14);
				
				Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id='+r.get('ostoreskontra_id'));
				
				Ext.getCmp('laskunera_pvm_invoice').setValue(r.get('laskunera_pvm'));
				
				Ext.getCmp('replace_id').setValue(r.get('ostoreskontra_id'));
				
				createCookie("ostoreskontra_id", r.get('ostoreskontra_id'), 31);
				createCookie("maksuehto", r.get('maksuehto_paivaa'), 31);
				
				createCookie("total_sum", parseFloat(r.get('laskun_summa_verollinen')), 31);
				
				gridTilit.store.clearData();
      		    gridTilit.view.refresh();
				
				storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeTilit.reload();
				
				createCookie("tilitLoaded", "false", 31);
				
				storeTili.reload();
	            storeKustannuspaikka.reload();
	            storeProjektit.reload();
				
				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeHistory.reload();
				
				storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeAsiatarkastajat.reload();
				
				storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeAddasiatarkastaja.reload();
				
				storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeHyvaksyjat.reload();
				
				storeAddhyvaksyja.proxy.conn.url = "/zf/public/ostoreskontra/json/addhyvaksyjat?ostoreskontra_id="+r.get('ostoreskontra_id');
				storeAddhyvaksyja.reload();
				
				//alert(storeHyvaksyjat.getTotalCount());
				
             });
            
            /*storeSeuraavakasittelija.on('beforeload', function() {
            	store.load({params: { "start":0, "limit":50, "query":"" }});
			});*/
            
            storeAddasiatarkastaja.on('load', function() {
            	var countAsiatarkastaja = storeAddasiatarkastaja.getTotalCount();
            	//alert(countAsiatarkastaja);
            	var ostoreskontra_id = readCookie('ostoreskontra_id');
            	//alert(ostoreskontra_id);
            	if (ostoreskontra_id==0) {
            		Ext.getCmp('add_asiatarkastajat-grid').disable();
            	} else {
	            	if (countAsiatarkastaja==0) {
	            		Ext.getCmp('add_asiatarkastajat-grid').disable();
	            	} else {
	            		Ext.getCmp('add_asiatarkastajat-grid').enable();
	            	}
            	}
            });
            
            /*storeHyvaksyjat.on('load', function() {
            	//var countHyvaksyjat = storeHyvaksyjat.getTotalCount();
            	var ostoreskontra_id = readCookie('ostoreskontra_id');
            	//alert(ostoreskontra_id);
            	if (ostoreskontra_id==0) {
            		Ext.getCmp('add_hyvaksyjat-grid').disable();
            	} else {
		        	//if (countHyvaksyjat==0) {
		        	//	Ext.getCmp('add_hyvaksyjat-grid').disable();
		        	//} else if (countHyvaksyjat>=1) {
		        		//Ext.getCmp('add_hyvaksyjat-grid').disable();
		        	//} else {
		        		Ext.getCmp('add_hyvaksyjat-grid').enable();
		        	//}
            	}
            });*/
            
            storeAddhyvaksyja.on('load', function() {
            	var countHyvaksyja = storeAddhyvaksyja.getTotalCount();
            	//alert(countAsiatarkastaja);
            	var ostoreskontra_id = readCookie('ostoreskontra_id');
            	//alert(ostoreskontra_id);
            	if (ostoreskontra_id==0) {
            		Ext.getCmp('add_hyvaksyjat-grid').disable();
            	} else {
	            	if (countHyvaksyja==0) {
	            		Ext.getCmp('add_hyvaksyjat-grid').disable();
	            	} else {
	            		Ext.getCmp('add_hyvaksyjat-grid').enable();
	            	}
            	}
            });
            
            storeStatus.on('load', function() {
            	
            	var storeLoaded = readCookie('storeLoaded');
            	
            	if (storeLoaded==="false") {
            	store.load({params: { "start":0, "limit":1000, "query":"" }});
            	createCookie("storeLoaded", "true", 31);
            	}
            	
			});
            
           storeMaksatus.on('load', function() {
            	
            	//var storeLoaded = readCookie('storeLoaded');
            	
            	//if (storeLoaded==="false") {
            	//store.load({params: { "start":0, "limit":50, "query":"" }});
            	//createCookie("storeLoaded", "true", 31);
            	//}
        	   
        	   store.reload();
            	
			});
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/ostoreskontra/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.ostoreskontra_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        store.commitChanges();
						//storechart.loadData();
						store.reload();
						storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+ Grid_Event.record.data.ostoreskontra_id;
						storeHistory.reload();
                    }      
                    , scope: this
                });
            };
            
            function saveTilitEdit (Grid_Event) {
            	
            	//alert(Grid_Event.value);
            	
            	var rec = gridTilit.store.getAt(Grid_Event.row);
            	
            	var colIndex = Grid_Event.column;
            	var rowIndex = Grid_Event.row;
            	var cm = Ext.getCmp('grid-tilit').getColumnModel();
            	var valCol = cm.getColumnAt(colIndex);
            	var count = gridTilit.getStore().getTotalCount();
            	
            	var cellXtype = valCol.getEditor().getXType();
            	
            	var cell = gridTilit.getView().getCell(rowIndex, colIndex);
            	
            	var colname = Grid_Event.field;
            	
            	var value;
            	
            	if (cellXtype=="textfield") {
            		value = parseFloat(Grid_Event.value.replace(",", "."));
            		rec.set(colname, value);
            	} else if (cellXtype=="combo") {
            		value = Grid_Event.value;
            	} else {
            		value = Grid_Event.value;
            	}

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/ostoreskontra/json/tilitedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.summat_id
                        , idID: Grid_Event.record.data.laskun_id
                        , field: Grid_Event.field
                        , value: value          
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        storeTilit.commitChanges();
						//storechart.loadData();
                        storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+ Grid_Event.record.data.laskun_id;
						//storeTilit.reload();
                        storeTili.reload();
        	            storeKustannuspaikka.reload();
        	            storeProjektit.reload();
                        storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+ Grid_Event.record.data.laskun_id;
						storeHistory.reload();
                    }      
                    , scope: this
                });
            };
            
            function handleDeleteTiliointi() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridTilit.selModel.selections.items;
				var selectedKeys = gridTilit.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/ostoreskontra/json/deletetiliointi'
					, params: { 
						task: "deletetiliointi"
						, deleteKeys: encoded_keys
						, key: 'summa_id'
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
						var summaId = readCookie('ostoreskontra_id');
						storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id="+summaId;
						storeTilit.reload();
						storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+summaId;
						storeHistory.reload();
						Ext.getCmp('poista-tili').disable();
						Ext.getCmp('xls').disable();
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
			
            /*function handleDeleteLasku() {
				
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
					, url: '/zf/public/ostoreskontra/json/deletelasku'
					, params: { 
						task: "deletelasku"
						, deleteKeys: encoded_keys
						, key: 'ostoreskontra_id'
						}
					, callback: function (options, success, response) {
						if (success) {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->success ?>',json.msg);
						} else {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->error ?>',json.msg);
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
						Ext.getCmp('download').disable();
                        Ext.getCmp('replace').disable();
                        //Ext.getCmp('tilit-submit').disable();
                    	//Ext.getCmp('tilit-reset').disable();
						Ext.getCmp('invoice-submit').disable();
						Ext.getCmp('lisaa-uusi-tili').disable();
						Ext.getCmp('poista-tili').disable();
						Ext.getCmp('xls').disable();
						//Ext.getCmp('delete-invoice').disable();
						grid.selModel.clearSelections();
						storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id=0";
						storeHistory.reload();
						storeTilit.proxy.conn.url = "/zf/public/ostoreskontra/json/summa?ostoreskontra_id=0";
						storeTilit.reload();
						Ext.getCmp('view_invoice_iframe').setSrc('/zf/public/ostoreskontra/json/viewinvoice?ostoreskontra_id=0');
						forminvoicedetails.getForm().reset();
						store.reload();
						//storechart.reload();
					    //storechart.loadData();
						Ext.getCmp('add_asiatarkastajat-grid').disable();
						Ext.getCmp('delete_asiatarkastajat-grid').disable();
						Ext.getCmp('add_hyvaksyjat-grid').disable();
						Ext.getCmp('delete_hyvaksyjat-grid').disable();
						storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id=0";
						storeAsiatarkastajat.reload();
						storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id=0";
        				storeHyvaksyjat.reload();
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};*/
			
            function deleteAS() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridAsiatarkastajat.selModel.selections.items;
				var selectedKeys = gridAsiatarkastajat.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/ostoreskontra/json/deleteas'
					, params: { 
						task: "deleteas"
						, deleteKeys: encoded_keys
						, key: 'relation_id'
						}
					, callback: function (options, success, response) {
						if (success) {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->success ?>',json.msg);
						} else {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->error ?>',json.msg);
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
						Ext.getCmp('delete_hyvaksyjat-grid').disable();
						Ext.getCmp('delete_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
						storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
						storeAsiatarkastajat.reload();
						storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
        				storeAddasiatarkastaja.reload();
        				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
        				storeHistory.reload();
                        //Ext.getCmp('replace').disable();
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
			
            function deleteHY() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridHyvaksyjat.selModel.selections.items;
				var selectedKeys = gridHyvaksyjat.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/ostoreskontra/json/deletehy'
					, params: { 
						task: "deletehy"
						, deleteKeys: encoded_keys
						, key: 'relation_id'
						}
					, callback: function (options, success, response) {
						if (success) {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->success ?>',json.msg);
						} else {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->error ?>',json.msg);
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
						} // end ifdeleteAS
						Ext.getCmp('delete_hyvaksyjat-grid').disable();
						Ext.getCmp('delete_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_and_next_user_asiatarkastajat-grid').disable();
						Ext.getCmp('replace_and_next_user_hyvaksyja-grid').disable();
						storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
						storeHyvaksyjat.reload();
						storeAddhyvaksyja.proxy.conn.url = "/zf/public/ostoreskontra/json/addhyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
        				storeAddhyvaksyja.reload();
        				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
        				storeHistory.reload();
                        //Ext.getCmp('replace').disable();
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
			
            function removeALL() {
				
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
					, url: '/zf/public/ostoreskontra/json/removeall'
					, params: { 
						task: "removeall"
						, deleteKeys: encoded_keys
						, key: 'ostoreskontra_id'
						}
					, callback: function (options, success, response) {
						if (success) {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->success ?>',json.msg);
						} else {
							var json = Ext.util.JSON.decode(response.responseText);
							Ext.MessageBox.alert('<?= $this->error ?>',json.msg);
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
						Ext.getCmp('remove_all-grid').disable();
						Ext.getCmp('delete_hyvaksyjat-grid').disable();
						storeAsiatarkastajat.proxy.conn.url = "/zf/public/ostoreskontra/json/asiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
						storeAsiatarkastajat.reload();
						storeAddasiatarkastaja.proxy.conn.url = "/zf/public/ostoreskontra/json/addasiatarkastajat?ostoreskontra_id="+json.ostoreskontra_id;
        				storeAddasiatarkastaja.reload();
						storeHyvaksyjat.proxy.conn.url = "/zf/public/ostoreskontra/json/hyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
						storeHyvaksyjat.reload();
						storeAddhyvaksyja.proxy.conn.url = "/zf/public/ostoreskontra/json/addhyvaksyjat?ostoreskontra_id="+json.ostoreskontra_id;
        				storeAddhyvaksyja.reload();
        				storeHistory.proxy.conn.url = "/zf/public/ostoreskontra/json/history?ostoreskontra_id="+json.ostoreskontra_id;
        				storeHistory.reload();
                        //Ext.getCmp('replace').disable();
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
			
            function handleMaksata() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuretext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {
					                	 
					                	  window.location = '/zf/public/ostoreskontra/json/xml';
				                          
				                          store.reload();
				                          
				                          storeMaksatus.reload();
				                          
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
			gridTilit.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				Ext.getCmp('poista-tili').enable();
			});
            
            grid.addListener('afteredit', saveGridEdit, this);
            gridTilit.addListener('afteredit', saveTilitEdit, this);
            
            <?php if ($this->redirect) { ?>
            
            store.on('load', function() {
            	
            var record = store.getById(<?= $this->redirect ?>),
            rowIndex = store.indexOf(record);
            
            grid.getSelectionModel().selectRow(rowIndex);
            
            //alert(rowIndex);
            
            });
            
            <?php } else { ?>
           
            <?php } ?>
            
            // render the grid to the specified div in the page
            //grid.render('ApplicationForm');
            
            var conn = new Ext.data.Connection();
            
            Ext.TaskMgr.start({
      		  run: function() {

      		conn 
      		.request( { 
      		url : '/zf/public/ostoreskontra/json/ismaksatus', 
      		method : 'POST', 
      		success : function(responseObject) { 
      		 
      		var json = Ext.util.JSON.decode(responseObject.responseText); 
      		 
      		if (json.success == true) {
      			Ext.getCmp('xml').enable();
      		} else {
      			//document.location = '/zf/public/index/logout';
      			Ext.getCmp('xml').disable();
      		} 
      		 
      		}, 
      		failure : function(responseObject) {
      		 
      		} 
      		});

      		  },
      		  interval: 3000
      		});
            
            function resize() {
            	
            	//alert(Ext.lib.Dom.getViewWidth()+"x"+Ext.lib.Dom.getViewHeight());
            	
            	var x_y_z = Ext.getBody().getHeight();
            	
            	panel.setHeight(x_y_z);
            	panel.setWidth(Ext.lib.Dom.getViewWidth());
            	forminvoicedetails.setHeight(x_y_z);
            	gridTilit.setHeight(x_y_z);
            	gridHistory.setHeight(x_y_z);
            	
            	grid.setHeight(x_y_z);
            	
            	if (Ext.lib.Dom.getViewWidth()==1898) {
            		
            		tabs_right.setWidth((Ext.lib.Dom.getViewWidth() - 1000));
            		tabs_left.setWidth(1000);
            		//grid.view.forceFit=true;
            		panel.setHeight(Ext.lib.Dom.getViewHeight());
                	//panel.setWidth(Ext.lib.Dom.getViewWidth());
                	forminvoicedetails.setHeight(Ext.lib.Dom.getViewHeight());
                	gridTilit.setHeight(Ext.lib.Dom.getViewHeight());
                	gridHistory.setHeight(Ext.lib.Dom.getViewHeight());
                	
                	/*grid.headerCt.forceFit = true;
                	grid.headerCt.doComponentLayout();
                	grid.doComponentLayout();*/
            		
            	} else {
            		tabs_right.setWidth((Ext.lib.Dom.getViewWidth() - 550));
            		tabs_left.setWidth(550);
            		//grid.view.forceFit=false;
            		
            		/*grid.headerCt.forceFit = false;
            		grid.headerCt.doComponentLayout();
            		grid.doComponentLayout();*/
            		
            	}
            	
        	}
        	
            Ext.EventManager.onWindowResize(resize);
        	
        	Ext.EventManager.onDocumentReady(resize);
        	
        	/*Ext.TaskMgr.start({
        		run: function () {
        		
        				var x_y_z = Ext.getBody().getViewHeight();
		            	
		            	panel.setHeight(x_y_z);
		            	panel.setWidth(Ext.lib.Dom.getViewWidth());
		            	forminvoicedetails.setHeight(x_y_z);
		            	gridTilit.setHeight(x_y_z);
		            	gridHistory.setHeight(x_y_z);
		            	
		            	grid.setHeight(x_y_z);
		            	
		            	if (Ext.lib.Dom.getViewWidth()==1898) {
		            		
		            		tabs_right.setWidth((Ext.lib.Dom.getViewWidth() - 1000));
		            		tabs_left.setWidth(1000);
		            		//grid.view.forceFit=true;
		            		panel.setHeight(Ext.lib.Dom.getViewHeight());
		                	//panel.setWidth(Ext.lib.Dom.getViewWidth());
		                	forminvoicedetails.setHeight(Ext.lib.Dom.getViewHeight());
		                	gridTilit.setHeight(Ext.lib.Dom.getViewHeight());
		                	gridHistory.setHeight(Ext.lib.Dom.getViewHeight());
		                	
		                	/*grid.headerCt.forceFit = true;
		                	grid.headerCt.doComponentLayout();
		                	grid.doComponentLayout();*/
		            		
		            	/*} else {
		            		tabs_right.setWidth((Ext.lib.Dom.getViewWidth() - 550));
		            		tabs_left.setWidth(550);
		            		//grid.view.forceFit=false;
		            		
		            		/*grid.headerCt.forceFit = false;
		            		grid.headerCt.doComponentLayout();
		            		grid.doComponentLayout();*/
		            		
		            	/*}
		            	
        		},
        		  interval: 3000
        		});*/
            
 });