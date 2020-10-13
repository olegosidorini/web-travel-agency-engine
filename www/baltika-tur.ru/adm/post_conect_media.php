<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$pid=$_REQUEST['id'];
$cid=$_REQUEST['cid'];

$dbh->query("INSERT INTO ve_crosstbl(cid,pid) values('".$_REQUEST['cid']."','".$_REQUEST['id']."')");


?>
