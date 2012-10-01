<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 SQLXPORT	 |
//		 |_______________|  */
// ::: SQL Export Plugin 4 FFDB :::
// plug-in-name::SqlXport[+]
// plug-in-des::Exports a database to sql file[+]
// plug-in-ver::01.00[+]
// plug-in-fil::SqlXport.php[+]
//

define("_FF_PLUG_CORE_SQLx_",true);
function SqlXport($it=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $it!==null) {
		// HEADERS
		header("Content-Type: text/sql; charset=utf-8");
		header("Content-Disposition: attachment; filename=FF_".$it."_".mt_rand(100,999).".sql");
		// READ SQL SAMPLE
		$Samie = _FFDIR_."Functions/Plugins/Extras/SqlSample.sql";
		$innput = fopen($Samie, "r+");
		$samy = fread($innput,filesize($Samie));
		// SQL
		$output = fopen("php://output", "w");
		// get row headings (structure) or fields
		if(@free_existance($it)){
			$idmode = "_Id_";
			$freeall = @get_free($it);
			if($freeall){
			$headins = array_keys($freeall);
			$valuesa = array_values($freeall);
			$Countess = count($freeall) +1 ;
			}
		}
		elseif(@table_exists($it)){
			$idmode = "_Row_";
			$headins = parse_src($it);
			$valuero = get_row_count($it)+1;
			$Countess = $valuero;
		}
		// Collation
		if(isset($_POST["ff_x_port_colat"]) && $_POST["ff_x_port_colat"]!=null && $_POST["ff_x_port_colat"]!="null")
			$colligari =$_POST["ff_x_port_colat"]; else $colligari="utf8_bin";
		// START OUTPUT
		$tosam = str_replace("[+][_Databasename_][+]",pure_decode($indb["db"]),$samy); // Database name
		$tosam = str_replace("[+][_AUTO_INCRE_C+_][+]",$Countess,$tosam); // Auto incr...
		// Generating Columns
		if(@$valuero || @$valuesa){
				$maradonna = "";
			foreach ($headins as $figu){
				$maradonna .="  `".$figu."` text COLLATE [+][_COLLATION_][+] NOT NULL,\n";	
		}
		$tosam = str_replace("[+][_COLUMNS_HERE][+]",$maradonna,$tosam); // COLUMNS
		// INSERT
			// FREE
		if(@$valuesa){
		$Donasimentu = "INSERT INTO `[+][_tablename_][+]` (`[+][_ID_COLUMN_][+]`";
		$Donasimenta = "(0";
			for($loka=0;$loka<count($headins);$loka++){
				$vandal = $valuesa[$loka];
				if ($vandal==="") $vandal="null";
				$Donasimentu .= ", `".$headins[$loka]."`";
				$Donasimenta .= ", "."'".$vandal."'";
			}
		$Donasimentu .= ") VALUES".$Donasimenta.");\n\n";
		}
			// TABLE
		if(@$valuero){
		$Donasimentu = "INSERT INTO `[+][_tablename_][+]` (`[+][_ID_COLUMN_][+]`";
		for($loka=0;$loka<=($Countess-1);$loka++){
			if($loka===0) $vinci = "("; else $vinci = ", (";
			$rowisla = get_row($it,$loka);
			$ladisla = "".$loka;
			foreach($rowisla as $ladis){
			$ladisla .= ", '".$ladis."'";
			}
			$Donasimenta .= $vinci.$ladisla.") ";
			}
		foreach($headins as $hidi){$Donasimentu .= ", `".$hidi."`";}
		$Donasimentu .= ") VALUES".$Donasimenta.";\n\n";
		}
		// Last Currection
		$tosam = str_replace("[+][_DATA_HERE][+]",$Donasimentu,$tosam); // Data
		$tosam = str_replace("[+][_ID_COLUMN_][+]",$idmode,$tosam); // ID (ROWs)
		$tosam = str_replace("[+][_COLLATION_][+]",$colligari,$tosam); // collation
		$tosam = str_replace("[+][_tablename_][+]",$it,$tosam); // New Table name
		// WRITE TO FILE
		fwrite($output,$tosam);
		return true;
	}
	else return false;
}
}
?>