<?php/*		  _______________//		 | 				 |//		 |	M.H.GOLKAR	 |//		 |	 FlatFire	 |//		 |	01.00[2012]	 |//		 |_______________|//::: Control panel Add New Free Job :::*/// New Free// fanction to replace html special charsinclude_once(_FFDIR_."Panel/Functions/hsc.php");if(count($_POST)>0){	if(		isset($_POST["edit_db_dbname"]) && $_POST["edit_db_dbname"]!=null && $_POST["edit_db_dbname"]!="null" 		&& in_array($_POST["edit_db_dbname"],$dblist)		&& isset($_POST["new_table_id"]) && $_POST["new_table_id"]!=null		&& isset($_POST["new_table_cols"]) && $_POST["new_table_cols"]!=null		){				//EXTRACT				$columnsa = explode("|",$_POST["new_table_cols"]);				cheatcon($_POST["edit_db_dbname"]); // Connect				if(!table_exists($_POST["new_table_id"])){					$frsuccess = @new_table($_POST["new_table_id"],$columnsa);					if($frsuccess!==false) $raportaj = "Done... New table crated Successfuly";					else{					$erica = error_get_last();					if($erica!=null) $raportaj = $erica["message"];					else $raportaj = "Internal Error... job failed";					}				}				else $raportaj = "Error... This table is alrady exists";	}	elseif(isset($_POST["TFG"])) $raportaj = "Error! Null Input...";}$dblist = real_db_list();?><!-- PRIVILEGE --><div id="ff_new_table_Db"><h1>Add New Table</h1><span class="req">* all fields required</span><br/><form action="<?php echo $_SERVER["PHP_SELF"] ?>?p=databases&l=Editor&ed=Jobs" method="POST"><input style="display:none;" name="TFG"/><b>Table name</b><br/><span>should be unique in database: </span><br/><input type="textarea" name="new_table_id" /><br/><b>Database</b><br/><select name="edit_db_dbname">	<?php	if(isset($_GET["d"]) && $_GET["d"]!==null && in_array($_GET["d"],$dblist)) {		$firstdb = $_GET["d"];		echo "<option value=\"".$firstdb."\">".hsc($firstdb)."</option>";	}	else {		$firstdb=null;		echo "<option value=\"null\">Select from database list</option>";		}	foreach($dblist as $ik){		if($ik!==$firstdb && $ik!==@$_POST["destroy_db_dbname"]) echo "<option value=\"".$ik."\">".hsc($ik)."</option>";	}	?></select><br/><b>Columns</b><br/><span class="req">* seprate with pipe |</span><br/><input type="textarea" placeholder="Column01|Column02" name="new_table_cols" /><br/><input type="submit" class="creatbot" value="Table"/></form><br/><br/></div>