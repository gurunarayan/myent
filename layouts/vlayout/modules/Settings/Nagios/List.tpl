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

</style>

<div class="container-fluid">
	<div class="widget_header">
		<h3>{'Nagios'}</h3>
	</div>
	<hr>
	<div>
		<iframe src="{$DATA[0]}map.php?host=all" style="width: 1080px;height:1060px;border:none;" id="iframeDiagram" >
			<p>Your browser does not support iframes.</p>
		</iframe>
	</div>
</div>
{/strip}

<script>
</script>
   
