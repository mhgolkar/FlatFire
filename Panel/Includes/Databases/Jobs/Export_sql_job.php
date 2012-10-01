<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//::: Control panel Export SQL JOB:::
*/
@require_once("../../../../Config.php"); // Configurations [RIQUIERD]
@require_once("../../../../FlatFire.php");
session_start();
if(isset($_SESSION["ROOT"]) && isset($_SESSION["PASS"]))
	root($_SESSION["ROOT"],$_SESSION["PASS"]);
if($root && @_FF_PLUG_CORE_SQLx_===true){
	if(isset($_POST["ff_x_port_db"]) && isset($_POST["ff_x_port_it"]) ){
		$dblistast = real_db_list();
		if(in_array($_POST["ff_x_port_db"],$dblistast)) cheatcon($_POST["ff_x_port_db"]);
		@SqlXport($_POST["ff_x_port_it"]);
	}
} else echo "<span>SqlXport Function is diactive...</span>";
?>