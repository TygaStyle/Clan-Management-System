<?php
session_start();
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
require("../functions/functions.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
//secure the page
if(isset($_SESSION['id']) && isset($_SESSION['selectid'])) {
	$maxsquad = mysql_query("SELECT * FROM `squads` WHERE `id` = '".$_SESSION['selectid']."'");
	$mbrcount = mysql_query("SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0'");
	$membercount = mysql_num_rows($mbrcount);
	$row_max = mysql_fetch_row($maxsquad);
	echo "<table cellpadding=0 cellspacing=0 border=0 style=\"border: solid 1px #000000\" width=120>";
	echo "<tr><td><table cellpadding=0 cellspacing=0 border=0 bgcolor=00358C width=".(($membercount / $row_max[6]) * 100)."% height=16><tr><td></td></tr></table></td></tr>";
	echo "</table>";
	echo "<b>".$membercount."/".$row_max[6]."</b> MbR Full<BR>";
	if($row_max[7] == 2) {
	echo "<BR><font color=red><b>Squad is Locked</b></font>";
	}
}
?>