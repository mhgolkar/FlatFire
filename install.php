<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//    ::: FLAT FIRE INSTALLER :::	
//

function constantin($na=null,$in=null){
	if($na!==null && $in!==null){
		$config = "Config.php";
		@chmod($config,0750);
		$opinas = fopen($config,"r+");
		clearstatcache(); set_file_buffer($opinas,0);
		$configus = fread($opinas,filesize($config));
		$patsun = "(\"".$na."\",";
		$startan = strpos($configus,$patsun)+strlen($patsun);
		if($startan){
		$spartan = strpos($configus,");",$startan);
			if($in===true || $in===false || $in==="true" || $in==="false") {
				if((bool)$in) $replaco = "true"; else $replaco = "false";
			}
			if(is_numeric($in)) $replaco = (int)$in;
			if(!@$replaco) $replaco = "\"".$in."\"";
		$newingo = substr_replace($configus,$replaco,$startan,$spartan-$startan);
		ftruncate($opinas,0); rewind($opinas);
		fwrite($opinas,$newingo);
		fclose($opinas);
		}
	}
	else return false;
}
if(	isset($_POST["INSTALL_FF_addr"]) && $_POST["INSTALL_FF_addr"]!=null ){
	$newdiro = str_replace("\\","/",$_POST["INSTALL_FF_addr"]);
	if(strrpos($newdiro,"/")!==(strlen($newdiro)-1)) $newdiro .= "/";
	constantin("_FFDIR_",$newdiro);
}

require_once("Config.php");
if( !file_exists(_FFDBDIR_."Root.rut")	){
	// PRE-INSTALL: CHECK FOR PERMISION
	$raper = "";
	clearstatcache();
	if ( !is_writable(_FFDBDIR_) || !is_readable(_FFDBDIR_) ) {
		if(!@chmod(_FFDBDIR_,0750))
			$raper .= "Unable to read or write in Database Directory. Script (not world) should have read and write permission to this folder, files in it and all sub-folders: \""._FFDBDIR_."\"";
		}
	else $raper .= "Everything is ok... We are ready to install FF";
	// INSTALLATION PART
	if(isset($_POST["INSTALL_FF"])){
	clearstatcache(); $succido = false;
		if(
		!isset($_POST["INSTALL_FF_root"]) || $_POST["INSTALL_FF_root"]== null
		|| !isset($_POST["INSTALL_FF_pass"]) || $_POST["INSTALL_FF_pass"]== null ){
				$raper = "Username or Password is null";
				$succido = false;
		}
		elseif(is_writable(_FFDBDIR_) && is_readable(_FFDBDIR_)){
			$newrut = fopen(_FFDBDIR_."Root.rut","x");
			$newdbi = fopen(_FFDBDIR_."Databases.dbi","x");
			$newsec = fopen(_FFDBDIR_."Security.sec","x");
			if(
			@fwrite($newrut,$_POST["INSTALL_FF_root"]."[=]".$_POST["INSTALL_FF_pass"]) &&
			@fwrite($newdbi,"[DATABASE LIST]") &&
			@fwrite($newsec,"[Security list]")
			){
				@fclose($newrut);
					@fclose($newdbi);
						@fclose($newsec);
				// Demo Content
				if( isset($_POST["INSTALL_FF_demo"]) ){
					include_once("FlatFire.php");
					root($_POST["INSTALL_FF_root"],$_POST["INSTALL_FF_pass"]); // access root
					root_fire("Demo_Mixed","m"); // MIXD database created
					root_hire("Demo_Mixed","demo","pass"); // privilege created
					connect("Demo_Mixed","demo","pass"); // connect to database
					new_table("RPS","player","hand","sharpness"); // table crated
						insert_row("RPS",array("player"=>"Rango","hand"=>"Rock","sharpness"=>"not")); // +row
						insert_row("RPS",array("player"=>"Edward","hand"=>"Scissors","sharpness"=>"hot")); // +row
						insert_row("RPS",array("player"=>"Skywalker","hand"=>"Paper","sharpness"=>"what")); // +row
					new_free("FF-Author",array("Name"=>"M","MiddleName"=>"H","LastName"=>"Golkar","LV"=>"DT"),true); // free element crated
				}
				// OK
				$raper = "Installed completed...<br/>Please remove this file<br/><a href=\"index.php\">Control panel</a>";
				$succido = true;
			}
		}
		else
			$raper .= "<br/>First change permissions please...";
	}
		//FORM
		if(@!$succido) $adca = "
	<form class=\"Install_Form\" action=\"".$_SERVER["PHP_SELF"]."\" method=\"POST\">
		<b>FFDB Folder</b><br/>
		<span class=\"lit\">Adress to FFDB root</span><br/>
		<input type=\"textarea\" name=\"INSTALL_FF_addr\" value=\"".__dir__."\"/><br/><br/>
		<fieldset>
			<legend><b>ROOT</b></legend>
			<span>Username: </span><br/><input type=\"textarea\" name=\"INSTALL_FF_root\"/><br/>
			<span>Password: </span><br/><input type=\"password\" name=\"INSTALL_FF_pass\"/><br/>
		</fieldset>
		<input type=\"checkbox\" name=\"INSTALL_FF_demo\" value=\"In_demo\"/><span>Install Demo Content</span><br/>
		<input id=\"ins_but\" type=\"submit\" name=\"INSTALL_FF\" value=\"Install\"/>
	</form>
	"; else $adca = "";
		echo"<!DOCTYPE html>
<html>
<head>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"FFStyle.css\"/>
</head>
<body>";
// CHECK PHP VERSION
if(strpos("PAD".phpversion(),"5.3")!==3) echo "
<div class=\"install_alert\">
<b>NOTE!</b><br/>
<span>
Your server PHP version is under 5.3
<br/>
If you want to use FFDB on php5 under 5.3 this is what you need:<br/>
remove \"namespace FFDB;\" and \"FFDB\\\" (without quotes) from all php files, don't lose anyone.
if you remove namespace, you can call functions without \"FFDB\\\" but you should not use this variables never in your script : \$Root, \$indb.
for more information about namespace, have a look at <a style=\"color:white\" href=\"http://php.net/manual/en/language.namespaces.rationale.php\">php official website</a>.
</span>
</div>
";
	echo"<div id=\"Install_Report\">
		<b>FLAT FIRE INSTALLATION</b><br/>
		<span>".$raper."</span>
	</div><br/>".$adca."
</body>
		";
} else
	die("Flat Fire had installed, please remove this file...");
?>