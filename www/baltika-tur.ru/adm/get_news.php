<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];
$base=$dbh->query("SELECT * FROM ve_news where id='$id'")->fetch(PDO::FETCH_ASSOC);
$cros=$dbh->query("SELECT * FROM ve_crosstbl where pid='$id'")->fetch(PDO::FETCH_ASSOC);
echo '
  <div'.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h2>Сортировка:</h2>
    <input onchange="changeNews('.$cros['id'].',\'sort\',this.value,\'ve_crosstbl\');" type="text" name="main_sort" value="'.$cros['sort'].'" />
    <h1>Редактирование новости:</h1>
    <input onChange="changeNews('.$id.',\'date\',this.value,\'ve_news\');"  type="text" name="main_title" value="'.$base['date'].'" />
    <input onChange="changeNews('.$id.',\'title\',this.value,\'ve_news\');" type="text" name="main_title" value="'.$base['title'].'" />
    <textarea onChange="changeNews('.$id.',\'text\',this.value,\'ve_news\');" name="text" rows="25">'.$base['text'].'</textarea>
    <input onClick="delNews('.$id.',\'ve_news\')" type="button" value="'.(($base['status'] == 0)?'Восстановить новость':'Удалить новость').'" />
    <input onClick="newNews()" type="button" value="Добавить новость"  />
    <hr>
    <h2>Выберите контент из списка или введите ссылку  в поле:</h2>
    <input onchange="changeNews('.$id.',\'link\',this.value,\'ve_news\',\''.$base['type'].'\');" name="link" type="text" value="'.$base['link'].'" />
    <form>
      <select name="contents_sp" row="3">
';
$result=$dbh->query('SELECT * FROM ve_pages WHERE type="region" OR type="menu" OR type="obr" ORDER BY "name" ASC');
foreach ($result as $res){
   		echo '<option '.(($base['link'] == "?id=".$res['id'])?'selected':'').' value="?id='.$res['id'].'">'.$res['name'].'</option>';
}
echo '
      </select>
      <input type="button" onClick="newLinkNews(this.form.contents_sp.options,'.$id.')" id="conect" value="Связать">
    </form>
  </div>
';


?>
