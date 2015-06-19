<?php

class Logout_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run() 
    {
	    $customerid = Session::get('customer_id');
		$sessionid = Session::get('customer_sessionid');

	    $client = $this->soap_client();

        $params = Array(Array('id' => "$customerid", 'sessionid'=>"$sessionid", 'flag'=>"logout"));

		$result = $client->call('update_login_details', $params);
		
		@session_start();
		Session::set('loggedIn', 'false');
		Session::set('customer_id', is_null);
		Session::set('customer_name', is_null);
		Session::set('last_login', is_null);
		Session::set('support_start_date', is_null);
		Session::set('support_end_date', is_null);
		Session::set('__permitted_modules', is_null);
		Session::set('customer_account_id', is_null);
		
        header('location: '.URL.'login');
        exit;
    }
}