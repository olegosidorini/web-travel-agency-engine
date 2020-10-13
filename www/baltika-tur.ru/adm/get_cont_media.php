<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$ss=$_REQUEST['ss'];

$data=$dbh->query("SELECT * FROM ve_contents WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
echo '
  <div '.(($data['status'] == 0)?'style="opacity: 0.2;"':'').'>
  <h1>Редактирование группы:</h1></td>
  <h2> Название:</h2>
  <input onchange="changeMedia('.$id.',\'name\',this.value,\'ve_contents\',\''.$data['type'].'\');"  type="text" name="main_title" value="'.$data['name'].'" />
  <input onClick="delMediaCont('.$id.',\'ve_contents\',\''.$data['type'].'\');" type="button" value="'.(($data['status'] == 0)?'Восстановить контейнер':'Удалить контейнер').'" />
  <input onClick="newMediaCont(\''.$data['type'].'\');" type="button" value="Добавить новый контейнер" />
  <h2>Выберите новый контент из списка:<h2>
  <form>
    <select name="contents_sp">
';
if ($ss == 0) $result=$dbh->query('SELECT * FROM ve_photos WHERE type="'.$data['type'].'" AND status="1"');
else          $result=$dbh->query('SELECT * FROM ve_photos WHERE type="'.$data['type'].'"');
foreach ($result as $res){
  echo '<option  value="'.$res['id'].'">'.$res['title'].'</option>';
}
echo '
      </select>
      <input type="button" onClick="newConectMedia(this.form.contents_sp.options,'.$id.',\''.$data['type'].'\')" id="conect" value="Связать">
    </form>
  </div>
';       	

?>
