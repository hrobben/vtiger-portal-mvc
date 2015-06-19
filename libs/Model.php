<?php

class Model{

    function __construct() {
        // $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    public static function soap_client()
    {
         
            $client = new nusoap_client(SERVER_PATH."/vtigerservice.php?service=customerportal", false, PROXY_HOST, PROXY_PORT, PROXY_USERNAME, PROXY_PASSWORD);
            //We have to overwrite the character set which was set in nusoap/lib/nusoap.php file (line 151)
            $client->soap_defencoding = DEFAULT_CHARSET;  
            return $client;          
            
    }

}
