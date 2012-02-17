<?
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
require("functions/functions.php");
if(isset($_GET['n'])) {
					
					$asql = "SELECT * FROM `mbrlist` WHERE `name` LIKE '%".str_replace("+", " ", $_GET['n'])."%' AND `visable` = '0' ORDER BY `name` LIMIT 0,14";
					$aresult = mysql_query($asql);
					echo "<table border=0 cellspacing=0 width=100% height=100% cellpadding=0 align=center class=tablexx>";
					if(mysql_num_rows($aresult) > 0) {
					while($row = mysql_fetch_assoc($aresult)) {
					$list[$row['id']] = $row['name'];
					}
					$count = 0;
					foreach($list as $id=>$name) {
						++$count;
						if($count > 7) {
							$newlist[1][$id] = $name;
						} else {
							$newlist[0][$id] = $name;
						}
					}
					echo "<tr><td valign=top>";
						echo "<table border=0 cellspacing=0 width=100% height=100% cellpadding=0 align=center>";
						foreach($newlist[0] as $id=>$name) {
							echo "<tr><td valign=top><a href=index.php?db=fpr&i=".$id.">".$name."</a></td></tr>";
						}
						echo "</table>";
					echo "</td><td valign=top>";
						echo "<table border=0 cellspacing=0 width=100% height=100% cellpadding=0 align=center>";
						foreach($newlist[1] as $id=>$name) {
							echo "<tr><td valign=top><a href=index.php?db=fpr&i=".$id.">".$name."</a></td></tr>";
						}
						echo "</table>";
					echo "</td></tr>";
					echo "<tr><td height=100% valign=bottom colspan=2 align=center><input name='uu' type='hidden' id='uu' value='".str_replace("+", " ", $_GET['n'])."' /><input name=subs type=Submit id=subs value='View more results' class=forms /></td></tr>";
					} else {
					echo "<tr><td height=100% valign=bottom colspan=2>No Results</td></tr>";
					}
					echo "</table>";
} else {
echo "n/a";
}
?>