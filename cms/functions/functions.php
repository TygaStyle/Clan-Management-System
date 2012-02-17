<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

function xboxgt($gt, $type, $gid) {
echo "<table cellpadding=0 cellspacing=0 border=0 class=forms width=200>";
/*
	require_once('functions/Snoopy.class.php');
	require_once('functions/GamerCard.class.php');
	
	$_TAG = str_replace(" ", "+", $gt);
	if(isset($_GET['gamertag']))
		if (is_string($_GET['gamertag']))
			$_TAG = str_replace(' ', '%20', $_GET['gamertag']);
	
	$_FORCE = false;
	if(isset($_GET['force']))
		if (is_numeric($_GET['force']))
			$_FORCE = ($_GET['force'] == 1);
	
	$GamerCard = GamerCard::Fetch($_TAG, $_FORCE);
	if(isset($GamerCard['rep'])) {
	if(isset($GamerCard['score'])) {
	if(isset($GamerCard['zone'])) {
	if(isset($GamerCard['lastplayedhtml'])) {
	
	if($GamerCard['rep'] == "http://gamercard.xbox.com" || empty($GamerCard['rep'])) {
		$GamerCard['rep'] = "http://gamercard.xbox.com/xweb/lib/images/gc_repstars_external_0.gif";
	}
	if($GamerCard['score'] == "") {
		$GamerCard['score'] = 0;
	}
	if($GamerCard['zone'] == "") {
		$GamerCard['zone'] = "n/a";
	}
	*/
	//echo "<table cellspacing=0 border=0 width=266><tr><td class=forms align=center valign=center>";
	//echo "<img src=\"".$GamerCard['tile']."\" width=32 height=32>";
	//echo "</td><td>";
	$colorstyle = dataRetrieve($gid, "colorcode");
	$namestr = str_replace("+", " ", $gt);
	$rgbcolor = html2rgb("#".$colorstyle);
	//<img src='images/gamerpic.php?text=".$gt."&rgb=".$rgbcolor[0]."-".$rgbcolor[1]."-".$rgbcolor[2]."' />
	echo "<tr><td colspan=2><b>".colorname($namestr, $colorstyle)."</b></td></tr>";
	//echo "<tr bgcolor=757575><td>Score: <b>".$GamerCard['score']."</b></td><td align=right><img src=".$GamerCard['rep']."></td></tr>";
	//echo "<tr bgcolor=333333><td>Zone:</td><td align=right><b>".$GamerCard['zone']."</b></td></tr>";
	//echo "<tr><td colspan=2 align=center>".str_replace(" /></a>", "border=0 /></a> ", $GamerCard['lastplayedhtml'])."</td></tr>";


	//echo "</td></tr></table>";
	/*}
	}
	}
	}*/
	if($type == 1) {
	echo "<tr><td align=center colspan=2 onClick=\"return clickreturnvalue()\" onMouseover=\"dropdownmenu(this, event, menu5, '198px')\" onMouseout=\"delayhidemenu()\"><font size=1>M e n u</font></td></tr>";
	}
	echo "</table>";
}

function rgb2html($r, $g=-1, $b=-1)
{
if (is_array($r) && sizeof($r) == 3)
list($r, $g, $b) = $r;

$r = intval($r); $g = intval($g);
$b = intval($b);

$r = dechex($r<0?0:($r>255?255:$r));
$g = dechex($g<0?0:($g>255?255:$g));
$b = dechex($b<0?0:($b>255?255:$b));

$color = (strlen($r) < 2?'0':'').$r;
$color .= (strlen($g) < 2?'0':'').$g;
$color .= (strlen($b) < 2?'0':'').$b;
return '#'.$color;
} 

function html2rgb($color)
{
if ($color[0] == '#')
$color = substr($color, 1);

if (strlen($color) == 6)
list($r, $g, $b) = array($color[0].$color[1],
$color[2].$color[3],
$color[4].$color[5]);
elseif (strlen($color) == 3)
list($r, $g, $b) = array($color[0], $color[1], $color[2]);
else
return false;

$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

return array($r, $g, $b);
}

