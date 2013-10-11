	 (     (                       (     (    (         
 	)\ )  )\ )    (       *   )   )\ )  )\ ) )\ )      
	(()/( (()/(    )\    ` )  /(  (()/( (()/((()/( (    
 	/(_)) /(_))(*((_)(   ( )(_))  /(_)) /(_))/(_)))\   
	(_))_|(_))   )\ _ )\ (_(_())  (_))_|(_)) (_)) *(_)  
	| |_  | |    `_)_\(' |_   _|  | |_  |_ _|| _ \| __| 
	| __| | |__   / _ \    | |    | __|  | | |   /| _|  
	|_|   |____| /_/ \_\   |_|    |_|   |___||_|_\|___| 

________________________

.:: FLAT FIRE DATABASE ::.
PHP Flat File Database Engine
________________________

# Easy to setup
	1. Upload files to your host and address to FFDB root (index.php).
	It redirects you to installation:
	2. (Install FF) Set a root username and password.
	FF is ready to use...
	Include "FlatFire.php" to your script, everywhere you need FF functionality.

# REST API
	You are able to access databases from other servers using a POST request to "FFDB/api.php".
	for more information look at Documentation.

# CONTROL PANEL
	Flat Fire is pure php and totaly function oriented so you can manipulate your databases, right from your script. In adition to this, FF has also powerful user-interface which prefer controls for Databases and configurations.
	You can access to this control panel using root username and password and from index.php

# MULTIDATABASE
	Create databases as many as you want.

# MULTIUSER
	You can:
	1. setup privileges for multiple users (similar to mysql).
	2. control members using core functions.
	2. manage users and privileges from control panel.

# Free or Structured or Mixed
	Flat Fire supports three database types:
	- STRUCTURED
	Regular (table, row, column) format.
	[DATABASE]
	/	\
	TX	TableY
		\_____________________________
		|ROW_0 Colum_0 Colum_1 Colum_2|
		|ROW_1 Colum_0 Colum_1 Colum_2|
		|_____________________________|
	- FREE
	More creative data storing. You can store data in any structure you want for each (free) element, its similar to storing an array with a unique "Id".
	[DATABASE]
	/	\
	EX	ElementY (ID)
		\________________
		|Field_0 Value_0 |
		|Field_1 Value_1 |
		|Field_2 Value_2 |
		|________________|
	recall [ID]: get_free("ElementY") --> array([Field_0]=>Value_0,[Field_1]=>Value_1...
	- MIXD (Mixed)
	Mixed databases can store both free elements and tables.If you add a table to a free db or a free element to a structured db, flat fire will automatically convert FREE or SRCT to MIXD database.
	[DATABASE]
	/	\
	EX	TY
		
# Detailed error reporting
	FF can trigger (short or detailed) error messages on almost every error.
	- Note: You can disable error reporting from control panel.
# Plugin engine
# Lightweight
# Stable against code injection
# Easy to search and read physical files
# Opensource and free
# Server Requirements
	A little storage and...
	PHP 5.3+ or...
	--> if you want to use FFDB on php5 under 5.3 this is what you need:
	remove "namespace FFDB;" and "FFDB\" (without quotes) from all php files, don't lose anyone.
	if you remove namespace, you can call functions without "FFDB\"...
	but you should not use this variables: $Root, $indb
	for more information about namespace, have a look at php official manual.
	--> you can also use namespaceless (git) branch.
________________________
# License:
(MIT License)
Read "License" file please; That's plain text.
________________________
Author: 
	M. H. GOLKAR
	http://mhgolkar.com/
Version: 
	01.00 [2012]
________________________
For more information please take a look at "Documents" in control panel
