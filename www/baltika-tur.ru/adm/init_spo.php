<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$result=$dbh->query('SELECT * FROM ve_pages WHERE  type="obr" AND spo<>"0" AND spo<>""');

echo '
  <ul class="myTree">';
foreach ($result as $res){
  echo '
    <li class="treeItem">
      <img src="images/obr.gif" class="folderImage" />
      <span onclick="getPage('.$res['id'].')" id="pg'.$res['id'].'" class="textHolder">'.$res['name'].'</span>
    </li>
  ';
}
echo "
  </ul>";




?>
