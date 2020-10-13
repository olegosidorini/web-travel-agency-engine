<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=1;
$start_id=$_REQUEST['id'];
$ss=$_REQUEST['ss'];

$res=$dbh->query('SELECT * FROM ve_contents WHERE id="'.$start_id.'"')->fetch(PDO::FETCH_ASSOC);
echo '
  <ul class="myTree">
    <li class="treeItem">
      <img src="images/'.$res['type'].'.gif" class="folderImage" />
      <span class="textHolder" onClick="getContent('.$start_id.')">'.$res['name'].':'.$start_id.'</span>
    </li>
';
echo "
    <ul>
";

if($ss == 0) $result=$dbh->query('SELECT * FROM ve_table_of_contents WHERE cid="'.$start_id.'" AND status="1" ORDER BY sort DESC');
else         $result=$dbh->query('SELECT * FROM ve_table_of_contents WHERE cid="'.$start_id.'" ORDER BY sort DESC');
foreach ($result as $res){
  echo '
      <li class="folderItem"'.(($res[$j][status] == 0)?'style="opacity: 0.2"':' ').'>
        <img src="images/catalog.gif" class="folderImage" />
        <span onClick="getFolder('.$res['id'].','.$start_id.')" class="folderHolder" id="'.$res['id'].'">'.$res['title'].':'.$res['id'].'</span>
      </li>    
  ';
  echo "
      <ul>";
      init_desk($res['id'], $start_id, $ss, $dbh);
      init_foto($res['id'], $start_id, $ss, $dbh);
      init_file($res['id'], $start_id, $ss, $dbh);
  echo "
      </ul>";	
}
echo "
    </ul>
";
echo "
  </ul>
";


function init_desk($start, $cid, $ss, $dbh){
  if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_descriptions WHERE pid="'.$start.'" AND status="1" ORDER BY sort DESC');
  else          $result=$dbh->query('SELECT * FROM ve_descriptions WHERE pid="'.$start.'" ORDER BY sort DESC');
  foreach ($result as $res){
    echo '
      <li class="deskItem"'.(($res['status'] != 1)?'style="opacity: 0.4"':' ').' onClick="getDesk('.$res['id'].','.$cid.')">
        <img id="desk" src="images/desk.gif" class="folderImage" />
        <span  id="'.$res['id'].'" class="textHolder">'.$res['title'].'</span>
      <li/>
    ';
  }
}

function init_foto($start, $cid, $ss, $dbh){
  if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_photos WHERE pid="'.$start.'" AND status="1"  AND type="photo" ORDER BY sort DESC');
  else          $result=$dbh->query('SELECT * FROM ve_photos WHERE pid="'.$start.'" AND type="photo" ORDER BY sort DESC');
  foreach ($result as $res){
    echo '
      <li class="deskItem" '.(($res['status'] != 1)?'style="opacity: 0.4"':' ').' onClick="getFoto('.$res['id'].','.$cid.')">
        <img id="foto" src="images/foto.gif" class="folderImage" />
        <span  id="'.$res['id'].'" class="textHolder">'.$res['title'].'</span>
      <li/>
    ';
  } 
}


function init_file($start, $cid, $ss, $dbh){
  if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_photos WHERE pid="'.$start.'" AND status="1" AND type="file" ORDER BY sort DESC');
  else          $result=$dbh->query('SELECT * FROM ve_photos WHERE pid="'.$start.'" AND type="file" ORDER BY sort DESC');
  foreach ($result as $res){
    echo '
      <li class="deskItem"'.(($res['status'] != 1)?'style="opacity: 0.4"':' ').' onClick="getFile('.$res['id'].','.$cid.')">
        <img id="foto" src="images/file.gif" class="folderImage" />
        <span  id="'.$res['id'].'" class="textHolder">'.$res['title'].'</span>
      </li>
    ';
  }
}

?>
