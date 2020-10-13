<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=$_REQUEST['id'];
if($dbh->query("INSERT INTO ve_pages(pid,name,type) values(0,'Новый сайт','Domen')")){
  $pid=$dbh->query("SELECT * FROM ve_pages ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];
  $dbh->query("INSERT INTO ve_pages(pid,name,type) values('".$pid."','каталог','catalog)");
  $dbh->query("INSERT INTO ve_pages(pid,name,type) values('".$pid."','меню','menu')");
  $dbh->query("INSERT INTO ve_pages(pid,name,type) values('".$pid."','банеры','baner')");
  $dbh->query("INSERT INTO ve_pages(pid,name,type) values('".$pid."','реклама','media')");
  $dbh->query("INSERT INTO ve_pages(pid,name,type) values('".$pid."','новости','news')");

  $result=$dbh->query('SELECT * FROM ve_template WHERE site_id="'.$start_id.'"');
  foreach ($result as $res){
    $dbh->query("INSERT INTO ve_template(site_id,param,value,description) values('".$pid."','".$res['param']."','".$res['value']."','".$res['description']."')");
  }
  echo $pid;
} else {
  echo 0;
}
?>
