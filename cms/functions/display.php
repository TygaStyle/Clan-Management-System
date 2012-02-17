<?
error_reporting(E_ALL);
ini_set('display_errors', '1');
//member links
function return_menu() {
	if(isset($_SESSION['id'])) {
		$aar[] = "My_Clans-myclans-index.php?db=myclans";
		$aar[] = "Settings-settings-index.php?db=cpsettings";
		$aar[] = "My_Logs-mylogs-index.php?db=cpmylogfile";
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
		$aar[] = "Division Codes-codes-index.php?db=divicodelist";
		}
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
		$aar[] = "Request_List-requestlist-index.php?db=request";
		$aar[] = "Add_Squad-addsquad-index.php?db=addsquad";
		$aar[] = "Delete_Squad-delsquad-index.php?db=delsquad";
		}
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		$aar[] = "Add_Division-adddivision-index.php?db=adddiv";
		$aar[] = "Delete_Division-deldivision-index.php?db=deldiv";
		$aar[] = "Permissions-permissions-index.php?db=permissions";
		$aar[] = "Black_List-blacklist-index.php?db=cpblk";
		$aar[] = "Codes-codes-index.php?db=codegen";
		$aar[] = "Leaders_List-leaderslist-index.php?db=securitycheck&divi=0&sss=345";
		/*$aar[] = "Admin_List-adminlist-index.php?db=securitycheck&divi=0&sss=346";*/
		$aar[] = "Division_Transfer-dt-index.php?db=dt";
		}
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 5) {
		$aar[] = "Admin_Panel-admin-index.php?db=adminsettings";
		}
		$aar[] = "Logout-logout-logout.php";
		return $aar;
	}
}


function panel() {
	if(!isset($_SESSION['id'])) {
	echo "<form name='form1' method='post' action='login.php'>";
	echo "<input name='username' id='username' type='text' onFocus=\"this.value=''\" maxlength='17' value='Username' size=22>";
	echo "<BR>";
	echo "<input type='password' name='password' onFocus=\"this.value=''\" id='password' value='Password' size=22><BR> ";
	echo "<input type=submit value=Login class=forms><BR><center><font size=1><a href=changepassword.php style=\"color:ffffff\">Forgot Password?</a></font></center></form>";
	} else {
	
	
	echo "<table cellpadding=0 cellspacing=0 border=0 class=forms width=150>";
	$colorstyle = dataRetrieve($_SESSION['id'], "colorcode");
	$name = dataRetrieve($_SESSION['id'], "username");
	echo "<tr><td><b>".colorname($name, $colorstyle)."</b></td></tr>";
	//echo "<tr><td align=center colspan=2 onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu5, '150px')\" onMouseout=\"delayhidemenu()\"><font size=1>M e n u</font></td></tr>";
	echo "</table>";
	}
}

function navigation() {
echo "<font size=2><a href=index.php style=\"color:dfdfdf\">Home</a> | <a style=\"color:dfdfdf\" href=# onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu1, '200px')\" onMouseout=\"delayhidemenu()\">Clans</a>  | <a href=# style=\"color:dfdfdf\" onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu2, '150px')\" onMouseout=\"delayhidemenu()\">RD Members</a> | <a style=\"color:dfdfdf\" href=index.php?db=al>Access List</a> | <a href=index.php?db=register style=\"color:dfdfdf\">Register</a>".
" | <a href=# style=\"color:dfdfdf\" onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu6, '150px')\" onMouseout=\"delayhidemenu()\">Black List</a>  | <a href=# style=\"color:dfdfdf\" onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu3, '150px')\" onMouseout=\"delayhidemenu()\">Help</a>  | <a style=\"color:dfdfdf\" href=# onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu4, '150px')\" onMouseout=\"delayhidemenu()\">Links</a></font>";
}

