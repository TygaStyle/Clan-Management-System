<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET['n'])) {
	$handle = fopen("http://www.ndagaming.com/roster/ajax_mbr_srch.php?n=".str_replace(" ", "+", $_GET['n']), "rb");
	$contents = '';
	while (!feof($handle)) {
	  $contents .= fread($handle, 8192);
	}
	fclose($handle);
	echo $contents;

} else {
echo "Search is currently down";
}
?>