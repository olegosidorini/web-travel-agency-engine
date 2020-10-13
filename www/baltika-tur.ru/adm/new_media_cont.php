<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');
$type=$_REQUEST['type'];

$dbh->query("INSERT INTO ve_contents(type,name) values('".$type."','Новый контейнер')");
echo $dbh->query("SELECT * FROM ve_contents  ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];

?>
