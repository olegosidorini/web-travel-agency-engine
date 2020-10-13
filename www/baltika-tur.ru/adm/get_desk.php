<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];

$base=$dbh->query("SELECT * FROM ve_descriptions WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
echo ' 
  <div '.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h1>Редактирование элемента описания:</h1>
    <h2>Сортировка:</h2>
    <input onchange="changeContents('.$_REQUEST['cid'].','.$id.',\'sort\',this.value,\'ve_descriptions\');" type="text" name="main_sort" value="'.$base['sort'].'" />
    <h2>Название:</h2>
    <input onChange="changeContents('.$cid.','.$id.',\'title\',this.value,\'ve_descriptions\');" type="text" name="main_title" value="'.$base['title'].'" />
    <textarea rows="20" cols="40" id="html" class="markItUpEditor" >'.$base['text'].'</textarea>
    <input onClick="saveText('.$cid.','.$id.',\'text\',\'ve_descriptions\')" type="button" value="Сохранить текст"/>
    <input onClick="delContents('.$cid.','.$id.',\'ve_descriptions\')" type="button" value="'.(($base['status'] == 0)?'Восстановить описание':'Удалить описание').'" />
    <input onClick="newDescription('.$cid.','.$base['pid'].')" type="button" value="Добавить еще одно описание" />
  </div>
';
?>
