<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');
$host=$_SERVER['HTTP_HOST'];
$obj= $_REQUEST['object'];
$reg=$_REQUEST['region'];
$ema=$_REQUEST['email'];
$fio=$_REQUEST['fio'];
$res=$_REQUEST['residing_info'];
$pho=$_REQUEST['phone'];
$ds=$_REQUEST['date_s'];
$de=$_REQUEST['date_e'];
$time=time();
$status = 0;
$query='insert into ve_up_form(date_s,date_e,residing_info,fio,phone,email,obr,region,post_time,status,host) values("'.$ds.'", "'.$de.'", "'.$res.'", "'.$fio.'", "'.$pho.'", "'.$ema.'", "'.$obj.'", "'.$reg.'", "'.$time.'", "'.$status.'", "'.$host.'")';
$res=$dbh->query($query);
if (!empty($res)){
	echo 'Заявка принята номер заявки-'.$dbh->query('SELECT id FROM ve_up_form ORDER BY id DESC')->fetch(PDO::FETCH_ASSOC)['id'];
}

?>
