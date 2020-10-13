<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$type=$_REQUEST['type'];
$ss=$_REQUEST['ss'];
echo '
  <ul class="myTree">
';
if($ss == 0) $result=$dbh->query('SELECT * FROM ve_contents WHERE type="'.$type.'" AND status="1"');
else         $result=$dbh->query('SELECT * FROM ve_contents WHERE type="'.$type.'"');
foreach ($result as $res){
  echo '
    <li class="folderItem"'.(($res['status'] == 0)?'style="opacity: 0.2"':' ').'>
      <img src="images/catalog.gif" class="folderImage" />
      <span onClick="getMediaCont('.$res['id'].')" class="folderHolder" id="'.$res['id'].'">'.$res['name'].'</span>
    </li>
  ';
  echo "
    <ul>
  ";
	init_desk($res['id'], $type, $ss, $dbh);
  echo "
    </ul>
  ";	
}
echo "
  </ul>
";


function init_desk($start, $type, $ss, $dbh){
  $result=$dbh->query('SELECT * FROM ve_crosstbl WHERE cid="'.$start.'" ORDER BY sort DESC');
  foreach($result as $res1){
    $res=$dbh->query('SELECT * FROM ve_photos WHERE id="'.$res1[pid].'"')->fetch(PDO::FETCH_ASSOC);  
    if (($ss == 1)||($res['status'] == 1)) {
      echo '
        <li class="deskItem" id="cn_'.$res1['id'].'"'.(($res['status'] != 1)?'style="opacity: 0.4"':' ').' onClick="getMedia('.$res['id'].')">
          <img id="desk" src="images/'.$type.'.gif" class="folderImage" />
          <span  id="'.$res['id'].'" class="textHolder">'.$res['title'].'</span>&nbsp
          <img src="images/del.gif" onclick="delItem('.$res1['id'].')" title="Убрать из контейнера"  class="folderImage"/>';
    }
  }
}


?>
