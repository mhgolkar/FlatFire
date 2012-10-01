<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: Control panel NEW DATABASE Job:::
*/

// fanction to replace html special chars
include_once(_FFDIR_."Panel/Functions/hsc.php");

// Create Database
if(count($_POST)>0){
	if(
		isset($_POST["new_db_dbname"]) && $_POST["new_db_dbname"]!=null
		&& isset($_POST["new_db_dbtype"]) && $_POST["new_db_dbtype"]!=null
		&& isset($_POST["new_db_pass"]) && $_POST["new_db_pass"]!=null
		){
		if( isset($_POST["new_db_privilege"]) && $_POST["new_db_privilege"]!="null" && in_array($_POST["new_db_privilege"],$userli) ){
			if(
			@root_fire($_POST["new_db_dbname"],$_POST["new_db_dbtype"],$_POST["new_db_privilege"])
			&& @root_hire($_POST["new_db_dbname"],$_POST["new_db_privilege"],$_POST["new_db_pass"])
				)
				$raportaj = "Done... Database created as \"".hsc($_POST["new_db_dbname"])."\" Successfuly...";
				else $raportaj = "Internal Error...";
		}
		elseif( isset($_POST["new_db_user"]) && !in_array($_POST["new_db_user"],$userli)){
			if(
				@root_fire($_POST["new_db_dbname"],$_POST["new_db_dbtype"])
				&& @root_hire($_POST["new_db_dbname"],$_POST["new_db_user"],$_POST["new_db_pass"])
					)
					$raportaj = "Done... Database created as \"".hsc($_POST["new_db_dbname"])."\" Successfuly...";
					else $raportaj = "Internal Error...";
		}
		elseif(in_array($_POST["new_db_user"],$userli)) $raportaj = "Error! Your new user name is existing...";
		else $raportaj = "Error! Wrong Input...";
	}
	else $raportaj = "Error! Null Input...";
}
/*
in outer layer its need to be in a form tag like this:
<!-- JOBS -->
<form action="<?php echo $_SERVER["PHP_SELF"] ?>?p=databases&l=New" method="POST">
<?php include_once("Panel/Includes/Databases/Jobs/New_Database.php");?>
</form>
*/
?>
<!-- NEW DATABASE -->
<div id="ff_new_db">
<h1>NEW DATABASE</h1>
<b>Database Name</b><br/>
<span class="req">*required</span><br/>
<input type="textarea" name="new_db_dbname" /><span class="req"> max 30 chars</span>
<br/> <span>Type: </span>
<select name="new_db_dbtype">
	<option value="m">Mixed [Free and Table]</option>
	<option value="s">Table Structure</option>
	<option value="f">Free Element Storage</option>
</select> 
<br/>
<b>Privilege</b><br/>
<select name="new_db_privilege">
	<option value="null">Select from user list</option>
	<?php foreach($userli as $ik){echo "<option value=\"".$ik."\">".hsc($ik)."</option>";}?>
</select> 
<span> or new user : </span><br/>
<span> username: </span><input type="textarea" name="new_db_user" /><br/>
<span> password: </span><span class="req">*required (even for existing user)</span><br/><input type="password" name="new_db_pass" /><br/>
<input type="submit" class="creatbot" value="Create"/>
</form>
<br/>
</div>