<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$result=$dbh->query('SELECT * FROM ve_contents WHERE type="article" ORDER BY name');
echo '<ul class="myArticle">';
foreach ($result as $res){
	echo '<li class="myArticle"><img src="images/article.gif" class="spImage" /><span class="spArticle" id="'.$res['id'].'">'.$res['name'].'</span>';
}
echo "</ul>";

?>
