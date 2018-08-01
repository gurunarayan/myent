<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class Instances extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_instances';
	var $table_index= 'instancesid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_instancescf', 'instancesid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_instances', 'vtiger_instancescf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_instances' => 'instancesid',
		'vtiger_instancescf'=>'instancesid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'InstancesId' => Array('instances', 'instancesid'),
		'Assigned To' => Array('crmentity','smownerid')
	);
	var $list_fields_name = Array (
		/* Format: Field Label => fieldname */
		'InstancesId' => 'instancesid',
		'Assigned To' => 'assigned_user_id',
	);

	// Make the field link to detail view
	var $list_link_field = 'instancesid';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'InstancesId' => Array('instances', 'instancesid'),
		'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
	);
	var $search_fields_name = Array (
		/* Format: Field Label => fieldname */
		'InstancesId' => 'instancesid',
		'Assigned To' => 'assigned_user_id',
	);

	// For Popup window record selection
	var $popup_fields = Array ('instancesid');

	// For Alphabetical search
	var $def_basicsearch_col = 'instancesid';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'instancesid';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('instancesid','assigned_user_id');

	var $default_order_by = 'instancesid';
	var $default_sort_order='ASC';
	
	function __construct() {
		global $log;
		$this->column_fields = getColumnFields(get_class($this));
		$this->db = new PearDatabase();
		$this->log = $log;
		$this->copiedFiles = Array();
		$this->failedCopies = Array();
		$this->ignoredFiles = Array();
		$this->failedDirectories = Array();
		$this->savedFiles = Array();
		//echo php_uname();
		//echo PHP_OS;
		if (isset($_SERVER['COMSPEC']) || isset($SERVER['WINDIR']))
			$hostOSType='Windows';
		else
			$hostOSType='Linux';
		$this->log = LoggerManager::getLogger('account');
		//echo "<hr><table><tr valign=\"absmiddle\"><td><img width=100px src='modules/vtDZiner/images/vtigress.png' />&nbsp;<span style='font-size:18px;font-weight:bold;'>presents vtDZiner 5.5.8</span> </td> </tr> </table><br><br>";
	}

	function recursiveDelete($str){
		if(is_file($str)){
			return @unlink($str);
		}
		elseif(is_dir($str)){
			$scan = glob(rtrim($str,'/').'/*');
			foreach($scan as $index=>$path){
				$this->recursiveDelete($path);
			}
			return @rmdir($str);
		}
	}

    function vtFileCopy( $source ) {
		if (is_file($source))
		{
			$data = file_get_contents($source);
			$targetfile = "modules/Instances/yourcopies/".substr( $source , 2 );
			$targetpaths = explode (DIRECTORY_SEPARATOR, $targetfile);
			$targetfile = $targetpaths[count($targetpaths)-1];
			unset($targetpaths[count($targetpaths)-1]);
			$targetpath = implode(DIRECTORY_SEPARATOR, $targetpaths);
			//print('<pre>');print_r($targetpaths);print('</pre>');
			//echo "<br>Targetfile is $targetfile, path is $targetpath<br>";
			if (!is_dir($targetpath))
			{
				if (mkdir($targetpath, 0777, true)){
					file_put_contents("modules/Instances/yourcopies/".substr( $source , 2 ), $data);
					//echo "$source saved in modules/Instances/yourcopies<br>";
					$this->savedFiles[] = "$source saved in modules/Instances/yourcopies";
				}
				else {
					//echo "<br>Could not create $targetpath<br>";
					$this->failedDirectories[] = "Could not create $targetpath";
				}
			}
			else {
				file_put_contents("modules/Instances/yourcopies/".substr( $source , 2 ), $data);
				//echo "Saved current copy of $source in modules/Instances/yourcopies<br>";
				$this->savedFiles[] = "$source saved in modules/Instances/yourcopies";
			}
		} else {
			//echo "&nbsp;&nbsp;&nbsp;"."<font color=red>Ignored file $source</font><br>";
			//TODO To check why the ignored file is needed
			//$this->ignoredFiles[] = "Ignored file for archiving $source";
		}
	}

    function copy_r( $path, $dest ) {
        if( is_dir($path) ) {
            @mkdir( $dest );
            $objects = scandir($path);
            if( sizeof($objects) > 0 ) {
                foreach( $objects as $file ) {
                    if( $file == "." || $file == ".." )
                        continue;
                    // go on
                    if( is_dir( $path.DIRECTORY_SEPARATOR.$file ) ) {
                        $this->copy_r( $path.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file );
                    }
                    else {
						// TODO Must save existing script copies for rollback
						$this->vtFileCopy($dest.DIRECTORY_SEPARATOR.$file);
                        $crslt = copy( $path.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file );
						if ($crslt) {
							//echo "Copied ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file."<br>";
							$this->copiedFiles[] = "Copied ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file;
						}
						else {
							$this->failedCopies[] = "Could not copy ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file;
						}
                    }
                }
            }
            return true;
        }
        elseif( is_file($path) ) {
			$crslt = copy($path, $dest);
			if ($crslt)
			{
				//echo "Copied ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file."<br>";
				$this->copiedFiles[] = "Copied ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file;
			}
			else {
				//echo "<font color=red>Could not copy ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file."</font><br>";
				$this->failedCopies[] = "Could not copy ".$path.DIRECTORY_SEPARATOR.$file." to ".$dest.DIRECTORY_SEPARATOR.$file;
			}
            return $crslt;
        }
        else {
            return false;
        }
    }
	
	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {

		require_once('include/utils/utils.php');
		global $adb;

 		if($eventType == 'module.postinstall') {
			require_once('vtlib/Vtiger/Module.php');
			
			
		} else if($eventType == 'module.preuninstall') {
		// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
		// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
		// TODO Handle actions after this module is updated.
		}
		
		$this->copy_r("modules/Instances/vtiger6", ".");
		$this->recursiveDelete("modules/Instances/vtiger6");
		
		$structure = 'analyser';
		if (!mkdir($structure, 0777, true)) {
			die('Failed to create folders...');
		}
		$structure = 'analyser/css';
		if (!mkdir($structure, 0777, true)) {
			die('Failed to create folders...');
		}
		
		$temp_path = 'modules/Instances/temp/';
			
			$files = array(
				$temp_path.'TestClient.php' => 'TestClient.php',
				$temp_path.'TestServer.php' => 'TestServer.php',
				$temp_path.'SummaryClient.php' => 'SummaryClient.php',
				$temp_path.'SummaryServer.php' => 'SummaryServer.php',
				$temp_path.'nusoap.php' => 'analyser/nusoap.php',
				$temp_path.'home.png' => 'analyser/home.png',
				$temp_path.'loader.gif' => 'loader.gif',
				$temp_path.'bootstrap.min.css' => 'analyser/css/bootstrap.min.css',
				$temp_path.'bootstrap.css' => 'analyser/css/bootstrap.css',
				$temp_path.'logo-nav.css' => 'analyser/css/logo-nav.css'
				);
			 
			foreach($files as $spath => $tpath){ 
				rename($spath,$tpath);
			} 
 	}
	
}