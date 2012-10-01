<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: Get Data :::
// returns data from row and column
// ____________________________________________
//
// function:
//			get_data(table,row(integer),column);
// returns a string from value of a column or false
// input: table-name and row-number and column-name or column number
//

require_once("check_value.php");
function get_data($tb=null,$row=null,$col=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null && $row!==null && $col!==null ) {
		$rowis = @get_row($tb,$row);
		$colis = @sanit_integer($col);
		if($colis!==false && @current($rowis) && $colis<=(count($rowis)-1) ) {
		$rowra = array_values($rowis);
		return $rowra[$colis];}
		elseif($colis===false && @current($rowis) && array_key_exists($col,$rowis) ) return $rowis[$col];
		else{trigger_error("no such column",E_USER_WARNING); return false;}
		
	}
	elseif($tb===null || $row===null || $col===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}	
}
?>