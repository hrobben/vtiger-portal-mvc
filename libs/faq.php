<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************
* require_once('include/utils/utils.php');
*/
class Faq
{

public static function getNoofFaqsPerCategory($category_name)
{
	$faq_array = $_SESSION['faq_array'];
	$count = 0;
	for($i=0;$i<count($faq_array);$i++)
	{
		if($category_name == $faq_array[$i]['category'])
			$count++;
	}
	return $count;
}
public static function getNoofFaqsPerProduct($productid)
{
	$faq_array = $_SESSION['faq_array'];
	$count = 0;
	for($i=0;$i<count($faq_array);$i++)
	{
		if($productid == $faq_array[$i]['product_id'])
			$count++;
	}
	return $count;
}
public static function getLatestlyCreatedFaqList()
{
	$list = '';
	$search_text = '';
	$product_array = $_SESSION['product_array'];
	$faq_array = $_SESSION['faq_array'];
	$list = '<div class="addimage">'.lang::get('LBL_RECENTLY_CREATED').'</div>';
	$list .= '<br><table width="100%" border="0" cellspacing="0" cellpadding="0" class="dummy">';
	
	for($i=0;$i<count($faq_array);$i++)
	{
		$record_exist = true;
		$list .= '
			   <tr>
				<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">&nbsp;
					<a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$i]['id'].'>'.$faq_array[$i]['question'].'</a></td>
			   </tr>
			   <tr>
				<td class="small" style="padding-left:35px;" >'.$faq_array[$i]['answer'].'</td>
			   </tr>
			   <tr>
				<td height="10"></td>
			   </tr>';
	}
	if(!$record_exist)
		$list .= lang::get('LBL_NO_FAQ');

	$list .= '</table>';
	return $list; 
}
public static function ListFaqsPerCategory($category_index)
{
	$flag = false;
	$list = '';
	$search_text = '';
	$category_array = $_SESSION['category_array'];
	$faq_array = $_SESSION['faq_array'];
	$category = $category_array[$category_index];
	$list = '<div class="addimage">'.lang::get('LNK_CATEGORY').': '.$category.'</div>';  // portal_purify()
	$list .= '<br><table width="100%" border="0" cellspacing="0" cellpadding="0" class="dummy">';

	for($i=0;$i<count($faq_array);$i++)
	{
		if($category == $faq_array[$i]['category'])
		{
			$flag = true;
			$list .= '
				   <tr>
					<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">&nbsp;
						<a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$i]['id'].'>'.$faq_array[$i]['question'].'</a></td>
				   </tr>
				   <tr>
					<td class="small">'.$faq_array[$i]['answer'].'</td></tr><tr><td height="10"></td>
				   </tr>';
		}
	}
	if(!$flag)
		$list .= lang::get('LBL_NO_FAQ_IN_THIS_CATEGORY');
	$list .= '</table>';
	return $list; 
}
public static function ListFaqsPerProduct($productid)
{
	$list = '';
	$flag = false;
	$search_text = '';
	$product_array = $_SESSION['product_array'];
	$faq_array = $_SESSION['faq_array'];
	$list = '<div class="addimage">'.lang::get('LBL_PRODUCT').': '.faq::getProductname($productid).'</div>'; // portal_purify()
	$list .= '<br><table width="100%" border="0" cellspacing="0" cellpadding="0" class="dummy">';
	
	for($i=0;$i<count($faq_array);$i++)
	{
		if($productid == $faq_array[$i]['product_id'])
		{
			$flag = true;
			$list .= '
				   <tr>
					<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">&nbsp;
						<a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$i]['id'].'>'.$faq_array[$i]['question'].'</a></td>
				   </tr>
				   <tr>
					<td class="small">'.$faq_array[$i]['answer'].'</td>
				   </tr>
				   <tr>
					<td height="10"></td>
				   </tr>';
		}
	}
	if(!$flag) 
		$list .= lang::get('LBL_NO_FAQ_IN_THIS_PRODUCT');
	$list .= '</table>';
	return $list; 
}

