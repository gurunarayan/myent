<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_Nagios_NagiosView_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		global $adb;
		$adb = PearDatabase::getInstance();
		$userid = $_SESSION['authenticated_user_id'];
		$viewer = $this->getViewer($request);
		
		$query = $adb->pquery("SELECT * FROM vtiger_nagios_settings WHERE userid=?",array($userid));
		$server = $adb->query_result($query, 0, 'server');
		//$user = $adb->query_result($query, 0, 'user');
		//$pwd = $adb->query_result($query, 0, 'pwd');
		
		$data = array();
		//$data = [$server, $user, $pwd];
		$data = [$server];
		$viewer->assign('DATA', $data);
		$viewer->view('List.tpl', $request->getModule(false));
	}
	
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}
	

}