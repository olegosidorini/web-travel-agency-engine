<?php
header('Content-Type: text/html; charset=utf-8');
include_once('../config.php');

$id=$_REQUEST['id'];
$db=$_REQUEST['db'];
$ft=$dbh->query("SELECT * FROM ".$db." WHERE id='$id'")->fetch(PDO::FETCH_ASSOC)['status'];
$dbh->query("UPDATE ".$db." SET status=".(($ft == 0)?1:0)." WHERE id='$id'");
echo $id;
?>
