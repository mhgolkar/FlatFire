<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: Control panel Export XML JOB:::
*/
session_start();
require_once($_SESSION["DIR"]."Config.php");
require_once($_SESSION["DIR"]."FlatFire.php");
if(isset($_SESSION["ROOT"]) && isset($_SESSION["PASS"]))
	root($_SESSION["ROOT"],$_SESSION["PASS"]);
if($root && @_FF_PLUG_CORE_XMLx_===true){
	if(isset($_POST["ff_x_port_db"]) && isset($_POST["ff_x_port_it"]) ){
		$dblistast = real_db_list();
		if(in_array($_POST["ff_x_port_db"],$dblistast)) cheatcon($_POST["ff_x_port_db"]);
		@XmlXport($_POST["ff_x_port_it"]);
	}
} else echo "<span>XmlXport Function is diactive...</span>";
?>