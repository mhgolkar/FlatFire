<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//    ::: FLAT FIRE [LOADER] :::
// include "Config.php" and this file in your script to use flat fire
// IT'S RECOMMANDED: DON'T CHANGE SORT OF FUNCTIONS
// ____________________________________________
//

// for some controls
define("_FF_LOADED_",true); // dont change this

// core and universal functions
@require_once("Config.php"); // Configurations [RIQUIERD]
if(gettype(_FFDIR_)==="NULL") trigger_error("Unable to load FFDB directory path from Configuration file!",E_USER_ERROR);
require_once(_FFDIR_."Functions/Master/Pure_fire.php");
if(_FF_ERR_) include_once(_FFDIR_."Functions/Master/Error_Hand.php");
if(_FF_Root_acs_) include_once(_FFDIR_."Functions/Root.php");
if(_FF_Root_acs_) include_once(_FFDIR_."Functions/Master/db_list.php");
require_once(_FFDIR_."Functions/Master/Connect.php");
require_once(_FFDIR_."Functions/Master/Counter.php");
require_once(_FFDIR_."Functions/Master/db_type.php");
if(_FF_Plug_in_) require_once(_FFDIR_."Functions/Plugins.php");
if(_FF_use_api_) require_once(_FFDIR_."Functions/Master/Pairzoro.php");

// free element functions
include_once(_FFDIR_."Functions/Free/free_existance.php");
include_once(_FFDIR_."Functions/Free/new_free.php");
include_once(_FFDIR_."Functions/Free/get_free.php");
include_once(_FFDIR_."Functions/Free/get_free_str.php");
include_once(_FFDIR_."Functions/Free/list_free.php");
include_once(_FFDIR_."Functions/Free/add_to_free.php");
include_once(_FFDIR_."Functions/Free/delete_free.php");
include_once(_FFDIR_."Functions/Free/remove_from_free.php");

// Structured database functions
include_once(_FFDIR_."Functions/Structured/table_exists.php");
include_once(_FFDIR_."Functions/Structured/new_table.php");
include_once(_FFDIR_."Functions/Structured/delete_table.php");
include_once(_FFDIR_."Functions/Structured/get_row_count.php");
include_once(_FFDIR_."Functions/Structured/list_tables.php");
include_once(_FFDIR_."Functions/Structured/src_parser.php");
include_once(_FFDIR_."Functions/Structured/get_row.php");
include_once(_FFDIR_."Functions/Structured/get_data.php");
include_once(_FFDIR_."Functions/Structured/get_column.php");
include_once(_FFDIR_."Functions/Structured/insert_row.php");
include_once(_FFDIR_."Functions/Structured/insert_data.php");
include_once(_FFDIR_."Functions/Structured/delete_row.php");

?>