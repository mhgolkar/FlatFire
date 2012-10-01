<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 RANDOMGET	 |
//		 |_______________|  */
// ::: Random data Plugin 4 FFDB :::
// plug-in-name::RandomGet[+]
// plug-in-des::returns a random data from database both from tables and free elements[+]
// plug-in-ver::01.00[+]
// plug-in-fil::RandomGet.php[+]
//

// function: RandomGet(HowMany,from?); 
// 			input: from:
//						|> null: iregular! from all elements in database free and table;
//						|> free: some fileds ("id"=>id,field=>value) from all fields in free element;
//						|> table: some (structured) rows from all rows in table;

function RandomGet($count=1,$it=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $count!==null) {
		// get row headings (structure) or fields
		if($it===null){
			if(db_type()!="s"){
				$result = array();
				$listusy = @array_flip(list_free($indb["db"]));
				$count = (int)(min($count,count($listusy))===$count?$count:count($listusy));
				$listac = array_rand($listusy,$count);
				if(@current($listac)) {
					foreach($listac as $randy){
						array_push($result,get_free($randy));
					}
				}
				elseif($listac) $result=get_free($listac);
				else return false;
			}
			if(db_type()!="f"){
				$result = array();
				$listusy = @array_flip(list_tables($indb["db"]));
				$count = (int)(min($count,count($listusy))===$count?$count:count($listusy));
				$listac = array_rand($listusy,$count);
				if(@current($listac)) {
					foreach($listac as $randy){
						array_push($result,get_row($randy,(int)mt_rand(0,get_row_count($randy))));
					}
				}
				elseif($listac) $result=get_row($listac,(int)mt_rand(0,get_row_count($listac)));
				else return false;
			}
			if($result) return $result; else return false;
		}
		else{
			if(@free_existance($it)){
					$result = array();
					$listusy = get_free($it);
					$keysart = array_keys($listusy);
					$count = (int)(min($count,count($keysart))===$count?$count:count($keysart));
					if($keysart) {
						for($lop=0;$lop<$count;$lop++){
							$rankey = $keysart[(int)mt_rand(0,count($keysart)-1)];
							array_push($result,@get_free($it,$rankey));
						}
					}
					else return false;
				}
			elseif(@table_exists($it)){
				$result = array();
				$keysart = get_row_count($it);
				$count = (int)(min($count,$keysart)===$count?$count:$keysart);
				if($keysart!==false) {
					for($lop=0;$lop<=$count;$lop++){
						$rankey = (int)mt_rand(0,$count);
						array_push($result,@get_row($it,$rankey));
					}
				}
				else return false;
			}
		if($result) return $result; else return false;
		}
	}
}

/*
// Example //
@require_once("../../Config.php"); // Configurations [RIQUIERD]
@require_once("../../FlatFire.php");
session_start();
if(isset($_SESSION["ROOT"]) && isset($_SESSION["PASS"]))
	root($_SESSION["ROOT"],$_SESSION["PASS"]);
cheatcon("Structured_one");
print_r(RandomGet(3,"RPS"));
*/


?>