<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	  ::: parse structure :::
// extracting structure of table as an array
// ____________________________________________
// function:
//			parse_src(); returns array filled with column names
//						 table structure parser
// input: table name
//

require_once("check_value.php");
function parse_src($tb=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null) {
		$tibca = table_exists($tb);
		if($tibca!==false){
				$scro = _FFDBDIR_.$indb["db"]."/".$indb["db"].".src";
				$scrbuf = fopen($scro,"r"); clearstatcache();
				$sabura = fread($scrbuf,filesize($scro));
				$bupat = "[tbl]".pure_encode($tb)."[+tbl][loc]".$tibca."[+loc][=]";
				$starpos = strpos($sabura,$bupat);
				$pluspos = strpos($sabura,"[+]",$starpos);
				$toexplut = substr($sabura,$starpos+strlen($bupat),$pluspos-$starpos-strlen($bupat));
				$primat = explode("[|]",$toexplut);
				$elmirt = array_map("pure_decode",$primat);
				return $elmirt;
		}
	}
	elseif($tb===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}	
}
?>