function findalert($n) {
	if($n == 1) {
		$checkexist = mysql_query("SELECT * FROM `alert`");
		if(mysql_num_rows($checkexist) == 0) {
			return false;
		} elseif(mysql_num_rows($checkexist) == 1) {
			return true;
		}
	} elseif ($n == 2) {
		$exist = mysql_query("SELECT * FROM `alert`");
		$findrow = mysql_fetch_row($exist);
		echo "<table width='99%' border='0' cellspacing='0' cellpadding='0' class=tablexx><tr><td height='16' background='images/tt.jpg' align=left style=\"color:ffffff\">";
		echo "Alert Message";
		echo "</td></tr><tr><td valign=top align=left bgcolor=ffffff>";
		echo "<BR><center>".afterMsg($findrow[2])."</center><BR>";
		echo "</td></tr></table>";
	} else {
		return false;
	}
}
/*
function cleanInput($input) {
//small function for universal bad input filtering
	if ((!empty($input)) && ($input != NULL)) {
		// This strips all html and php tags, hopefully ;/
		strip_tags(trim($input));
		if(get_magic_quotes_gpc()) {
			//small addition to stripslashes if magic quotes is on, damn server.. lol
			$input = stripslashes($input);
		}
	}
	return $input;
}

*/

function cleanInput($clean) {
// Clan.net security patch
// Author: David
 $clean = trim($clean);
 $clean = htmlentities($clean);
 if (get_magic_quotes_gpc() == "0"){
  $clean = mysql_real_escape_string($clean);
 }else{
  $clean = mysql_real_escape_string(stripslashes($clean));
 }
 return $clean;
}

function getRank($rank) {
$divisioncount = 0;

	switch($rank) {
		case ++$divisioncount: return "Recruit"; break;
		case ++$divisioncount: return "Private"; break;
		case ++$divisioncount: return "Private First Class"; break;
		case ++$divisioncount: return "Specialist"; break;
		case ++$divisioncount: return "Sergeant"; break;
		case ++$divisioncount: return "Lieutenant"; break;
		case ++$divisioncount: return "Captain"; break;
		case ++$divisioncount: return "Major"; break;
		case ++$divisioncount: return "Colonel"; break;
		case ++$divisioncount: return "General"; break;
		case ++$divisioncount: return "Co-Founder"; break;
		case ++$divisioncount: return "Founder"; break;
		case ++$divisioncount: return "Co-Division Leader"; break;
		case ++$divisioncount: return "Division Leader"; break;
		case ++$divisioncount: return "Director"; break;
		case ++$divisioncount: return "Senior Director"; break;
		case ++$divisioncount: return "Chairman"; break;
		case ++$divisioncount: return "Major General"; break;
		case ++$divisioncount: return "Lieutenant General"; break;
		case ++$divisioncount: return "General"; break;
		case ++$divisioncount: return "Graphics Department"; break;
		case ++$divisioncount: return "Website Departmentt"; break;
		
	}
}
function getDiviAL($id) {
$sql = "SELECT * FROM `squads` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$squadrow = mysql_fetch_assoc($result);
$sqltwo = "SELECT * FROM `divisions` WHERE `id` = '".$squadrow['divisionid']."'";
$resulttwo = mysql_query($sqltwo);
$squadrowtwo = mysql_fetch_assoc($resulttwo);
return $squadrowtwo['diviabbr'];
}

function getDiviNAME($id) {
$sql = "SELECT * FROM `squads` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$squadrow = mysql_fetch_assoc($result);
$sqltwo = "SELECT * FROM `divisions` WHERE `id` = '".$squadrow['divisionid']."'";
$resulttwo = mysql_query($sqltwo);
$squadrowtwo = mysql_fetch_assoc($resulttwo);
return $squadrowtwo['diviname'];
}

function getDiviID($id) {
$sql = "SELECT * FROM `squads` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$squadrow = mysql_fetch_assoc($result);
$sqltwo = "SELECT * FROM `divisions` WHERE `id` = '".$squadrow['divisionid']."'";
$resulttwo = mysql_query($sqltwo);
$squadrowtwo = mysql_fetch_assoc($resulttwo);
return $squadrowtwo['id'];
}

function getSquad($id) {
$sql = "SELECT * FROM `squads` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
return $row['squadname'];
}

