<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');
$new_date = date("d.m.y");
$dbh->query("INSERT INTO ve_news(date,title,text,status) values('$new_date','Новая новость','','1')");
echo dbh->query("SELECT * FROM ve_news  ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];
?>
