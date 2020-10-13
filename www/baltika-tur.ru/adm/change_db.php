<?
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$dbh->query("UPDATE ".$_REQUEST['db']." set ".$_REQUEST['type']."='".$_REQUEST['value']."' where id=".$_REQUEST['id']);
?>
