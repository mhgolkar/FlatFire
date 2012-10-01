<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: FLAT FIRE DATABASE SETING:::
*/
?>
<h1></h1>
<?php
// Page Loader
if(isset($_GET["l"])){
	switch($_GET["l"]){
		case "Root":
			include_once("Includes/Settings/Root.php");
				break;
		case "Config":
			include_once("Includes/Settings/Config.php");
				break;
		default:
			unset($_GET["l"]);
				break;
	}			
}
// Settings Content
if(!isset($_GET["l"])){
include_once(_FFDIR_."Panel/Includes/Settings/Toolbar.php");
echo "<span>Please Sellect ...</span>";
}
?>