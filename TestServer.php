<?php
require_once('analyser/nusoap.php');

$server = new nusoap_server;

$server ->register('connString', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# connString');
//register a function that works on server
$server ->register('getUsersDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getUsersDetails');
$server ->register('getRoleDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getRoleDetails');
$server ->register('getGroupDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getGroupDetails');
$server ->register('getWorkflowDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getWorkflowDetails');
$server ->register('getModuleDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getModuleDetails');
$server ->register('getFilterDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getFilterDetails');
$server ->register('getFieldDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getFieldDetails');
$server ->register('getRelatedListDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getRelatedListDetails');
$server ->register('getRelatedModuleDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getRelatedModuleDetails');
$server ->register('getPicklistDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPicklistDetails');
$server ->register('getDashBoardDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getDashBoardDetails');
$server ->register('getTemplateDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getTemplateDetails');
$server ->register('getReportDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getReportDetails');
$server ->register('getScannerDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getScannerDetails');
$server ->register('getWebformDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getWebformDetails');
$server ->register('getCronDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getCronDetails');
$server ->register('getPortalDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPortalDetails');
$server ->register('getPdfMakerDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPdfMakerDetails');
$server ->register('getPBXIncomingDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPBXIncomingDetails');
$server ->register('getPBXOutgoingDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPBXOutgoingDetails');
$server ->register('getPBXNoAnswerDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getPBXNoAnswerDetails');
$server ->register('getUpdateDetails', array('id'=> 'xsd:string','to'=>'xsd:string','from'=>'xsd:string','user'=>'xsd:string','module'=>'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getUpdateDetails');

$server ->register('getUsersList', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getUsersList');
$server ->register('getModulesList', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getModulesList');
$server ->register('getCommentDetails', array('id'=> 'xsd:string','user'=>'xsd:string','from' => 'xsd:string','to' => 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getCommentDetails');
$server ->register('getLoginDetails', array('id'=> 'xsd:string','user' => 'xsd:string','from' => 'xsd:string','to' => 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getLoginDetails');


function connString($id, $dbconfig){
	//$conn = mysql_connect('localhost','root','345mcqcmMpYm8mRm');
	$conn = mysql_connect($dbconfig['db_server'],$dbconfig['db_username'],$dbconfig['db_password']);
	
	mysql_select_db($dbconfig['db_name'], $conn);

	$dd = "SELECT host, username, password, dbname FROM vtiger_instancescf WHERE instancesid =".$id." ";
	$query1 = mysql_query($dd);
	$result = mysql_fetch_array($query1);
	
	$host = $result['host'];
	$user = $result['username'];
	$pwd = $result['password'];
	$db = $result['dbname'];
	mysql_close($conn);

	$anl = mysql_connect($host, $user, $pwd);
	mysql_select_db($db, $anl);

}	

// create the function to fetch Data’s from Database
function getUsersDetails ($id, $dbconfig){
	connString($id, $dbconfig);
	$users_query ="SELECT first_name, last_name, IF(is_admin='on','Yes','No') as admin, status, rolename, email1, phone_crm_extension FROM vtiger_users 
				LEFT JOIN vtiger_user2role ON vtiger_user2role.userid = vtiger_users.id 
				LEFT JOIN vtiger_role ON vtiger_role.roleid = vtiger_user2role.roleid ORDER BY id ASC";  
	$users_result = mysql_query($users_query); 
	$items = array();
	while($row = mysql_fetch_array($users_result)){
		$items [] = array(
			'firstname'=>$row["first_name"],  
			'lastname'=>$row["last_name"],
			'admin' =>$row["admin"],
			'status'=>$row["status"],  
			'role'=>$row["rolename"],
			'email'=>$row["email1"],
			'extension'=>$row["phone_crm_extension"]
		);
	}
    return $items;
}

function getRoleDetails ($id, $dbconfig){
	connString($id, $dbconfig);
	$users_query ="SELECT roleid, rolename, parentrole FROM vtiger_role";  
	$users_result = mysql_query($users_query); 
	$items = array();
	while($row = mysql_fetch_array($users_result)){
		$items [] = array(
			'roleid'=>$row["roleid"],
			'rolename'=>$row["rolename"],
			'parentrole'=>$row["parentrole"]
		);
	}
    return $items;
}

function getGroupDetails ($id, $dbconfig){	
	connString($id, $dbconfig);
	$query ="SELECT groupname, rolename, GROUP_CONCAT(vtiger_users.user_name SEPARATOR ',') AS user, vtiger_groups.description FROM vtiger_groups 
										LEFT JOIN vtiger_group2role ON vtiger_groups.groupid = vtiger_group2role.groupid
										LEFT JOIN vtiger_role ON vtiger_group2role.roleid = vtiger_role.roleid
										LEFT JOIN vtiger_users2group ON vtiger_users2group.groupid = vtiger_groups.groupid 
										LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_users2group.userid
										LEFT JOIN vtiger_group2rs ON vtiger_group2rs.roleandsubid = vtiger_role.roleid
										GROUP BY vtiger_groups.groupid";  
	$result = mysql_query($query); 
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items [] = array(
			'groupname'=>$row["groupname"],
			'rolename'=>$row["rolename"],
			'description'=>$row["description"],
			'user'=>$row["user"]
		);
	}
    return $items;
}

function getWorkflowDetails ($id, $dbconfig){
	connString($id, $dbconfig);
	$sql = "SELECT module_name, com_vtiger_workflows.summary, com_vtiger_workflowtasks.summary AS tasksummary, com_vtiger_workflowtasks.task
			FROM com_vtiger_workflows 
			LEFT JOIN com_vtiger_workflowtasks ON com_vtiger_workflowtasks.workflow_id= com_vtiger_workflows.workflow_id ";
	$q = mysql_query($sql);
		   $items = array();
	while($row = mysql_fetch_array($q)){
		$items [] = array(
			'module'=>$row['module_name'],
			'summary'=>$row['summary'],
			'tasksummary'=>$row['tasksummary'],
			'task'=>$row['task']
		);
	}
    return $items;
}

function getModuleDetails ($id, $dbconfig){	
	connString($id, $dbconfig);
	//$modules_query ="SELECT tablabel as name, IF(isentitytype=0,'Extension','Entity') AS type, parent as menu, tabid from vtiger_tab";
	$modules_query ="SELECT tablabel, COUNT(vtiger_crmentity.crmid) AS total, parent as menu, IF(isentitytype=0,'Extension','Entity') AS type
	                FROM vtiger_tab LEFT JOIN vtiger_crmentity ON vtiger_tab.tablabel = vtiger_crmentity.setype WHERE vtiger_crmentity.deleted=0	
					GROUP BY vtiger_tab.isentitytype, vtiger_tab.tablabel";
	$modules_result = mysql_query($modules_query);
	$items = array();
	while($row = mysql_fetch_array($modules_result)){
		$modulename = $row['tablabel'];
		
		
		$items [] = array(
			'name'=>$modulename,
			'type'=>$row['type'],
			'menu'=>$row['menu'],
			'total'=>$row['total']
			//'total'=>$num_rows['count']
		);
	}
    return $items;
}

function getFilterDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT viewname,CONCAT(first_name,' ',last_name)as name, 
					IF(vtiger_customview.status=0, 'Default',
						IF(vtiger_customview.status=1, 'Private',
							IF(vtiger_customview.status=2,'Pending','Public'
							)
				  		) 
				  	) AS c_status, entitytype FROM vtiger_customview
			LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_customview.userid ORDER BY entitytype";
	$result = mysql_query($query); 
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'viewname'=>$row['viewname'],
			'name'=>$row['name'],
			'status'=>$row['c_status'],
			'module'=>$row['entitytype']
		);
	}
	return $items;
}

function getFieldDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query ="SELECT fieldname, fieldlabel, vtiger_tab.tablabel, vtiger_ws_fieldtype.fieldtype, 
				IF(vtiger_field.presence=0,'System Field',
					If(vtiger_field.presence=1,'Inactive Field',
						If(vtiger_field.presence=2,'Normal Field','Hidden'
						)
					)
				) AS presence_f
				FROM vtiger_field LEFT JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_field.tabid
				LEFT JOIN vtiger_ws_fieldtype ON vtiger_ws_fieldtype.uitype = vtiger_field.uitype
				ORDER BY fieldid ASC ";
	$result = mysql_query($query); 
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'fieldname'=>$row['fieldname'],
			'fieldlabel'=>$row['fieldlabel'],
			'tablabel'=>$row['tablabel'],
			'fieldtype'=>$row['fieldtype'],
			'presence_f'=>$row['presence_f']
		);
	}
	return $items;
}

function getRelatedListDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query ="SELECT t1.tablabel AS module, t2.tablabel AS related_module, t.label, t.actions FROM vtiger_relatedlists t 
							INNER JOIN vtiger_tab t1 ON t1.tabid = t.tabid 
							INNER JOIN vtiger_tab t2 ON t2.tabid = t.related_tabid";
	$result = mysql_query($query); 
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'module'=>$row['module'],
			'fieldlabel'=>$row['fieldlabel'],
			'related_module'=>$row['related_module'],
			'label'=>$row['label'],
			'actions'=>$row['actions']
		);
	}
	return $items;
}

function getRelatedModuleDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query ="SELECT fieldname, fieldlabel, vtiger_tab.tablabel
							FROM vtiger_field LEFT JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_field.tabid
							WHERE vtiger_field.uitype IN(10,75,59,51,57)";
	$result = mysql_query($query); 
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'fieldname'=>$row['fieldname'],
			'fieldlabel'=>$row['fieldlabel'],
			'tablabel'=>$row['tablabel']
		);
	}
	return $items;
}

function getPicklistDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT fieldlabel, fieldname, tablabel, fieldid FROM vtiger_field LEFT JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_field.tabid WHERE vtiger_field.uitype IN(15,16) ";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'fieldlabel'=>$row['fieldlabel'],
			'fieldname'=>$row['fieldname'],
			'module'=>$row['tablabel'],
			'fieldid'=>$row['fieldid']
		);		
	}
	return $items;
	
}

function getDashBoardDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT tablabel,linklabel FROM vtiger_links LEFT JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_links.tabid WHERE linktype='DASHBOARDWIDGET'";
	$result = mysql_query($query)or trigger_error(mysql_error()." ".$query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'module'=>$row['tablabel'],
			'link'=>$row['linklabel']
		);
	}
	return $items;
}

function getTemplateDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT templatename, description FROM vtiger_emailtemplates";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'name'=>$row['templatename'],
			'description'=>$row['description']
		);
	}
	return $items;
}

function getReportDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT foldername, reportname, vtiger_report.description FROM vtiger_report LEFT JOIN vtiger_reportfolder ON  vtiger_reportfolder.folderid = vtiger_report.folderid";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'foldername'=>$row['foldername'],
			'reportname'=>$row['reportname'],
			'description'=>$row['description']
		);
	}
	return $items;
}

function getScannerDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT actiontype, module, fromaddress, toaddress, CONCAT(first_name,'',last_name) AS fullname FROM vtiger_mailscanner_rules 
			LEFT JOIN vtiger_mailscanner_actions ON vtiger_mailscanner_actions.actionid = vtiger_mailscanner_rules.ruleid
			LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_mailscanner_rules.assigned_to";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'actiontype'=>$row['actiontype'],
			'module'=>$row['module'],
			'fullname'=>$row['fullname'],
			'fromaddress'=>$row['fromaddress'],
			'toaddress'=>$row['toaddress']			
		);
	}
	return $items;
}

function getWebformDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT name, description, returnurl, targetmodule FROM vtiger_webforms";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'name'=>$row['name'],
			'description'=>$row['description'],
			'fullname'=>$row['fullname'],
			'returnurl'=>$row['returnurl'],
			'targetmodule'=>$row['targetmodule']			
		);
	}
	return $items;
}

function getCronDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT name, module, frequency, description, IF(status=1,'Active','Inactive') as c_status FROM vtiger_cron_task";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items[] = array(
			'name'=>$row['name'],
			'frequency'=>$row['frequency'],
			'description'=>$row['description'],
			'status'=>$row['c_status'],		
			'module'=>$row['module']		
		);
	}
	return $items;
}


function getPortalDetails ($id, $dbconfig){	
	connString($id, $dbconfig);
	$portal_query ="SELECT tablabel, IF(visible=1,'Active','Inactive') AS status from vtiger_customerportal_tabs
					LEFT JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_customerportal_tabs.tabid";
	$portal_result = mysql_query($portal_query);
	$items = array();
	while($row = mysql_fetch_array($portal_result)){
		$items [] = array(
			'module'=>$row['tablabel'],
			'status'=>$row['status']
		);
	}
    return $items;
}

