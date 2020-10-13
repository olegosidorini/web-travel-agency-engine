<?php
function init_ceo($result,$dbh){
  $html_out='';
  $pg_ceo_h=$result['ceo_h'];
  $pg_ceo_t=$result['ceo_t'];
  if($pg_ceo_t)
  $html_out .='
    <h2>'.$pg_ceo_h.'</h2>
    <p>'.$pg_ceo_t.'</p>
  ';
  return $html_out;
}