function squadcount($id) {
$sql = "SELECT * FROM `mbrlist` WHERE `sid` = '".$id."' AND `visable` = '0'";
$result = mysql_query($sql);
return mysql_num_rows($result);
}

function getSquadvv($id) {
$sql = "SELECT * FROM `squads` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
return $row['visable'];
}

function divicount($id) {
$totalsquadcount = 0;
$sql = "SELECT * FROM `divisions` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$newresultx = mysql_query("SELECT * FROM `squads` WHERE `divisionid` = '".$row['id']."' AND `visable` = '0'");
	while($oro = mysql_fetch_assoc($newresultx)) {
	$totalsquadcount = $totalsquadcount + squadcount($oro['id']);
	}
return $totalsquadcount;
}

function divi($id) {
$sql = "SELECT * FROM `divisions` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
return $row['diviabbr'];
}
function divitf($id) {
$sql = "SELECT * FROM `divisions` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0) {
		return 1;
	} else {
		return 2;
	}
}

function diviname($id) {
$sql = "SELECT * FROM `divisions` WHERE `id` = '".$id."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
return $row['diviname'];
}

function breakLongWords($str, $maxLength, $char){
    $wordEndChars = array(" ", "\n", "\r", "\f", "\v", "\0");
    $count = 0;
    $newStr = "";
    $openTag = false;
    for($i=0; $i<strlen($str); $i++){
        $newStr .= $str{$i};    
        
        if($str{$i} == "<"){
            $openTag = true;
            continue;
        }
        if(($openTag) && ($str{$i} == ">")){
            $openTag = false;
            continue;
        }
        
        if(!$openTag){
            if(!in_array($str{$i}, $wordEndChars)){//If not word ending char
                $count++;
                if($count==$maxLength){//if current word max length is reached
                    $newStr .= $char;//insert word break char
                    $count = 0;
                }
            }else{//Else char is word ending, reset word char count
                    $count = 0;
            }
        }
        
    }//End for    
    return $newStr;
} 

function replaceMessage($message) {
$message = str_replace("'", "[col]", $message);
$message = strip_tags($message, '<b></b><i></i><u></u><a></a>');
$message = htmlspecialchars($message);
$message = str_replace("\n", "<BR>", $message);
$message = str_replace("\\", "[bs]", $message);
$message = str_replace("[u]", "<U>", $message);
$message = str_replace("[/u]", "</U>", $message);
$message = str_replace("[i]", "<I>", $message);
$message = str_replace("[/i]", "</I>", $message);
$message = str_replace("[b]", "<B>", $message);
$message = str_replace("[/b]", "</B>", $message);

return $message;
}

function afterMsg($message, $numcount) {
$message = str_replace("\&", "&amp;", $message);
$message = str_replace("[col]", "'", $message);
$message = str_replace("\"", "&quot;", $message);
$message = str_replace("[bs]", "\\", $message);
$message = breakLongWords($message, $numcount, "<BR>");

return $message;
}
function replaceUrl($message, $urloverflow) {
// Make link from [url]htp://.... [/url] or [url=http://.... ]text[/url]
if (strpos($message, "[url")){
$begUrl = strpos($message, "[url");
$endUrl = strpos($message, "[/url]");
$url = substr($message, $begUrl, $endUrl-$begUrl+6);
$posBracket = strpos($url, "]");
if ($posBracket != null){
if ($posBracket == 4){  
// [url]http://.... [/url]
$link = substr($url, 5, $endUrl - $begUrl -5);
$htmlUrl    = "<a href=$link target=_blank>$link</a>";
$htmlUrl    = breakLongWords($htmlUrl, $urloverflow, "<BR>");
} else {            
 // [url=http://....]text[/url]
$link        = substr($url, 5, $posBracket-5);
$text        = substr($url, $posBracket+1, strpos($url, "[/url]") - $posBracket-1);
$htmlUrl    = "<a href=$link target=main>$text</a>";
$htmlUrl    = breakLongWords($htmlUrl, $urloverflow, "<BR>");
}
}
$message = str_replace($url, $htmlUrl, $message);
// searches for other [url]-codes

$message = replaceUrl($message);
}
return $message;
}

