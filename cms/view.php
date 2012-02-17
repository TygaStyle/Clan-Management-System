<?php
session_start();
##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
require("../functions/functions.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
//secure the page
if(isset($_SESSION['id']) && isset($_SESSION['selectid'])) {
if(isset($_GET['t'])) {

//retrieve member list unformatted
$mbrs = array();
$f_mbr_list = array();
$sql = mysql_query("SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0' ORDER BY `rank` DESC");
while($row = mysql_fetch_assoc($sql)) {
	// insert into array in RANK as array id
	$mbrs[$row['rank']][$row['name']] = array("id" => $row['id'], "addid" => $row['addid'], "bgcheck" => $row['bgcheck'], "date" => $row['date'], "gametype" => $row['gametype'], "des" => $row['des']);
}
foreach($mbrs as $rank=>$name) {// split up 2d array
	ksort($name, SORT_REGULAR); // sort names alphabetically
	$f_mbr_list[$rank] = $name;
}
$beg_tab = "<table cellpadding=0 cellspacing=0 border=0 width=390 height=100%  style=\"background-color: #ffffff\">"; // beginning of table properties of row
$end_tab = "</table>"; // ending of table properties of row

	if($_GET['t'] == 1) { //view
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=70 align=right><td width=100 align=left>".$content['gametype']."</td><td width=90 align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	} elseif($_GET['t'] == 2) { // add members
		echo "<form><table border=0 style=\"background-color: #e0e0e0\" width=100%>";
		echo "<tr><td>Gamertag: <input name='name' type='text' id='name' size='20' maxlength='15' class='forms' /></td>";
		echo "<td align=right><input type='button' name='Button' value='Insert Name' class='forms' onClick=\"addname()\" /><br /></td></tr>";
		echo "<tr><td><select name='rank' class='forms' id='rank'>";
		$ranks_r = range(1, 27);
		$ranks_count = 0;
		if($_SESSION['selectid'] == 345) {
			foreach($ranks_r as $item) {
				echo "<option value='".$item."'>".getRank($item)."</option>";
			}
		} else {
			foreach($ranks_r as $item) {
				++$ranks_count;
				if($ranks_count >= 27) {
					break;
				}
				echo "<option value='".$item."'>".getRank($item)."</option>";
			}
		}
		echo "</select></td><td align=right><input type='reset' name='Reset' value='Reset Form' class='forms' /></td></tr></table></form>";
		echo "<BR>Have more suggestions? Email me at <a href=mailto:mparmyman1984@hotmail.com.com>mparmyman1984@hotmail.com</a>";
	} elseif($_GET['t'] == 3) { // remove members
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=70 align=right><td width=100 align=right><a onClick=\"setTimeout('openpage(\'3\')', 700)\" href=\"javascript: changeinfo('32&id=".$content['id']."')\">Remove</a></td><td width=90 align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	} elseif($_GET['t'] == 4) { // preferences
	echo "<table cellpadding=1 cellpadding=1 width=100% border=0>"; 
	echo "<tr><td height=20>Lock Squad (lv4+)</td><td>";
	if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		echo "<select id=secure name=secure onChange='secure()'>";
	} else {
		echo "<select id=secure name=secure disabled=disabled>";
	}
	$optionsgg = array("1" => "Unlock", "2" => "Lock");
	$check_options = mysql_query("SELECT * FROM `squads` WHERE `id` = '".$_SESSION['selectid']."'");
	$check_options_r = mysql_fetch_row($check_options);
	foreach($optionsgg as $num=>$name) {
		if($num == $check_options_r[7]) {
	 		echo "<option value=".$num." selected=selected>".$name."</option>";
		} else {
			echo "<option value=".$num.">".$name."</option>";
		}
	}
	unset($optionsgg);
	echo "</select>";
 	echo "</td></tr>";
	echo "<tr><td height=20>Maximum Members (lv3+)</td><td>";
	if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
		echo "<select id=max name=max onChange='maxlen()'>";
	} else {
		echo "<select id=max name=max disabled=disabled>";
	}
	$options = array(20, 40, 60, 80, 100, 125, 150);
	foreach($options as $num) {
		if($num == $check_options_r[6]) {
	 		echo "<option value=".$num." selected=selected>".$num."</option>";
		} else {
			echo "<option value=".$num.">".$num."</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";
	//echo "<tr><td height=20>Allow Multiple Sessions</td><td><i>Enabled</i></td></tr>";
	echo "</table>";
	} elseif($_GET['t'] == 5) { // edit gametype
	$form_count = 0;
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$games = array("Halo: Reach", "Call of Duty: Black Ops", "Call of Duty: Modern Warfare 2", "Card Player");
				$options = "";
				foreach($games as $items) {
					if($content['gametype'] == $items) {
						$options = $options."<option value='".$items."' selected='selected'>".$items."</option>";
					} else {
						$options = $options."<option value='".$items."'>".$items."</option>";
					}
				}
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=70 align=right><td width=100 align=right><select name='ccranks".++$form_count."' id='ccranks".$form_count."' class=forms onChange=\"editname('".$content['id']."', '".$form_count."')\">".$options."</select></td><td width=90 align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	} elseif($_GET['t'] == 6) { // bgchecking
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=70 align=right><a href=\"javascript:popUp('bgchecker/?u=".$content['id']."&c=1', 500, 500)\">H2O</a><td width=100 align=right>".bgcode($content['bgcheck'])."</td><td width=90 align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	} elseif($_GET['t'] == 7) { // squad log files
		$asql = "SELECT * FROM `squadlogs` WHERE `userid` = '".$_SESSION['selectid']."' ORDER BY `id` DESC LIMIT 0,200";
		$aresult = mysql_query($asql);
		echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'e0e0e0')\" onMouseout=\"changeback(event, 'ffffff')\">";
		echo "<tr id=ignore><td colspan=3 style=\"background-color: #e0e0e0\"><b>Current Logs</b></td></tr>";
		while($row = mysql_fetch_assoc($aresult)) {
			echo "<tr><td align=left width=121>[<b><font size=1>".dataRetrieve($row['uid'], "username")."</font></b>]<BR><b><font size=1 color=999999>[Level ".$row['ip']."]</font></b></td><td align=left><font size=1>".$row['action']."</font><BR><font size=1 color=999999>".$row['time']." MT</font></td><td width=75 align=right><font size=1>".$row['date']."</font></td></tr>";
		}
		echo "</table><BR>";
	} elseif($_GET['t'] == 8) { // edit rank
	$form_count = 0;
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$games = range(1, 27);
				$options = "";
				foreach($games as $items) {
					if($_SESSION['selectid'] != 345) {
						if($items >= 27) {
							break;
						}
					}
					if($rank == $items) {
						$options = $options."<option value='".$items."' selected='selected'>".getRank($items)."</option>";
					} else {
						$options = $options."<option value='".$items."'>".getRank($items)."</option>";
					}
				}
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=180 align=right><select name='ranks".++$form_count."' id='ranks".$form_count."' class=forms onChange=\"editrank('".$content['id']."', '".$form_count."')\">".$options."</select></td><td width=90 align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	} elseif($_GET['t'] == 9) {
	echo "<table cellpadding=0 cellspacing=0 border=0 width=390>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width=100%><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$final_output = $beg_tab."<tr><td width=130>".$name."</td><td width=10 align=right><td width=10 align=right></td><td width=240 align=left><input maxlength=250 type=text name=kk".$content['id']." id=kk".$content['id']." class=forms value='".$content['des']."'><input type=submit onClick='altdes(".$content['id'].")' name=s".$content['id']." id=s".$content['id']." class=forms value=Save></td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
	echo "</table>";
	} else {
		echo "No Page Exists";
	}
} elseif(isset($_GET['c'])) { // post-coding
	if(isset($_GET['i'])) {// check type of post
		if($_GET['i'] == 32) {// more checking
			if(isset($_GET['id'])) { // check for valid id
				$sql = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$_GET['id']."' AND `visable` = '0'");
				if(mysql_num_rows($sql) == 1) {
					mysql_query("UPDATE `mbrlist` SET `visable` = '1', `date` = '".date("m/d/y")."' WHERE `id` = '".$_GET['id']."' AND `sid` = '".$_SESSION['selectid']."'");
					logfile($_SESSION['id'], "Deleted <u>".mbrlistname($_GET['id'])."</u> from ".getSquad($_SESSION['selectid']));
					logsquadfile($_SESSION['selectid'], $_SESSION['id'], "Deleted <u>".mbrlistname($_GET['id'])."</u> from ".getSquad($_SESSION['selectid']));
					echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
					echo "<tr><td bgcolor=616161>Last Action</td></tr>";
					echo "<tr><td style=\"font-size: 10px\"><u>".mbrlistname($_GET['id'])."</u> was successfully removed from the squad.</td></tr>";
					echo "</table>";
				}
			}
		} elseif($_GET['i'] == 40) {
			if(isset($_GET['m'])) {
				mysql_query("UPDATE `squads` SET `max` = '".$_GET['m']."' WHERE `id` = '".$_SESSION['selectid']."'");
				logfile($_SESSION['id'], "Set max to ".$_GET['m']." in ".getSquad($_SESSION['selectid']));
				logsquadfile($_SESSION['selectid'], $_SESSION['id'], "Set max to ".$_GET['m']." in ".getSquad($_SESSION['selectid']));
				echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
				echo "<tr><td bgcolor=616161>Last Action</td></tr>";
				echo "<tr><td style=\"font-size: 10px\">Successfully able to change the maximum members to ".$_GET['m'].".</td></tr>";
				echo "</table>";
			}
		} elseif($_GET['i'] == 49) {
			if(isset($_GET['m']) && isset($_GET['id'])) {
				if(empty($_GET['m'])) {
				$fixed = "n/a";
				} else {
				$fixed = cleanInput($_GET['m']);
				}
				mysql_query("UPDATE `mbrlist` SET `des` = '".$fixed."' WHERE `id` = '".$_GET['id']."'");
				logfile($_SESSION['id'], "Changed description on ".mbrlistname($_GET['id']));
				logsquadfile($_SESSION['selectid'], $_SESSION['id'], "Changed description on ".mbrlistname($_GET['id']));
				echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
				echo "<tr><td bgcolor=616161>Last Action</td></tr>";
				echo "<tr><td style=\"font-size: 10px\">Successfully changed the description.</td></tr>";
				echo "</table>";
			}
		} elseif($_GET['i'] == 41) {
			if(isset($_GET['lock'])) {
				mysql_query("UPDATE `squads` SET `secure` = '".$_GET['lock']."' WHERE `id` = '".$_SESSION['selectid']."'");
				if($_GET['lock'] == 1) {
					$final_lock = "Unlocked";
				} else {
					$final_lock = "Locked";
				}
				logfile($_SESSION['id'], $final_lock." ".getSquad($_SESSION['selectid']));
				logsquadfile($_SESSION['selectid'], $_SESSION['id'], $final_lock." ".getSquad($_SESSION['selectid']));
				echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
				echo "<tr><td bgcolor=616161>Last Action</td></tr>";
				echo "<tr><td style=\"font-size: 10px\">".getSquad($_SESSION['selectid'])." was successfully ".$final_lock.".</td></tr>";
				echo "</table>";
			}
		} elseif($_GET['i'] == 34) {
			if(isset($_GET['id']) && isset($_GET['to'])) {
				mysql_query("UPDATE `mbrlist` SET `gametype` = '".$_GET['to']."' WHERE `id` = '".$_GET['id']."'");
				echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
				echo "<tr><td bgcolor=616161>Last Action</td></tr>";
				echo "<tr><td style=\"font-size: 10px\"><u>".mbrlistname($_GET['id'])."</u> was successfully changed to the game type of <u>".$_GET['to']."</u>.</td></tr>";
				echo "</table>";
			}
		} elseif($_GET['i'] == 39) {
			if(isset($_GET['id']) && isset($_GET['to'])) {
				$name_id = mbrlistname($_GET['id']);
				$rank_id = getRank($_GET['to']);
				logfile($_SESSION['id'], "Set ".$name_id." to ".$rank_id);
				logsquadfile($_SESSION['selectid'], $_SESSION['id'], "Set ".$name_id." to ".$rank_id);
				mysql_query("UPDATE `mbrlist` SET `rank` = '".$_GET['to']."' WHERE `id` = '".$_GET['id']."'");
				echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
				echo "<tr><td bgcolor=616161>Last Action</td></tr>";
				echo "<tr><td style=\"font-size: 10px\"><u>".$name_id."</u> was successfully changed to the rank of <u>".$rank_id."</u>.</td></tr>";
				echo "</table>";
			}
		} elseif($_GET['i'] == 33) {
			if(isset($_GET['name']) && isset($_GET['rank'])) {
				$addname = cleanInput(str_replace("+", " ", $_GET['name']));
				$as_result = mysql_query("SELECT * FROM `mbrlist` WHERE `name` = '".$addname."' AND `visable` = '0'");
					if(mysql_num_rows($as_result) == 0) {
					$as_resultz = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$addname."'");
						if(mysql_num_rows($as_resultz) == 0) {
							if(empty($addname)) {
								echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #FF0000\">";
								echo "<tr><td bgcolor=FF0000>Last Action</td></tr>";
								echo "<tr><td style=\"font-size: 10px\">Name field was empty, cannot insert.</td></tr>";
								echo "</table>";
							} else {
							$squad_specr = mysql_query("SELECT * FROM `squads` WHERE `id` = '".$_SESSION['selectid']."'");
							$squad_spec = mysql_fetch_row($squad_specr);
								if(squadcount($_SESSION['selectid']) < $squad_spec[6]) {
									if($squad_spec[7] == 2) {
										echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #FF0000\">";
										echo "<tr><td bgcolor=FF0000>Last Action</td></tr>";
										echo "<tr><td style=\"font-size: 10px\">Squad is currently locked.</td></tr>";
										echo "</table>";
									} else {
										logfile($_SESSION['id'], "Added <u>".$addname."</u> to squad ".getSquad($_SESSION['selectid']));
										logsquadfile($_SESSION['selectid'], $_SESSION['id'], "Added <u>".$addname."</u> to squad ".getSquad($_SESSION['selectid']));
										mysql_query("INSERT INTO `mbrlist` (`name`, `sid`, `addid`, `bgcheck`, `rank`, `date`) VALUES ('".$addname."', '".$_SESSION['selectid']."', '".$_SESSION['id']."', '0', '".$_GET['rank']."', '".date("m/d/y")."')");
										echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #616161\">";
										echo "<tr><td bgcolor=616161>Last Action</td></tr>";
										echo "<tr><td style=\"font-size: 10px\"><u>".$addname."</u> was successfully added from the squad.</td></tr>";
										echo "</table>";
									}
								} else {
								echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #FF0000\">";
								echo "<tr><td bgcolor=FF0000>Last Action</td></tr>";
								echo "<tr><td style=\"font-size: 10px\">Squad has reached maximum amount.</td></tr>";
								echo "</table>";
								}
								/*echo "<script language=javascript>alert(\"User Added\");</script>";*/
							}
						} else {
							echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #FF0000\">";
							echo "<tr><td bgcolor=FF0000>Last Action</td></tr>";
							echo "<tr><td style=\"font-size: 10px\"><u>".$addname."</u> is <b>blacklisted</b>, remove him from your clan!</td></tr>";
							echo "</table>";
						}
					} else {
						echo "<table cellspacing=0 cellpadding=1 width=100% border=0 style=\"border: solid 1px #FF0000\">";
						echo "<tr><td bgcolor=FF0000>Last Action</td></tr>";
						echo "<tr><td style=\"font-size: 10px\"><u>".$addname."</u> already exists in are database. If you wish to find that user, go on the bottom left hand side of the website and type in the user's name in the search box.</td></tr>";
						echo "</table>";
					}
			}
		}
	}
} else {
	echo "No Page Exists";
}

} else {
// unwanted access
echo "<h3>Restricted Area</h3><hr>You have stumbled upon a page that denies your entrance.";
}

?>