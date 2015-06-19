<?php

class Lang
{
    
    /**
     *
     * @param string $text the string containing text witch needed translation.     * 
     */

    public static function get($text)
    {
        //if (!isset($app_strings)) {
            if(file_exists("public/languages/".DEFAULT_LANG.".lang.php")){
                require("public/languages/".DEFAULT_LANG.".lang.php");
            }
        //}
        return (isset($app_strings[$text]))?$app_strings[$text]:$text;
    }
    
    /*  Function to Show the languages in the Login page
    *   Takes an array from PortalConfig.php file $language
    *   Returns a list of available Language    
    */
    public static function getPortalLanguages() {
        global $languages;
        foreach($languages as $name => $label) {
            if(strcmp(DEFAULT_LANG,$name) == 0){
                $list .= '<option value='.$name.' selected>'.$label.'</option>';
            } else {
                $list .= '<option value='.$name.'>'.$label.'</option>';
            }
        }
        return $list;
    }
    /*  Function to set the Current Language
     *  Sets the Session with the Current Language
     */
    public static function setPortalCurrentLanguage() {
        // global $default_language;
        if(isset($_REQUEST['login_language']) && $_REQUEST['login_language'] != ''){
            $_SESSION['portal_login_language'] = $_REQUEST['login_language'];
        } else {
            $_SESSION['portal_login_language'] = DEFAULT_LANG;
        }
        return;
    }

    /*  Function to get the Current Language
     *  Returns the Current Language
     */
    public static function getPortalCurrentLanguage() {
        /*global $default_language;
        if(isset($_SESSION['portal_login_language']) && $_SESSION['portal_login_language'] != ''){
            DEFINE('DEFAULT_LANG', $_SESSION['portal_login_language']);
        } else {
            DEFINE('DEFAULT_LANG', 'en_us');
        }*/
        return DEFAULT_LANG;
    }
}