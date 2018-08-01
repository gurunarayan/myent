<?php
//require_once('config.inc.php');
require_once('analyser/nusoap.php');

  
//print_r($dbconfig);
$server = new nusoap_server;

$server ->register('connString', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# connString');
//register a function that works on server
$server ->register('getUsersDetails', array('id'=> 'xsd:string','dbconfig'=> 'xsd:string'), array('return' => 'xsd:string'), 'urn:server', 'urn:server# getUsersDetails');

function connString($id, $dbconfig){
	
	//$conn = mysql_connect('localhost','root','');
	$conn = mysql_connect($dbconfig['db_server'].$dbconfig['db_port'],$dbconfig['db_username'],$dbconfig['db_password']);
	
	mysql_select_db($dbconfig['db_name'], $conn);
	//mysql_select_db('newvtd', $conn);

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
function getUsersDetails ($id,$dbconfig){
	connString($id,$dbconfig);
	$users_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_users WHERE status='Active'");   
	$users_result = mysql_fetch_array($users_query);
	
	$in_users_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_users WHERE status='Inactive'");   
	$in_users_result = mysql_fetch_array($in_users_query);
	
	$role_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_role");   
	$role_result = mysql_fetch_array($role_query);
	
	$group_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_groups");   
	$group_result = mysql_fetch_array($group_query);
	
	$profile_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_profile");   
	$profile_result = mysql_fetch_array($profile_query);
	
	$login_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_loginhistory");   
	$login_result = mysql_fetch_array($login_query);
	
	$workflow_query = mysql_query("SELECT COUNT(*) AS count FROM com_vtiger_workflows");   
	$workflow_result = mysql_fetch_array($workflow_query);
	
	$modules_query ="SELECT tablabel, COUNT(vtiger_crmentity.crmid) AS total FROM vtiger_tab 
						LEFT JOIN vtiger_crmentity ON vtiger_tab.tablabel = vtiger_crmentity.setype 
						WHERE vtiger_crmentity.deleted=0
						GROUP BY vtiger_tab.isentitytype, vtiger_tab.tablabel";
	$modules_result = mysql_query($modules_query);
		$mod_items = array();
		while($row = mysql_fetch_array($modules_result)){
			$modulename = $row['tablabel'];
			$mod_items [] = array(
				'name'=>$modulename,
				'total'=>$row['total']
			);
		}
	
	$email_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_emailtemplates");   
	$email_result = mysql_fetch_array($email_query);
	
	$report_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_report");   
	$report_result = mysql_fetch_array($report_query);
	
	$cron_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_cron_task");   
	$cron_result = mysql_fetch_array($cron_query);
	
	$webform_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_webforms");   
	$webform_result = mysql_fetch_array($webform_query);
	
	$field_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_field");   
	$field_result = mysql_fetch_array($field_query);
	
	$filter_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_customview");   
	$filter_result = mysql_fetch_array($filter_query);
	
	$link_query = mysql_query("SELECT COUNT(*) AS count FROM vtiger_links WHERE linktype='DASHBOARDWIDGET'");   
	$link_result = mysql_fetch_array($link_query);
	
	
	
	$items = array();
		$items [] = array(
			'active_user_count'=> $users_result['count'],
			'inactive_user_count'=> $in_users_result['count'],
			'role_count'=> $role_result['count'],
			'group_count'=> $group_result['count'],
			'profile_count'=> $profile_result['count'],
			'login_count'=> $login_result['count'],
			'workflow_count'=> $workflow_result['count'],
			'email_count'=> $email_result['count'],
			'report_count'=> $report_result['count'],
			'cron_count'=> $cron_result['count'],
			'webform_count'=> $webform_result['count'],
			'field_count'=> $field_result['count'],
			'filter_count'=> $filter_result['count'],
			'link_count'=> $link_result['count'],
			'module'=> $mod_items
		);
    return $items;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server ->service($HTTP_RAW_POST_DATA);
?>
					
					
					
					
					
					
					
					