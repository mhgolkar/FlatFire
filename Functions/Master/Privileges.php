<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
// to check user existance and it's database access
// functions: 
//			first connect to root() then :
//				user_exists(username); true on success;
//				db_access(username,database); chack access to a database for a spesific user
//

function user_exists($us=null){
global $root;
	if($us!=null && _FF_Root_acs_ && $root){
		$dotsec = _FFDBDIR_."Security.sec";
		$sec = fopen($dotsec,"r");
		clearstatcache();
		$rsec = fread($sec,filesize($dotsec));
		$uspatic = "[user]".pure_encode($us)."[hash]";
		if( strpos($rsec,$uspatic) ) return true; else return false;
		}
	elseif($us==null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
}


function db_access($us=null,$db=null){
global $root;
	if($us!=null && $db!=null && _FF_Root_acs_ && $root){
		if( user_exists($us) ){
			$dotsec = _FFDBDIR_."Security.sec";
			$sec = fopen($dotsec,"r");
			clearstatcache();
			$rsec = fread($sec,filesize($dotsec));
			$uspatic = "[user]".pure_encode($us)."[hash]";
			$basa = explode("[+]",$rsec);
			foreach($basa as $kala){
				$relpstr = strpos($kala,$uspatic);
				if($relpstr){
				$dabaposl = strpos($kala,"[DBA]",$relpstr);
				$passposl = strpos($kala,"[pass]",$relpstr);
				if( substr($kala,$dabaposl+5,$passposl-$dabaposl-5)===pure_encode($db) ) return true;
				}
			}
			return false;
		}
		else return false;
	}
	elseif($us==null || $db==null){
		trigger_error("bad function invoking: required input is null",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
}
?>