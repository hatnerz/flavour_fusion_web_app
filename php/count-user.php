<?php
require_once("../core/db.php");
include "get_image.php";

$connection = DB::connect_to_db();
$date = date('Y-m-d', time());
mysqli_query($connection, "DELETE FROM `list_ip` WHERE (`date`!=\"$date\")");
mysqli_query($connection, "UPDATE `statistics` SET `hosts`= 0, `hits`= 0 WHERE (`date`!=\"$date\")"); 
mysqli_query($connection, "UPDATE `statistics` SET `date`=\"$date\"");
$ip = $_SERVER['REMOTE_ADDR'];

$result = mysqli_query($connection, "SELECT * FROM `list_ip` WHERE (`ip`=\"$ip\") ");
$row = mysqli_num_rows($result);

if ($row > 0)
{
	$result = mysqli_query($connection, "SELECT `hosts`, `hits`, `total` FROM `statistics`"); 
	$row = mysqli_fetch_array($result);
	$new_hits = ++$row['hits'];
	$new_total = ++$row['total'];
	mysqli_query($connection, "UPDATE `statistics` SET `hits`=\"$new_hits\", `total`=\"$new_total\"");
	output_img($row['hosts'], $new_hits, $new_total);
}
else
{
	mysqli_query($connection, "INSERT INTO `list_ip` (`ip`, `date`) VALUES (\"$ip\", \"$date\")") or die(mysql_error());
	$result = mysqli_query($connection, "SELECT `hosts`, `hits`, `total` FROM `statistics`");
	$row = mysqli_fetch_array($result);
	$new_hosts = ++$row['hosts'];
	$new_hits = ++$row['hits'];
	$new_total = ++$row['total'];
	mysqli_query($connection, "UPDATE `statistics` SET `hosts`=\"$new_hosts\", `hits`=\"$new_hits\", `total`=\"$new_total\"");
	output_img($new_hosts, $new_hits, $new_total);
}


DB::disconnect_from_db($connection);

/*$res = mysqli_query($connection, "SELECT `ip`, `count` FROM `list_ip_count` WHERE (`ip`=\"$ip\")"); 
$row = mysqli_num_rows($res);

if ($row == 0)
{
	mysqli_query($connection, "INSERT INTO `list_ip_count` (`ip`, `count`) VALUES (\"$ip\", 1)");
	$res = mysqli_query($connection, "SELECT `ip`, `count` FROM `list_ip_count`");
	while ($row = mysqli_fetch_array($res))
		echo 'IP: '.$row['ip'].' Count: '.$row['count']."\n";
} 
else
{
	$res = mysqli_query($connection, "SELECT `ip`, `count` FROM `list_ip_count` WHERE (`ip`=\"$ip\")");
	$row = mysqli_fetch_array($res);
	$count = ++$row['count']; 
	mysqli_query($connection, "UPDATE `list_ip_count` SET `count`=\"$count\" WHERE (`ip`=\"$ip\") ");
	$res = mysqli_query($connection, "SELECT `ip`, `count` FROM `list_ip_count`");
	while ($row = mysqli_fetch_array($res))
		echo 'IP: '.$row['ip'].' Count: '.$row['count']."\n";
} 
*/
