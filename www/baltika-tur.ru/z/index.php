<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include('../config.php');

if (!$_POST){
	echo "<br><br><br><br><center><form method='POST' name='avto'>"	;
	echo"Логин: <input type='text' name='login'><br><br>";
	echo"Пароль: <input type='password' name='pass'><br><br>";
	echo"<input type='submit' value='Вход'></form><br><br><br><br>";
  echo"login:admin pass:admin";
} else {
	$login=trim($_POST['login']);
	$pass=trim($_POST['pass']);
  $user = ['login' => $login, 'password' => $password];
  if ($login=='admin' && $pass=='admin'){
    $_SESSION['user']=$user;
    $html_out='
      <!DOCTYPE html>
        <title>Tree</title>
        <meta charset=utf-8">
        <title>$Заявки</title>
        <link media=all href="css/style.css" type=text/css rel=stylesheet>
        <script type="text/javascript"src="js/jquery.js"></script>
        <script type="text/javascript" src="js/tablesorter.js"></script>
        <script type="text/javascript">
          $(function(){
              initGrid();
          });
          function initGrid (){
            $("#list").load("get_zayavki.php",{"id":"id"}, function(){
              $("#turs").tablesorter();	 	
            });
          };
        </script>
      <body>
        Заявки на туры
        <DIV id=list style="width:100%"></div>
      </body>
    ';
    echo $html_out;
	} else {
		session_unset();
    echo 'Вероятно вы неправильно ввели логин или пароль <a href="/z/">повторите</a> попытку пожалуйста';
  }
}


?>
