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
		<h3>{'Nagios Settings'}</h3>
	</div>
	<hr>
	
	    <form action="index.php" id="formSettings">
        <input type="hidden" name="parent" value="Settings"/>
        <input type="hidden" name="module" value="Nagios"/>
        <input type="hidden" name="action" value="IndexAjax"/>
        <input type="hidden" name="mode" value="nagiosSettings"/>
        <div class="summaryWidgetContainer">
           <table class="table table-bordered equalSplit" style="width: 50%;">
				<tr>
					<td><label>Server</label></td>
					<td>
						<div class="row-fluid">
							<span class="span10">
								<input type="text" class="input-large fieldInput" name="server" value="{$DATA[0]}" />
							</span>
						</div>
					</td>
				</tr>
				<!--<tr>
					<td><label>Username</label></td>
					<td>
						<div class="row-fluid">
							<span class="span10">
								<input type="text" class="input-large fieldInput" name="user" value="{$DATA[1]}" />
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td>
						<div class="row-fluid">
							<span class="span10">
								<input type="text" class="input-large fieldInput" name="pwd" value="{$DATA[2]}" />
							</span>
						</div>
					</td>
				</tr>-->
			</table>
			<div style="margin-top: 20px;">
                <span>
                    <button class="btn btn-success" type="button" id="btnSaveNagiosSettings">{vtranslate('LBL_SAVE')}</button>
                </span>
            </div>
        </div>
    </form>
		
</div>
{/strip}

<script>
</script>
   
