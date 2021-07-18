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
            //var newwin;
            
            var store = new Ext.data.Store({
                url: '/zf/public/timesheetscrm/json/index',
                reader: new Ext.data.JsonReader({root: 'timesheets',
                    totalProperty: 'totalCount',id: 'timesheet_id'}, 
                        [{name: 'timesheet_id',type: 'int'},
                         {name: 'username',type: 'string'},
                         {name: 'timesheet_name',type: 'string'},
                         {name: 'next',type: 'string'},
                         {name: 'next_user',type: 'int'},
                         {name: 'status',type: 'string'},
                         {name: 'occupation',type: 'string'},
                         {name: 'order_id',type: 'string'},
                         {name: 'memo',type: 'string'}]),
                        baseParams: { "limit":50 },
                        sortInfo:{field: 'timesheet_id', direction: "DESC"}
             });
            
            store.load({params: { "start":0, "limit":50, "query":"" }});
            
            // create the Grid
            var grid = new Ext.grid.GridPanel({
                store: store,
                cm: new Ext.ux.grid.LockingColumnModel({
                    defaults: {
                        //width: 40,
                        sortable: true
                    },
                    columns: [
                        {
                        id       :'timesheet_id',
                        header   : 'ID', 
                        width    : 40, 
                        sortable : true,
                        locked:false,
                        dataIndex: 'timesheet_id'
                    },{
                        id       : 'timesheet_name',
                        header   : '<?= $this->timesheet_name ?>', 
                        width    : 400, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'timesheet_name'
                    },{
                        id       : 'username',
                        header   : '<?= $this->username ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'username'
                    },{
                        id       : 'order_id',
                        header   : '<?= $this->order_id ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'order_id'
                    },{
                        id       :'occupation',
                        header   : '<?= $this->occupation ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'occupation'
                    },{
                        id       :'status',
                        header   : '<?= $this->status ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'status'
                    },{
                        id       :'memo',
                        header   : '<?= $this->memo ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'memo'
                    },{
                        id       :'next',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        dataIndex: 'next'
                    },{
                        id       :'next_user',
                        header   : '<?= $this->next ?>', 
                        width    : 200, 
                        sortable : false,
                        locked:false,
                        hidden:true,
                        dataIndex: 'next_user'
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
                    emptyMsg: '<?= $this->notimesheets ?>'}
                ),
                plugins:[ new Ext.ux.grid.Search({
                        iconCls:'icon-zoom'
                        ,readonlyIndexes:['timesheet_id']
                        ,disableIndexes:['timesheet_id']
                        ,minChars:3
                        //,xtype:'combo'
                        ,searchText:'<?= $this->search ?>'
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
                waitMsg: '',
                clicksToEdit: 2,
                stripeRows: true,
                autoExpandColumn: 'timesheet_id',
                width: Ext.lib.Dom.getViewWidth(),
                height: Ext.lib.Dom.getViewHeight(),
                //title: '<?= $this->module ?>',
                // config options for stateful behavior
                stateful: true,
                stateId: 'grid-timesheets',
                renderTo: 'TimesheetsGrid',
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
	                            store.reload();
	                        }},{
	                        id: 'edit-timesheet-grid',
                        	text: '<?= $this->edit_timesheet ?>',
	                        tooltip: '<?= $this->edit_timesheet_tooltip ?>',
	                        iconCls: 'refresh-icon',
	                        disabled: true,
	                        handler: function () {
                        	    var timesheet_id = readCookie('timesheet_id');
                        	    window.location = "/zf/public/timesheetscrm/index/timesheet?timesheet_id=" + timesheet_id;
	                        }}
                        ]
            });
            
            /*grid.addListener('afteredit', saveGridEdit, this);
            
            function saveGridEdit (Grid_Event) {            

                Ext.Ajax.request({
                    waitMsg: 'Saving changes...'
                    , url: '/zf/public/timesheet/json/gridedit'
                    , params: { 
                        task: "edit"
                        , key: 'id' 
                        , keyID: Grid_Event.record.data.timesheet_id
                        , field: Grid_Event.field
                        , value: Grid_Event.value             
                        }
                    , failure:function(response,options){
                        Ext.MessageBox.alert('Warning','Oops...');
                    }                            
                    , success:function(response,options){                       
                        store.commitChanges();
						store.reload();
                    }      
                    , scope: this
                });
            };
            
            var newform = new Ext.FormPanel( {
                id : Ext.id(),
                labelWidth : 120,
                url : "/zf/public/timesheet/json/createnew",
                frame : false,
                bodyStyle : 'padding:5px 5px 0 0',
                width : 460,
                border : false,
                fileUpload: false,
                defaults : {
                    width : 300
                },
                defaultType : 'textfield',
                items : [
                     {fieldLabel : '<?= $this->timesheet_name ?>',
                     name : 'timesheet_name',
                     allowBlank : false,
                     xtype:'textfield',
                     hidden:false
                 },
                 {
                     fieldLabel : '<?= $this->agreement ?>',
                     name : 'agreement_id',
             		hiddenName: 'agreement_id',
                     allowBlank : false,
             		xtype:'combo',
             		//value:'1',
             		store: storeAgreement,
 					displayField: 'DisplayField',
 	                valueField: 'KeyField',
                     mode: 'local',
                     triggerAction: 'all'
             		}
                ]
            });
            
            function createNewTimesheet() {

                // create the window on the first click and reuse on subsequent
                // clicks
                if (!newwin) {
                    newwin = new Ext.Window(
                            {
                                // applyTo:'hello-win',
                                id : 'create-new-career',
                                //layout : 'fit',
                                width : 480,
                                height : 180,
                                closeAction : 'hide',
                                plain : true,
                                title : '<?= $this->new_timesheet ?>',
                                items : [newform],
                                buttons : [
                                        {
                                            text : '<?= $this->submit ?>',
                                            handler : function() {
                                                var url = "/zf/public/timesheet/json/createnew";
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
            }*/
            
            store.on('load', function() {
            	
            	Ext.getCmp('edit-timesheet-grid').disable();
            	
			});
            
            grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
            	
            	Ext.getCmp('edit-timesheet-grid').enable();
            	
            	createCookie("timesheet_id", r.get('timesheet_id'), 31);
				
             });
 });
 
 