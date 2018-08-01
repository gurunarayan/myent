<?php
require_once('analyser/nusoap.php');
require_once('config.inc.php');
global $site_URL,$dbconfig;  
session_start();
if(!isset($_SESSION['authenticated_user_id']) ){
  header('Location:index.php');
  exit;
}
$url_str =  $_SERVER['QUERY_STRING'];
$id = substr($url_str, strrpos($url_str, '=') + 1);

$url = $site_URL."TestServer.php?wsdl";
$client = new nusoap_client($url);
//print_r($id);
$servername = $dbconfig['db_hostname'];
$servername = $dbconfig['db_server'];
$username = $dbconfig['db_username'];
$password = $dbconfig['db_password'];
$db_name = $dbconfig['db_name'];
$db_type  =  $dbconfig['db_type']; 


//Call server function
$connString = $client ->call('connString',array('id'=>$id,'dbconfig'=>$dbconfig));
$users_detail = $client ->call('getUsersDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$role_detail = $client ->call('getRoleDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$group_detail = $client ->call('getGroupDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$workflow_detail = $client ->call('getWorkflowDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$module_detail = $client ->call('getModuleDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$filter_detail = $client ->call('getFilterDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$field_detail = $client ->call('getFieldDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$relatedlist_detail = $client ->call('getRelatedListDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$relatedmodule_detail = $client ->call('getRelatedModuleDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$picklist_detail = $client ->call('getPicklistDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$dashboard_detail = $client ->call('getDashBoardDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$template_detail = $client ->call('getTemplateDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$report_detail = $client ->call('getReportDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$scanner_detail = $client ->call('getScannerDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$webform_detail = $client ->call('getWebformDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$cron_detail = $client ->call('getCronDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$portal_detail = $client ->call('getPortalDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$pdf_detail = $client ->call('getPdfMakerDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$pbx_incoming = $client ->call('getPBXIncomingDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$pbx_outgoing = $client ->call('getPBXOutgoingDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
$pbx_noanswer = $client ->call('getPBXNoAnswerDetails',array('id'=>$id,'dbconfig'=>$dbconfig));
//$update_detail = $client ->call('getUpdateDetails');
$users_picklist = $client ->call('getUsersList',array('id'=>$id,'dbconfig'=>$dbconfig));
$modules_picklist = $client ->call('getModulesList',array('id'=>$id,'dbconfig'=>$dbconfig));


if(isset($_POST['submit'])){
	$instance_id = $_POST['instanceid'];	
	$to = $_POST['to'];	
	$from = $_POST['from'];	
	$user = $_POST['user'];	
	$module = $_POST['module'];	
	$response = $client->call('getUpdateDetails',array('id'=>$instance_id,'to'=>$to,'from'=>$from,'user'=>$user,'module'=>$module,'dbconfig'=>$dbconfig));
	$update_result = $response;
	$update_count = count($update_result);
	
}elseif(isset($_POST['login_submit'])){
	$user_name = $_POST['user_name'];	
	$instance_id = $_POST['instanceid'];
	$from = $_POST['from'];	
	$to = $_POST['to'];	
	$login_details = $client->call('getLoginDetails',array('id'=>$instance_id,'user'=>$user_name,'from'=>$from,'to'=>$to,'dbconfig'=>$dbconfig));
	$login_result = $login_details;
	//print_r($login_result);
	$login_count = count($login_result);
	
}elseif(isset($_POST['comment_submit'])){
	$instance_id = $_POST['instanceid'];
	$user = $_POST['user'];	
	$from = $_POST['from'];	
	$to = $_POST['to'];
	$comments_detail = $client ->call('getCommentDetails',array('id'=>$instance_id,'user'=>$user,'from'=>$from,'to'=>$to,'dbconfig'=>$dbconfig));
	$comments_result = $comments_detail;
	$comments_count = count($comments_result);
}

if($client->fault){
	echo "FAULT: <p>Code: (".$client ->faultcode.")</p>";
	echo "String: ".$client->faultstring;
	
}else{
	$err_msg = $client->getError();
    if ($err_msg) {
        // Print error msg
        echo 'Error: '.$err_msg;
    }
	$users_result = $users_detail;
	$users_count = count($users_result);
	
	$role_result = $role_detail;
	$role_count = count($role_result);
	
	$group_result = $group_detail;
	$group_count = count($group_result);

	$workflow_result = $workflow_detail;
	$workflow_count = count($workflow_result);
	
	$module_result = $module_detail;
	//print_r($module_result);
	$module_count = count($module_result);
	
	$filter_result = $filter_detail;
	$filter_count = count($filter_result);
	
	$field_result = $field_detail;
	$field_count = count($field_result);
	
	$relatedlist_result = $relatedlist_detail;
	$relatedlist_count = count($relatedlist_result);
	
	$picklist_result = $picklist_detail;
	$picklist_count = count($picklist_result);
	//print_r($picklist_result);
	
	$relatedmodule_result = $relatedmodule_detail;
	$relatedmodule_count = count($relatedmodule_result);
	
	$dashboard_result = $dashboard_detail;
	$dashboard_count = count($dashboard_result);
	
	$template_result = $template_detail;
	$template_count = count($template_result);
	
	$report_result = $report_detail;
	$report_count = count($report_result);
	
	$scanner_result = $scanner_detail;
	$scanner_count = count($scanner_result);
	
	$webform_result = $webform_detail;
	$webform_count = count($webform_result);
	
	$cron_result = $cron_detail;
	$cron_count = count($cron_result);
	
	$portal_result = $portal_detail;
	$portal_count = count($portal_result);
	
	$pdf_result = $pdf_detail;
	$pdf_count = count($pdf_result);
	
	$pbx_incoming_result = $pbx_incoming;
	$pbx_incoming_count = count($pbx_incoming_result);
	
	$pbx_outgoing_result = $pbx_outgoing;
	$pbx_outgoing_count = count($pbx_outgoing_result);
	
	$pbx_noanswer_result = $pbx_noanswer;
	$pbx_noanswer_count = count($pbx_noanswer_result);
	
	//$update_result = $update_detail;
	//$update_count = count($update_result);
	//print_r($update_result);
	
	$users_picklist_result = $users_picklist;
	$users_picklist_count = count($users_picklist_result);
	
	$modules_picklist_result = $modules_picklist;
	$modules_picklist_count = count($modules_picklist_result);
	
?>

  <!DOCTYPE html> 

 <html>  
      <head>  
           <title>Analyser</title>  
		   
		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		   
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />  
		    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css" /> 
		    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>	
			 <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>	
			 
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Bootstrap Core CSS -->
    <link href="analyser/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="analyser/css/logo-nav.css" rel="stylesheet">
      </head> 
		<style>
			table { table-layout: fixed; }

			td {  word-wrap:break-word;}
			
			#loading-img {
				background: url(loader.gif) center center no-repeat;
				height: 100%;
				z-index: 20;
			}

			.overlay {
				background: #e9e9e9;
				display: none;
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				opacity: 0.5;
			}
		</style>
		<!--<body> --> 
		<body style="background-color: #f5f5f5;font-size:14px;">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand avanta-brand" style="margin: 0 30px;" id="summaryLink" href="<?PHP echo $site_URL.'SummaryClient.php?id='.$id;?>">Summary</a>
					<a class="navbar-brand avanta-brand" style="margin: 0 10px;" id="detailLink" href="<?PHP echo $site_URL.'TestClient.php?id='.$id;?>" >Detail</a>
				</div>
			</div>
		</nav>
		
		<div class="overlay">
			<div id="loading-img"></div>
		</div>
		
		<div class="container">
        <div class="row">
            <div class="col-lg-16">			 
				<div class="panel panel-default">
					<div class="panel-body">
                <!--<h3 align="center"><a href='tracker/index.php'>Analyser</a></h3>  
                <br /> -->
				<br />
				<ul class="nav nav-tabs">
					<li class="active" ><a data-toggle="tab" href="#users">Users</a></li>
					<li><a data-toggle="tab" href="#roles">Roles</a></li>
					<li><a data-toggle="tab" href="#groups">Groups</a></li>
					<li><a data-toggle="tab" href="#modules">Modules</a></li>
					<li><a data-toggle="tab" href="#workflows">Workflows</a></li>
					<li><a data-toggle="tab" href="#filters">Filters</a></li>
					<li><a data-toggle="tab" href="#fields">Fields</a></li>
					<li><a data-toggle="tab" href="#picklist">Picklist</a></li>
					<li><a data-toggle="tab" href="#dashboard">Dashboard</a></li>
					<li><a data-toggle="tab" href="#template">Templates</a></li>
					<li><a data-toggle="tab" href="#reports">Reports</a></li>
					<li><a data-toggle="tab" href="#scanner">MailScanner</a></li>
					<li><a data-toggle="tab" href="#webform">Webforms</a></li>
					<li><a data-toggle="tab" href="#cron">Scheduler</a></li>
					<!--<li><a data-toggle="tab" href="#test">Test</a></li>-->
					<li><a data-toggle="tab" href="#portal">CustomerPortal</a></li>
					<li><a data-toggle="tab" href="#pdf">PDF Maker</a></li>
					<li><a data-toggle="tab" href="#pbx">PBXManager</a></li>
					<li><a data-toggle="tab" href="#update">Records Update</a></li>
					<li><a data-toggle="tab" href="#comment">Comments</a></li>
					<li><a data-toggle="tab" href="#loginhistory">Login History</a></li>
				</ul>
				
				<div class="tab-content">
					<br />
					<div id="users" class="tab-pane fade in active">
						<div class="table-responsive">  
							<table id="users_data" class="table table-striped table-bordered">  
								<thead>  
								   <tr>  
										<td>First Name</td>  
										<td>Last Name</td>  
										<td>Email</td>  
										<td>Phone Extension</td>  
										<td>Admin</td>  
										<td>Status</td>  
										<td>Role</td>  
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<span class="users"></span>
								  <?php 
									for($i = 0;$i < $users_count;$i++) {
										echo '  
										<tr>  
											<td>'.$users_result[$i]["firstname"].'</td>    
											<td>'.$users_result[$i]["lastname"].'</td>    
											<td>'.$users_result[$i]["email"].'</td>    
											<td>'.$users_result[$i]["extension"].'</td>    
											<td>'.$users_result[$i]["admin"].'</td>    
											<td>'.$users_result[$i]["status"].'</td>    
											<td>'.$users_result[$i]["role"].'</td>    
											  
										</tr> '; 
									}
								  ?>  
							 </table>  
						</div>
					</div>
					
					<div id="roles" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="roles_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Role ID</td>  
										<td>Role Name</td>  
										<td>Parent Role </td>  
								   </tr>  
								</thead>  
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								  <?php  
								  for($i=0;$i<$role_count;$i++)  
								  {  
									echo '  
									<tr>  
										<td>'.$role_result[$i]["roleid"].'</td>    
										<td>'.$role_result[$i]["rolename"].'</td>    
										<td>'.$role_result[$i]["parentrole"].'</td>    
									</tr> ';  
								  } 
								  ?>  
							 </table>  
						</div>
					</div>
					
					<div id="groups" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="groups_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Group Name</td>  
										<td>Role Name</td>  
										<td>Description</td>  
										<td>Users</td>  
								   </tr>  
								</thead>  
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								  <?php  
								  for($i=0;$i<$group_count;$i++)  
								  {  
									echo '  
									<tr>  
										<td>'.$group_result[$i]["groupname"].'</td>    
										<td>'.$group_result[$i]["rolename"].'</td>    
										<td>'.$group_result[$i]["description"].'</td>    
										<td>'.$group_result[$i]["user"].'</td>    
									</tr> ';  
								  } 
								  ?>  
							 </table>  
						</div>
					</div>
					<div id="modules" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="modules_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Name</td>  
										<td>Total Records</td>  
										<td>Type</td>  
										<td>Menu</td>   
								   </tr>  
								</thead>  
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								  <?php  
									for($i = 0;$i < $module_count;$i++) {
										echo '  
										<tr>  
											<td>'.$module_result[$i]["name"].'</td>    
											<td>'.$module_result[$i]['total'].'</td>    
											<td>'.$module_result[$i]["type"].'</td>    
											<td>'.$module_result[$i]["menu"].'</td> 
										</tr> '; 
									}
								  ?>  
							 </table>  
						</div>
					</div>
					
					<div id="workflows" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="workflow_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Module Name</td>
										<td>Workflow Name</td>  
										<td>Task Summary</td>   
										<td>Task Name</td>  
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th>Module Name</th>
									</tr>
								</tfoot>
								<tbody>
								  <?php						  
									for($i = 0;$i < $workflow_count;$i++) {
										
										//$task = unserialize($workflow_result[$i]["task"]);
										//$stdClassObj = preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen('stdClass') . ':"stdClass"', $workflow_result[$i]["task"]);
										//$nnn = unserialize( $stdClassObj );
										//print_r($nnn);
										//$taskname = $task['__PHP_Incomplete_Class_Name'];
										if (preg_match('/"([^"]+)"/', $workflow_result[$i]["task"], $m)) {
											$task = $m[1];   
										}
										if($task == 'VTEmailTask'){
											$tasklabel = 'Send Mail';
										}else if($task == 'VTEntityMethodTask'){
											$tasklabel = 'Custom Function';
										}else if($task == 'VTCreateTodoTask'){
											$tasklabel = 'Create Todo';
										}else if($task == 'VTCreateEventTask'){
											$tasklabel = 'Create Event';
										}else if($task == 'VTUpdateFieldsTask'){
											$tasklabel = 'Update Fields';
										}else if($task == 'VTCreateEntityTask'){
											$tasklabel = 'Create Entity';
										}else if($task == 'VTSMSTask'){
											$tasklabel = 'SMS Task';
										}
										echo '  
										<tr>     
											<td>'.$workflow_result[$i]["module"].'</td>
											<td>'.$workflow_result[$i]["summary"].'</td> 
											<td>'.$workflow_result[$i]["tasksummary"].'</td> 
											<td>'.$tasklabel.'</td>    	  
										</tr> '; 
									}
								  ?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="filters" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="filter_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Name</td>  
										<td>User Name</td>   
										<td>Status</td>   
										<td>Module Name</td>   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php  
									for($i = 0;$i < $filter_count;$i++) {
										echo '  
										<tr>  
											<td>'.$filter_result[$i]["viewname"].'</td>    
											<td>'.$filter_result[$i]["name"].'</td>    
											<td>'.$filter_result[$i]["status"].'</td>    	
											<td>'.$filter_result[$i]["module"].'</td>    	
										</tr> '; 
									}
								  ?>  
								</tbody>
							 </table> 
						</div>
					</div>
					
					<div id="fields" class="tab-pane fade">
						<ul class="nav nav-tabs">
							<li class="active" ><a data-toggle="tab" href="#fields_fields">Fields</a></li>
							<li><a data-toggle="tab" href="#related_module">Related Module</a></li>
							<li><a data-toggle="tab" href="#related_list">Related List</a></li>
						</ul>
						
						<div class="tab-content">
							<br />
							<div id="fields_fields" class="tab-pane fade in active">
								<div class="table-responsive">  
									<table id="fields_fields_data" class="table table-striped table-bordered" width="100%">  
										<thead>  
										   <tr>  
												<td>Field Name</td>  
												<td>Field Label</td>  
												<td>Module</td>  
												<td>Presence</td> 
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<tbody>
										  <?php  
										  for($i=0;$i<$field_count;$i++) 
										  {  
											echo '  
											<tr>  
												<td>'.$field_result[$i]["fieldname"].'</td>  
												<td>'.$field_result[$i]["fieldlabel"].'</td>  
												<td>'.$field_result[$i]["tablabel"].'</td>  
												<td>'.$field_result[$i]["presence_f"].'</td>   
											</tr> ';  
										  }  
										  ?>
										</tbody>
									 </table>  
								</div>
							</div>
							
							<div id="related_module" class="tab-pane fade">
								<div class="table-responsive">  
									<table id="fields_relmodule_data" class="table table-striped table-bordered" style="width:100%">  
										<thead>  
										   <tr>  
												<td>Field Name</td>  
												<td>Field Label</td>  
												<td>Module</td>  	   
												  	   
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<tbody>
										  <?php  
										  for($i=0;$i<$relatedmodule_count;$i++)  
										  {  
											echo '  
											<tr>  
												<td>'.$relatedmodule_result[$i]["fieldname"].'</td>    
												<td>'.$relatedmodule_result[$i]["fieldlabel"].'</td>    
												<td>'.$relatedmodule_result[$i]["tablabel"].'</td>
											</tr> ';  
										  }  
										  ?> 
										</tbody>
									 </table>  
								</div>
							</div>
							
							<div id="related_list" class="tab-pane fade">
								<div class="table-responsive">  
									<table id="fields_rellist_data" class="table table-striped table-bordered" style="width:100%">  
										<thead>  
										   <tr>  
												<td>Module</td>  
												<td>Related Module</td>  	   
												<td>Label</td>  	   
												<td>Actions</td>	   
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										  <?php  
										  for($i=0;$i<$relatedlist_count;$i++)  
										  {  
											echo '  
											<tr>  
												<td>'.$relatedlist_result[$i]["module"].'</td>       
												<td>'.$relatedlist_result[$i]["related_module"].'</td>
												<td>'.$relatedlist_result[$i]["label"].'</td>
												<td>'.$relatedlist_result[$i]["actions"].'</td>
											</tr> ';  
										  } 
										  ?>  
									 </table>  
								</div>
							</div>	
						</div>	
					</div>
					
					<div id="picklist" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="picklist_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Field Label</td>  
										<td>Field Name</td>    	   
										<td>Module Name</td>    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>  
									<?php 
										for($i=0;$i<$picklist_count;$i++)  
										{  
											echo '  
											<tr>  
												<td>'.$picklist_result[$i]["fieldlabel"].'</td>       
												<td>'.$picklist_result[$i]["fieldname"].'</td>
												<td>'.$picklist_result[$i]["module"].'</td>
											</tr> ';  
										} 
										  ?>  
								</tbody>  
							 </table>  
						</div>
					</div>
					
					<div id="dashboard" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="dashboard_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Dashboard Name</td>  
										<td>Module</td>
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php  
									for($i = 0;$i < $dashboard_count;$i++) {
										echo '  
										<tr>  
											<td>'.$dashboard_result[$i]["link"].'</td>    
											<td>'.$dashboard_result[$i]["module"].'</td>    
										</tr> '; 
									}
								  ?>  
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="template" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="template_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Template name</td>  
										<td>Description</td>  	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php  
									for($i = 0;$i < $template_count;$i++) {
										echo '  
										<tr>  
											<td>'.$template_result[$i]["name"].'</td>    
											<td>'.$template_result[$i]["description"].'</td>    
										</tr> '; 
									}
								  ?>  
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="reports" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="reports_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Report Name</td>  
										<td>Folder Name</td>  
										<td>Description</td>  	   
								   </tr>  
								</thead> 
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php  
									for($i = 0;$i < $report_count;$i++) {
										echo '  
										<tr>  
											<td>'.$report_result[$i]["foldername"].'</td>
											<td>'.$report_result[$i]["reportname"].'</td>
											<td>'.$report_result[$i]["description"].'</td>
										</tr> '; 
									}
								  ?>  
								</tbody>  
							 </table>  
						</div>
					</div>
					
					<div id="scanner" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="scanner_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Action Type</td>  
										<td>Module</td>  
										<td>Name</td>  	   
										<td>From</td>  	   
										<td>To</td>  	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
								  <?php  
								  for($i = 0; $i < $scanner_count; $i++)  
								  {  
									echo '  
									<tr>  
										<td>'.$scanner_result[$i]["actiontype"].'</td>    
										<td>'.$scanner_result[$i]["module"].'</td>    
										<td>'.$scanner_result[$i]["fullname"].'</td>
										<td>'.$scanner_result[$i]["fromaddress"].'</td>
										<td>'.$scanner_result[$i]["toaddress"].'</td>										
									</tr> ';  
								  } 
								  ?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="webform" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="webform_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Name</td>  
										<td>Description</td>  
										<td>Return URL</td>  	   
										<td>Module</td>  	      
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
								  <?php  
								  for($i=0;$i<$webform_count;$i++) 
								  {  
									echo '  
									<tr>  
										<td>'.$webform_result[$i]["name"].'</td>    
										<td>'.$webform_result[$i]["description"].'</td>    
										<td>'.$webform_result[$i]["returnurl"].'</td>
										<td>'.$webform_result[$i]["targetmodule"].'</td>									
									</tr> ';  
								  } 
								  ?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="cron" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="cron_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>  
										<td>Name</td>  
										<td>Module</td>  
										<td>Status</td>  	   
										<td>Frequency</td>  	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
								  <?php  
								  for($i=0;$i<$cron_count;$i++) 
								  {  
									echo '  
									<tr>  
										<td>'.$cron_result[$i]["name"].'</td>    
										<td>'.$cron_result[$i]["module"].'</td>    
										<td>'.$cron_result[$i]["status"].'</td>
										<td>'.gmdate("H:i",$cron_result[$i]["frequency"]).'</td>		
									</tr> ';  
								  }  
								  ?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					
					
					
					
					<!--<div id="test" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="example" class="table table-striped table-bordered" style="width:100%">  
								<thead>
									<tr>
										<th>Field Label</th>
										<th>Module Name</th>
										<th>Field Name</th>
										<th>Picklist Value</th>
										
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Field Label</th>
										<th>Module Name</th>
										<th>Field Name</th>
										<th>Picklist Value</th>
										
									</tr>
								</tfoot>
								
								<?php  
								  /*while($row = mysqli_fetch_array($pick_val_result))  
								  {  
									echo '  
									<tr>  
										<td>'.$row['fieldlabel'].'</td>        	
										<td>'.$row['tablabel'].'</td>        	
										<td>'.$row['fiellname'].'</td>        	
										<td>'.$row['pickval'].'</td>        	
										
									</tr> ';
						  
								  }*/  
								  ?>  
								
							 </table>  
						</div>
					</div>-->
					
					<div id="portal" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="portal_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Module Name</td>    	   
										<td>Status</td>    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?PHP for($i = 0;$i < $portal_count;$i++) {
										echo '  
										<tr>  
											<td>'.$portal_result[$i]["module"].'</td>    
											<td>'.$portal_result[$i]["status"].'</td>    
										</tr> '; 
									}?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="pdf" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="pdf_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>File Name</td>    	   
										<td>User Access</td>    	   
										<td>Module</td>    	   
										<td>Description</td>    	   
										<td>Status</td>    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?PHP for($i = 0;$i < $pdf_count;$i++) {
										echo '  
										<tr>  
											<td>'.$pdf_result[$i]["filename"].'</td>    
											<td>'.$pdf_result[$i]["name"].'</td>    
											<td>'.$pdf_result[$i]["module"].'</td>    
											<td>'.$pdf_result[$i]["description"].'</td>    
											<td>'.$pdf_result[$i]["status"].'</td>    
										</tr> '; 
									}?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					
					<div id="pbx" class="tab-pane fade">
						<ul class="nav nav-tabs">
							<li class="active" ><a data-toggle="tab" href="#pbx_incoming">Incoming Calls</a></li>
							<li><a data-toggle="tab" href="#pbx_outgoing">Outgoing Calls</a></li>
							<li><a data-toggle="tab" href="#pbx_noanswer">No Answer</a></li>
						</ul>
						
						<div class="tab-content">
							<br />
							<div id="pbx_incoming" class="tab-pane fade in active">
								<div class="table-responsive">  
									<table id="pbx_incoming_data" class="table table-striped table-bordered" width="100%">  
										<thead>  
										   <tr>  
												<td>Customer Type</td>  
												<td>Customer Name</td>  
												<td>User Name</td>  
												<td>Customer Number</td>  
												<td>Total Duration</td> 
												<td>Call Status</td> 
												<td>Direction</td> 
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<tbody>
											<?PHP for($i = 0;$i < $pbx_incoming_count;$i++) {
												echo '  
												<tr>  
													<td>'.$pbx_incoming_result[$i]["type"].'</td>    
													<td>'.$pbx_incoming_result[$i]["name"].'</td>    
													<td>'.$pbx_incoming_result[$i]["user"].'</td>    
													<td>'.$pbx_incoming_result[$i]["number"].'</td>    
													<td>'.$pbx_incoming_result[$i]["duration"].'</td>    
													<td>'.$pbx_incoming_result[$i]["status"].'</td>    
													<td>'.$pbx_incoming_result[$i]["direction"].'</td>    
													
												</tr> '; 
											}?>
										</tbody>
									 </table>  
								</div>
							</div>
							
							<div id="pbx_outgoing" class="tab-pane fade">
								<div class="table-responsive">  
									<table id="pbx_outgoing_data" class="table table-striped table-bordered" style="width:100%">  
										<thead>  
										   <tr>  
												<td>Customer Type</td>  
												<td>Customer Name</td>  
												<td>User Name</td>  
												<td>Customer Number</td>  
												<td>Total Duration</td> 
												<td>Call Status</td> 
												<td>Direction</td> 
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<tbody>
											<?PHP for($i = 0;$i < $pbx_outgoing_count;$i++) {
												echo '  
												<tr>  
													<td>'.$pbx_outgoing_result[$i]["type"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["name"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["user"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["number"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["duration"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["status"].'</td>    
													<td>'.$pbx_outgoing_result[$i]["direction"].'</td>    
													
												</tr> '; 
											}?>
										</tbody> 
									 </table>  
								</div>
							</div>
							
							<div id="pbx_noanswer" class="tab-pane fade">
								<div class="table-responsive">  
									<table id="pbx_noanswer_data" class="table table-striped table-bordered" style="width:100%">  
										<thead>  
										   <tr>  
												<td>Customer Type</td>  
												<td>Customer Name</td>  
												<td>User Name</td>  
												<td>Customer Number</td>  
												<td>Total Duration</td> 
												<td>Call Status</td> 
												<td>Direction</td> 
										   </tr>  
										</thead>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<tbody>
											<?PHP for($i = 0;$i < $pbx_noanswer_count;$i++) {
												echo '  
												<tr>  
													<td>'.$pbx_noanswer_result[$i]["type"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["name"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["user"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["number"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["duration"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["status"].'</td>    
													<td>'.$pbx_noanswer_result[$i]["direction"].'</td>    
													
												</tr> '; 
											}?>
										</tbody>
									 </table>  
								</div>
							</div>	
						</div>	
					</div>
					
					
					<div id="comment" class="tab-pane fade">
						<div class="table-responsive">
							<div class='row' style="padding-left:20px;">
								<form class="form-inline" method = 'post' name='form4' action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id; ?>">
									<input type="hidden" name="instanceid" value="<?PHP echo $id;?>"/>
									
									<div class="form-group">
										<label for="user">User</label>						
										<select id="idBranch" name="user" class="form-control" required>
											<option value="">Select User</option>
											<?PHP for($i=0;$i<$users_picklist_count;$i++){
												if(isset($_POST['user']) && $_POST['user'] == $users_picklist_result[$i]['id']){
													$sel='selected';}
												else{
													$sel = '';
												}
												echo '<option value="'.$users_picklist_result[$i]['id'].'" '.$sel.'>'.$users_picklist_result[$i]['name'].'</option>';
											}?>
											
										</select> 
									</div>&nbsp;&nbsp;&nbsp;
									<div class="form-group">
									
									   <label for="from">From</label>
									   <input type="date" class="form-control" name="from" id="from" value="<?php if(isset($_POST['from']))echo $_POST['from'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<div class="form-group">
									   <label for="to">To</label>
									   <input type="date" class="form-control" name="to" id="to" value="<?php if(isset($_POST['to']))echo $_POST['to'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<button type="submit" id="comment_submit" name='comment_submit' class="btn btn-success">Fetch Data</button>
								   </form>
							</div>	
							<table id="comment_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Comments</td>    	   
										<td>Label</td>    	   
										<td>Module</td>    	   	   
										<td>User</td>    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>	
									</tr>
								</tfoot>
								<tbody>
									<?PHP for($i = 0;$i < $comments_count;$i++) {
										echo '  
										<tr>  
											<td>'.$comments_result[$i]["commentcontent"].'</td>            
											<td>'.$comments_result[$i]["label"].'</td>            
											<td>'.$comments_result[$i]["module"].'</td>            
											<td>'.$comments_result[$i]["name"].'</td>            
										</tr> '; 
									}?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					<div id="update" class="tab-pane fade">
						<div class="table-responsive">
								<div class='row' style="padding-left:20px;">
									<form class="form-inline" method = 'post' name='form1' action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id; ?>">
									<input type="hidden" name="instanceid" value="<?PHP echo $id;?>"/>
									<div class="form-group">
									   <label for="from">From</label>
									   <input type="date" class="form-control" name="from" id="from" value="<?php if(isset($_POST['from']))echo $_POST['from'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<div class="form-group">
									   <label for="to">To</label>
									   <input type="date" class="form-control" name="to" id="to" value="<?php if(isset($_POST['to']))echo $_POST['to'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<div class="form-group">
										<label for="user">User</label>						
										<select id="idBranch" name="user" class="form-control" required>
											<option value="">Select User</option>
											<?PHP for($i=0;$i<$users_picklist_count;$i++){
												if(isset($_POST['user']) && $_POST['user'] == $users_picklist_result[$i]['id']){
													$sel='selected';}
												else{
													$sel = '';
												}
												echo '<option value="'.$users_picklist_result[$i]['id'].'" '.$sel.'>'.$users_picklist_result[$i]['name'].'</option>';
											}?>
											
										</select> 
									</div>&nbsp;&nbsp;&nbsp;
									
									<div class="form-group">
										<label for="module">Module</label>						
										<select id="idModule" name="module" class="form-control" required>
											<option value="">Select Module</option>
											<?PHP for($i=0;$i<$modules_picklist_count;$i++){
												if(isset($_POST['module']) && $_POST['module'] == $modules_picklist_result[$i]['module']){
													$sel='selected';}
												else{
													$sel = '';
												}
												echo '<option value="'.$modules_picklist_result[$i]['module'].'" '.$sel.'>'.$modules_picklist_result[$i]['module'].'</option>';
											}?>
											
										</select> 
									</div>&nbsp;&nbsp;&nbsp;
									
									<button type="submit" id="submit" name='submit' class="btn btn-success">Fetch Data</button>
								   </form>
								</div>
							<table id="update_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Module Name</td>    	   
										<td>Label</td>    	   
										<td>Changed On</td>    	   
										<td>Who Changed</td>    	   
										<td>Field Name</td>    	   
										<td>PreValue</td>    	   
										<td>PostValue</td>    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										
									</tr>
								</tfoot>
								<tbody>
									<?PHP for($i = 0;$i < $update_count;$i++) {
										echo '  
										<tr>  
											<td>'.$update_result[$i]["module"].'</td>       
											<td>'.$update_result[$i]["label"].'</td>       
											<td>'.$update_result[$i]["changedon"].'</td>       
											<td>'.$update_result[$i]["fullname"].'</td>       
											<td>'.$update_result[$i]["fieldname"].'</td>       
											<td>'.$update_result[$i]["prevalue"].'</td>       
											<td>'.$update_result[$i]["postvalue"].'</td>       
										</tr> '; 
									}?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					
					
					<div id="loginhistory" class="tab-pane fade">
						<div class="table-responsive">
							<div class='row' style="padding-left:20px;">
									<form class="form-inline" method = 'post' name='form2' action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id; ?>">
									<input type="hidden" name="instanceid" value="<?PHP echo $id;?>"/>
									<div class="form-group">
										<label for="user_name">User</label>						
										<select id="idBranch" name="user_name" class="form-control" required>
											<option value="">Select User</option>
											<?PHP for($i=0;$i<$users_picklist_count;$i++){
												if(isset($_POST['user_name']) && $_POST['user_name'] == $users_picklist_result[$i]['user_name']){
													$sel='selected';}
												else{
													$sel = '';
												}
												echo '<option value="'.$users_picklist_result[$i]['user_name'].'" '.$sel.'>'.$users_picklist_result[$i]['user_name'].'</option>';
											}?>
											
										</select> 
									</div>&nbsp;&nbsp;&nbsp;
									<div class="form-group">
									   <label for="from">From</label>
									   <input type="date" class="form-control" name="from" id="from" value="<?php if(isset($_POST['from']))echo $_POST['from'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<div class="form-group">
									   <label for="to">To</label>
									   <input type="date" class="form-control" name="to" id="to" value="<?php if(isset($_POST['to']))echo $_POST['to'];?>" required>
									</div>&nbsp;&nbsp;&nbsp;
									
									<button type="submit" id="login_submit" name='login_submit' class="btn btn-success">Fetch Data</button>
								   </form>
							</div>	
							<table id="loginhistory_data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>User Name</td>    	   
										<td>User IP</td>    	   
										<td>Sign-in Time</td>    	   
										<td>Sign-out Time </td>    	   
										<td>Status</td>    	    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>	
									</tr>
								</tfoot>
								<tbody>
									<?PHP for($i = 0;$i < $login_count;$i++) {
										echo '  
										<tr>  
											<td>'.$login_result[$i]["user_name"].'</td>                  
											<td>'.$login_result[$i]["user_ip"].'</td>                  
											<td>'.$login_result[$i]["login_time"].'</td>                  
											<td>'.$login_result[$i]["logout_time"].'</td>                  
											<td>'.$login_result[$i]["status"].'</td>                  
										</tr> '; 
									}?>
								</tbody>
							 </table>  
						</div>
					</div>
					
					
			</div>
           </div>
		</div>
	</div>
	</div>
	</div>
<br />		   
      </body>  
 </html> 

 <?php
}
 ?> 
 <script>  
 $(document).ready(function(){ 
	
	
    $('#users_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
    $('#roles_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#groups_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
    $('#modules_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll()
            }
        }
	});
    $('#workflow_data').DataTable({
		"aaSorting": [[1,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
    $('#filter_data').DataTable({
		"aaSorting": [[3,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#dashboard_data').DataTable({
		"aaSorting": [[1,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#template_data').DataTable({
		"scrollX": false,
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
    $('#reports_data').DataTable({
		"scrollX": false,
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#scanner_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#webform_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#cron_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
    $('#fields_fields_data').DataTable({
		"aaSorting": [[2,'asc']],
		
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#fields_relmodule_data').DataTable({
		"aaSorting": [[2,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#fields_rellist_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#picklist_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	/*var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();

            var last=null;
 
            var groupadmin = []; 
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {

                if ( last !== group ) {
  
                    $(rows).eq( i ).before(
                        '<tr class="group" id="'+i+'"><td colspan="5">'+group+'</td></tr>'
                    );
                    groupadmin.push(i);
                    last = group;
                }
            } );
            
            for( var k=0; k < groupadmin.length; k++){
// Code added for adding class to sibling elements as "group_<id>"  
                  $("#"+groupadmin[k]).nextUntil("#"+groupadmin[k+1]).addClass(' group_'+groupadmin[k]); 
               // Code added for adding Toggle functionality for each group
                    $("#"+groupadmin[k]).click(function(){
                        var gid = $(this).attr("id");
                         $(".group_"+gid).slideToggle(300);
                    });
                 
            }
        }
    } );*/
	
	$('#portal_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#pdf_data').DataTable({
		"aaSorting": [[2,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#pbx_incoming_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#pbx_outgoing_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	$('#pbx_noanswer_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#update_data').DataTable({
		
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#comment_data').DataTable({
		"aaSorting": [[2,'asc']],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$('#loginhistory_data').DataTable({
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="width:100px;"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	$("#summaryLink").click(function(){
      $(".overlay").show();
	});
	
	$("#detailLink").click(function(){
      $(".overlay").show();
	});
	
	$('#submit').click(function() {
		$(".overlay").show();
	});
	
	$('#login_submit').click(function() {
		$(".overlay").show();
	});
	
	$('#comment_submit').click(function() {
		$(".overlay").show();
	});
	
 });
	
 </script>  