function data_errors($num) {
	if($num == 1) {// Login fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Login Failed</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;You did not fill out all the fields.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Username and/or Password were incorrect.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Username may not exist on the database.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your Username may have not been activated.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your account may have been banned or deleted.";
	echo "</td></tr></table><BR>";
	}
	if($num == 2) {// link fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Link not Available</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Link does not exist.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Link is only accessed through specificed users.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Link may be broken.";
	echo "</td></tr></table><BR>";
	}
	if($num == 3) {// message fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Message Failed to Send</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Message Box was left blank.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;You were signed out when you sent the message.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Message Box may be disabled or broken.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;HTML or other blocked coding tags were used.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your account may have been disabled when you submitted.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your internet failed loading the page.";
	echo "</td></tr></table><BR>";
	}
	if($num == 4) {// register fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Register Failed</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Fields were not filled out.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Password did not match Re-Password.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Email was invalid.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Email did not match Re-Email.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Terms were not accepted.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;You did not choose a squad.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your account already exists.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;You account is banned.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your IP Address is banned.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Security Code is invalid.";
	echo "</td></tr></table><BR>";
	}
	if($num == 5) {// code gen fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Code Generation Failed</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Squad was not selected.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Your internet dropped connection for 1-2 seconds.";
	echo "</td></tr></table><BR>";
	}
	if($num == 6) {// blk submit fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Black List Submition Failed</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Empty Fields.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Blacklisted user already exists.";
	echo "</td></tr></table><BR>";
	}
	if($num == 7) {// request fail
	echo "<BR><table class=tablexx cellpadding=0 cellspacing=0 border=0 align=center width=90% bgcolor=E0E0E0><tr><td valign=top>";
	echo "<h3>Set Access Level Failed</h3><i>Possible Errors:</i><BR><BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Fields Matched.<BR>&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Internet Problems.";
	echo "</td></tr></table><BR>";
	}
}

function lastactive($id) {
$sql = "UPDATE `useraccess` SET `lastactive` = '".date("m/d/y")." at ".date("H:ia")."' WHERE `id` = '".$id."'";
$result = mysql_query($sql);
}

function logfile($id, $action) {
mysql_query("INSERT INTO `logs` (`userid`, `date`, `action`, `ip`, `time`) VALUES ('".$id."', '".date("m/d/y")."', '".$action."', '".$_SERVER['REMOTE_ADDR']."', '".date('h:i:s A')."')");
}
function logsquadfile($id, $uid, $action) {
mysql_query("INSERT INTO `squadlogs` (`userid`, `uid`, `date`, `action`, `ip`, `time`) VALUES ('".$id."', '".$uid."', '".date("m/d/y")."', '".$action."', '".dataRetrieve($uid, "accesslevel")."', '".date('h:i:s A')."')");
}

function snidRetrieve($id, $type) {
	if(!$id == 0) {
	$sd_result = mysql_query("SELECT * FROM `accesslevels` WHERE `userid` = '".$id."' LIMIT 0,1");
		while($rowr = mysql_fetch_assoc($sd_result)) {
			if($type == "s1id") {
			return $rowr['s1id'];
			} elseif($type == "s2id") {
			return $rowr['s2id'];
			} elseif($type == "s3id") {
			return $rowr['s3id'];
			} else {
			return 0;
			}
		}
	} else {
	return "Pending";
	}
}

function searchDiv($name, $abb) {
$timeout = NULL;
$sqlh = "SELECT * FROM `divisions` WHERE `visable` = '0'";
$resulth = mysql_query($sqlh);
	while($row = mysql_fetch_assoc($resulth)) {
		if(strtolower($name) == strtolower($row['diviname']) || strtolower($abb) == strtolower($row['diviabbr'])) {
		$timeout = 1;
		}
	}
	if($timeout == 1) {
	return 1; 
	} else {
	return 0;
	}
}

function bgcode($num) {
	if($num == 0) {
		return "<font color=#999999>Not Checked</font>";
	} elseif($num == 1) {
		return "<font color=red>Failed</font>";
	} elseif($num == 2) {
		return "<font color=green>Good</font>";
	} elseif($num == 3) {
		return "Pending";
	}
}

function bgcodeplain($num) {
	if($num == 0) {
		return "Not Checked";
	} elseif($num == 1) {
		return "Fail";
	} elseif($num == 2) {
		return "Pass";
	} elseif($num == 3) {
		return "Pending";
	}
}