public static function getArticleIdTime($faqid,$product_id,$faqcategory,$faqcreatedtime,$faqmodifiedtime)
{
	$list .='<div id="faqDetail" onMouseOver="fnShowDiv(\'faqDetail\')" onMouseOut="fnHideDiv(\'faqDetail\')">
		 <table class="fagView" cellpadding="0" cellspacing="0">
		   <tr>
			<td align="right"><b>'.lang::get('LBL_FAQ_ID').': </b></td><td align="left"><b>'.$faqid.'</b></td>
		   </tr>
		   <tr>
			<td align="right">'.lang::get('LBL_PRODUCT').': </td><td align="left">'.faq::getProductName($product_id).'</td>
		   </tr>
		   <tr>
			<td align="right">'.lang::get('LBL_CATEGORY').': </td><td align="left">'.$faqcategory.'</td>
		   </tr>
		   <tr>
			<td align="right">'.lang::get('LBL_CREATED_DATE').': </td><td align="left">'.substr($faqcreatedtime,0,10).'</td>
		   </tr>
		   <tr>
			<td align="right" nowrap>'.lang::get('LBL_MODIFIED_DATE').': </td><td align="left">'.substr($faqmodifiedtime,0,10).'</td>
		   </tr>
		</table>
		</div>';

	return $list;
}
public static function getPageOption()
{
	$list .= '
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
		   	   <tr>
				<td width="18" align="center"><img src="'.URL.'public/images/print.gif" valign="absmiddle"></td><td><a href="javascript:printPage()">'.lang::get('LBL_PRINT_THIS_PAGE').'</a></td>
				<td width="18" align="center"><img src="'.URL.'public/images/email.gif" valign="absmiddle"></td><td><a href="javascript:sendAsEmail();">'.lang::get('LBL_EMAIL_THIS_PAGE').'</a></td>
				<td width="18" align="center"><img src="'.URL.'public/images/favorite.gif" valign="absmiddle"></td><td><a href="javascript:addToFavorite();">'.lang::get('LBL_ADD_TO_FAVORITES').'</a></td>
			   </tr>
			</table>
		';
	$list .= '<script language="JavaScript">
				function printPage() {
					window.print()
				}
				function sendAsEmail() {
					var emailBody=escape("'.lang::get('LBL_ARTICLE_INTERESTED').'"+String.fromCharCode(13)+String.fromCharCode(13)+"URL: "+document.location.href)
					document.location.href = "mailto:?body="+emailBody;
				}
				function addToFavorite() {
					if (document.all) {
						window.external.addFavorite(document.location.href,document.title);
					} else {
						alert("'.lang::get('LBL_PRESS_CNTR_D').'")
					}
				}
			</script>';
	
	return $list;
}
public static function getProductName($productid)
{
	$product_array = $_SESSION['product_array'];
	$productname = '';
	for($i=0;$i<count($product_array);$i++)
	{
		if($productid == $product_array[$i]['productid'])
			$productname = $product_array[$i]['productname'];
	}
	return $productname;
}
public static function getSearchCombo()
{
	$category_array = $_SESSION['category_array'];
	$product_array = $_SESSION['product_array'];
	$comboarray = '<select name="search_category">';
	$comboarray .= '<OPTION value="all:All">All</OPTION>';
	$comboarray .= '<OPTGROUP label="Categories">';
	for($i=0;$i<count($category_array);$i++)
	{
		$selected = '';
		if (isset($_REQUEST['search_category'])) {
			$search_category = explode(":",$_REQUEST['search_category']);
			if($category_array[$i] == $search_category[1])
				$selected = 'selected';
		}
		$comboarray .= '<OPTION value="category:'.$category_array[$i].'"'.$selected.'>'.$category_array[$i].'</OPTION>';
	}
	$comboarray .= '</OPTGROUP>';
	$comboarray .= '<OPTGROUP label="Products">';
        for($i=0;$i<count($product_array);$i++)
        {
                $selected = '';
		if (isset($_REQUEST['search_category'])) {
	 		$search_category = explode(":",$_REQUEST['search_category']);
                if($product_array[$i]['productname'] == $search_category[1])
                        $selected = 'selected';
            }
            $comboarray .= '<OPTION value="products:'.$product_array[$i]['productname'].'"'.$selected.'>'.$product_array[$i]['productname'].'</OPTION>';
        }
        $comboarray .= '</OPTGROUP>';
	$comboarray .= '</select>';
	return $comboarray;
}
public static function getSearchResult($search_text,$search_value,$search_by)
{
	$flag = false;
	$record_exist = false;
	$faq_array = $_SESSION['faq_array'];
	
	$list = '<div class="addimage">'.lang::get('LBL_SEARCH_RESULT').'</div>';
	$list .= '<br><table class="dummy" width="100%" border=0 cellspacing=0 cellpadding=0>';

	if($search_value == 'All')
        {
                for($i=0;$i<count($faq_array);$i++)
                {
			if($search_text != '')
	                        $flag = @stristr($faq_array[$i]['question'],$search_text);
			else
				$flag = true;

                        if($flag)
                        {				  // index.php?module=Faq&action=index&fun=faq_detail&faqid='	
				$record_exist = true;    // '.URL.'index/Faq/index/faqs/1/'.$product
                                $list .= ' <tr>
						<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">&nbsp;  
			                                <a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$i]['id'].'>'.$faq_array[$i]['question'].'</a></td>
					   </tr>
					   <tr>
						<td class="small">'.$faq_array[$i]['answer'].'</td>
					   </tr>
					   <tr>
						<td height="18" class="kbFAQInfo">'.lang::get('LBL_CATEGORY').': '.$faq_array[$i]['category'].'</td>
					   </tr>
					   <tr>
						<td height="15"></td>
					   </tr>';
                        }
                }
		if(!$record_exist)
                        $list .=  lang::get('LBL_NO_FAQ_IN_THIS_SEARCH_CRITERIA');
        }
        elseif($search_by == 'category')
        {
                for($i=0;$i<count($faq_array);$i++)
                {
			if($search_text != '')
	                        $flag = @stristr($faq_array[$i]['question'],$search_text);
			else
				$flag = true;
                        if($flag && $faq_array[$i]['category'] == $search_value)
                        {
				$record_exist = true;
                                $list .= '
					   <tr>
						<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">&nbsp;
							<a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$i]['id'].'>'.$faq_array[$i]['question'].'</a></td>
					   </tr>
					   <tr>
						<td class="small">'.$faq_array[$i]['answer'].'</td>
					   </tr>';
                        }
                }
		if(!$record_exist)
			$list .=  lang::get('LBL_NO_FAQ_IN_THIS_SEARCH_CRITERIA');
        }
	elseif($search_by == 'products')
	{
		$product_array = $_SESSION['product_array'];
		$faq_array = $_SESSION['faq_array'];
		for($i=0;$i<count($product_array);$i++)
		{
			if($product_array[$i]['productname'] == $search_value)
			{
				for($j=0;$j<count($faq_array);$j++)
       				{
					if($search_text != '')
		                                $flag = @stristr($faq_array[$j]['question'],$search_text);
                		        else
                                		$flag = true;
			        	if($flag && ($product_array[$i]['productid'] == $faq_array[$j]['product_id']))
			                {
                        			$record_exist = true;
			                        $list .= '
							   <tr>
								<td><img src="'.URL.'public/images/faq.gif" valign="absmiddle">
									<a class="faqQues" href='.URL.'index/Faq/index/faq_detail/1/0/'.$search_text.'/1/'.$faq_array[$j]['id'].'>'.$faq_array[$j]['question'].'</a></td>
							   </tr>
							   <tr>
								<td class="small">'.$faq_array[$j]['answer'].'</td>
							   </tr>
							   <tr>
								<td height="10"></td>
							   </tr>';
			                }
			        }
			}
		}
		if(!$record_exist)
                        $list .=  lang::get('LBL_NO_FAQ_IN_THIS_SEARCH_CRITERIA');
	}

	$list .= '</table>';
	return $list;
}

public static function text_length($str){
	$length = strlen($str);
	if($length > 25){
		$str = substr($str,0,25)."..";
		return $str;
	}
	return $str;
}

}
