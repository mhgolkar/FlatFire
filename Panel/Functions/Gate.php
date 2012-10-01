<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |_______________|
//::: FLAT FIRE CONTROL PANEL GATE :::
*/

// LOGIN
function gate($us=null,$pa=null){
	if($us!==null && $pa!==null){
	$tracker = "Panel/Functions/Tracker.ini";
		if(!file_exists($tracker)) {$nork = @fopen($tracker,"x"); @fclose($nork);}
		$parsier = @parse_ini_file($tracker,true);
		$ter = $_SERVER["REMOTE_ADDR"];
		if(@$parsier[$ter]["time"] === Date("Y/M/D",time()) && @$parsier[$ter]["rate"]>2){
			header("HTTP/1.1 403 Forbidden");
			die("
			<!DOCTYPE html>
			</head><link rel=\"stylesheet\" type=\"text/css\" href=\"FFStyle.css\"/></head>
			<body><p class=\"alerti\">Your ip is baned for 24h</p></body>
			");
			}
	if(root($us,$pa)){
		$_SESSION["ROOT"]=(string)$us;
		$_SESSION["PASS"]=(string)$pa;
		
	} else {
			if(array_key_exists($ter,$parsier)){
				$outi = fopen($tracker,"r+"); clearstatcache();
				if($outi){
				$ready = fread($outi,filesize($tracker));
				foreach(@$parsier as $ave){
					if($ave["time"]!==Date("Y/M/D",time())) $ready = str_replace("[".$ter."]\nrate=".$ave["rate"]."\ntime=".$ave["time"]."\n","",$ready);
				}
				$towr = str_replace("[".$ter."]\nrate=".$parsier[$ter]["rate"],"[".$ter."]\nrate=".($parsier[$ter]["rate"]+1),$ready);
				ftruncate($outi,0);	rewind($outi); fwrite($outi,$towr);	fclose($outi);
				}
			}
			else {
				$outi = fopen($tracker,"a+");
				if($outi){ fwrite($outi,"[".$ter."]\nrate=0\ntime=".Date("Y/M/D",time())."\n"); fclose($outi); }
			}
		return false;
	}
	}
	else {
		trigger_error("Bad function invoking: null input",E_USER_ERROR);
		return false;
	}
}

?>