<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: List Free Elements :::
// function: list_free(database-name); returns all free elements id as an array 
// needs access to root or connection to same database
// ____________________________________________
//

function FF_List_map_pluser($ii){
	return pure_encode(substr($ii,strpos($ii,"\n")+1,strpos($ii,"[=]")-strpos($ii,"\n")-1));
}
function list_free($in = null){
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
		if($dbti!=="s"){
			$inp = pure_encode($in);
			$dbf = _FFDBDIR_.$inp."/".$inp.".idx"; clearstatcache();
			$real = fread(fopen($dbf,"r"),filesize($dbf));
			$larg = explode("[+]",str_replace("[Elements index]\n","",$real)); array_pop($larg);
			$Result = array_map("FFDB\FF_List_map_pluser",$larg);
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