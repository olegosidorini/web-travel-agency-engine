<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$dbh->query('UPDATE ve_descriptions SET pid="'.$_REQUEST['pid'].'" WHERE id="'.$_REQUEST['id'].'"');


?>
