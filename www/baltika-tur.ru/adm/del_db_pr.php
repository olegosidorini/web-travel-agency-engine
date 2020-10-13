<?
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

echo $dbh->query("DELETE FROM ".$_REQUEST['db']." WHERE ".$_REQUEST['pole']." = '".$_REQUEST['id']."'");

?>
