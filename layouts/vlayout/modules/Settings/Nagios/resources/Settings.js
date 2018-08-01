/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/*Settings_Vtiger_List_Js("Settings_Nagios_Settings_Js",{
},{
	
	registerEventToSaveSettings : function () {
        jQuery('#btnSaveNagiosSettings').on('click', function(e) {
            e.preventDefault();
            var progressIndicatorElement = jQuery.progressIndicator();
            var params={};
            params = jQuery("#formSettings").serializeFormData();
            
			console.log(params);
            AppConnector.request(params).then(
                function(data) {
					console.log(data);
                    progressIndicatorElement.progressIndicator({'mode':'hide'});
                    if(data.success == true){
                        var params = {};
                        params['text'] = 'Settings Saved';
                        //Settings_Vtiger_Index_Js.showMessage(params);
						//params['text'] = 'Settings Saved';
                        Vtiger_Helper_Js.showPnotify(params);
						window.location.href='index.php?module=Vtiger&parent=Settings&view=Index';
                    }
                },
                function(error,err){
                    progressIndicatorElement.progressIndicator({'mode':'hide'});
                }
            );
        });
    },


	registerEvents : function(){
		this.registerEventToSaveSettings();
	},

});*/
jQuery.Class("Settings_Nagios_Settings_Js", {
    
},{

    registerEventToSaveSettings : function () {
        jQuery('#btnSaveNagiosSettings').on('click', function(e) {
            e.preventDefault();
            var progressIndicatorElement = jQuery.progressIndicator();
            var params={};
            params = jQuery("#formSettings").serializeFormData();
            
			console.log(params);
            AppConnector.request(params).then(
                function(data) {
					console.log(data);
                    progressIndicatorElement.progressIndicator({'mode':'hide'});
                    if(data.success == true){
                        var params = {};
                        params['text'] = data.message;
                        //Settings_Vtiger_Index_Js.showMessage(params);
						//params['text'] = 'Settings Saved';
                        Vtiger_Helper_Js.showPnotify(params);
						window.location.href='index.php?module=Nagios&parent=Settings&view=NagiosView';
                    }
                },
                function(error,err){
                    progressIndicatorElement.progressIndicator({'mode':'hide'});
                }
            );
        });
    },
    
    registerEvents: function() {
        var thisInstance = this;
        this.registerEventToSaveSettings();
	}
    
});
jQuery(document).ready(function(){
	var instance = new Settings_Nagios_Settings_Js();
	instance.registerEvents();
})
