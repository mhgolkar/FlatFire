<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		  ::: API REACTOR :::
// ____________________________________________
// generate result and send response to api request
//

// for some controls
define("_FFREA_LOADED_",true); // dont change this

// REACTOR
function api_reactor($in=null){
	if($in!==null){
		eval("\$result =@FFDB\\".$in.";");// GET RESULT
		// SEND RESULT
		header("Content-Type: .".gettype($result)); // send content type header
		return $result; // return material
		}
	else return false;
}
?>