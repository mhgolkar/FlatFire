<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: CONTROL PANEL Dashboard:::
*/
// Page Loader
if(isset($_GET["l"])){
	switch($_GET["l"]){
		case "Explore":
			include_once("Includes/Databases/Explorer.php");
				break;
		case "Explorer":
			include_once("Includes/Databases/Explorer.php");
				break;
		case "New":
			include_once("Includes/Databases/New_DB.php");
				break;
		case "Edit":
			include_once("Includes/Databases/Edit_DB.php");
				break;
		case "Editor":
			include_once("Includes/Databases/Edit_DB.php");
				break;
		case "Privilege":
			include_once("Includes/Databases/Privilege.php");
				break;
		case "Api Clients":
			include_once("Includes/Databases/Api_Clients.php");
				break;
		case "Export":
			include_once("Includes/Databases/Export.php");
				break;
				case "Plugins":
			include_once("Includes/Databases/Plugins.php");
				break;
		default:
			unset($_GET["l"]);
				break;
	}
}
if(!isset($_GET["l"])){
root($_SESSION["ROOT"],$_SESSION["PASS"]);
include_once("Includes/Databases/Explorer.php");
}
?>
