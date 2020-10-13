<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$start_id=$_REQUEST['id'];
$base=$dbh->query("SELECT * FROM ve_pages where id='$start_id'")->fetch(PDO::FETCH_ASSOC);

echo '
  <div'.(($base['status'] == 0)?'style="opacity: 0.2;"':'').'>
    <h1>Домен сайта:</h1>
    <input onchange="changeDB('.$start_id.',\'type\',this.value,\'ve_pages\');" type="text" name="domen" value="'.$base['type'].'" />
    <h2>Заголовок сайта:</h2>
    <input onchange="changeDB('.$start_id.',\'title\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['title'].'" /></td>
    <h2>Список ключевых слов (keywords):</h2>
    <textarea onchange="changeDB('.$start_id.',\'keywords\',this.value,\'ve_pages\');" name="text"rows="2">'.$base['keywords'].'</textarea>
    <h2>Описание (descriptions):</h2>
    <textarea onchange="changeDB('.$start_id.',\'description\',this.value,\'ve_pages\');" name="text" rows="2">'.$base['description'].'</textarea>
    <h2>Заголовок CEO текста:</h2>
    <input onchange="changeDB('.$start_id.',\'ceo_h\',this.value,\'ve_pages\');" type="text" name="main_title" value="'.$base['ceo_h'].'" />
    <h2>CEO текст</h2>
    <textarea onchange="changeDB('.$start_id.',\'ceo_t\',this.value,\'ve_pages\');" name="text"rows="3">'.$base['ceo_t'].'</textarea>
    <input onClick="delSite('.$start_id.')" type="button" value="'.(($base['status'] == 0)?'Включить сайт':'Bыключить сайт').'" />
    <h2>Параметры шаблона сайта:</h2>
';
$result=$dbh->query('SELECT * FROM ve_template WHERE site_id="'.$start_id.'"');
foreach ($result as $res){
  echo '
    <h2>'.$res['description'].'</td>
    <input onchange="changeDB('.$res['id'].',\'value\',this.value,\'ve_template\');" style="width:99%;" type="text" NAME="'.$res['param'].'" value="'.$res['value'].'">
  ';
}
echo '
    <input onClick="newSite('.$start_id.')" type="button" value="Добавить сайт"/>
  </div>
';
?>
