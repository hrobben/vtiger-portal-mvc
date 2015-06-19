<?php

class MySettings_model extends Model {

	public $errormsg;

    public function __construct() {
        parent::__construct();
    }

	//Added for My Settings - Save Password
	private function SavePassword($version)
	{
		$client = $this->soap_client();
		$errormsg = '';
		$customer_id = $_SESSION['customer_id'];
		$customer_name = $_SESSION['customer_name'];
		$oldpw = trim($_REQUEST['old_password']);
		$newpw = trim($_REQUEST['new_password']);
		$confirmpw = trim($_REQUEST['confirm_password']);

		$params = Array('user_name'=>"$customer_name",'user_password'=>"$oldpw",'version'=>"$version",'login'=>'false');
		$result = $client->call('authenticate_user',$params);
		$sessionid = $_SESSION['customer_sessionid'];
		if($oldpw == $result[0]['user_password'])
		{
			if(strcasecmp($newpw,$confirmpw) == 0)
			{
				$customerid = $result[0]['id'];
							
			//	$customerid = $_SESSION['customer_id'];
				$sessionid = $_SESSION['customer_sessionid'];

				$client = $this->soap_client();
				$params = Array(Array('id'=>"$customerid", 'sessionid'=>"$sessionid", 'username'=>"$customer_name",'password'=>"$newpw",'version'=>"$version"));

				$result_change_password = $client->call('change_password',$params);
				if($result_change_password[0] == 'MORE_THAN_ONE_USER'){
					$errormsg .= lang::get('MORE_THAN_ONE_USER');
				}else{
					$errormsg .= lang::get('MSG_PASSWORD_CHANGED');
				}
			}
			else
			{
				$errormsg .= lang::get('MSG_ENTER_NEW_PASSWORDS_SAME');
			}
		}elseif($result[0] == 'INVALID_USERNAME_OR_PASSWORD') {
			$errormsg .= lang::get('LBL_ENTER_VALID_USER');	
		}elseif($result[0] == 'MORE_THAN_ONE_USER'){
			$errormsg .= lang::get('MORE_THAN_ONE_USER');
		}
		else
		{
			$errormsg .= lang::get('MSG_YOUR_PASSWORD_WRONG');
		}

		return $errormsg;
	}

    public function run()
    {
    	return $this->SavePassword(VERSION);
    }
    
}