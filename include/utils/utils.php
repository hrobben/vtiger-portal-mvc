<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/

global $result;
global $client;

function checkFileAccess($filepath) {
	$root_directory = '';

	// Set the base directory to compare with
	$use_root_directory = $root_directory;
	if(empty($use_root_directory)) {
		$use_root_directory = realpath(dirname(__FILE__).'/../../.');
	}

	$realfilepath = realpath($filepath);

	/** Replace all \\ with \ first */
	$realfilepath = str_replace('\\\\', '\\', $realfilepath);
	$rootdirpath  = str_replace('\\\\', '\\', $use_root_directory);

	/** Replace all \ with / now */
	$realfilepath = str_replace('\\', '/', $realfilepath);
	$rootdirpath  = str_replace('\\', '/', $rootdirpath);

	if(stripos($realfilepath, $rootdirpath) !== 0) {
		die("Sorry! Attempt to access restricted file.");
	}
	return true;
}

// The function to get html format url_list data
// input array
// output htmlsource list array
function getblockurl_fieldlistview($block_array,$block)
{
	$header_arr =$block_array[0][$block]['head'][0][0];	
	$nooffields=count($header_arr);
	$data_arr=$block_array[1][$block]['data'];
	$noofdata=count($data_arr);
	if($nooffields!='')
	{
		$list .='<tr class="detailedViewHeader" align="center">';
		for($i=0;$i<$nooffields;$i++)
			$list .= "<td>".getTranslatedString($header_arr[$i]['fielddata'])."</td>";
		$list .='</tr>';
	}	
	if($noofdata != '')
	{
		for($j=0;$j<$noofdata;$j++)
		{
			for($j1=0;$j1<count($data_arr[$j]);$j1++)
			{
				if($j1== '0'||$j1%2==0)
					$list .='<tr class="dvtLabel">';
				else
					$list .='<tr class="dvtInfo">';

				for($i=0;$i<$nooffields;$i++)
				{
					$data = $data_arr[$j][$j1][$i]['fielddata'];
					if($data =='')
						$data ='&nbsp;';
					if($i == '0' || $i== '1')
					{	if($j1 == '0')
						$list .= '<td rowspan="'.count($data_arr[$j]).'" >'.$data."</td>";
					}
					else
						$list .= "<td>".$data."</td>";
				}
				$list .='</tr>';
			}
		}
	}	
        $list .= '<tr><td colspan ="'.$nooffields.'">&nbsp;</td></tr>';

return $list;
}

/** HTML Purifier global instance */
$__htmlpurifier_instance = false;

/*
 * Purify (Cleanup) malicious snippets of code from the input
 *
 * @param String $value
 * @param Boolean $ignore Skip cleaning of the input
 * @return String
 */
function portal_purify($input, $ignore=false) {
    global $default_charset, $__htmlpurifier_instance;
 
    $use_charset = $default_charset; 
    $value = $input; 
    if($ignore === false) {    	 
        // Initialize the instance if it has not yet done
        if(empty($use_charset)) $use_charset = 'UTF-8';
  
        if($__htmlpurifier_instance === false) {
            require_once('include/htmlpurify/library/HTMLPurifier.auto.php');
            $config = HTMLPurifier_Config::createDefault();
            $config->set('Core.Encoding', $use_charset);
            $config->set('Cache.SerializerPath', "test/cache");
	
            $__htmlpurifier_instance = new HTMLPurifier($config);
        }
        if($__htmlpurifier_instance){
           $value = $__htmlpurifier_instance->purify($value);
        }
    }
	$value = str_replace('&amp;','&',$value);
    return $value;
}
?>