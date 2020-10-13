<?php
require_once "./view/view_ceo_out.php";
require_once "./view/view_catalog_out.php";
require_once "./view/view_menu_out.php";
require_once "./view/view_contents_out.php";
require_once "./view/view_baner_out.php";
require_once "./view/view_photo_out.php";

function init ($startID,$content_ID,$dbh)
{
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
  $pg_title=$result['title'];
  $pg_keywords=$result['keywords'];
  $pg_description=$result['description'];
  $pg_name=$result['name'];
  $ceo_out=init_ceo($result, $dbh);
  $catalog_out=init_katalog($startID, $dbh);
  $menu_out=init_menu($startID, $dbh);
  $content_out=init_contents($content_ID, $dbh);
  $baner_out=init_baner($startID, $dbh);
  $photo_out=init_photos($content_ID, $dbh);


  $html_out = '
    <!DOCTYPE html>
    <title>'.$pg_title.'</title>
    <meta charset=utf-8">
    <meta name="keywords" content="'.$pg_keywords.'" />
    <meta name="description" content="'.$pg_description.'" />
    <link href="css/init_go/template.css" type=text/css rel=stylesheet>
    <link  href="css/init_go/constant.css" type=text/css rel=stylesheet>
    <script type="text/javascript"src="js/jquery.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
    <script type="text/javascript" src="js/thickbox.js"></script>
    <script type="text/javascript">
      var region = "'.$result['pid'].'";
      var object = "'.$content_ID.'";
		</script>
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
      <div class="tail-top-menu clear">
      '.$menu_out.'
      </div>
      <div class="tail-content clear">
        <div class="main">
          <table id="content">
            <tr>
              <td valign="top">
                <div id="left">
                  <div class="indent-left">
                    <div class="clear">
                      '.$catalog_out.'
                      <div id="foto">'.$photo_out.'</div>
                    </div>
                  </div>
                </div>                                 
              </td>
              <td valign="top">
                <div id="container">
                  <div id="spec">'.$content_out.'</div>
                  '.$ceo_out.'
                </div>
              </td>
              <td valign="top">
                <div id="right">
                  <div class="indent-right">
                    <div class="clear">		
                      <div class="wrapper-box module-login">
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
                                            <h3>ОФОРМИТЬ ЗАКАЗ</h3>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-content">
                                      <div class="clear">
                                        <form action="" method="POST" name="up_form" enctype="multipart-form/data">
                                          <table id="form" width="50%">
                                            <tr>
                                              <td width="50%">Тур - '.$pg_name.'<br><br></td>
                                            </tr>
                                            <tr>
                                              <td width="50%">Дата поездки</td>
                                            </tr>
                                            <tr>
                                              <td width="100%">
                                                с <input type="text" name="date_s" id="date_s" value="" style="width:33%">
                                                по <input type="text" name="date_e" id="date_e" value="" style="width:33%">
                                              </td>
                                            </tr>
                                            <tr>
                                              <td width="100%">Информация по размещению</td>
                                            </tr>
                                            <tr>
                                              <td width="100%">
                                                <textarea  id="residing_info"  name="residing_info" style="width: 100%" rows="4"></textarea>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td width="100%">Контактное лицо (Ф.И.О)</td>
                                            </tr>
                                            <tr>
                                              <td width="100%"><input  id="fio"  type="text" name="fio" value="" style="width:100%"></td>
                                            </tr>
                                            <tr>
                                              <td width="100%">Телефон (с кодом города)</td>
                                            </tr>
                                            <tr>
                                              <td width="100%"><input  id="phone"  type="text" name="phone" value="" style="width:100%"></td>
                                            </tr>
                                            <tr>
                                              <td width="100%">E-mail</td>
                                            </tr>
                                            <tr>
                                              <td width="100%"><input  id="email"  type="text" name="email" value="" style="width:100%"></td>
                                            </tr>
                                            <tr>
                                              <td width="100%" align="center" colspan="2">
                                                <br>
                                                <input type="button" name="add" value="Отправить заказ" onClick="return verify()">
                                                <br><br>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td width="100%" id="ve_content"></td>
                                            </tr>
                                          </table>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="baners">'.$baner_out.'</div>
                    </div>
                  </div>
                </div>
              </td>               
            </tr>
          </table>
        </div>
      </div>
      <div class="tail-footer clear">
        <div class="main">
          <div id="footer" class="clear">
            <div class="indent">
              <a href="'.HOST_STRING.'">Восточный экспресc</a>
            </div>
          </div>
        </div>
      </div>
    </body>';

echo $html_out;


}


?>
