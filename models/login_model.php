<?php

class Login_Model extends Model
{
    public $er_log;

    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        global $result;   // $version,$default_language,
        $username = trim($_REQUEST['username']);
        $password = trim($_REQUEST['pw']);

        @session_start();
        lang::setPortalCurrentLanguage();

        $params = array('user_name' => "$username",
            'user_password'=>"$password",
            'version' => VERSION);

        $client = $this->soap_client();

        $result = $client->call('authenticate_user', $params, SERVER_PATH, SERVER_PATH);
        //The following are the debug informations
        $err = $client->getError();
        if ($err)
        {
            //Uncomment the following lines to get the error message in login screen itself.
            /*
            echo '<h2>Error Message</h2><pre>' . $err . '</pre>';
            echo '<h2>request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
            echo '<h2>response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
            echo '<h2>debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
            exit;
            */
            $login_error_msg = lang::get("LBL_CANNOT_CONNECT_SERVER");
            $login_error_msg = base64_encode('<font color=red size=1px;> '.$login_error_msg.' </font>');
            header("Location: login.php?login_error=$login_error_msg");
            exit;
        }

        if(strtolower($result[0]['user_name']) == strtolower($username) && strtolower($result[0]['user_password']) == strtolower($password))
        {
            @session_start();
            Session::set('loggedIn', 'true');
            Session::set('customer_id', $result[0]['id']);
            Session::set('customer_sessionid', $result[0]['sessionid']);
            Session::set('customer_name', $result[0]['user_name']);
            Session::set('last_login', $result[0]['last_login_time']);
            Session::set('support_start_date', $result[0]['support_start_date']);
            Session::set('support_end_date', $result[0]['support_end_date']);
            $customerid = Session::get('customer_id');
            $sessionid = Session::get('customer_sessionid');

            $params1 = Array(Array('id' => "$customerid", 'sessionid'=>"$sessionid", 'flag'=>"login"));

            $result2 = $client->call('update_login_details', $params1, SERVER_PATH, SERVER_PATH);

            $params = array('customerid'=>$customerid);
            $permission = $client->call('get_modules',$params,SERVER_PATH,SERVER_PATH);
            $module = $permission[0];       
            
            if($permission == '')
            {
                echo lang::get('LBL_NO_PERMISSION_FOR_ANY_MODULE');
                exit;
            }
            
            // Store the permitted modules in session for re-use
            Session::set('__permitted_modules', $permission);
            
            header("Location: ../index");
        }
        else
        {
            if($result[0] == 'NOT COMPATIBLE'){
                $error_msg = lang::get("LBL_VERSION_INCOMPATIBLE");
            }elseif($result[0] == 'INVALID_USERNAME_OR_PASSWORD') {
                $error_msg = lang::get("LBL_ENTER_VALID_USER");   
            }elseif($result[0] == 'MORE_THAN_ONE_USER'){
                $error_msg = lang::get("MORE_THAN_ONE_USER");
            }
            else
                $error_msg = lang::get("LBL_CANNOT_CONNECT_SERVER");

            $login_error_msg = base64_encode('<font color=red size=1px;> '.$error_msg.' </font>');
            header("Location: elog/$login_error_msg");
         }
   }
    
    public function elog($msg)
        {
            return base64_decode($msg); 
        }    

    private function GetForgotPasswordUI($mail_send_message='')
            {
                $list = '';
                $list .= '<br><br>';
                $list .= '<link rel="stylesheet" type="text/css" href="'.URL.'public/css/style.css">';
                $list .= '<form name="forgot_password" action="'.URL.'login/supportpage/forgot_password" method="post">';   // action nog te doen.  login/supportpage/forgot_password/mail_send_message
                $list .= '<input type="hidden" name="email_id">';
                $list .= '<input type="hidden" name="param" value="forgot_password">';
                $list .= '<table width="50%" border="0" cellspacing="2" cellpadding="2" align="center">';
                $list .= '<tr><td class="detailedViewHeader" nowrap colspan=2 ><b>'.lang::get('LBL_FORGOT_LOGIN').'</b></td></tr>';
                $list .= '<tr><td colspan=2 class="dvtCellInfo">&nbsp;</td></tr>';
                if($mail_send_message != '')
                {
                    $list .= '<tr><td nowrap colspan=2 class="dvtCellInfo">'.$mail_send_message.'</td></tr>';
                }
                    $list .= '<tr><td nowrap class="dvtCellLabel" align="right">'.lang::get('LBL_YOUR_EMAIL').'</td>';
                    $list .= '<td class="dvtCellInfo"><input class="detailedViewTextBox" type="text" name="email_id" STYLE="width:185px;" MAXLENGTH="80" VALUE=""/></td>';
                    $list .= '<tr><td>&nbsp;</td><td><input class="crmbutton small cancel" type="submit" value="'.lang::get('LBL_SEND_PASSWORD').'"></td></tr>';
                    $list .= '</table></form>';

                return $list;
            }

    public function supportpage($param)
        {
            /*********************************************************************************
            ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
             * ("License"); You may not use this file except in compliance with the License
             * The Original Code is:  vtiger CRM Open Source
             * The Initial Developer of the Original Code is vtiger.
             * Portions created by vtiger are Copyright (C) vtiger.
             * All Rights Reserved.
            *
             ********************************************************************************/

            if (isset($_REQUEST['close_window']))
            {
            if($_REQUEST['close_window'] == 'true')
                {
                   ?>
                    <script language="javascript">
                            window.close();
                    </script>
                   <?php
                }
            }
            $client = $this->soap_client();

            if(isset($_REQUEST['email_id']))
            {
                $email = $_REQUEST['email_id'];
                $params = array('email' => "$email");
                $result = $client->call('send_mail_for_password', $params);
                $mail_send_message = $result;
            } else 
            {
                $mail_send_message = '';
            }

            if($mail_send_message != '')
            {
                //print_r($result);
                $mail_send_message = explode("@@@",$mail_send_message);  // email_id

                if($mail_send_message[0] == 'true')
                {
                    $list = '<link rel="stylesheet" type='.URL.'"text/css" href="css/style.css">';
                    $list .= '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">';
                    $list .= '<tr><td class="detailedViewHeader" nowrap colspan=2 align="center"><b>';
                    $list .= lang::get('LBL_SEND_PASSWORD').'.........</b></td></tr>';
                    $list .= '<br><tr><td>&nbsp;</td></tr>';
                    $list .= '<tr><td class="dvtCellInfo">'.$mail_send_message[1].'</td></tr>';
                    $list .= '<br><tr><td>&nbsp;</td></tr>';
                    $list .= '<tr><td align="right"><a href="login.php?close_window=true"> '.lang::get('LBL_CLOSE').'</a>';
                    $list .= '</td></tr></table>';

                    
                }
                elseif($mail_send_message[0] == 'false')
                {
                    $list = $this->GetForgotPasswordUI($mail_send_message[1]);
                    
                }
            }
            elseif($param == 'forgot_password')
            {
                $list = $this->GetForgotPasswordUI();
                    
            }
            elseif($param == 'sign_up')
            {
                $list = 'Sign Up..........';
            }
            
            return $list;     
        }       

}