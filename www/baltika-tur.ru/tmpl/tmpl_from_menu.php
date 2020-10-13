<?php
require_once "./view_m/view_catalog_out.php";
require_once "./view_m/view_menu_out.php";
require_once "./view/view_contents_out.php";
require_once "./view_m/view_contact_out.php";

function init ($startID,$content_ID,$dbh)
{
$result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
$pg_title=$result['title'];
$pg_keywords=$result['keywords'];
$pg_description=$result['description'];
$catalog_out=init_katalog($startID, $dbh);
$menu_out=init_menu($startID,$content_ID,$dbh);
$content_out=init_contents($content_ID, $dbh);
$contact_out=init_contact();

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
                <article class="span2" style="padding-top:100px;">
                '.$catalog_out.'
                </article>
                <article class="span7" ">
                  '.$content_out.'
                </article>
                <article class="span2 offset1 info1">
                  '.$contact_out.'
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



