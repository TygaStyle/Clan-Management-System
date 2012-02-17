<?php
include "../../Documents and Settings/Owner.Melissa/My Documents/Unnamed Site 3/inc/db.php";

$backupFile = '/home/lgngamin/backup/main'. date("Y-m-d") . '.txt';
$command = "mysqldump --opt -h$dbdir -u$dbuser -p$dbpass $dbase | gzip > $backupFile";
system($command);
?>