<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];
$base=$dbh->query("SELECT * FROM ve_photos where id='$id' AND type='file'")->fetch(PDO::FETCH_ASSOC);

$pos = strpos($base['path'], '.');
if ($pos)$type_file = substr($path,$pos+1);
else $type_file = 'none';
$pic_path="../images/".$type_file;
echo '
  <div '.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h2>Сортировка:</h2>
    <input onchange="changeContents('.$cid.','.$id.',\'sort\',this.value,\'ve_photos\');" type="text" name="main_sort" value="'.$base['sort'].'" />
    <h1>Редактирование файла:</h1>
    <h2>Название:</h2>
    <input onchange="changeContents('.$cid.','.$id.',\'title\',this.value,\'ve_photos\');" type="text" name="main_title" value="'.$base['title'].'" />
    <h2>Описание:</h2>
    <textarea onchange="changeContents('.$cid.','.$id.',\'text\',this.value,\'ve_photos\');" name="text">'.$base['text'].'</textarea>
    <h3>'.((empty($base['path']))?'Файла НЕТ!':'Файл:<br><a href="../'.$path.'"><img src="'.$pic_path.'.gif"  /> - '.$path.'</a>').'</h3>
    <input onClick="delContents('.$cid.','.$id.',\'ve_photos\');" type="button" value="'.(($base['status'] == 0)?'Восстановить файл':'Удалить файл').'"/>
    <hr>
    <input class="r_b" type="radio" name="f_param" value="0" checked>добавить новый файл&nbsp
    <input class="r_b" type="radio" name="f_param" value="'.$id.'">заменить файл<BR>
    <input onchange="newPhoto('.$cid.','.$base['pid'].',\'file\');" id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"/>
  </div>
';

?>
