<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$pid=$_REQUEST['pid'];

if (!empty($pid)){
  $dbh->query("INSERT INTO ve_descriptions(pid,title,text,status) values('$pid','Новый элемент','','1')");
}
?>
