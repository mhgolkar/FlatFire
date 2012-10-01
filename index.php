<?php

if (!@$_SESSION) session_start();
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//    ::: FLAT FIRE INDEX :::	
//
require_once("Config.php");
if(!file_exists(_FFDBDIR_."Root.rut")) header("Location: install.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="FFStyle.css"/>
</head>
<body>	<?php
	if (isset($_SESSION["ROOT"])){
	echo"
<p class=\"alerta\">You are loged in<br/>you can access to control panel<a href=\"panel.php\"> this way...</a> or <a href=\"panel.php?p=logout\">logout</a></p>
<div id=\"cpright\">
	<span class=\"lif\">Open Source and Free for Ever </span> <br/>
	<span class=\"fut\">Flat Fire Database</span> <br/>
	<span class=\"lif\">[2012]</span><br/>
</div>
";
	}
	if(!isset($_SESSION["ROOT"]) && _FF_CP_){
		echo"
<div id=\"Login\">
	<form action=\"panel.php\" method=\"POST\">
		<b>Flat Fire</b><br/><br/>
		<span class=\"lif\">Control Panel</span><br/>
		<span>Username</span><br/>
		<input class=\"intix\" type=\"text\" name=\"user\"/><br/>
		<span>password</span><br/>
		<input class=\"intix\" type=\"password\" name=\"pass\"/><br/>
		<input class=\"inbot\" type=\"submit\" value=\"GO!\" name=\"submit\"/>
	</form>	
	<div id=\"cpright\">
		<span class=\"lif\">Open Source and Free for Ever </span> <br/>
		<span class=\"fut\">Flat Fire Database</span> <br/>
		<span class=\"lif\">Ver 01.00 [2012]</span> <br/>
	</div>
</div>
";
	}
	elseif(!isset($_SESSION["ROOT"]) && !_FF_CP_) {
		header("HTTP/1.1 503 Service Unavailable"); 
		die("
<p class=\"alerti\">Control Panel is inaccessible<br/>to access this service edit configuration file</p>
<div id=\"cpright\">
	<span class=\"lif\">Open Source and Free for Ever </span> <br/>
	<span class=\"fut\">Flat Fire Database</span> <br/>
	<span class=\"lif\">Ver 01.00 [2012]</span><br/>
</div>
</body>
</html>
"
	);
	}
?>
</body>
</html>