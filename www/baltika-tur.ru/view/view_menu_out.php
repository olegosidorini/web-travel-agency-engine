<?php
function init_menu($start,$dbh){
  $catalogID = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='menu' ORDER BY sort")->fetch(PDO::FETCH_ASSOC)['id'];
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$catalogID.'" AND status="1"');
  $html_out='
  <table cellpadding="0" cellspacing="0" height="100%">
    <tbody> 
      <tr>
        <td>&nbsp;</td>
        <td  style="background-color:#aaa;"></td>';
  foreach($result as $res){
    if ($res['type'] == 'menu'){
      $html_out .= "
        <td  style='vertical-align:middle;text-align:center;'>
          <a href='".HOST_STRING."?id=".$res['id']."' class='menu_h'>".$res['name']."</a>
        </td>";					  
    }
    if ($res['type'] == 'link'){
      $cont = $dbh->query("SELECT * FROM ve_contents WHERE id=".$res['cid']."")->fetch(PDO::FETCH_ASSOC);
      $html_out .= "
        <td  style='vertical-align:middle;text-align:center;'>
          <a href='".$cont['ceni']."' class='menu_h'>".$res['name']."</a>
        </td>";					  
      }
      if ($res == end($result)){
        $html_out .= "
        <td  style='background-color:#aaa;'></td>
        ";
      }
  }
  $html_out .= "
      <td width='1' style='background-color:#aaa;'></td><td>&nbsp;</td></tr></tbody></table>";
  return $html_out;
}