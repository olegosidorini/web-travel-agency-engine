<?php
function get_tour($result,$dbh){
  $html_out .='';
  foreach($result as $res){
    $spo=$res['spo'];
    $name=$res['name'];
    $link=HOST_STRING."?id=".$res['id'];
    $content = $dbh->query('SELECT * FROM ve_contents WHERE id="'.$res['cid'].'"')->fetch(PDO::FETCH_ASSOC);
    $spec = $content['ceni'];
    $table = $dbh->query('SELECT * FROM ve_table_of_contents WHERE cid="'.$res['cid'].'"')->fetch(PDO::FETCH_ASSOC);
    $descriptions = $dbh->query('SELECT * FROM ve_descriptions WHERE pid="'.$table['id'].'" AND status="1" ORDER BY sort DESC')->fetch(PDO::FETCH_ASSOC);
    $title=$descriptions['title'];
    $text=$descriptions['text'];
    $photos = $dbh->query('SELECT * FROM ve_photos WHERE pid="'.$table['id'].'" AND status="1" ORDER BY sort DESC')->fetch(PDO::FETCH_ASSOC);
    $pic_path=$photos['path'];
    $html_out.='
      <div class="wrapper-title">
        <div class="corner-top-left">
          <div class="corner-top-right">
            <div class="corner-bottom-left">
              <div class="corner-bottom-right clear">
                <div class="wrapper-title-bull">
                  <div class="wrapper-title-indent">
                    <div class="clear title-border contentpaneopen">
                      <div class="fright"><div class="icon-indent">
                        </div></div><div class="fleft contentheading">
                          <div class="title">'.$name.'</div>
                        </div>
                      </div>
                      <div class="clear contentpaneopen">';
    if(!empty($spo)){
      $html_out.='
                       <div class="spo">
                        <span>'.$spo.'</span>&nbsp;&nbsp;
                      </div>';
    }
    $html_out.='
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
                          <div class="clear">
                            <img src="'.$pic_path.'" class="img-right" alt="" border="0" width="160" height="120"/>
                            <strong class="br">'.$title.'</strong>'.$text.'
                            <div>
                              <div class="readmore">
                                <a href="'.$link.'" class="readon">Подробнее...</a>
                              </div>
                            </div>
                          </div>
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
    ';
    
  }
  return $html_out;
  }