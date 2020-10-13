<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$pid=$_REQUEST['id'];

if (!empty($pid)){
	$dbh->query("INSERT INTO ve_table_of_contents(cid,title) values('$pid','Новый элемент')");
	$id=$dbh->query("SELECT * FROM ve_table_of_contents WHERE cid='$pid' ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];
	$dbh->query("INSERT INTO ve_descriptions(pid,title) values('$id','Новый элемент')");
  $dbh->query("INSERT INTO ve_photos(pid,title,type) values('$id','Новое изображение','photo')");
  echo $id;
}
?>
