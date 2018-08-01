<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_Nagios_Index_View extends Settings_Vtiger_Index_View {

	
	public function process(Vtiger_Request $request) {
		$db = PearDatabase::getInstance();
		//$db->setDebug(true);
		$userid = $_SESSION['authenticated_user_id'];
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
		$sourceModule = $request->get('source_module');
		
		$query = $db->pquery("SELECT * FROM vtiger_nagios_settings WHERE userid=?",array($userid));
		$server = $db->query_result($query, 0, 'server');
		//$user = $db->query_result($query, 0, 'user');
		//$pwd = $db->query_result($query, 0, 'pwd');
		
		$data = array();
		//$data = [$server, $user, $pwd];
		$data = [$server];
		$viewer->assign('DATA', $data);
		$viewer->assign('SOURCE_MODULE', $sourceModule);
		$viewer->view('Index.tpl', $qualifiedModuleName);
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
		
			'modules.Vtiger.resources.List',
			'modules.Settings.Vtiger.resources.List',
			"modules.Settings.$moduleName.resources.Settings",
			"modules.Settings.Vtiger.resources.$moduleName",
			
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}
	
	
    public function validateRequest(Vtiger_Request $request) { 
        $request->validateReadAccess(); 
    }
}
