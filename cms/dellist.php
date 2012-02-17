<?
if(isset($_POST['nam'])) {
	if($_POST['nam'] == "0") {
	echo "<script langauge=javascript>alert(\"You did not select a member\");</script>";
	} else {
	$name = dataRetrieve($_POST['nam'], "username");
	logfile($_SESSION['id'], "Deleted user: <u>".$name."</u>");
	mysql_query("INSERT INTO `removed_names` (`uid`, `name`) VALUES ('".$_POST['nam']."', '".$name."')");
	mysql_query("DELETE FROM `useraccess` WHERE `id` = '".$_POST['nam']."'");
	mysql_query("DELETE FROM `accesslevel` WHERE `userid` = '".$_POST['nam']."'");
	echo "<script langauge=javascript>alert(\"User Deleted\");</script>";
	}
}
$rrr = mysql_query("SELECT * FROM `useraccess` ORDER BY `username`");
echo "<form id='form1s' name='form1s' method='post' action='#' onSubmit=\"submitonce(this);\">";
echo "<select id=nam name=nam>";
echo "<option value=0>--Select a Member--</option>";
	while($row = mysql_fetch_assoc($rrr)) {
		if($row['letinby'] == 0) {
		
		} else {
			if($row['accesslevel'] <= 4) {
			echo "<option value=".$row['id'].">".$row['username']."</option>";
			}
		}
	}
echo "</select>";
echo "<input type=Submit value=Delete>";
echo "</form>";
echo "<a href=index.php?db=adminsettings>Back</a>";
?>