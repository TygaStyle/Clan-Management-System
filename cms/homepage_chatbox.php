<?
if(!isset($_GET['Sl4kAS01kdX'])) {


	echo "<table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=100% height=146>";
	echo "<form name='form12121212' method='post' action='' onSubmit=\"submitonce(this);\">";
	echo "<tr><td valign=top align=center>";
	
	$sqlx = "SELECT * FROM `chatbox` ORDER BY `id` DESC LIMIT 0,10";
	$resultx = mysql_query($sqlx);
	$num_rows = mysql_num_rows($resultx);
	if($resultx) {
		if(!$num_rows == 0) {
		echo "<iframe src=homepage_chatbox.php?Sl4kAS01kdX height='125' width='100%' scrolling='yes' marginheight='0' marginwidth='0' frameborder='0' align=center class=tablexx id=chr name=chr></iframe>";
		} else {
		echo "<BR><center>Chatbox has no Data</center>";
		}
	} else {
	echo "<BR><center>Chatbox is broken</center>";
	}
	if(isset($_SESSION['id'])) {
	echo "<table cellpadding=0 cellspacing=0 border=0 align=center width=330><tr><td width=260>";
	echo "<input type='text' name='chatbox' size='27' maxlength=250 class=forms></td><td width=200 align=left>";
	echo "<input type='submit' name='Submit' value='Enter' class=forms><input class=forms type='button' value='Refresh' onClick=\"document.getElementById('chr').contentWindow.location.reload()\"></td><td width=20 align=right><font size=1><script language=\"javascript\">displaylimit(\"\",\"chatbox\",250)</script></font></td></tr></table>";
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
	echo "Must be logged in to reply.";
	}
	echo "</td></tr></form></table>";
} else {
session_start();
$connection = mysql_connect("localhost", "rdghq_guest", "guest");
mysql_select_db("rdghq_roster", $connection);
//echo "<meta http-equiv=\"refresh\" content=\"15\">";
echo "<style type=text/css>
<!--
.formsxx {
font:normal 12px Verdana;
border : 1px solid #000000;
}
.forms {
font:normal 12px Verdana;
border : 1px solid #000000;
background-color: #000000;
}
body {
	margin-top: 0px;
	margin-bottom: 0px;
	background-color: #000000;
}
.tablexx {
border : 1px solid #000000;
background-color:#000000;
}
body,td,th {
	color: ffffff;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:link {
	color: #003375;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #003375;
}
a:hover {
	text-decoration: underline;
	color: #0066CC;
}
a:active {
	text-decoration: none;
	color: #003375;
}
-->
</style>";
require("config.php");
require("functions/functions.php");

$sql = "SELECT * FROM `chatbox` ORDER BY `id` DESC LIMIT 0,25";
$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)) {
	echo "<table class=forms cellpadding=0 cellspacing=0 align=center width=99%>";

	echo "<tr><td bgcolor=000d22><div title='[".$row['datesent']."]'><a href=http://www.rdghq.com/roster/index.php?db=profile&v=".$row['userid']." target=_parent><font size=1 style='color: #FFFFFF; text-decoration: none;'>".colorname(dataRetrieve($row['userid'], "username"), dataRetrieve($row['userid'], "colorcode"))."</font></a></div></td></tr><tr><td valign=top><div title='[".$row['datesent']."]'>".afterMsg(replaceUrl($row['message'], 18), 14)."</div></td></tr>";
	echo "</table><BR>";
	}
	
echo "<BR>";
mysql_close($connection);
}
?>