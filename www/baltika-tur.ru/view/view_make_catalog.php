<?php
function make_catalog($start, $dbh){
  $html_out='';
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND status="1"');
  $html_out .= "
    <ul>";
  foreach($result as $res){
    if ($res['type'] == 'type')
      $html_out .= "
        <li class='treeItem'>
          <img class='expandImage' src='img/minus.gif'/ onClick='activCatalog(this)'>
          <span  class='aol_typeHolder' id='".$result[$i][id]."' >".$result[$i][name]."</span>
        </li>";
    else if ($res['type'] == 'obr')
      $html_out .= "
        <li class='treeItem'>
          <img class='expandImage' src='img/spacer.gif'/>
          <a href='".HOST_STRING."/?id=".$res['id']."' class='aol_textHolder' id='".$res['id']."'>".$res['name']."</a>
        </li>";
    else
      $html_out .= "
        <li class='treeItem'>
          <img class='expandImage' src='img/minus.gif'/ onClick='activCatalog(this)'>
          <a href='".HOST_STRING."/?id=".$res['id']."' class='aol_regionHolder' id='".$res['id']."'>".$res['name']."</a>
        </li>";		

  if ($res['type'] != 'obr') $html_out .= make_catalog($res['id'], $dbh);
  }
  $html_out .= "
    </ul>";
           
  return $html_out;
}