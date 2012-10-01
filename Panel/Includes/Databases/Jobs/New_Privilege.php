<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: Control panel NEW PRIVILEGE Job:::
*/

// fanction to replace html special chars
include_once(_FFDIR_."Panel/Functions/hsc.php");

// Create Privilege
if(count($_POST)>0){
	if(
		isset($_POST["new_priv_dbname"]) && $_POST["new_priv_dbname"]!=null && $_POST["new_priv_dbname"]!="null"
		&& isset($_POST["new_priv_pass"]) && $_POST["new_priv_pass"]!=null
		){
		if( isset($_POST["new_priv_privilege"]) &&  $_POST["new_priv_privilege"]!="null"){
			$sandra = @root_hire($_POST["new_priv_dbname"],$_POST["new_priv_privilege"],$_POST["new_priv_pass"]);
				if($sandra!==false)
					$raportaj = "Done... Privilege created for \"".hsc($_POST["new_priv_privilege"])."\" Successfuly";
				else{
					$erica = error_get_last();
					if($erica!=null) $raportaj = $erica["message"];
					else $raportaj = "Internal Error... job failed";
					}
			}
		elseif( isset($_POST["new_priv_user"]) ){
			$sandra = @root_hire($_POST["new_priv_dbname"],$_POST["new_priv_user"],$_POST["new_priv_pass"]);
				if($sandra!==false)
					$raportaj = "Done... Privilege created for \"".hsc($_POST["new_priv_user"])."\" Successfuly";
				else{
					$erica = error_get_last();
					if($erica!=null) $raportaj = $erica["message"];
					else $raportaj = "Internal Error... job failed";
					}
		}
		else $raportaj = "Error! Wrong Input...";
	}
	elseif(isset($_POST["TK"])) $raportaj = "Error! Null Input...";
}

$dblist = real_db_list();

/*
in outer layer its need to be in a form tag like this:
<!-- JOBS -->
<form action="<?php echo $_SERVER["PHP_SELF"] ?>?p=databases&l=Privilege" method="POST">
<?php include_once("Panel/Includes/Databases/Jobs/New_Privilege.php");?>
</form>
*/

?>
<!-- PRIVILEGE -->
<div id="ff_new_priv">
<h1>NEW PRIVILEGE</h1>
<input style="display:none;" name="TK"/>
<span class="req">*all fields required</span><br/>
<b>Database</b><br/>
<select name="new_priv_dbname">
	<option value="null">Select from database list</option>
	<?php foreach($dblist as $ik){echo "<option value=\"".$ik."\">".hsc($ik)."</option>";}?>
</select><br/>
<b>User</b><br/>
<select name="new_priv_privilege">
	<option value="null">Select from user list</option>
	<?php foreach($userli as $ik){echo "<option value=\"".$ik."\">".hsc($ik)."</option>";}?>
</select>
<span> or new user : </span><br/>
<span> username: </span><input type="textarea" name="new_priv_user" /><br/>
<span> password: </span><span class="req">*required (even for existing user)</span><br/><input type="password" name="new_priv_pass" /><br/>
<input type="submit" class="creatbot" value="Create"/>
<br/><br/>
</div>