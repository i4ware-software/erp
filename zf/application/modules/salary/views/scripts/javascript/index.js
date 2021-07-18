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
            //var fm = Ext.form;
            //var newwin;
            
            // turn on validation errors beside the field globally
            Ext.form.Field.prototype.msgTarget = 'side';	
            
            /*var myData = [
				['3m Co', 'USA', 82167],
				['Alcoa Inc', 'FRANCE', 12342]
				]*/
            
            //var myData = '[{"salary_id":"1","company_name":"Sant Esteve de Palautordera"}]';
				
				//you have two rows and each rows with three data, separet with ' , '.
				
				
				
				// create the data store
				/*var store = new Ext.data.SimpleStore({
				fields: [
				{name: 'salary_id'},
				{name: 'company_name' }
				]
				});*/
				
				//have the simpleStore object with three columns "company, country, condeZip"
				
				
				// now you need fire the metod loadData
				
				//store.loadData(alert(myData));
            
            //var data = '[{"salary_id":"1","company_name":"Sant Esteve de Palautordera"}]';

            /*var mystore = new Ext.data.JsonStore({
                //autoload: true,
            	storeId: 'myStore',
            	proxy: {
                    type: 'ajax',
                    url: '/zf/public/json/salary/index',
                    reader: {
                        type: 'json',
                        root: 'salary_payment_basic_settings',
                        idProperty: 'salary_id'
                    }
                },
                fields: [ 
                    {type: 'integer', name: 'salary_id'},
                    {type: 'string', name: 'company_name'}
                ]
            });
            
            Ext.getStore('myStore').loadData(Ext.decode(data)); // decode data, because it is in encoded in string
            
            //alert(mystore.getById('company_name'));
            
            //Ext.getStore('myStore').loadData(mystore.getById('company_name'));
            
            /*mystore.loadData(Ext.decode(data)); // decode data, because it is in encoded in string
             * 
             * 

            var cbxSelDomini = new Ext.form.ComboBox({
                hiddenName: 'Domini',
                name: 'nom_domini',
                displayField: 'nom_domini',
                valueField: 'cod_domini',
                mode: 'local',
                triggerAction: 'all',
                listClass: 'comboalign',
                typeAhead: true,
                forceSelection: true,
                selectOnFocus: true,
                store: mystore
            });*/
            
            //var store = new Ext.data.Store({
            	//autoLoad : true,
            	//id: 'storeId',
                /*reader: new Ext.data.JsonReader({root: 'salary_payment_basic_settings',
                    totalProperty: 'totalCount',id: 'salary_id'}, 
                        [// map Record's 'firstname' field to data object's key of same name
                            {name: 'company_name'},
                            // map Record's 'job' field to data object's 'occupation' key
                            {name: 'contact_person'}]),
                        //baseParams: { "limit":50 },
                        //sortInfo:{field: 'salary_id', direction: "DESC"},
                        //remoteSort: true
                         // store configs
                        autoDestroy: true,
                        //url: 'get-images.php',
                        storeId: 'salary_id',
                        // reader configs
                        root: 'salary_payment_basic_settings',
                        idProperty: 'salary_id',
             });
            
            store.load({params: { "start":0, "limit":50, "query":"" }});
            
            // turn on validation errors beside the field globally
            Ext.form.Field.prototype.msgTarget = 'side';*/
            
            //var store = Ext.getStore('storeId');
            //store.loadData(arr.month)
            //alert(store.loadData(arr.month));
            
            var myRecord = new Ext.data.Record.create([
            {
                name: 'company_name'
            },
            {
                name: 'contact_person'
            },
            {
                name: 'phone'
            },
            {
                name: 'address'
            },
            {
                name: 'zip_code'
            },
            {
                name: 'zip'
            },
            {
                name: 'country'
            },
            {
                name: 'vat_number'
            },
            {
                name: 'payment_number'
            },
            {
                name: 'BIC'
            },
            {
                name: 'IBAN'
            },
            {
                name: 'bank_account'
            },
            {
                name: 'year'
            },
            {
                name: 'sotu'
            },
            {
                name: 'TyEL_nro_vuositili'
            },
            {
                name: 'TyEL_nro_kk_tilitys'
            },
            {
                name: 'KuEL_tunnus'
            },
            {
                name: 'KuEL'
            },
            {
                name: 'tyontekelake'
            },
            {
                name: 'var53v_tyont_el'
            },
            {
                name: 'tyottomyysvakuutus'
            },
            {
                name: 'paivarahamaksu'
            },
            {
                name: 'paivarahamyritt'
            },
            {
                name: 'vastuuvakuutusmaksu'
            },
            {
                name: 'ryhmahvakuutus'
            },
            {
                name: 'tapaturmavakuutus'
            },
            {
                name: 'paivaraha'
            },
            {
                name: 'osapaivaraha'
            },
            {
                name: 'kilometrikorvaus'
            },
            {
                name: 'tyontekELMtili'
            },
            {
                name: 'tyontekTTVakTili'
            },
            {
                name: 'AyJsmTili'
            },
            {
                name: 'Sotu_maksutili'
            },
            {
                name: 'SotuVelkaTili'
            },{
            	name: 'EnnPidValkaTili'
            },{
            	name: 'TyEL_tili'
            },{
            	name: 'KVTEL_tili'
            }, {
            	name: 'tyottVakTili'
            },{
            	name: 'tapaVakaTili'
            },{
            	name: 'RyhmaHVakTili'
            },{
            	name: 'Muut_maksut_tili'
            },{
            	name: 'TyEL_Tasetili'
            },{
            	name: 'KVTEL_Tasetili'
            },{
            	name: 'TyottVakTaseTili'
            },{
            	name: 'TapaVakTaseTili'
            },{
            	name: 'RyhmaHVakTaseTili'
            },{
            	name: 'MuutTaseTili'
            },{
            	name: 'LuontaisedutTili'
            },{
            	name: 'TyELTT'
            },{
            	name: 'TyELTT53'
            },{
            	name: 'unemploymentTT'
            },{
            	name: 'unemploymentTTOver'
            },{
            	name: 'liast8to10'
            },{
            	name: 'lasat10to24'
            },{
            	name: 'su_lisat'
            }
            ]);

            var myReader = new Ext.data.JsonReader({
                successProperty: 'success',
                totalProperty: 'results',
                root: 'salary_payment_basic_settings',
                id: 'salary_id'
            },
            myRecord);
            
            var salary_payment_basic_settings = new Ext.FormPanel({
            	frame: false,
                //title:'<?= $this->salary_payment_basic_settings ?>',
                labelAlign: 'right',
                labelWidth: 320,
                //width: 800,
                //height: Ext.lib.Dom.getViewHeight(),
                waitMsgTarget: true,
                id: 'storeId',
                // configure how to read the JSON Data
                reader: myReader,
                items: [
                        new Ext.form.FieldSet({
                            title: '<?= $this->basic_settings ?>',
                            autoHeight: true,
                            defaultType: 'textfield',
                            items: [{
                                    fieldLabel: '<?= $this->company_name ?>',
                                    name: 'company_name',
                                    width:300
                                }, {
                                    fieldLabel: '<?= $this->contact_person ?>',
                                    name: 'contact_person',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->phone ?>',
                                    name: 'phone',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->address ?>',
                                    name: 'address',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->zip_code ?>',
                                    name: 'zip_code',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->zip ?>',
                                    name: 'zip',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->country ?>',
                                    name: 'country',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->company_vat_number ?>',
                                    name: 'vat_number',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->payment_number ?>',
                                    name: 'payment_number',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->bic ?>',
                                    name: 'BIC',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->iban_account ?>',
                                    name: 'IBAN',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->bank_account ?>',
                                    name: 'bank_account',
                                    width:190
                                }, {
                                    fieldLabel: '<?= $this->year ?>',
                                    name: 'year',
                                    width:190
                                }
                        ]
                  }),
                  new Ext.form.FieldSet({
                      title: '<?= $this->company_tax_and_payment_settings ?>',
                      autoHeight: true,
                      defaultType: 'textfield',
                      items: [
						{
						    fieldLabel: '<?= $this->sotu ?>',
						    name: 'sotu',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->TyEL_nro_vuositili ?>',
						    name: 'TyEL_nro_vuositili',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->TyEL_nro_kk_tilitys ?>',
						    name: 'TyEL_nro_kk_tilitys',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->KuEL_tunnus ?>',
						    name: 'KuEL_tunnus',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->KuEL ?>',
						    name: 'KuEL',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->tyontekelake ?>',
						    name: 'tyontekelake',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->var53v_tyont_el ?>',
						    name: 'var53v_tyont_el',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->tyottomyysvakuutus ?>',
						    name: 'tyottomyysvakuutus',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->paivarahamaksu ?>',
						    name: 'paivarahamaksu',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->paivarahamyritt ?>',
						    name: 'paivarahamyritt',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->vastuuvakuutusmaksu ?>',
						    name: 'vastuuvakuutusmaksu',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->ryhmahvakuutus ?>',
						    name: 'ryhmahvakuutus',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->tapaturmavakuutus ?>',
						    name: 'tapaturmavakuutus',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->paivaraha ?>',
						    name: 'paivaraha',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->osapaivaraha ?>',
						    name: 'osapaivaraha',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->kilometrikorvaus ?>',
						    name: 'kilometrikorvaus',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->TyELTT ?>',
						    name: 'TyELTT',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->TyELTT53 ?>',
						    name: 'TyELTT53',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->unemploymentTT ?>',
						    name: 'unemploymentTT',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->unemploymentTTOver ?>',
						    name: 'unemploymentTTOver',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->liast8to10 ?>',
						    name: 'liast8to10',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->lasat10to24 ?>',
						    name: 'lasat10to24',
						    width:300
						},
						{
						    fieldLabel: '<?= $this->su_lisat ?>',
						    name: 'su_lisat',
						    width:300
						}
                      ]
                  }),
                  new Ext.form.FieldSet({
                      title: '<?= $this->acconting ?>',
                      autoHeight: true,
                      defaultType: 'textfield',
                      items: [{
						    fieldLabel: '<?= $this->tyontekELMtili ?>',
						    name: 'tyontekELMtili',
						    width:300
						},{
						    fieldLabel: '<?= $this->tyontekTTVakTili ?>',
						    name: 'tyontekTTVakTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->AyJsmTili ?>',
						    name: 'AyJsmTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->Sotu_maksutili ?>',
						    name: 'Sotu_maksutili',
						    width:300
						},{
						    fieldLabel: '<?= $this->sotuvelkatili ?>',
						    name: 'SotuVelkaTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->ennpidvalkatili ?>',
						    name: 'EnnPidValkaTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->TyEL_tili ?>',
						    name: 'TyEL_tili',
						    width:300
						},{
						    fieldLabel: '<?= $this->KVTEL_tili ?>',
						    name: 'KVTEL_tili',
						    width:300
						},{
						    fieldLabel: '<?= $this->tyottVakTili ?>',
						    name: 'tyottVakTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->tapaVakaTili ?>',
						    name: 'tapaVakaTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->RyhmaHVakTili ?>',
						    name: 'RyhmaHVakTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->Muut_maksut_tili ?>',
						    name: 'Muut_maksut_tili',
						    width:300
						},{
						    fieldLabel: '<?= $this->TyEL_Tasetili ?>',
						    name: 'TyEL_Tasetili',
						    width:300
						},{
						    fieldLabel: '<?= $this->KVTEL_Tasetili ?>',
						    name: 'KVTEL_Tasetili',
						    width:300
						},{
						    fieldLabel: '<?= $this->TyottVakTaseTili ?>',
						    name: 'TyottVakTaseTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->TapaVakTaseTili ?>',
						    name: 'TapaVakTaseTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->RyhmaHVakTaseTili ?>',
						    name: 'RyhmaHVakTaseTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->MuutTaseTili ?>',
						    name: 'MuutTaseTili',
						    width:300
						},{
						    fieldLabel: '<?= $this->LuontaisedutTili ?>',
						    name: 'LuontaisedutTili',
						    width:300
						}]
                  })
               ]
         });
         
             /*salary_payment_basic_settings.getForm().load({ url: 'servletURL',
                  failure: function(form, action) {
                     Ext.Msg.alert("Load failed", action.result.errorMessage);
                     }
             });*/
            
            // explicit add
            var submit = salary_payment_basic_settings.addButton({
                text: '<?= $this->submit ?>',
                handler: function(){
                	 var url = "/zf/public/salary/json/saveconfig";
	                 //}
               	 if(salary_payment_basic_settings.getForm().isValid()){
               		 salary_payment_basic_settings.getForm().submit(
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
                                        salary_payment_basic_settings.getForm().load({
                                            url: '/zf/public/salary/json/index',
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
             
             salary_payment_basic_settings.render('SalaryGrid');
             
             salary_payment_basic_settings.getForm().load({
                 url: '/zf/public/salary/json/index',
                 waitMsg: '<?= $this->loading ?>',
                 failure: function (form, action) {
                     var json = Ext.util.JSON.decode(action.response.responseText);
                     Ext.MessageBox.alert('<?= $this->warning ?>', json.msg);
                 }
             });
             
             /*var panelStore = new Ext.data.JsonStore({ autoLoad: true,
				autoDestroy: true, url : 'servletURL',
				root: 'salary_payment_basic_settings',
				fields: ['salary_id', 'company_name'],
				listeners : {
				load: function(store, records, options){
				if(records[0]){
				alert(records[0]);
				FormPanel.getForm().loadRecord(records[0]);
				} else{
				console.log("no data!");
				}
				}
				}
				});
				
				panelStore.load();
            
            /*salary_payment_basic_settings.getForm().load({
            	  url: '/zf/public/json/salary/index'
            	});*/
            
            /*var customer_infomation = new Ext.data.Store(
            		{
            			id: 'customer_data_store',
            			proxy: new Ext.data.HttpProxy({
            				url: '/zf/public/json/salary/index',
            				method: 'POST'
            			}),
            			reader: new Ext.data.JsonReader(
            			{
            					root: 'salary_payment_basic_settings',
            					totalProperty: 1,
            					id: 'salary_id'
            			},
            			[
            				{id: 'salary_id', name: 'salary_id', type: 'int'},
            				{id: 'company_name', name: 'company_name', type: 'string'}
            			])
            		});

            		/*customer_infomation.load(
            		{
            			params:
            			{
            				id: AppData.target_customer
            			}
            		});*/

            		//alert(customer_infomation.getById('salary_id'));
            
         /*salary_payment_basic_settings.render('SalaryGrid');
         
         salary_payment_basic_settings.on('load', function()
        		 {
        		 	//alert(customer_infomation.getById(AppData.target_customer));
        	        var salary_payment_basic_settings = salary_payment_basic_settings.items.get(0).items.get(0);
        	        company_name.setValue('Joe');
        		 });*/
            
 });