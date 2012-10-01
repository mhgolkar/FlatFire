<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//  ::: Insert Data in column :::
// ____________________________________________
//
// function:
//			insert_data(table,row,input); returns true on success
// input: 
//			table is table name and required
//			row is row id and required
//			1- an array ( keys are column id and values are values)
//			2- two arguments (column id, value)
//

function insert_data($tb=null,$row=null,$in=null,$tex=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null && $row!=null && $in!=null) {
		//find that row
		$table = table_exists($tb); 
		if(!$table){
			trigger_error("No such table",E_USER_WARNING); 
			return false;
		}
		else{
		$tabgi = _FFDBDIR_.$indb["db"]."/".$table.".tbl";
		$tisis = get_row($tb,$row);
		$rowis = "\nrow_".$row."[=]".implode("[|]",$tisis)."[+]";
		//get input
		if( !@current($in) && $tex!==null ) $wagner= array($in=>$tex);
		elseif( !@current($in) && $tex===null ) $wagner= array($in=>"null");
		elseif( @current($in) ) $wagner = $in;
		else { trigger_error("bad data to insert",E_USER_WARNING); return false;}
		//define new row to replace
		$thatis = $tisis;	reset($wagner);
		for($ia=0;$ia<count($thatis);$ia++){
		if( array_key_exists(key($wagner),$thatis) ) $thatis[key($wagner)] = pure_encode(current($wagner));
		next($wagner);
		}
		$newrow = "\nrow_".$row."[=]".implode("[|]",$thatis)."[+]";;//
		// go ahead
		$ropen = fopen($tabgi,"r+"); 
		set_file_buffer($ropen,0); clearstatcache();
		$readr = fread($ropen,filesize($tabgi));
		$rowstart = strpos($readr,$rowis);
		if($rowstart){
		//rewrite that row
		$reprow = substr_replace($readr,$newrow,$rowstart,strlen($rowis));
		ftruncate($ropen,0); rewind($ropen);
		fwrite($ropen,$reprow);
		fclose($ropen);
		return true;
		}
		}
	}
	elseif($tb==null || $in==null || $row==null){
		trigger_error("bad function invoking: null input",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}
}

?>