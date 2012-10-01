<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: Get Row :::
// ____________________________________________
//
// function:
//			get_row(table,row(integer)); returns a row as an array (keys are column names and values are values)
// input: table-name and row-order
//

require_once("check_value.php");
function get_row($tb=null,$row=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null && $row!==null) {
		$tibca = table_exists($tb);
		if($tibca!==false){
			$rows = @get_row_count($tb);
			$row = sanit_integer($row);
			if($rows===false){
				trigger_error("Table is empty",E_USER_NOTICE);
				return false;
			}
			elseif( $row!==false && 0<=$row && $row<=$rows ){
				$tabo = _FFDBDIR_.$indb["db"]."/".$tibca.".tbl";
				$tabuf = fopen($tabo,"r"); clearstatcache();
				$tabura = fread($tabuf,filesize($tabo));
				$rowpat = "row_".$row."[=]";
				$rowpos = strpos($tabura,$rowpat);
				$pluspos = strpos($tabura,"[+]",$rowpos);
				$toexplu = substr($tabura,$rowpos+strlen($rowpat),$pluspos-$rowpos-strlen($rowpat));
				$prima = explode("[|]",$toexplu);
				$elmir = array_map("FFDB\pure_decode",$prima);
				$donjuan = parse_src($tb);
				return array_combine($donjuan,$elmir);
			}
			else return false;
		}
	}
	elseif($tb===null || $row===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}	
}
?>