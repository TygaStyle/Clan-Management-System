<?php
/*




CREATE TABLE `accesslevels` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `level` int(1) default NULL,
  `s1id` int(11) NOT NULL default '0',
  `s2id` int(11) NOT NULL default '0',
  `s3id` int(11) NOT NULL default '0',
  `clid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)

######################################

CREATE TABLE `alert` (
  `id` int(11) NOT NULL auto_increment,
  `date` varchar(10) NOT NULL default '00-00-00',
  `textalert` text,
  PRIMARY KEY  (`id`)
)

#########################################################


CREATE TABLE `bgpending` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  PRIMARY KEY  (`id`)
)

####################################################

CREATE TABLE `blkclans` (
  `id` int(11) NOT NULL auto_increment,
  `cblktag` varchar(10) default NULL,
  `cblkclan` varchar(100) default NULL,
  `cblkreason` varchar(255) default NULL,
  `cblklv` int(1) default NULL,
  `cblkauthid` int(11) default NULL,
  `cblkdate` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
)

######################################################


CREATE TABLE `blklist` (
  `id` int(11) NOT NULL auto_increment,
  `blkname` varchar(17) default NULL,
  `blkreason` varchar(255) default NULL,
  `blklv` int(1) default NULL,
  `blkproof` text,
  `blkauthid` int(11) NOT NULL default '1',
  `blkdate` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
)

#####################################################

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `message` varchar(255) default NULL,
  `datesent` varchar(9) default NULL,
  PRIMARY KEY  (`id`)
)

#######################################################

CREATE TABLE `checklogs` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `gameid` int(20) default NULL,
  `gamertag` varchar(100) default NULL,
  `numclans` int(11) NOT NULL default '0',
  `numtags` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)

########################################################

CREATE TABLE `codes` (
  `id` int(11) NOT NULL auto_increment,
  `squadid` int(11) default NULL,
  `codechars` int(10) default NULL,
  PRIMARY KEY  (`id`)
)

#########################################################

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL auto_increment,
  `diviname` varchar(100) default NULL,
  `diviabbr` varchar(5) NOT NULL default '',
  `divipass` int(8) NOT NULL default '30000192',
  `visable` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)

####################################################

CREATE TABLE `gametypes` (
  `id` int(11) NOT NULL auto_increment,
  `gamename` varchar(250) default NULL,
  `abbr` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

#######################################################

INSERT INTO `gametypes` (`id`, `gamename`, `abbr`) VALUES (1, 'Call of Duty: Modern Warfare 2', 'MW2'),
(2, 'Call of Duty: Black Ops', 'Black Ops'),
(3, 'Halo: Reach', 'Reach'),
(4, 'Other', 'Other');

#############################################################################################

CREATE TABLE `ipban` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
)
#############################################################################################

CREATE TABLE `logs` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `date` varchar(10) default NULL,
  `action` text,
  `ip` varchar(40) NOT NULL default '0',
  `time` varchar(40) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)

#################################################################################################
CREATE TABLE `mbrlist` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(17) default NULL,
  `sid` int(11) default NULL,
  `addid` int(11) default NULL,
  `bgcheck` int(1) NOT NULL default '0',
  `rank` int(2) default NULL,
  `date` varchar(10) default NULL,
  `gametype` varchar(255) NOT NULL default '3',
  `visable` int(1) NOT NULL default '0',
  `des` varchar(250) NOT NULL default 'n/a',
  PRIMARY KEY  (`id`)
)



#################################################################################################


CREATE TABLE `removed_names` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(17) default NULL,
  `uid` int(11) default NULL,
  PRIMARY KEY  (`id`)
)


#################################################################################################


CREATE TABLE `requestlist` (
  `id` int(11) NOT NULL auto_increment,
  `appid` int(11) default NULL,
  `squadid` int(11) default NULL,
  `multi` varchar(5) default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
)


##################################################################################################

CREATE TABLE `squadlogs` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `uid` int(11) default NULL,
  `date` varchar(10) default NULL,
  `action` text,
  `ip` varchar(40) default NULL,
  `time` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
)

##################################################################################################

CREATE TABLE `squads` (
  `id` int(11) NOT NULL auto_increment,
  `squadname` varchar(15) default NULL,
  `squadpass` varchar(50) NOT NULL default '1234567897',
  `visable` int(1) NOT NULL default '0',
  `divisionid` int(11) default NULL,
  `date` varchar(10) NOT NULL default '06/10/07',
  `max` int(11) NOT NULL default '100',
  `secure` int(1) NOT NULL default '1',
  `defaultgame` varchar(255) NOT NULL default 'Halo 2',
  PRIMARY KEY  (`id`)
)




##################################################################################################


CREATE TABLE `useraccess` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(17) default NULL,
  `password` varchar(62) default NULL,
  `email` varchar(100) default NULL,
  `accesslevel` int(1) default NULL,
  `clanleaderid` int(11) NOT NULL default '0',
  `ipaddress` varchar(25) default NULL,
  `lastactive` varchar(9) NOT NULL default '-',
  `firststarted` varchar(9) default NULL,
  `letinby` int(10) NOT NULL default '0',
  `colorcode` varchar(21) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

###################################################################################################

INSERT INTO `useraccess` (`id`, `username`, `password`, `email`, `accesslevel`, `clanleaderid`, `ipaddress`, `lastactive`, `firststarted`, `letinby`, `colorcode`) VALUES (1, 'AK', '2073cf9ebd10706c67358007822695d3', 'deioreanmotors@aol.com', 5, 0, '67.232.225.55 ', '09/07/08', '05/18/07', 1, '999999-00688a')

*/
?>