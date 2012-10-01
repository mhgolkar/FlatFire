<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: PAIR/UNPAIR CLIENT :::
// ____________________________________________
// to pair or to unpair this is the [...] question
// Functions:
//			pair_client(id,remote-addr,database-to-access);
//							|> returns array("id"=>id,"key"=>pair-key) on success or id if already paierd or false and error on...
//							|> note: use unique id, if you dont, script will generate a unique random id
//			unpair_client(id); returns true on success or false and error on...
//			list_paired(); returns list of paired clients (array); if input is an id returns only that client information if exists
// id (exact) length is _FF_MAXID_ (default: 10)
// but first connect root


// id length
define("_FF_MAXID_",10);

// LIST PAIERD
function list_paired($in=null){
	$itsini = _FFDIR_."Functions/Api/Paired_clients.ini";
	$parsed = parse_ini_file($itsini,true);
	reset($parsed);
	for($ix=0;$ix<count($parsed);$ix++){
		$parsed[key($parsed)]["id"]= key($parsed);
		next($parsed);
	}
	if($in!==null && @array_key_exists($in,$parsed)) return $parsed[$in]; elseif($in!==null) return false;
	return $parsed;
}
// PAIR
function pair_client($dom=null,$ip=null,$dba=null){
global $root;
if(!_FF_Root_acs_ || !$root){ trigger_error("unable access to root",E_USER_WARNING); return false;}
if($dom==null || $ip==null || $dba==null) {	trigger_error("Bad function invoking: null input",E_USER_WARNING); return false;}
clearstatcache();
if(!file_exists(_FFDBDIR_."/".$dba)){ trigger_error("No such database",E_USER_WARNING); return false;}
	$itsini = _FFDIR_."Functions/Api/Paired_clients.ini";
	$pairedis = list_paired();
	if($pairedis){
		foreach($pairedis as $lego){
			if($lego["RADDR"]===$ip && $lego["DBA"]===$dba) {
				trigger_error("already paired",E_USER_NOTICE);
				return $lego["id"];
			}
		}
		end($pairedis); $endish = $pairedis[key($pairedis)];
		reset($pairedis);
		$idii = str_pad(substr($dom,0,_FF_MAXID_),_FF_MAXID_,substr(SHA1(mt_rand()),0,3),STR_PAD_BOTH);
		while($pairedis[key($pairedis)]!==$endish){
			if(key($pairedis)===$idii) {
				$idii = substr($idii,0,7).substr(SHA1(mt_rand()),0,3);
				reset($pairedis);
			}
			next($pairedis);
		}
		// OK.. id is unique.. make pairkey and write this
		$paiallicon = str_shuffle(SHA1(mt_rand().$idii));
		$towrite = "\n[".$idii."]\nRADDR=".$ip."\nPAIRKY=".$paiallicon."\nDBA=".$dba."\n";
		$now = @fopen($itsini,"a+"); 
		if($now){
		set_file_buffer($now,0); 
		fwrite ($now,$towrite);
		fclose($now);
		return array("id"=>$idii,"key"=>$paiallicon);
		}
		else{
		trigger_error("Unable to write in parse paired clients file",E_USER_WARNING);
		return false;
		}
	}
	else{
		trigger_error("Unable to parse paired clients",E_USER_WARNING);
		return false;
	}
}


// UNPAIR 
function unpair_client($id=null){
global $root;
	if(!_FF_Root_acs_ || !$root){ trigger_error("unable access to root",E_USER_WARNING);	return false;}
	if($id===null) { trigger_error("Bad function invoking: null input",E_USER_WARNING);	return false;}
	$todel = @list_paired($id);
	if($todel){
		$itsini = _FFDIR_."Functions/Api/Paired_clients.ini";
		$delica = fopen($itsini,"r+");
		if($delica){
		clearstatcache(); set_file_buffer($delica,0);
		$delisr = fread($delica,filesize($itsini));
		$psone= strpos($delisr,$id)-1;
		if($psone<0 || !$psone) $psone = 0;
		$pstwo= strpos($delisr,"[",($psone+1))-$psone;
		if($pstwo<0 || !$pstwo) $pstwo = strlen($delisr);
		$towrit = substr_replace($delisr,"",$psone,$pstwo);
		$towrit = str_replace("\n\n","\n",$towrit);
		$towrit = str_replace("\r\n","\n",$towrit);
		ftruncate($delica,0); rewind($delica);
		fwrite($delica,$towrit);
		fclose($delica);
		return true;
		}
		else{
			trigger_error("un able to write in paired clients file",E_USER_WARNING);
			return false;
		}
	}
	else{
		trigger_error("No such id!",E_USER_WARNING);
		return false;
	}
}

?>