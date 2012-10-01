<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//	::: Error Handler Function :::
//
														
function Erritoria($num, $msg, $fle, $lin, $ctx){
// if When we have '@' before error :
if ( ! error_reporting() ) return false; // you used "@" operator : function dose not report error...
if ( !_FF_ERR_ ) return false; // @ : function dose not report error...
// else...
echo "<br/>"; // just for clear message printing!	
$bfle = basename($fle); // short file name
if(!_FF_ERR_short_) $moreis = "  ".$bfle." : ".$lin." :: "; else $moreis =""; // from config : short report or not
// and start beauty reporting:
	switch ($num) {
	// Error types [numbers]:	
		case 256:
			// E_USER_ERROR
			echo "<b style=\"color:red\">Error!</b>$moreis $msg <br/>";
			die("Exacustion is died..."); //IS FATAL!
				break;		
		case 512:
			// E_USER_WARNING
			echo "<b style=\"color:orange\">Warning!</b>$moreis $msg <br/>";
				break;		
		case 1024:
			// E_USER_NOTICE
			echo "<b style=\"color:YellowGreen\">Notice!</b>$moreis $msg <br/>";
				break;		
		default:
			// Non-user-generated errors
			$bfle = basename($fle); //cleaning file url (aestetics!)
			echo "<b style=\"color:red\">Php Error!</b> [$num] '$moreis' , $msg <br/>";
				break;
	}
	// MySQL Errors...
	if( mysql_error() && mysql_error() !="" ) // We have an MYSQL error message... so ...
		echo "<b style=\"color:purple\">.::. MSQL Error</b> [".mysql_errno()."]  ".mysql_error()."<br/>";
}
//seting up error handler
set_error_handler("Erritoria");
?>