function getPdfMakerDetails ($id, $dbconfig){	
	connString($id, $dbconfig);
	$pdf_query ="SELECT filename, CONCAT(first_name,' ', last_name) as name, IF(vtiger_pdfmaker.deleted=0,'Active','Inactive') AS status, module, vtiger_pdfmaker.description from vtiger_pdfmaker
					LEFT JOIN vtiger_pdfmaker_userstatus ON vtiger_pdfmaker_userstatus.templateid = vtiger_pdfmaker.templateid
					LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_pdfmaker_userstatus.userid
					ORDER BY vtiger_pdfmaker.templateid ASC ";
	$pdf_result = mysql_query($pdf_query);
	$items = array();
	while($row = mysql_fetch_array($pdf_result)){
		$items [] = array(
			'filename'=>$row['filename'],
			'name'=>$row['name'],
			'module'=>$row['module'],
			'description'=>$row['description'],
			'status'=>$row['status']
		);
	}
    return $items;
}

function getPBXIncomingDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = mysql_query("SELECT customertype, label, customernumber, totalduration, callstatus, direction, CONCAT(first_name,' ',last_name) as fullname  
							FROM vtiger_pbxmanager 
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_pbxmanager.customer
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_pbxmanager.user WHERE direction='inbound' 
							ORDER BY vtiger_pbxmanager.pbxmanagerid ASC ");
	$items = array();
	while($row = mysql_fetch_array($query)){
		$items [] = array(
			'type'=>$row['customertype'],
			'name'=>$row['label'],
			'user'=>$row['fullname'],
			'number'=>$row['customernumber'],
			'duration'=>$row['totalduration'],
			'status'=>$row['callstatus'],
			'direction'=>$row['direction']			
		);
	}
	return $items;
}

function getPBXOutgoingDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = mysql_query("SELECT customertype, label, customernumber, totalduration, callstatus, direction, CONCAT(first_name,' ',last_name) as fullname  
							FROM vtiger_pbxmanager 
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_pbxmanager.customer
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_pbxmanager.user WHERE direction='outbound' 
							ORDER BY vtiger_pbxmanager.pbxmanagerid ASC ");
	$items = array();
	while($row = mysql_fetch_array($query)){
		$items [] = array(
			'type'=>$row['customertype'],
			'name'=>$row['label'],
			'user'=>$row['fullname'],
			'number'=>$row['customernumber'],
			'duration'=>$row['totalduration'],
			'status'=>$row['callstatus'],
			'direction'=>$row['direction']			
		);
	}
	return $items;
}

function getPBXNoAnswerDetails($id, $dbconfig){
	connString($id, $dbconfig);
	$query = mysql_query("SELECT customertype, label, customernumber, totalduration, callstatus, direction, CONCAT(first_name,' ',last_name) as fullname  
							FROM vtiger_pbxmanager 
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_pbxmanager.customer
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_pbxmanager.user WHERE callstatus='no-response' 
							ORDER BY vtiger_pbxmanager.pbxmanagerid ASC ");
	$items = array();
	while($row = mysql_fetch_array($query)){
		$items [] = array(
			'type'=>$row['customertype'],
			'name'=>$row['label'],
			'user'=>$row['fullname'],
			'number'=>$row['customernumber'],
			'duration'=>$row['totalduration'],
			'status'=>$row['callstatus'],
			'direction'=>$row['direction']			
		);
	}
	return $items;
}


function getUsersList($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT id, CONCAT(first_name,' ',last_name) AS name, user_name FROM vtiger_users";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items [] = array(
			'id'=>$row['id'],
			'name'=>$row['name'],
			'user_name'=>$row['user_name']
		);
	}
	return $items;
}

function getModulesList($id, $dbconfig){
	connString($id, $dbconfig);
	$query = "SELECT DISTINCT module FROM vtiger_modtracker_basic";
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items [] = array(
			'module'=>$row['module']		
		);
	}
	return $items;
}

