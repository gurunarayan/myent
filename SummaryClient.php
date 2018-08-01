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

$url = $site_URL."SummaryServer.php?wsdl";
$client = new nusoap_client($url);

$servername = $dbconfig['db_hostname'];
$servername = $dbconfig['db_server'];
$username = $dbconfig['db_username'];
$password = $dbconfig['db_password'];
$db_name = $dbconfig['db_name'];
$db_type  =  $dbconfig['db_type']; 


$connString = $client ->call('connString',array('id'=>$id,'dbconfig'=>$dbconfig));
$users_detail = $client ->call('getUsersDetails',array('id'=>$id,'dbconfig'=>$dbconfig));

if($client->fault){
	echo "FAULT: <p>Code: (".$client ->faultcode.")</p>";
	echo "String: ".$client->faultstring;
	
}else{
	$err_msg = $client->getError();
    if ($err_msg) {
        // Print error msg
        echo 'Error: '.$err_msg;
    }
	$users_result = $users_detail[0];
	//print_r($users_result);
	$module = $users_result['module'];
	$module_count = count($module);
	
	
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
				<!--<div class="navbar-header">   
					<a class="navbar-brand avanta-brand" href="tracker/index.php" title="Click to return to KPI index" style="margin: 0 25px;">OCT11</a>
				</div>-->             
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
					
					<ul class="nav nav-tabs">
						<li class="active" ><a data-toggle="tab" href="#users">Users</a></li>
						<li><a data-toggle="tab" href="#module">Modules</a></li>
						<li><a data-toggle="tab" href="#settings">Settings</a></li>
					</ul>
				<br />
				<div class="tab-content">
					<div id="users" class="tab-pane fade in active">
						<div class="table-responsive">  
							<table id="data" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Summary</td>    	   
										<td>Count</td>    	    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?PHP echo' 
										<tr>  
											<td>Active Users</td>                  
											<td>'.$users_result["active_user_count"].'</td> 
										</tr>
										<tr>  
											<td>In-Active Users</td>                  
											<td>'.$users_result["inactive_user_count"].'</td> 
										</tr>
										<tr>  
											<td>Roles</td>                  
											<td>'.$users_result["role_count"].'</td> 
										</tr>
										<tr>  
											<td>Groups</td>                  
											<td>'.$users_result["group_count"].'</td> 
										</tr>
										<tr>  
											<td>Profiles</td>                  
											<td>'.$users_result["profile_count"].'</td> 
										</tr>
										<tr>  
											<td>Login History</td>                  
											<td>'.$users_result["login_count"].'</td> 
										</tr>';?>
								</tbody>
							 </table>
						</div>
					</div>
					
					<div id="module" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="data_1" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Summary</td>    	   
										<td>Count</td>    	    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?PHP
									for($i = 0;$i < $module_count;$i++) {
									
									echo '  
									<tr>  
										<td>'.$module[$i]["name"].'</td>                  
										<td>'.$module[$i]["total"].'</td>                  
														
									</tr> '; 
									}?>
								</tbody>
							 </table>
						</div>
					</div>
					
					<div id="settings" class="tab-pane fade">
						<div class="table-responsive">  
							<table id="data_2" class="table table-striped table-bordered" style="width:100%">  
								<thead>  
								   <tr>   
										<td>Summary</td>    	   
										<td>Count</td>    	    	   
								   </tr>  
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?PHP echo '  
										<tr>  
											<td>Workflow</td>                  
											<td>'.$users_result["workflow_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Email Templates</td>                  
											<td>'.$users_result["email_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Reports</td>                  
											<td>'.$users_result["report_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Scheduler</td>                  
											<td>'.$users_result["cron_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Webforms</td>                  
											<td>'.$users_result["webform_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Fields</td>                  
											<td>'.$users_result["field_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Custom View</td>                  
											<td>'.$users_result["filter_count"].'</td>                  					
										</tr>
										<tr>  
											<td>Dashboard</td>                  
											<td>'.$users_result["link_count"].'</td>                  					
										</tr>'; 
									?>
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
		
		$('#data').DataTable({
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
		$('#data_1').DataTable({
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
		$('#data_2').DataTable({
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

	
	});
	
 </script>  
