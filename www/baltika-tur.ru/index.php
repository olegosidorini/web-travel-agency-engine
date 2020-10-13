<?php
header('Content-Type: text/html; charset=utf-8');
require('./config.php');

$host_string=explode('.',$_SERVER['HTTP_HOST']);
if($host_string[0] == 'www'){ $host_string = array_shift($host_string);}
define(HTTP_HOST,implode('.',$host_string));
$site = $dbh->query("SELECT * FROM ve_pages WHERE type='".HTTP_HOST."' AND status='1'")->fetch(PDO::FETCH_ASSOC);
//определяем стартовый ид
$startID = $site['id']; 
// определяем параметры сайта
$template=$dbh->query('SELECT * FROM ve_template WHERE site_id="'.$startID.'"');
$site_template = array();
foreach($template as $val) 
	$site_template[$val['param']]=$val['value'];
$get_ID= $_GET["id"];
if ($startID != NULL){
	if (!empty($get_ID)){
		$page=$dbh->query("SELECT * FROM ve_pages WHERE id='".$get_ID."'")->fetch(PDO::FETCH_ASSOC);
		$page_tmpl = $site_template["TMPL_".$page['type']];
		include_once('./tmpl/'.$page_tmpl.'.php');	
		init($startID,$get_ID,$dbh);	
	}
	else {
    $page_tmpl=$site_template['TEMPLATE'];
		include_once('./tmpl/'.$page_tmpl.'.php');
		init($startID,$startID,$dbh);
	}
}

?>
