<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: Database List:::
// functions:
//			real_db_list(); returns an array of physical existing databases;
//			privilege_list(passwords); returns all privilege information about database including passwords if input is "true";
//			db_tree(); returns a tree of all databases;
// but first access root
// ____________________________________________
//

function privilege_list($in=null){
global $root;
	if(_FF_Root_acs_ && $root){
		$db_list=array();
		clearstatcache();
		$dbli=_FFDBDIR_."Databases.dbi"; $odbli = fopen($dbli,"r"); $dblistr=fread($odbli,filesize($dbli)); fclose($odbli);
		$scor=_FFDBDIR_."Security.sec"; $oscor = fopen($scor,"r"); $scorstr=fread($oscor,filesize($scor)); fclose($oscor);
		$seclarg = explode("[+]",$scorstr);
		foreach($seclarg as $uniter){
			if(strlen($uniter)>3){
				$usea=substr($uniter,strpos($uniter,"[user]")+6,strpos($uniter,"[hash]")-strpos($uniter,"[user]")-6);
				$dbaa=substr($uniter,strpos($uniter,"[DBA]")+5,strpos($uniter,"[pass]")-strpos($uniter,"[DBA]")-5);
				$pasa=substr($uniter,strpos($uniter,"[pass]")+6,strlen($uniter)-strpos($uniter,"[pass]")-6);
				$hash=substr($uniter,strpos($uniter,"[hash]")+6,strpos($uniter,"[dba]")-strpos($uniter,"[hash]")-6);
				array_push($db_list,array("user"=>$usea,"dba"=>$dbaa,"pass"=>($in===true?$pasa:$hash)));
			}
		}
		$result = array();
		foreach($db_list as $shekar){
			$starta = strpos($dblistr,$shekar["dba"])+strlen($shekar["dba"])+3;
			$lenta = strpos($dblistr,"[+]",$starta)-$starta;
			array_push($result,array("user"=>$shekar["user"],"dba"=>$shekar["dba"],"pass"=>$shekar["pass"],"type"=>substr($dblistr,$starta,$lenta)));	
		}
		return array_map("pure_decode",$result);
	}
	else{
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
}

function real_db_list(){
global $root;
	if(_FF_Root_acs_ && $root){
		$dir= _FFDBDIR_;
		$lista = scandir($dir);
		$resturant = array_diff($lista,array(".","..","Databases.dbi","Root.rut","Security.sec"));
		return array_values($resturant);
	}
	else{
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
}

// DATABASE TREE
function db_tree(){
global $root;
	if(_FF_Root_acs_ && $root){
		$Start = real_db_list();
		$mentor = array(); foreach($Start as $inj){
			if(!in_array($inj,$mentor)) array_push($mentor,$inj);
		}
		$result = array("list"=>array(),"db"=>array());
		foreach($mentor as $ment){array_push($result["list"],$ment);}
		foreach($mentor as $ment){$result["db"][$ment]["free"]=(list_free($ment)?list_free($ment):null);}
		foreach($mentor as $ment){$result["db"][$ment]["tables"]=(list_tables($ment)?list_tables($ment):null);}
		return $result;
	}
	else{
		trigger_error("You need root access",E_USER_WARNING);
		return false;
	}
}
?>