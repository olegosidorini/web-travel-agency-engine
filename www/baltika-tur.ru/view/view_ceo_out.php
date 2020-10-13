<?php
function init_ceo($result,$dbh){
  $html_out='';
  $pg_ceo_h=$result['ceo_h'];
  $pg_ceo_t=$result['ceo_t'];
  if($pg_ceo_t)
  $html_out .='
    <div class="wrapper-col-box clear">
      <div class="corner-top-left">
        <div class="corner-top-right">
          <div class="corner-bottom-left">
            <div class="corner-bottom-right clear">
              <div class="wrapper-col-box-indent">
                <div class="clear">
                  <div class="col-1 fleft">
                      <div class="moduletable s1">
                          <h3>'.$pg_ceo_h.'</h3>
                      </div>
                      <div>'.$pg_ceo_t.'</div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>';
  return $html_out;
}