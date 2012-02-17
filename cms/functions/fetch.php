<?php

/**
 * XBox Live Friends Score Board
 * Version 1.3
 *
 * Doug'DarkHalf' Barry
 * 20060620
 *
 * This is ready to include in you php scripts, and will throw back a plain
 * table consisting of your friends in ranked gamer score order.
 * Requires GamerCard.class.php
 * Modify the $Friends array to suite your needs.
 *
 * Change Log:
 *
 * Version 1.3
 *	Couldn't be bothered with the long version of game names, so now
 * 	they're always short. Abbreiviation is done in the GamerCard fetcher
 *	now.
 *
 * Version 1.2
 *	Optional shortening of last played game name via $_GCARD.
 *
 * Version 1.1
 * 	Optional display of last played game (and future expansion), via
 * 	$_GCARD array.
 *
 * Version 1
 * 	Initial functionality, list sorting by score.
 */
 
require_once('GamerCard.class.php');

$Friends = array('ksi vicecaptain', 'ksi grandpa 7');

$_GCARD['show_lastplayed'] = true;
$_GCARD['show_shortlpnames'] = true;

?>
<table cellspacing=2 cellpadding=0 border=0>
<?php

foreach($Friends as $Friend)
{
	$GamerCard[$Friend] = GamerCard::Fetch(str_replace(' ', '%20', $Friend));
	$friendslist[$GamerCard[$Friend]['tag']] = $GamerCard[$Friend]['score'];
}

arsort($friendslist);

foreach($friendslist as $name => $score)
{
if ($score>0)
{

$tmp=$GamerCard[$name]['lastplayed_short'];

if ($_GCARD['show_lastplayed'])
{
        if ($_GCARD['show_shortlpnames'])
        {
		$lastplayed=$tmp[0];
        }
}

?>
<tr><td>
<DIV TITLE="header=[GamerCard for <?=$name;?>] body=[<?

/*
echo 'Recently played:<br />';
foreach($GamerCard[$name]['lastplayed_short'] as $shortn)
{
	echo $shortn.'<br />';
}
*/

echo '<img border=0 src=\'http://card.mygamercard.net/mini/'.$name.'.png\' /><br />';

?>]" STYLE="BORDER: #eeeeee 1px solid;">
<table cellspacing=2 cellpadding=0 border=0>
	<tr>
		<td align="left" valign="bottom"><a title="GamerCard for <?=$name;?>" href="http://live.xbox.com/member/<?=$name;?>"><img border="0" height="48px" width="48px"src="<?=$GamerCard[$name]['tile'];?>" /></td></a>
		<td valign="top">
			<table border=0 cellspacing=0 cellpadding=0>
				<tr><td valign="top"><a title="GamerCard for <?=$name;?>" href="http://live.xbox.com/member/<?=$name;?>"><font size=+0.6><strong><?=$name;?></strong></font></a></td></tr>
				<tr><td valign="top"><a><div title="header=[GamerCard score graph] body=[<img src='http://gamerscorechart.com/theme/xbox/<?=$name;?>.png' />]" style="text-decoration: underline;">G <?=$score;?></div></a><br /><?=$lastplayed;?></td></tr>
			</table>
		</td>
		
	</tr>
</table>
</div>
</td></tr>
<?php
}
}
?>
</table>
