<?
if(isset($_GET['p'])) {	
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";
require("config.php");
require("functions/functions.php");


		echo "<center>";
			if($_GET['p'] == 0) {
			$limnum = 0;
			} else {
			$limnum = $_GET['p'] * 50;
			}	
		$rowresult = mysql_query("SELECT * FROM `chatbox`");
		$rownum = mysql_num_rows($rowresult);
		$pagecount = 0;
		echo "Page Numbers:";
			while($rownum > 0) {
			if($_GET['p'] == $pagecount) {
			echo "<b>".($pagecount + 1)."</b> ";
			} else {
			echo "<a href=viewall.php?p=".$pagecount.">".($pagecount + 1)."</a> ";
			}
			++$pagecount;
			$rownum = $rownum - 50;
			}
		echo "</center><BR>";
		
$sql = "SELECT * FROM `chatbox` ORDER BY `id` DESC LIMIT ".$limnum.",50";
$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)) {
	echo "<BR><table class=forms cellpadding=0 cellspacing=0 align=center width=95%>";
	echo "<tr><td bgcolor=000d22><div title='[".$row['datesent']."]'><a href=http://www.rdghq.com/roster/index.php?db=profile&v=".$row['userid']." target=_parent><font size=1 style='color: #FFFFFF'>".colorname(dataRetrieve($row['userid'], "username"), dataRetrieve($row['userid'], "colorcode"))."</font></a></div></td></tr><tr><td valign=top><div title='[".$row['datesent']."]'>".afterMsg(replaceUrl($row['message'], 1000), 1000)."</div></td></tr>";
	echo "</table>";
	}
	
echo "<BR>";
mysql_close($connection);
} else {
echo "<script language=\"javascript\">";
echo "window.location=\"viewall.php?p=0\";";
echo "</script>";
}
?>