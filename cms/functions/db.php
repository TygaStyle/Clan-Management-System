<html>
<head>
<title>Database</title>
</head>
<body>
<?php
$location = 'localhost';
$dbusername = '';  
$dbpassword = '';
$conn = mysql_connect($location, $dbusername, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br />';
$sql = 'DROP DATABASE database here';
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not delete database: ' . mysql_error());
}
echo "Database successful\n";
mysql_close($conn);
?>
</body>
</html>
