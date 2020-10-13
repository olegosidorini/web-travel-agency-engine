<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

if (!empty($_REQUEST['id']))$id=$_REQUEST['id'];
$base=$dbh->query("SELECT * FROM ve_pages where id='$id'")->fetch(PDO::FETCH_ASSOC);
$name=str_replace('"','`',$base['name']);
echo '
  <div'.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
      <h2>Сортировка:</h2>
      <input onchange="changeDB('.$id.',\'sort\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['sort'].'" />
      <h1>Редактирование страницы:</h1>
      <h2>Название:</h2>
      <input onchange="changePage('.$id.',\'name\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$name.'" />
      <h2>Текст спецпредложения:</h2>
      <input onchange="changeDB('.$id.',\'spo\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['spo'].'" />
      <h2>Title:</h2>
      <input onchange="changeDB('.$id.',\'title\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['title'].'" />
      <h2>Keywords:</h2>
      <input onchange="changeDB('.$id.',\'keywords\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['keywords'].'" />
      <h2>Description:</h2>
      <textarea onchange="changeDB('.$id.',\'description\',this.value,\'ve_pages\');" name="text" ows="2">'.$base['description'].'</textarea>
      <h2>Заголовок CEO текста:</h2>
      <input onchange="changeDB('.$id.',\'ceo_h\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['ceo_h'].'" />
      <h2>CEO текст</h2>
      <textarea onchange="changeDB('.$id.',\'ceo_t\',this.value,\'ve_pages\');" name="text"rows="3">'.$base['ceo_t'].'</textarea>
      <input onClick="delPage('.$id.');" type="button" value="'.(($base['status'] == 0)?'Включить страницу':'Bыключить страницу').'" />
      <input onClick="newPage('.$id.');" type="button" value="Дублировать страницу"/>
      <hr>
      <h2>Выберите новый тип:</h2>
';
$result=$dbh->query('SELECT * FROM ve_template where site_id="-1"');
foreach ($result as $res){
  echo '
    <br>
    <input class="r_bt" type="radio" name="f_param" onchange="changeType('.$id.')"'.(($base['type'] == $res['param'])?' checked ':' ').'value="'.$res['param'].'">
    <img src="images/'.$res['param'].'.gif" class="folderImage" />'.$res['description'];
}
echo '</div>'




?>
