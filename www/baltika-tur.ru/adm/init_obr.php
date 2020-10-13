<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

if(empty($_REQUEST['ss'])) $result=$dbh->query('SELECT * FROM ve_contents WHERE type="obr" AND status=1 ORDER BY name');
else                       $result=$dbh->query('SELECT * FROM ve_contents WHERE type="obr" ORDER BY name');

echo '<ul class="myOBR">';
foreach ($result as $res){
  echo '<li class="myOBR"'.((($res['status'] == 0)?'style="opacity: 0.5"':' ')).'>
          <img src="images/obr.gif" class="spImage" />
          <span class="spOBR" id="'.$res['id'].'">'.$res['name'].'</span>
        </li>';
}
echo "</ul>";

?>
