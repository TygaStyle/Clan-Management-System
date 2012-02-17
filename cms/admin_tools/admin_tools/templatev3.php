<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="keywords" content="clan, clanclan, clan clan, clan vice, clan vicecaptain, clan global, clan interaction, clan gaming, clan global gamin, clanglobal"> 
	<meta name="copyright" content="clan Global Gaming Network"> 
	<meta name="author" content="Matt Lo"> 
	<meta name="email" content="followinto@gmail.com"> 
	<meta name="Language" content="EN"> 
	<meta name="Rating" content="General"> 
	<meta name="Robots" content="INDEX,FOLLOW"> 
	<title><? echo $titlepage; ?></title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript">
function popUp(URL, www, hhh) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=" + www + ",height=" + hhh + ",left = 326,top = 182');");
}

function submitonce(theform){
//if IE 4+ or NS 6+
if (document.all||document.getElementById){
//screen thru every element in the form, and hunt down "submit" and "reset"
for (i=0;i<theform.length;i++){
var tempobj=theform.elements[i]
if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
//disable em
tempobj.disabled=true
}
}
}


var persistmenu="yes"
var persisttype="sitewide" //enter "sitewide" for menu to persist across site, "local" for this page only

if (document.getElementById){ 
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); 
		if(el.style.display != "block"){ 
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") 
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate

//////////////////////////////////////////////////////////////////////////////////////////////////
var highlightbehavior="TR"
//////////////////////////////////////////////////////////////////////////////////////////////////
var ns6=document.getElementById&&!document.all
var ie=document.all

function changeto(e,highlightcolor){
source=ie? event.srcElement : e.target
if (source.tagName=="TABLE")
return
while(source.tagName!=highlightbehavior && source.tagName!="HTML")
source=ns6? source.parentNode : source.parentElement
if (source.style.backgroundColor!=highlightcolor&&source.id!="ignore")
source.style.backgroundColor=highlightcolor
}

function contains_ns6(master, slave) { //check if slave is contained by master
while (slave.parentNode)
if ((slave = slave.parentNode) == master)
return true;
return false;
}

function changeback(e,originalcolor){
if (ie&&(event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="ignore")||source.tagName=="TABLE")
return
else if (ns6&&(contains_ns6(source, e.relatedTarget)||source.id=="ignore"))
return
if (ie&&event.toElement!=source||ns6&&e.relatedTarget!=source)
source.style.backgroundColor=originalcolor
}

var ns6=document.getElementById&&!document.all

function restrictinput(maxlength,e,placeholder){
if (window.event&&event.srcElement.value.length>=maxlength)
return false
else if (e.target&&e.target==eval(placeholder)&&e.target.value.length>=maxlength){
var pressedkey=/[a-zA-Z0-9\.\,\/]/ //detect alphanumeric keys
if (pressedkey.test(String.fromCharCode(e.which)))
e.stopPropagation()
}
}

function countlimit(maxlength,e,placeholder){
var theform=eval(placeholder)
var lengthleft=maxlength-theform.value.length
var placeholderobj=document.all? document.all[placeholder] : document.getElementById(placeholder)
if (window.event||e.target&&e.target==eval(placeholder)){
if (lengthleft<0)
theform.value=theform.value.substring(0,maxlength)
placeholderobj.innerHTML=lengthleft
}
}

var xmlHttp
var xmlHttp2

function showUser(str)
{ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="../ajax_mbr_srch.php"
url=url+"?n="+str.replace(/ /gi, "+")
xmlHttp.onreadystatechange=stateChanged 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function changeinfo(str)
{ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="editsquadv2fn/view.php"
url=url+"?c=1&i="+str
xmlHttp.onreadystatechange=changeinfo40
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function statupdate()
{ 
xmlHttp2=GetxmlHttp2Object()
if (xmlHttp2==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="editsquadv2fn/stats.php"
xmlHttp2.onreadystatechange=stat
xmlHttp2.open("GET",url,true)
xmlHttp2.send(null)
}

function openpage(str)
{ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="editsquadv2fn/view.php"
url=url+"?t="+str
xmlHttp.onreadystatechange=stateChangededv2 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}
function addname() {
	var name = document.getElementById("name").value
	name = name.replace(/ /gi, "+")
	var rank = document.getElementById("rank").value
	changeinfo('33&name='+name+'&rank='+rank)
}
function altdes(id) {
	var name = document.getElementById("kk"+id).value
	name = name.replace(/ /gi, "+")
	changeinfo('49&m='+name+'&id='+id)
}
function maxlen() {
	var maxl = document.getElementById("max").value
	changeinfo('40&m='+maxl)
}
function secure() {
	var switch_onoff = document.getElementById("secure").value
	changeinfo('41&lock='+switch_onoff)
}
function editname(id, counts) {
	var formname = "ccranks"+counts
	var name = document.getElementById(formname).value
	name = name.replace(/ /gi, "+")
	changeinfo('34&id='+id+'&to='+name)
	//setTimeout(openpage('5'), 700)
}
function editrank(id, counts) {
	var formname = "ranks"+counts
	var name = document.getElementById(formname).value
	changeinfo('39&id='+id+'&to='+name)
	//setTimeout(openpage('5'), 700)
}
function stateChangededv2() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("1221").innerHTML=xmlHttp.responseText 
 } else {
 document.getElementById("1221").innerHTML="<table width=100%><tr><td valign=top align=center><img src=images/loader.gif></td></tr></table>"
 }
}

function stat() 
{ 
if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
 { 
 document.getElementById("stat").innerHTML=xmlHttp2.responseText 
 } else {
 document.getElementById("stat").innerHTML="<table width=100%><tr><td valign=top align=center><img src=images/loader.gif></td></tr></table>"
 }
}

function changeinfo40() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("infos").innerHTML=xmlHttp.responseText
 statupdate()
 } else {
 document.getElementById("infos").innerHTML="<table width=100%><tr><td valign=top align=center><img src=images/loader.gif></td></tr></table>"
 }
}


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText 
 } else {
 document.getElementById("txtHint").innerHTML="Loading..."
 }
}

