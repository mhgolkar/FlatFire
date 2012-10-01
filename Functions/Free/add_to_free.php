<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: add data to a free_element :::
// functions:
//			 add_to_free(element-id,field,value,replace) returns true on success
//			 array_to_free(element-id,array-of-data,replace) returns true on success
// inputs: array-of-data(fieald=>value); you can also use array, to call add_to_free(element-id,array,replace)
// NOTE : if replace is true (default) function will replace new value to existing field
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

// ADD_TO_FREE
function add_to_free($el=null,$fi=null,$va=null,$repr=true){
global $indb;
	if( $indb && connected($indb["db"]) && $el!=null && $fi!="id" ){
		$eleman = free_existance($el);
		//Calling array_to free
		$aro = func_get_args();
		if( @$eleman && count($aro)==3 && @current($aro[1]) ) return array_to_free($el,$aro[1],$repr);
		//
		$elembox = _FFDBDIR_.$indb["db"]."/".$eleman.".3fe";
		$toelembox = null;
		// DEFINE NEW VALUE
			$safeva = ($va!=null ? $va : "");
			if($fi!=null) $toelembox = pure_encode($fi)."[=]".pure_encode($safeva)."[+]";
			else {
				trigger_error("Bad function invoking: field is null",E_USER_WARNING);
				return false;
				}
		if($eleman){
			// write data in element
				clearstatcache();
				if( is_writable($elembox) &&  $toelembox!=null){
				$oElembox = fopen($elembox,"r+");
				set_file_buffer($oElembox,0);
				$oElemboss = fread($oElembox,filesize($elembox));
				$repilox = strpos($oElemboss,pure_encode($fi));
					if($repilox==false){
						$boxCalib = substr_replace($oElemboss,"",-3,3)."[|]".$toelembox;
						ftruncate($oElembox,0); rewind($oElembox);
						fwrite($oElembox,$boxCalib);
						fclose($oElembox);
						return true;
					} 
					else {
						if( $repr===true && $fi!="id" ){
							$hornpos1 = strpos($oElemboss,"[|]",$repilox);
							$hornpos2 = strpos($oElemboss,"[+]",$repilox);
							$hornpos = (max($hornpos1,$hornpos2)==strlen($oElemboss)-3?max($hornpos1,$hornpos2):min($hornpos1,$hornpos2))-$repilox+3 ;
							$hornCalib = substr_replace($oElemboss,"",$repilox,$hornpos);
							$boxCalib = substr_replace($hornCalib,"",-3,3)."[|]".$toelembox;
							ftruncate($oElembox,0); rewind($oElembox);
							fwrite($oElembox,$boxCalib);
							fclose($oElembox);
							return true;
						}
					}
				}
				elseif(!is_writable($elembox)){
					trigger_error("Unable to write in element!",E_USER_ERROR);
					return false;
				}
		}
		else {
		trigger_error("Element is not exists",E_USER_WARNING);
		return false;
		}
	} elseif( $el == null ) {
	trigger_error("Bad function invoking: element id is null",E_USER_WARNING);
	return false;
	}
}
// ARRAY_TO_FREE
function array_to_free($el=null,$aro=null,$repric=true){
global $indb;
	if( $indb && connected($indb["db"]) && $el!=null ){
		if(free_existance($el) && $aro != null && count($aro)>0){
			reset($aro);
			for($iz=0; $iz<count($aro); $iz++){
				add_to_free($el,key($aro),current($aro),$repric);
				next($aro);
			}
			return true;
		}
		elseif( $aro == null || count($aro)<1 ) {
			trigger_error("Bad function invoking: function needs a real array of data for 2nd argument",E_USER_WARNING);
			return false;
		}
		else{
			trigger_error("Bad function invoking: element dose not exists",E_USER_WARNING);
			return false;
		}
	}
	elseif( $el == null ) {
		trigger_error("Bad function invoking: element id is null",E_USER_WARNING);
		return false;
	}
}
?>