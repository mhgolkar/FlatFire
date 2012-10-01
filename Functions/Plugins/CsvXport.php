<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 CVSXPORT	 |
//		 |_______________|  */
// ::: CVS Export Plugin 4 FFDB :::
// plug-in-name::CsvXport[+]
// plug-in-des::Export Connected Database as CVS file[+]
// plug-in-ver::01.00[+]
// plug-in-fil::CsvXport.php[+]
//

define("_FF_PLUG_CORE_CSVx_",true);
function CsvXport($it=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $it!==null) {
		// HEADERS
		header("Content-Type: text/csv; charset=utf-8");
		header("Content-Disposition: attachment; filename=FF_".$it."_".mt_rand(100,999).".csv");
		// CSV
		$output = fopen("php://output", "w");
		// get row headings (structure) or fields
		if(@free_existance($it)){
			$freeall = @get_free($it);
			if($freeall){
			$headins = array_keys($freeall);
			$valuesa = array_values($freeall);
			}
		}
		elseif(@table_exists($it)){
			$headins = parse_src($it);
			$valuero = get_row_count($it)+1;
		}
		// output the headings
		@fputcsv($output,$headins);
		// outputting values
		if(@$valuesa){
		fputcsv($output,$valuesa);
		return true;
		}
		if(@$valuero){
			for($coj=0;$coj<=$valuero-1;$coj++){
				@fputcsv($output,get_row($it,$coj));
			}
			return true;
		}
	return false;
	}
	else return false;
}

?>