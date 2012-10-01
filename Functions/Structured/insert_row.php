<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: Insert Row :::
// ____________________________________________
//
// function:
//			insert_row(table,input); returns row id number on success
// input:
//			table is table name and required
//			1- an array ( keys are column name and values are values!)
//			2- multiple arguments
// in array input if all keys are not meaningfull, script will use values with meaningfull keys and leave others empty and if there is not any meaningfull key will insert values in sort of array and to the maximum capacity


function insert_row($tb=null){
global $indb;
if(@table_exists($tb)===false) {trigger_error("Table dose not exist",E_USER_WARNING); return false;}
	//
	if ( $indb && connected($indb["db"]) && $tb!==null) {
	// define new raw from input according to src
	$strata = parse_src($tb);
	$strakey = array_flip($strata);
	$argus = func_get_args();
	array_shift($argus);
	if(count($argus)>0 && @current($argus[0])) {
		$wagner = array_intersect_key($argus[0],$strakey);
		if(count($wagner)===0) $wagner = array_slice($argus[0],0,count($strakey),true);
		elseif(count($wagner)!==0 && count($wagner)<count($strata)) {
			$nululu = array_fill(0,count($strakey),"null");
			$emerson = array_combine($strata,$nululu);
			reset($wagner);
			for($iv=0;$iv<count($wagner);$iv++){
				if( array_key_exists(key($wagner),$emerson) ) $emerson[key($wagner)] = current($wagner);
			next($wagner);
			}
			$wagner = $emerson;
		}
		else $wagner = array_slice($wagner,0,count($strakey),true);
		$angery = array_pad($wagner,count($strata),"null");;
	}
	elseif(count($argus)>0 && !@current($argus[0])) {
		$wagner = array_slice($argus,0,count($strakey),false);
		if(count($wagner)< count($strata)) $wagner = array_pad($wagner,count($strata),"null");
		$angery = array_combine($strata,$wagner);
	}
	else return false;
	// insert in database
	$angery = array_pad($angery,count($strata),"null");// last calibration
	$gorila = array_map("pure_encode",$angery);
	$tondar = implode("[|]",$gorila);
	$tablert = _FFDBDIR_.$indb["db"]."/".table_exists($tb).".tbl";
	$foterm = fopen($tablert,"a+");
	set_file_buffer($foterm,0);
	$counta = get_row_count($tb);
	$counti = ($counta===null?0:$counta+1);
	$thisrow = "\nrow_".$counti."[=]".$tondar."[+]";
	if($foterm){ fwrite($foterm,$thisrow);
	fclose($foterm);
	return $counti;
	} else return false;
	}
	elseif($tb===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}
}

?>