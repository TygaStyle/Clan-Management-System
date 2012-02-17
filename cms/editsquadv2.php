<?php
if(isset($_SESSION['selectid']) && getSquadvv($_SESSION['selectid']) == 0) {
	if(isset($_GET['i'])) {
		echo "<table cellpadding=0 cellspacing0 border=0 width=520>";
		echo "<tr><td colspan=2><img src='images/squadv2pic.php?d=".str_replace(" ", "+", getDiviNAME($_SESSION['selectid']))."&ds=".str_replace(" ", "+", getDiviAL($_SESSION['selectid']))."&s=".str_replace(" ", "+", getSquad($_SESSION['selectid']))."'></td></tr>";
		echo "<tr><td valign=top style='border-right: solid 1px #161616'><table cellpadding=0 cellspacing=0 border=0 width=100%>";
		echo "<tr><td height=17 width=130><a href=\"javascript: openpage('1')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">View List</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('2')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Add Member</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('3')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Remove Members</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('5')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Edit Gametype</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('8')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Edit Rank</a></td></tr>";
		//echo "<tr><td height=17><a href=\"javascript: openpage('6')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Halo 2 BG</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('7')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Squad Logs</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('9')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Descriptions</a></td></tr>";
		echo "<tr><td height=17><a href=\"javascript: openpage('4')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Preferences</a></td></tr>";
		//echo "<tr><td height=17><a href=\"downgrade.php?y\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Downgrade</a></td></tr>";
		//echo "<tr><td height=17><a href=\"javascript: openpage('9')\" style=\"text-decoration: none;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\">Complete</a></td></tr>";
		echo "<tr><td><BR><div name=stat id=stat><script language=javascript type=text/javascript>statupdate()</script></div></td></tr>";
		echo "<tr><td><BR><div name=infos id=infos></div></td></tr>";
		echo "</table>";
		echo "</td><td valign=top width=390 style='padding-left: 2px;'>";
		echo "<table cellpadding=0 border=0 cellspacing=0 width=390><tr><td valign=top>";
		echo "<div id=1221 name=1221><script language=javascript type=text/javascript>openpage('1')</script></div>";
		echo "</td></tr></table>";
		echo "</td></tr>";
		echo "</table>";
	}
}
?>
