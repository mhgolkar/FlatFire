<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: FLAT FIRE CONTROL PANEL :::
*/

// SESSION
session_start();
// LOGIN AS ROOT
require_once("Config.php");
require_once("Panel/Functions/Gate.php");
require_once("Functions/Root.php");
if(isset($_POST["user"]) && isset($_POST["pass"])) gate($_POST["user"],$_POST["pass"]);
if(!isset($_SESSION["ROOT"])){
	header("HTTP/1.1 403 Forbidden");
	die("	<!DOCTYPE html>
			</head><link rel=\"stylesheet\" type=\"text/css\" href=\"FFStyle.css\"/></head>
			<body><p class=\"alerti\">Access denide<br/><a href=\"index.php\">you can return to index this way...</a></p></body>
			");
}
root($_SESSION["ROOT"],$_SESSION["PASS"]);
$_SESSION["DIR"] = _FFDIR_;
require_once("FlatFire.php");
// Control PANEL HERE ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="FFStyle.css"/>
<link rel="stylesheet" type="text/css" href="Panel/Includes/CpStyle.css"/>
<script type="text/javascript" src="Panel/Includes/SelRel.js"></script>
<script type="text/javascript" src="Panel/Includes/tr3e.js"></script>
</head>
<body>
<?php
if(!isset($_GET["p"]) || $_GET["p"]!=="logout") echo"
<ol class=\"top-menu\">
<li><a href=\"".$_SERVER["PHP_SELF"]."\"> Wellcome ".$_SESSION["ROOT"]."</a></li>
<li><a href=\"".$_SERVER["PHP_SELF"]."?p=databases\">Dashboard</a></li>
<li><a href=\"".$_SERVER["PHP_SELF"]."?p=settings\">Settings</a></li>
<li><a href=\"".$_SERVER["PHP_SELF"]."?p=documents\">Documents</a></li>
<li><a href=\"".$_SERVER["PHP_SELF"]."?p=logout\">Logout</a></li>
</ol>
<br/>
";
// Page Loader
if(isset($_GET["p"])){
	switch($_GET["p"]){
		case "databases":
			include_once("Panel/databases.php");
				break;
		case "settings":
			include_once("Panel/settings.php");
				break;
		case "documents":
			include_once("Documents/documents.php");
				break;
		case "logout":
			session_destroy();
			die("
			<!DOCTYPE html>
			</head><link rel=\"stylesheet\" type=\"text/css\" href=\"FFStyle.css\"/></head>
			<body><p class=\"alerta\"><p class=\"alerta\">Thanks for using Flat Fire you can <a href=\"index.php\">return to index this way...</a></p></body>
			");
				break;
		default:
			unset($_GET["p"]);
				break;
	}			
}
if(!isset($_GET["p"])) include_once("Panel/home.php");
?>
<br/>
</body>
</html>