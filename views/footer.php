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

<!-- Following are the tags which have been opened in header.html. These should be closed after loading the content of the body -->
					</div>
				</td>
			</tr>
		</table>
		<!-- Table with Tickets and FAQ tabs - Ends -->
		</td>
	</tr>
	<tr>
		 <td width="2%">&nbsp;</td>
		 <td width="98%" align="right"><?php echo lang::get('customerportal')." ".VERSION; ?></td>
		 <td width="2%">&nbsp;</td>
	</tr>

	</table>
	</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<!--td width="6" height="6"><img src="images/loginSIBottomLeft.gif"></td>
	<td bgcolor="#FFFFFF"></td>
	<td width="6" height="6"><img src="images/loginSIBottomRight.gif"></td-->
	  </tr>
	</table>
	<br>
    </td>
   </tr>
</table>


<!-- Added for Search in Tickets -->
<!-- pop up for Search -->
<div id="tabSrch">
	<img id="tabSrch_progress" src="<?php echo URL;?>public/images/status.gif" border="0" align="right">
	<form name="search" method="post" action="index.php">
		<input type="hidden" name="module">
		<input type="hidden" name="action">
		<input type="hidden" name="fun">
		
		<div id="_search_formelements_"></div>
	</form>
</div>

<script type="text/javascript">
function showSearchFormNow(elementid) {
	fnDown(elementid);
	
	if($(elementid).loaded) {
		return;
	} else {
		// Squeeze the search div wrapper
		$(elementid).style.width = '100px';
	}
	
	var url = 'module=HelpDesk&action=SearchForm&ajax=true';
	
	new Ajax.Request(
		'index.php', {queue: {position: 'end', scope: 'command'},
		method: 'post',
		postBody:url,
		onComplete: function(response){
					
			// Set the width of serach div wrapper
			$(elementid).style.width = '700px';
						
			$('_search_formelements_').innerHTML = response.responseText;
			$(elementid).loaded = true;
			$(elementid+'_progress').hide();			
		}
	});
	
}

function toggleView(view) {
	if(document.getElementById(view) != null){
		if (document.getElementById(view).style.display=="block") {
			document.getElementById(view).style.display="none"
			document.getElementById(view+"img").src="<?php echo URL; ?>public/images/plus.gif"
			set_cookie("kb_"+view,"none")
		} else {
			document.getElementById(view).style.display="block"
			document.getElementById(view+"img").src="<?php echo URL; ?>public/images/minus.gif"
			set_cookie("kb_"+view,"block")
		}
	}
}

var view=new Array("category","products_array")
for (i=0;i<view.length;i++) {
	if(document.getElementById(view) != null){
		if (get_cookie("kb_"+view[i])==null || get_cookie("kb_"+view[i])=="" || get_cookie("kb_"+view[i])=="block") {
			document.getElementById(view[i]).style.display="block"
			document.getElementById(view[i]+"img").src="<?php echo URL; ?>public/images/minus.gif"
		} else {
			document.getElementById(view[i]).style.display="none"
			document.getElementById(view[i]+"img").src="<?php echo URL; ?>public/images/plus.gif"
		}
	}
}

</script>



