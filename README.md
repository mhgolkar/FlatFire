# Flat Fire
PHP Flat File Database Engine  
Version: 01.0.0 [2012]  


### Installation
1. Upload files to your host and address to FFDB root (index.php).  It redirects you to installation:
2. (Install FF) Set a root username and password.
3. FF is ready to use. Include "FlatFire.php" to your script, everywhere you need FF functionality.


### Features
#### Rest Api
You are able to access databases from other servers using a POST request to `FFDB/api.php`. for more information look at project Documentation or [Git Repo Wiki](https://github.com/mhgolkar/FlatFire/wiki).

#### Control Panel
Flat Fire is pure php and totaly function oriented so you can manipulate your databases, right from your script. In adition to this, FF has also powerful user-interface which prefer controls for Databases and configurations. You can access to this control panel using root username and password and from `index.php`.

#### Multiple Databases
#### Multiple users
* setup privileges for multiple users (similar to mysql).
* control members using core functions.
* manage users and privileges from control panel.

#### Free, Structured or Mixed databases
Flat Fire supports three database types:   
1. STRUCTURED  
Regular (table, row, column) format.
```
	[DATABASE]
	/	\
	TX	TableY
		\_____________________________
		|ROW_0 Colum_0 Colum_1 Colum_2|
		|ROW_1 Colum_0 Colum_1 Colum_2|
		|_____________________________|
```
2. FREE
More creative data storing.  
You can store data in any structure you want for each (free) element, its similar to storing an array with a unique "Id".
```
	[DATABASE]
	/	\
	EX	ElementY (ID)
		\________________
		|Field_0 Value_0 |
		|Field_1 Value_1 |
		|Field_2 Value_2 |
		|________________|
	recall [ID]: get_free("ElementY") --> array([Field_0]=>Value_0,[Field_1]=>Value_1...
```
3. MIXD (Mixed)   
Mixed databases can store both free elements and tables.If you add a table to a free db or a free element to a structured db, flat fire will automatically convert FREE or SRCT to MIXD database.
```
	[DATABASE]
	/	\
	EX	TY
```
		
#### Detailed error reporting
FF can trigger (short or detailed) error messages on almost every error.
	- Note: You can disable error reporting from control panel.
#### Plugin engine
#### Lightweight
#### Stable against code injection
#### Easy to search and read physical files
#### Opensource and free

________________________

### Server Requirements
1. A little storage
2. PHP 5.3+  
--> if you want to use FFDB on php5 under 5.3 this is what you need:
	remove `namespace FFDB;` and `FFDB\` from all php files, don't lose anyone. if you remove namespace, you can call functions without `FFDB\`. but you should not use this variables in your script: `$Root`, `$indb`.  more information about namespace, have a look at php official manual.
	--> you can also use [namespaceless (git) branch](https://github.com/mhgolkar/FlatFire/tree/Namespaceless).

### License:
MIT  
M. H. Golkar  
________________________
**Deprecation Warning**  
*No new development will happen in this repository.*
