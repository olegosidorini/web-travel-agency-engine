<?php
function init_baner($start,$dbh){
  $cat = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='baner' AND status='1'")->fetch(PDO::FETCH_ASSOC)['cid'];
  $result=$dbh->query("SELECT pid FROM ve_crosstbl WHERE cid='".$cat."' ORDER BY sort DESC");
  $html_out='
    <div id="flexslider">
      <ul class="slides clearfix">
  ';
  foreach($result as $banDb){
    $base = $dbh->query('SELECT * FROM ve_photos WHERE id="'.$banDb['pid'].'"')->fetch(PDO::FETCH_ASSOC);
    $html_out .='
        <li>
          <a href="'.HOST_STRING.$base['link'].'"><img alt="" src="'.$base['path'].'"></a>
          <div class="flex-caption">
              <div class="flex-box1">
                <p class="title1">'.$base['title'].': </p>
                <p class="title2">'.$base['spec'].'</p>
                <p>'.$base['text'].'</p>
              </div>
          </div>
        </li>
      ';        
  }
  $html_out .='
      </ul>
    </div>
  ';
  return $html_out;	
}
