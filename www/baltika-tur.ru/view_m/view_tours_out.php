<?php
function init_tours($start, $dbh){
  $root=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'" ')->fetch(PDO::FETCH_ASSOC);
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1"');
  $html_out = '
    <div class="row"><div style=" float:right;"><h3 >'.$root['name'].'</h3></div></div>
    <div class="row">
  ';
  foreach($result as $res)
    $html_out .= get_tours($res['id'], $dbh);
  $html_out .='
    </div>
  ';
  return $html_out;
  }
  
  function get_tours($start, $dbh){
    $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1"');
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
        <article class="span4 box4">
          <div class="thumb-pad8 maxheight" style="height: 473px;">
            <div class="box_inner">
              <div class="thumbnail">
                  <figure><a href="'.$link.'"><img src="'.$pic_path.'" alt=""></a></figure>
                  <div class="caption">
                      <a href="'.$link.'" style="color: rgb(18, 18, 18);">'.$title.'</a>
                      <p style="color: rgb(184, 184, 184);">'.substr($text,0,700).'...</p>
                  </div>
              </div>
              <span style="height: 0px;"></span>
              <strong style="height: 100%;"></strong>
            </div>
          </div>
        </article>
      ';
      
    }
    return $html_out;
  }