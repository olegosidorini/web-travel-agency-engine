<?php
require_once "./view_m/view_ceo_out.php";
require_once "./view_m/view_menu_out.php";
require_once "./view/view_contents_out.php";
require_once "./view/view_photo_out.php";

function init ($startID,$content_ID,$dbh)
{
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
  $pg_title=$result['title'];
  $pg_keywords=$result['keywords'];
  $pg_description=$result['description'];
  $pg_name=$result['name'];
  $ceo_out=init_ceo($result, $dbh);
  $menu_out=init_menu($startID,$content_ID,$dbh);
  $content_out=init_contents($content_ID, $dbh);
  $photo_out=init_photos($content_ID, $dbh);


  $html_out = '
    <!DOCTYPE html>
    <html lang="ru">
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>'.$pg_title.'</title>
        <meta charset=utf-8">
        <meta name="keywords" content="'.$pg_keywords.'" />
        <meta name="description" content="'.$pg_description.'" />
        <link rel="stylesheet" href="css/new/bootstrap.css">
        <link rel="stylesheet" href="css/new/responsive.css">
        <link rel="stylesheet" href="css/new/style.css">
        <script type="text/javascript"src="js/jquery.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
        <script type="text/javascript" src="js/thickbox.js"></script>
        <script type="text/javascript">
        var region = "'.$result['pid'].'";
        var object = "'.$content_ID.'";
      </script>
      <head>
      <body class="">
        <div class="global">
          <header>
            <div class="container">
            <div class="menu"> 
            '.$menu_out.'   
            </div>   
                <h1 class="brand" style="position:absolute;top:0;"><a href="'.HOST_STRING.'"><img src="images/new/logo.png" alt=""></a></h1>
            </div>
          </header>
          <div class="container" style="padding-top:80px">
          <div class="row">
            <section class="span12">
              <div class="row">
                  <article class="span2">
                  '.$photo_out.'
                  </article>
                  <article class="span7" style="padding-top:80px;">
                    '.$content_out.'
                  </article>
                  <article class="span2 offset1 info1">
                    <h3>'.$pg_name.'</h3>
                    <form id="contact-form" name="up_form" >
                        <div class="success" id="ve_content"></div>
                        <fieldset>
                            <div>
                                <div class="form-div-1">
                                    <label class="name">
                                    <input type="text" value="Name:" id="fio" >
                                  </label>
                                </div>
                                <div class="form-div-2">
                                  <label class="email">
                                    <input type="email" value="Email:" id="email" >
                                  </label>
                                </div>
                                <div class="form-div-3">
                                  <label class="phone">
                                    <input type="tel" value="Phone:" id="phone">
                                  </label>
                                </div>
                            </div>
                            <div>
                                <label class="message">
                                <textarea id="residing_info">Message:</textarea>
                                </label>
                            </div>
                            <div class="btns">
                                <a href="#" data-type="reset" class="btn btn-link" onClick="return verify()">Отправить</a>
                            </div>
                        </fieldset>
                    </form>
                  </article>
              </div>
            </section>
          </div>
        </div>
        </div>
        <!--footer-->
        <footer>
          <div class="container">
            <div class="row">
              <article class="span2 pull-left">
                  <figure><img alt="" src="images/new/footer_logo.png"></figure>
                  <p>© 2020<br><a href="/">Privacy Policy</a></p>
              </article>
            </div>
          </div>   
        </footer>
      </body>
    </html>
';

echo $html_out;


}


?>
