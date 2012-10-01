<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	     ::: Delete Table :::
// ____________________________________________
//
// function:
//			delete_table(tablename); returns boolean
// first connect to database
//


function delete_table($in=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $in!=null ) {
		//check table existant 
		if( !table_exists($in) ) {
			trigger_error("no such table",E_USER_NOTICE);
			return false;
		}
		else{
			$delilax = table_exists($in);
			$deltac = _FFDBDIR_.$indb["db"]."/".$delilax.".tbl";
			if( @unlink($deltac) ){
				tik_counter("-"); // remove from count
				
				$dictago = _FFDBDIR_.$indb["db"]."/";
				$Numb = (int)str_replace(pure_encode($indb["db"])."_","",$delilax);
				$Filos = array_diff(scandir($dictago),array(".","..",$indb["db"].".idx",$indb["db"].".ctr",$indb["db"].".src"));
				
				$delicr = _FFDBDIR_.$indb["db"]."/".$indb["db"].".src";
				$fdelicr = fopen($delicr,"r+");
				$delibocra = fread($fdelicr,filesize($delicr));	

				set_file_buffer($fdelicr,0);

					for($kid=$Numb;$kid<=count($Filos);$kid++){
						if(file_exists(_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".$kid.".tbl")){
								rename(
									_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".$kid.".tbl"
									,_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".($kid-1).".tbl");
								$delibocra = str_replace($indb["db"]."_".$kid,$indb["db"]."_".($kid-1),$delibocra);
								}
						if(file_exists(_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".$kid.".3fe"))
								rename(
									_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".$kid.".3fe"
									,_FFDBDIR_.$indb["db"]."/".$indb["db"]."_".($kid-1).".3fe");
					}
					
					ftruncate($fdelicr,0); rewind($fdelicr);
					fwrite($fdelicr,$delibocra);
					fclose($fdelicr);					
				
				// remove from .src
				$todelco = "\n[tbl]".pure_encode($in)."[+tbl][loc]".pure_encode($delilax)."[+loc][=]";
				$dotstruc = _FFDBDIR_.$indb["db"]."/".$indb["db"].".src";
				$delfro = @fopen($dotstruc,"r+");
				if($delfro){
				set_file_buffer($delfro,0); clearstatcache();
				$delfari = fread($delfro,filesize($dotstruc));
				$posone = strpos($delfari,$todelco);
				if($posone){
				$postwo = strpos($delfari,"[+]",$posone);
				$todelwr = substr_replace($delfari,"",$posone,$postwo-$posone+3);
				for($kid=$Numb;$kid<=count($Filos);$kid++){
					$todelwr = str_replace($indb["db"]."_".$kid,$indb["db"]."_".($kid-1),$todelwr);
				}
				ftruncate($delfro,0); rewind($delfro);
				fwrite($delfro,$todelwr); }
				fclose($delfro);
				} else { trigger_error("Unable to open structure handler as stream",E_USER_WARNING); return false;}
				return true;
			}
			else{
				trigger_error("Unable to delete table physical file",E_USER_WARNING);
				return false;
			}
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