<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];
$base=$dbh->query("SELECT * FROM ve_photos where id='$id'")->fetch(PDO::FETCH_ASSOC);
echo '
  <div '.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h2>Сортировка:</h2>
    <input onchange="changeContents('.$cid.','.$id.',\'sort\',this.value,\'ve_photos\');"  type="text" name="main_sort" value="'.$base['sort'].'" />
    <h1>Редактирование изображения:</h1>
    <h2>Название:</h2>
    <input onchange="changeContents('.$cid.','.$id.',\'title\',this.value,\'ve_photos\');"  type="text" name="main_title" value="'.$base['title'].'" />
    <h2>Описание:</h2>
    <textarea onchange="changeContents('.$cid.','.$id.',\'text\',this.value,\'ve_photos\');" name="text" >'.$base['text'].'</textarea>
    <h3'.((empty($base['path']))?'Фотограффии НЕТ!':'Предпросмотр:<br><img src="../'.$base['path'].'"  />').'</h3>
    <input onClick="delContents('.$cid.','.$id.',\'ve_photos\');" type="button" value="'.(($base['status'] == 0)?'Восстановить изображение':'Удалить изображение').'" />
    <hr>
    <input class="r_b" type="radio" name="f_param" value="0" checked>добавить новое изображение&nbsp
    <input class="r_b" type="radio" name="f_param" value="'.$id.'">заменить изображение
    <input onchange="newPhoto('.$cid.','.$base['pid'].',\'photo\');" id="fileToUpload" type="file" name="fileToUpload" class="input"/>
  </div>
';

?>