function getCommentDetails($id, $user, $from, $to, $dbconfig){
	connString($id, $dbconfig);
	if($from != ''){
		$from = date("Y-m-d H:i:s", strtotime($from));
	}
	if($to != ''){
		$to = date("Y-m-d H:i:s", strtotime($to));
	}
	if( $user == '' || $to == '' || $from == '' ){
		$query = mysql_query("SELECT commentcontent, label, CONCAT(first_name, ' ', last_name) AS name ,setype FROM `vtiger_modcomments` 
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_modcomments.related_to
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_modcomments.userid
							ORDER BY vtiger_modcomments.modcommentsid ASC LIMIT 100");
	}else{
		$query = mysql_query("SELECT commentcontent, label, CONCAT(first_name, ' ', last_name) AS name ,setype FROM `vtiger_modcomments` 
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_modcomments.related_to
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_modcomments.userid
							WHERE CAST(vtiger_crmentity.createdtime AS DATE) BETWEEN '".$from."' AND '".$to."' AND vtiger_modcomments.userid = $user
							ORDER BY vtiger_modcomments.modcommentsid ASC ");
	}
	$items = array();
	while($row = mysql_fetch_array($query)){
		$items [] = array(
			'commentcontent'=>$row['commentcontent'],
			'label'=>$row['label'],
			'name'=>$row['name'],			
			'module'=>$row['setype']			
		);
	}
	return $items;
}

function getUpdateDetails($id, $to,$from,$user,$module, $dbconfig){
	connString($id, $dbconfig);
	if($from != ''){
		$from = date("Y-m-d H:i:s", strtotime($from));
	}
	if($to != ''){
		$to = date("Y-m-d H:i:s", strtotime($to));
	}
	
	if($to == '' || $from == '' || $user == '' || $module == ''){
		$query = "SELECT label, module, changedon, fieldname, prevalue, postvalue, CONCAT(first_name,' ',last_name) AS fullname 
							FROM vtiger_modtracker_detail
							LEFT JOIN vtiger_modtracker_basic  ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id 
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_modtracker_basic.crmid LIMIT 100";
	}else{
		$query = "SELECT label, module, changedon, fieldname, prevalue, postvalue, CONCAT(first_name,' ',last_name) AS fullname 
							FROM vtiger_modtracker_detail
							LEFT JOIN vtiger_modtracker_basic  ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id 
							LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid
							LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_modtracker_basic.crmid 
							WHERE CAST(changedon AS DATE) BETWEEN '".$from."' AND '".$to."' AND whodid=$user AND module= '".$module."' 
							ORDER BY vtiger_modtracker_detail.id ASC ";
	}	
		
	$result = mysql_query($query);
	$items = array();
	while($row = mysql_fetch_array($result)){
		$items [] = array(
			'label'=>$row['label'],
			'module'=>$row['module'],
			'changedon'=>$row['changedon'],
			'fieldname'=>$row['fieldname'],
			'prevalue'=>$row['prevalue'],
			'postvalue'=>$row['postvalue'],
			'fullname'=>$row['fullname']			
		);
	}
	return $items;
}

function getLoginDetails($id, $user, $from, $to, $dbconfig){
	connString($id, $dbconfig);
	if($from != ''){
		$from = date("Y-m-d H:i:s", strtotime($from));
	}
	if($to != ''){
		$to = date("Y-m-d H:i:s", strtotime($to));
	}
	
	if($to == '' || $from == '' || $user == ''){
		$query = mysql_query("SELECT user_name, user_ip, logout_time, login_time, status FROM vtiger_loginhistory LIMIT 100 ");				
		//$query = mysql_query("SELECT * FROM vtiger_loginhistory ");		 
	}else{
		$query = mysql_query("SELECT user_name, user_ip, logout_time, login_time, status FROM vtiger_loginhistory WHERE user_name='".$user."' AND CAST(login_time AS DATE) BETWEEN '".$from."' AND '".$to."' ");
	}
			
	$items = array();
	while($row = mysql_fetch_array($query)){
		$items [] = array(
			'user_name'=>$row['user_name'],	
			'user_ip'=>$row['user_ip'],
			'logout_time'=>$row['logout_time'],
			'login_time'=>$row['login_time'],
			'status'=>$row['status']
		);
	}
	return $items;
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server ->service($HTTP_RAW_POST_DATA);
?>