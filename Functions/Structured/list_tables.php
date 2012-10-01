<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: List Tables :::
// function: list_tables(database-name); returns all tables id in an array 
// needs access to root or connection to same database
// ____________________________________________
//

function FF_table_map_pluser($ii){
	return substr($ii,(strpos($ii,"[tbl]")+5),(strpos($ii,"[+tbl]")-(strpos($ii,"[tbl]")+5)));
}
function list_tables($in = null){
if ($in === null) {
		trigger_error("Wrong function invoking! input is null",E_USER_WARNING);
		return false; 
	}
global $root;
global $indb;
$volver = $indb["db"];
	if (@connected($in) || $root) {
		if($in!=null) $indb["db"]=$in;
		$dbti = db_type();
		if($dbti!=="f"){
			$inp = pure_encode($in);
			$dbf = _FFDBDIR_.$inp."/".$inp.".src"; clearstatcache();
			$real = fread(fopen($dbf,"r"),filesize($dbf));
			$larg = explode("[+]",str_replace("[STRUCTURE]\n","",$real)); array_pop($larg);
			$Result = array_map("FFDB\FF_table_map_pluser",$larg);
			$indb["db"] = $volver;
			return $Result;
		}
		else return false;
	}
	else{
		trigger_error("You have not access",E_USER_WARNING);
		return false; 
	}
}
?>