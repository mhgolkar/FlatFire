<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: compose new free_element :::
// function: new_free(id,fields-array,forceTo!); returns "id" of new free element or false (and error) if did not connected to database or unable to make element...
// input: id (name of element), optionaly field(s) (an array that keys are fields and values are values!) and true/false to force making this element
// first argument is name and required
// function never replace an existing element but:
// if forceTo! is true script will compose a new element even if that specific id is exists but with a generated new name from your id and a random number then returns that new id... 
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

function new_free($in=null){
global $indb;
	if($indb && connected($indb["db"]) && $in!=null){
	if ( db_type()==="s" ) mix_it();
	// ELEMENT ID?
		// check existans of free element
		if( free_existance($in) === false ){
			$newis = $in;
		}
		else{
		// if exists and forceTo! is true
		$arguos = func_get_args();
		$lastarguos = $arguos[count($arguos)-1];
			if (count($arguos)>1 && $lastarguos === true){
				//new name for 
				do{
				$d3rand = mt_rand(0,_FF_E_MAX_*10);
				$newis = "".$in.$d3rand;
				} while( free_existance($newis) );
			} else return false;
		}
	// chechk maximum free elements in database _FF_E_MAX_ (check is int or not)
		if( under_maximum() ){
		// make file
			$ix=0; 
			do{
			$ix++;
		$newgen = _FFDBDIR_.$indb["db"]."/".$indb["db"]."_".(get_counter()+$ix).".3fe";
			} while( file_exists($newgen) );
			$fnewgen = fopen($newgen,"x");	fclose($fnewgen);
		// register file (to index and counter)
			if ( file_exists($newgen) ){
			$indxgo =  _FFDBDIR_.$indb["db"]."/".$indb["db"].".idx";
			$toindx = "\n".pure_encode($newis)."[=]".pure_encode(basename($newgen,".3fe"))."[+]";
			$ftoindx = fopen($indxgo,"a+");
			fwrite($ftoindx,$toindx); 
			fclose($ftoindx);
			tik_counter("+");
			} else {trigger_error("unable to write in database folder",E_USER_ERROR); return false;}
		// geting data from function
		$toEself = null;
		$arguos = func_get_args();
		array_shift($arguos);
		if(@count($arguos[0])>=1) $toEself = array_shift($arguos);
		// write data in element
			clearstatcache();
			if( is_writable($newgen) &&  $toEself!=null){
				$toEselfstr = "[id]".pure_encode($newis)."[+id][+]";
				reset($toEself);
				for( $iy=0;$iy<count($toEself);$iy++ ){
					$toEselfstr .= pure_encode(key($toEself))."[=]".pure_encode(current($toEself)).($iy<(count($toEself)-1)?"[|]":"[+]");
					next($toEself);
				}
			$oEselfi = fopen($newgen,"r+");
			ftruncate($oEselfi,0);
			set_file_buffer($oEselfi,0);
			rewind($oEselfi);
			fwrite($oEselfi,$toEselfstr);
			fclose($oEselfi);
			return $newis;
			}
			elseif(!is_writable($newgen)){
				trigger_error("Unable to write in element!",E_USER_ERROR);
				return false;
			}
		}
	if( free_existance($newis) ) return true;
	}
	elseif($in==null) {
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	} else return false;
}
?>