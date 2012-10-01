<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: Get Column :::
// returns array of columns values from all and in order to rows
// ____________________________________________
//
// function:
//			get_column(table,column);
// input: table-name and column-name or number
//

require_once("check_value.php");
function get_column($tb=null,$col=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null && $col!==null ) {
		$count = get_row_count($tb);
		$result = array();
		for($iw=0; $iw<=$count; $iw++){
			$alpha = get_data($tb,$iw,$col);
			if ($alpha!==null || $alpha!==false) array_push($result,$alpha);
		}
		if (count($result)>0) return $result; else return false;
	}
	elseif($tb===null || $col===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}	
}
?>