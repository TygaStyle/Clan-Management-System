<?php


require_once('Snoopy.class.php');

class GamerCard
{

	private static $_FETCHGC_CACHE_TTL = 3600; // seconds
	private static $_FETCHGC_ABBREVIATION = array(	'EA SPORTS FN 3' => 'FN3',
							'DEAD OR ALIVE 4' => 'DOA4',
							'Geometry Wars Evolved' => 'GWE',
							'Call of Duty 2' => 'COD2',
							'Perfect Dark Zero' => 'PDZ',
							'Rockstar Table Tennis' => 'R* TT',
							'Ridge Racer 6' => 'RR6',
							'Battlefield 2: MC' => 'BF2:MC',
							'Marble Blast Ultra' => 'M\'Blast',
							'Football Manager 2006' => 'FM2K6',
							'Jewel Quest' => 'J\'Quest',
							'Feeding Frenzy' => 'F\'Frenzy',
							'Outpost Kaloki X' => 'Outpost K\'X',
							'Wik: Fable of Souls' => 'Wik: FoS',
							'Hardwood Backgammon' => 'Backg\'mon',
							'Mutant Storm Reloaded' => 'M\'Storm',
							'Street Fighter II\' HF' => 'SF2',
							'Outpost K\'X' => 'OutpostKX',
							'Tomb Raider:Legend' => 'TRaider:L',
							'Hitman: Blood Money' => 'Hitman',
							'Texas Hold\'em' => 'TX Hold\'m',
							'Ninety-Nine Nights' => '99Nights');

	function FetchArray($_TAG)
	{
		$MySnoopy = new Snoopy();
		$MySnoopy->read_timeout=1;
		$MySnoopy->_fp_timeout=1;

		if ($MySnoopy->fetch('http://gamercard.xbox.com/'. $_TAG . '.card')) {
			$MyResult = $MySnoopy->results;
		}
		else
		{
			return null;
		}
		
		preg_match('#<h3 class="XbcGamertag(.+?)">#',$MyResult, $gtagstyle);
		preg_match('#width="64" src="(.+?)" /></a>#',$MyResult, $gtile);
		preg_match('#XbcFRAR"><img src="(.+?)" /></span></p>#',$MyResult, $grep);
		preg_match('#Gamerscore" src="(.+?)" />#',$MyResult, $gscoreimg);
		preg_match_all('#<span class="XbcFRAR">(.+?)</span>#',$MyResult, $gamer);
		preg_match_all('#<div class="XbcgcGames">(.+?)</div>#',$MyResult, $glastplayed);
		
		$GamerCard['tag'] = str_replace('%20', ' ', $_TAG);
		@$GamerCard['zone'] = $gamer[1][2];
		@$GamerCard['style'] = $gtagstyle[1];
		@$GamerCard['tile'] = $gtile[1];
		@$GamerCard['rep'] = 'http://gamercard.xbox.com'. $grep[1];
		@$GamerCard['score'] = $gamer[1][1];
		@$GamerCard['scoreimg'] = 'http://gamercard.xbox.com'. $gscoreimg[1];
		@$GamerCard['lastplayedhtml'] = $glastplayed[1][0];
		@$GamerCard['lastplayed'] = array();
		@$lastplayedhtml = explode('</a>', $GamerCard['lastplayedhtml']);
		
		$GamerCard['lastplayed'] = array();
		
		foreach($lastplayedhtml as $line)
		{
			if (!empty($line))
			{
				preg_match('#<img height="32" width="32" title="(.+?)"#', $line, $lastplayedname);
				preg_match('#src="http://tiles.xbox.com/tiles/(.+?)"#', $line, $lastplayedtag);
				@$GamerCard['lastplayed'][$lastplayedname[1]] = $lastplayedtag[1];
//				foreach(self::$_FETCHGC_ABBREVIATION as $long => $short)
				if (isset(self::$_FETCHGC_ABBREVIATION[$lastplayedname[1]])) {
					$GamerCard['lastplayed_short'][] = self::$_FETCHGC_ABBREVIATION[$lastplayedname[1]];
				} else {
					$GamerCard['lastplayed_short'][] = $lastplayedname[1];
				}
			}
		}

		return $GamerCard;
	}
	
	function Fetch($_TAG, $force=false)
	{

		$_CACHE_FILE = 'cache/' . $_TAG;
		$_FETCH = true;
		$_SUCCESS = false;
		$CacheContents = '';
		
		if (file_exists($_CACHE_FILE))
		{
			$CacheContents = file_get_contents($_CACHE_FILE);
			if (!is_string($CacheContents))
			{
				$_FETCH = true;
			}
			elseif ((time() - filemtime($_CACHE_FILE)) > $_FETCHGC_CACHE_TTL)
			{
				$_FETCH = true;
			}
			else
			{
				$_FETCH = false;
			}
		}
		
		if($force) $_FETCH=true;
		
		if (!$_FETCH)
		{
			if (!($GamerCard = unserialize($CacheContents)))
			{
				// Unserialization failed
				$GamerCard = GamerCard::FetchArray($_TAG);
				$_SUCCESS = GamerCard::CacheWrite($_CACHE_FILE, serialize($GamerCard));
			}
		}
		else
		{
			$GamerCard = GamerCard::FetchArray($_TAG);
			if ($GamerCard == null)
			{
				$GamerCard = unserialize($CacheContents);
			}
			else
			{
				$_SUCCESS = GamerCard::CacheWrite($_CACHE_FILE, serialize($GamerCard));	
			}
		}

		if ($GamerCard['score'] == '--')
			return null;

		return $GamerCard;
	}

	function CacheWrite($filename, $contents)
	{
		if (!($CacheHandle = @fopen($filename, 'w')))
		{
			// File is not writable
			return false;
		}
		fwrite($CacheHandle, $contents);
		fclose($CacheHandle);
		return true;
	}
}

?>
