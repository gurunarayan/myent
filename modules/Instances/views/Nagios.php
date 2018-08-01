<?php 
/** License Text Here **/
class Instances_Nagios_View extends Vtiger_Index_View {
    function __construct() {
		parent::__construct();
		
		//$this->exposeMethod('ViewEntities');	 
	}
	
	public function preProcess(Vtiger_Request $request, $display = true) {
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE_NAME', $request->getModule());

		parent::preProcess($request, false);
		if($display) {
			$this->preProcessDisplay($request);
		}
	}
   
	protected function preProcessTplName(Vtiger_Request $request) {
		return 'DashBoardPreProcess.tpl';
	}
	public function getHeaderCss1(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$parentCSSScripts = parent::getHeaderCss($request);
		$styleFileNames = array(

			);
		$cssScriptInstances = $this->checkAndConvertCssStyles($styleFileNames);
		$headerCSSScriptInstances = array_merge($parentCSSScripts, $cssScriptInstances);
		return $headerCSSScriptInstances;
	}
	public function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$jsFileNames = array(
		
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	public function process(Vtiger_Request $request) {
		global $adb;
		$mode = $request->getMode();
		$recordid = $request->get('record');
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}
		$query = $adb->pquery("SELECT cf_760, cf_762 FROM vtiger_instancescf WHERE instancesid=? ",array($recordid));
		$server = $adb->query_result($query, 0, 'cf_760');
		$host = $adb->query_result($query, 0, 'cf_762');
		
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$viewer->assign('MODULEMODEL', $moduleModel);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('RECORDID', $recordid);
		$viewer->assign('SERVER', $server);
		$viewer->assign('HOST', $host);
		$viewer->view('Nagios.tpl', $request->getModule());
	}
	
}
?>