<?php

/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//	::: CONTROL PANEL HOME :::
*/
?>
<br/>
<p>
	<b>FLAT FIRE</b><br/>
	<span> Control Panel Home Page </span>
</p>
<table class="tensuplsu" border="1">
	<caption>Your Databases</caption>
	<tr class="trpink">
		<th>Databases</th>
	</tr>
<?php
$dbsli = real_db_list();
if(count($dbsli)===0) echo "<tr><td> NO DATABASE (<a href=\"?p=databases&l=New\"> Create </a>) </td></tr>";
for($ilk=0;$ilk<count($dbsli);$ilk++){
echo"
	<tr".($ilk%2!==0?" class=\"rawrow\"":"").">
		<td>".$dbsli[$ilk]."</td>
	</tr>";
}
?>
</table>

<!-- Bad Loging-in log -->
<table class="tensuplsu" border="1">
	<caption>Bad Loging-in log</caption>
	<tr class="trpink">
		<th>ADDR</th>
		<th>Tries</th>
		<th>Date</th>
	</tr>
<?php
$trilis = parse_ini_file("Panel/Functions/Tracker.ini",true);
reset($trilis);
for($ilk=0;$ilk<count($trilis);$ilk++){
echo"
	<tr".($ilk%2!==0?" class=\"rawrow\"":"").">
		<td>".key($trilis)."</td>
		<td>".($trilis[key($trilis)]["rate"]<3?
			$trilis[key($trilis)]["rate"]+1
			:"BANED"
			)."</td>
		<td>".$trilis[key($trilis)]["time"]."</td>
	</tr>";
next($trilis);
}
?>
</table>