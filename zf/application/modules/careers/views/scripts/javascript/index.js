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
            var newqawin;
            var replacewin;
            var replaceqawin;
            var newtcwin;
            var replacetcwin;
            
            createCookie("storeLoaded_career", "false", 31);
            //createCookie("storeLoaded_career_qualifications", "false", 31);
            
            var store = new Ext.data.Store({
                url: '/zf/public/careers/json/index',
                reader: new Ext.data.JsonReader({root: 'careers',
                    totalProperty: 'totalCount',id: 'employee_id'}, 
                        [{name: 'employee_id',type: 'int'},
                         {name: 'user_id',type: 'int'},
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
                         {name: 'job_title',type: 'string'},
                         {name: 'salary',type: 'float'},
                         {name: 'start_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'effective_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'BIC',type: 'string'},
                         {name: 'taxation_city',type: 'string'},
                         {name: 'basic_prosent',type: 'string'},
                         {name: 'extra_prosent',type: 'float'},
                         {name: 'Yearlysalarylimit',type: 'string'},
                         {name: 'Taxationcountingmethod',type: 'string'},
                         {name: 'Taxcard_come_into_effect_date',type: 'date', dateFormat:'Y-m-d'},
                         {name: 'Retrimentmodel',type: 'string', dateFormat:'Y-m-d'},
                         {name: 'AY_membershippaymentpersent',type: 'float'}
                         ]),
                        baseParams: { "limit":200 },
                        sortInfo:{field: 'employee_id', direction: "DESC"},
                        remoteSort: true
             });
            
            //store.load({params: { "start":0, "limit":50, "query":"" }});
            
            var storeTaxcards = new Ext.data.Store({
                url: '/zf/public/careers/json/taxcards',
                reader: new Ext.data.JsonReader({root: 'taxcards',
                    totalProperty: 'totalCount',id: 'taxcard_id'}, 
                        [{name: 'taxcard_id',type: 'int'},
                         {name: 'employee_id',type: 'int'},
                         {name: 'fullname',type: 'string'},
                         {name: 'date_come_to_effective',type: 'date', dateFormat:'Y-m-d'}
                         ]),
                        baseParams: { "limit":200 },
                        sortInfo:{field: 'taxcard_id', direction: "ASC"},
                        remoteSort: true
             });
            
            storeTaxcards.load({params: { "start":0, "limit":50 }});
            
            var storeQualifications = new Ext.data.Store({
                url: '/zf/public/careers/json/qualifications',
                reader: new Ext.data.JsonReader({root: 'qualifications',
                    totalProperty: 'totalCount',id: 'qualification_id'}, 
                        [{name: 'qualification_id',type: 'int'},
                         {name: 'employee_id',type: 'int'},
                         {name: 'qualification_name',type: 'int'},
                         {name: 'fullname',type: 'string'},
                         {name: 'experience_in_years',type: 'int'},
                         {name: 'date_completed',type: 'date', dateFormat:'Y-m-d'}]),
                        sortInfo:{field: 'qualification_id', direction: "ASC"}
                    });
            
            storeQualifications.load();
            
            var storeEducation = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/careers/json/education',
					scope: this
				})
				, baseParams: {
					task: "education"
				}
				, reader: new Ext.data.JsonReader ({
					root: 'education_root'
					, id: 'KeyField'
					, fields: [
						{name: 'KeyField'}
						, {name: 'DisplayField'}
					]
				})
			});		
				
          storeEducation.loadData;
          storeEducation.load();
          
          var storeStartplace = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: '/zf/public/careers/json/startplace',
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
                        id       :'employee_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'employee_id'
                    },{
                        id       :'user_id',
                        header   : 'UID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'user_id'
                    },{
                        id       :'sotu',
                        header   : '<?= $this->sotu ?>', 
                        width    : 180, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'sotu',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'firstname',
                        header   : '<?= $this->firstname ?>', 
                        width    : 180, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'firstname',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'lastname',
                        header   : '<?= $this->lastname ?>', 
                        width    : 180, 
                        sortable : false,
                        locked:true,
                        dataIndex: 'lastname',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
                    },{
                        id       :'address',
                        header   : '<?= $this->address ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'address',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'zip',
                        header   : '<?= $this->zip ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'zip',
                        editor: new fm.TextField({
    						allowBlank: false
    					})
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
                        dataIndex: 'phone',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'email',
                        header   : '<?= $this->email ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'email',
                        editor: new fm.TextField({
    						allowBlank: false,
    						vtype: 'email'
    					  })
                    },{
                        id       :'taxnumber',
                        header   : '<?= $this->taxnumber ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'taxnumber',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'bank_account',
                        header   : '<?= $this->bank_account ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'bank_account',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'BIC',
                        header   : '<?= $this->BIC ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'BIC',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'job_title',
                        header   : '<?= $this->job_title ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'job_title',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'salary',
                        header   : '<?= $this->salary ?>', 
                        width    : 200, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'salary',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
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
                        id       :'taxation_city',
                        header   : '<?= $this->taxation_city ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'taxation_city',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'basic_prosent',
                        header   : '<?= $this->basic_prosent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'basic_prosent',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'extra_prosent',
                        header   : '<?= $this->extra_prosent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'extra_prosent',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'Yearlysalarylimit',
                        header   : '<?= $this->Yearlysalarylimit ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Yearlysalarylimit',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    },{
                        id       :'Taxationcountingmethod',
                        header   : '<?= $this->Taxationcountingmethod ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Taxationcountingmethod',
                        editor: new fm.ComboBox({
                            typeAhead: true,
                            triggerAction: 'all',
                            //transform: 'light',
                            mode: 'local',
                            displayField: 'value',
			                valueField: 'id',
                            store: new Ext.data.SimpleStore({
                                fields: ['id','value'],
                                data:[
								["A","A"],
								["B","B"]
								]
                            }),
                            lazyRender: true,
                            listClass: 'x-combo-list-small'
                        })
                    },{
                        id       :'Taxcard_come_into_effect_date',
                        header   : '<?= $this->Taxcard_come_into_effect_date ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Taxcard_come_into_effect_date',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false
                        }
                    },{
                        id       :'Retrimentmodel',
                        header   : '<?= $this->Retrimentmodel ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'Retrimentmodel',
                        editor: new fm.ComboBox({
                            typeAhead: true,
                            triggerAction: 'all',
                            //transform: 'light',
                            displayField: 'value',
			                valueField: 'id',
			                mode: 'local',
                            store: new Ext.data.SimpleStore({
                                fields: ['id','value'],
                                data:[
								["YEL","YEL"],
								["TYEL alle 53","TYEL alle 53"],
								["TYEL yli 53","TYEL yli 53"]
								]
                            }),
                            lazyRender: true,
                            listClass: 'x-combo-list-small'
                        })
                    },{
                        id       :'AY_membershippaymentpersent',
                        header   : '<?= $this->AY_membershippaymentpersent ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'AY_membershippaymentpersent',
                        editor: new fm.TextField({
    						allowBlank: false
    					  })
                    }
                    ]
                }),
                //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                    store: store,           
                    pageSize: 200,
                    id:'paging-toolbar',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->nocareers ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['employee_id']
                        ,disableIndexes:['employee_id', 'user_id', 'sotu', 'address', 'city', 'zip', 'bank_account', 'taxnumber', 'phone', 'tes', 'salary', 'start_date', 'effective_date']
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
                waitMsg: 'Lataa työn tekijöitä uudestaan...',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'employee_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-careers',
                renderTo: 'CareersGrid',
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
                        	    grid.selModel.clearSelections();
                        	    Ext.getCmp('download').disable();
        		            	//Ext.getCmp('refresh-grid-qualifications').disable();
        		            	Ext.getCmp('new-grid-qualifications').disable();
        		            	//Ext.getCmp('move-career-grid').disable();
        		            	Ext.getCmp('replace-cv-grid').disable();
        		            	//Ext.getCmp('delete-career-grid').disable();
        		            	Ext.getCmp('new-grid-taxcard').disable();
        		            	Ext.getCmp('delete-grid-taxcard').disable();
        		            	Ext.getCmp('replace-taxcard-grid').disable();
        		                Ext.getCmp('download-grid-taxcards').disable();
        		                
        		                Ext.getCmp('download-grid-certificates').disable();
        		            	Ext.getCmp('delete-grid-qualifications').disable();
        		                Ext.getCmp('replace-qualification-grid').disable();
        		            	
	                            store.reload();
	                            gridQualifications.store.clearData();
	    		                gridQualifications.view.refresh();
	                            gridQualifications.selModel.clearSelections();
	                            storeQualifications.reload();
	                            
	                            gridTaxcards.store.clearData();
	    		                gridTaxcards.view.refresh();
	                            gridTaxcards.selModel.clearSelections();
	                            storeTaxcards.reload();
	                        }},
		                     /*{
			                        id: 'move-career-grid',
		                        	text: '<?= $this->move_career ?>',
			                        tooltip: '<?= $this->move_career_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: moveCR
			                 },*/
			                 {
			                        id: 'replace-cv-grid',
		                        	text: '<?= $this->replace_cv ?>',
			                        tooltip: '<?= $this->replace_cv_tooltip ?>',
			                        iconCls: 'refresh-icon',
			                        disabled: true,
			                        handler: replaceCV
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
		                                                 
		                                window.location = '/zf/public/careers/download.' + encoded_keys + '.pdf';
		                                
		                            }
		                        }
                        ]
            });
            
            var replaceform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/careers/json/replace",
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
            
            var replaceqaform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/careers/json/replaceqa",
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
                id:'replace_qa_id',
                name: 'replace_qa_id',
                hidden:true
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file-qa-replace',
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

            function replaceQA() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replaceqawin) {
                    replaceqawin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'replace-qa-new',
                                //layout : 'fit',
                                width : 480,
                                height : 120,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->replaceqa ?>',
                                items : [replaceqaform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/careers/json/replaceqa";
                                                if(replaceqaform.getForm().isValid()){
            									replaceqawin.hide();
                                                replaceqaform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        replaceqaform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('download-grid-certificates').disable();
                                                                    	Ext.getCmp('delete-grid-qualifications').disable();
                                                                        Ext.getCmp('replace-qualification-grid').disable();
                                                						
                                                						grid.selModel.clearSelections();
                                            
                                                						store.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	replaceqaform
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
                                                replaceqaform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                replaceqawin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replaceqawin.show(this);
            }

            function replaceCV() {

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
                                                var url = "/zf/public/careers/json/replace";
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
                                                		            	//Ext.getCmp('refresh-grid-qualifications').disable();
                                                		            	Ext.getCmp('new-grid-qualifications').disable();
                                                		            	//Ext.getCmp('move-career-grid').disable();
                                                		            	Ext.getCmp('replace-cv-grid').disable();
                                                		            	//Ext.getCmp('delete-career-grid').disable();
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
            
            var replacetcform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/careers/json/replacetc",
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
                id:'replace_tc_id',
                name: 'replace_tc_id',
                hidden:true
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file-tc-replace',
                    emptyText: '<?= $this->select_pdf ?>',
                    fieldLabel: '<?= $this->select_pdf_label ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
                    name: 'tcpath',
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

            function replaceTC() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!replacetcwin) {
                    replacetcwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'replace-tc-new',
                                //layout : 'fit',
                                width : 480,
                                height : 120,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->replacetc ?>',
                                items : [replacetcform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/careers/json/replacetc";
                                                if(replacetcform.getForm().isValid()){
            									replacetcwin.hide();
                                                replacetcform
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                        replacetcform
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        Ext.getCmp('delete-grid-taxcard').disable();
                                                		            	Ext.getCmp('replace-taxcard-grid').disable();
                                                		                Ext.getCmp('download-grid-taxcards').disable();
                                                						
                                                						gridTaxcards.selModel.clearSelections();
                                            
                                                						storeTaxcards.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	replacetcform
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
                                                replacetcform.getForm().reset();
                                                //myaccount_password_auto.getForm().reset();
                                                //store.reload();
                                                replacetcwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                replacetcwin.show(this);
            }
            
            function moveCR() {
				
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
					, url: '/zf/public/careers/json/movecr'
					, params: { 
						task: "movecr"
						, deleteKeys: encoded_keys
						, key: 'employee_id'
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
						//Ext.getCmp('poista-tili').disable();
						//Ext.getCmp('xls').disable();
						//storechart.reload();
					    //storechart.loadData();
						Ext.getCmp('download').disable();
		            	//Ext.getCmp('refresh-grid-qualifications').disable();
		            	Ext.getCmp('new-grid-qualifications').disable();
		            	//Ext.getCmp('move-career-grid').disable();
		            	Ext.getCmp('replace-cv-grid').disable();
		            	//Ext.getCmp('delete-career-grid').disable();
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
			
            function deleteCR() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletecareertext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = grid.selModel.selections.items;
				var selectedKeys = grid.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/careers/json/deletecr'
					, params: { 
						task: "deletecr"
						, deleteKeys: encoded_keys
						, key: 'employee_id'
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
						//Ext.getCmp('poista-tili').disable();
						//Ext.getCmp('xls').disable();
						//storechart.reload();
					    //storechart.loadData();
						Ext.getCmp('download').disable();
		            	//Ext.getCmp('refresh-grid-qualifications').disable();
		            	Ext.getCmp('new-grid-qualifications').disable();
		            	//Ext.getCmp('move-career-grid').disable();
		            	Ext.getCmp('replace-cv-grid').disable();
		            	//Ext.getCmp('delete-career-grid').disable();
		            	Ext.getCmp('download-grid-certificates').disable();
                	    Ext.getCmp('delete-grid-qualifications').disable();
                	    Ext.getCmp('replace-qualification-grid').disable();
                	    //Ext.getCmp('refresh-grid-qualifications').enable();
                    	Ext.getCmp('new-grid-qualifications').enable();
		            	grid.selModel.clearSelections();
						store.reload();
						gridQualifications.store.clearData();
		                gridQualifications.view.refresh();
                        gridQualifications.selModel.clearSelections();
                        storeQualifications.reload();
                       }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
            
         // create the Grid
           var gridQualifications = new Ext.grid.EditorGridPanel({
                store: storeQualifications,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'qualification_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'qualification_id'
                    },{
                        id       :'fullname',
                        header   : '<?= $this->employee_name ?>', 
                        width    : 250, 
                        sortable : true,
                        locked:true,
                        dataIndex: 'fullname'
                    },{
                        id       :'eduction_name',
                        header   : '<?= $this->qualification_name ?>', 
                        width    : 300, 
                        sortable : false,
                        dataIndex: 'qualification_name',
                        editor: new Ext.form.ComboBox({									    
							store: storeEducation,
							displayField: 'DisplayField',
			                valueField: 'KeyField',
							typeAhead: false,
							lazyRender: true,
							triggerAction: 'all',
							disabled:false									
						})
						, renderer: function(data) {
							record = storeEducation.getById(data);
							if(record) {
								return record.data.DisplayField;
							} else {
								return '( <?= $this->puuttuu ?> )';
							}
						}
                    },{
                        id       :'date_completed',
                        header   : '<?= $this->date_completed ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'date_completed',
                        renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                        editor: {
                            xtype: 'datefield',
                            allowBlank: false,
                            minValue: '01/01/1970',
                            minText: '<?= $this->min_date ?>',
                            maxValue: '12/31/2999'
                        }
                    },{
                        id       :'experience_in_years',
                        header   : '<?= $this->experience_in_years ?>', 
                        width    : 180, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'experience_in_years',
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
                 /*bbar: new Ext.PagingToolbar({
                    store: storeQualifications,           
                    pageSize: 50,
                    id:'paging-toolbar-qualifications',
                    prependButtons: true,
                    beforePageText: '<?= $this->page ?>',
                    displayInfo: '{0} / {1} - {2}',
                    displayMsg: '{0} / {1} - {2}',
                    emptyMsg: '<?= $this->noqualifications ?>'}
                ),*/
                /*plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['qualification_id']
                        ,disableIndexes:['qualification_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,checkIndexes:['qualification_name']
                        ,searchText:'<?= $this->search ?>'
                        ,autoFocus:true
                        ,menuStyle:'radio'
                    })],*/
                collapsible: false,
                animCollapse: false,
                enableDragDrop: false,
                selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                enableColumnResize: false,
                enableColumnMove: false,
                enableHdMenu: false,
                loadMask:true,
                waitMsg: 'Lataa voimassaolevia koulutuksia uudestaan...',
                clicksToEdit: 2,
                stripeRows: true,
                //autoExpandColumn: 'qualification_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight() * 0.5,
                title: '<?= $this->qualifications ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-qualifications',
                //renderTo: 'CareersGrid',
                view: new Ext.ux.grid.LockingGridView({
                    forceFit: false
                    //showGroupName: false,
                    //enableNoGroups: false,
                    //enableGroupingMenu: false,
                    //hideGroupedColumn: true
                    }),
                tbar: [
                        '-',                         
                        /*{
	                        id: 'refresh-grid-qualifications',
                        	text: '<?= $this->refresh_qualifications ?>',
	                        tooltip: '<?= $this->refresh_qualifications_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
                        	    Ext.getCmp('download-grid-certificates').disable();
                        	    Ext.getCmp('delete-grid-qualifications').disable();
                        	    Ext.getCmp('replace-qualification-grid').disable();
                        	    gridQualifications.selModel.clearSelections();
                        	    gridQualifications.store.clearData();
                                gridQualifications.view.refresh();
                            	storeQualifications.reload();
	                        }}
                        ,*/                       
                        {
	                        id: 'new-grid-qualifications',
                        	text: '<?= $this->new_qualification ?>',
	                        tooltip: '<?= $this->new_qualification_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: newQA
                        },
                        {
	                        id: 'delete-grid-qualifications',
                        	text: '<?= $this->delete_qualification ?>',
	                        tooltip: '<?= $this->delete_qualification_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: deleteQA
                        },
                        {
	                        id: 'replace-qualification-grid',
                        	text: '<?= $this->replace_qualification ?>',
	                        tooltip: '<?= $this->replace_qualification_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: replaceQA
	                    },
                        {
	                        id: 'download-grid-certificates',
                        	text: '<?= $this->download_certificate ?>',
	                        tooltip: '<?= $this->download_certificate_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
	                        	//store.reload();
	                            var selectedRows = gridQualifications.selModel.selections.items;
	                
	                            var selectedKeys = gridQualifications.selModel.selections.keys; 
	
	                            var encoded_keys = Ext.encode(selectedKeys);
	                            
	                            //encoded_keys = 
	                            
	                            encoded_keys = encoded_keys.replace('["', '');
	                            encoded_keys = encoded_keys.replace('"]', '');
	
	                            //alert(encoded_keys[0]);                 
	                                             
	                            window.location = '/zf/public/careers/download_certificate.' + encoded_keys + '.pdf';
	                            
	                        }}   
                        ]
            });
           
           gridQualifications.addListener('afteredit', saveQualificationGridEdit, this);
           
           function deleteQA() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletetext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridQualifications.selModel.selections.items;
				var selectedKeys = gridQualifications.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/careers/json/deleteqa'
					, params: { 
						task: "deleteqa"
						, deleteKeys: encoded_keys
						, key: 'qualification_id'
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
						
		            	Ext.getCmp('download-grid-certificates').disable();
		            	Ext.getCmp('delete-grid-qualifications').disable();
		            	gridQualifications.selModel.clearSelections();
		            	storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
		            	gridQualifications.store.clearData();
		                gridQualifications.view.refresh();
		            	storeQualifications.reload();
                      }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
			
            function deleteTC() {
				
				Ext.Msg.show({
					   title:'<?= $this->areyousuretitle ?>',
					   msg: '<?= $this->areyousuredeletetext ?>',
					   buttons: Ext.Msg.YESNO,
					   fn: function(btn) {
					                 if (btn=='yes') {  

				var selectedRows = gridTaxcards.selModel.selections.items;
				var selectedKeys = gridTaxcards.selModel.selections.keys; 
				var encoded_keys = Ext.encode(selectedKeys);
				Ext.Ajax.request({
					waitMsg: '<?= $this->sending ?>'
					, url: '/zf/public/careers/json/deletetc'
					, params: { 
						task: "deletetc"
						, deleteKeys: encoded_keys
						, key: 'taxcard_id'
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
						
						Ext.getCmp('delete-grid-taxcard').disable();
		            	Ext.getCmp('replace-taxcard-grid').disable();
		                Ext.getCmp('download-grid-taxcards').disable();
		            	gridTaxcards.selModel.clearSelections();
		            	storeTaxcards.proxy.conn.url = "/zf/public/careers/json/taxcards?employee_id="+json.employee_id;
		            	gridTaxcards.store.clearData();
		                gridTaxcards.view.refresh();
		            	storeTaxcards.reload();
                      }
					, scope: this
				});
				
				   }
					                 
				   },
				   animEl: 'elId',
				   icon: Ext.MessageBox.QUESTION
				});
			};
           
           function saveQualificationGridEdit (Grid_Event) {            

               Ext.Ajax.request({
                   waitMsg: 'Saving changes...'
                   , url: '/zf/public/careers/json/qualificationedit'
                   , params: { 
                       task: "edit"
                       , key: 'id' 
                       , keyID: Grid_Event.record.data.qualification_id
                       , field: Grid_Event.field
                       , value: Grid_Event.value             
                       }
                   , failure:function(response,options){
                       Ext.MessageBox.alert('Warning','Oops...');
                   }                            
                   , success:function(response,options){                       
                	   storeQualifications.commitChanges();
                       storeQualifications.proxy.conn.url = "/zf/public/jobseekers/json/qualifications?employee_id="+Grid_Event.record.data.employee_id;
                       gridQualifications.store.clearData();
                       gridQualifications.view.refresh();
                   	   storeQualifications.reload();
                   }      
                   , scope: this
               });
           };
            
            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/careers/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: true,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [
                         {fieldLabel : '<?= $this->firstname ?>',
                         name : 'firstname',
                         allowBlank : false,
                         xtype:'textfield',
                         hidden:false
                     },
                     {fieldLabel : '<?= $this->lastname ?>',
                         name : 'lastname',
                         allowBlank : false,
                         xtype:'textfield',
                         hidden:false
                     },
                     {fieldLabel : '<?= $this->sotu ?>',
                     name : 'sotu',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },
                     {fieldLabel : '<?= $this->address ?>',
                     name : 'address',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },{fieldLabel : '<?= $this->zip ?>',
                     name : 'zip',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },
                 {
                     fieldLabel : '<?= $this->city ?>',
                     name : 'city',
             		hiddenName: 'city',
                     allowBlank : false,
             		xtype:'combo',
             		//value:'1',
             		store: storeStartplace,
 					displayField: 'DisplayField',
 	                valueField: 'KeyField',
                     mode: 'local',
                     triggerAction: 'all'
             		},
                     {fieldLabel : '<?= $this->phone ?>',
                     name : 'phone',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },
                     {fieldLabel : '<?= $this->email ?>',
                     name : 'email',
                     allowBlank : false,
                     xtype:'textfield',
                     vtype: 'email',
                     hidden:false
                 },
                     {fieldLabel : '<?= $this->taxnumber ?>',
                     name : 'taxnumber',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },{fieldLabel : '<?= $this->bank_account ?>',
                     name : 'bank_account',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
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
                ]
            });
            
            function createNT() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-career',
                                //layout : 'fit',
                                width : 480,
                                height : 380,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_career ?>',
                                items : [newform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/careers/json/createnew";
                                               // alert('moi');
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
                                                newform.getForm().reset();
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
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/careers/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.employee_id
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
            
            // create the Grid
            var gridTaxcards = new Ext.grid.EditorGridPanel({
                 store: storeTaxcards,
                 cm: new Ext.ux.grid.LockingColumnModel({
                     defaults: {
                         //width: 40,
                         sortable: true
                     },
                     columns: [
                         {
                         id       :'taxcard_id',
                         header   : 'ID', 
                         width    : 40, 
                         sortable : true,
                         locked:true,
                         dataIndex: 'taxcard_id'
                     },{
                         id       :'employee_id',
                         header   : 'EID', 
                         width    : 40, 
                         sortable : true,
                         locked:true,
                         dataIndex: 'employee_id'
                     },{
                         id       :'fullname_taxcard',
                         header   : '<?= $this->employee_name ?>', 
                         width    : 250, 
                         sortable : true,
                         locked:true,
                         dataIndex: 'fullname'
                     },{
                         id       :'date_come_to_effective',
                         header   : '<?= $this->date_come_to_effective ?>', 
                         width    : 180, 
                         sortable : true,
                         locked:false,
                         dataIndex: 'date_come_to_effective',
                         renderer:  Ext.util.Format.dateRenderer('d.m.Y'),
                         editor: {
                             xtype: 'datefield',
                             allowBlank: false,
                             minValue: '01/01/1970',
                             minText: '<?= $this->min_date ?>',
                             maxValue: '12/31/2999'
                         }
                     }
                     ]
                 }),
                 //colModel: colModel,
                 bbar: new Ext.PagingToolbar({
                     store: storeTaxcards,           
                     pageSize: 50,
                     id:'paging-toolbar-taxcards',
                     prependButtons: true,
                     beforePageText: '<?= $this->page ?>',
                     displayInfo: '{0} / {1} - {2}',
                     displayMsg: '{0} / {1} - {2}',
                     emptyMsg: '<?= $this->notaxcards ?>'}
                 ),
                 /*plugins:[ new Ext.ux.grid.Search({
                         iconCls:'icon-zoom'
                         ,readonlyIndexes:['qualification_id']
                         ,disableIndexes:['qualification_id']
                         ,minChars:3
                         //,xtype:'combo'
                         ,checkIndexes:['qualification_name']
                         ,searchText:'<?= $this->search ?>'
                         ,autoFocus:true
                         ,menuStyle:'radio'
                     })],*/
                 collapsible: false,
                 animCollapse: false,
                 enableDragDrop: false,
                 selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
                 enableColumnResize: false,
                 enableColumnMove: false,
                 enableHdMenu: false,
                 loadMask:true,
                 waitMsg: 'Lataa verokortteja uudestaan...',
                 clicksToEdit: 2,
                 stripeRows: true,
                 //autoExpandColumn: 'qualification_id',
                 width: Ext.lib.Dom.getViewWidth(),
                 height: Ext.lib.Dom.getViewHeight() * 0.5,
                 title: '<?= $this->taxcards ?>',
                 // config options for stateful behavior
                 stateful: true,
                 stateId: 'grid-taxcards',
                 //renderTo: 'CareersGrid',
                 view: new Ext.ux.grid.LockingGridView({
                     forceFit: false
                     //showGroupName: false,
                     //enableNoGroups: false,
                     //enableGroupingMenu: false,
                     //hideGroupedColumn: true
                     }),
                 tbar: [
                         '-',                         
                         /*{
 	                        id: 'refresh-grid-qualifications',
                         	text: '<?= $this->refresh_qualifications ?>',
 	                        tooltip: '<?= $this->refresh_qualifications_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: function () {
                         	    Ext.getCmp('download-grid-certificates').disable();
                         	    Ext.getCmp('delete-grid-qualifications').disable();
                         	    Ext.getCmp('replace-qualification-grid').disable();
                         	    gridQualifications.selModel.clearSelections();
                         	    gridQualifications.store.clearData();
                                 gridQualifications.view.refresh();
                             	storeQualifications.reload();
 	                        }}
                         ,*/                       
                         {
 	                        id: 'new-grid-taxcard',
                         	text: '<?= $this->new_taxcard ?>',
 	                        tooltip: '<?= $this->new_taxcard_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: newTC
                         },
                         {
 	                        id: 'delete-grid-taxcard',
                         	text: '<?= $this->delete_taxcard ?>',
 	                        tooltip: '<?= $this->delete_taxcard_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: deleteTC
                         },
                         {
 	                        id: 'replace-taxcard-grid',
                         	text: '<?= $this->replace_taxcard ?>',
 	                        tooltip: '<?= $this->replace_taxcard_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: replaceTC
 	                    },{
 	                        id: 'download-grid-taxcards',
                         	text: '<?= $this->download_taxcards ?>',
 	                        tooltip: '<?= $this->download_taxcards_tooltip ?>',
 	                        iconCls: 'refresh-icon',
 	                        disabled: true,
 	                        handler: function () {
 	                        	//store.reload();
 	                            var selectedRows = gridTaxcards.selModel.selections.items;
 	                
 	                            var selectedKeys = gridTaxcards.selModel.selections.keys; 
 	
 	                            var encoded_keys = Ext.encode(selectedKeys);
 	                            
 	                            //encoded_keys = 
 	                            
 	                            encoded_keys = encoded_keys.replace('["', '');
 	                            encoded_keys = encoded_keys.replace('"]', '');
 	
 	                            //alert(encoded_keys[0]);                 
 	                                             
 	                            window.location = '/zf/public/careers/download_taxcards.' + encoded_keys + '.pdf';
 	                            
 	                        }
                         }   
                         ]
             });
            
            grid.addListener('afteredit', saveGridEdit, this);
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {

            	Ext.getCmp('download').enable();
            	
            	//Ext.getCmp('refresh-grid-qualifications').enable();
            	Ext.getCmp('new-grid-qualifications').enable();
            	
            	Ext.getCmp('new-grid-taxcard').enable();
            	//Ext.getCmp('move-career-grid').enable();
            	Ext.getCmp('replace-cv-grid').enable();
            	//Ext.getCmp('delete-career-grid').enable();
            	
            	Ext.getCmp('download-grid-certificates').disable();
            	Ext.getCmp('delete-grid-qualifications').disable();
                Ext.getCmp('replace-qualification-grid').disable();
                
                Ext.getCmp('delete-grid-taxcard').disable();
            	Ext.getCmp('replace-taxcard-grid').disable();
                Ext.getCmp('download-grid-taxcards').disable();
            	
            	Ext.getCmp('employee_id_form').setValue(r.get('employee_id'));
            	
            	Ext.getCmp('employee_id_form_taxcard').setValue(r.get('employee_id'));
            	
            	Ext.getCmp('replace_id').setValue(r.get('employee_id'));
            	
            	storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+r.get('employee_id');
            	gridQualifications.store.clearData();
                gridQualifications.view.refresh();
            	storeQualifications.reload();
            	
            	storeTaxcards.proxy.conn.url = "/zf/public/careers/json/taxcards?employee_id="+r.get('employee_id');
            	gridTaxcards.store.clearData();
                gridTaxcards.view.refresh();
            	storeTaxcards.reload();
				
             });
            
            gridQualifications.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {

            	Ext.getCmp('download-grid-certificates').enable();
            	Ext.getCmp('delete-grid-qualifications').enable();
                Ext.getCmp('replace-qualification-grid').enable();
            	
            	Ext.getCmp('replace_qa_id').setValue(r.get('qualification_id'));
				
             });
            
            gridTaxcards.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {

            	Ext.getCmp('delete-grid-taxcard').enable();
            	Ext.getCmp('replace-taxcard-grid').enable();
                Ext.getCmp('download-grid-taxcards').enable();
                
                Ext.getCmp('replace_tc_id').setValue(r.get('taxcard_id'));
				
             });
            
            var newqualification = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/careers/json/createnewqualification",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 280,
                border : false,
                fileUpload: true,
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
                    fieldLabel : 'ID',
                    id: 'employee_id_form',
                    name : 'employee_id',
                    hiddenName: 'employee_id',
                    allowBlank : false,
                    anchor:'95%',
                    hidden: true
                },{
                    fieldLabel : '<?= $this->qualification_name ?>',
                    name : 'qualification_name',
            		hiddenName: 'qualification_name',
                    allowBlank : false,
            		xtype:'combo',
            		//value:'1',
            		store: storeEducation,
					displayField: 'DisplayField',
	                valueField: 'KeyField',
                    mode: 'local',
                    triggerAction: 'all',
                    anchor:'95%'
            		},/*{
                    fieldLabel : '<?= $this->qualification_name ?>',
                    name : 'qualification_name',
                    allowBlank : false,
                    anchor:'95%'
                },*/{
                    fieldLabel : '<?= $this->effective_date ?>',
                    name : 'effective_date',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y',
                    anchor:'95%'
                },{
                    fieldLabel : '<?= $this->experience_in_years ?>',
                    name : 'experience_in_years',
                    allowBlank : false,
                    anchor:'95%'
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file-qa',
                    emptyText: '<?= $this->select_pdf ?>',
                    fieldLabel: '<?= $this->select_pdf_label_qualification ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
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
                                title : '<?= $this->new_agreement ?>',
                                items : [newqualification],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/careers/json/createnewqualification";
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
                                                                        storeQualifications.proxy.conn.url = "/zf/public/careers/json/qualifications?employee_id="+json.employee_id;
                                                                        storeQualifications.reload();
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
            
            var newtc = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 200,
                url : "/zf/public/careers/json/createnewtaxcard",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 470,
                height : 280,
                border : false,
                fileUpload: true,
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
                    fieldLabel : 'ID',
                    id: 'employee_id_form_taxcard',
                    name : 'employee_id',
                    hiddenName: 'employee_id',
                    allowBlank : false,
                    anchor:'95%',
                    hidden: true
                },{
                    fieldLabel : '<?= $this->date_come_to_effective ?>',
                    name : 'date_come_to_effective',
                    allowBlank : false,
                    xtype: 'datefield',
                    format: 'd.m.Y',
                    anchor:'95%'
                },{
                    xtype: 'fileuploadfield',
                    id: 'form-file-tc',
                    emptyText: '<?= $this->select_pdf ?>',
                    fieldLabel: '<?= $this->select_pdf_label_taxcard ?>'+ ' (<?php echo ini_get('upload_max_filesize'); ?>)',
                    name: 'tcpath',
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
                    }]
                }
            });

            function newTC() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newtcwin) {
                    newtcwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-qa',
                                //layout : 'fit',
                                width : 500,
                                height : 280,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_taxcard ?>',
                                items : [newtc],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/careers/json/createnewtaxcard";
                                                if(newtc.getForm().isValid()){
            									newtcwin.hide();
            									newtc
                                                        .getForm()
                                                        .submit(
                                                                {
                                                                    waitMsg : '<?= $this->sending ?>',
                                                                    url : url,
                                                                    success : function(
                                                                            form, action) {
                                                                	newtc
                                                                                .getForm()
                                                                                .reset();
                                                                        //myaccount_password_auto.getForm().reset();
            															var json = Ext.util.JSON.decode(action.response.responseText); 
                                                                        Ext.MessageBox
                                                                        .alert(
                                                                                '<?= $this->success ?>',
                                                                                json.msg);
                                                                        storeTaxcards.proxy.conn.url = "/zf/public/careers/json/taxcards?employee_id="+json.employee_id;
                                                                        storeTaxcards.reload();
                                                                    },
                                                                    failure : function(
                                                                            form, action) {
                                                                    	newtc
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
                                                newtcwin.hide();
                                            }
                                        } ]
                            });
            				
                }
                newtcwin.show(this);
            }
            
           storeStartplace.on('load', function() {
            	
            	var storeLoaded = readCookie('storeLoaded_career');
            	
            	if (storeLoaded==="false") {
            	store.load({params: { "start":0, "limit":200, "query":"" }});
            	createCookie("storeLoaded_career", "true", 31);
            	}
            	
			});
           
           var tabsQualifications = new Ext.TabPanel({
           	renderTo: 'CareersGrid',
               width: Ext.lib.Dom.getViewWidth(),
               height: Ext.lib.Dom.getViewHeight() * 0.5,
               activeTab: 0,
               deferredRender: false,
               autoTabs: true,
               frame:true,
               defaults:{autoHeight: false},
               items:[
                   gridQualifications,
                   gridTaxcards
               ]
           });
            
 });