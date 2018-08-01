<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
 
class Settings_Nagios_IndexAjax_Action extends Settings_Vtiger_Index_Action {

   function __construct() {
	   parent::__construct();
	   $this->exposeMethod('nagiosSettings');	   
	}
	
	public function process(Vtiger_Request $request) {
		global $adb;
		
		$mode = $request->get('mode');
		if (!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
		
		$adb = PearDatabase::getInstance(); 
		/*$id = $_SESSION['authenticated_user_id'];

		$sql = "SELECT count(id) as total FROM `chat_messages` where to_id = ? and read_status=0";
		$qry = $adb->pquery($sql,array($id));
		$res = $adb->fetch_array($qry);
		$result = $res['total'];

		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();*/
		 
	}
	
	public function nagiosSettings(Vtiger_Request $request){
		global $adb;
		$adb = PearDatabase::getInstance(); 
		$userid = $_SESSION['authenticated_user_id'];
		$response = new Vtiger_Response();
		$qualifiedModuleName = $request->getModule(false);
		$server = $request->get('server');
		//$user = $request->get('user');
		//$pwd = $request->get('pwd');
		
		$check = $adb->pquery("SELECT * FROM vtiger_nagios_settings WHERE userid=?",array($userid));
		$row = $adb->num_rows($check);
		if($row == 0){
			//$adb->pquery("INSERT INTO vtiger_nagios_settings (userid, server, user, pwd) VALUES(?,?,?,?)", array($userid, $server, $user, $pwd));
			$adb->pquery("INSERT INTO vtiger_nagios_settings (userid, server) VALUES(?,?)", array($userid, $server));
			$responseData = array("message"=>"Added.\n", 'SUCCESS'=>true);
		}else{
			//$adb->pquery("UPDATE vtiger_nagios_settings SET server=?, user=?, pwd=? WHERE userid=?", array($server, $user, $pwd, $userid));
			$adb->pquery("UPDATE vtiger_nagios_settings SET server=? WHERE userid=?", array($server, $userid));
			$responseData = array("message"=>"Updated.\n", 'SUCCESS'=>true);
		}
		$response->setResult($responseData);
		$response->emit();
	}
	
}
?>
