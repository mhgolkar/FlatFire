<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: remove data from free_element :::
// function: remove_from_free(id,field,delete-empty); returns true on success or false and error on...
// function will remove a field and related value from selected free element;
// input: id (name of element) and field both required, delete-empty is boolean and optional (default: true)
// field can be an array filled with field names
// on delete-empty true : function will delete free element phisicaly if element is empty;
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

function remove_from_free($el=null,$fi=null,$emt=true){
global $indb;
	if($indb && connected($indb["db"]) && $el!=null && $fi!=null ){
		$rimelax = free_existance($el);
		if($rimelax){
			$rimel = _FFDBDIR_.$indb["db"]."/".$rimelax.".3fe";
			$rimboX = func_get_args();
			array_shift($rimboX);
			$lastrimboX = $rimboX[count($rimboX)-1];
			if( $lastrimboX===true || $lastrimboX===false ) array_pop($rimboX) ;
			$rimbo = array();
			foreach($rimboX as $Oo){
				if( !@current($Oo) ) array_push($rimbo,$Oo);
				else foreach($Oo as $Gogo) array_push($rimbo,$Gogo);
			}
			foreach($rimbo as $rix){
				$rimbo = get_free($el,$rix);
				clearstatcache();
				if( $rimbo && count($rimbo)>1 ){
					$rimpat1 = pure_encode($rix)."[=]".pure_encode($rimbo[$rix])."[+]";
					$rimpat2 = pure_encode($rix)."[=]".pure_encode($rimbo[$rix])."[|]";
					$frimel = fopen($rimel,"r+");
					$rimelstr = fread($frimel,filesize($rimel));
					$rimpat = (strpos($rimelstr,$rimpat1)?$rimpat1:$rimpat2);
					$torimel = substr_replace($rimelstr,"",strpos($rimelstr,$rimpat),strlen($rimpat));
					ftruncate($frimel,0); rewind($frimel);
					fwrite($frimel,$torimel);
					fclose($frimel);
				}
			}
			// DELETE EMPTY
			if( $emt ) {
				clearstatcache();
				$frimel = fopen($rimel,"r");
				$rimelstr = fread($frimel,filesize($rimel));
				fclose($frimel);
				if( $rimelstr == "[id]".pure_encode($el)."[+id][+]" ) {
					if( delete_free($el) ) return true;
					else trigger_error("Field removed but element is empty and physicaly exists",E_USER_NOTICE);
					}
				}
			return true;
		}
		else {trigger_error("No such element!",E_USER_WARNING); return false;}
	}
	elseif($el==null) {
		trigger_error("Bad function invoking: element is null",E_USER_WARNING);
		return false;
	}
	elseif($fi==null) {
		trigger_error("Bad function invoking: field is null",E_USER_WARNING);
		return false;
	}
	else return false;
}
?>