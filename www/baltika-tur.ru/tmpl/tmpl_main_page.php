<?php
require_once "./view_m/view_ceo_out.php";
require_once "./view_m/view_catalog_out.php";
require_once "./view_m/view_menu_out.php";
require_once "./view_m/view_news_out.php";
require_once "./view_m/view_spec_out.php";
require_once "./view_m/view_baner_out.php";
require_once "./view_m/view_contact_out.php";

function init ($startID,$content_ID,$dbh)
{
  $result= $dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
  $pg_title=$result['title'];
  $pg_keywords=$result['keywords'];
  $pg_description=$result['description'];
  $ceo_out=init_ceo($result,$dbh);
  $catalog_out=init_katalog($startID,$dbh);
  $menu_out=init_menu($startID,$content_ID,$dbh);
  $news_out=init_news($startID,$dbh);
  $spec_out=init_spec($startID,$dbh);
  $baner_out=init_baner($startID,$dbh);
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
        <link rel="stylesheet" href="css/new/flexslider.css">
        <script src="js/new/jquery.js"></script>
        <script src="js/new/jquery.flexslider.js"></script>
        <script>
        $(window).load(function() {									
          $("#flexslider").flexslider({
              animation: "fade",			
              slideshow: true,			
              slideshowSpeed: 5000,
              animationDuration: 600,				
              prevText: "",
              nextText: "",
              controlNav: false,
              sync: "#slides-pagination"					
          });	 				
        })
        </script> 
        <head>
        <body class="">
        <div class="global">
          <!--header-->
          <header>
              <div class="container">
                  <h1 class="brand"><a href="'.HOST_STRING.'"><img src="images/new/logo.png" alt=""></a></h1>
              </div>
          </header>
          <div id="slider">
            '.$baner_out.'
          </div> 
          <div class="menu"> 
          '.$menu_out.'   
          </div>                 
          <!--content-->
          <div class="container padBot">
            <div class="row">
              <section class="span12">
                <div class="row">
                    <article class="span2">
                    '.$catalog_out.'
                    </article>
                    <article class="span4">
                      '.$ceo_out.'
                      <div class="row">
                        '.$news_out.'
                      </div>
                    </article>
                    <article class="span3">
                      '.$spec_out.'
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
