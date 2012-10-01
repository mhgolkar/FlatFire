<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: Delete Row :::
// ____________________________________________
//
// function:
//			delete_row(table,row); returns true on success, null and error if there is not such row or false on failure
//			

function delete_row($tb=null,$row=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $tb!==null && $row!==null) {
		$table = table_exists($tb);
		if($table){
			// find row
			$rowtodel = get_row($tb,$row);
			$rowderac = get_row_count($tb);
			if($rowtodel){
				$dtabl = _FFDBDIR_.$indb["db"]."/".$table.".tbl";
				$otabl = fopen($dtabl,"r+");
				if($otabl){
					clearstatcache(); set_file_buffer($otabl,0);
					$rtabl = fread($otabl,filesize($dtabl));
					// delete row get row id
					$todella = "\nrow_".$row."[=]".implode("[|]",$rowtodel)."[+]";
					$totab = substr_replace($rtabl,"",strpos($rtabl,$todella),strlen($todella));
					// change row counts
					for($iki=$row;$iki<=$rowderac;$iki++){
						$totab = str_replace("row_".$iki."[=]","row_".($iki-1)."[=]",$totab,$recount);
					}
					$totab = str_replace("\r\n","\n",$totab);
					//write
					ftruncate($otabl,0); rewind($otabl); fwrite($otabl,$totab); fclose($otabl);
					// return
					return true;
				}
			}
			else{
				trigger_error("No such row",E_USER_WARNING);
				return null;
			}
		}
		else{
			trigger_error("Table dose not exists",E_USER_WARNING);
			return false;
		}
	}
	elseif($tb===null || $row===null){
		trigger_error("bad function invoking: input is null",E_USER_WARNING);
		return false;
	}
	else{
		trigger_error("first connect to database",E_USER_WARNING);
		return false;
	}
}

?>