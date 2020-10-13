<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');
$type=$_REQUEST['type'];
if(empty($_REQUEST['ss'])) $result=$dbh->query('SELECT * FROM ve_photos WHERE type="'.$type.'" AND status=1');
else                       $result=$dbh->query('SELECT * FROM ve_photos WHERE type="'.$type.'"');

echo '<ul class="myMedia">';
foreach ($result as $res){
  echo '<li class="myMedia"'.(($res['status'] != 1)?'style="opacity: 0.4"':' ').'>
    <img src="images/'.$type.'.gif" class="spImage" />
    <span class="sp'.$type.'" id="'.$res['id'].'">'.$res['title'].'</span>
    </li>';
}
echo "</ul>";


?>
