<?
session_start();
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
include("functions/functions.php");
logfile($_SESSION['id'], "Logged Out ".date('h:i:s A'));
unset($_SESSION['id']);
unset($_SESSION['selectid']);
header("Location: index.php");
?>
