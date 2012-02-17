<?php
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
require("functions/functions.php");
		echo "<div style=\"text-align: left;\" align=\"left\"><table cellpadding=0 cellspacing=0 border=0 width=100% style='color: #FFFFFF;'>";
		$newrow = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
		echo "<tr><td style='font-size: 12px'>Total RD:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow)."</b></td></tr>";
		$newrow5 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Halo: Reach'");
		echo "<tr><td style='font-size: 12px'>Reach:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow5)."</b></td></tr>";
		$newrow6 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Call of Duty: Black Ops'");
		echo "<tr><td style='font-size: 12px'>Black Ops:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow6)."</b></td></tr>";
		$newrow61 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Call of Duty: Modern Warfare 2'");
		echo "<tr><td style='font-size: 12px'>MW2:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow61)."</b></td></tr>";
		$newrow64 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Card Player'");
		echo "<tr><td style='font-size: 12px'>Card Players:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow64)."</b></td></tr>";
		$newrow2 = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0'");
		echo "<tr><td style='font-size: 12px'>Squads:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow2)."</b></td></tr>";
		$newrow3 = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0'");
		echo "<tr><td style='font-size: 12px'>Divisions:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow3)."</b></td></tr>";
		$newrow4 = mysql_query("SELECT * FROM `blklist`");
		echo "<tr><td style='font-size: 12px'>Blacklist:</td><td style='font-size: 12px'><b>".mysql_num_rows($newrow4)."</b></td></tr>";
		echo "<tr><td height=50 valign=bottom colspan=2 style='font-size: 12px'>";
		$last_member = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = 0 ORDER BY `id` DESC LIMIT 0,1");
		$s_row = mysql_fetch_row($last_member);
		echo "<u>Newest Member</u><BR>";
		echo $s_row[1]."<BR>";
		echo "[".$s_row[7]."]";
		echo "</td></tr>";
		echo "</table></div>";
?>