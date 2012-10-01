<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//::: FLAT FIRE DOCUMENTATION :::
//
?>
<br/>
<h1>Documents</h1>
<br/><pre style="color:orange;margin:0px; padding:0px;">
 (     (                       (     (    (         
 )\ )  )\ )    (       *   )   )\ )  )\ ) )\ )      
(()/( (()/(    )\    ` )  /(  (()/( (()/((()/( (    
 /(_)) /(_))(*((_)(   ( )(_))  /(_)) /(_))/(_)))\   
(_))_|(_))   )\ _ )\ (_(_())  (_))_|(_)) (_)) *(_)  
</pre><pre style="color:darkred;margin:0px; padding:0px;">
| |_  | |    `_)_\(' |_   _|  | |_  |_ _|| _ \| __| 
| __| | |__   / _ \    | |    | __|  | | |   /| _|  
|_|   |____| /_/ \_\   |_|    |_|   |___||_|_\|___| 
</pre><span style="color:lightgray;">.:: MHGolkar ::. 01.00 [2012]</span><br/><br/>

<!-- Quick Start Guide -->
<details>
<summary>
	<b>Quick Start Guide</b>
</summary>
<pre class="doc">
<b>Installation</b>
	1. Upload files to your host and address to FFDB root (index.php).
	It redirects you to installation:
	2. (Install FF) Set a root username and password.
	FF is ready to use...
	Include "FlatFire.php" to your script, everywhere you need FF functionality.

IMPORTANT:
- Script should have execute, read and write permission in "Database Directory" and normal mode for other files. Please care more about modes...
- For security reasons change root username and password right from setting menu in control panel at first login. You can also find configurations there. FF has also more configurations like "Database Directory" (in "FFDB/Config.php") but you need not change these settings in regular situations.
- Note that FF has demo content and demo paired clients, for more secure experience, burn after reading!

<b>After installation</b>
- You need only to include "FFDB/FlatFire.php" in your script...
- (If you are using master version) Flat Fire name space is "FFDB" so you should care about this. for example, every time you want to call a function, it's necessary to "use FFDB as Everything-u-want;" or call functions like this: "FFDB\functionX(input)"... but i guess this is namespaceless version and you can call functions without "FFDB\" but note: never use this variables : $root & $indb
</pre>
</details>

<!-- Database file system-->
<details>
<summary>
	<b>Database file system</b>
</summary>
<pre class="doc">
Flat Fire supports unlimited databases in three types:
- <b>STRUCTURED</b> (SRCT)
This kind of databases can store data in tables with row/column structure.
[DATABASE]
/	\
TX	TableY
	\_____________________________
	|ROW_0 Colum_0 Colum_1 Colum_2|
	|ROW_1 Colum_0 Colum_1 Colum_2|
	|_____________________________|
- <b>FREE</b>
Free databases can store (free) element(s) with a unique id and you can access to any element using a single id. It's similar to storing an array.
[DATABASE]
/	\
EX	ElementY (ID)
	\________________
	|Field_0 Value_0 |
	|Field_1 Value_1 |
	|Field_2 Value_2 |
	|________________|
Output array:
[ID] --> array([Field_0]=>Value_0,[Field_1]=>Value_1,[Field_2]=>Value_2);
- <b>MIXED</b> (MIXD) 
Mixed databases can store both free elements and tables.
If you add a table to a free db or a free element to a structured db, flat fire will automatically convert FREE or SRCT to MIXD database. You can also connect to database and use this function : mix_it()
[DATABASE]
/	\
EX	TY
______________

Database files are in "Database Directory" which is defined in "config.php" file. Database Directory is "FFDB/Databases/" by default...
These files are database core:
	- Databases.dbi // stores databases name (id) and type
	- Root.rut // very simple format to store root data
	- Security.sec
In adition with these files, Any database has its own folder in Databases Directory containing:
	- DatabaseX.ctr // free elements and tables count storage
	- (if you have a FREE or MIXD db) DatabaseX.idx // free elements index
	- (if you have a SRCT or MIXD db) DatabaseX.src // tables index // also stores table structure
	and some ".3fe" and/or ".tbl" files that any one stores a free element or a table data

</pre>
</details>

<!-- Functions List -->
<details>
<summary>
	<b>Functions List</b>
</summary>
<pre class="doc">
<b>Core functions</b>
[ROOT] To use root functionality, first access to root:
- root(username,password); 
	// Access to root | Boolean
then...
- root_fire(database-name,database-type); 
	// new database | Boolean | database-type-inputs: "s" for SRCT,"f" for FREE and "m" for MIXD
- root_hire(database-name,username,password); 
	// create new privilege or replace password if already exists | Boolean 	
- root_killer(database-name or username); 
	// destroy which one exists, database or user (privilege) | Boolean 	
- root_priv_killer(user-name,database-name);
	// destroy a privilege and leave database intact | Boolean 
- user_exists(username); 
	// check if a user exists | Boolean
- db_access(username,database); 
	// check access to a database for a specific user | Boolean	
[MASTER] Functions in master folder are used by almost every other function.
the must useful function for you is presumably this one:
- connect(database,user,pass);
	// makes a connection to database | Boolean 
This function tells to script that are you privileged to database or not, and which database you want to use; so it's necessery to connect beforee use any other function. A connection is stable until you "disconnect()" or connect() again with another database. You can also check connection to db using "connected(database-name)" that returns Boolean.
Here is a list of all other MASTER functions:
- get_counter(); 
	// returns elements count for connected database
- tik_counter(plus-sign-or-minus-sign-string); 
	// increase/decrease elements count (one step) | Boolean
- under_maxim(); 
	// check if elements count is lower than maximum free elements or not | Boolean
- real_db_list();
	// returns an array of physically existing databases | array
- privilege_list(Boolean);
	// returns all privilege information about database including passwords ("true": real password string, "false" hashed password (default) | array
- db_tree();
	// returns a tree of all databases and elements | array
- FF_hash();
	// Calculates the MD5 or SHA1 hash of input (related to configurations, default is SHA1)
- pure_encode(string);
	// encode input to avoid manual injecting of preserved characters to database| string
- pure_decode(string);
	// you can guess | string
[Api] FF Api has it's own functions, some of these functions are in master folder in "Pairzoro.php":
- pair_client(id,remote-addr,database-to-access);
	// to pair a client | returns array("id"=>id,"key"=>pair-key) on success or id if already paierd | note: use unique id; if you dont, script will generate a unique random id and returns that as id
- unpair_client(id);
	// to unpair a client | Boolean
- list_paired(id-optional);
	// returns list of paired clients | array | if input is an id returns only that client information if exists
[Plugins] FF plugin engine has this functions:
- plugins_info(plugin-name);
	// returns array filled with plugins info; input = null means all plugins
- plugins_switch(plugin-name,Boolean);
	//	Boolean | 2nd input: true= make it active, false= make it deactive, null= invert it
- plug_in(filename);
	// plugin installer function | Boolean | note: input a file name only from plugins directory and without path (like this: foo.php)

<b>FREE db related</b>
After make a connection to database...
You can use these functions to manipulate FREE databases and free elements:

- check Free element exists?
	function: 
		free_existance(id); 
	returns file name of exist free element or false if doesn't exists
	input: id (name of element)

- Get Free Element (as array)
	function: 
		get_free(id,field);
	returns an array or false if id is invalid
	inputs: id (name of element) id only for all values stored in this element or id and optionally field or fields or id and single array of fields!

- Get Free Element (as string)
	function: 
		get_free_str(id,...fields...); 
	returns an string or false if id is invalid
	inputs: id (name of element) for all values stored in this element or id and optionally field or fieldss or id and single array of fields!
	but first connect to database using connect(database,user,pass)

- Add data to a free element
	functions:
		add_to_free(element-id,field,value,replace) returns true on success
		array_to_free(element-id,array-of-data,replace) returns true on success
	inputs: array-of-data(fieald=>value); you can also use array, to call add_to_free(element-id,array,replace)
	NOTE : if replace is true (default) function will replace new value to existing field

- List Free Elements
	function:
		list_free(database-name);
	returns all free elements id as an array 
	needs access to root or connection to same database

- Make new free element
	function: 
		new_free(id,fields-array,forceTo!);
	returns "id" of new free element or false (and error) if did not connected to database or unable to make element...
		input: id (unique name of element), optionally field(s) (an array that keys are fields and values are values!) and true/false to force making this element
	first argument is name and required
	function never replace an existing element but:
	if forceTo! is set to true script will compose a new element even if that specific id is exists but with a generated new name from your id and a random number then returns that new id... 

- Remove data (field and value) from free element
	function: 
		remove_from_free(id,field,delete-empty);
	function will remove a field and related value from selected free element; returns true on success or false and error on...
	input: id (name of element) and field both required, delete-empty is Boolean and optional (default: true)
	field can be an array filled with field names
	on delete-empty true : function will delete free element physically if element is empty;

- Delete a free element
	function:
		delete_free(id);
	returns "true" on success, "null" if element dose not exists, "false" and error on fai...
	input: id (name of element)
	function will remove an existing element completely from database;

<b>SRCT db related</b>
If you want to work with structured databases, these function will be useful:

- table_exists(table-name);
	if table exists returns table file name for example "DatabaseX_3.tbl", without extension.
	
- parse_src(table-name); 
	table structure parser
	returns array filled with column names

- new_table(table-name,structure); 
	makes new table with specific structure
	(makes src file and set an structure for database) 
	returns true on success or false if database exists
		input:
			table-name: unique name of new table
			structure:
			1- an array of columns (values as column names)
			2- multiple arguments
				
- list_tables(database-name);
	returns all tables id in an array
	needs access to root or connection to same database

- insert_row(table-name,data-input);
	returns new row order on success
	data-input:
			1- an array ( keys are column name and values are values!)
			2- multiple arguments
	in array input if all keys are not meaningful, script will use values with meaningful keys and leave others empty and if there is not any meaningful key will insert values in sort of array without any change to structure.

- insert_data(table,row,input); returns true on success
	input: 
			table is table name and required
			row is row id (order, first row is zero) and required
			input:
				1- an array ( keys are column id and values are values)
				2- two arguments (column id, value)
				
- get_row_count(table-name); 
	returns number of rows in a table (int)

- get_row(table,row-order);
	returns a row as an array (keys are column names)

- get_data(table,row-order,column-name);
	returns a string
	inputs all is required. table-name and row-number and column-name (or column number)

- get_column(table,column);
	inputs: table-name and column-name (or number)
	
- delete_table(tablename);
	returns Boolean
	removes entire table

- delete_row(table,row);
	returns true on success, null and error if there is not such row or false on failure and internal errors
	
</pre>
</details>

<!-- Plugins -->
<details>
<summary>
	<b>Plugins</b>
</summary>
<pre class="doc">
FF has a little plugin engine which load active plugins automatically to script.
Please take a look at dashboard->plugins menu in control panel.
<b>Install your own plugins</b>
0. It's recommended to use "FFDB" as your plugin namespace.
1. you should add this comment lines in your script:
						// plug-in-name::ADD_ON_NAME_HERE[+]
						// plug-in-des::ONE_LINE_DESCRIBTION[+]
						// plug-in-ver::VERSION[+]
						// plug-in-fil::FILE_NAME_WITH_EXTENSION_DOT_PHP[+]
change statement after "::" and before "[+]" but leave these marks intact
2. copy your php file in "<FFDB>/Functions/Plugins/" directory (no-subfolders)
3. use control panel (dashboard) to install your Plugin
4. activate it... nice job ...
script will automatically include active add_ons in FlatFire.php
</pre>
</details>

<!-- API -->
<details>
<summary>
	<b>API</b>
</summary>
<pre class="doc">
REQUEST(S):
send to "FFDB/api.php"
POST method only
			 p = parekey
			 r = request function without semicolon ( like this: get_row('jobs',1) )
response(s):
			 HTTP Status :
						-	on server errors : 500 Internal Server Error
						-	if api is disabled: 503 Service Unavailable
						-	Wrong method: 405 Method Not Allowed
						-	[!p] no pare key : 401 Unauthorized
						-	NOT PAIRED: 403 Forbidden
						-	[!r] empty request: 400 Bad Request
						-	Bad function or type in request: 406 Not Acceptable
						-	Acceptable request: 202 Accepted
						-	on result: 200 OK
							
			 HTTP Header : Content-Type: [type of result: string,array,bool...]

if you need an example:
Have a look at "FFDB/api_demo.php"
</pre>
</details>
