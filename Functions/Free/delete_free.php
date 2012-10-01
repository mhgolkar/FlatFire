<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: delete a free_element physicaly:::
// function: delete_free(id); returns "true" on success, "null" if element dose not exists, "false" and error on fai...
// input: id (name of element)
// function will remove an existing element completely from database;
// but first connect to database using connect(database,user,pass)
// ____________________________________________
//

function delete_free($in=null){
global $indb;
	if($indb && connected($indb["db"]) && $in!=null){
		$delilax = free_existance($in);
		if($delilax){
			$delila = _FFDBDIR_.$indb["db"]."/".$delilax.".3fe";
			$delibo = _FFDBDIR_.$indb["db"]."/".$indb["db"].".idx";
			if ( is_writeable($delibo) ){		
				clearstatcache();
				if( unlink($delila) ){
					$dictago = _FFDBDIR_.$indb["db"]."/";
					$Numb = (int)str_replace(pure_encode($indb["db"])."_","",$delilax);
					$Filos = array_diff(scandir($dictago),array(".","..",$indb["db"].".idx",$indb["db"].".ctr",$indb["db"].".src"));
					
					$fdelibo = fopen($delibo,"r+");
					$delibostr = fread($fdelibo,filesize($delibo));
					$delipat = "\n".pure_encode($in)."[=]".pure_encode($delilax)."[+]";
					$toindeli = substr_replace($delibostr,"",strpos($delibostr,$delipat),strlen($delipat));
					
					$delicr = _FFDBDIR_.$indb["db"]."/".$indb["db"].".src";
					$fdelicr = fopen($delicr,"r+");
					$delibocra = fread($fdelicr,filesize($delicr));
					
					set_file_buffer($fdelibo,0);
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
								$toindeli = str_replace($indb["db"]."_".$kid,$indb["db"]."_".($kid-1),$toindeli);
					}
					
					ftruncate($fdelicr,0); rewind($fdelicr);
					fwrite($fdelicr,$delibocra);
					fclose($fdelicr);

					ftruncate($fdelibo,0); rewind($fdelibo);
					fwrite($fdelibo,$toindeli);
					fclose($fdelibo);
				} 
				else {
					trigger_error("unable to delet physical file of element",E_USER_WARNING);
					return false;
				}
				tik_counter("-");
				return true;
				}
			else {
				trigger_error("Unable to write in database index, job failed",E_USER_WARNING);
				return false;
			}
		}
		else {
		return null;
		}
	}
	elseif($in==null) {
		trigger_error("Bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else return false;
}
?>