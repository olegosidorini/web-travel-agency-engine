<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$result=$dbh->query('SELECT * FROM ve_pages WHERE pid=0');
echo '<ul class="mySites">';
echo '<li class="mySitesItem"><img src="images/media.gif" class="spImage" /><span onClick="initSPO(0)" style="cursor: pointer">Все спецпредложения  </span>';
foreach ($result as $res){
	echo '<li class="mySitesItem"';
	if ($res['status'] != 1) echo "style='opacity: 0.4'";
	if ($res['id'] == 1)echo '><img src="images/catalog.gif" ';
	else echo '><img src="images/site.gif" ';
	echo 'class="spImage" /><span class="spSites" id="'.$res['id'].'">'.$res['type'].'</span>';
}
echo "</ul>";



?>