function mbrlistname($id) {
	$result = mysql_query("SELECT * FROM `mbrlist` WHERE `id` = '".$id."' LIMIT 0,1");
	while($rows = mysql_fetch_assoc($result)) {
		return $rows['name'];
	}
}

function number_range($min, $max, $search) {
	foreach(range($min, $max) as $item) {
		if($search == $item) {
			return true;
		}
	}
}

function colorname($name, $hexcode) {
	if(empty($name) || empty($hexcode)) {// empty
		return $name;
	} else {
		// define what type of combo the color needs to be
		if(strlen($hexcode) == 6) {
			return "<font style=\"color: #".$hexcode.";\">".$name."</font>";
		} elseif(strlen($hexcode) == 13) {
			list($code_one, $code_two) = explode("-", $hexcode); //split code
			
			// divide name
			$charlen = strlen($name);
			$round = round(($charlen / 2), 0);
			$begin = substr($name, 0, $round);
			$end =  substr($name, -($charlen - $round));
			
			//add in sections with color
			$begin_two = "<font style=\"color: #".$code_one.";\">".$begin."</font>";
			$end_two = "<font style=\"color: #".$code_two.";\">".$end."</font>";
			
			// replace old sections with new ones
			$newname = $name;
			$newname = str_replace($begin, $begin_two, $newname);
			$newname = str_replace($end, $end_two, $newname);
			
			return $newname;
		} elseif(strlen($hexcode) == 20) {
			list($code_one, $code_two, $code_three) = explode("-", $hexcode); //split code
				if(strlen($name) <= 6) {
					
					// Same Process with set numbers
					$begin = substr($name, 0, 1);
					$end =  substr($name, -1);
					$begin_two = "<font style=\"color: #".$code_one.";\">".$begin."</font><font style=\"color: #".$code_two.";\">";
					$end_two = "</font><font style=\"color: #".$code_three.";\">".$end."</font>";
					$newname = $name;
					$newname = str_replace($begin, $begin_two, $newname);
					$newname = str_replace($end, $end_two, $newname);
					
					return $newname;
					
				} elseif(number_range(9, 12, strlen($name)) === true) {
				
					// ""
					$begin = substr($name, 0, 3);
					$end =  substr($name, -3);
					$begin_two = "<font style=\"color: #".$code_one.";\">".$begin."</font><font style=\"color: #".$code_two.";\">";
					$end_two = "</font><font style=\"color: #".$code_three.";\">".$end."</font>";
					$newname = $name;
					$newname = str_replace($begin, $begin_two, $newname);
					$newname = str_replace($end, $end_two, $newname);
				
					return $newname;
					
				} elseif(number_range(13, 17, strlen($name)) == true) {
				
					// ""
					$begin = substr($name, 0, 5);
					$end =  substr($name, -5);
					$begin_two = "<font style=\"color: #".$code_one.";\">".$begin."</font><font style=\"color: #".$code_two.";\">";
					$end_two = "</font><font style=\"color: #".$code_three.";\">".$end."</font>";
					$newname = $name;
					$newname = str_replace($begin, $begin_two, $newname);
					$newname = str_replace($end, $end_two, $newname);
				
					return $newname;
					
				} else {
					return $name;
				}
				
		} else {
			return $name;
		}
	}
}

