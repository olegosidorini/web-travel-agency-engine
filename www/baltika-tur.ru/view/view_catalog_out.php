<?php

function init_katalog($start,$dbh){
	$html_out='';
	$result=$dbh->query('SELECT * FROM ve_pages WHERE pid="'.$start.'" AND type="catalog" AND status="1" ORDER BY sort');
	foreach($result as $res){
		$html_out .='
			<div class="wrapper-box module_menu">
				<div class="border-top">
					<div class="border-bottom">
						<div class="corner-top-left">
							<div class="corner-top-right">
								<div class="corner-bottom-left">
									<div class="corner-bottom-right">
										<div class="box-title">
											<div class="border1-top">
												<div class="corner1-top-left">
													<div class="corner1-top-right clear">
														<h3>'.$res['name'].'</h3>
													</div>
												</div>
											</div>
										</div>
										<div class="box-content">
											<div class="clear">'
												.init_catalog_reg($res['cid'],$dbh).'
                      </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
      </div>
      ';
	}
	return $html_out;
}

function init_catalog_reg($start,$dbh){
    $result = $dbh->query("SELECT * FROM ve_pages WHERE pid=".$start." AND type='region' AND status=1 ORDER BY sort" );
    $html_out = '<ul class="menu">';
    foreach($result as $res){
        $html_out .= "
            <li class='Item'>
                <a href='".HOST_STRING."?id=".$res['id']."'>
                    <span>".$res['name']."</span>
                </a>";					         
    }
    $html_out .= "</ul>";
    return $html_out;
}
