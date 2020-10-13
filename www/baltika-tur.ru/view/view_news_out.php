<?php
function init_news($start,$dbh){
  $cont = $dbh->query("SELECT cid FROM ve_pages WHERE pid='".$start."' AND TYPE='news' and status='1'")->fetch(PDO::FETCH_ASSOC)['cid'];
  $result=$dbh->query("SELECT pid FROM ve_crosstbl WHERE cid='".$cont."' ORDER BY sort DESC");
  $html_out='
    <div class="wrapper-box module">
      <div class="border-top">
        <div class="border-bottom">
          <div class="corner-top-left">
            <div class="corner-top-right">
              <div class="corner-bottom-left">
                <div class="corner-bottom-right">
                  <div class="box-title">
                    <div class="border1-top">
                      <div class="corner1-top-left">
                        <div class="corner1-top-right clear">
                          <h3>НОВОСТИ</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-content">
                  <div class="clear">';
  foreach($result as $res){
    $npid = $res['pid'];
    $ca = $dbh->query("SELECT * FROM ve_news WHERE id='".$npid."' and status='1'")->fetch(PDO::FETCH_ASSOC);
    $html_out .= "<ul>";
    if (!empty($ca)){
      $html_out .="
        <li class='new_head'>
          <span  id='3' class='new_title'>
            ".substr($ca['date'],8,2).'.'.substr($ca['date'],5,2).'.'.substr($ca[0][date],0,4)."
          </span>&nbsp;&nbsp;&nbsp;&nbsp;
          <span  id='3' class='new_text'>".$ca['text']."</span>
        </li>
      ";
    }          
    $html_out .="</ul>";
  }
  $html_out .='</div></div></div></div></div></div></div></div>';
  return $html_out;
}