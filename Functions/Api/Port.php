<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: API PORT :::
// ____________________________________________
// validate is a request from a paired client or not
//


// for some controls
define("_FFPOT_LOADED_",true); // dont change this

function api_port_auth($RADDR=null,$PAIRKY=null){
global $indb;
	$PIKS = parse_ini_file("Paired_clients.ini",true);
	if($RADDR!==null && $PAIRKY!==null){
		foreach($PIKS as $PRK){ 
			if ($PRK["RADDR"]===$RADDR && $PRK["PAIRKY"]===$PAIRKY){
				$opear = fopen(_FFDBDIR_."Security.sec","r");	clearstatcache();
				$redar = fread($opear,filesize(_FFDBDIR_."Security.sec"));
				rewind($opear); 
				while(!feof($opear)){
				$linia = fgets($opear);
				$midpo = strpos($linia,"[DBA]".$PRK["DBA"]."[pass]");
				if($midpo) {
				$uspalang = substr($linia,(strpos($linia,"\n[user]")?strpos($linia,"\n[user]")+6:6),strpos($linia,"[hash]")-6);
				$passpalang = substr($linia,strpos($linia,"[pass]")+6,(strpos($linia,"[+]")-strpos($linia,"[pass]")-6));
				}
				}
				//return true on paired and connected
				if(Connect($PRK["DBA"],$uspalang,$passpalang))return true; else return false;
			}
		}
		return false;
	} else return false;
}


function api_port_acable($re=null){
	if($re!==null){
	$acci = parse_ini_file("Acceptables.ini",false);
	foreach ($acci as $ac) { if( strpos($re,$ac."(")===0 && strrpos($re,")")===strlen($re)-1 ) return true;}
	}
return false;
}
?>