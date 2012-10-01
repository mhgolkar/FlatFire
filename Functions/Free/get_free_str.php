<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: free_element parser :::
// function: get_free_str(id,...fields...); returns an string or false if id is invalid
// inputs: id (name of element) for all values stored in this element or id and optionaly field or fieldss or id and single array of fields!
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

function get_free_str($in = null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $in!=null ) {
		// get where is the element
		$findex = free_existance($in);
		// get element
		if($findex){
		$elmira = array("id"=>$in);
		$elis = _FFDBDIR_.$indb["db"]."/".$findex.".3fe";
		$elisto = fopen($elis,"r");
		clearstatcache();
		$elisro = fread($elisto,filesize($elis));
		$elispat = "[id]".pure_encode($in)."[+id][+]";
		$elisCat = stristr($elisro,$elispat);
		$elisStart = substr($elisCat,strlen($elispat),strrpos($elisCat,"[+]")-strlen($elispat));
		// parse element
		$valtics = explode("[|]",$elisStart);
			foreach($valtics as $enti){
				$vKey = substr($enti,0,strpos($enti,"[=]"));
				$vVal = substr($enti,strpos($enti,"[=]")+3,strlen($enti));
				$elmira[pure_decode($vKey)] = pure_decode($vVal);
			}
		// calibrate!
				$elisg = func_get_args();
			if( count($elisg)>1 ){
				$elisg[0] = "id"; // first is id self but should be "id"!
				if( count($elisg[1])>1 && @current($elisg[1]) ) {
					foreach( $elisg[1] as $elisar){
						array_push($elisg,$elisar);
					}
					$elisg[1]="";
				}
				elseif ( @current($elisg[1]) && !@current($elisg[1][0]) ){
					$elisg = func_get_args(); $elisg[0] = "id"; $elisg[1]=$elisg[1][0];
				}
				$elisXg = array_flip($elisg);
				$elisWonder = array_intersect_key($elmira,$elisXg);
				$elisWonderStr = null; reset($elisWonder);
				for($i=0;$i<count($elisWonder);$i++){
				$elisWonderStr .= key($elisWonder)."=".current($elisWonder).($i+1<count($elisWonder)?"&":"");
				next($elisWonder);
				}
				return $elisWonderStr;
			}
			else {
				$elmiraWonderStr = null; reset($elmira);
				for($i=0;$i<count($elmira);$i++){
				$elmiraWonderStr .= key($elmira)."=".current($elmira).($i+1<count($elmira)?"&":"");
				next($elmira);
				}
				return $elmiraWonderStr;
			}
		} else return false;		
	}
	elseif ($in == null) {
		trigger_error("Wrong function invoking! input is null",E_USER_WARNING);
		return false; 
		}
}
?>