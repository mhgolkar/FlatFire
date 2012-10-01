<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: Setup Database :::
//	functions:
//				setup_db(f/s/m);
// ____________________________________________
//

function setup_db($mo=null){
global $indb;
global $root;
	if(_FF_Root_acs_ && $root===true) $setable=true;
	elseif ($indb && connected($indb["db"]) && $mo!=null) $setable=true;
	else $setable=false;
	if($setable){
		clearstatcache();
		$dbdir = _FFDBDIR_.$indb["db"];
		$dbxir = $dbdir."/".$indb["db"];
		if( !is_writeable($dbdir) ) chmod($dbdir,0750);
		clearstatcache(); if( !is_writeable($dbdir) ) {
			trigger_error("unable to write in database folder, please check permisions",E_USER_ERROR);
			return false;
		} 
		else {
			// .ctr -1
			if( !file_exists($dbxir.".ctr") ){
				$fdbctr = @fopen($dbxir.".ctr","x+");
				fwrite($fdbctr,"-1");
				@fclose($fdbctr);
			}
			//
			switch( strtolower($mo) ){
				case "f":			
					//.idx [Elements index]\n
					$fdbidx = @fopen($dbxir.".idx","x+");
					if($fdbidx) {fwrite($fdbidx,"[Elements index]\n"); fclose($fdbidx);}
					$dbtipi = "FREE";
						break;
				case "s":
					//.src [STRUCTURE]\n
					$fdbsrc = @fopen($dbxir.".src","x+");
					if($fdbsrc) {fwrite($fdbsrc,"[STRUCTURE]\n"); fclose($fdbsrc);}
					$dbtipi = "SRCT";
						break;
				default:
					//code mixed
					if (_FF_mxd_db_){
					$fdbidx = @fopen($dbxir.".idx","x+");	if($fdbidx) {fwrite($fdbidx,"[Elements index]\n"); fclose($fdbidx);}
					$fdbsrc = @fopen($dbxir.".src","x+");	if($fdbsrc) {fwrite($fdbsrc,"[STRUCTURE]\n"); fclose($fdbsrc);}
					$dbtipi = "MIXD";
					} else {trigger_error("not permited to make mixed databases",E_USER_WARNING); return false;}
						break;
			}
			// .dbi
			if( !db_type() ){
				$fdbinx = @fopen(_FFDBDIR_."Databases.dbi","x+");
					if($fdbinx) {fwrite($fdbinx,"[DATABASE LIST]\n"); fclose($fdbinx);}
				$fdbiop = fopen(_FFDBDIR_."Databases.dbi","a+");
					fwrite($fdbiop,"\n".pure_encode($indb["db"])."[=]".$dbtipi."[+]");
					@fclose($fdbiop);
			}
			return true;
		}
	}
	elseif($mo==null) {
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	}	
	elseif($root && !$root) {
		trigger_error("You have not root accsess",E_USER_WARNING);
		return false;
	}	
	elseif($indb || connected($indb["db"])) {
		trigger_error("first make database and connect to it",E_USER_WARNING);
		return false;
	}
	else return false;
}

?>