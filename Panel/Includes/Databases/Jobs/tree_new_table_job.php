<?php/*		  _______________//		 | 				 |//		 |	M.H.GOLKAR	 |//		 |	 FlatFire	 |//		 |	01.00[2012]	 |//		 |_______________|//::: Control panel Add New Free Job :::*/// New Free// fanction to replace html special charsinclude_once(_FFDIR_."Panel/Functions/hsc.php");if(count($_POST)>0){	if(		isset($_POST["edit_db_dbname"]) && $_POST["edit_db_dbname"]!=null && $_POST["edit_db_dbname"]!="null" 		&& in_array($_POST["edit_db_dbname"],$dblist)		&& isset($_POST["tree_table_id"]) && $_POST["tree_table_id"]!=null		&& isset($_POST["new_table_data"]) && $_POST["new_table_data"]!=null		){				//EXTRACT				$columnsa = explode("|",$_POST["new_table_data"]);				cheatcon($_POST["edit_db_dbname"]); // Connect				if(table_exists($_POST["tree_table_id"])){					if($_POST["tree_existing_row"]=="null")						$frsuccess = @insert_row($_POST["tree_table_id"],$columnsa);					elseif(is_numeric($_POST["tree_existing_row"]))						$parsa = @parse_src($_POST["tree_table_id"]);						$datastus = @array_combine($parsa,array_pad($columnsa,count($parsa),""));						$frsuccess = @insert_data($_POST["tree_table_id"],$_POST["tree_existing_row"],$datastus);					if($frsuccess!==false) $raportaj = "Done... <a href=\"".$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]."\">Click here to refresh data</a>";					else{					$erica = error_get_last();					if($erica!=null) $raportaj = $erica["message"];					else $raportaj = "Internal Error... job failed";					}				}				else $raportaj = "Error... This table is alrady exists";	}	elseif(isset($_POST["TABL"])) $raportaj = "Error! Null Input...";}$dblist = real_db_list();?><!-- PRIVILEGE --><div id="ff_tree_table_Db"><h1>Insert Data</h1><form action="<?php echo $_SERVER["PHP_SELF"] ?>?p=databases&l=Editor&ed=Jobs" method="POST"><span>Database:</span><br/>	<?php	if(isset($_GET["d"]) && $_GET["d"]!==null && in_array($_GET["d"],$dblist)) {		$firstdb = $_GET["d"];		echo "<input style=\"display:none\" name=\"edit_db_dbname\" value=\"".$firstdb."\"><b>".hsc($firstdb)."</b>";	}	else echo "<span>Select a table to edit</span>";		?><br/><input style="display:none;" name="TABL"/><span>Table: </span><br/>	<?php	if(isset($_GET["s"]) && $_GET["s"]!==null && $_GET["s"]!=null) {		$firstbl = $_GET["s"];		echo "<input style=\"display:none\" name=\"tree_table_id\" value=\"".$firstbl."\"><b>".hsc($firstbl)."</b>";	}	else echo "<span>Select a table to edit</span>";		?><br/><span>Row Data:</span><br/><span class="req">* seprate columns with pipe |</span><br/><input type="textarea" placeholder="Data01|Data02" name="new_table_data" /><br/><span>Insert in Row :</span><select name="tree_existing_row"><option value="null">Add New</option><?php cheatcon($_GET["d"]);for($co=0;$co<=get_row_count($_GET["s"]);$co++){ echo"<option value=".$co." >Row ".hsc($co)."</option>"; }?></select><br/><input type="submit" class="creatbot" value="Row"/></form><br/><br/></div>