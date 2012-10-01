<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: Connection :::
/* connecting to database you wana use (for both free and structured)
 functions :
		connect(database,user,pass); returns $indb and boolean;
		connected(database); check $indb and returns boolean
 input: user and pass is requierd if password protection is activated
// ____________________________________________ */ //

// array to storing connected database
$indb = array(
			"db"=>null,
			"user"=>null,
			"pass"=>null,
			"hash"=>null
			);

// function to Check if we have both username and password (if password protection is activated)
function havpass($us=null,$pa=null){
	if ($us!=null && $pa!=null) return true;
	elseif (!_FF_Secure_) return true;
	else return false;
}
// connecting to database
function connect($db=null,$us=null,$pa=null){
global $indb;
clearstatcache();
$dbdir = _FFDBDIR_.pure_encode($indb["db"]);
	if( is_dir($dbdir) ){
		if ($db != null){
			if ( havpass($us,$pa) ) {
				// ::: CONNECT :::
				require_once("HashPa.php");
				$hashedpa = FF_hash($pa);
				// // get privileges
				$dotsec = _FFDBDIR_."Security.sec";
				$sec = fopen($dotsec,"r");
				clearstatcache();
				$rsec = fread($sec,filesize($dotsec));
				$pati = "[user]".pure_encode($us)."[hash]".pure_encode($hashedpa)."[DBA]".pure_encode($db)."[pass]";
				$lati = strpos($rsec,$pati);	
				// // check
				if($lati!=false){
					$indb["db"] = pure_encode($db);
					$indb["user"] = $us;
					$indb["pass"] = $pa;
					$indb["hash"] = $hashedpa;
					return true;
				} else {trigger_error("Invalid Priviladge",E_USER_WARNING); return false;}
				// :: FIN CONNECT ::
			}
			else trigger_error("Unable to Connect without username and password",E_USER_ERROR);
		}
		else trigger_error("You wanna Connect to null!",E_USER_WARNING);
	}
	else {
	trigger_error("Database dose not exists, first setup database",E_USER_ERROR);
	return false;
	}
}

// connected or not?
function connected($in=null){
	global $indb;
	if ( $indb["db"] == pure_encode($in)
		&& connect($indb["db"],$indb["user"],$indb["pass"])
		)
		return true;
	else {
	trigger_error("Your not connected to database",E_USER_WARNING);
	return false;
	}
}

// disconnecting
function disconnect(){
	global $indb; 
	$indb = array("db"=>null,"user"=>null,"pass"=>null,"hash"=>null);
	return true;
}

?>