<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$base=$dbh->query("SELECT * FROM ve_photos where id='$id'")->fetch(PDO::FETCH_ASSOC);
$cros=$dbh->query("SELECT * FROM ve_crosstbl where pid='$id'")->fetch(PDO::FETCH_ASSOC);
echo '
  <div '.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h2>Сортировка:</h2>
    <input onchange="changeMedia('.$cros['id'].',\'sort\',this.value,\'crosstbl\',\''.$base['type'].'\');" type="text" name="main_sort" value="'.$cros['sort'].'" />
    <h1>Редактирование изображения:</h1>
    <h2>Заголовок:</h2>
    <input onchange="changeMedia('.$id.',\'title\',this.value,\'ve_photos\',\''.$base['type'].'\');" type="text" name="main_title" value="'.$base['title'].'" />
    <h2>Спец.Текст:</h2>
    <input onchange="changeMedia('.$id.',\'spec\',this.value,\'ve_photos\',\''.$base['type'].'\');" type="text" name="main_spec" value="'.$base['spec'].'" />
    <h2>Описание:</h2>
    <textarea onchange="changeMedia('.$id.',\'text\',this.value,\'ve_photos\',\''.$base['type'].'\');" name="text">'.$base['text'].'</textarea>
    <h3>'.((empty($base['path']))?'Фотограффии НЕТ!':'Предпросмотр:<br><img src="../'.$base['path'].'" />').'</h3>
    <input onClick="delMedia('.$id.',\'ve_photos\',\''.$base['type'].'\');" type="button" value="'.(($base['status'] == 0)?'Восстановить изображение':'Удалить изображение').'"/>
    <hr>
    <input class="r_b" type="radio" name="f_param" value="0" checked>добавить новый банер 
    <input class="r_b" type="radio" name="f_param" value="'.$id.'">заменить изображение на текущем банере<BR>
    <input onchange="newPhoto(0,0,\''.$base['type'].'\');" id="fileToUpload" type="file" name="fileToUpload" class="input"/>
    <hr>
    <h2>Выберите контент из списка или введите ссылку  в поле:</h2>
    <input onchange="changeMedia('.$id.',\'link\',this.value,\'ve_photos\',\''.$base['type'].'\');" name="link" type="text" value="'.$base['link'].'" />
    <form>
      <select name="contents_sp" row="3">
';
$result=$dbh->query('SELECT * FROM ve_pages WHERE type="region" OR type="menu" OR type="obr" ORDER BY "name" ASC');
foreach ($result as $res){
   		echo '<option '.(($base['link'] == "?id=".$res['id'])?'selected':'').' value="?id='.$res['id'].'">'.$res['name'].'</option>';
}
echo '
      </select>
      <input type="button" onClick="newLinkMedia(this.form.contents_sp.options,'.$id.')" id="conect" value="Связать">
    </form>
  </div>
';
?>
