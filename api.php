<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		    ::: API :::
// ____________________________________________
// REQUEST(S):
// POST method only
//			 p = parekey
//			 r = request function ( like this: get_row('jobs',1) ) without semicolon
// response(s):
//			 HTTP Status :
//							on server errors : 500 Internal Server Error
//							if api is disabled: 503 Service Unavailable
//							Wrong method: 405 Method Not Allowed
//							[!p] no pare key : 401 Unauthorized
//							NOT PAIRED: 403 Forbidden
//							[!r] empty request: 400 Bad Request
//							Bad function or type in request: 406 Not Acceptable
//							Acceptable request: 202 Accepted
//							on result: 200 OK
//							
//			 HTTP Header : Content-Type: [type of result: string,array,bool...]
//


// REQUIREMENTS
require_once("FlatFire.php"); // include flatfire
include_once(_FFDIR_."Functions/Api/Recorder.php"); // request logging
require_once(_FFDIR_."Functions/Api/port.php");
require_once(_FFDIR_."Functions/Api/Reactor.php");

if(!_FF_LOADED_ || !_FFREA_LOADED_ || !_FFPOT_LOADED_) {header("HTTP/1.1 500 Internal Server Error"); die();}

// time limit
if(is_numeric(_FF_api_time_) && is_finite(_FF_api_time_) && !is_nan(_FF_api_time_)) set_time_limit(_FF_api_time_);
elseif(_FF_api_time_!==true) set_time_limit(60);

// API
if(!_FF_use_api_) {header("HTTP/1.1 503 Service Unavailable"); die();}
if ($_SERVER["REQUEST_METHOD"] === "POST"){		
	header("HTTP/1.1 100 Continue");
	if(	isset( $_POST["p"] ))
	{
		$ath = api_port_auth($_SERVER["REMOTE_ADDR"],$_POST["p"]);
		if($ath){
			if( isset($_POST["r"]) ){
				if(api_port_acable($_POST["r"])) header("HTTP/1.1 202 Accepted"); 
							else {header("HTTP/1.1 406 Not Acceptable"); die();}
					$result = api_reactor($_POST["r"]);
					if(!$result) {header("HTTP/1.1 404 Not Found"); die();}
					if($result === true) {header("HTTP/1.1 200 OK");}
					print_r($result);
				header("HTTP/1.1 200 OK");
			} else header("HTTP/1.1 400 Bad Request");
		} else header("HTTP/1.1 403 Forbidden");
	} else header("HTTP/1.1 401 Unauthorized");
}else header("HTTP/1.1 405 Method Not Allowed");

?>