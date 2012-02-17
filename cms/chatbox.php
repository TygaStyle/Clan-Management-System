<?
if(!isset($_GET['Sl4kAS01kdX'])) {
	echo "<center><i><font size=1>Message to Chatbox</font></i></center><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=95% bgcolor=e0e0e0><tr><td valign=top align=center valign=middle><BR>";
	if(isset($_SESSION['id'])) {
	echo "<form name='form12121212' method='post' action='' onSubmit=\"submitonce(this);\">";
	echo "<textarea name='chatbox' cols='15' rows='2' wrap='VIRTUAL' class=forms maxlength=100></textarea><BR>";
	echo "<font size=1><script language=\"javascript\">displaylimit(\"\",\"chatbox\",250)</script> characters remaining</font>";
	echo "<BR><input type='submit' name='Submit' value='Enter' class=forms><input class=forms type='button' value='Refresh' onClick=\"document.getElementById('chr').contentWindow.location.reload()\"></form><a href=viewall.php target=_blank>View all posts</a>";
		if(isset($_POST['chatbox'])) {
		$cbmessage = replaceMessage($_POST['chatbox']);
			if($cbmessage == "") {
			$_SESSION['error'] = 3;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			} else {
				if($_SESSION['chatboxx'] == md5($_POST['chatbox'])) {
				} else {
				$sqlx = "INSERT INTO `chatbox` (`userid`, `message`, `datesent`) VALUES ('".$_SESSION['id']."', '".$cbmessage."', '".date("m/d/y")."')";
				$resultx = mysql_query($sqlx);
					if(!$resultx) {
					echo mysql_error();
					}
				$_SESSION['chatboxx'] = md5($_POST['chatbox']);
				}
			}
		}
	} else {
	echo "Must be logged in to reply<BR>&nbsp;";
	}
	echo "</td></tr></table>";
	$sqlx = "SELECT * FROM `chatbox` ORDER BY `id` DESC LIMIT 0,10";
	$resultx = mysql_query($sqlx);
	$num_rows = mysql_num_rows($resultx);
	if($resultx) {
		if(!$num_rows == 0) {
		echo "<BR><iframe src=chatbox.php?Sl4kAS01kdX height='200' bgcolor='666666' width='163' scrolling='yes' marginheight='0' marginwidth='0' frameborder='0' align=center class=tablexx id=chr name=chr></iframe><BR>&nbsp;";
		} else {
		echo "<BR><center>Chatbox has no Data</center><BR>";
		}
	} else {
	echo "<BR><center>Chatbox is broken</center><BR>";
	}
} else {
session_start();
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
//echo "<meta http-equiv=\"refresh\" content=\"15\">";
require("config.php");
require("functions/functions.php");

$sql = "SELECT * FROM `chatbox` ORDER BY `id` DESC LIMIT 0,25";
$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)) {
	echo "<table class=forms cellpadding=0 cellspacing=0 align=center width=95%>";
	echo "<tr><td style=\"background: url(imgs/nav_bg.gif) repeat-x;\"><div title='[".$row['datesent']."]'><a href=index.php?db=profile&v=".$row['userid']." target=_parent><font size=1 style='color: #FFFFFF; text-decoration: none;'>".colorname(dataRetrieve($row['userid'], "username"), dataRetrieve($row['userid'], "colorcode"))."</font></a></div></td></tr><tr><td valign=top><div title='[".$row['datesent']."]' style=\"font-size: 12px;\">".afterMsg(replaceUrl($row['message'], 21), 21)."</div></td></tr>";
	echo "</table>";
	}
	
mysql_close($connection);
}
?>