<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: Control panel Remove PRIVILEGE Job:::
*/

// fanction to replace html special chars
include_once(_FFDIR_."Panel/Functions/hsc.php");

if(count($_POST)>0){
	if(
		isset($_POST["ff_remove_priv_in"]) && $_POST["ff_remove_priv_in"]!=null && $_POST["ff_remove_priv_in"]!="null"
		){
			$inprivrem = explode("[|]",$_POST["ff_remove_priv_in"]);
			if(db_access($inprivrem[0],$inprivrem[1])) {
				if(@root_priv_killer($inprivrem[0],$inprivrem[1])) {
					//header("Location: ".$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]);
					$raportaj = "Privilege Destroyed...";
				}
				else{
					$erica = error_get_last();
					if($erica!=null) $raportaj = $erica["message"];
					else $raportaj = "Internal Error... job failed";
					}
			}
			else $raportaj = "Error! Wrong Input...";
	}
	elseif(isset($_POST["RP1"])) $raportaj = "Error! Null Input...";
}

// get Privileges
$alllist = privilege_list(false);
?>
<div id="ff_remove_priv">
<input style="display:none;" name="RP1"/>
<table class="privplus" border="1">
	<caption>Your Privileges</caption>
	<tr class="trpink">
		<th> </th>
		<th> User </th>
		<th> Database </th>
		<th> Type </th>
	</tr>
<?php
foreach($alllist as $inj){
	if($inj["user"]!=="ity "){
	echo"<tr>
			<td><input type=\"radio\" value=\"".$inj["user"]."[|]".$inj["dba"]."\" name=\"ff_remove_priv_in\"/></td>
			<td>".hsc($inj["user"])."</td>
			<td>".hsc($inj["dba"])."</td>
			<td>".hsc($inj["type"])."</td>
		</tr>";
		}
		else echo "<tr><td>NO</td><td>PRIVILEGE</td></tr>";
}
?>
</table>
<input type="submit" class="privplus" value="Remove"/>
</div>