function GetxmlHttp2Object()
{
var xmlHttp2=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp2=new xmlHttp2Request();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp2=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp2;
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

function displaylimit(thename, theid, thelimit){
var theform=theid!=""? document.getElementById(theid) : thename
var limit_text='<b><span id="'+theform.toString()+'">'+thelimit+'</span></b>'
if (document.all||ns6)
document.write(limit_text)
if (document.all){
eval(theform).onkeypress=function(){ return restrictinput(thelimit,event,theform)}
eval(theform).onkeyup=function(){ countlimit(thelimit,event,theform)}
}
else if (ns6){
document.body.addEventListener('keypress', function(event) { restrictinput(thelimit,event,theform) }, true); 
document.body.addEventListener('keyup', function(event) { countlimit(thelimit,event,theform) }, true); 
}
}

var menu1=new Array()
menu1[0]='blank'
		
var menuwidth='165px' 
var menubgcolor='000000'  
var disappeardelay=250  
var hidemenu_onclick="yes"

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top="-500px"
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu




function high(which2){
theobject=which2
highlighting=setInterval("highlightit(theobject)",50)
}
function low(which2){
clearInterval(highlighting)
if (which2.style.MozOpacity)
which2.style.MozOpacity=0.3
else if (which2.filters)
which2.filters.alpha.opacity=30
}

function highlightit(cur2){
if (cur2.style.MozOpacity<1)
cur2.style.MozOpacity=parseFloat(cur2.style.MozOpacity)+0.1
else if (cur2.filters&&cur2.filters.alpha.opacity<100)
cur2.filters.alpha.opacity+=10
else if (window.highlighting)
clearInterval(highlighting)
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
<body style="background: #1e292d url(imgs/bg.gif) repeat-x;">
<div id="container">
  <div class="nav_holder">
  <ul id="navigation">
			<li><a href="index.php">Home</a></li>
            <li><a href="http://www.lgngaming.net">LGN Home</a></li>
            <li><a href="http://www.lgngaming.net/e107_plugins/forum/forum.php">LGN Forums</a></li>
<li><a href="index.php?db=LGNmembers">clan Leaders</a></li>
		  <li><a href="index.php?db=clan&dm=1">Divisions</a></li>
			<li><a href="index.php?db=al">Access List</a></li>
			<li><a href="index.php?db=register">Register</a></li>
			
		</ul>
	</div>
<h1 id="banner"></h1>
	<div id="content">
		<div id="left">
            <div class="side_header">Stats</div>
			<div class="side_content">
			<?php
			$q_stat_a = mysql_query("SELECT * FROM `mbrlist` WHERE `visable` = '0'");
			echo 'clan Total Members: <b>'.mysql_num_rows($q_stat_a).'</b>';


			while($row = mysql_fetch_assoc($q_stat_a)) {
				$temp_array[$row['sid']][] = NULL;
			}

			$q_divi = mysql_query("SELECT * FROM `divisions` WHERE `visable` = '0'");
			$q_squad = mysql_query("SELECT * FROM `squads` WHERE `visable` = '0'");
				while($row = mysql_fetch_assoc($q_divi)) {
					if($row['id'] != 37) {
					$divisionsIO[] = $row['id'];
					}
				}

				while($row = mysql_fetch_assoc($q_squad)) {
					$squadsIO[$row['id']] = $row['divisionid'];
				}

			
				foreach($divisionsIO as $did) {
					foreach($squadsIO as $sid => $squad_did) {
						if($squad_did == $did) {
							$division_squad_array[$did][$sid] = NULL;
						}
					}
				}

				foreach($division_squad_array as $division=>$squadid_a) {
					$final_division[$division] = NULL;
					foreach($squadid_a as $sid=>$allnull) {
						if(array_key_exists($sid, $temp_array)) {
							$final_division[$division] += count($temp_array[$sid]);
						}
					}
				}

				
				mysql_query("DELETE FROM `frontpage_stats_gb`");
				$testco = NULL;
				foreach($final_division as $d=>$final_count) {
					mysql_query("INSERT INTO `frontpage_stats_gb` (`division`, `totalnum`) VALUES ('".diviname($d)."', '".$final_count."')");
				}

				


			$check_q = mysql_query("SELECT * FROM `frontpage_stats_gb`");
			if(mysql_num_rows($check_q) != 0) {
				while($row = mysql_fetch_assoc($check_q)) {
					$formal_array[] = $row['division'].": <b>".$row['totalnum']."</b>";
				}
				echo "<br />".join("<br />", $formal_array);
			}
			?>
			</div>        
        
			<div class="side_header">Chat Box</div>
			<div class="side_content">
			<? include("chatbox.php"); ?>
			</div>			
            


			<div class="side_header">Search Gamertag</div>
			<div class="side_content">
				<form method="post" action="index.php?db=sg">
					<div class="search_input_left"></div>
					<input name="uu" id="uu" type="text" value="Search..." onFocus="this.value=''" class="search_input" />
					<input name="submit" type="submit" value="" class="search_submit" title="Search" />
				</form>
			</div>
			<div class="side_header">Black List</div>
			<div class="side_content_menu">
				<ul class="list_side">
					<li><a href="index.php?db=blk">Gamertags</a></li>
					<li><a href="index.php?db=blkclan">Clans</a></li>
				</ul>
			</div>
		</div>
		<div id="center">
	<?
	$check = mysql_query("SELECT * FROM `alert`");
	if(mysql_num_rows($check) == 1) {
		echo "<div class=\"center_header\">Alert Message</div><div class=\"center_content\"><div class=\"news_post\">";
			while($row = mysql_fetch_assoc($check)) {
			echo $row['textalert'];
			}
		echo "</div></div>";
		}
	?>
			<!-- Start a content post -->
			
			<!--<div class="center_header">Test.</div><div class="center_content"><div class="news_post">
					 <span class="posted">Written by Subleme on the third of November 2007</span><div class="center_post_img">
					<img src="imgs/content_post_img.gif" alt="" />
				</div>
s
			</div></div>-->
			
			<div class="heightfix">CLAN.NET</div>
			<!-- End a content post -->
			<? main(); ?>
		</div>
		<div id="right">
			<!-- Start a side box -->
            <div class="side_header">Random LGN Member</div>
            
            <?php
									$sql = mysql_query ("SELECT `name` FROM `mbrlist` WHERE `visable` = '0' ORDER BY RAND() LIMIT 0,1") or die (mysql_error ());
									$res = mysql_fetch_assoc ($sql);
									$randomquote = $res['name'];
									?><iframe src="http://gamercard.xbox.com/<?php echo $randomquote; ?>.card" scrolling="no" frameborder="0" height="140" width="202" float="right"></iframe>
                                    
                                    <br /><br />
			<div class="side_header">Members Area</div>
			<div class="side_content">
			<? panel(); ?>
			</div>
			<? if(isset($_SESSION['id'])) { ?>
			<div class="side_header"><a href="index.php?db=cp" style="color: #FFFFFF">Member Control Panel</a></div>
			<div class="side_content_menu">
				<ul class="list_side">
				<?
					foreach(return_menu() as $item) {
						list($fullname, $imgname, $url) = explode("-", $item);
						echo "<li><a href=\"".$url."\">".str_replace("_", " ", $fullname)."</a></li>";
					}
					
				?>
				</ul>
			</div>
			<? } ?>
			
			<div class="side_header">Affiliates</div>
			<div class="side_content_menu"><a href="http://www.clanblackops.co.cc/forums" target="_blank"><img src="imgs/Forumslogo.gif" alt="clan Forums" border="0" /></a>			</div>
		  <!-- End a side box -->
		</div>
	</div>
	<div id="site_footer">Programming by: Matt lo, reprogramming Justin</div>
</div>
<div id="footer"><center class="style1">
  <span class="style1">&copy;2008-<?=date('Y')+1 ?> clanCLAN</span>
</center>
</div>
</body>
</html>