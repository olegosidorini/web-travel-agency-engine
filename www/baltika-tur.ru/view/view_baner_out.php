<?php
function init_baner($start,$dbh){
  $cat = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='baner' AND status='1'")->fetch(PDO::FETCH_ASSOC)['cid'];
  $result=$dbh->query("SELECT pid FROM ve_crosstbl WHERE cid='".$cat."' ORDER BY sort DESC");
  $html_out="";
  foreach($result as $banDb){
    $base = $dbh->query('SELECT * FROM ve_photos WHERE id="'.$banDb['pid'].'"')->fetch(PDO::FETCH_ASSOC);
    $mttl=$base['title'];
    $mtext=$base['text'];
    $spec=$base['spec'];
    $pid=$base['pid'];
    $type=$base['type'];
    $pic_path="".$base['path'];
    $link =HOST_STRING.$base['link'];
    $html_out .='
      <div class="wrapper-box module">
        <div class="border-top">
          <div class="border-bottom">
            <div class="corner-top-left">
              <div class="corner-top-right">
                <div class="corner-bottom-left">
                  <div class="corner-bottom-right">
                    <div class="box-content">
                      <a href="'.$link.'" class="baner_a">
                        <br>
                        <table width="200" height="100" background="'.$pic_path.'">
                          <tr>
                            <td align="right">
                              <span class="baner_spec">'.$spec.'</span>
                            </td>
                          </tr>
                          <tr>
                            <td align="right">
                              <span class="baner_text">'.$mtext.'</span>
                            </td>
                          </tr>
                          <tr>
                            <td align="right" style="vertical-align: bottom;">
                              <span class="baner_ttl">'.$mttl.'</span>
                            </td>
                          </tr>
                        </table>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';        
  }
  return $html_out;	
}