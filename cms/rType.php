<?php
// Read from request lists
if($_GET['result'] == 0 && isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
	mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['result']."' WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now a full member.</b>";
	logfile($_SESSION['id'], "Let ".dataRetrieve($_GET['id'], "username")." into the website as lv 0");
	}
}
if($_GET['result'] == 1 && isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
		if(isset($_POST['squad2'])) {
			if($_POST['squad2'] == snidRetrieve($_GET['id'], "s1id")) {
			$_SESSION['error'] = 7;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			exit;
			}
		logfile($_SESSION['id'], "Let ".dataRetrieve($_GET['id'], "username")." into the website as lv 1");
		mysql_query("UPDATE `accesslevels` SET `s2id` = '".$_POST['squad2']."' WHERE `userid` = '".$_GET['id']."'");
		mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['result']."' WHERE `id` = '".$_GET['id']."'");
		mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
		echo "<BR><b>".dataRetrieve($_GET['id'], "username")." is now a full member.</b><BR>";
		} else {
		echo "<form id='form34' name='form34' method='post' action='' onSubmit=\"submitonce(this);\">";
		echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=000d22>";
		echo "<tr><td colspan=2 align=center>[".dataRetrieve($_GET['id'], "username")."] Division: <b>".getDiviAL(snidRetrieve($_GET['id'], "s1id"))."</b></td></tr>";
		echo "<tr><td>Squad 1</td><td>".getSquad(snidRetrieve($_GET['id'], "s1id"))."</td></tr>";
		echo "<tr><td>Squad 2</td><td>";
		$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_GET['id'], "s1id"))."' AND `visable` = '0'");
		echo "<select name=squad2 id=squad2>";
			while($rowz = mysql_fetch_assoc($sx_result)) {
			echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
			}
		echo "</td></tr>";
		echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=request';\"><BR></td></tr>";
		echo "</select></td></tr>";
		echo "</table>";
		echo "</form>";
		}

	}
}
if($_GET['result'] == 2 && isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
		if(isset($_POST['squad2'])) {
			if($_POST['squad2'] == snidRetrieve($_GET['id'], "s1id") || $_POST['squad2'] == $_POST['squad3'] || $_POST['squad3'] == snidRetrieve($_GET['id'], "s1id")) {
			$_SESSION['error'] = 7;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			exit;
			}
		logfile($_SESSION['id'], "Let ".dataRetrieve($_GET['id'], "username")." into the website as lv 2");
		mysql_query("UPDATE `accesslevels` SET `s2id` = '".$_POST['squad2']."' WHERE `userid` = '".$_GET['id']."'");
		mysql_query("UPDATE `accesslevels` SET `s3id` = '".$_POST['squad3']."' WHERE `userid` = '".$_GET['id']."'");
		mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['result']."' WHERE `id` = '".$_GET['id']."'");
		mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
		echo "<BR><b>".dataRetrieve($_GET['id'], "username")." is now a full member.</b><BR>";
		} else {
		echo "<form id='form34' name='form34' method='post' action='' onSubmit=\"submitonce(this);\">";
		echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=000d22>";
		echo "<tr><td colspan=2 align=center>[".dataRetrieve($_GET['id'], "username")."] Division: <b>".getDiviAL(snidRetrieve($_GET['id'], "s1id"))."</b></td></tr>";
		echo "<tr><td>Squad 1</td><td>".getSquad(snidRetrieve($_GET['id'], "s1id"))."</td></tr>";
		echo "<tr><td>Squad 2</td><td>";
		$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_GET['id'], "s1id"))."' AND `visable` = '0'");
		echo "<select name=squad2 id=squad2>";
			while($rowz = mysql_fetch_assoc($sx_result)) {
			echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
			}
		echo "</td></tr>";
		echo "<tr><td>Squad 3</td><td>";
		$sx_results = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_GET['id'], "s1id"))."' AND `visable` = '0'");
		echo "<select name=squad3 id=squad3>";
			while($rowz = mysql_fetch_assoc($sx_results)) {
			echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
			}
		echo "</td></tr>";
		echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=request';\"><BR></td></tr>";
		echo "</select></td></tr>";
		echo "</table>";
		echo "</form>";
		}
	}
}
if($_GET['result'] == 3 && isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "accesslevel") > 3) {
	logfile($_SESSION['id'], "Let ".dataRetrieve($_GET['id'], "username")." into the website as lv 3");
	mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['result']."', `clanleaderid` = '".getDiviID(snidRetrieve($_GET['id'], "s1id"))."' WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now a full member.</b>";
	}
}
if($_GET['result'] == 4 && isset($_SESSION['id'])) {
	if(dataRetrieve($_SESSION['id'], "accesslevel") == 5) {
	logfile($_SESSION['id'], "Let ".dataRetrieve($_GET['id'], "username")." into the website as lv 4");
	mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['result']."' WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now a full member.</b>";
	}
}
if($_GET['result'] == 7 && isset($_SESSION['id'])) {
	logfile($_SESSION['id'], "Dropped ".dataRetrieve($_GET['id'], "username")." off the website");
	if(dataRetrieve($_SESSION['id'], "accesslevel") == 3 && dataRetrieve($_GET['id'], "accesslevel") <= 2) {
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now dropped from the access list.</b>";
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `useraccess` WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `accesslevels` WHERE `userid` = '".$_GET['id']."'");
	} elseif(dataRetrieve($_SESSION['id'], "accesslevel") == 4 && dataRetrieve($_GET['id'], "accesslevel") <= 3) {
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now dropped from the access list.</b>";
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `useraccess` WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `accesslevels` WHERE `userid` = '".$_GET['id']."'");
	} elseif(dataRetrieve($_SESSION['id'], "accesslevel") == 5 && dataRetrieve($_GET['id'], "accesslevel") <= 4) {
	echo "<b>".dataRetrieve($_GET['id'], "username")." is now dropped from the access list.</b>";
	mysql_query("DELETE FROM `requestlist` WHERE `appid` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `useraccess` WHERE `id` = '".$_GET['id']."'");
	mysql_query("DELETE FROM `accesslevels` WHERE `userid` = '".$_GET['id']."'");
	}
}
?>