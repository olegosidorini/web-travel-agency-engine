<?php

function init_katalog($start,$dbh){
	$html_out='';
	$result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND type="catalog" AND status="1" ORDER BY sort');
	foreach($result as $res){
		$html_out .='<h4>'.$res['name'].'</h4>'.init_catalog_reg($res['cid'],$dbh);
  }
	return $html_out;
}

function init_catalog_reg($start,$dbh){
  $result = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='region' AND status=1 ORDER BY sort" );
  $html_out = '<ul class="list1 margBot1">';
  foreach($result as $res){
    $html_out .= '<li><a href="'.HOST_STRING.'?id='.$res['id'].'">'.$res['name'].'</a></li>';					         
  }
  $html_out .= "</ul>";
  return $html_out;
}