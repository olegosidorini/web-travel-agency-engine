<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=$_REQUEST['id'];
$ss=$_REQUEST['ss'];
$res=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start_id.'"')->fetch(PDO::FETCH_ASSOC);
$type_content = $res['type'];
$cid = $res['cid'];
echo '<div>';
if ($type_content == 'catalog'){
  $ress=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$cid.'" AND pid=1')->fetch(PDO::FETCH_ASSOC);
  echo '
    <h2>Текущая страница</h2>
    <span class="zag">'.$res['name'].'</span>
    <h2>Cвязанана с каталогом: </h2>
    <a href="#" onClick="getContent('.$cid.')">'.$ress['name'].' :ID='.$cid.'</a>
    <h2>Выберите новый каталог из списка:</h2>
    <form>
    <select size=30 name="contents_sp">
  ';
  $result=$dbh->query('SELECT * FROM ve_pages WHERE type="catalog" AND pid="1"');
  foreach($result as $res){
    echo '<option '.(($cid == $res['id'])?' selected ':'').' value="'.$res['id'].'">'.$res['name'].'</option>';
    $resu=$dbh->query('SELECT * FROM ve_pages WHERE type="region" AND pid="'.$res['id'].'" AND status="1"');
    foreach($resu as $ru){
      echo '<option '.(($cid == $ru['id'])?' selected ':'').' value="'.$ru['id'].'">'.$ru['name'].'</option>';
    }  
  }
  echo '
      </select>
      <input TYPE="button" onClick="newConectContent(this.form.contents_sp.options,'.$start_id.')" id="conect" value="Связать">
      </form>
  ';       	
} else {
  if ($type_content == 'region'|| $type_content == 'menu' || $type_content == 'link') 
    $type_content="article";
  $ress=$dbh->query('SELECT * FROM ve_contents WHERE id="'.$cid.'"')->fetch(PDO::FETCH_ASSOC);
  echo '
    <h2>Текущая страница:</h2>
    <span class="zag">'.$res['name'].'</span>
    <h2>Cвязанана с контейнером:</h2>
    <a href="#" onClick="getContent('.$cid.')">'.$ress['name'].' :ID='.$cid.'</a>
    <h2>Выберите новый контейнер из списка:</h2>
    <form>
    <select size=30 name="contents_sp">
  ';
  if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_contents WHERE type="'.$type_content.'" AND status=1 ORDER BY name');
  else          $result=$dbh->query('SELECT * FROM ve_contents WHERE type="'.$type_content.'" ORDER BY name');
  foreach($result as $res){
    echo '<option '.(($cid == $res['id'])?' selected ':'').' value="'.$res['id'].'">'.$res['name'].'</option>';
  }
  echo '
      </select>
    <input type="button" onClick="newConectContent(this.form.contents_sp.options,'.$start_id.')" id="conect" value="Связать">
    </form>
  ';
  echo '</div>';
}
?>