function main() {####MAIN (MIDDLE)


if(isset($_GET['db'])) {

	if($_GET['db'] == "error") {// error page
	echo "<div class=\"center_header\">";
	echo "Error Feedback";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		if(!isset($_SESSION['error'])) {
			echo "Error has been terminated and problem have already been displayed to you.<BR>This page will only show information when an error is occured. <BR><BR>Remember, this is an error page; if there is no error, nothing will be displayed so stop going to this link.";
		} else {
			echo "An error has occured during the action you have executed. Please read the box below for information on what the error was and how it can be fixed. There is an option to report the error to the admins (aka A GENERAL JUST) below. Any spam, inappropriate messages, or hate letters will be terminated and your IP will get banned until further notice.<BR>";
			data_errors($_SESSION['error']);
			unset($_SESSION['error']);
			echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
			echo "<BR><center><INPUT TYPE=\"BUTTON\" VALUE=\"Report Error in Secured Environment\" ONCLICK=\"window.location.href='index.php?db=report'\" class=formsxx></center><BR>";
			echo "</tr></td></table><BR>";
			echo "Reference:<BR> - <a href=http://www.clanblackops.co.cc/forum target=_blank>Ask for assistance on the forums</a>";
		}
	echo "</div></div>";
	} elseif($_GET['db'] == "fpr" && isset($_GET['i'])) {
			echo "<div class=\"center_header\">";
			echo "Search RD Member";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			$results = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".cleanInput(str_replace("'", "", $_GET['i']))."' AND `visable` = '0'");
				if(mysql_num_rows($results) == 0 || empty($_GET['i'])) {
					echo "<b>No Results Found</b>";
				} else {
					echo "<BR><table cellpadding=0 cellspacing=0 border=0 class=tablexx width=400 align=center>";
						while($rows = mysql_fetch_assoc($results)) {
							echo "<tr><td width=400 align=center colspan=2 bgcolor=E0E0E0><b>".$rows['name']."</b></td></tr>";
							echo "<tr><td width=200>Location</td><td width=200 align=right>".getDiviAL($rows['sid'])." - ".getSquad($rows['sid'])."</td></tr>";
							echo "<tr><td width=200>Rank</td><td width=200 align=right>".getRank($rows['rank'])."</td></tr>";
							echo "<tr><td width=200>Added by</td><td width=200 align=right>".dataRetrieve($rows['addid'], "username")."</td></tr>";
							echo "<tr><td width=200>Background Check</td><td width=200 align=right>".bgcode($rows['bgcheck'])."</td></tr>";
							echo "<tr><td width=200>Added on</td><td width=200 align=right>".$rows['date']."</td></tr>";
						}
					echo "</table><BR>";
				}
			echo "</div></div>";
	} elseif($_GET['db'] == "sg") {
		if(isset($_POST['uu'])) {
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=sg&n=".str_replace(" ", "+", cleanInput(str_replace("'", "", $_POST['uu'])))."&p=0\";";
			echo "</script>";
		} elseif(isset($_GET['n'])) {
			if($_GET['n'] == "") {
				echo "<script language=\"javascript\">";
				echo "window.location=\"index.php?db=sg&n=ksi+se7en+7&p=0\";";
				echo "</script>";
			}
		}
			echo "<div class=\"center_header\">";
			echo "Search RD Member";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			if(isset($_GET['p'])) {
						if($_GET['p'] == 0) {
						$limnum = 0;
						} else {
						$limnum = $_GET['p'] * 200;
						}	
					$rowresult = mysql_query("SELECT * FROM `mbrlist` WHERE `name` LIKE '%".str_replace("+", " ", $_GET['n'])."%' AND `visable` = '0'");
					$rownum = mysql_num_rows($rowresult);
					$pagecount = 0;
					echo "<u>Page Numbers</u><BR>";
						while($rownum > 0) {
						if($_GET['p'] == $pagecount) {
						echo "<b>".($pagecount + 1)."</b> ";
						} else {
						if(isset($_GET['n'])) {
						echo "<a href=index.php?db=sg&n=".$_GET['n']."&p=".$pagecount."><font size=1>".($pagecount + 1)."</font></a> ";
						}
						}
						++$pagecount;
						$rownum = $rownum - 200;
						}
					if(isset($_GET['n'])) {
					$asql = "SELECT * FROM `mbrlist` WHERE `name` LIKE '%".str_replace("+", " ", $_GET['n'])."%' AND `visable` = '0' ORDER BY `name` LIMIT ".$limnum.",200";
					}
					$aresult = mysql_query($asql);
					echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
					if(mysql_num_rows($aresult) > 0) {
					while($row = mysql_fetch_assoc($aresult)) {
					echo "<tr><td><a href=index.php?db=fpr&i=".$row['id'].">".$row['name']."</a></td><td>".$row['gametype']."</td></tr>";
					}
					} else {
					echo "No Results";
					}
					echo "</table><BR>";
				}
			echo "</div></div>";
		
	} elseif($_GET['db'] == "sc") {
	echo "<div class=\"center_header\">";
	echo "Contest";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	echo "<table cellpadding=0 cellspacing=0 border=0 width=400><tr bgcolor=E0E0E0><td>Name</td><td>Percent Full</td><td>Timestamp</td><td>By User</td></tr>";
	
	echo "</div></div>";
	} elseif($_GET['db'] == "register") {
	echo "<div class=\"center_header\">";
	echo "Register";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	include("register.php");
	if(!isset($_POST['username'])) {
	echo "<form id='form1' name='form1' method='post' action='#' onSubmit=\"submitonce(this);\">";
	echo "<table width='430' height='438' border='0' cellpadding='0' cellspacing='0' align=center>";
	echo "<tr>";
	echo "<td width='199'><b>Xbox Live Gamertag</b></td>";
	echo "<td width='231'><div align='right'>";
	echo "<input name='username' type='text' id='username' size='30' maxlength='17' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Password</td>";
	echo "<td><div align='right'>";
	echo "<input name='password' type='password' id='password' size='30' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Retype Password </td>";
	echo "<td><div align='right'>";
	echo "<input name='repassword' type='password' id='repassword' size='30' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Email</td>";
	echo "<td><div align='right'>";
	echo "<input name='email' id='email' type='text' size='30' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Retype Email </td>";
	echo "<td><div align='right'>";
	echo "<input name='reemail' id='reemail' type='text' size='30' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Squad Control </td>";
	echo "<td><div align='right'>";
	echo "<select name='squad' id='squad' class=forms>";
	echo "<option value='0'>--Select Squad--</option>";
	$dbsql = "SELECT * FROM `squads` WHERE `visable` = '0' ORDER BY `divisionid`";
	$dbresult = mysql_query($dbsql);
	while($dbrow = mysql_fetch_assoc($dbresult)) {
		if($dbrow['divisionid'] == 37) {//blocking leaderlist
		} else {
			echo "<option value='".$dbrow['id']."'>".divi($dbrow['divisionid'])." - ".$dbrow['squadname']."</option>";
		}
	}
	echo "</select>";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Multiple Squads </td>";
	echo "<td><div align='right'>";
	echo "<input name='moresquad' type='checkbox' id='moresquad' value='checkbox' />";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'><div align='center'>Code";
	echo "<br />";
	echo "<input name='code' type='text' size='30' maxlength='30' class=forms />";
	echo "</div>";
	echo "<div align='right'></div></td>";
	echo "</tr>";
	echo "<tr>";
	$filename = "codeofconduct.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	echo "<td colspan='2'><div align='center'><textarea name='agreeform' id='agreeform' cols='40' rows='5' class=forms>".$contents."</textarea><BR>Agree to the RD Code of Conduct ";
	echo "<input type='checkbox' name='agreecheck' id='agreecheck' value='checkbox' class=forms>";
	echo "</div></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='2'><div align='center'>";
	echo "<input type='submit' name='Submit' value='Register' class=forms />";
	echo "</div></td>";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
	}
	echo "</div></div>";
	} elseif($_GET['db'] == "help") {// help page
	echo "<div class=\"center_header\">";
	echo "Help";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	if(isset($_GET['dm'])) {
		if($_GET['dm'] == "1") {
		echo "<p align=\"center\"><b>Registration Help</b></p>";
		echo "<p>-Click the registration tab on the top of RD clan</p>";
		echo "<center><img src=images/reg1.jpg></center>";
		echo "<p>-Type in your Xbox Live Gamer tag so that the administrators  know who you are</p>";
		echo "<p>-Make a password for your account then retype your password</p>";
		echo "<p>-Type in your email address (yahoo, hotmail, etc.) then  retype your email address</p>";
		echo "<p>-Find the squad that you are doing a squad list for on the  list. IMPORTANT: if you are doing multiple clans, first you have to click on  any clan in your division THEN check the mark for multiple squads. Also checking the mark for multiple squads just tells the  administrator that you want more than one squad. This does not tell them you  are that division&rsquo;s clan leader.</p>";
		echo "<center><img src=images/reg2.jpg></center>";
		echo "<p>-Type in the code you got from  your leader. Make sure you have every number or letter right or it will not  work.</p>";
		echo "<p>-Finally, read and accept the RD  Code of Conduct</p>";
		echo "<center><img src=images/reg3.jpg></center>";
		} elseif($_GET['dm'] == "2") {
		echo "<p align='left'>Squadlists Help </p><div align='left'>First you must be logged into your RD clan account Then click on the tab in the top left corner of the  page called &ldquo;Menu&rdquo;</div><p><center><img width='165' height='77' src='images/clip_image002_0000.jpg'></center><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><div align='left'>Then on the menu that drops down click on the button  titled &ldquo;My Clans&rdquo;</div><p align='left'><center><img width='281' height='140' src='images/clip_image004_0000.jpg'></center></p><div align='left'>Then click on your division and then your clan</div><p align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp;&nbsp; Then click on &ldquo;Edit&rdquo;</p><p align='left'><center><img width='236' height='15' src='images/clip_image006_0000.jpg'></center></p><div align='left'>Then type the gamertag of the player you wish to add,  select their rank, and click &ldquo;Add to Squad&rdquo;</div><p align='left'><center><img src='images/clip_image008_0000.jpg'></center></p><p align='left'>-Continue to do the previous last step until your entire squad is on the list</p>";
		} elseif($_GET['dm'] == "4") {
		echo "<center><h3>About</h3></center>";
		echo "<BR><b>Master Coder:</b> KSI ViceCaptain (Matt Lo)<BR><BR><b>Background Check Program:</b> KSI ViceCaptain<BR><BR><b>Black List Details:</b> KSI Spider 7<BR><BR><b>Website Analyst:</b> KSI Legacy<BR><BR><b>Beta and Delta Tester:</b> KSI Kill Steal<BR><BR><b>Help Section:</b> KSI Elderpooter and KSI Cold 7<BR><BR>Contact KSI ViceCaptain through the forums as a PM (Private Message) or through the chat box.<BR><BR><B>All gamertags are used as identification to hide their real names.</B>";
		} elseif($_GET['dm'] == "5") {
		echo "<center><h3>Access Levels</h3></center>";
		echo "<table cellpadding=0 cellspacing=0 border=1 border=95% bordercolor=E0E0E0>";
		echo "<tr><td><img src=images/lv0.jpg></td><td>Access to ONLY 1 squad.</td></tr>";
		echo "<tr><td><img src=images/lv1.jpg></td><td>Access to UP TO 2 squads.</td></tr>";
		echo "<tr><td><img src=images/lv2.jpg></td><td>Access to UP TO 3 squads.</td></tr>";
		echo "<tr><td><img src=images/lv3.jpg></td><td>Access to the entire division, including in giving codes, and controlling the squads (adding or deleting).</td></tr>";
		echo "<tr><td><img src=images/lv4.jpg></td><td>Access to the all divisions, able to generate new codes, able to change the leaders list, able to manage the entire blacklist, and able to approve/disapprove halo 2 background pending checks.</td></tr>";
		echo "<tr><td><img src=images/lv5.jpg></td><td>Controls every you do with the access to the entire website (Concidered to be as admin of this website).</td></tr>";
		echo "</table>";
		} else {
			$find_andrew = mysql_query("SELECT * FROM `mbrlist` WHERE `gametype` = 'Halo 3' AND `visable` = '0'");
			while($row = mysql_fetch_assoc($find_andrew)) {
				echo $row['name']."<BR>";
			}
		}
	} else {
	$_SESSION['error'] = 2;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	}
	echo "</div></div>";
	} elseif($_GET['db'] == "RDmembers") {// blk list page
	echo "<div class=\"center_header\">";
	echo "RD Members";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	
//retrieve member list unformatted
$mbrs = array();
$f_mbr_list = array();
$sql = mysql_query("SELECT * FROM `mbrlist` WHERE `sid` = '345' AND `visable` = '0' ORDER BY `rank` DESC");
while($row = mysql_fetch_assoc($sql)) {
	// insert into array in RANK as array id
	$mbrs[$row['rank']][$row['name']] = array("id" => $row['id'], "addid" => $row['addid'], "bgcheck" => $row['bgcheck'], "date" => $row['date'], "gametype" => $row['gametype'], "des" => $row['des']);
}
foreach($mbrs as $rank=>$name) {// split up 2d array
	ksort($name, SORT_REGULAR); // sort names alphabetically
	$f_mbr_list[$rank] = $name;
}
$beg_tab = "<table cellpadding=0 cellspacing=0 border=0 width='100%' height=100%  style=\"background-color: #ffffff\">"; // beginning of table properties of row
$end_tab = "</table>"; // ending of table properties of row

	echo "<table cellpadding=0 cellspacing=0 border=0 width='100%'>";
		foreach($f_mbr_list as $rank=>$name_r) { // break ranks
		echo "<tr><td height=24 style=\"background-color: #e0e0e0\"><table cellpadding=0 cellspacing=0 style=\"background-color: #003366\" border=0 width='100%'><tr><td><b><font color=#ffffff>".getRank($rank)."</font></b></td></tr></table></td></tr>";
			foreach($name_r as $name=>$content) { // break into names then use numbers to use in $content
				$final_output = $beg_tab."<tr><td width='50%'>".$name."</td><td width='1' align=right><td width='1' align=left></td><td width='50%' align=right>".$content['date']."</td></tr>".$end_tab;
				echo "<tr><td height=18 style=\"padding-bottom: 1px; padding-top: 1px;\">".$final_output."</td></tr>";//display all contents
			}
		}
		echo "</table>";
	
	echo "</div></div>";

	
	
	} elseif($_GET['db'] == "clan") {// blk list page
	echo "<div class=\"center_header\">";
	echo "Divisions and Squads";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		if($_GET['dm'] == "1") {
			if(isset($_GET['view'])) {
				$master_division_list = NULL;
				$total_mbr = 0;
				$check_division_id = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0' AND `id` = '".$_GET['view']."'");
				if(mysql_num_rows($check_division_id) == 1) {
					$squad_list = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".$_GET['view']."' AND `visable` = '0'");
					while($row_squad = mysql_fetch_assoc($squad_list)) {
						$squad_count[$row_squad['squadname']][] = 0;
						$mbrlist_extract = mysql_query("SELECT * FROM `mbrlist` WHERE `sid` = '".$row_squad['id']."' AND `visable` = '0'");
						while($row_mbr = mysql_fetch_assoc($mbrlist_extract)) {
							$master_division_list[$row_mbr['rank']][] = "[".$row_mbr['gametype']."]".$row_mbr['name'];
							$squad_count[$row_squad['squadname']][] = 0;
							++$total_mbr;
						}
					}
				$newrowx = mysquery("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
				echo "<font size=3><b>".divi($_GET['view'])." - ".diviname($_GET['view'])."<BR>Total of ".$total_mbr."</b></font><BR><BR>";
				echo "<BR><table cellpadding=0 cellspacing=0 border=0 align=center width=430 class=tablexx>";
				echo "<tr><td colspan=2 bgcolor=E0E0E0>Division Statistics</td></tr>";
				echo "<tr><td width=300>Member Count</td><td>".$total_mbr."</td></tr>";
				$percentage = round($total_mbr / mysql_num_rows($newrowx), 2);
				if(strlen($percentage) == 3) {
					$percentage = str_replace("0.", "", $percentage)."0";
				}
				$percentage = str_replace("0.0", "", $percentage);
				$percentage = str_replace("0.", "", $percentage);
				echo "<tr><td width=300>Percentage of RD</td><td>".$percentage."%</td>";
				echo "</table>";	
					
				echo "<BR><table cellpadding=0 cellspacing=0 border=0 align=center width=430 class=tablexx>";
				echo "<tr bgcolor=E0E0E0><td colspan=2>Squads</td></tr>";
				if(isset($squad_count)) {
					if(is_array($squad_count)) {
						foreach($squad_count as $key=>$value) {
							echo "<tr><td width=300>".$key."</td><td>".(count($value) - 1)."</td></tr>";
						}
					}
				}
				echo "</table><BR>";
				echo "<BR><table cellpadding=0 cellspacing=0 border=0 align=center width=430 bgcolor=E0E0E0>";
				echo "<tr><td align=center><b>Master Division List</b></td></tr>";
				echo "<tr><td align=center>";
				
				if(is_array($master_division_list)) {
				krsort($master_division_list, SORT_NUMERIC);
				
				echo "<font size=1>";
					foreach($master_division_list as $key=>$value) {
						echo "<BR><u>".getRank($key)." - <b>".count($value)."</b></u><BR>";
						asort($value);
						foreach($value as $item) {
							echo $item."<BR>";
						}
					}
				}
				echo "</font>";
				echo "</td></tr>";
				echo "</table>";
				} elseif(mysql_num_rows($check_division_id) == 0) {
					$_SESSION['error'] = 2;
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=error\";";
					echo "</script>";
				}
			} else {
			echo "<b>Squad Numbers per Division is within the Master List</b><BR>";
				$resulto = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviname`");
					while($rowas = mysql_fetch_assoc($resulto)) {
						if($rowas['id'] == 37) {//Block Leader List
						} else {
							$newcount = 0;
							echo "<BR><table border=0 cellspacing=0 width=430 cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
							echo "<tr id=ignore><td><img src='images/divipic.php?d=".str_replace(" ", "+", $rowas['diviname'])."&ds=".str_replace(" ", "+", $rowas['diviabbr'])."'></td></tr>";
							$aaresult = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0' AND `divisionid` = '".$rowas['id']."'");
								if(mysql_num_rows($aaresult) == 0) {
									echo "<tr id=ignore><td>Currently there are no squads in this division.</td></tr>";
								} else {
									while($nerow = mysql_fetch_assoc($aaresult)) {
										echo "<tr><td>".$nerow['squadname']."</td></tr>";
									}
								}
							echo "</table><BR>";
						}
					}
			}
		} elseif($_GET['dm'] == "2") {
			echo "<BR><center><B>Statistics of RD</B></center>";
			echo "<table border=0 align=center width=430>";
			$member_count = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
			echo "<tr><td>Members <i>(RD Clan Based)</i></td><td>".mysql_num_rows($member_count)."</td></tr>";
			$squad_count = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0'");
			echo "<tr><td>Squads <i>(KSIClan.net Based)</i></td><td>".mysql_num_rows($squad_count)."</td></tr>";
			$divisions_count = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0'");
			echo "<tr><td>Divisions <i>(RDClan Based)</i></td><td>".mysql_num_rows($divisions_count)."</td></tr>";
			$bg_count = mysql_query("SELECT * FROM `mbrlist` WHERE `bgcheck` > '0' AND `visable` = '0'");
			echo "<tr><td>Background Checks Completed</td><td>".mysql_num_rows($bg_count)."</td></tr>";
			$aa_count = mysql_query("SELECT * FROM `useraccess`");
			echo "<tr><td>Registered Users</td><td>".mysql_num_rows($aa_count)."</td></tr>";
			echo "</table><BR>&nbsp;";
		} elseif($_GET['dm'] == "3") {
			/*echo "<BR><table border=0 cellspacing=0 width=430 cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
			echo "<tr id=ignore><td colspan=3 bgcolor=E0E0E0>Leaderboards</b></td></tr>";
		$resulto = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviname`");
		$leaderboard = array();
			while($rowas = mysql_fetch_assoc($resulto)) {
				if($rowas['id'] == 37) { //block leader list
				} else {
					$newcount = 0;
					$aaresult = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0' AND `divisionid` = '".$rowas['id']."'");
						if(mysql_num_rows($aaresult) == 0) {
							$leaderboard[diviname($rowas['id'])] = 0;
						} else {
							while($nerow = mysql_fetch_assoc($aaresult)) {
								$leaderboard[diviname($rowas['id'])] = $leaderboard[diviname($rowas['id'])] + squadcount($nerow['id']);
							}
						}
				}
			}
			asort($leaderboard, SORT_NUMERIC);
			$leaderboard = array_reverse($leaderboard);
			$cccc = 0;
				foreach($leaderboard as $key=>$value) {
					echo "<tr><td width=50>".++$cccc."</td><td>".$key."</td><td>".$value."</td></tr>";
				}
			echo "</table><BR>";*/
			echo "SR is number one, thats the leaderboard.";
		}
	echo "</div></div>";
	} elseif($_GET['db'] == "blkclan") {
	echo "<div class=\"center_header\">";
	echo "Black List of Clans";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	echo "<BR><center><img src=images/blk.jpg></center><BR><BR>";
	$counting = 0;
	echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
	$newresults = mysql_query("SELECT * FROM `blkclans` ORDER BY `cblktag`");
	echo "<tr id=ignore bgcolor=E0E0E0><td width=10%></td><td width=30%>Clan Tag</td><td width=30%>Threat Level</td><td width=30%>Authorized By</td></tr>";
		while($rows = mysql_fetch_assoc($newresults)) {
			
			echo "<tr onClick=\"return alert('Reason of Blacklist: ".$rows['cblkreason']."');\"><td>".++$counting."</td><td>".$rows['cblktag']."</a></td><td>".$rows['cblklv']."</td><td>".colorname(dataRetrieve($rows['cblkauthid'], "username"), dataRetrieve($rows['cblkauthid'], "colorcode"))."</td></tr>";
		}
	echo "</table><BR>";
	
	echo "</div></div>";
	} elseif($_GET['db'] == "blk") {// blk list page
	echo "<div class=\"center_header\">";
	echo "Black List of Gamer Tags";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	echo "<BR><center><img src=images/blk.jpg></center><BR><BR>";
	if(isset($_POST['bb'])) {
	$aadbresultx = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$_POST['bb']."' LIMIT 0,1");
		if(mysql_num_rows($aadbresultx) == 0) {
		echo "<script language=\"javascript\">";
		echo "alert(\"Cannot find user.\");";
		echo "</script>";
		} else {
		$rowxa = mysql_fetch_row($aadbresultx);
		echo "<script language=\"javascript\">";
		echo "window.location=\"http://www.clanblackops.co.cc/clan/index.php?db=blk&t=".$rowxa['0']."&pz=0&SESSION\";";
		echo "</script>";
		}
	}
	echo "<form id='form1' name='form1' method='post' action='#' onSubmit=\"submitonce(this);\" align=center>";
	echo "Search for Blacklisted Member<BR><input name='bb' type='text' id='bb' size='17' maxlength='17' class=forms /><input name=subs type=Submit id=subs value=Go class=forms />";
	echo "</form>";
		if(isset($_GET['p'])) {
		echo "<center>";
			if($_GET['p'] == 0) {
			$limnum = 0;
			} else {
			$limnum = $_GET['p'] * 50;
			}	
		$rowresult = mysql_query("SELECT * FROM `blklist`");
		$rownum = mysql_num_rows($rowresult);
		$pagecount = 0;
		echo "Page Numbers:";
			while($rownum > 0) {
			if($_GET['p'] == $pagecount) {
			echo "<b>".($pagecount + 1)."</b> ";
			} else {
			echo "<a href=index.php?db=blk&p=".$pagecount.">".($pagecount + 1)."</a> ";
			}
			++$pagecount;
			$rownum = $rownum - 50;
			}
		echo "</center><BR>";
		echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";

		$dbsqzl = "SELECT * FROM `blklist` ORDER BY `blkname` LIMIT ".$limnum.",50";
		$resultz = mysql_query($dbsqzl);
		echo "<tr id=ignore bgcolor=E0E0E0><td width=10%></td><td width=30%>Gamertag</td><td width=30%>Threat Level</td><td width=30%>Authorized By</td></tr>";
			while($row = mysql_fetch_assoc($resultz)) {
			echo "<tr><td>".++$limnum."</td><td><a href=index.php?db=blk&t=".$row['id']."&pz=".$_GET['p']."&SESSION>".$row['blkname']."</a></td><td>".$row['blklv']."</td><td>".colorname(dataRetrieve($row['blkauthid'], "username"), dataRetrieve($row['blkauthid'], "colorcode"))."</td></tr>";
			}
	
		echo "</table><BR>";
		} elseif(isset($_GET['t'])) {
		echo "<font size=1><BR><u>Threat Level Details</u>";
		echo "<BR><BR>Level 1- Harrassment, Racism, Sexism (can be appealed depending on circumstances).";
		echo "<BR><BR>Level 2- Violating the Anti-Cheating Policy (can be appealed depending on circumstances).";
		echo "<BR><BR>Level 3- Insubordination (can be  appealed depending on circumstances).";
		echo "<BR><BR>Level 4- Breaking Code of Conduct (can be appealed in court depending on the  circumstances and what it was).";
		echo "<BR><BR>Level 5- Hitting any part of RD, Extreme Code of Conduct Violations, Hacking.&nbsp; Usually cannot be appealed;";
		$dbresultx = mysql_query("SELECT * FROM `blklist` WHERE `id` = '".$_GET['t']."' LIMIT 0,1");
		$rowx = mysql_fetch_row($dbresultx);
		echo "<BR><BR>Gamertag: <b>".$rowx['1']."</b><BR>Reason: <b>".$rowx['2']."</b><BR>Threat Level: <b>".$rowx['3']."</b><BR>Proof: <b>".$rowx['4']."</b><BR>Authorized By: <b>".dataRetrieve($rowx['5'], "username")."</b><BR>Date Added: <b>".$rowx['6']."</b><BR><BR><a href=index.php?db=blk&p=".$_GET['pz'].">Back</a>";
		
		} else {
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=blk&p=0\";";
		echo "</script>";
		}
	echo "</div></div>";
	} elseif($_GET['db'] == "profile") {// profile page
		if(isset($_GET['v'])) {
		$ultraresult = mysql_query("SELECT * FROM `useraccess` WHERE `id` = '".$_GET['v']."'");
			if(mysql_num_rows($ultraresult) == 0) {
			$_SESSION['error'] = 2;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			} else {
			echo "<div class=\"center_header\">";
			echo "Viewing Profile <b>".dataRetrieve($_GET['v'], "username")."</b>";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			include("profile.php");
			echo "</div></div>";
			}
		} else {
		$_SESSION['error'] = 2;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		}
	} elseif($_GET['db'] == "al") {// access list page
	echo "<div class=\"center_header\">";
	echo "User Access List";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	echo "<BR><table width='470' border='0' cellspacing='0' cellpadding='0' align=center>";###
	$sql = "SELECT * FROM `useraccess` ORDER BY `username`";
	$result = mysql_query($sql);
	echo "<tr bgcolor=E0E0E0 id=ignore height=15><td width=130>Username</td><td width=125>Last Active</td><td width=90 align=center><font size=1>Access Level</font></td><td width=150>Access Granted By</td></tr>";
		while($row = mysql_fetch_assoc($result)) {
			//if($row['lastactive'] == date("m/d/y")) {
			//$checkdate = "<b>".$row['lastactive']."</b>";
		        //} else {
			$checkdate = $row['lastactive'];
			//}
		echo "<tr height=30><td><a href=index.php?db=profile&v=".$row['id'].">".colorname($row['username'], $row['colorcode'])."</a></td><td>".$checkdate."</td><td align=center><img src=images/lv".$row['accesslevel'].".jpg></td><td><a href=index.php?db=profile&v=".$row['letinby'].">".colorname(dataRetrieve($row['letinby'], "username"), dataRetrieve($row['letinby'], "colorcode"))."</a></td></tr>";
		}
	echo "</table><BR>";###
	echo "</div></div>";
	} elseif($_GET['db'] == "securitycheck" && isset($_SESSION['id'])) {
		include("./securitycheck.php");
	} elseif($_GET['db'] == "editSquad" && isset($_SESSION['id'])) {
		echo "<div class=\"center_header\">";
		echo "My Clans";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		if(dataRetrieve($_SESSION['id'], "letinby") == 0) { 
		$_SESSION['error'] = 2;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		} else {
			if(isset($_SESSION['downgrade'])) {
				include("./editsquadv1.php");
			} else {
				include("./editsquadv2.php");
			}
		}
		echo "</div></div>";
	} elseif($_GET['db'] == "cpmylogfile" && isset($_SESSION['id'])) {
		echo "<div class=\"center_header\">";
		echo "My Log File";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		echo "Logs:";
		$asql = "SELECT * FROM `logs` WHERE `userid` = '".$_SESSION['id']."' ORDER BY `id` DESC LIMIT 0,50";
		$aresult = mysql_query($asql);
		echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
		while($row = mysql_fetch_assoc($aresult)) {
		echo "<tr><td>[<b><font size=1>".dataRetrieve($row['userid'], "username")."</font></b>]</td><td><font size=1>".$row['action']."</font></td><td><font size=1>".$row['date']."</font></td></tr>";
		}
		echo "</table><BR>";
		echo "</div></div>";
	} elseif($_GET['db'] == "divicodelist" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
			echo "<div class=\"center_header\">";
			echo "Division's Request Codes";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			$count = 0;
			$dbsql = "SELECT * FROM `codes` WHERE `squadid` = ".dataRetrieve($_SESSION['id'], "clanleaderid")." ORDER BY `squadid`";
			$dbresult = mysql_query($dbsql);
				if($dbresult) {
					if(mysql_num_rows($dbresult) == 0) {
					echo "<BR>";
					} else {
						echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
						echo "<tr id=ignore bgcolor=E0E0E0><td></td><td>Division Name</td><td>Code</td></tr>";
						while($row = mysql_fetch_assoc($dbresult)) {
						echo "<tr><td><font size=1><b>&nbsp;".++$count."&nbsp;</b></font></td><td>".diviname($row['squadid'])."</td><td>".$row['codechars']."</td></tr>";
						}
						echo "</table><BR>";
					}
					
				} else {
				echo mysql_error();
				}
				echo "</div></div>";
		} else {
		$_SESSION['error'] = 2;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		}
	} elseif($_GET['db'] == "cpsettings" && isset($_SESSION['id'])) {
		echo "<div class=\"center_header\">";
		echo "Settings (adding more in near future)";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		include("settings.php");
		echo "</div></div>";
	} elseif($_GET['db'] == "myclans" && isset($_SESSION['id'])) {
		echo "<div class=\"center_header\">";
		echo "My Clans";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		echo "<table border=0 width=95% align=center><tr><td>";
		echo "<br><center><img src=images/myclan.jpg></center>";
		echo "<BR><div id='masterdiv'>";
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 0) {
			if(dataRetrieve($_SESSION['id'], "letinby") == 0) {
			echo "Account is under pending";
			} else {
			$n = 0;
			$i = 0;
			$sqlq = "SELECT * FROM `accesslevels` WHERE `userid` = '".$_SESSION['id']."'";
			$resultq = mysql_query($sqlq);
				while($row = mysql_fetch_assoc($resultq)) {
					$squadsql = "SELECT * FROM `squads` WHERE `id` = '".$row['s1id']."' AND `visable` = '0'";
					$squadresult = mysql_query($squadsql);
					echo "<div class='menutitle' onclick=\"SwitchMenu('sub".++$n."')\">".getDiviAL($row['s1id'])."</div>";
					echo "<span class=\"submenu\" id=\"sub".++$i."\">";
						while($squadrow = mysql_fetch_assoc($squadresult)) {
							echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s1id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s1id'])."</a><BR>";
						}
					echo "</span>";
				}
			}
		}
		
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 1) {
		$n = 0;
		$i = 0;
		$sqlq = "SELECT * FROM `accesslevels` WHERE `userid` = '".$_SESSION['id']."'";
		$resultq = mysql_query($sqlq);
			while($row = mysql_fetch_assoc($resultq)) {
			$squadsql = "SELECT * FROM `squads` WHERE `visable` = '0' ORDER BY `squadname`";
			$squadresult = mysql_query($squadsql);
			echo "<div class='menutitle' onclick=\"SwitchMenu('sub".++$n."')\">".getDiviAL($row['s1id'])."</div>";
			echo "<span class=\"submenu\" id=\"sub".++$i."\">";
				while($squadrow = mysql_fetch_assoc($squadresult)) {
					if($row['s1id'] == $squadrow['id']) {
					echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s1id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s1id'])."</a><BR>";
					}
					if($row['s2id'] == $squadrow['id']) {
					echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s2id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s2id'])."</a><BR>";
					}
				}
			echo "</span>";
			}
		}

		if(dataRetrieve($_SESSION['id'], "accesslevel") == 2) {
		$n = 0;
		$i = 0;
		$sqlq = "SELECT * FROM `accesslevels` WHERE `userid` = '".$_SESSION['id']."'";
		$resultq = mysql_query($sqlq);
			while($row = mysql_fetch_assoc($resultq)) {
			$squadsql = "SELECT * FROM `squads` WHERE `visable` = '0' ORDER BY `squadname`";
			$squadresult = mysql_query($squadsql);
			echo "<div class='menutitle' onclick=\"SwitchMenu('sub".++$n."')\">".getDiviAL($row['s1id'])."</div>";
			echo "<span class=\"submenu\" id=\"sub".++$i."\">";
				while($squadrow = mysql_fetch_assoc($squadresult)) {
					if($row['s1id'] == $squadrow['id']) {
					echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s1id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s1id'])."</a><BR>";
					}
					if($row['s2id'] == $squadrow['id']) {
					echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s2id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s2id'])."</a><BR>";
					}
					if($row['s3id'] == $squadrow['id']) {
					echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['s3id'].">".ucwords(strtolower($squadrow['squadname']))." - ".squadcount($row['s3id'])."</a><BR>";
					}
				}
			echo "</span>";
			}
		}
		
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
		$n = 0;
		$i = 0;
		$sqlq = "SELECT * FROM `squads` WHERE `divisionid` = '".dataRetrieve($_SESSION['id'], "clanleaderid")."' AND `visable` = '0' ORDER BY `squadname`";
		$resultq = mysql_query($sqlq);
		echo "<div class='menutitle' onclick=\"SwitchMenu('sub".++$n."')\">".divi(dataRetrieve($_SESSION['id'], "clanleaderid"))."</div>";
		echo "<span class=\"submenu\" id=\"sub".++$i."\">";
			while($row = mysql_fetch_assoc($resultq)) {
			echo "<a href=index.php?db=securitycheck&divi=0&sss=".$row['id'].">".ucwords(strtolower($row['squadname']))." - ".squadcount($row['id'])."</a><BR>";
			}
		echo "</span>";
		}
		
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		$n = 0;
		$i = 0;
		$sqlq = "SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviabbr`";
		$resultq = mysql_query($sqlq);
			while($row = mysql_fetch_assoc($resultq)) {
			if($row['id'] == 37) {//BLOCK LEADERLIST
			} else {
				echo "<div class='menutitle' onclick=\"SwitchMenu('sub".++$n."')\">".$row['diviabbr']."</div>";
				echo "<span class=\"submenu\" id=\"sub".++$i."\">";
				$sqltwo = "SELECT * FROM `squads` WHERE `divisionid` = '".$row['id']."' AND `visable` = '0'";
				$resulttwo = mysql_query($sqltwo);
					while($rowtwo = mysql_fetch_assoc($resulttwo)) {
					echo "<table cellpadding=0 cellspacing=0 border=0><tr><td width=125>";
						echo "<table cellpadding=0 cellspacing=0 border=0 style=\"border: solid 1px #00358C\" width=120>";
						$maxsquad = squadcount($rowtwo['id']);
						echo "<tr><td><table cellpadding=0 cellspacing=0 border=0 bgcolor=001B46 width=".(($maxsquad / $rowtwo['max']) * 100)."% height=12><tr><td></td></tr></table></td></tr>";
						echo "</table>";
					echo "</td><td><a href=index.php?db=securitycheck&divi=0&sss=".$rowtwo['id'].">".ucwords(strtolower($rowtwo['squadname']))." - ".$maxsquad."</a></td></tr></table>";
					}
				echo "</span>";
				}
			}
		
		}
		
		echo "</div><BR>";
		echo "</td> </tr> </table>";
		echo "</div></div>";
	} elseif($_GET['db'] == "cpblk" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		echo "<div class=\"center_header\">";
		echo "Black List <i>Add/Delete/Edit</i>";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		echo "<BR><center><img src=images/blk.jpg></center><BR>";
			if(isset($_GET['t'])) {
				if($_GET['t'] == "1") {
				echo "Add to Gamer Tag Blacklist<BR>";
				
				if(isset($_POST['blkname'])) {
				$blkuser = $_POST['blkname'];
				$blkreason = $_POST['blkreason'];
				$threat = $_POST['blklv'];
				$proof = $_POST['blkproof'];
					if(empty($blkuser) || empty($blkreason) || empty($proof)) {
					$_SESSION['error'] = 6;
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=error\";";
					echo "</script>";
					exit;
					}
					$resultxz = mysql_query("SELECT * FROM `blklist`");
					while($row = mysql_fetch_assoc($resultxz)) {
						if(strtolower($row['blkname']) == strtolower($blkuser)) {
						$_SESSION['error'] = 6;
						echo "<script language=\"javascript\">";
						echo "window.location=\"index.php?db=error\";";
						echo "</script>";
						exit;
						}
					}
					
					if(mysql_query("INSERT INTO `blklist` (`blkname`, `blkreason`, `blklv`, `blkproof`, `blkauthid`, `blkdate`) VALUES ('".$blkuser."', '".$blkreason."', '".$threat."', '".$proof."', '".$_SESSION['id']."', '".date("m/d/y")."')")) {
					logfile($_SESSION['id'], "Black Listed [GT] <u>".$blkuser."</u>");
					echo "<BR><b>".$blkuser."</b> is officially blacklisted.";
					} else {
					echo mysql_error();
					}

				}
				echo "<font size=1><BR><u>Threat Level Details</u>";
				echo "<BR><BR>Level 1- Harrassment, Racism, Sexism (can be appealed depending on circumstances).";
				echo "<BR><BR>Level 2- Violating the Anti-Cheating Policy (can be appealed depending on circumstances).";
				echo "<BR><BR>Level 3- Insubordination (can be  appealed depending on circumstances).";
				echo "<BR><BR>Level 4- Breaking Code of Conduct (can be appealed in court depending on the  circumstances and what it was).";
				echo "<BR><BR>Level 5- Hitting any part of RD, Extreme Code of Conduct Violations, Hacking.&nbsp; Usually cannot be appealed;";;
				echo "<br><br>Level 6- Being just an all around douchebag.";
				echo "<form id='form34' name='form34' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<table border=0 cellspacing=0 width=95% cellpadding=0 al=center class=tablexx>";
				echo "<tr><td><BR>Gamertag</td><td><BR><input name='blkname' id='blkname' type='text' size='30' maxlength=17></td></tr>";
				echo "<tr><td>Reason</td><td><input name='blkreason' id='blkreason' type='text' size='30' maxlength=255></td></tr>";
				echo "<tr><td>Threat Level</td><td><select name='blklv' id='blklv'>";
				echo "<option value='1'>1</option>";
				echo "<option value='2'>2</option>";
				echo "<option value='3'>3</option>";
				echo "<option value='4'>4</option>";
				echo "<option value='5'>5</option>";
				echo "<option value='6'>6</option>";
				echo "</select>";
				echo "</td></tr>";
				echo "<tr><td>Proof (links, people, ect...) list em...</td><td><input name='blkproof' id='blkproof' type='text' size='30' maxlength=400></td></tr>";
				echo "<tr><td colspan=2><input type='submit' name='Submit' value='Blacklist!'><BR>&nbsp;</td></tr>";
				echo "</table>";
				echo "</form>";
				echo "<a href=index.php?db=cpblk>Back</a>";
				
				} elseif($_GET['t'] == "4") {
				
				echo "Add to Clan Blacklist";
					if(isset($_POST['cblktag'])) {
					$cblkname= $_POST['cblkname'];
					$cblktag = $_POST['cblktag'];
					$cblkreason = $_POST['cblkreason'];
					$cthreat = $_POST['cblklv'];
						if(empty($cblktag) || empty($cblkreason) || empty($cblkname)) {
						$_SESSION['error'] = 6;
						echo "<script language=\"javascript\">";
						echo "window.location=\"index.php?db=error\";";
						echo "</script>";
						exit;
						}
						$resultxz = mysql_query("SELECT * FROM `blkclans`");
						while($row = mysql_fetch_assoc($resultxz)) {
							if(strtolower($row['cblktag']) == strtolower($cblktag)) {
							$_SESSION['error'] = 6;
							echo "<script language=\"javascript\">";
							echo "window.location=\"index.php?db=error\";";
							echo "</script>";
							exit;
							}
						}
						
						if(mysql_query("INSERT INTO `blkclans` (`cblktag`, `cblkclan`, `cblkreason`, `cblklv`, `cblkauthid`, `cblkdate`) VALUES ('".$cblktag."', '".$cblkname."', '".$cblkreason."', '".$cthreat."', '".$_SESSION['id']."', '".date("m/d/y")."')")) {
						logfile($_SESSION['id'], "Black Listed [Clan] <u>".$cblktag."</u>");
						echo "<BR><BR><b>".$cblktag."</b> is officially a blacklisted clan.<BR>";
						} else {
						echo mysql_error();
						}
	
					}
				echo "<font size=1><BR><u>Threat Level Details</u>";
				echo "<BR><BR>Level 1- Harrassment, Racism, Sexism (can be appealed depending on circumstances).";
				echo "<BR><BR>Level 2- Violating the Anti-Cheating Policy (can be appealed depending on circumstances).";
				echo "<BR><BR>Level 3- Insubordination (can be  appealed depending on circumstances).";
				echo "<BR><BR>Level 4- Breaking Code of Conduct (can be appealed in court depending on the  circumstances and what it was).";
				echo "<BR><BR>Level 5- Hitting any part of RD, Extreme Code of Conduct Violations, Hacking.&nbsp; Usually cannot be appealed;";
				echo "<BR><BR>";
				echo "<form id='form34d' name='form34d' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx>";
				echo "<tr><td><BR>Clan Tag</td><td><BR><input name='cblktag' id='cblktag' type='text' size='30' maxlength=10></td></tr>";
				echo "<tr><td><BR>Clan Name (Full)</td><td><BR><input name='cblkname' id='cblkname' type='text' size='30' maxlength=100></td></tr>";
				echo "<tr><td>Reason</td><td><input name='cblkreason' id='cblkreason' type='text' size='30' maxlength=255></td></tr>";
				echo "<tr><td>Threat Level</td><td><select name='cblklv' id='cblklv'>";
				echo "<option value='1'>1</option>";
				echo "<option value='2'>2</option>";
				echo "<option value='3'>3</option>";
				echo "<option value='4'>4</option>";
				echo "<option value='5'>5</option>";
				echo "</select>";
				echo "</td></tr>";
				echo "<tr><td colspan=2><input type='submit' name='Submit' value='Blacklist!'><BR>&nbsp;</td></tr>";
				echo "</table>";
				echo "</form>";
				echo "<a href=index.php?db=cpblk>Back</a>";
				} elseif($_GET['t'] == "2") {
				if(isset($_POST['delblk'])) {
				$dele = cleanInput($_POST['delblk']);
				$check = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$dele."'");
					if(mysql_num_rows($check) == 0) {
					echo "<script language=\"javascript\">";
					echo "alert(\"User not exsist on the blacklist.\");";
					echo "window.location=\"index.php?db=cpblk&t=2\";";
					echo "</script>";
					} else {
					mysql_query("DELETE FROM `blklist` WHERE `blkname` = '".$dele."'");
					logfile($_SESSION['id'], "Unblacklisted [GT] <u>".$dele."</u>");
					echo "<script language=\"javascript\">";
					echo "alert(\"User Unblacklisted.\");";
					echo "window.location=\"index.php?db=cpblk&t=2\";";
					echo "</script>";
					}
				}
				echo "<form id='form34aaa' name='form34aaa' method='post' action='#' onSubmit=\"submitonce(this);\">";
						echo "<BR><table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td align=center><br>";
				echo "Black List Name: <input name='delblk' id='delblk' type='text' size='30' maxlength=17><BR><input type='submit' name='Submit' value='UNBlacklist!'>";
				echo "<BR>&nbsp;</td></tr></table></form>";
				echo "<a href=index.php?db=cpblk>Back</a>";
				} elseif($_GET['t'] == "5") {
				if(isset($_POST['cdelblk'])) {
					mysql_query("DELETE FROM `blkclans` WHERE `cblktag` = '".$_POST['cdelblk']."'");
					logfile($_SESSION['id'], "Unblacklisted [Clan] <u>".$_POST['cdelblk']."</u>");
					echo "<script language=\"javascript\">";
					echo "alert(\"Clan Unblacklisted.\");";
					echo "window.location=\"index.php?db=cpblk&t=5\";";
					echo "</script>";
				}
				echo "<form id='form34aaa' name='form34aaa' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<BR><table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td align=center><br>";
				echo "Black List Name:";
				echo "<select id=cdelblk name=cdelblk>";
				$newresultsd = mysql_query("SELECT * FROM `blkclans` ORDER BY `cblktag`");
				while($row = mysql_fetch_assoc($newresultsd)) {
					echo "<option value='".$row['cblktag']."'>".$row['cblktag']."</option>";
				}
				echo "</select>";
				echo "<input type='submit' name='Submit' value='UNBlacklist!'>";
				echo "<BR>&nbsp;</td></tr></table></form>";
				echo "<a href=index.php?db=cpblk>Back</a>";
				} else {
				$_SESSION['error'] = 2;
				echo "<script language=\"javascript\">";
				echo "window.location=\"index.php?db=error\";";
				echo "</script>";
				}
			} else {
			echo "You may add a person to the blacklist, remove someone from the blacklist, or edit the information on the blacklist<BR>";
			echo "<BR><BR>- <a href=index.php?db=cpblk&t=4>Add to Clan Black list</a><BR>- <a href=index.php?db=cpblk&t=1>Add to Gamer Tag Black list</a><BR>- <a href=index.php?db=cpblk&t=2>Remove from Gamer Tag Black list</a><BR>- <a href=index.php?db=cpblk&t=5>Remove from Clan Black List</a><BR>- <a href=index.php?db=blk>View Black list</a><BR>";
			}
		echo "</div></div>";
		}
	} elseif($_GET['db'] == "request" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
		echo "<div class=\"center_header\">";
		echo "Request List";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		echo "This section is where the registration is controlled. No one has access to the actual squad list unless <u>you</u> allow them. <b>ALL ACTIONS ARE RECORDED, MAKE SMART CHOICES.</b><BR>";
		echo "<BR><u>Level Usage</u><BR><b>0</b> - Pending OR 1 Squad Control<BR><b>1</b> - 2 Squads Control<BR><b>2</b> - 3 Squads Control<BR><b>3</b> - Division Squads Control, Clan Leader Powers<BR><b>4</b> - Clan Directors<BR><BR>";
		if(isset($_GET['result'])) {
		include("rType.php");
		}		
		echo "<BR><table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
		echo "<tr id=ignore bgcolor=E0E0E0><td width=25%><u>Username</u></td><td width=5%><u>+</u></td><td width=20%><u><center>Squad</center></u></td><td width=50% align=right><u>Permissons</u></td></tr>";

		$dbsql = "SELECT * FROM `requestlist`";
		$dbresult = mysql_query($dbsql);
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
			while($row = mysql_fetch_assoc($dbresult)) {
				if(getDiviID($row['squadid']) == dataRetrieve($_SESSION['id'], "clanleaderid")) {
				echo "<tr><td>".dataRetrieve($row['appid'], "username")."</td><td>".$row['multi']."</td><td><center>".getSquad($row['squadid'])."</center></td><td align=right>[<a href=index.php?db=request&id=".$row['appid']."&result=0>0</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=1>1</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=2>2</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=7>Drop</a>]</td></tr>";
				}
			}
		} elseif(dataRetrieve($_SESSION['id'], "accesslevel") == 4) {
			while($row = mysql_fetch_assoc($dbresult)) {
			echo "<tr><td>".dataRetrieve($row['appid'], "username")."</td><td>".$row['multi']."</td><td><center>".getSquad($row['squadid'])."</center></td><td align=right>[<a href=index.php?db=request&id=".$row['appid']."&result=0>0</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=1>1</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=2>2</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=3>3</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=6>Ban</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=7>Drop</a>]</td></tr>";
			}
		} elseif(dataRetrieve($_SESSION['id'], "accesslevel") == 5) {
			while($row = mysql_fetch_assoc($dbresult)) {
			echo "<tr><td>".dataRetrieve($row['appid'], "username")."</td><td>".$row['multi']."</td><td><center>".getSquad($row['squadid'])."</center></td><td align=right>[<a href=index.php?db=request&id=".$row['appid']."&result=0>0</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=1>1</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=2>2</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=3>3</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=4>4</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=6>Ban</a>] [<a href=index.php?db=request&id=".$row['appid']."&result=7>Drop</a>]</td></tr>";
			}
		}
		echo "</table><BR>";
		echo "</div></div>";
		}
	} elseif($_GET['db'] == "deldiv" && isset($_SESSION['id'])) {	
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
			if(isset($_POST['dsquad'])) {
				if($_POST['dsquad'] == 0) {
				echo "<script language=\"javascript\">";
				echo "alert(\"Division cannot be Deleted.\");";
				echo "window.location=\"index.php?db=deldiv\";";
				echo "</script>";
				} else {
				mysql_query("UPDATE `squads` SET `visable` = '1' WHERE `divisionid` = '".$_POST['dsquad']."'");
				mysql_query("UPDATE `divisions` SET `visable` = '1' WHERE `id` = '".$_POST['dsquad']."'");
				$ssresult = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".$_POST['dsquad']."'");
					while($row = mysql_fetch_assoc($ssresult)) {
					mysql_query("UPDATE `mbrlist` SET `visable` = '1', `date` = '".date("m/d/y")."' WHERE `sid` = '".$row['id']."'");		
					}
				logfile($_SESSION['id'], "Deleted Division <u>".divi($_POST['dsquad'])."</u>");
				echo "<script language=\"javascript\">";
				echo "alert(\"Division Deleted.\");";
				echo "window.location=\"index.php?db=deldiv\";";
				echo "</script>";
				}
			}
			
			echo "<div class=\"center_header\">";
			echo "Delete Division";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			echo "This is where you delete divisions. Level 4 and 5 can delete through the RD Clan. <B>ALL ACTIONS ARE RECORDED</B>";
			echo "<form id='formsdsdss' name='formsdsdss' method='post' action='#' onSubmit=\"submitonce(this);\">";
			echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td><BR>";
				
				if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
				
				echo "<select name='dsquad' id='dsquad'>";
				echo "<option value='0'>--Select Division--</option>";
				$dbsql = "SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviname`";
				$dbresult = mysql_query($dbsql);
				while($dbrow = mysql_fetch_assoc($dbresult)) {
					echo "<option value='".$dbrow['id']."'>".$dbrow['diviabbr']." - ".$dbrow['diviname']."</option>";
				}
				echo "</select>";
				
				}
			echo "<input type='submit' name='Submit' value='Delete Division' class=forms>";
			echo "<BR>&nbsp;</td></tr></table>";
			echo "</form>";
			
			echo "</div></div>";
		}
	} elseif($_GET['db'] == "delsquad" && isset($_SESSION['id'])) {	
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
			if(isset($_POST['dsquad'])) {
				if($_POST['dsquad'] == 0) {
				echo "<script language=\"javascript\">";
				echo "alert(\"Squad cannot be Deleted.\");";
				echo "window.location=\"index.php?db=delsquad\";";
				echo "</script>";
				} else {
				mysql_query("UPDATE `squads` SET `visable` = '1' WHERE `id` = '".$_POST['dsquad']."'");
				mysql_query("UPDATE `mbrlist` SET `visable` = '1', `date` = '".date("m/d/y")."' WHERE `sid` = '".$_POST['dsquad']."'");
				logfile($_SESSION['id'], "Deleted Squad <u>".getSquad($_POST['dsquad'])."</u>");
				echo "<script language=\"javascript\">";
				echo "alert(\"Squad Deleted.\");";
				echo "window.location=\"index.php?db=delsquad\";";
				echo "</script>";
				}
			}
			
			echo "<div class=\"center_header\">";
			echo "Delete Squad";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			echo "This is where you delete squads. Level 3 and up have access to this page. Level 3 can only delete squads within their division. Level 4 and 5 can delete through the RD Clan. <B>ALL ACTIONS ARE RECORDED</B>";
			echo "<form id='formsdsdss' name='formsdsdss' method='post' action='#' onSubmit=\"submitonce(this);\">";
			echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td><BR>";
				if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
				
				echo "<select name='dsquad' id='dsquad'>";
				echo "<option value='0'>--Select Squad--</option>";
				$dbsql = "SELECT * FROM `squads` WHERE `divisionid` = '".dataRetrieve($_SESSION['id'], "clanleaderid")."' AND `visable` = '0' ORDER BY `divisionid`";
				$dbresult = mysql_query($dbsql);
				while($dbrow = mysql_fetch_assoc($dbresult)) {
					echo "<option value='".$dbrow['id']."'>".divi($dbrow['divisionid'])." - ".$dbrow['squadname']."</option>";
				}
				echo "</select>";
				
				} elseif(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
				
				echo "<select name='dsquad' id='dsquad'>";
				echo "<option value='0'>--Select Squad--</option>";
				$dbsql = "SELECT * FROM `squads` WHERE `visable` = '0' ORDER BY `divisionid`";
				$dbresult = mysql_query($dbsql);
				while($dbrow = mysql_fetch_assoc($dbresult)) {
					echo "<option value='".$dbrow['id']."'>".divi($dbrow['divisionid'])." - ".$dbrow['squadname']."</option>";
				}
				echo "</select>";
				
				}
			echo "<input type='submit' name='Submit' value='Delete Squad' class=forms>";
			echo "<BR>&nbsp;</td></tr></table>";
			echo "</form>";
			
			echo "</div></div>";
		}
	} elseif($_GET['db'] == "addsquad" && isset($_SESSION['id'])) {	
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 3) {
			if(isset($_POST['addss'])) {
			$newsquad = cleanInput($_POST['addss']);
				if(empty($newsquad) || $_POST['div'] == "0") {
				echo "<script language=\"javascript\">";
				echo "alert(\"Cannot create Squad.\");";
				echo "window.location=\"index.php?db=addsquad\";";
				echo "</script>";
				} else {
				mysql_query("INSERT INTO `squads` (`squadname`, `divisionid`) VALUES ('".$newsquad."', '".$_POST['div']."')");
				logfile($_SESSION['id'], "Added Squad <u>".$newsquad."</u>");
				echo "<script language=\"javascript\">";
				echo "alert(\"Squad Created.\");";
				echo "window.location=\"index.php?db=addsquad\";";
				echo "</script>";
				}
			}
			echo "<div class=\"center_header\">";
			echo "Add Squad";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
				if(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
				
				echo "<form id='formsdsd' name='formsdsd' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td>";
				echo "<input name='addss' id='addss' type='text' size='25' maxlength=17>";
				echo "<select name=div id=div>";
				echo "<option value=0>--Select--</option>";
				$srlt = mysql_query("SELECT * FROM `divisions` WHERE `id` = '".dataRetrieve($_SESSION['id'], "clanleaderid")."' AND `visable` = '0' LIMIT 0,1");
				while($row = mysql_fetch_assoc($srlt)) {
				echo "<option value=".$row['id'].">".$row['diviabbr']." - ".$row['diviname']."</option>";
				}
				echo "</select>";
				echo "<input type='submit' name='Submit' value='Add Squad'>";
				echo "</td></tr></table></form>";
				
				} elseif(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
	
				echo "Add Squad to the database. Level 3 can only add squads to their division. Level 4 and 5 can create throughout the RD Clan. <b>ALL ACTIONS ARE RECORDED.</b><form id='formsdsd' name='formsdsd' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<BR><table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td>";
				echo "<BR>New Squad Name: <input name='addss' id='addss' type='text' size='25' maxlength=17><BR>(<font color=red size=1>SQUAD NAME ONLY NOT <u>RD NAME SR</u> OR <u>RD NAME</u></font>)";
				echo "<BR>Division: <select name=div id=div>";
				echo "<option value=0>--Select--</option>";
				$srlt = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0' ");
				while($row = mysql_fetch_assoc($srlt)) {
				echo "<option value=".$row['id'].">".$row['diviabbr']." - ".$row['diviname']."</option>";
				}
				echo "</select>";
				echo "<BR><input type='submit' name='Submit' value='Add Squad' class=forms><BR>&nbsp;";
				echo "</td></tr></table></form>";
	
				}
			echo "</div></div>";
		}
	} elseif($_GET['db'] == "adddiv" && isset($_SESSION['id'])) {	
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
			if(isset($_POST['addss'])) {
			$newsquad = cleanInput($_POST['addss']);
			$abb = $_POST['abb'];
				if(empty($newsquad) || empty($abb)) {
				echo "<script language=\"javascript\">";
				echo "alert(\"Cannot create Division.\");";
				echo "window.location=\"index.php?db=adddiv\";";
				echo "</script>";
				} else {
					if(searchDiv($newsquad, $abb) == 0) {
					mysql_query("INSERT INTO `divisions` (`diviname`, `diviabbr`) VALUES ('".$newsquad."', '".$abb."')");
					logfile($_SESSION['id'], "Added Division <u>".$abb."</u>");
					echo "<script language=\"javascript\">";
					echo "alert(\"Division Created.\");";
					echo "window.location=\"index.php?db=addsquad\";";
					echo "</script>";
					} else {
					echo "<script language=\"javascript\">";
					echo "alert(\"Cannot create Division.\");";
					echo "window.location=\"index.php?db=adddiv\";";
					echo "</script>";
					}
				}
			}
			echo "<div class=\"center_header\">";
			echo "Add Division";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
				echo "This is where you add a division, Level 4 and 5 only have access to this page. <b>ALL ACTIONS ARE RECORDED.</b><BR>";
				echo "<form id='formsdsd' name='formsdsd' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0><tr><td>";
				echo "<BR>Division Name<input name='addss' id='addss' type='text' size='25' maxlength=100>";
				echo "<BR>Division Abbreviation<input name='abb' id='abb' type='text' size='5' maxlength=3>";
				echo "<input type='submit' name='Submit' value='Add Division'>";
				echo "</td></tr></table></form>";
			echo "</div></div>";
		}
	} elseif($_GET['db'] == "dt" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
			if(isset($_GET['s'])) {
				if(isset($_POST['dt_id']) && isset($_POST['dt_d'])) {
				echo "<form id='form34' name='form34' method='post' action='index.php?db=permissions&stage=0&id=".$_POST['dt_id']."' onSubmit=\"submitonce(this);\">";
				echo "You have been redirected to the permissions page, here you will select the persons squad (REVERTED BACK TO LEVEL 0). After submitting this you can go back into permissions and change the user's level back to normal with the new division.";
				echo "<BR><table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0>";
				echo "<tr><td colspan=2 align=center>[".dataRetrieve($_POST['dt_id'], "username")."] Division: <b>".divi($_POST['dt_d'])."</b></td></tr>";

				echo "<tr><td>Squad 1</td><td>";
				$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".$_POST['dt_d']."' AND `visable` = '0'");
				echo "<select name=squad3 id=squad3>";
					while($rowz = mysql_fetch_assoc($sx_result)) {
					echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
					}
				echo "</select></td></tr>";
				echo "<input type=hidden id='divi_id' name='divi_id' value='".$_POST['dt_d']."'>";
				echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=cp';\"><BR></td></tr>";
				echo "</td></tr>";
				echo "</table>";
				echo "</form>";
				}
			} else {
			echo "<div class=\"center_header\">";
			echo "Division Transfer";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			echo "Anyone who needs to switch to a different division, this is the place to do it. Levels 0, 1, 2, and 3 are listed in the drop down menu. This should prevent people form creating new accounts. All actions are recorded.";
				echo "<form name=form0294 action=?db=dt&s=2 method=post>";
				echo "<select id=dt_id name=dt_id class=forms>";
				$rrr = mysql_query("SELECT * FROM `useraccess` WHERE `accesslevel` <= '3' ORDER BY `username`");
					while($row = mysql_fetch_assoc($rrr)) {
					echo "<option value='".$row['id']."'>".$row['username']."</option>";
					}
				echo "</select><BR>";
				echo "<select id=dt_d name=dt_d class=forms>";
				$division_s = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviname`");
					while($row = mysql_fetch_assoc($division_s)) {
						if($row['id'] == 37) {
						} else {
						echo "<option value='".$row['id']."'>".$row['diviname']."</option>";
						}
					}
				echo "</select>";
				echo "<BR><BR><input type=submit value='Change Division'";
				echo "</form>";
			echo "</div></div>";	
			}
		}
	} elseif($_GET['db'] == "permissions" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
			echo "<div class=\"center_header\">";
			echo "Change Permissions to Users";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			echo "<u>Level Usage</u><BR><b>0</b> - Pending OR 1 Squad Control<BR><b>1</b> - 2 Squads Control<BR><b>2</b> - 3 Squads Control<BR><b>3</b> - Division Squads Control, Clan Leader Powers<BR><b>4</b> - Clan Directors<BR><BR>";
			if(isset($_GET['stage'])) {
				if(isset($_POST['mbrname'])) {
					if($_POST['lv'] == 1) {
						if(dataRetrieve($_POST['mbrname'], "accesslevel") == 4 && dataRetrieve($_SESSION['id'], "accesslevel") == 4) {
						echo "<script language=\"javascript\">";
						echo "alert(\"Cannot change permission. Your access is below requirements.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";
						} else {
						echo "<form id='form34' name='form34' method='post' action='index.php?db=permissions&stage=1&id=".$_POST['mbrname']."' onSubmit=\"submitonce(this);\">";
						echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0>";
						echo "<tr><td colspan=2 align=center>[".dataRetrieve($_POST['mbrname'], "username")."] Division: <b>".getDiviAL(snidRetrieve($_POST['mbrname'], "s1id"))."</b></td></tr>";
						echo "<tr><td>Squad 1</td><td>".getSquad(snidRetrieve($_POST['mbrname'], "s1id"))."</td></tr>";
						echo "<tr><td>Squad 2</td><td>";
						$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_POST['mbrname'], "s1id"))."' AND `visable` = '0'");
						echo "<select name=squad2 id=squad2>";
							while($rowz = mysql_fetch_assoc($sx_result)) {
							echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
							}
						echo "</select></td></tr>";
						echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=permissions';\"><BR></td></tr>";
						echo "</td></tr>";
						echo "</table>";
						echo "</form>";
						}
					} elseif($_POST['lv'] == 2) {
						if(dataRetrieve($_POST['mbrname'], "accesslevel") == 4 && dataRetrieve($_SESSION['id'], "accesslevel") == 4) {
						echo "<script language=\"javascript\">";
						echo "alert(\"Cannot change permission. Your access is below requirements.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";
						} else {
						echo "<form id='form34' name='form34' method='post' action='index.php?db=permissions&stage=2&id=".$_POST['mbrname']."' onSubmit=\"submitonce(this);\">";
						echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0>";
						echo "<tr><td colspan=2 align=center>[".dataRetrieve($_POST['mbrname'], "username")."] Division: <b>".getDiviAL(snidRetrieve($_POST['mbrname'], "s1id"))."</b></td></tr>";
						echo "<tr><td>Squad 1</td><td>".getSquad(snidRetrieve($_POST['mbrname'], "s1id"))."</td></tr>";
						echo "<tr><td>Squad 2</td><td>";
						$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_POST['mbrname'], "s1id"))."' AND `visable` = '0'");
						echo "<select name=squad2 id=squad2>";
							while($rowz = mysql_fetch_assoc($sx_result)) {
							echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
							}
						echo "</select></td></tr>";
						echo "<tr><td>Squad 3</td><td>";
						$sx_results = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_POST['mbrname'], "s1id"))."' AND `visable` = '0'");
						echo "<select name=squad3 id=squad3>";
							while($rowz = mysql_fetch_assoc($sx_results)) {
							echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
							}
						echo "</select></td></tr>";
						echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=permissions';\"><BR></td></tr>";
						echo "</td></tr>";
						echo "</table>";
						echo "</form>";
						}
					} elseif($_POST['lv'] == 3) {
						if(dataRetrieve($_POST['mbrname'], "accesslevel") == 4 && dataRetrieve($_SESSION['id'], "accesslevel") == 4) {
						echo "<script language=\"javascript\">";
						echo "alert(\"Cannot change permission. Your access is below requirements.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";
						} else {
						$clid = getDiviID(snidRetrieve($_POST['mbrname'], "s1id"));
						mysql_query("UPDATE `useraccess` SET `clanleaderid` = '".$clid."', `accesslevel` = '3' WHERE `id` = '".$_POST['mbrname']."'");
						logfile($_SESSION['id'], "Promoted ".dataRetrieve($_POST['mbrname'], "username")." to access level 3");
						echo "<script language=\"javascript\">";
						echo "alert(\"".dataRetrieve($_POST['mbrname'], "username")." is now a level 3.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";
						}
					} elseif($_POST['lv'] == 0) {// Access LEvel 0
						if(dataRetrieve($_POST['mbrname'], "accesslevel") == 4 && dataRetrieve($_SESSION['id'], "accesslevel") == 4) {
						echo "<script language=\"javascript\">";
						echo "alert(\"Cannot change permission. Your access is below requirements.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";
						} else {
						echo "<form id='form34' name='form34' method='post' action='index.php?db=permissions&stage=0&id=".$_POST['mbrname']."' onSubmit=\"submitonce(this);\">";
						echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx bgcolor=E0E0E0>";
						echo "<tr><td colspan=2 align=center>[".dataRetrieve($_POST['mbrname'], "username")."] Division: <b>".getDiviAL(snidRetrieve($_POST['mbrname'], "s1id"))."</b></td></tr>";
		
						echo "<tr><td>Squad 1</td><td>";
						$sx_result = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".getDiviID(snidRetrieve($_POST['mbrname'], "s1id"))."' AND `visable` = '0'");
						echo "<select name=squad3 id=squad3>";
							while($rowz = mysql_fetch_assoc($sx_result)) {
							echo "<option value=".$rowz['id'].">".$rowz['squadname']."</option>";
							}
						echo "</select></td></tr>";
						echo "<tr><td colspan=2 align=center><BR><input type='submit' name='Submit' value='Set'> <input type='button' name='Button' value='Cancel' onClick=\"return window.location='index.php?db=permissions';\"><BR></td></tr>";
						echo "</td></tr>";
						echo "</table>";
						echo "</form>";
						
						}
					} elseif($_POST['lv'] == 4 && dataRetrieve($_SESSION['id'], "accesslevel") == 5) {
						
						mysql_query("UPDATE `useraccess` SET `accesslevel` = '4' WHERE `id` = '".$_POST['mbrname']."'");
						logfile($_SESSION['id'], "Promoted ".dataRetrieve($_POST['mbrname'], "username")." to access level 4");
						echo "<script language=\"javascript\">";
						echo "alert(\"".dataRetrieve($_POST['mbrname'], "username")." is now a level 4.\");";
						echo "window.location=\"index.php?db=permissions\";";
						echo "</script>";

					} else {
					logfile($_SESSION['id'], "Attempted to chage ".dataRetrieve($_POST['mbrname'], "username")."'s access.");
					echo "<script language=\"javascript\">";
					echo "alert(\"Cannot change permission. Your access is below requirements.\");";
					echo "window.location=\"index.php?db=permissions\";";
					echo "</script>";
					}
				}
				if(isset($_POST['squad3']) && $_GET['stage'] == 0) {
					if($_POST['squad3'] == snidRetrieve($_GET['id'], "s1id")) {
					$_SESSION['error'] = 7;
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=error\";";
					echo "</script>";
					exit;
					}
				mysql_query("UPDATE `accesslevels` SET `s1id` = '".$_POST['squad3']."' WHERE `userid` = '".$_GET['id']."'");
				mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['stage']."' WHERE `id` = '".$_GET['id']."'");
				if(isset($_POST['divi_id'])) {
				mysql_query("UPDATE `useraccess` SET `clanleaderid` = '".$_POST['divi_id']."', `accesslevel` = '".$_GET['stage']."' WHERE `id` = '".$_GET['id']."'");
				logfile($_SESSION['id'], "Changed ".dataRetrieve($_GET['id'], "username")." to division ".divi($_POST['divi_id']));
				} else {
				logfile($_SESSION['id'], "Promoted ".dataRetrieve($_GET['id'], "username")." to access level 0");
				}
				echo "<script language=\"javascript\">";
				echo "alert(\"".dataRetrieve($_GET['id'], "username")." is now a level ".$_GET['stage'].".\");";
				echo "window.location=\"index.php?db=permissions\";";
				echo "</script>";
				}
				
				if(isset($_POST['squad2']) && $_GET['stage'] == 1) {
					if($_POST['squad2'] == snidRetrieve($_GET['id'], "s1id")) {
					$_SESSION['error'] = 7;
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=error\";";
					echo "</script>";
					exit;
					}
				mysql_query("UPDATE `accesslevels` SET `s2id` = '".$_POST['squad2']."' WHERE `userid` = '".$_GET['id']."'");
				mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['stage']."' WHERE `id` = '".$_GET['id']."'");
				logfile($_SESSION['id'], "Promoted ".dataRetrieve($_GET['id'], "username")." to access level 1");
				echo "<script language=\"javascript\">";
				echo "alert(\"".dataRetrieve($_GET['id'], "username")." is now a level ".$_GET['stage'].".\");";
				echo "window.location=\"index.php?db=permissions\";";
				echo "</script>";
				}
				
				if(isset($_POST['squad2']) && $_GET['stage'] == 2) {
					if($_POST['squad2'] == snidRetrieve($_GET['id'], "s1id") || $_POST['squad2'] == $_POST['squad3'] || $_POST['squad3'] == snidRetrieve($_GET['id'], "s1id")) {
					$_SESSION['error'] = 7;
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=error\";";
					echo "</script>";
					exit;
					}
				mysql_query("UPDATE `accesslevels` SET `s2id` = '".$_POST['squad2']."' WHERE `userid` = '".$_GET['id']."'");
				mysql_query("UPDATE `accesslevels` SET `s3id` = '".$_POST['squad3']."' WHERE `userid` = '".$_GET['id']."'");
				mysql_query("UPDATE `useraccess` SET `letinby` = '".$_SESSION['id']."', `accesslevel` = '".$_GET['stage']."' WHERE `id` = '".$_GET['id']."'");
				logfile($_SESSION['id'], "Promoted ".dataRetrieve($_GET['id'], "username")." to access level 2");
				echo "<script language=\"javascript\">";
				echo "alert(\"".dataRetrieve($_GET['id'], "username")." is now a level ".$_GET['stage'].".\");";
				echo "window.location=\"index.php?db=permissions\";";
				echo "</script>";
				}
			} else {
				echo "This is where you will be changing people's access of control. Access Level 4 and 5 only have direct control over this page. No one can edit or promote level 5. Access Level 4 cannot promote others to access level 4. <b>ALL ACTIONS ARE RECORDED.</b><BR><table bgcolor=E0E0E0 width=95% cellpadding=0 cellspacing=0 class=tablexx align=center><tr><td align=center><BR>";
				echo "<b>Select Permission to Change</b>";
				echo "<form id='formx2' name='formx2' method='post' action='index.php?db=permissions&stage=0' onSubmit=\"submitonce(this);\">";
				echo "<select name='mbrname' id='mbrname'>";
				$ss_result = mysql_query("SELECT * FROM `useraccess` ORDER BY `username`");
				while($row = mysql_fetch_assoc($ss_result)) {
					if($row['accesslevel'] <= 4 && !($row['letinby'] == 0)) {
					echo "<option value='".$row['id']."'>".$row['username']." [".$row['accesslevel']."]</option>";
					}
				}
				echo "</select>";
				echo "<select name='lv' id='lv'>";
				$kcount = 0;
				while($kcount < 5) {
				echo "<option value=".$kcount.">Level ".$kcount."</option>";
				++$kcount;
				}
				echo "</select>";
				echo "<input type='submit' name='Submit' value='Change Permission' class=forms>";
				echo "</form><BR>";
				echo "</td></tr></table><BR>";
				}
			echo "</div></div>";
			
		}
	} elseif($_GET['db'] == "bglist" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		echo "<div class=\"center_header\">";
		echo "List of the Background Check Pendings";
		echo "</td></tr><tr><td valign=top align=left bgcolor=ffffff><BR>";
		
			if(isset($_GET['p']) && isset($_GET['u'])) {
				if($_GET['p'] == "2" || $_GET['p'] == "1") {
					$viewidx = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$_GET['u']."'");
					$viewrowz = mysql_fetch_row($viewidx);
					mysql_query("UPDATE `mbrlist` SET `bgcheck` = '".$_GET['p']."' WHERE `id` = '".$_GET['u']."'");
					mysql_query("DELETE FROM `checklogs` WHERE `userid` = '".$_GET['u']."'");
					mysql_query("DELETE FROM `bgpending` WHERE `userid` = '".$_GET['u']."'");
					logfile($_SESSION['id'], bgcodeplain($_GET['p'])."ed ".$viewrowz[1]." on Pending List");
					echo "<script language=\"javascript\">";
					echo "alert(\"Status Changed\");";
					echo "window.location=\"index.php?db=bglist\";";
					echo "</script>";
				}
			}
		
			if(isset($_GET['viewbglist'])) {
			$astat = array();
			$stat_view = mysql_query("SELECT * FROM `checklogs` WHERE `userid` = '".$_GET['viewbglist']."' ORDER BY `gameid` DESC");
			echo "<h4><a href=\"#botsd\">View Statistics of User</a></h4>";
			$viewid = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$_GET['viewbglist']."'");
			$viewrow = mysql_fetch_row($viewid);
			echo "<center><b><font size=3>".$viewrow[1]."</font></b> [<a href=index.php?db=bglist&u=".$viewrow[0]."&p=2 style=\"color: green\">Pass</a>] - [<a href=index.php?db=bglist&u=".$viewrow[0]."&p=1 style=\"color: red\">Fail</a>]</center>";
			echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
			$result_bgp = mysql_query("SELECT * FROM `checklogs` WHERE `userid` = '".$_GET['viewbglist']."' ORDER BY `gameid` DESC");
				while($row_bgp = mysql_fetch_assoc($result_bgp)) {
					echo "<tr><td><a href='http://www.bungie.net/Stats/GameStatsHalo2.aspx?gameid=".$row_bgp['gameid']."&player=".str_replace(" ", "%20", $row_bgp['gamertag'])."' target=_blank>".$row_bgp['gameid']."</a></td><td><a href='http://www.bungie.net/Stats/GameStatsHalo2.aspx?gameid=".$row_bgp['gameid']."&player=".str_replace(" ", "%20", $row_bgp['gamertag'])."' target=_blank>".$row_bgp['gamertag']."</a></td></tr>";
					$astat[$row_bgp['gameid']][] = $row_bgp['gamertag'];
					$numg = $row_bgp['numtags'];
					$numc = $row_bgp['numclans'];
				}
			echo "</table><BR>";
			$countclans = array();
			$gblk = array();//blk tags
			$checktags = mysql_query("SELECT * FROM `blkclans`");
				while($row = mysql_fetch_assoc($checktags)) {
					$cblk[] = strtolower($row['cblktag']);
					$countclans[strtolower($row['cblktag'])] = 0;
				}
			echo "<a href=#>Back to the Top</a><table border=0 align=center width=430>";
			echo "<tr><td><a id=\"botsd\"></a>Number of Games</td><td>".count($astat)."</td></tr>";
				if(count($astat) <= 200) {
					echo "<tr><td colspan=2 align=center><b>PLAYER HAS LESS THAN 200 GAMES<BR>All Games Listed</b></td></tr>";
				} else {
					echo "<tr><td>Blacklisted Gamertags Encounters</td><td>".$numg."</td></tr>";
					echo "<tr><td>Blacklisted Clans Encounters</td><td>".$numc."</td></tr>";
				}
					foreach($astat as $keyx=>$valuex) {
						foreach($valuex as $gamertags) {
						$tag_gt = substr($gamertags, 0, 3);
							if(in_array($tag_gt, $cblk)) {
								++$countclans[$tag_gt];
							}
						}
					}
				arsort($countclans, SORT_NUMERIC);
				echo "<tr><td colspan=2 align=center><B>Encounters with Blacklisted Clans</B></td></tr>";
					foreach($countclans as $key=>$value) {
						echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
					}
				
				
				
			echo "</table>";
			} else {
			echo "This is where you fail or pass pending bgchecks.<BR>";
			$checkup = mysql_query("SELECT * FROM `bgpending`");
				if(mysql_num_rows($checkup) == 0) {
					echo "<BR><center><b>Currently, no pending background checks have been filed.</b></center>";
				} else {
					while($checkrow = mysql_fetch_assoc($checkup)) {
						$personx = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$checkrow['userid']."'");
						if(mysql_num_rows($personx) == 0) {
							mysql_query("DELETE FROM `checklogs` WHERE `userid` = '".$checkrow['userid']."'");
							mysql_query("DELETE FROM `bgpending` WHERE `userid` = '".$checkrow['userid']."'");
						}
					}
				$checkups = mysql_query("SELECT * FROM `bgpending`");
				echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
				echo "<tr id=ignore><td bgcolor=E0E0E0>Pending Background Checks</td></tr>";
					while($row = mysql_fetch_assoc($checkups)) {
						$viewid = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$row['userid']."'");
						$viewrow = mysql_fetch_row($viewid);
						echo "<tr><td><a href=index.php?db=bglist&viewbglist=".$row['userid'].">".$viewrow[1]."</a></td></tr>";
					}
				echo "</table>";
				}
			}
		echo "<BR></td></tr></table>";
		}
	} elseif($_GET['db'] == "codegen" && isset($_SESSION['id'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		if(isset($_POST['gensquad'])) {
			if($_POST['gensquad'] == 0) {
			$_SESSION['error'] = 5;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			} else {
			$ranvar = rand(1000000000, 2147483647);
			$sqlx = "INSERT INTO `codes` (`squadid`, `codechars`) VALUES ('".$_POST['gensquad']."', '".$ranvar."')";
			mysql_query($sqlx);
			logfile($_SESSION['id'], "Created Code: ".$ranvar);
			}
		}
		echo "<div class=\"center_header\">";
		echo "Generate Key Codes for Registration";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		echo "Clan Directors and Website Admins will have to generate codes for divisions.<BR><BR>";
		echo "<table bgcolor=E0E0E0 width=95% cellpadding=0 cellspacing=0 class=tablexx align=center><tr><td align=center><BR>";
		echo "<form id='formx' name='formx' method='post' action='#' onSubmit=\"submitonce(this);\">";
		echo "<select name='gensquad' id='gensquad'>";
		echo "<option value='0'>--Select Division--</option>";
		$dbsql = "SELECT * FROM `divisions` WHERE `visable` = '0' ORDER BY `diviname`";
		$dbresult = mysql_query($dbsql);
		while($dbrow = mysql_fetch_assoc($dbresult)) {
			if($dbrow['id'] == 37) {//block leader list
			} else {
				echo "<option value='".$dbrow['id']."'>".$dbrow['diviabbr']." - ".$dbrow['diviname']."</option>";
			}
		}
		echo "</select>";
		echo " <input type='submit' name='Submit' value='Generate Code' class=forms></form>";
		echo "</td></tr></table><BR><BR>";
		$count = 0;
		$dbsql = "SELECT * FROM `codes` ORDER BY `squadid`";
		$dbresult = mysql_query($dbsql);
			if($dbresult) {
				if(mysql_num_rows($dbresult) == 0) {
				echo "<font size=1><b><center>There are no active codes, generate more if needed.</center></b></font><BR><BR>";
				} else {
					echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
					echo "<tr id=ignore bgcolor=E0E0E0><td></td><td>Division Name</td><td>Code</td></tr>";
					while($row = mysql_fetch_assoc($dbresult)) {
					echo "<tr><td><font size=1><b>&nbsp;".++$count."&nbsp;</b></font></td><td>".divi($row['squadid'])." - ".diviname($row['squadid'])."</td><td>".$row['codechars']."</td></tr>";
					}
					echo "</table><BR>";
				}
			} else {
			echo mysql_error();
			}
		echo "</div></div>";
		}
	} elseif($_GET['db'] == "adminsettings" && isset($_SESSION['id'])) {
	############################################################ADMIN SETTINGS HERE###################################################
		if(dataRetrieve($_SESSION['id'], "accesslevel") == 5) {
		echo "<div class=\"center_header\">";
		echo "Adminstration Settings";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			if(isset($_GET['am'])) {
				if($_GET['am'] == "1") {
				include("dellist.php");
				}
				if($_GET['am'] == "2") {
					if(isset($_GET['s'])) {
						if(isset($_GET['p'])) {
						echo "<a href=index.php?db=adminsettings&am=2>Back</a><BR>";
						echo "<BR>";
						echo "<center>";
							if($_GET['p'] == 0) {
							$limnum = 0;
							} else {
							$limnum = $_GET['p'] * 200;
							}	
						$rowresult = mysql_query("SELECT * FROM `logs` WHERE `userid` = '".$_GET['s']."'");
						$rownum = mysql_num_rows($rowresult);
						$pagecount = 0;
						echo "Page Numbers:";
							while($rownum > 0) {
							if($_GET['p'] == $pagecount) {
							echo "<b>".($pagecount + 1)."</b> ";
							} else {
							echo "<a href=index.php?db=adminsettings&am=2&s=".$_GET['s']."&p=".$pagecount.">".($pagecount + 1)."</a> ";
							}
							++$pagecount;
							$rownum = $rownum - 200;
							}
						$asql = "SELECT * FROM `logs` WHERE `userid` = '".$_GET['s']."' ORDER BY `id` DESC LIMIT ".$limnum.",200";
						$aresult = mysql_query($asql);
						echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center bgcolor=ffffff class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
						echo "<tr id=ignore><td colspan=3 bgcolor=E0E0E0><b>Current Logs</b></td></tr>";
						while($row = mysql_fetch_assoc($aresult)) {
						echo "<tr bgcolor=ffffff><td align=left>[<b><font size=1>".dataRetrieve($row['userid'], "username")."</font></b>]<BR><b><font size=1 color=999999>[".$row['ip']."]</font></b></td><td align=left><font size=1>".$row['action']."</font><BR><font size=1 color=999999>".$row['time']." MT</font></td><td><font size=1>".$row['date']."</font></td></tr>";
						}
						echo "<tr id=ignore><td colspan=3 align=center><a href=index.php?db=adminsettings&am=2>View a User's Log File</a> :: <a href=index.php?db=adminsettings&am=3>View Entire Log File</a>";
						echo "</table><BR>";
						} else {
						echo "<script language=\"javascript\">";
						echo "window.location=\"index.php?db=adminsettings&am=3&p=0\";";
						echo "</script>";
						}
					} else {
						if(isset($_POST['names'])) {
						echo "<script language=\"javascript\">";
						echo "window.location=\"index.php?db=adminsettings&am=2&s=".$_POST['names']."&p=0\";";
						echo "</script>";
						} else {
						echo "Admins: Spy on people if you must! (Also this features is good for getting evidence on potential clan hitters)";
						echo "<form id='form1s' name='form1s' method='post' action='#' onSubmit=\"submitonce(this);\">";
						echo "<select id=names name=names>";
						$rrr = mysql_query("SELECT * FROM `useraccess` ORDER BY `username`");
						echo "<option value=0>--Select a Member--</option>";
							while($row = mysql_fetch_assoc($rrr)) {
								echo "<option value=".$row['id'].">".$row['username']."</option>";
							}
						echo "</select>";
						echo "<input type=Submit value='Spy/Search/Whatever'>";
						echo "</form>";
						echo "<a href=index.php?db=adminsettings>Back</a>";
						}
					}
				}
				if($_GET['am'] == "3") {
					if(isset($_GET['p'])) {
					echo "<a href=index.php?db=adminsettings>Back</a><BR>";
					echo "<BR>";
					echo "<center>";
						if($_GET['p'] == 0) {
						$limnum = 0;
						} else {
						$limnum = $_GET['p'] * 200;
						}	
					$rowresult = mysql_query("SELECT * FROM `logs`");
					$rownum = mysql_num_rows($rowresult);
					$pagecount = 0;
					echo "Page Numbers:";
						while($rownum > 0) {
						if($_GET['p'] == $pagecount) {
						echo "<b>".($pagecount + 1)."</b> ";
						} else {
						echo "<a href=index.php?db=adminsettings&am=3&p=".$pagecount.">".($pagecount + 1)."</a> ";
						}
						++$pagecount;
						$rownum = $rownum - 200;
						}
					$asql = "SELECT * FROM `logs` ORDER BY `id` DESC LIMIT ".$limnum.",200";
					$aresult = mysql_query($asql);
					echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
					echo "<tr id=ignore><td colspan=3 bgcolor=ffffff><b>Current Logs</b></td></tr>";
					while($row = mysql_fetch_assoc($aresult)) {
					echo "<tr><td align=left>[<b><font size=1>".dataRetrieve($row['userid'], "username")."</font></b>]<BR><b><font size=1 color=999999>[".$row['ip']."]</font></b></td><td align=left><font size=1>".$row['action']."</font><BR><font size=1 color=999999>".$row['time']." MT</font></td><td><font size=1>".$row['date']."</font></td></tr>";
					}
					echo "<tr id=ignore><td colspan=3 align=center><a href=index.php?db=adminsettings&am=2>View a User's Log File</a> :: <a href=index.php?db=adminsettings&am=3>View Entire Log File</a></td></tr>";
					echo "</table><BR>";
					} else {
					echo "<script language=\"javascript\">";
					echo "window.location=\"index.php?db=adminsettings&am=3&p=0\";";
					echo "</script>";
					}
				}
				if($_GET['am'] == "4") {
				mysql_query("DELETE FROM `logs`");
				mysql_query("DELETE FROM `squadlogs`");
				logfile($_SESSION['id'], "Cleared Logs and Squad Logs");
				echo "<script language=\"javascript\">";
				echo "alert(\"Cleared Logs\");";
				echo "window.location=\"index.php?db=adminsettings\";";
				echo "</script>";
				}
				if($_GET['am'] == "5") {
				mysql_query("DELETE FROM `chatbox`");
				logfile($_SESSION['id'], "Cleared Chatbox");
				echo "<script language=\"javascript\">";
				echo "alert(\"Chatbox Cleared\");";
				echo "window.location=\"index.php?db=adminsettings\";";
				echo "</script>";
				}
				if($_GET['am'] == "10" && $_SESSION['id'] == 1) {
				mysql_query("DELETE FROM `mbrlist` WHERE `visable` = '1'");
				mysql_query("DELETE FROM `squads` WHERE `visable` = '1'");
				mysql_query("DELETE FROM `divisions` WHERE `visable` = '1'");
				$loop = mysql_query("SELECT * FROM `codes`");
					while($row = mysql_fetch_assoc($loop)) {
						if(divitf($row['squadid']) == 1) {
							mysql_query("DELETE FROM `codes` WHERE `squadid` = '".$row['squadid']."'");
						}
					}
				logfile($_SESSION['id'], "<b>Emptied Recycling Bin</b>");
				echo "<script language=\"javascript\">";
				echo "alert(\"Recycling bin emptied. Cannot recover past actions.\");";
				echo "window.location=\"index.php?db=adminsettings\";";
				echo "</script>";
				}
				if($_GET['am'] == "6") {
					if(isset($_POST['ipb'])) {
					mysql_query("INSERT INTO `ipban` (`ip`) VALUES ('".$_POST['ipb']."')");
					logfile($_SESSION['id'], "IP Banned <u>".$_POST['ipb']."</u>");
					echo "<script language=\"javascript\">";
					echo "alert(\"IP Banned\");";
					echo "window.location=\"index.php?db=adminsettings&am=6\";";
					echo "</script>";
					}
					if(isset($_GET['ipdel'])) {
					mysql_query("DELETE FROM `ipban` WHERE `ip` = '".$_GET['ipdel']."'");
					logfile($_SESSION['id'], "Unbanned <u>".$_GET['ipdel']."</u>");
					echo "<script language=\"javascript\">";
					echo "alert(\"IP Unbanned\");";
					echo "window.location=\"index.php?db=adminsettings&am=6\";";
					echo "</script>";
					}
						echo "This is where you block someone's IP (Computer Location). No adding *s because HB DR 7 likes blocking 50% of the world.<BR><BR>IPs from Access levels 0-4<BR><select id=nameas name=namesa class=forms>";
						$rrr = mysql_query("SELECT * FROM `useraccess` ORDER BY `username`");
						echo "<option value=0>--Select a Member--</option>";
							while($row = mysql_fetch_assoc($rrr)) {
							echo "<option>[".$row['ipaddress']."] ".$row['username']."</option>";
							}
						echo "</select>";
					echo "<BR><BR><table cellpadding=0 cellspacing=0 border=0 bgcolor=E0E0E0 width=95% align=center><tr><td align=center>";
					echo "<BR><form id='form1aa' name='form1aa' method='post' action='#' onSubmit=\"submitonce(this);\">";
					echo "Type in IP<BR><input name='ipb' type='text' id='ipb' size='15' maxlength='50' class=forms><input name=subsjs type=Submit id=subsjs value='Ban' class=forms>";
					echo "</form>";
					echo "</td></tr></table><BR>";
					
					echo "<table width='470' border='0' cellspacing='0' cellpadding='0' class=tablexx align=center onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
					$resulto = mysql_query("SELECT * FROM `ipban` ORDER BY `ip`");
					echo "<tr id=ignore><td>Existing IP Bans</td></tr>";
					while($rowg = mysql_fetch_assoc($resulto)) {
						echo "<tr><td>".$rowg['ip']."</td><td><a href='index.php?db=adminsettings&am=6&ipdel=".$rowg['ip']."'>Delete</a></td></tr>";
					}
					echo "</table><BR>";
					
				}
				if($_GET['am'] == "9") {
				echo "<BR><form id='form1aa' name='form1aa' method='post' action='http://whatismyipaddress.com/staticpages/index.php/lookup-results' onSubmit=\"submitonce(this);\">";
				echo "<input name=\"LOOKUPADDRESS\" type=\"text\" value=\"68.10.192.39\" size=\"12\" maxlength=\"255\" class=forms>";
				echo "<input name=subsjs type=Submit id=subsjs value='GO!' class=forms>";
				echo "</form>";
				}
				if($_GET['am'] == "7") {
					if(isset($_POST['switch'])) {
						if($_POST['switch'] == 2) {
							$check_alert = mysql_query("SELECT * FROM `alert`");
							if(mysql_num_rows($check_alert) == 1) {
								mysql_query("DELETE FROM `alert`");
								logfile($_SESSION['id'], "Disabled Alert Messaging");
								echo "<script language=\"javascript\">";
								echo "alert(\"Alert Messaging disabled.\");";
								echo "</script>";
							} elseif(mysql_num_rows($check_alert) == 0) {
								echo "<script language=\"javascript\">";
								echo "alert(\"Alert Messaging is already disabled.\");";
								echo "</script>";
							}
						} elseif($_POST['switch'] == 1){
							if(empty($_POST['amsg'])) {
								echo "<script language=\"javascript\">";
								echo "alert(\"Alert Message Field was empty.\");";
								echo "</script>";
							} else {
								mysql_query("DELETE FROM `alert`");
								$alert_message = replaceMessage($_POST['amsg']);
								mysql_query("INSERT INTO `alert` (`textalert`) VALUES ('".$alert_message."')");
								logfile($_SESSION['id'], "Enabled Alert Messaging");
								echo "<script language=\"javascript\">";
								echo "alert(\"Alert Messaging is Enabled, click the next link to view\");";
								echo "</script>";
							}
						}
					}
				echo "Post a message banner across the top of RDClan about any breaking news or important information you want the users to view any time.";
				echo "<center><BR><u>Legend</u><BR>";
				echo "<BR><b>Bold</b> - [b]Bold[/b]";
				echo "<BR><u>Underline</u> - [u]Underline[/u]";
				echo "<BR><i>Italic</i> - [i]Italic[/i]<BR><BR></center>";
				echo "<form id='form1aas' name='form1aas' method='post' action='#' onSubmit=\"submitonce(this);\">";
				echo "<table align=center border=0 width=430>";
				
				echo "<tr><td>Toggle Alert Message<BR><font size=1><i>Leave message blank if turning off</i></font></td><td>Off <input name='switch' type='radio' value='2'> On <input name='switch' type='radio' value='1'></td></tr>";
				echo "<tr><td>Type in a <b>brief</b> message</td><td><input name='amsg' type='text' id='amsg' size='25' class=forms></td></tr>";
				echo "<tr><td colspan=2 align=center><input name=subsjs type=Submit id=subsjs value='Submit' class=forms></td></tr>";
				echo "</table>";
				echo "</form>";
				}
			} else {
			$asql = "SELECT * FROM `logs` ORDER BY `id` DESC LIMIT 0,10";
			$aresult = mysql_query($asql);
			echo "<table border=0 cellspacing=0 width=95% cellpadding=0 align=center class=tablexx onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
			echo "<tr id=ignore><td colspan=3 bgcolor=E0E0E0><b>Current Logs</b></td></tr>";
			while($row = mysql_fetch_assoc($aresult)) {
			echo "<tr><td align=left>[<b><font size=1>".dataRetrieve($row['userid'], "username")."</font></b>]<BR><b><font size=1 color=999999>[".$row['ip']."]</font></b></td><td align=left><font size=1>".$row['action']."</font><BR><font size=1 color=999999>".$row['time']." MT</font></td><td><font size=1>".$row['date']."</font></td></tr>";
			}
			echo "<tr id=ignore><td colspan=3 align=center><a href=index.php?db=adminsettings&am=2>View a User's Log File</a> :: <a href=index.php?db=adminsettings&am=3>View Entire Log File</a></td></tr>";
			echo "</table><BR><BR>";
			$countsqlb = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '1'");
			echo "<table width='470' border='0' cellspacing='0' cellpadding='0' class=tablexx align=center onMouseover=\"changeto(event, 'E0E0E0')\" onMouseout=\"changeback(event, 'ffffff')\">";
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=1>Remove Member from Access List</a></td></tr>";
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=5>Clear Chatbox</a></td></tr>";
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=6>IP Ban</a></td></tr>";
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=9>IP Geographical Location</a></td></tr>";
			if($_SESSION['id'] == 1) {
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=10>Empty Recycling Bin (".mysql_num_rows($countsqlb).")</a></td></tr>";
			} else {
			echo "<tr height=20><td><i><font color=cccccc>Empty Recycling Bin (".mysql_num_rows($countsqlb).")</font></i></td></tr>";
			}
			echo "<tr height=20><td><a href=index.php?db=adminsettings&am=7>Alert Message</a></td></tr>";
			/*echo "<tr height=20><td><a href=index.php?db=adminsettings&am=8>News Edit</a></td></tr>";*/
			echo "</table><BR>";
			
			}
		echo "</div></div>";
		} else {
		$_SESSION['error'] = 2;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		}
	############################################################ADMIN SETTINGS HERE###################################################
	} elseif($_GET['db'] == "cp" && isset($_SESSION['id'])) {//Control Panel ###LOGIN###
			echo "<div class=\"center_header\">";
			echo "Control Panel";
			echo "</div><div class=\"center_content\"><div class=\"news_post\">";
			echo "<center><BR><img src=images/ksiclan-controlpanel.jpg></center>";
			echo "<center><br><a href=index.php?db=myclans><img src=images/icons/myclans.gif></br></center>";
			echo "<center><br><a href=index.php?db=cpsetting><img src=images/icons/settings.gif></br></center>";
			echo "<center><br><a href=index.php?db=cpmylogfile><img src=images/icons/mylogs.gif></br></center>";
			echo "<center><br><a href=index.php?db=request><img src=images/icons/requestlist.gif></br></center>";
			echo "<center><br><a href=index.php?db=addsquad><img src=images/icons/addsquad.gif></br></center>";
			echo "<center><br><a href=index.php?db=delsquad><img src=images/icons/delsquad.gif></br></center>";
			echo "<center><br><a href=index.php?db=adddiv><img src=images/icons/adddivision.gif></br></center>";
			echo "<center><br><a href=index.php?db=deldiv><img src=images/icons/deldivision.gif></br></center>";
			echo "<center><br><a href-index.php?db=permissions><img src=images/icons/permissions.gif></br></center>";
			echo "<center><br><a href=index.php?db=cpblk><img src=images/icons/blacklist.gif></br></center>";
			echo "<center><br><a href=index.php?db=codegen><img src=images/icons/codes.gif></br></center>";
			echo "<center><br><a href=index.php?db=securitycheck%divi=0&sss=345><img src=images/icons/leaderslist.gif></br></center>";
			echo "<center><br><a href=index.php?db=dt><img src=images/icons/dt.gif></br></center>";
			echo "<center><br><a href=index.php?db=adminsettings><img src=images/icons/admin.gif></br></center>";
			echo "<BR>";
			$tcnt = 0;
			echo "<table align=center width=435 cellpadding=0 cellspacing=0 border=0>";
			foreach(return_menu() as $item) {
				++$tcnt;
				if($tcnt == 1) {
					echo "<tr>";
				}
				list($fullname, $name, $url) = explode("-", $item);
				echo "<td width=145 height=50 align=center><a href=".$url." style='width: 125px; height: 35px; display: box; margin: 3px;'></a></td>";
				if($tcnt == 3) {
					echo "</tr>";
					$tcnt = 0;
				}
			}
			echo "</table>";
			###
			echo "</div></div>";
		
	} else { // page doesnt exsist
	$_SESSION['error'] = 2;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";

	}


} else {
include("homepage.php");
/*
	echo "<table width=99% border=0 cellspacing=1 cellpadding=1 bgcolor=ffffff class=tablexx>";
	echo "<tr><td valign=top>";
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class=tablexx height=100%><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "Chatbox";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		include("./homepage_chatbox.php");
		echo "</td> </tr> </table>";
	echo "</td><td>";
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class=tablexx height=100%><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
	echo "Search Gamertag";
	echo "</td></tr><form id='form1' name='form1' method='post' action='index.php?db=sg' onSubmit=\"submitonce(this);\"><tr><td valign=top align=center bgcolor=E0E0E0 height=148>";
	//echo "<a href=\"index.php?db=contest\"><img src=\"images/contestad.jpg\" alt=\"RDClan Contest\" name=\"Image1\" width=\"360\" height=\"100\" border=\"0\" style=\"solid 1px #E0E0E0\"></a><BR>";
	echo "<table cellpadding=0 cellspacing=0 border=0 width=100% height=100%><tr><td bgcolor=ffffff height=100% align=center>";
	echo "<div id='txtHint' width=100% height=100%><table cellpadding=0 cellspacing=0 border=0 height=100%><tr><td valign=middle align=center><b>Type in the box below for a quick search.</b></td></tr></table></div>";
	echo "</td></tr><tr><td valign=bottom align=left>";
	echo "Search:<input name='".date('l dS \of F Y h:i:s A')."' type='text' id='".date('l dS \of F Y h:i:s A')."' size='48' maxlength='17' class=forms onKeyUp='showUser(this.value)' />";
	echo "</td> </tr> </table>";
	echo "</td></tr></form></table>";
	echo "</tr><tr><td valign=top>";
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class=tablexx><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "RD";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		$newrow = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
		echo "Total RD Members: <b>".mysql_num_rows($newrow)."</b><BR>";
		$newrow5 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Halo 3'");
		echo "Total RD Halo 3 Members: <b>".mysql_num_rows($newrow5)."</b><BR>";
		$newrow61 = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' AND `gametype` = 'Call of Duty 4'");
		echo "Total RD Call of Duty 4 Members: <b>".mysql_num_rows($newrow61)."</b><BR>";
		$newrow2 = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0'");
		echo "Total Squads: <b>".mysql_num_rows($newrow2)."</b><BR>";
		$newrow3 = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0'");
		echo "Total Divisions: <b>".mysql_num_rows($newrow3)."</b><BR>";
		$newrow4 = mysql_query("SELECT * FROM `blklist`");
		echo "Total Blacklist: <b>".mysql_num_rows($newrow4)."</b><BR>";
		echo "</td> </tr> </table>";
	echo "</td><td valign=top>";
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class=tablexx><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "Newest RD Members added to Database";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		$newksi = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' ORDER BY `id` DESC LIMIT 0,6");
		while($row = mysql_fetch_assoc($newksi)) {
			echo "[".$row['gametype']."] ".$row['name']."<BR>";
		}
		echo "<i><a href=http://ksiclan.net/index.php?db=ksimembers&dm=1>More...</a></i>";
		echo "</td> </tr> </table>";
	echo "</tr><tr><td width=100% valign=top>";
		echo "<table width='100%' height='203' border='0' cellspacing='0' cellpadding='0' class=tablexx><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "RDClan News";
		echo "</div><div class=\"center_content\"><div class=\"news_post\">";
		$handle = fopen("homepage.php", "rb");
		$contents = '';
		while (!feof($handle)) {
		  $contents .= fread($handle, 8192);
		}
		echo $contents;
		fclose($handle);
		echo "</td> </tr> </table>";
	echo "</td><td valign=top>";
		echo "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='360' height='203'>";
		echo "<param name='movie' value='images/ad.swf'>";
		echo "<param name='quality' value='high'>";
		echo "<param name='menu' value='false'>";
		echo "<embed src='images/ad.swf' menu='false' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='360' height='203' quality='autohigh'></embed>";
		echo "</object>";
	echo "</td></tr><tr><td colspan=2>";
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class=tablexx><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "Bungie.net News";
		echo "</td></tr><tr><td valign=top align=left bgcolor=ffffff><BR>";
		include("functions/rssfunction.php");
		echo "</td></tr></table><BR>";
	echo "</td> </tr> </table>";
	)*/
	include("functions/rssfunction.php");
}

}### END MAIN

function left() {
	if(isset($_GET['db'])) {
	echo "<div class=\"center_header\">";
	echo "Chat Area";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	
	include("./chatbox.php");
	
	echo "</td></tr></table><BR>";
	##Break
	echo "<div class=\"center_header\">";
	echo "Search Gamertag";
	echo "</td></tr><tr><td valign=top align=center bgcolor=E0E0E0>";
	echo "<BR><form id='form1' name='form1' method='post' action='index.php?db=sg' onSubmit=\"submitonce(this);\">";
	echo "Type in Gamertag<BR><input name='uu' type='text' id='uu' size='15' maxlength='17' class=forms /><input name=subs type=Submit id=subs value=Go class=forms />";
	echo "</form>";
	echo "</td></tr></table><BR>";
	##Break
	echo "<div class=\"center_header\">";
	echo "Site Statistics";
	echo "</div><div class=\"center_content\"><div class=\"news_post\">";
	echo "Newest registered user:";
	$xsql = "SELECT * FROM `useraccess` ORDER BY `id` DESC LIMIT 0,1";
	$xrow = mysql_fetch_assoc(mysql_query($xsql));
	echo "<BR><b>".$xrow['username']."</b>";
	
	echo "<BR>Newest RD Member:<BR>";
	$newksi = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0' ORDER BY `id` DESC LIMIT 0,1");
	$ksirow = mysql_fetch_row($newksi);
	echo "<b>[".$ksirow['7']."] ".$ksirow['1']."</b>";
	
	echo "<BR>RD of Members Added:";
	$newrow = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
	echo "<br><b>".mysql_num_rows($newrow)."</b>";
	
	echo "</td> </tr> </table>";
	}
}
?>