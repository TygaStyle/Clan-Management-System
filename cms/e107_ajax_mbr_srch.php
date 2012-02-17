<?
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
require("functions/functions.php");
if(isset($_GET['n'])) {
					
					$asql = "SELECT * FROM `mbrlist` WHERE `name` LIKE '%".str_replace("+", " ", $_GET['n'])."%' AND `visable` = '0' ORDER BY `name` LIMIT 0,7";
					$aresult = mysql_query($asql);
					echo "<table border=0 cellspacing=0 width=100% height=100% cellpadding=0 align=center>";
					if(mysql_num_rows($aresult) > 0) {
					while($row = mysql_fetch_assoc($aresult)) {
						echo "<tr><td valign=top><a href=http://www.rdghq.com/roster/index.php?db=fpr&i=".$row['id']." target=_blank>".$row['name']."</a></td></tr>";
					}
				
					echo "<tr><td height=100% valign=bottom align=center><input name='uu' type='hidden' id='uu' value='".str_replace("+", " ", $_GET['n'])."' /><input name=subs type=Submit id=subs value='More' class=button /></td></tr>";
					} else {
					echo "<tr><td height=100% valign=bottom>No Results</td></tr>";
					}
					echo "</table>";
} else {
echo "n/a";
}
?>