<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |_______________|  */
//	  ::: Sanitize inputs :::
// ____________________________________________
//

// sanit_integer(number); returns integer number if its ok!
function sanit_integer($inta){
	if(
		is_numeric($inta)
		&& !is_nan($inta)
		&& is_finite($inta)
							) return (int)$inta;
							  else return false;
}

?>