<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//			   root
// functions: 
//			root(username,password); set root access... will set global root to true and returns true on success;
//			always first connect to root() then :
//				|-- root_fire(database-name,mode(f/s/m:default)); make new database
//				|-- root_hire(database-name,username,password); sets up a new privilege or replace password if already exists
//				|-- root_killer(database-name or username); destroy a database or privilege
//


$root = null;
require_once("./Config.php");
require_once("Master/Setup_db.php");
require_once("Master/db_type.php");
require_once("Master/Privileges.php");
require_once("Master/HashPa.php");
require_once("Master/Pure_fire.php");

// ROOT
function root($us=null,$pa=null){
global $root;
	if(_FF_Root_acs_){
		clearstatcache();
		$rut = _FFDBDIR_."Root.rut";
		$ruti = fopen($rut,"r") or die("unable to access root info");
		$rutistr = fread($ruti,filesize($rut));
		$rutpati = pure_encode($us)."[=]".pure_encode($pa);
		fclose($ruti);
		if ($rutistr === $rutpati){ 
			$root = true;
			return true;
		}
	}
	else{
		trigger_error("Root access denied",E_USER_WARNING);
		$root = false;
		return false;
	}
}


// FIRE
function root_fire($db=null,$mo="m"){
global $root;
	if(_FF_Root_acs_ && $root && $db!=null){
		// make database folder
		clearstatcache();
		$dbxdir = _FFDBDIR_.pure_encode($db);
		if( file_exists($dbxdir) && db_type()!=false ) {
			trigger_error("This database already exists",E_USER_WARNING);
			return false;
		}
		else{
			//make directory
			if( !file_exists($dbxdir) ) mkdir($dbxdir,0750) or die("unable to make folders in database directory");
			// setup database
			global $indb;	$indb["db"] = pure_encode($db);
			if($mo!="m" && $mo!="f" && $mo!="s") setup_db("m"); else setup_db($mo);
			return true;
		}
	}
}


// HIRE
function root_hire($db=null,$us=null,$pa=null){
global $root;
	if(_FF_Root_acs_ && $root && $db!=null && $us!=null && $pa!=null ){
	// read .sec
		$dotsec = _FFDBDIR_."Security.sec";
		$sec = fopen($dotsec,"r+") or die("unable to access security handler");
		$filpatri= "\n[user]".pure_encode($us)."[hash]".FF_hash($pa)."[DBA]".pure_encode($db)."[pass]".pure_encode($pa)."[+]";
	// changes
		if( db_access($us,$db) ){
			clearstatcache();
			$rsec = fread($sec,filesize($dotsec));
			$uspatic = "\n[user]".pure_encode($us)."[hash]";
			$relpose =  strpos($rsec,$uspatic);
			$plusposl = strpos($rsec,"[+]",$relpose);
			$tofiller = substr_replace($rsec,"",$relpose,$plusposl-$relpose+3);
			set_file_buffer($sec,0);
			ftruncate($sec,0);
			rewind($sec);
			fwrite($sec,$tofiller);
			fwrite($sec,$filpatri);
			if($sec) fclose($sec);
			return true;
		}
		else {
		file_put_contents($dotsec,$filpatri,FILE_APPEND) or die("unable to put contents in security handler");
		return true;
		}
	} 
	elseif( !_FF_Root_acs_ || !$root){
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("bad function invoking: your input is null",E_USER_WARNING);
		return false;
	}
}


