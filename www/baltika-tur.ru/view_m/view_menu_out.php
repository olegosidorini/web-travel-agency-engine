<?php
function init_menu($start,$content,$dbh){
  $catalogID = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='menu' ORDER BY sort")->fetch(PDO::FETCH_ASSOC)['id'];
  $result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$catalogID.'" AND status="1"');
  $html_out='
    <div class="container">
      <div class="navbar navbar_ clearfix">
        <div class="navbar-inner">      
          <div class="clearfix">
            <div class="nav-collapse nav-collapse_ collapse">
                <ul class="nav sf-menu clearfix sf-js-enabled">
                <li '.(($content==$start)?'class="active"':'').'><a href="'.HOST_STRING.'">Главная</a></li>
  ';
  foreach($result as $res){
    if ($res['type'] == 'menu'){
      $html_out .= '
                    <li '.(($content==$res['id'])?'class="active"':'').'><a href="'.HOST_STRING.'?id='.$res['id'].'">'.$res['name'].'</a></li>
      ';				  
    }
    if ($res['type'] == 'link'){
      $cont = $dbh->query("SELECT * FROM ve_contents WHERE id=".$res['cid']."")->fetch(PDO::FETCH_ASSOC);
      $html_out .= '
                    <li '.(($content==$res['id'])?'class="active"':'').'><a href="'.$cont['ceni'].'?id='.$res['id'].'">'.$res['name'].'/a></li>
      ';			  
      }
  }
  $html_out .= '
              </ul>
            </div>
          </div> 
        </div> 
      </div> 
    </div>  
   
  ';
  return $html_out;
}

   