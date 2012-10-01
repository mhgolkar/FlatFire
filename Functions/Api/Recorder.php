<?php
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	POST AND GET [REQUESTS] RECORD SCRIPT
//	______________________________________________
//	define Log-container-file and include this script
//	to log all POST and GET Query values...
//	______________________________________________
//	
//

// DEFINE LOG[CONTAINER]
define("Log_Container",_FFDIR_."Functions/Api/_REC.ORD");

// LOGER FUNCTION
function logger($only=null){
	// METHODS TO RECORD
	if ($only === "POST") $met = $_POST; elseif($only === "GET") $met = $_GET; elseif($only === "COOKIE") $met = $_COOKIE; /* ALL METHODS: */ else $met = array_merge($_POST,$_GET,$_COOKIE);
	// REFERENCE
	$Ref = array(
			'H_R' => (array_key_exists("HTTP_REFERER",$_SERVER)?$_SERVER["HTTP_REFERER"]:null),
			'R_A' => ($_SERVER["REMOTE_ADDR"]?$_SERVER["REMOTE_ADDR"]:null),
			'R_P' => ($_SERVER["REMOTE_PORT"]?$_SERVER["REMOTE_PORT"]:null),
			'R_T' => ($_SERVER["REQUEST_TIME"]?$_SERVER["REQUEST_TIME"]:null),
			'R_U' => ($_SERVER["REQUEST_URI"]?$_SERVER["REQUEST_URI"]:null),
			'L_F' => ($_SERVER["SCRIPT_NAME"]?$_SERVER["SCRIPT_NAME"]:null)
			);
	// IS THERE SOME THING TO LOG?
	if (	$met	) { 
		// are you missed to define log container? no problem...
		$Log_Container = (defined("Log_Container")?Log_Container:"your_Request_Log.txt");
		$new = fopen($Log_Container,"a+");
		// Writing :
		$base = "\n------- ".date("Y/m/d @ H:i:s",time())." ------- \n";
		fwrite($new,$base); // this is for Seperation and time record...
			reset($met); // rewind array...
			for( $i=0;$i<count($met);$i++ ){
					$ki = key($met);
					//Where Request came from?
					$WrCf = null;
					if( array_key_exists( key($met),$_POST ) ) $WrCf = "POST"; elseif( array_key_exists( key($met),$_GET ) ) $WrCf = "GET"; elseif ( array_key_exists( key($met),$_COOKIE ) ) $WrCf = "COOKIE"; else $WrCf = "UnKnown Request method!";
					//RECORD CONTENT:
					$Log = 
"RECIVED ".$WrCf." : [".key($met)."] ::\n ".$met[$ki]."
".($Ref['H_R']?"REFERER : ".$Ref['H_R']." | ":null)."
".($Ref['R_A']?"REMOTE_ADDR : ".$Ref['R_A']." | ":null)."
".($Ref['R_P']?"PORT : ".$Ref['R_P']." ":null)."
".($Ref['R_T']?"REQUEST TIME : ".date("Y/m/d @ H:i:s",$Ref['R_T'])."  ":null)."
".($Ref['R_U']?"REQUEST URI : ".$Ref['R_U']."  ":null)."
".($Ref['L_F']?"LOGD FROM : ".$Ref['L_F']."  ":null)."
					"
					;
					fwrite($new,$Log);
					next($met);
				}
			reset($met); // rewind again, back to the main stream...
		fclose($new);
		}
}

// Runing Loger
logger();
//logger("COOKIE"); //ONLY "COOKIE"(s) or "POST" or "GET"

// JUST INCLUDE THIS TO YOUR SCRIPT...
?>