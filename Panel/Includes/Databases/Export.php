<?php/*		  _______________//		 | 				 |//		 |	M.H.GOLKAR	 |//		 |	 FlatFire	 |//		 |	01.00[2012]	 |//		 |_______________|//::: Control panel Export:::*/$dblistay = real_db_list();?><h1>EXPORT</h1><!-- Toolbar --><?php include_once("Panel/Includes/Databases/Jobs/Toolbar.php") ?><!-- Guide --><?php if(!isset($_POST["ff_x_port_db"])) echo"<span>	You can also select items for edit in \"Editor\" and click on [Xport] button.</span><br/>";?><!-- Jobs --><div id="X_P_Job_cvs"><h1>Export To CSV</h1><form action="Panel/Includes/Databases/Jobs/Export_csv_job.php" method="POST" ><b>Database</b><br/><select name="ff_x_port_db"><?phpif(isset($_POST["ff_x_port_db"]))	echo "<option value=\"".$_POST["ff_x_port_db"]."\">".$_POST["ff_x_port_db"]."</option>";else echo "<option value=\"null\">Select from this list</option>";foreach($dblistay as $fag){	if($fag!==@$_POST["ff_x_port_db"]) echo "<option value=\"".$fag."\">".$fag."</option>";}?></select><br/><b>Element</b><span class="req"> *Required</span><br/><input name="ff_x_port_it" placeholder="Table or Free item" <?php if(isset($_POST["ff_x_port_it"])) echo "value=\"".$_POST["ff_x_port_it"]."\""; ?>/><br/><input class="creatbot" type="submit" value="CsvXport"/></form></div><div id="X_P_Job_xml"><h1>Export To XML</h1><form action="Panel/Includes/Databases/Jobs/Export_xml_job.php" method="POST" ><b>Database</b><br/><select name="ff_x_port_db"><?phpif(isset($_POST["ff_x_port_db"]))	echo "<option value=\"".$_POST["ff_x_port_db"]."\">".$_POST["ff_x_port_db"]."</option>";else echo "<option value=\"null\">Select from this list</option>";foreach($dblistay as $fag){	if($fag!==@$_POST["ff_x_port_db"]) echo "<option value=\"".$fag."\">".$fag."</option>";}?></select><br/><b>Element</b><span class="req"> *Required</span><br/><input name="ff_x_port_it" placeholder="Table or Free item" <?php if(isset($_POST["ff_x_port_it"])) echo "value=\"".$_POST["ff_x_port_it"]."\""; ?>/><br/><input class="creatbot" type="submit" value="XmlXport"/></form></div><div id="X_P_Job_sql"><h1>Export To SQL</h1><form action="Panel/Includes/Databases/Jobs/Export_sql_job.php" method="POST" ><b>Database</b><br/><select name="ff_x_port_db"><?phpif(isset($_POST["ff_x_port_db"]))	echo "<option value=\"".$_POST["ff_x_port_db"]."\">".$_POST["ff_x_port_db"]."</option>";else echo "<option value=\"null\">Select from this list</option>";foreach($dblistay as $fag){	if($fag!==@$_POST["ff_x_port_db"]) echo "<option value=\"".$fag."\">".$fag."</option>";}?></select><br/><span>Collation</span><br/><select name="ff_x_port_colat"><option value="utf8_unicode_ci">utf8_unicode_ci</option><option value="utf8_bin">utf8_bin</option><option value="utf16_bin">utf16_bin</option><option value="utf16_unicode_ci">utf16_unicode_ci</option><option value="ascii_bin">ascii_bin</option><option value="ascii_general_ci">ascii_general_ci</option><option value="utf32_bin">utf32_bin</option><option value="utf32_unicode_ci">utf32_unicode_ci</option></select><br/><b>Element</b><span class="req"> *Required</span><br/><input name="ff_x_port_it" placeholder="Table or Free item" <?php if(isset($_POST["ff_x_port_it"])) echo "value=\"".$_POST["ff_x_port_it"]."\""; ?>/><br/><input class="creatbot" type="submit" value="SqlXport"/></form></div>