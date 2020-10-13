<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$data=$dbh->query("SELECT * FROM ve_contents WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
$form_template='
  <div '.(($data['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h1>Редактирование группы:</h1>
    <h2>Название:</h2>
    <input onchange="changeArticle('.$id.','.$id.',\'name\',this.value,\'ve_contents\');" type="text" name="main_title" value="'.$data['name'].'" />
    <h2>Ссылка для меню:</h2>
    <input onchange="changeArticle('.$id.','.$id.',\'ceni\',this.value,\'ve_contents\');" style="width:99%;" type="text" name="spec" value="'.$data['ceni'].'" />
    <input onClick="delArticle('.$id.',\'ve_contents\');" type="button" value="'.(($data['status'] == 0)?'Восстановить статью':'Удалить статью').'"/>
    <input onClick="newArticle();" type="button" value="Добавить новую статью" />
  </div>
';
echo $form_template;
?>
