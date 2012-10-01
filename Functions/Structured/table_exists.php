<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	  ::: Table Existance:::
// returns is table exists or not
// ____________________________________________
//
// finction: table_exists(); if table exists returns file name
// input: table name
//

function table_exists($in=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $in!=null ) {
	$inp = pure_encode($in);
		// find where is the element
		$strc = _FFDBDIR_.$indb["db"]."/".$indb["db"].".src";
		$osrc = @fopen($strc,"r");
		if($osrc){
		clearstatcache();
		$srcstr = fread($osrc,filesize($strc));
		$srcpat = "[tbl]".$inp."[+tbl][loc]";
		$tablerpos = strpos($srcstr,$srcpat);
		if($tablerpos){
		$pluserpos = strpos($srcstr,"[+loc]",$tablerpos);
		$findex = substr($srcstr,$tablerpos+strlen($srcpat),$pluserpos-$tablerpos-strlen($srcpat));
		// if exists return file name
		return $findex;
		}
		else return false;
		} else return false;
	}
	elseif($in==null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}
}
?>