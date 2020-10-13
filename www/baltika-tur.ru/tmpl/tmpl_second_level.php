<?php
require_once "./view_m/view_menu_out.php";
require_once "./view_m/view_tours_out.php";

function init ($startID,$content_ID,$dbh)
{
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$content_ID.'"')->fetch(PDO::FETCH_ASSOC);
  $pg_title=$result['title'];
  $pg_keywords=$result['keywords'];
  $pg_description=$result['description'];
  $pg_name=$result['name'];
  $menu_out=init_menu($startID,$content_ID,$dbh);
  $tours_out=init_tours($content_ID, $dbh);

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
        <script src="js/new/jquery.js"></script>
        <script>
        $(window).load(function() {									
          $(".thumb-pad8").hover(function(){
            $(this).find("strong").stop().css({height:0});
            $(this).find("span").stop().css({height:"100%"});
            $(this).find(".caption a").stop().css({color:"#fff"});
            $(this).find(".caption p").stop().css({color:"#fff"});	 
                }, function(){
            $(this).find("strong").stop().css({height:"100%"});
            $(this).find("span").stop().css({height:0});
            $(this).find(".caption a").stop().css({color:"#121212"});
            $(this).find(".caption p").stop().css({color:"#b8b8b8"});			
          })	 
        })
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
                  '.$tours_out.'
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
