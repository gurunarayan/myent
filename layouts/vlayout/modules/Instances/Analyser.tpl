{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
<style>
	#iframeDiagram {
	  background:url(loader.gif) center center no-repeat;
	}
</style>
<div>
	<iframe src="SummaryClient.php?id={$RECORDID}" style="width: 1080px;height:1060px;border:none;" id="iframeDiagram" >
		<p>Your browser does not support iframes.</p>
	</iframe>
</div>
{/strip}