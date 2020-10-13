<?php
require_once "./view/view_ceo_out.php";
require_once "./view/view_catalog_out.php";
require_once "./view/view_menu_out.php";
require_once "./view/view_news_out.php";
require_once "./view/view_spo_out.php";
require_once "./view/view_baner_out.php";
require_once "./view/view_contact_out.php";

function init ($startID,$content_ID,$dbh)
{
  var_dump($dbh);
  $result= $dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
  $pg_title=$result['title'];
  $pg_keywords=$result['keywords'];
  $pg_description=$result['description'];
  $ceo_out=init_ceo($result,$dbh);
  $catalog_out=init_katalog($startID,$dbh);
  $menu_out=init_menu($startID,$dbh);
  $news_out=init_news($startID,$dbh);
  $spec_out=init_spo($startID,$dbh);
  $baner_out=init_baner($startID,$dbh);
  $contact_out=init_contact();
  $html_out = '
    <!DOCTYPE html>
    <title>'.$pg_title.'</title>
    <meta charset=utf-8">
    <meta name="keywords" content="'.$pg_keywords.'" />
    <meta name="description" content="'.$pg_description.'" />
    <link href="css/init_go/template.css" type=text/css rel=stylesheet>
    <link  href="css/init_go/constant.css" type=text/css rel=stylesheet>
    <body id="body">
      <div class="tail-header clear">
        <div class="main">
          <div class="header">
            <div class="row-logo">
              <h1><a href="'.HOST_STRING.'"></a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="tail-top-menu clear">'.$menu_out.'</div>
      <div class="tail-content clear">
        <div class="main">
          <table id="content">
            <tr>
              <td valign="top">  
                <div class="clear">
                  <div id="left">
                    <div class="indent-left">
                      <div class="clear">'
                        .$catalog_out.$news_out.
                      '</div>
                    </div>
                  </div>
                </div>
              </td>
              <td valign="top">                                        
                <div id="container">
                  <div class="container-indent">
                    <div class="clear">
                      <div id="spec">'.$spec_out.'</div>
                      <div style="width:490px;>'.$ceo_out.'</div>
                    </div>
                  </div>
                </div>
              </td>
              <td valign="top">  
                <div id="right">
                  <div class="indent-right">
                    <div class="clear">		
                      '.$contact_out.'
                      <div id="baners">'.$baner_out.'</div>
                    </div>
                  </div>
                </div>
              </td>  
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="tail-footer clear">
        <div class="main">
          <div id="footer" class="clear">
            <div class="indent">
              <a href="/index.php">Восточный экспресc</a>
            </div>
          </div>
        </div>
      </div>
    </body>
  ';


  echo $html_out;
}
