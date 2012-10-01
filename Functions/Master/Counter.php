<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: Counter controller! :::
// functions:
//			get_counter(); returns counter integer for connected database or false and error
//			tik_counter("+/-"); counter plus/minus one; returns true
//			under_maxim(); check if counter is lower than maximum free elements or maximum is unlimited (returns true) or not (returns false);
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

// GET_COUNTER
function get_counter(){
global $indb;
	if ( $indb && connected($indb["db"]) ) {
		// find where is the element
		$ctr = _FFDBDIR_.$indb["db"]."/".$indb["db"].".ctr";
		$octr = fopen($ctr,"r");
		$ctrstr = fread($octr,filesize($ctr));
			if ( is_numeric($ctrstr) && !is_nan($ctrstr) && is_finite($ctrstr) ){
				$ctrnum = (int)$ctrstr;
				return $ctrnum;
			}
			else return false;
		}
}
// UNDER_MAXIMUM
function under_maximum(){
	if ( is_numeric(_FF_E_MAX_)
			&& !is_nan(_FF_E_MAX_)
				&& is_finite(_FF_E_MAX_) )	{
					if ( get_counter() < _FF_E_MAX_ )return true;
					else return false; 
	}
	else return true;
}
// TIK_COUNTER
function tik_counter($in=null){
global $indb;
	if ( $indb && connected($indb["db"]) && $in!=null){
		if ($in == "+" || $in =="-"){
			$cctr = _FFDBDIR_.$indb["db"]."/".$indb["db"].".ctr";
			$occtr = fopen($cctr,"r+");
			clearstatcache();
			$cctrstr = fread($occtr,filesize($cctr));
			if ( is_numeric($cctrstr) && !is_nan($cctrstr) && is_finite($cctrstr) ){
				$cctrnum = (int)$cctrstr;
			} else {trigger_error("Unable to read counter",E_USER_ERROR); return false;}
			switch($in){
				case "+":
					$cctrnum++;
					set_file_buffer($occtr,0);
					ftruncate($occtr,0);
					rewind($occtr);
					fwrite($occtr,$cctrnum);
						break;
				case "-":
					$cctrnum--;
					if ($cctrnum<0) $cctrnum =0;
					set_file_buffer($occtr,0);
					ftruncate($occtr,0);
					rewind($occtr);
					fwrite($occtr,$cctrnum);
						break;
			}
			if($occtr) fclose($occtr);
		}
		else {
			trigger_error("Wrong Ticking Counter!",E_USER_ERROR);
			return false;
			}
	} else return false;
}
?>