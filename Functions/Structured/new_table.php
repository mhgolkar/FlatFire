<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	     ::: New Table :::
// makes new table with specific structure
// ____________________________________________
//
// function:
//			new_table(table-name,structure); makes src file and set an structure for database ; returns true on success or false if database exists
// input: 
//			table-name: unique name of new table
//			structure:
//			1- an array of columns (values as columns)
//			2- multiple arguments
// first connect to database
//


function new_table($in=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $in!=null ) {
		//check table existant 
		if( table_exists($in) ) {
			trigger_error("table already exists",E_USER_NOTICE);
			return false;
		}
		else{
			if(db_type()=="f") mix_it(); //if database is free and mixd database is enable : mix it
			$countac = get_counter() + 1 ; // database elements count
			$newtbl = _FFDBDIR_.$indb["db"]."/".$indb["db"]."_".$countac.".tbl";
			$onew = @fopen($newtbl,"x+");// make and open files
			if($onew){
			tik_counter("+"); // add count
			fwrite($onew,"[Table]");
			fclose($onew);
			} else return false;
			// inport to src
			$tosrc1 = "\n[tbl]".pure_encode($in)."[+tbl][loc]".$indb["db"]."_".$countac."[+loc][=]";
			$aralia = func_get_args();
			if(count($aralia)>1) $aramis = $aralia[1];
			$tosrc2 = "";
			if( count($aralia)>1 && @count($aramis)>0 && @current($aramis) ){
				for($ie=0;$ie<count($aramis);$ie++){
					$tosrc2 .= $aramis[$ie].($ie!=count($aramis)-1?"[|]":"");
				}
			}
			else{
				for($ie=1;$ie<count($aralia);$ie++){
					$tosrc2 .= $aralia[$ie].($ie!=count($aralia)-1?"[|]":"");
				}
			}			
			$tosrc = $tosrc1.$tosrc2."[+]";
			$fosrc = @fopen(_FFDBDIR_.$indb["db"]."/".$indb["db"].".src","a+");
			set_file_buffer($fosrc,0);
			if($fosrc){
			fwrite($fosrc,$tosrc);
			if($fosrc) fclose($fosrc);
			} else return false;
			return true;
		}
	}
	elseif($in==null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
		}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
		}	
}
?>