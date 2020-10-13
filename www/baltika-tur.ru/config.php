<?php
//require ("lib/lib.php");
//require ("lib/libgo.php");

define(HOST_STRING,"/");  //путь корня сайта по отношению к хосту. На случай если не охота заморачиваться с настройкой виртуального хоста прописать путь к папке с baltica-tur.ru
define(DB_DSN, "mysql:host=172.21.0.1;port=3306;dbname=baltika_ve");
define(DB_USERNAME, "root");
define(DB_PASSWORD, "gotechnies");
define(DB_OPTIONS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',));


try {
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
} catch (\Throwable $th) {
    echo $th;
    die;
}
