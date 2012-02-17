<?
//if($_SERVER['REMOTE_ADDR'] != "98.226.56.186") {
//exit("<table width=100% height=100%><tr><td align=center><table cellpadding=0 cellspacing=0 style=\"border: solid 1px #000000\" width=200><tr><td bgcolor=#cccccc><font face=verdana><b>Updating</b></font></td></tr><tr><td><font face=verdana>10 min, changing ranks</font></td></tr></td></tr></table>");
//}
session_start();
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
$newresult = mysql_query("SELECT * FROM `ipban` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."'");
if(mysql_num_rows($newresult) == 1) {
unset($_SESSION['id']);
header("Location: http://www.google.com");
exit;
}

require("config.php");
require("functions/functions.php");
if(isset($_POST['cc'])) {
mysql_query("UPDATE `useraccess` SET `colorcode` = '".$_POST['cc']."' WHERE `id` = '".$_SESSION['id']."'");
echo "<script language=\"javascript\">";
echo "alert(\"Color Changed (look at gamercard)\");";
echo "</script>";
}

if(isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "username") == "#Name_Dead#") {
	unset($_SESSION['id']);
	}
}
if(!isset($_SESSION['chatboxx'])) {
	$_SESSION['chatboxx'] = "1";
}
require("functions/display.php");
require("templatev3.php");
?>