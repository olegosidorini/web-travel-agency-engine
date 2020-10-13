<?php
require_once "view_get_tour_out.php";
function init_spo($start,$dbh){
  $result=$dbh->query('SELECT cid FROM ve_pages WHERE pid="'.$start.'" AND type="catalog" AND status="1"');
  $html_out="";
  foreach($result as $res){
    $region=$dbh->query('SELECT id FROM ve_pages WHERE pid="'.$res['cid'].'" AND type="region" AND status="1"');
    foreach($region as $reg){
      $types=$dbh->query('SELECT id FROM ve_pages WHERE pid="'.$reg['id'].'" AND type="type" AND status="1"');
      foreach($types as $typ){
        $obr=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$typ['id'].'" AND type="obr" AND status="1" AND spo<>"0" AND spo<>""');
        if(!empty($obr))$html_out .= get_tour($obr,$dbh);
      }
    }
  }
  return $html_out;
}