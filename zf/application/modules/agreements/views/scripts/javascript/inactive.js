<?php 
header('Content-type: text/javascript');
?>

Ext.override(Ext.ux.form.SuperBoxSelect, {
	   assertValue:null
});

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

var orig_onLoad = Ext.grid.GridView.prototype.onLoad;

Ext.override(Ext.ux.grid.LockingGridView, {
        /*
         * Override the Ext.grid.GridView onLoad method.
         * The original one in ExtJs 3 "resets the scrollbar" every time new items
         * are added. This is especially uncomfortable when doing a large, slow,
         * search.
         * The original onLoad is now replaced by something which checks if the
         * scroll position is below the actual bottom grid row. If that's the case,
         * then and only then we reset the scroll position to the top of the grid.
         * It is thought that the original scroll-to-the-top behaviour was only
         * intended to prevent the situation where the user was left with a white
         * screen when a grid was reloaded with less items than before (- when the
         * scroll was done).
         */
        onLoad : function()
        {
                var rowCount = this.getRows().length;


                // Count the content hight in pixels.
                var totalPixels = 0;
                for(var rowNr=0; rowNr<rowCount; rowNr++) {
                        totalPixels += this.getRow(rowNr).clientHeight;
                }


                /*
                 * If the current scroll position is below the bottom of
                 * the grid-items, then scroll all the way up
                 * In theory we could also just move to [bottom - window size] but that
                 * might be confusing.
                 * We let the original onLoad take care of the scrolling: in case it
                 * has other things to do so besides the this.scrollToTop() call.
                 */
                if (this.el.getScroll().top >= totalPixels) {
                        orig_onLoad.apply(this, arguments);
                }
        }
});

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
            var replacewin;
            
            createCookie("storeLoaded_hrm", "false", 31);
            
            var store = new Ext.data.Store({
                url: '/zf/public/agreements/json/inactive',
                reader: new Ext.data.JsonReader({root: 'agreements',
                    totalProperty: 'totalCount',id: 'agreement_id'}, 
                        [{name: 'agreement_id',type: 'int'},
                         {name: 'employee_id',type: 'int'},
                         {name: 'type_id',type: 'string'},
                         {name: 'site_id',type: 'int'},
                         {name: 'worktime',type: 'string'},
                         {name: 'start_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'effective_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'firstname',type: 'string'},
                         {name: 'lastname',type: 'string'},
                         {name: 'sotu',type: 'string'},
                         {name: 'address',type: 'string'},
                         {name: 'zip',type: 'string'},
                         {name: 'city',type: 'string'},
                         {name: 'phone',type: 'string'},
                         {name: 'email',type: 'string'},
                         {name: 'taxnumber',type: 'string'},
                         {name: 'bank_account',type: 'string'},
                         {name: 'BIC',type: 'string'},
                         {name: 'hours_in_a_day',type: 'string'},
                         {name: 'warranty_work_hours',type: 'int'},
                         {name: 'trial',type: 'string'},
                         {name: 'job_title',type: 'string'},
                         {name: 'tasks',type: 'string'},
                         {name: 'salary',type: 'string'},
                         {name: 'salary_unit',type: 'string'},
                         {name: 'terms_and_conditions',type: 'string'},
                         {name: 'salary_terms_and_conditions',type: 'string'},
                         {name: 'salary_payment_period',type: 'string'},
                         {name: 'benefits',type: 'string'},
                         {name: 'from_date',type: 'string'},
                         {name: 'user_id',type: 'int'},
                         {name: 'customer_id',type: 'int'},
                         {name: 'tes_id',type: 'int'},
                         {name: 'additional',type: 'string'},
                         {name: 'salary_other_what',type: 'string'},
                         {name: 'taxation_city',type: 'string'},
                         {name: 'basic_prosent',type: 'float'},
                         {name: 'extra_prosent',type: 'float'},
                         {name: 'Yearlysalarylimit', type: 'string'},
                         {name: 'Taxationcountingmethod', type: 'string'},
                         {name: 'Taxcard_come_into_effect_date', type: 'date', dateFormat:'Y-m-d'},
                         {name: 'Retrimentmodel', type: 'string'},
                         {name: 'AY_membershippaymentpersent', type: 'float'},
                         {name: 'asuntoetu', type: 'float'},
                         {name: 'asuntoetu_sahko', type: 'float'},
                         {name: 'autotallietu', type: 'float'},
                         {name: 'ravintoetu', type: 'float'},
                         {name: 'autoetu', type: 'float'},
                         {name: 'puhelinetu', type: 'float'},
                         {name: 'message_date',type: 'date', dateFormat:'Y-m-d'}]),
                        baseParams: { "limit":200 },
                        sortInfo:{field: 'agreement_id', direction: "DESC"},
                        remoteSort: true
                    });
                    
          //store.load({params: { "start":0, "limit":50, "query":"" }});
            
            /*var storeQualifications = new Ext.data.Store({
                url: '/zf/public/agreements/json/qualifications',
                reader: new Ext.data.JsonReader({root: 'qualifications',
                    totalProperty: 'totalCount',id: 'qualification_id'}, 
                        [{name: 'qualification_id',type: 'int'},
                         {name: 'employee_id',type: 'int'},
                         {name: 'qualification_name',type: 'string'},
                         {name: 'fullname',type: 'string'},
                         {name: 'active',type: 'string'},
                         {name: 'experience_in_years',type: 'int'},
                         {name: 'date_completed',type: 'date', dateFormat:'Y-m-d'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'qualification_id', direction: "ASC"}
                    });
            
            storeQualifications.load({params: { "start":0, "limit":50, "query":"" }});*/
          
          var storeStartplace = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/agreements/json/startplace',
					scope: this
				})
				, baseParams: {
					task: "startplace"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'startplace_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
          storeStartplace.loadData;
          storeStartplace.load();
          
          var storeEmployee = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/agreements/json/employees',
					scope: this
				})
				, baseParams: {
					task: "employees"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'employees_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
        storeEmployee.loadData;
        storeEmployee.load();
        
        /*var storeWorkplace = new Ext.data.Store ({
			proxy: new Ext.data.HttpProxy ({ 
				url: '/zf/public/agreements/json/workplace',
				scope: this
			})
			, baseParams: {
				task: "workplace"
			}
			, reader: new Ext.data.JsonReader ({
				root: 'workplace_root'
				, id: 'KeyField'
				, fields: [
					{name: 'KeyField'}
					, {name: 'DisplayField'}
				]
			})
		});		
			
    storeWorkplace.loadData;
    storeWorkplace.load();*/
    
    var storeType = new Ext.data.Store ({
		proxy: new Ext.data.HttpProxy ({ 
			url: '/zf/public/agreements/json/type',
			scope: this
		})
		, baseParams: {
			task: "type"
		}
		, reader: new Ext.data.JsonReader ({
			root: 'type_root'
			, id: 'KeyField'
			, fields: [
				{name: 'KeyField'}
				, {name: 'DisplayField'}
			]
		})
	});		
		
      storeType.loadData;
      storeType.load();
      
      var storeCustomers = new Ext.data.Store ({
    		proxy: new Ext.data.HttpProxy ({ 
    			url: '/zf/public/agreements/json/customers',
    			scope: this
    		})
    		, baseParams: {
    			task: "customers"
    		}
    		, reader: new Ext.data.JsonReader ({
    			root: 'customers_root'
    			, id: 'KeyField'
    			, fields: [
    				{name: 'KeyField'}
    				, {name: 'DisplayField'}
    			]
    		})
    	});		
    		
      storeCustomers.loadData;
      storeCustomers.load();
      
      var storeWorktime = new Ext.data.Store ({
  		proxy: new Ext.data.HttpProxy ({ 
  			url: '/zf/public/agreements/json/worktime',
  			scope: this
  		})
  		, baseParams: {
  			task: "worktime"
  		}
  		, reader: new Ext.data.JsonReader ({
  			root: 'worktime_root'
  			, id: 'KeyField'
  			, fields: [
  				{name: 'KeyField'}
  				, {name: 'DisplayField'}
  			]
  		})
  	});		
  		
        storeWorktime.loadData;
        storeWorktime.load();
        
        var storeWorktimeForm = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/worktimeform',
      			scope: this
      		})
      		, baseParams: {
      			task: "worktimeform"
      		}
      		, reader: new Ext.data.JsonReader ({
      			root: 'worktimeform_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeWorktimeForm.loadData;
        storeWorktimeForm.load();
        
        var storeAgreeForm = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/agreeform',
      			scope: this
      		})
      		, baseParams: {
      			task: "agreeform"
      		}
      		, reader: new Ext.data.JsonReader ({
      			root: 'agreeform_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeAgreeForm.loadData;
        storeAgreeForm.load();
        
        var storeSalaryTermsForm = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/salarytermsform',
      			scope: this
      		})
      		, baseParams: {
      			task: "salarytermsform"
      		},
      		sortInfo:{field: 'KeyField', direction: "ASC"}
      		, reader: new Ext.data.JsonReader ({
      			root: 'salarytermsform_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeSalaryTermsForm.loadData;
        storeSalaryTermsForm.load();
        
        var storeTermsForm = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/termsform',
      			scope: this
      		})
      		, baseParams: {
      			task: "termsform"
      		},
      		sortInfo:{field: 'KeyField', direction: "ASC"}
      		, reader: new Ext.data.JsonReader ({
      			root: 'termsform_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeTermsForm.loadData;
        storeTermsForm.load();
        
        var storeSalaryPaymentPeriodForm = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/salarypaymentperiodform',
      			scope: this
      		})
      		, baseParams: {
      			task: "salarypaymentperiodform"
      		},
      		sortInfo:{field: 'KeyField', direction: "ASC"}
      		, reader: new Ext.data.JsonReader ({
      			root: 'salarypaymentperiodform_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeSalaryPaymentPeriodForm.loadData;
        storeSalaryPaymentPeriodForm.load();
        
        var storeTes = new Ext.data.Store ({
      		proxy: new Ext.data.HttpProxy ({ 
      			url: '/zf/public/agreements/json/tes',
      			scope: this
      		})
      		, baseParams: {
      			task: "tes"
      		},
      		sortInfo:{field: 'KeyField', direction: "ASC"}
      		, reader: new Ext.data.JsonReader ({
      			root: 'tes_root'
      			, id: 'KeyField'
      			, fields: [
      				{name: 'KeyField'}
      				, {name: 'DisplayField'}
      			]
      		})
      	});		
      		
        storeTes.loadData;
        storeTes.load();
            
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
                        id       :'agreement_id',
                        header   : 'AID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'agreement_id'
                    },{
                        id       :'employee_id',
                        header   : 'EID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'employee_id'
                    },{
                        id       :'sotu',
                        header   : '<?= $this->sotu ?>', 
                        width    : 100, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'sotu'
                    },{
                        id       :'firstname',
                        header   : '<?= $this->firstname ?>', 
                        width    : 130, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'firstname'
                    },{
                        id       :'lastname',
                        header   : '<?= $this->lastname ?>', 
                        width    : 130, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'lastname'
                    },{
                        id       :'job_title_grid',
                        header   : '<?= $this->job ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'job_title',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: true
                        }
                    },{
                        id       :'tasks_grid',
                        header   : '<?= $this->tasks ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'tasks',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: true
                        }
                    },{
                        id       :'trial',
                        header   : '<?= $this->trial ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'trial',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: true
                        }
                    },{
                        id       :'massage_date',
                        header   : '<?= $this->message_date ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'message_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            //minValue: '01/01/1970',
                            //minText: '<?= $this->min_date ?>',
                            //maxValue: '12/31/2999'
                        }
                    },{
                        id       :'addidional',
                        header   : '<?= $this->additional ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'additional',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: true
                        }
                    },{
                        header   : '<?= $this->employee_agrees_worktime ?>', 
                        width    : 600,
                        //height   :200,
                        sortable : false,
                        locked:false, 
                        dataIndex: 'worktime',
                        //xtype:'superboxselect',
                        renderer : function(value, cell, model, index) {
                            //alert(value);
                    	    var arr = value.split(",");
                    	    
                    	    arr.sort();
                    	    
                    	    var length = arr.length,
                    	    element = null;
                    	    //var element[0] = "";
                    	    
                    	    for (var i = 0; i < length; i++) {
                    	    
	                    	    // Do something with element i.
	                    	    if (arr[i]==1) {
	                    	    	arr[i] = '<?= $this->worktime_id_1 ?>';
	                    	    } else if (arr[i]==2) {
	                    	    	arr[i] = '<?= $this->worktime_id_2 ?>';
	                    	    } else if (arr[i]==3) {
	                    	    	arr[i] = '<?= $this->worktime_id_3 ?>';
	                    	    } else if (arr[i]==4) {
	                    	    	arr[i] = '<?= $this->worktime_id_4 ?>';
	                    	    } else {
	                    	    	arr[i] = "";
	                    	    }
                    	        
                    	    }
                    	   
                    	    var data = arr.join("; ");
                    	    
                            return data;
                            
                        },
                        editor: {									    
	                    	allowBlank:true,
	                        id:'worktime_grid',
	                        xtype:'superboxselect',
	                        fieldLabel: '<?= $this->worktime ?>',
	                        emptyText: '<?= $this->empty_text_worktime ?>',
	                        resizable: false,
	        				minChars: 1,
	                        name: 'worktime',
	                        //anchor:'100%',
	                        store: storeWorktime,
	                        mode: 'remote',
	                        displayField: 'DisplayField',
	                        displayFieldTpl: '{DisplayField}',
	                        valueField: 'KeyField',
	                        //value: 'CA,NY',
	        				queryDelay: 0,
	        				triggerAction: 'all',
	        				renderer: function (value, meta, record) {
	                            meta.css = 'super-select-cell';
	                            return value;
	                        }
						}
                    },{
                        //id       :'warranty_work_hours',
                        header   : '<?= $this->warranty_work_hours ?>', 
                        width    : 120, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'warranty_work_hours',
                        editor: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 168
                        }
                    },{
                        header   : '<?= $this->type ?>', 
                        width    : 400,
                        //height   :200,
                        sortable : true,
                        locked:false, 
                        dataIndex: 'type_id',
                        //xtype:'superboxselect',
                        renderer : function(value, cell, model, index) {
                            //alert(value);
                    	    var arr = value.split(",");
                    	    
                    	    arr.sort();
                    	    
                    	    var length = arr.length,
                    	    element = null;
                    	    //var element[0] = "";
                    	    
                    	    for (var i = 0; i < length; i++) {
                    	    
	                    	    // Do something with element i.
	                    	    if (arr[i]==1) {
	                    	    	arr[i] = '<?= $this->type_id_1 ?>';
	                    	    } else if (arr[i]==2) {
	                    	    	arr[i] = '<?= $this->type_id_2 ?>';
	                    	    } else if (arr[i]==3) {
	                    	    	arr[i] = '<?= $this->type_id_3 ?>';
	                    	    } else {
	                    	    	arr[i] = "";
	                    	    }
                    	        
                    	    }
                    	   
                    	    var data = arr.join("; ");
                    	    
                            return data;
                            
                        },
                        editor: {									    
	                    	allowBlank:true,
	                        id:'type_grid',
	                        xtype:'superboxselect',
	                        fieldLabel: '<?= $this->type ?>',
	                        emptyText: '<?= $this->empty_text_type ?>',
	                        resizable: false,
	        				minChars: 1,
	                        name: 'type_id',
	                        //anchor:'100%',
	                        store: storeType,
	                        mode: 'remote',
	                        displayField: 'DisplayField',
	                        displayFieldTpl: '{DisplayField}',
	                        valueField: 'KeyField',
	                        //value: 'CA,NY',
	        				queryDelay: 0,
	        				triggerAction: 'all',
	        				renderer: function (value, meta, record) {
	                            meta.css = 'super-select-cell';
	                            return value;
	                        }
						}
                    },{
                        header   : '<?= $this->terms_and_conditions ?>', 
                        width    : 400,
                        //height   :200,
                        sortable : false,
                        locked:false, 
                        dataIndex: 'terms_and_conditions',
                        //xtype:'superboxselect',
                        renderer : function(value, cell, model, index) {
                            //alert(value);
                    	    var arr = value.split(",");
                    	    
                    	    arr.sort();
                    	    
                    	    var length = arr.length,
                    	    element = null;
                    	    //var element[0] = "";
                    	    
                    	    for (var i = 0; i < length; i++) {
                    	    
	                    	    // Do something with element i.
	                    	    if (arr[i]==1) {
	                    	    	arr[i] = '<?= $this->worklaws_id_1 ?>';
	                    	    } else if (arr[i]==2) {
	                    	    	arr[i] = '<?= $this->worklaws_id_2 ?>';
	                    	    } else {
	                    	    	arr[i] = "";
	                    	    }
                    	        
                    	    }
                    	   
                    	    var data = arr.join("; ");
                    	    
                            return data;
                            
                        },
                        editor: {									    
	                    	allowBlank:true,
	                        id:'terms_and_condition_grid',
	                        xtype:'superboxselect',
	                        fieldLabel: '<?= $this->terms_and_condtions ?>',
	                        emptyText: '<?= $this->empty_text_terms_and_condtions ?>',
	                        resizable: false,
	        				minChars: 1,
	                        name: 'terms_and_contions',
	                        //anchor:'100%',
	                        store: storeTermsForm,
	                        mode: 'remote',
	                        displayField: 'DisplayField',
	                        displayFieldTpl: '{DisplayField}',
	                        valueField: 'KeyField',
	                        //value: 'CA,NY',
	        				queryDelay: 0,
	        				triggerAction: 'all',
	        				renderer: function (value, meta, record) {
	                            meta.css = 'super-select-cell';
	                            return value;
	                        }
						}
                    },{
                        header   : '<?= $this->tes ?>', 
                        width    : 160, 
                        sortable : true,
                        locked:false, 
                        dataIndex: 'tes_id',
                        editor: new Ext.form.ComboBox({									    
							store: storeTes,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeTes.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->missing ?> )';
							}
						}
                    },{
                        header   : '<?= $this->customer ?>', 
                        width    : 160, 
                        sortable : true,
                        locked:false, 
                        dataIndex: 'customer_id',
                        editor: new Ext.form.ComboBox({									    
							store: storeCustomers,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeCustomers.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->missing ?> )';
							}
						}
                    },{
                        //id       :'hours_in_a_day',
                        header   : '<?= $this->hours_in_a_day ?>', 
                        width    : 120, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'hours_in_a_day',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        header   : '<?= $this->startplace ?>', 
                        width    : 160, 
                        sortable : false,
                        locked:false, 
                        dataIndex: 'site_id',
                        editor: new Ext.form.ComboBox({									    
							store: storeStartplace,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeStartplace.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->missing ?> )';
							}
						}
                    },{
                        id       :'start_date',
                        header   : '<?= $this->start_date ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'start_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            //minValue: '01/01/1970',
                            //minText: '<?= $this->min_date ?>',
                            //maxValue: '12/31/2999'
                        }
                    },{
                        id       :'effective_date',
                        header   : '<?= $this->effective_date ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'effective_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            //minValue: '01/01/1970',
                            //minText: '<?= $this->min_date ?>',
                            //maxValue: '12/31/2999'
                        }
                    },{
                        id       :'salary_on_grid',
                        header   : '<?= $this->salary ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'salary',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'salary_unit_on_grid',
                        header   : '<?= $this->salary_unit ?>', 
                        width    : 100, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'salary_unit',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'benefits_grid',
                        header   : '<?= $this->benefits ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'benefits',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        header   : '<?= $this->salary_payment_period ?>', 
                        width    : 400,
                        //height   :200,
                        sortable : false,
                        locked:false, 
                        dataIndex: 'salary_terms_and_conditions',
                        //xtype:'superboxselect',
                        renderer : function(value, cell, model, index) {
                            //alert(value);
                    	    var arr = value.split(",");
                    	    
                    	    arr.sort();
                    	    
                    	    var length = arr.length,
                    	    element = null;
                    	    //var element[0] = "";
                    	    
                    	    for (var i = 0; i < length; i++) {
                    	    
	                    	    // Do something with element i.
	                    	    if (arr[i]==1) {
	                    	    	arr[i] = '<?= $this->salary_period_id_1 ?>';
	                    	    } else if (arr[i]==2) {
	                    	    	arr[i] = '<?= $this->salary_period_id_2 ?>';
	                    	    } else if (arr[i]==3) {
	                    	    	arr[i] = '<?= $this->salary_period_id_3 ?>';
	                    	    } else if (arr[i]==4) {
	                    	    	arr[i] = '<?= $this->salary_period_id_4 ?>';
	                    	    } else {
	                    	    	arr[i] = "";
	                    	    }
                    	        
                    	    }
                    	   
                    	    var data = arr.join("; ");
                    	    
                            return data;
                            
                        },
                        editor: {									    
	                    	allowBlank:true,
	                        id:'salary_perdormance_terms_and_condition_grid',
	                        xtype:'superboxselect',
	                        fieldLabel: '<?= $this->salary_performance_terms_and_condtions ?>',
	                        emptyText: '<?= $this->empty_text_performance_terms_and_condtions ?>',
	                        resizable: false,
	        				minChars: 1,
	                        name: 'salary_terms_and_conditions',
	                        //anchor:'100%',
	                        store: storeSalaryTermsForm,
	                        mode: 'remote',
	                        displayField: 'DisplayField',
	                        displayFieldTpl: '{DisplayField}',
	                        valueField: 'KeyField',
	                        //value: 'CA,NY',
	        				queryDelay: 0,
	        				triggerAction: 'all',
	        				renderer: function (value, meta, record) {
	                            meta.css = 'super-select-cell';
	                            return value;
	                        }
						}
                    },{
                        id       :'salary_other_what_grid',
                        header   : '<?= $this->salary_other_what ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'salary_other_what',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        header   : '<?= $this->salary_period_terms_and_conditions ?>', 
                        width    : 400,
                        //height   :200,
                        sortable : false,
                        locked:false, 
                        dataIndex: 'salary_payment_period',
                        //xtype:'superboxselect',
                        renderer : function(value, cell, model, index) {
                            //alert(value);
                    	    var arr = value.split(",");
                    	    
                    	    arr.sort();
                    	    
                    	    var length = arr.length,
                    	    element = null;
                    	    //var element[0] = "";
                    	    
                    	    for (var i = 0; i < length; i++) {
                    	    
	                    	    // Do something with element i.
	                    	    if (arr[i]==1) {
	                    	    	arr[i] = '<?= $this->salary_id_1 ?>';
	                    	    } else if (arr[i]==2) {
	                    	    	arr[i] = '<?= $this->salary_id_2 ?>';
	                    	    } else if (arr[i]==3) {
	                    	    	arr[i] = '<?= $this->salary_id_3 ?>';
	                    	    } else if (arr[i]==4) {
	                    	    	arr[i] = '<?= $this->salary_id_4 ?>';
	                    	    } else {
	                    	    	arr[i] = "";
	                    	    }
                    	        
                    	    }
                    	   
                    	    var data = arr.join("; ");
                    	    
                            return data;
                            
                        },
                        editor: {									    
	                    	allowBlank:true,
	                        id:'salary_period_terms_and_condition_grid',
	                        xtype:'superboxselect',
	                        fieldLabel: '<?= $this->salary_period_terms_and_condtions ?>',
	                        emptyText: '<?= $this->empty_text_salary_terms_and_condtions ?>',
	                        resizable: false,
	        				minChars: 1,
	                        name: 'salary_payment_period',
	                        //anchor:'100%',
	                        store: storeSalaryPaymentPeriodForm,
	                        mode: 'remote',
	                        displayField: 'DisplayField',
	                        displayFieldTpl: '{DisplayField}',
	                        valueField: 'KeyField',
	                        //value: 'CA,NY',
	        				queryDelay: 0,
	        				triggerAction: 'all',
	        				renderer: function (value, meta, record) {
	                            meta.css = 'super-select-cell';
	                            return value;
	                        }
						}
                    },{
                        id       :'from_date_grid',
                        header   : '<?= $this->salary_id_4 ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'from_date',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'address',
                        header   : '<?= $this->address ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'address'
                    },{
                        id       :'zip',
                        header   : '<?= $this->zip ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'zip'
                    },{
                        id       :'city',
                        header   : '<?= $this->city ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'city',
                        editor: new Ext.form.ComboBox({									    
							store: storeStartplace,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeStartplace.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->missing ?> )';
							}
						}
                    },{
                        id       :'phone',
                        header   : '<?= $this->phone ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'phone'
                    },{
                        id       :'email',
                        header   : '<?= $this->email ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'email'
                    },{
                        id       :'taxnumber',
                        header   : '<?= $this->taxnumber ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'taxnumber'
                    },{
                        id       :'bank_account',
                        header   : '<?= $this->bank_account ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'bank_account'
                    },{
                        id       :'BIC',
                        header   : '<?= $this->BIC ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'BIC'
                    },{
                        id       :'taxation_city',
                        header   : '<?= $this->taxation_city ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'taxation_city'
                    },{
                        id       :'basic_prosent',
                        header   : '<?= $this->basic_prosent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'basic_prosent'
                    },{
                        id       :'extra_prosent',
                        header   : '<?= $this->extra_prosent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'extra_prosent'
                    },{
                        id       :'Yearlysalarylimit',
                        header   : '<?= $this->Yearlysalarylimit ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Yearlysalarylimit'
                    },{
                        id       :'Taxationcountingmethod',
                        header   : '<?= $this->Taxationcountingmethod ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Taxationcountingmethod'
                    },{
                        id       :'Taxcard_come_into_effect_date',
                        header   : '<?= $this->Taxcard_come_into_effect_date ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        dataIndex: 'Taxcard_come_into_effect_date'
                    },{
                        id       :'Retrimentmodel',
                        header   : '<?= $this->Retrimentmodel ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Retrimentmodel'
                    },{
                        id       :'AY_membershippaymentpersent',
                        header   : '<?= $this->AY_membershippaymentpersent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'AY_membershippaymentpersent'
                    },{
                        id       :'asuntoetu',
                        header   : '<?= $this->asuntoetu ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'asuntoetu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'asuntoetu_sahko',
                        header   : '<?= $this->asuntoetu_sahko ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'asuntoetu_sahko',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'autotallietu',
                        header   : '<?= $this->autotallietu ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'autotallietu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'ravintoetu',
                        header   : '<?= $this->ravintoetu ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'ravintoetu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'autoetu',
                        header   : '<?= $this->autoetu ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'autoetu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    },{
                        id       :'puhelinetu',
                        header   : '<?= $this->puhelinetu ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'puhelinetu',
                        editor: {
                            xtype: 'textfield',
                            allowBlank: false
                        }
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: [new Ext.PagingToolbar({
                    store: store,           
                    pageSize: 200,
                    id:'paging-toolbar',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->noagreements ?>'}
                ),{
                    id: 'upcoming-grid',
                	text: '<?= $this->upcoming ?>',
                    tooltip: '<?= $this->upcoming_tooltip ?>',
                    iconCls: 'refresh-icon',
                    disabled: false,
                    handler: function () {
                	   document.location = "/zf/public/agreements/index/upcoming";
                    }},{
                id: 'active-grid',
            	text: '<?= $this->active ?>',
                tooltip: '<?= $this->active_tooltip ?>',
                iconCls: 'refresh-icon',
                disabled: false,
                handler: function () {
                	 document.location = "/zf/public/agreements/index";
                }},{
                    id: 'inactive-grid',
                	text: '<?= $this->inactive ?>',
                    tooltip: '<?= $this->inactive_tooltip ?>',
                    iconCls: 'refresh-icon',
                    disabled: false,
                    handler: function () {
                	   document.location = "/zf/public/agreements/index/inactive";
                    }}],
                    plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['agreement_id']
                        ,disableIndexes:['agreement_id', 'sotu', 'start_date', 'effective_date', 'user_id', 'salary_payment_period', 'worktime', 'additional', 'site_id', 'taxnumber', 'phone', 'employee_id', 'from_date', 'email', 'address', 'zip', 'city', 'trial', 'hours_in_a_day', 'terms_and_conditions', 'type_id', 'warranty_work_hours', 'workplace_id', 'bank_account']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['firstname']
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
                waitMsg: 'Lataa voimassaolevia sopimuksia uudestaan...',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'agreement_id',
                width: Ext.lib.Dom.getViewWidth(),
                //height: Ext.lib.Dom.getViewHeight() * 0.5,
                //height: Ext.lib.Dom.getViewHeight(),
                autoHeight:true,
                title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-agreement',
                //renderTo: 'AgreementGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false //,
                    /*getRowClass: function (record, rowIndex, rowParams, store) {
                         if (record.get('type_id')==1) {
                	         return 'super-select-grid-red';
                         } else if (record.get('type_id')==2) {
                        	 return 'super-select-grid-green';
                         } else if (record.get('type_id')==3) {
                        	 return 'super-select-grid-blue';
                         } else {
                        	 return 'super-select-grid-grey';
                         }
                    }*/
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
                        	    grid.store.clearData();
                                grid.view.refresh();
                                Ext.getCmp('update-agreement-grid').disable();
                            	Ext.getCmp('delete-agreement-grid').disable();
	                            store.reload();
	                        }},
	                        /*{
		                        id: 'new-agreement-grid',
	                        	text: '<?= $this->new_agreement ?>',
		                        tooltip: '<?= $this->new_agreement_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: false,
		                        handler: createNT
		                     },*/
		                     {
			                        id: 'update-agreement-grid',
		                        	text: '<?= $this->update_agreement ?>',
			                        tooltip: '<?= $this->update_agreement_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: replaceNT
			                },
		                     {
		                        id: 'delete-agreement-grid',
	                        	text: '<?= $this->delete_agreement ?>',
		                        tooltip: '<?= $this->delete_agreement_tooltip ?>',
		                        iconCls: 'refresh-icon',
		                        disabled: true,
		                        handler: deleteNT
		                }
                        ]
            });
 
            var replaceform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/agreements/json/update",
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
                id:'agreement_id_replace_form',
                name: 'agreement_id',
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
                                                var url = "/zf/public/agreements/json/update";
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
                                                						store.reload();
                                                						grid.store.clearData();
                                                                        grid.view.refresh();
                                                                        Ext.getCmp('update-agreement-grid').disable();
                                                                    	Ext.getCmp('delete-agreement-grid').disable();
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
                                                                        grid.store.clearData();
                                                                        grid.view.refresh();
                                                                        Ext.getCmp('update-agreement-grid').disable();
                                                                    	Ext.getCmp('delete-agreement-grid').disable();
                                                                    	store.reload();
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
            
            function deleteNT() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeleteagreementtext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/agreements/json/delete'
					, params: { 
						task: "delete"
						, deleteKeys: encoded_keys
						, key: 'agreement_id'
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
						
						grid.store.clearData();
                        grid.view.refresh();
                        Ext.getCmp('update-agreement-grid').disable();
                    	Ext.getCmp('delete-agreement-grid').disable();
		            	grid.selModel.clearSelections();
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
            
            var RadioPeriod = new Ext.form.Checkbox({
              	 id:'period',
              	 //xtype: 'radio',
                   checked: true,
                   fieldLabel: '',
                   labelSeparator: '',
                   boxLabel: '<?= $this->period ?>',
                   name: 'employment_type',
                   inputValue: '1'
              });
            
            var RadioParttime = new Ext.form.Checkbox({
           	 id:'parttime',
           	 //xtype: 'radio',
                checked: true,
                fieldLabel: '',
                labelSeparator: '',
                boxLabel: '<?= $this->parttime ?>',
                name: 'employment_type',
                inputValue: '2'
           });
           
           var RadioPermanent = new Ext.form.Checkbox({
           	id:'permanent',
           	//xtype: 'radio',
               fieldLabel: '',
               labelSeparator: '',
               boxLabel: '<?= $this->permanent ?>',
               name: 'employment_type',
               inputValue: '3',
               // Collapse combo when its element is clicked on
            	   listeners : {
            	      check : function(field, newValue, oldValue, options) {
        	   
        	          //alert("NEW");
        	   
            	      if(newValue)
            	      {
            	         //code executed when checkbox is checked
            	    	 //alert("true");
            	    	 Ext.getCmp('period').disable();
            	    	 Ext.getCmp('parttime').disable();
            	    	 Ext.getCmp('effective_date').disable();
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
             	    	 Ext.getCmp('effective_date').enable();
             	    	
            	      }
            	      
            	   }
            	 }
           });
           
           //Permanent.getValue();
           
           //
           
           var RadioVaralla = new Ext.form.Checkbox({
            	 id:'varalla',
            	 //xtype: 'radio',
                 checked: true,
                 fieldLabel: '',
                 labelSeparator: '',
                 boxLabel: '<?= $this->worktime_id_1 ?>',
                 name: 'worktime',
                 inputValue: '1'
            });
          
          var RadioViikonloppu = new Ext.form.Checkbox({
         	 id:'viikonloppu',
         	 //xtype: 'radio',
              checked: true,
              fieldLabel: '',
              labelSeparator: '',
              boxLabel: '<?= $this->worktime_id_2 ?>',
              name: 'worktime',
              inputValue: '2'
         });
          
          var RadioKomennus = new Ext.form.Checkbox({
          	 id:'komennus',
          	 //xtype: 'radio',
               checked: true,
               fieldLabel: '',
               labelSeparator: '',
               boxLabel: '<?= $this->worktime_id_3 ?>',
               name: 'worktime',
               inputValue: '2'
          });
          
          var RadioYlityo = new Ext.form.Checkbox({
           	 id:'ylityo',
           	 //xtype: 'radio',
                checked: true,
                fieldLabel: '',
                labelSeparator: '',
                boxLabel: '<?= $this->worktime_id_4 ?>',
                name: 'worktime',
                inputValue: '2'
           });
           
           var HoursNumberField = Ext.extend(Ext.form.NumberField, {
               setValue : function(v){
                   v = typeof v == 'number' ? v : String(v).replace(this.decimalSeparator, ".");
                   v = isNaN(v) ? '' : String(v).replace(".", this.decimalSeparator);
                   //  if you want to ensure that the values being set on the field is also forced to the required number of decimal places.
                   // (not extensively tested)
                   // v = isNaN(v) ? '' : this.fixPrecision(String(v).replace(".", this.decimalSeparator));
                   return Ext.form.NumberField.superclass.setValue.call(this, v);
               },
               fixPrecision : function(value){
                   var nan = isNaN(value);
                   if(!this.allowDecimals || this.decimalPrecision == -1 || nan || !value){
                      return nan ? '' : value;
                   }
                   return parseFloat(value).toFixed(this.decimalPrecision);
               }
           });
           
           /**
            * 
            */
           
           var RadioTerms = new Ext.form.Checkbox({
           	    id:'terms',
           	    //xtype: 'radio',
                checked: false,
                fieldLabel: '',
                labelSeparator: '',
                boxLabel: '<?= $this->worklaws_id_1 ?>',
                name: 'terms_and_conditions',
                inputValue: '1'
           });
            
            var RadioLaws = new Ext.form.Checkbox({
            	 id:'laws',
            	 //xtype: 'radio',
                 checked: true,
                 fieldLabel: '',
                 labelSeparator: '',
                 boxLabel: '<?= $this->worklaws_id_2 ?>',
                 name: 'terms_and_conditions',
                 inputValue: '2'
            });
            
            
            /**
             * 
             */
            
            var RadioSalaryTime = new Ext.form.Checkbox({
            	    id:'salary_time',
            	    //xtype: 'radio',
                 checked: false,
                 fieldLabel: '',
                 labelSeparator: '',
                 boxLabel: '<?= $this->salary_id_1 ?>',
                 name: 'salary_payment_period',
                 inputValue: '1'
            });
             
             var RadioSalaryComission = new Ext.form.Checkbox({
             	 id:'salary_comission',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_id_2 ?>',
                  name: 'salary_payment_period',
                  inputValue: '2'
             });
             
             var RadioSalaryOther = new Ext.form.Checkbox({
             	 id:'salary_other',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_id_3 ?>',
                  name: 'salary_payment_period',
                  inputValue: '3'
             });
             
             var RadioSalaryPerformance = new Ext.form.Checkbox({
             	 id:'salary_performance',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_id_4 ?>',
                  name: 'salary_payment_period',
                  inputValue: '4'
             });
             
             /**
              * 
              */
             
             var RadioSalaryPeriodI = new Ext.form.Checkbox({
             	 id:'salary_month',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_period_id_1 ?>',
                  name: 'salary_terms_and_conditions',
                  inputValue: '1'
             });
             
             var RadioSalaryPeriodII = new Ext.form.Checkbox({
             	 id:'salary_twice',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_period_id_2 ?>',
                  name: 'salary_terms_and_conditions',
                  inputValue: '2'
             });
             
             var RadioSalaryPeriodIII = new Ext.form.Checkbox({
             	 id:'salary_period_other',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_period_id_3 ?>',
                  name: 'salary_terms_and_conditions',
                  inputValue: '3'
             });
             
             var RadioSalaryPeriodIV = new Ext.form.Checkbox({
             	 id:'salary_other_other',
             	 //xtype: 'radio',
                  checked: true,
                  fieldLabel: '',
                  labelSeparator: '',
                  boxLabel: '<?= $this->salary_period_id_4 ?>',
                  name: 'salary_terms_and_conditions',
                  inputValue: '4'
             });
            
            /*var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/agreements/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 780,
                height : 380,
                border : false,
                fileUpload: false,
                items: {
                    xtype:'tabpanel',
                    activeTab: 0,
                    border : false,
                    frame : false,
                    defaults:{autoHeight:true, bodyStyle:'padding:4px'},
                    items:[{
                        title:'<?= $this->tab_1 ?>',
                        layout:'form',
                        defaults: {width: 300},
                        defaultType: 'textfield',
                        fileUpload: true,
                items : [{
                    id:'employee',
                	fieldLabel : '<?= $this->employee ?>',
                    name : 'employee_id',
            		hiddenName: 'employee_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		anchor:'95%',
            		store: storeEmployee,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            	},
            	/*{
                    allowBlank:true,
                    id:'worktime_form',
                    xtype:'superboxselect',
                    fieldLabel: '<?= $this->worktime ?>',
                    emptyText: '<?= $this->empty_text_worktime ?>',
                    resizable: true,
    				minChars: 1,
                    name: 'worktime',
                    anchor:'100%',
                    store: storeWorktimeForm,
                    mode: 'remote',
                    displayField: 'DisplayField',
                    displayFieldTpl: '{DisplayField}',
                    valueField: 'KeyField',
                    //value: 'CA,NY',
    				queryDelay: 0,
    				triggerAction: 'all'
                },/*
                new HoursNumberField({
                	id:'warranty_work_hours',
                	fieldLabel : '<?= $this->warranty_work_hours ?>',
					name : 'warranty_work_hours',
					maxLength: 4,
                    allowBlank : false,
                    anchor:'40%',
                    disabled:false,
                    hidden: false,
                    xtype: 'numberfield',
                    value: 14,
                    minValue: 0,
                    maxValue: 24,
                	decimalPrecision:2
                }),*/
            	/*{
                    fieldLabel : '<?= $this->start_date ?>',
                    name : 'start_date',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y'
                },{
                    id: 'effective_date',
                	fieldLabel : '<?= $this->effective_date ?>',
                    name : 'effective_date',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y'
                },{
                    fieldLabel : '<?= $this->startplace ?>',
                    name : 'site_id',
            		hiddenName: 'site_id',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeStartplace,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all'
            		},/*{
                        fieldLabel : '<?= $this->workplace ?>',
                        name : 'workplace_id',
                		hiddenName: 'workplace_id',
                        allowBlank : false,
                		xtype:'combo',
                		//value:'1',
                		store: storeWorkplace,
    					displayField: 'DisplayField',
    	                valueField: 'KeyField',
                        mode: 'local',
                        triggerAction: 'all'
                		},*//*{
                            xtype: "radiogroup",
                            fieldLabel: "<?= $this->employment_type ?>",
                            id: "optionsgroupemploymenttype",
                            vertical: false,
                            columns: 3,
                            items: [RadioPeriod, RadioParttime, RadioPermanent]
                        },{
                            id:'reason',
                        	height:40,
                            fieldLabel : '<?= $this->employment_type_reasoon ?>',
        					name : 'reason',
        					maxLength: 500,
        					xtype:'textarea',
                            allowBlank : true,
                            anchor:'95%',
                            disabled:false,
                            hidden: false
                        }/*,{
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
                }*/
                /*]
                    },{
                        title:'<?= $this->tab_2 ?>',
                        layout:'form',
                        defaults: {width: 230},
                        defaultType: 'textfield',
                        fileUpload: true,
                        items: [{
                            xtype:'fieldset',
                            checkboxToggle:false,
                            title: '<?= $this->place ?>',
                            autoHeight:true,
                            width:500,
                            defaults: {width: 300},
                            defaultType: 'textfield',
                            collapsed: false,
                            items :[{
                                fieldLabel : '<?= $this->workplace ?>',
                                name : 'workplace_id',
                        		hiddenName: 'workplace_id',
                                allowBlank : false,
                        		xtype:'combo',
                        		//value:'1',
                        		store: storeWorkplace,
            					displayField: 'DisplayField',
            	                valueField: 'KeyField',
                                mode: 'local',
                                triggerAction: 'all'
                        		}
                            
                            ]
                        }]
                    },{
                        title:'<?= $this->tab_3 ?>',
                        layout:'form',
                        defaults: {width: 230},
                        defaultType: 'textfield',
                        fileUpload: true,
                        items: [{
                            xtype:'fieldset',
                            checkboxToggle:false,
                            title: '<?= $this->time ?>',
                            autoHeight:true,
                            width:700,
                            defaults: {width: 520},
                            defaultType: 'textfield',
                            collapsed: false,
                            items :[/*new HoursNumberField({
                            	id:'hoursinaday',
                            	fieldLabel : '<?= $this->hours_in_a_day ?>',
            					name : 'hours_in_a_day',
            					maxLength: 4,
                                allowBlank : false,
                                anchor:'40%',
                                disabled:false,
                                hidden: false,
                                xtype: 'numberfield',
                                value: 8,
                                minValue: 0,
                                maxValue: 24,
                            	decimalPrecision:2
                            }),*/ /*{
                                xtype: "radiogroup",
                                fieldLabel: "<?= $this->agree ?>",
                                id: "worktime",
                                vertical: true,
                                columns: 1,
                                items: [RadioVaralla, RadioViikonloppu, RadioKomennus, RadioYlityo]
                            },{
                            	id:'worktime_form',
                            	fieldLabel: '<?= $this->worktime ?>',
                                name: 'hours_in_a_day',
                                anchor:'40%'
                            },
                            new HoursNumberField({
                            	id:'warranty_work_hours',
                            	fieldLabel : '<?= $this->warranty_work_hours ?>',
            					name : 'warranty_work_hours',
            					maxLength: 8,
                                allowBlank : false,
                                anchor:'40%',
                                disabled:false,
                                hidden: false,
                                xtype: 'numberfield',
                                value: 14,
                                minValue: 0,
                                maxValue: 40,
                            	decimalPrecision:2
                            }),
                            
                            ]
                        }]
                    },{
                        title:'<?= $this->tab_4 ?>',
                        layout:'form',
                        defaults: {width: 230},
                        defaultType: 'textfield',
                        fileUpload: true,
                        items: [{
                            xtype:'fieldset',
                            checkboxToggle:false,
                            title: '<?= $this->job_title_and_tasks ?>',
                            autoHeight:true,
                            width:500,
                            defaults: {width: 410},
                            defaultType: 'textfield',
                            collapsed: false,
                            items :[{
                            xtype: 'textfield',
                            fieldLabel: '<?= $this->job ?>',
                            hideLabel: false,
                            labelAlign: 'top',
                            name: 'job_title',
                            anchor:'95%',
                            allowBlank: true
                    },{
                            xtype: 'textarea',
                            fieldLabel: '<?= $this->tasks ?>',
                            hideLabel: false,
                            labelAlign: 'top',
                            name: 'tasks',
                            anchor:'95%',
                            height:100,
                            allowBlank: true,
                            flex: 1  // Take up all *remaining* vertical space
                    }]}]},{
                        title:'<?= $this->tab_5 ?>',
                        layout:'form',
                        defaults: {width: 230},
                        defaultType: 'textfield',
                        fileUpload: true,
                        items: [{
                            xtype:'fieldset',
                            checkboxToggle:false,
                            title: '<?= $this->salaries ?>',
                            autoHeight:true,
                            width:500,
                            defaults: {width: 410},
                            defaultType: 'textfield',
                            collapsed: false,
                            items :[new HoursNumberField({
                            	id:'salary',
                            	fieldLabel : '<?= $this->salary ?>',
            					name : 'salary_ammount',
            					//maxLength: 4,
                                allowBlank : false,
                                anchor:'40%',
                                disabled:false,
                                hidden: false,
                                xtype: 'numberfield',
                                //value: 8,
                                //minValue: 0,
                                //maxValue: 24,
                            	decimalPrecision:2
                            }),{
                            fieldLabel: '<?= $this->salary_unit ?>',
                            name: 'salary_unit',
                            anchor:'40%'
                        },{
                            xtype: "radiogroup",
                            fieldLabel: "<?= $this->salary_payment_period ?>",
                            id: "salary_terms_and_conditions",
                            vertical: true,
                            columns: 2,
                            items: [RadioSalaryPeriodI, RadioSalaryPeriodII, RadioSalaryPeriodIII, RadioSalaryPeriodIV]
                        },{
                                fieldLabel: '<?= $this->salary_other_what ?>',
                                name: 'salary_other_what',
                                anchor:'80%'
                            },{
                                xtype: 'textarea',
                                fieldLabel: '<?= $this->benefits ?>',
                                hideLabel: false,
                                labelAlign: 'top',
                                name: 'benefits',
                                anchor:'95%',
                                height:50,
                                allowBlank: true,
                                flex: 1  // Take up all *remaining* vertical space
                            },{
                                xtype: "radiogroup",
                                fieldLabel: "<?= $this->salary_period_terms_and_conditions ?>",
                                id: "salary_period_terms_and_conditions",
                                vertical: true,
                                columns: 2,
                                items: [RadioSalaryTime, RadioSalaryComission, RadioSalaryPerformance, RadioSalaryOther]
                            }
                           ]
                        }]},{
                            title:'<?= $this->tab_6 ?>',
                            layout:'form',
                            defaults: {width: 350},
                            defaultType: 'textfield',
                            fileUpload: true,
                            items: [{
                                xtype: "radiogroup",
                                fieldLabel: "<?= $this->terms_and_conditions ?>",
                                id: "terms_and_conditions",
                                vertical: false,
                                columns: 2,
                                items: [RadioTerms, RadioLaws]
                            }]
                            },{
                            title:'<?= $this->tab_7 ?>',
                            layout:'form',
                            defaults: {width: 230},
                            defaultType: 'textfield',
                            fileUpload: true,
                            items: [{
                                xtype: 'textarea',
                                fieldLabel: '<?= $this->additional ?>',
                                hideLabel: false,
                                labelAlign: 'top',
                                name: 'additional',
                                anchor:'95%',
                                height:100,
                                allowBlank: true,
                                flex: 1  // Take up all *remaining* vertical space
                        }]}]
                }
            }); */

            /*function createNT() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new',
                                //layout : 'fit',
                                width : 800,
                                height : 450,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_agreement ?>',
                                items : [newform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/agreements/json/createnew";
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
            }*/
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/agreements/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.agreement_id
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
                    }      
                    , scope: this
                });
            };
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            storeTes.on('load', function() {
            	
            	var storeLoaded = readCookie('storeLoaded_hrm');
            	
            	if (storeLoaded==="false") {
            	store.load({params: { "start":0, "limit":200, "query":"" }});
            	createCookie("storeLoaded_hrm", "true", 31);
            	}
            	
			});
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
				
            	Ext.getCmp('agreement_id_replace_form').setValue(r.get('agreement_id'));
            	//storeQualifications.proxy.conn.url = "/zf/public/agreements/json/qualifications?employee_id="+r.get('employee_id');
            	//gridQualifications.store.clearData();
                //gridQualifications.view.refresh();
            	//storeQualifications.reload();
            	Ext.getCmp('update-agreement-grid').enable();
            	Ext.getCmp('delete-agreement-grid').enable();
            	
            	Ext.getCmp('view_agreements_iframe').setSrc('/zf/public/agreements/json/viewagreement?agreement_id='+r.get('agreement_id'));
				
             });
            
            var tabs = new Ext.TabPanel({
                renderTo: 'AgreementGrid',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                activeTab: 0,
                frame:true,
                deferredRender: false,
                autoTabs: true,
                defaults:{autoHeight: false},
                //rowspan:3,
                items:[
                    grid,
                    {
                        layout: 'fit',
                        border: true,
                        frame: false,
                        title: '<?= $this->view_agreement ?>',
                        id: 'agreementframe',
                        defaultType: 'iframepanel',
                        defaults: {
                            loadMask: {hideOnReady :true,msg:'Loading...'},
                            border: false,
                            header: false
                        },
                        items: [{
                            id: 'view_agreements_iframe',
                            defaultSrc: '/zf/public/agreements/json/viewagreement?agreement_id=0'
                           
                        }]
                    } //,
                    //gridMaksatus
                ]
            });
            
 });