<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=1;
if (!empty($_REQUEST['id']))$start_id=$_REQUEST['id'];
if (!empty($_REQUEST['ss']))$ss=$_REQUEST['ss'];

$res=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start_id.'" ORDER BY sort')->fetch(PDO::FETCH_ASSOC);


echo '
  <ul class="myTree">
    <li class="treeItem">
      <img src="images/site.gif" class="folderImage" />
      <span  id="pg'.$start_id.'" class="textHolder">Сайт-'.$res['type'].'</span>';
      init_catalog($start_id, $ss, $dbh);	
echo "
    </li>
  </ul>";


function init_catalog($start, $ss, $dbh){
  if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1" ORDER BY sort');
  else          $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" ORDER BY sort');
  echo "<ul>";
  foreach($result as $res){
    echo '
    <li class="treeItem" '.(($res['status'] == 0)?'style="opacity: 0.5"':' ').'>
      <img src="images/'.$res['type'].'.gif" class="folderImage" id="img'.$res['id'].'"/>
      <span  id="pg'.$res['id'].'" class="textHolder" onClick="getPage('.$res['id'].')">'.$res['name'].'</span>
      <span  id="'.$res['id'].'" class="cidHolder">:'.$res['cid'].'</span>';
      init_catalog($res['id'], $ss, $dbh);
  }
  echo "
    </li>
  </ul>";
         	
}

?>
