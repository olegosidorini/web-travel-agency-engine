<?php
function init_spec($start,$dbh){
  $cid = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='media' AND status='1'")->fetch(PDO::FETCH_ASSOC)['cid'];
  $cont=$dbh->query("SELECT pid FROM ve_crosstbl WHERE cid='".$cid."' ORDER BY sort DESC");
  if(!empty($cont)){
    $html_out="";
    foreach($cont as $val){
      $base=$dbh->query('SELECT * FROM ve_photos WHERE id="'.$val['pid'].'"')->fetch(PDO::FETCH_ASSOC);
      $html_out .='
        <div class="border-box">
        <p class="title1">'.$base['title'].'</p>
        <p class="title2"><span>'.$base['spec'].'</span></p>
          <div class="thumb-pad6">
            <div class="thumbnail">
              <figure><img src="'.$base['path'].'" alt=""></figure>
              <div class="caption">
                  <p><strong>'.$base['text'].'</strong></p>
                  <a href="'.HOST_STRING.$base['link'].'" class="btn btn-link">подробнее</a>
              </div>
            </div>
          </div>
        </div>
      ';         
    }
  }
  return $html_out;	
}
