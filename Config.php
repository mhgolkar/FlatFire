<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//		::: Configuration :::

// Flat Fire Directoy
define("_FFDIR_",__dir__."/");
// Flat Fire Databases Directoy
define("_FFDBDIR_",_FFDIR_."Databases/");
// connection password protection activated?
define("_FF_Secure_",true);
// Root access // make user, set privileges, make database, remove user or database
define("_FF_Root_acs_",true);
// Control panel Avilable?
define("_FF_CP_",true);
// allow mixed database
define("_FF_mxd_db_",true);
// report FFDB detailed Errors
define("_FF_ERR_",true);
// Short Error report?
define("_FF_ERR_short_",false);
// Maximum free elements per database
define("_FF_E_MAX_","UNLIMITED"); // only integer... string, not a number and float means unlimited
// PHP hash method?
define("_FF_hash_","SHA1"); // "SHA1"(default) or "MD5" IMPORTANT!! : Never change this if you have any active database
// use plugins
define("_FF_Plug_in_",true);
// api?
define("_FF_use_api_",true);
// api time limit
define("_FF_api_time_",60); // Seconds or 'true' (without qoutes) for unlimited (dangerous!)
?>