function veiwList($ranknum, $squads) {
$sx_sql = "SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0' AND `rank` = '".$ranknum."' ORDER BY `name`";
$sx_result = mysql_query($sx_sql);
	while($row = mysql_fetch_assoc($sx_result)) {
		$checkq = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$row['name']."'");
		if(mysql_num_rows($checkq) == 0) {
		$cbn = $row['name'];
		} else {
		$cbn = "<font color=red><b>".$row['name']." [Blacklisted Member]</b></font>";
		}
	echo "<tr onClick=\"return alert('Date Added: ".$row['date']." - Added By: ".dataRetrieve($row['addid'], "username")."');\"><td>".getRank($row['rank'])."</td><td>".$cbn."</td><td>".bgcode($row['bgcheck'])."</td></tr>";
	}
}
function editList($ranknum, $squads) {
$sx_sql = "SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0' AND `rank` = '".$ranknum."' ORDER BY `name`";

$sx_result = mysql_query($sx_sql);
	while($row = mysql_fetch_assoc($sx_result)) {
		$checkq = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$row['name']."'");
		if(mysql_num_rows($checkq) == 0) {
		$cbn = $row['name'];
		} else {
		$cbn = "<font color=red><b>".$row['name']." [Blacklisted Member]</b></font>";
		}
	echo "<tr><td><input type='checkbox' name='checkname[]' value='".$row['id']."' width=13 height=13>".getRank($row['rank'])."</td><td>".$cbn."</td><td><a href=http://www.bungie.net/Account/Profile.aspx?player=".str_replace(" ", "+", $row['name'])." target=_blank>Look Up</a></td><td><a href=index.php?db=editSquad&i=edit&delid=".$row['id'].">Delete</a></td><td><a href=\"javascript:popUp('bgchecker/?u=".$row['id']."&c=1', 500, 500)\">Check</a></td></tr>";
	}

}

function editGTList($ranknum, $squads) {
$sx_sql = "SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0' AND `rank` = '".$ranknum."' ORDER BY `name`";

$sx_result = mysql_query($sx_sql);
	while($row = mysql_fetch_assoc($sx_result)) {
		$checkq = mysql_query("SELECT * FROM `blklist` WHERE `blkname` = '".$row['name']."'");
		if(mysql_num_rows($checkq) == 0) {
		$cbn = $row['name'];
		} else {
		$cbn = "<font color=red><b>".$row['name']." [Blacklisted Member]</b></font>";
		}
	echo "<tr><td><input type='checkbox' name='checkname[]' value='".$row['id']."' width=13 height=13>".getRank($row['rank'])."</td><td>".$cbn."</td><td>".$row['gametype']."</td></tr>";
	}

}

function dlforum($squads) {
$rankstruct = array();
$namestruct = array();
$sx_sql = "SELECT * FROM `mbrlist` WHERE `sid` = '".$_SESSION['selectid']."' AND `visable` = '0' ORDER BY `name`";
$sx_result = mysql_query($sx_sql);
	while($row = mysql_fetch_assoc($sx_result)) {
	$newname = "[".$row['gametype']."] ".$row['name'];
	$rankstruct[$row['rank']] = $row['rank'];
	$namestruct[$newname] = $row['rank'];
	}
krsort($rankstruct, SORT_NUMERIC);
ksort($namestruct);
	foreach($rankstruct as $item) {
		echo "\n[b]".getRank($item)."[/b]\n";
		foreach($namestruct as $key=>$value) {
			if($value == $item) {
				echo $key."\n";
			}
		}
	}
}

function removed_data($id, $type) {
	if($type == "username") {
	$sql = mysql_query("SELECT * FROM `removed_names` WHERE `uid` = '".$id."'");
		if(mysql_num_rows($sql) == 0) {
			return "n/a";
		} else {
			while($row = mysql_fetch_assoc($sql)) {
				return $row['name'];
			}
		}
	} else {
		return "n/a";
	}
}
function dataRetrieve($id, $type) {
	if(!$id == 0) {
	$sql = "SELECT * FROM `useraccess` WHERE `id` = '".$id."'";
	$result = mysql_query($sql);
		if(mysql_num_rows($result) == 0) {
			$check_r = removed_data($id, $type);
			if($check_r == "n/a") {
				return "<font color='#660000' />Removed Member</font>";
			} else {
				return $check_r;
			}
		} else {
			while($row = mysql_fetch_assoc($result)) {
				if($type == "username") {
					return $row['username'];
				} elseif($type == "email") {
					return $row['email'];
				} elseif($type == "accesslevel") {
					return $row['accesslevel'];
				} elseif($type == "clanleaderid") {
					return $row['clanleaderid'];
				} elseif($type == "ip") {
					return $row['ipaddress'];
				} elseif($type == "lastactive") {
					return $row['lastactive'];
				} elseif($type == "letinby") {
					return $row['letinby'];
				} elseif($type == "colorcode") {
					return $row['colorcode'];
				} else {
					return "Wrong Input";
				}
			}
		}
	} else {
	return "Pending";
	}
}
?>