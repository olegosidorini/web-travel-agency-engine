<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=$_REQUEST['id'];

$res=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start_id.'"')->fetch(PDO::FETCH_ASSOC);

$new_id = clon_record($start_id,$res['pid'],$dbh);
clon_catalog($start_id, $new_id,$dbh);

$res=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$new_id.'"')->fetch(PDO::FETCH_ASSOC);
echo '
  <li class="treeItem">
    <img src="images/'.$res['type'].'.gif" class="folderImage" id="img'.$res['id'].'"/>
    <span  id="'.$res['id'].'" class="textHolder" onClick="getPage('.$res['id'].')">'.$res['name'].'</span>
    <span  id="'.$res['id'].'" class="cidHolder">:'.$res['cid'].'</span>
';
init_catalog($new_id,$dbh);
echo '
  </li>
';	

function init_catalog($start,$dbh){
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'"');
  echo '<ul>';
  foreach ($result as $res){
      echo '
        <li class="treeItem">
          <img src="images/"'.$res['type'].'.gif" class="folderImage" id="img'.$res['id'].'"/>
          <span  id="'.$res['id'].'" class="textHolder" onClick="getPage('.$res['id'].')">'.$res['name'].'</span>
          <span  id="'.$res['id'].'" class="cidHolder">:'.$res['cid'].'</span>';
          init_catalog($res['id'],$dbh);
      echo '</li>';
  }
  echo '</ul>';
}


function clon_catalog($start,$npid,$dbh){
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'"');
  foreach ($result as $res){
      clon_catalog($res['id'], clon_record($res['id'], $npid));
  }
}


function clon_record($start,$npid,$dbh){
  $res=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'"')->fetch(PDO::FETCH_ASSOC);
  $dbh->query("INSERT INTO ve_pages(pid,name,cid,sort,type,status) values('".$npid."','".$res['name']."','".$res['cid']."','".$res['sort']."','".$res['type']."','".$res['status']."')");
  return $dbh->query("SELECT * FROM ve_pages ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];  
}
?>
