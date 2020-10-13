<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

if(empty($_REQUEST['ss'])) $result=$dbh->query('SELECT * FROM ve_news  WHERE 1  AND status=1');
else                       $result=$dbh->query('SELECT * FROM ve_news');
echo '<ul class="myNews">';
foreach ($result as $res){
  echo '
    <li class="myNewse" '.(($res['status'] != 1)?'style="opacity: 0.4"':' ').'>
      <img src="images/news.gif" class="spImage" />
      <span class="spNews" id="'.$res['id'].'">'.$res['title'].'</span>
    </li>
  ';
}
echo "</ul>";

?>
