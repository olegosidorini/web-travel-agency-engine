<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$dbh->query("INSERT INTO ve_contents(type,name,status) values('article','Новая статья','1')");
$pid=$dbh->query("SELECT * FROM ve_contents WHERE type='article' ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];

$dbh->query("INSERT INTO ve_table_of_contents(cid,title,status) values('$pid','Описание','1')");
$id=$dbh->query("SELECT * FROM ve_table_of_contents WHERE cid='$pid' ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];

$dbh->query("INSERT INTO ve_descriptions(pid,title,text,status) values('$id','Новый элемент','','1')");
$dbh->query("INSERT INTO ve_photos(pid,title,text,path,link,status,type) values('$id','Новое изображение','','','','1','photo')");
$dbh->query("INSERT INTO ve_photos(pid,title,text,path,link,status,type) values('$id','Новый файл','','','','1','file')");

echo $pid;
?>
