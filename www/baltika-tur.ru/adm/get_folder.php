<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];

$data=$dbh->query("SELECT * FROM ve_table_of_contents WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
echo '
  <div '.(($data['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h1>Редактирование группы:</h1>
    <h2>Название:</h2>
    <input onchange="changeContents('.$cid.','.$id.',\'title\',this.value,\'ve_table_of_contents\');"type="text" name="main_title" value="'.$data['title'].'" />
    <input onClick="delContents('.$cid.','.$id.',\'ve_table_of_contents\');" type="button" value="'.(($data['status'] == 0)?'Восстановить группу':'Удалить группу').'" />
    <input onClick="newTableOfContent('.$cid.');" type="button" value="Добавить новую группу" />
  </div>
';

?>
