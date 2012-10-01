<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//    ::: Plugins [LOADER] :::
// will load active plugins to flat fire also has functions...
// function: 
//			plugins_info(plugin-name); returns array filled with plugins info; input = null means all plugins
//			plugins_switch(plugin-name,boolean); returns true on success;
//							|> 2nd input: true= make it active / false= make it deactive / null= invert it
//			plug_in(filename); plugin installer, returns boolean; input a file name only from plugins directory (no-path: foo.php)
// ____________________________________________
//

//------
// FUNCTIONS
// plugins_info
function plugins_info($in=null){
$initia = _FFDIR_."Functions/Plugins/Plugins.plt";
$plugint = array();
	$oplt = fopen($initia,"r");	clearstatcache();
	if($oplt){
		$rplt = str_replace("[Plugins]","",fread($oplt,filesize($initia)));
		fclose($oplt);
		$first = explode("[+]",$rplt);
		foreach($first as $oc) {
			if(strlen($oc)>3){
				$xlarg = explode("[|]",$oc);
				$keysun = trim(array_shift($xlarg));
				$xlarg["id"] = pure_decode($keysun);
				$xlarg = array_combine(array("act","des","ver","fil","id"),$xlarg);
				$plugint[pure_decode($keysun)] = array_map("FFDB\pure_decode",$xlarg);
			}
		}
		if($in!==null && array_key_exists($in,$plugint)) return $plugint[$in];
		elseif($in!==null) return false;
		else return $plugint;
	}
	else {
		trigger_error("Unable to load plugins info file",E_USER_WARNING);
		return false;
	}
}

// plugins_switch
function plugins_switch($pl=null,$ac=null){
$initia = _FFDIR_."Functions/Plugins/Plugins.plt";
	if($pl!==null){
		$pluginte = plugins_info($pl);
		if($pluginte){
			if($ac===null) $acta = ($pluginte["act"]==="active"?"deactive":"active"); else $acta = ($ac==false?"deactive":"active");
			$opic = @fopen($initia,"r+");
			if($opic){
			clearstatcache(); set_file_buffer($opic,0);
			$rikie = fread($opic,filesize($initia));
			$lastas = pure_encode($pl)."[|]".pure_encode($pluginte["act"]);
			$actass = pure_encode($pl)."[|]".pure_encode($acta);
			$torikie = str_replace($lastas,$actass,$rikie);
			ftruncate($opic,0); rewind($opic);
			fwrite($opic,$torikie);
			fclose($opic);
			return true;
			}
			else{
				trigger_error("Unable to open plugins list",E_USER_WARNING);
				return false;
			}
		}
		else{
			trigger_error("No such plugin",E_USER_WARNING);
			return false;
		}
	}
	elseif($pl===null){
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
}

// plug_in
function plug_in($fn=null){
$initia = _FFDIR_."Functions/Plugins/Plugins.plt";
$ralpath = _FFDIR_."Functions/Plugins/".$fn;
	if(substr($fn,-4)!==".php") {trigger_error("It's not a php file!!",E_USER_WARNING); return false;}
	if($fn!==null && file_exists($ralpath)){
		$pluginal = plugins_info();
		$can = true; foreach($pluginal as $one){if($one["fil"]===$fn) $can = false;}
		if($can){
			// GET INFORMATION FROM NEW PLUGIN'S FILE
			$filus = fopen($ralpath,"r"); clearstatcache(); $rilus= fread($filus,filesize($ralpath));
			$ins=strpos($rilus,"plug-in-name::") ; $inso = substr($rilus,($ins+14),(strpos($rilus,"[+]",$ins)-$ins-14));
			$inz=strpos($rilus,"plug-in-des::") ; $inzo = substr($rilus,($inz+13),(strpos($rilus,"[+]",$inz)-$inz-13));
			$inc=strpos($rilus,"plug-in-ver::") ; $inco = substr($rilus,($inc+13),(strpos($rilus,"[+]",$inc)-$inc-13));
			//$ink=strpos($rilus,"plug-in-fil") ; $inko = substr($rilus,($ink+13),(strpos($riluk,"[+]",$ins)-$ink-13));
			$inko = $fn;
			$infact = "\n".$inso."[|]"."active[|]".$inzo."[|]".$inco."[|]".$inko."[+]";
			// INSTALL
			$opij = @fopen($initia,"a+");
			if($opij){
				clearstatcache(); set_file_buffer($opij,0);
				fwrite($opij,$infact); fclose($opij);
				return true;
			}
			else{
				trigger_error("unable to open plugins list file",E_USER_WARNING);
				return false;
			}
			}
			else{
				trigger_error("This plugin is already installed",E_USER_WARNING);
				return false;
			}
	}
	elseif($fn===null){
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("No such file: adress filename from plugins directory please",E_USER_WARNING);
		return false;
	}
}

//------
// LOADING ACTIVE PLUGINS
$plugins = plugins_info();
if($plugins && @_FF_Plug_in_){
	foreach($plugins as $in){
	if($in["act"] && $in["act"]==="active") include_once("Plugins/".$in["fil"]);
	}
} else trigger_error("Unable to get plugin list",E_USER_WARNING);

?>