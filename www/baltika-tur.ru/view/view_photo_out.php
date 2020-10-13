<?php
function init_photos($start, $dbh){
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'" AND status="1"')->fetch(PDO::FETCH_ASSOC);
  $t_of_c = $dbh->query("SELECT * FROM ve_table_of_contents WHERE cid=".$result['cid']." AND status='1'")->fetch(PDO::FETCH_ASSOC);
  $photos = $dbh->query("SELECT * FROM ve_photos WHERE pid=".$t_of_c['id']." AND status='1' AND type='photo'");
  $html='<center>';
  foreach($photos as $photo){
      $html .= "
        <br><a href='".$photo['path']."' title='".$photo['text']."' class='thickbox' rel='gallery-photo' >
         <img src='".$photo['path']."'  alt='".$photo['title']."'   alt='".$photo['title']."' width='160' height='120'>
        </a><br>";		
  }
  $html .="</center>";
  $html_out ='
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
                      <div class="title">Фотогалерея</div>
                    </div>
                  </div>
                  <div class="clear contentpaneopen"></div>
                </div>
              </div>
              <div class="content-text">
              <div class="clear">
                <table class="contentpaneopen">
                  <tbody>
                    <tr>
                      <td colspan="2" class="article_indent" valign="top">
                        <div class="clear">'
                          .$html.'
                          <div></div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="indent-article-separator"><span class="article_separator">&nbsp;</span></div>
          </div>
        </div>
      </div>
    </div>';
  return $html_out;
  }