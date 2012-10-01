<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	  ::: Row Count :::
// ____________________________________________
// get_row_count(table-name); returns nuber of rows in a table (int)
//

require_once("check_value.php");
function get_row_count($tbl=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tbl!=null) {
		if( @table_exists($tbl) ){
			$tblf = _FFDBDIR_.$indb["db"]."/".table_exists($tbl).".tbl";
			$tblo = @fopen($tblf,"r");
			if($tblo){
			clearstatcache(); set_file_buffer($tblo,0);
			$tblstr = fread($tblo,filesize($tblf));
			$lastrow = strrpos($tblstr,"row_");
			$lastequ = strrpos($tblstr,"[=]");
			$number = substr($tblstr,$lastrow+4,$lastequ-$lastrow-4);
			$anitnumb = sanit_integer($number);
			if( $anitnumb!==false ) return $anitnumb;
			elseif(!$lastrow) return null;
			else{ trigger_error("table is wrong defined!",E_USER_WARNING); return false;}
			}
			else return false;
		}
		else{
			trigger_error("table dose not exist",E_USER_WARNING);
			return false;
		}
	}
	elseif($tbl==null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}
}
?>