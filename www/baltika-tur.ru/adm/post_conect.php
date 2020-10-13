<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$dbh->query('UPDATE ve_pages SET cid="'.$_REQUEST['cid'].'" WHERE id="'.$_REQUEST['id'].'"');


?>
