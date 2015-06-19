<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>vtiger CRM 6 - CustomerPortal</title>
	<link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" /> 
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/prototype.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/general.js"></script>
    <script language="JavaScript" src="<?php echo URL; ?>public/js/cookies.js"></script>
    <?php 
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
// Prototype library clashes with AutoComplete library in use so avoid on those pages
/*if($_REQUEST['fun'] != 'newticket') {
	echo '<script language="javascript" type="text/javascript" src="js/prototype.js"></script>';
}
*/?>

<script>
	
function fnMySettings(){
		window.open("<?php echo URL; ?>mysettings","MySetttings","menubar=no,location=no,resizable=no,scrollbars=no,status=no,width=400,height=350,left=550,top=200");
}
</script>
</head>

<body>
<table class="innerTab" cellspacing="0" cellpadding="0">
   <tr>
    <th align="left"><img src="<?php echo URL;?>public/images/loginVtigerCRM.gif" width="169" height="49"></th>
    <th>&nbsp;</th>
    <th align="right" style="padding-right:15px;" nowrap>
	<span onclick="fnMySettings();" class="MySettingsHdr"><?php echo lang::get('LBL_MY_SETTINGS');?></span>&nbsp;|&nbsp;
	<a href="<?php echo URL;?>logout/run" class="hdr"><?php echo lang::get('LBL_LOG_OUT');?></a></th>
   </tr>
  <tr class="tableTop"><td colspan="3"></td></tr>
  <tr class="tableMid">
    <td colspan="3" align="right" valign="top">
	<table cellspacing="0" cellpadding="0" align="center" border="0" width="99%">
	   <tr>
		<td width="6" height="5"></td>
	        <td align="right">&nbsp;</td>
        	<td width="6" height="5"></td>
	   </tr>
	   <tr>
        	<td width="6" height="5"><img src="<?php echo URL;?>public/images/loginSITopLeft.gif"></td>
        	<td bgcolor="#FFFFFF"></td>
	        <td width="6" height="5"><img src="<?php echo URL;?>public/images/loginSITopRight.gif"></td>
	   </tr>
	   <tr bgcolor="#FFFFFF">
	        <td height="100">&nbsp;</td>
		<td valign="top">
		   <table width="100%"  border="0" cellspacing="0" cellpadding="3">
		      <tr>
			<td class="dvtCellInfo" colspan="2">
				<!-- Table with Tickets and FAQ tabs - Starts -->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="99%">
                		<tbody>
				   <tr>
                    			<td>
                      				<table class="small" border="0" cellpadding="1" cellspacing="0" width="98%">
			                        <tbody>
                        			   <tr>
			             	<?php
			             		$showmodule = array();
								// Look if we have the information already
								if(isset($_SESSION['__permitted_modules'])) {
									$showmodule = $_SESSION['__permitted_modules'];
								} else {
									// Get the information from server
									$client = model::soap_client();
									$params = array();
									$showmodule = $client->call('get_modules',$params,SERVER_PATH,SERVER_PATH);
									// Store for further use.
									$_SESSION['__permitted_modules'] = $showmodule;
								}
								global $Ttabs;
								for($i=0;$i<count($showmodule);$i++ ) {
									//if(file_exists($showmodule[$i])) // Show module tab, only if the module directory exists
									if (in_array($showmodule[$i], $Ttabs))
										echo "<td class='dvtUnSelectedCell'  align='center' nowrap='nowrap' id='$showmodule[$i]' onclick='fnLoadValues(\"$showmodule[$i]\")'><a href='".URL."index/".$showmodule[$i]."/index/true'><b>".lang::get($showmodule[$i])."</b></a></td>";
								}
							?>
						  </tr>
						</tbody>
						</table>
					</td>
				   </tr>
				   <tr>
					<td align="left" valign="top">
						<div id="mnuTab">

