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
            
            var tb = new Ext.Toolbar({
            	region: 'south',
            	height: 40,
            	buttonAlign: 'right',
            	items: [
                {
                    text: '<?= $this->agree_agreement ?>',
                    tooltip: '<?= $this->agree_agreement_tooltip ?>',
                    iconCls: 'option-icon',
                    handler: function () {
                      document.location = '/zf/public/timesheetscrm/index/agreeagreement';
                    }
                }
            	]
            });
            
            var viewport = new Ext.Viewport({
                layout: 'border',
                renderTo: 'Agreement',
                items: [{
                    region: 'center',
                    layout: 'fit',
                    border: true,
                    frame: false,
                    id: 'mainframe',
                    defaultType: 'iframepanel',
                    defaults: {
                        loadMask: {hideOnReady :true,msg:'Loading...'},
                        border: false,
                        header: false
                    },
                    items: [{
                        id: 'iframe',
                        defaultSrc: '/zf/public/timesheetscrm/index/readagreement'

                    }]
                },tb
                ]
            });
 });
 
 