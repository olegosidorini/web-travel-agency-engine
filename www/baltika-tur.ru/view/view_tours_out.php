<?php
require_once "view_get_tour_out.php";
function init_tours($start, $dbh){
  $root=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'" ')->fetch(PDO::FETCH_ASSOC);
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1"');
  $html_out = '&nbsp;&nbsp;<a href="'.HOST_STRING.'">Главная</a>&nbsp;&nbsp;|&nbsp;&nbsp;'.$root['name'].'<br><br><br>';
  $html_out .='
    <table class="blog" cellpadding="0" cellspacing="0"><tbody>';
  foreach($result as $res){
    $html_out .='
      <tr>
        <td valign="top">
          <div>
            <span class="type_tour">&nbsp;&nbsp;'.$res['name'].'</span><br><br>'
            .get_tours($res['id'], $dbh).'
          </div>
        </td>
      </tr>';
  }
  $html_out .='
    </tbody></table>';

  return $html_out;
  }
  
  function get_tours($start, $dbh){
    $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1"');
    $html_out = get_tour($result, $dbh);
  return $html_out;
  }