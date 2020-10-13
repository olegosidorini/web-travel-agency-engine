<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$data=$dbh->query("SELECT * FROM ve_contents WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);

echo '
  <div '.(($data['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h1>Редактирование группы:</h1>
    <h2>Название:</h2>
    <input onchange="changeContents('.$id.','.$id.',\'name\',this.value,\'ve_contents\');" type="text" name="main_title" value="'.$data['name'].'" />
    <h2>Спец.текст:</h2>
    <input onchange="changeContents('.$id.','.$id.',\'ceni\',this.value,\'ve_contents\');" type="text" name="main_title" value="'.$data['ceni'].'" />
    <input onClick="delContent('.$id.',\'contents\');" type="button" value="'.(($data['status'] == 0)?'Восстановить':'Удалить').'" />
    <input onClick="newContent();" type="button" value="Дублировать текущий элемент" style="width: 99%"/>
  </div>
';

?>
