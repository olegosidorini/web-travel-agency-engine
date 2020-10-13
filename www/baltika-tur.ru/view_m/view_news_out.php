<?php
function init_news($start,$dbh){
  $cid = $dbh->query("SELECT cid FROM ve_pages WHERE pid='".$start."' AND TYPE='news' and status='1'")->fetch(PDO::FETCH_ASSOC)['cid'];
  $result=$dbh->query("SELECT pid FROM ve_crosstbl WHERE cid='".$cid."' ORDER BY sort DESC");
  $html_out='';
  foreach($result as $res){
    $ca = $dbh->query("SELECT * FROM ve_news WHERE id='".$res['pid']."' and status='1'")->fetch(PDO::FETCH_ASSOC);
    $html_out .= '';
    if (!empty($ca)){
      $html_out .='
        <article class="span2">
          <h3>'.$ca['title'].'</h3>
          <p>'.$ca['text'].'</p>
          <a href="'.$ca['link'].'" class="btn btn-link">подробнее</a>
        </article>
      ';
    }          
  }
  return $html_out;
}
