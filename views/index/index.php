<?php
//echo $this->content;
	global $Ttabs;
	Session::init();
	if(Session::get('loggedIn') == true)
	{
		//include("HelpDesk/Utils.php");
		//global $default_charset, $default_language;
		//$default_language = getPortalCurrentLanguage();
		//include("language/$default_language.lang.php");
		//header('Content-Type: text/html; charset='.DEFAULT_CHARSET);
		
		// Look if we have the information already
		$tabArray = Session::get('__permitted_modules');
		if(!isset($tabArray)) {
			// Get the information from server
			$client = model::soap_client();
			$params = array();
			$tabArray = $client->call('get_modules',$params,$Server_path,$Server_path);
			// Store for futher re-use
			Session::init();
			$_SESSION['__permitted_modules'] = $tabArray;
		}
		//$module = $_REQUEST['module'];
		//if (!$module) {
			$module = Session::get('tabArray');
		//}
		//echo 'session loggedIn '.Session::get('loggedIn');				
		echo '<script type="text/javascript">';		
		foreach($tabArray as $key => $tabName) {
			if (in_array($tabName, $Ttabs)) {
				if(strcmp(rtrim($module,"/"),$tabName) == 0) {
					?>
					document.getElementById("<?php echo $tabName;?>").className = "dvtSelectedCell";
					<?php
					}
					else {
					?>
					document.getElementById("<?php echo $tabName;?>").className = "dvtUnSelectedCell";
					<?php
					}
				}
			}
		
		echo '</script>';
		Session::init();
		if($_SESSION['customer_id'] != ''){
			$permission = Session::get('__permitted_modules');
			// Look if we have the information already
			if(!isset($permission)) {
				// Get the information from server
				$client = model::soap_client();
				$params = array();
				$permission = $client->call('get_modules',$params,SERVER_PATH,SERVER_PATH);
			}
			$module = $permission[0];
			
			//checkFileAccess("$module/index.php");
			//include("$module/index.php");
		}
		if ($this->content)
			echo $this->content;		
	} else {
		header('location: '.URL.'login');
	}
	


?>
