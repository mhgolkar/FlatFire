<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//::: Retruns Database type :::
// free, structured and mixed
//	functions:
//				db_type(); returns srting (f/s/m) or false if database dose not exists in dbi
//				mix_it(); change a free or structured db to mixed (make files and changes indexes); returns true on success
// ____________________________________________
//

// DB_TYPE
function db_type(){
global $indb;
global $root;
	if(_FF_Root_acs_ && $root && $indb["db"]!=null) $goliath=true;
	elseif ($indb && @connected($indb["db"])) $goliath=true;
	else $goliath=false;
	if($goliath){
		$dbinx = _FFDBDIR_."/Databases.dbi";
		clearstatcache();
		if( file_exists($dbinx) ){
			$fdbinxo = fopen($dbinx,"r");
			$dbinxstr = fread($fdbinxo,filesize($dbinx));
			$nimpat = pure_encode($indb["db"])."[=]";
			if( strpos($dbinxstr,$nimpat."FREE[+]") != false ) return "f";
			if( strpos($dbinxstr,$nimpat."SRCT[+]") != false ) return "s";
			if( strpos($dbinxstr,$nimpat."MIXD[+]") != false ) return "m";
			return false;			
		}
		else {
			trigger_error("unable to access database index in database folder",E_USER_WARNING);
			return false;
		}
	}
	elseif($indb["db"]==null) {
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else {
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}
}


// MIX_IT
function mix_it(){
global $indb;
global $root;
	if(_FF_Root_acs_ && $root && $indb["db"]!=null) $goliath=true;
	elseif ($indb && @connected($indb["db"])) $goliath=true;
	else $goliath=false;
	if($goliath && _FF_mxd_db_){
		if(db_type() === "m") return true;
		else {
			clearstatcache();
			// always first make files
			$dbadre = _FFDBDIR_.$indb["db"]."/".$indb["db"];
			if( !file_exists($dbadre.".idx") || !file_exists($dbadre.".src") ) setup_db("m");
			// then add to index or make changes
			$fdbinx = @fopen(_FFDBDIR_."Databases.dbi","x+");
					if($fdbinx) {fwrite($fdbinx,"[DATABASE LIST]\n"); fclose($fdbinx);}
				$fdbiop = fopen(_FFDBDIR_."Databases.dbi","r+");
					$fdbiopstr = fread($fdbiop,filesize(_FFDBDIR_."Databases.dbi"));
					$fdbioplay0 = strpos($fdbiopstr,"\n".pure_encode($indb["db"])."[=]");
					$fdbioplay1 = strpos($fdbiopstr,"[+]",$fdbioplay0);
					$tofdbiop = substr_replace($fdbiopstr,"\n".pure_encode($indb["db"])."[=]MIXD[+]",$fdbioplay0,$fdbioplay1-$fdbioplay0+3);
					ftruncate($fdbiop,0); rewind($fdbiop);
					fwrite($fdbiop,$tofdbiop);
					fclose($fdbiop);
		}
	}
	else {
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}
}
?>