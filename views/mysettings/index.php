<!-- added for popup My Settings -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
   <head>
	<title><?php echo lang::get('LBL_MY_SETTINGS');?></title>
	<link href="<?php echo URL;?>public/css/style.css" rel="stylesheet" type="text/css">
   </head>

   <body>
	<table width="95%"  border="0" cellspacing="0" cellpadding="3" align="center">
	   <form name="savepassword" action="<?php echo URL; ?>mysettings/run" method="post">
	   <input type="hidden" name="fun" value="savepassword">
	   <tr><td colspan="2"></td></tr>
	   <tr>
		<td height="30" align="left"><b style="text-decoration:underline"><?PHP echo lang::get('LBL_MY_SETTINGS');?></b></td>
		<td align="right" ><a href="javascript:window.close();"><?php echo lang::get('LBL_CLOSE');?></a></td>
	   </tr>
	   <tr><td colspan="2">&nbsp;</td></tr>
	   <tr>
		<td colspan="2" class="detailedViewHeader"><b><?php echo lang::get('LBL_MY_DETAILS');?></b></td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_LAST_LOGIN'); ?></td>
		<td class="dvtCellInfo"><b><?php echo Session::get('last_login'); ?></b></td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_SUPPORT_START_DATE'); ?></td>
		<td class="dvtCellInfo"><b><?php echo Session::get('support_start_date'); ?></b></td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_SUPPORT_END_DATE'); ?></td>
		<td class="dvtCellInfo"><b><?php echo Session::get('support_end_date'); ?></b></td>
	   </tr>
	   <tr><td colspan="2">&nbsp;</td></tr>
	   <tr><td colspan="2"><?php echo $this->errormsg; ?></td></tr>
	   <tr>
		<td colspan="2" class="detailedViewHeader"><b><?php echo lang::get('LBL_CHANGE_PASSWORD'); ?></b></td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_OLD_PASSWORD'); ?></td>
		<td class="dvtCellInfo">
			<input type="password" name="old_password" class="detailedViewTextBox"  onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" value="">
		</td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_NEW_PASSWORD'); ?></td>
		<td class="dvtCellInfo">
			<input type="password" name="new_password" class="detailedViewTextBox"  onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" value="">
		</td>
	   </tr>
	   <tr>
		<td class="dvtCellLabel" align="right"><?php echo lang::get('LBL_CONFIRM_PASSWORD'); ?></td>
		<td class="dvtCellInfo">
			<input type="password" name="confirm_password" class="detailedViewTextBox"  onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" value="">
		</td>
	   </tr>
	   <tr><td colspan="2" class="dvtCellInfo">&nbsp;</td></tr>
	   <tr>
		<td colspan="2" align="center">
		   <input name="savepassword" type="submit" value="<?php echo lang::get('LBL_SAVE'); ?>" onclick="return verify_data(this.form)">&nbsp;&nbsp;
		   <input name="Close" type="button" value="<?php echo lang::get('LBL_CLOSE'); ?>" onClick="window.close();">
		</td>
	   </tr>
	   <tr>
		<td colspan="2">&nbsp;</td>
	   </tr>
	   </form>
	</table>

	<script>
		function verify_data(form)
		{
		        oldpw = trim(form.old_password.value);
		        newpw = trim(form.new_password.value);
		        confirmpw = trim(form.confirm_password.value);
		        if(oldpw == '')
		        {
				alert("Enter Old Password");
		                return false;
		        }
		        else if(newpw == '')
		        {
				alert("Enter New Password");
		                return false;
		        }
		        else if(confirmpw == '')
		        {
				alert("Confirm the New Password");
		                return false;
		        }
		        else
		        {
		                return true;
		        }
		}
		function trim(s)
		{
		        while (s.substring(0,1) == " ")
		        {
		                s = s.substring(1, s.length);
		        }
		        while (s.substring(s.length-1, s.length) == ' ')
		        {
		                s = s.substring(0,s.length-1);
		        }

		        return s;
		}
	</script>
   </body>
</html>

<?php
//echo $this->mysettings;