// KILLER
//(database-name or username); destroy a database or privilege
function root_killer($in){
global $root;
	if(_FF_Root_acs_ && $root && $in!=null){
		$dotsec = _FFDBDIR_."Security.sec";
		$inp = pure_encode($in);
		$whereis = _FFDBDIR_.$inp;
		if( !user_exists($in) ){
			clearstatcache();
			$dotkil = _FFDBDIR_.$inp;
			//unlink?
			if( is_dir($whereis) ){
				if( !@unlink($whereis) ){
					$diresc = scandir($whereis);
					foreach ($diresc as $todel){
						$delpath = $whereis."/".$todel;
						if($todel!="." && $todel!=".." && file_exists($delpath)) unlink($delpath);
					}
				rmdir($whereis);
				}
			}
			//Remove from .dbi
			$fdbiop = fopen(_FFDBDIR_."Databases.dbi","r+");
			$fdbiopstr = fread($fdbiop,filesize(_FFDBDIR_."Databases.dbi"));
			$fdbioplay0 = strpos($fdbiopstr,"\n".$inp."[=]");
			if($fdbioplay0){
			$fdbioplay1 = strpos($fdbiopstr,"[+]",$fdbioplay0);
			$tofdbiop = substr_replace($fdbiopstr,"",$fdbioplay0,$fdbioplay1-$fdbioplay0+3);
			$tofdbiop = str_replace("\n\n","\n",$tofdbiop);
			$tofdbiop = str_replace("\r\n","\n",$tofdbiop);
			ftruncate($fdbiop,0); rewind($fdbiop);
			fwrite($fdbiop,$tofdbiop);
			fclose($fdbiop);
			}
			// remove from .sec
			clearstatcache();
			$sec = fopen($dotsec,"r+");
			set_file_buffer($sec,0);
			$rsec = str_replace("[Security list]\n","",fread($sec,filesize($dotsec)));
			$largo = explode("[+]",$rsec);
			foreach($largo as $digi){
				if(strpos($digi,"[DBA]".$inp."[pass]")) $rsec = str_replace($digi,"",$rsec);
			}
			ftruncate($sec,0); rewind($sec);
			if(fwrite($sec,"[Security list]\n".$rsec)){
				fclose($sec);
				return true;
			}
			else return false;
		}
		elseif(user_exists($in)){
		// delete user
			clearstatcache();
			$sec = fopen($dotsec,"r+");
			set_file_buffer($sec,0);
			$rsec = fread($sec,filesize($dotsec));
			$uspatic = "\n[user]".$inp."[hash]";
			$relpose =  strpos($rsec,$uspatic);
			if($relpose){
			$pluspos = strpos($rsec,"[+]",$relpose)+3;
			$filler = substr_replace($rsec,"",$relpose,$pluspos-$relpose);
			ftruncate($sec,0);
			rewind($sec);
			fwrite($sec,$filler);
			if($sec) fclose($sec);
			return true;
			}
			return false;
		}
	}
	elseif( !_FF_Root_acs_ || !$root){
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("bad function invoking: your input is null",E_USER_WARNING);
		return false;
	}
}




// Privilege KILLER
// destroy a privilege
function root_priv_killer($us=null,$db=null){
global $root;
	if(_FF_Root_acs_ && $root && $us!=null && $db!=null){
		$dotsec = _FFDBDIR_."Security.sec";
		if(user_exists($us)){
			$sec = fopen($dotsec,"r+");
			clearstatcache();
			$rsec = fread($sec,filesize($dotsec));
			set_file_buffer($sec,0);
			$allsec = explode("[+]",$rsec);
			foreach($allsec as $getas){
				$usepo = strpos($getas,"[user]".pure_encode($us)."[hash]");
				$dabpo = strpos($getas,"[DBA]".pure_encode($db)."[pass]");
				if($usepo && $dabpo) $rsec =  str_replace($getas."[+]","",$rsec);
			}
			$rsec =  str_replace("\n\n","\n",$rsec);
			$esli = (substr($rsec,0,strlen("[Security list]\n"))==="[Security list]\n"?"":"[Security list]\n");
			ftruncate($sec,0);
			rewind($sec);
			fwrite($sec,$esli.$rsec);
			if($sec) fclose($sec);
			return true;
		}
		else return false;
	}
	elseif( !_FF_Root_acs_ || !$root){
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("bad function invoking: your input is null",E_USER_WARNING);
		return false;
	}
}

// Cheat Connect
function cheatcon ($db=null){
global $root;
global $indb;
	if ($root && $db!==null){
		$indb["db"] = $db;
		if(@db_type()!==false){
			$pal = _FFDBDIR_."Security.sec";
			$opear = fopen($pal,"r");	clearstatcache();
			$redar = fread($opear,filesize($pal));
			rewind($opear); 
			while(!feof($opear)){
				$linia = fgets($opear);
				$midpo = strpos($linia,"[DBA]".pure_encode($db)."[pass]");
				if($midpo) {
					$uspalang = substr($linia,(strpos($linia,"\n[user]")?strpos($linia,"\n[user]")+6:6),strpos($linia,"[hash]")-6);
					$passpalang = substr($linia,strpos($linia,"[pass]")+6,(strpos($linia,"[+]")-strpos($linia,"[pass]")-6));
				}
			}
			//return true on paired and connected
			if(Connect($db,$uspalang,$passpalang)) return true; else return false;
			} else return false;
		}
		else return false;
}
?>