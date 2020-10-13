<?php
function init_spec($start, $dbh){
  $html_out="";
  $cat=$dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='media' AND status='1'")->fetch(PDO::FETCH_ASSOC);
  if(!empty($cat)){
    $cont=$dbh->query("SELECT * FROM ve_crosstbl WHERE cid=".$cat['cid']." ORDER BY sort DESC");
    $html_out .='<table class="blog"><tbody>';
    foreach($cont as $val){
      $html_out .='
        <tr>
          <td valign="top">
            <div>'.get_spec($val['pid'], $dbh).'</div>
          </td>
        </tr>';
    }
    $html_out .='</tbody></table>';
    
  }
  return $html_out;
}
  
function get_spec($start, $dbh){
  $base=$dbh->query('SELECT * FROM ve_photos WHERE id="'.$start.'"')->fetch(PDO::FETCH_ASSOC);
  $mttl=$base['title'];
  $mtext=$base['text'];
  $spec=$base['spec'];
  $pid=$base['pid'];
  $type=$base['type'];
  $pic_path="".$base['path'];
  $link =HOST_STRING.$base['link'];
  $html_out='
    <div class="wrapper-title">
      <div class="corner-top-left">
        <div class="corner-top-right">
          <div class="corner-bottom-left">
            <div class="corner-bottom-right clear">
              <div class="wrapper-title-bull">
                <div class="wrapper-title-indent">
                  <div class="clear title-border contentpaneopen">
                    <div class="fright">
                      <div class="icon-indent"></div>
                    </div>
                    <div class="fleft contentheading">
                      <div class="title">'.$mttl.'</div>
                    </div>
                  </div>
                  <div class="clear contentpaneopen">
                    <div class="small">
                      <span>'.$spec.'</span>&nbsp;&nbsp;
                    </div>
                  </div>
                </div>
              </div>
              <div class="content-text">
                <div class="clear">
                  <table class="contentpaneopen">
                    <tbody>
                      <tr>
                        <td colspan="2" class="article_indent" valign="top">
                          <div class="clear"><img src="'.$pic_path.'" class="img-right" alt="" border="0">'.$mtext.'<div>
                          <div class="readmore"><a href="'.$link.'" class="readon">Подробнее...</a></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="indent-article-separator">
                <span class="article_separator">&nbsp;</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  ';
  
  return $html_out;
}