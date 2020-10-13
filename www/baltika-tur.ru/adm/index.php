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
  // TODO: верификацию по токенам и добавление токенов в базу для отслеживание последнего изменения
  $user = ['login' => $login, 'password' => $password];
	if ($login=='admin' && $pass=='admin'){
    $_SESSION['user']=$user;	
    $html_out='
      <!DOCTYPE html>
        <title>Tree</title>
        <meta charset=utf-8">
        <link media="screen, projection" href="css/adm.css" type=text/css rel=stylesheet>
        <script type="text/javascript" src="js/jquery.js"></script>        
        <script type="text/javascript" src="js/jquery.markitup.js"></script>
        <script type="text/javascript" src="js/interface.js"></script>
        <script type="text/javascript" src="js/lib.js"></script>
        <script type="text/javascript" src="js/trees.js"></script>
        <script type="text/javascript" src="js/ajaxfileupload.js"></script>
        <script type="text/javascript">	
          //--- статус отображения удаленных
          var show_status = 0;
          $(function(){
            initMenu();
          });
        </script>
        <body>
          <table border="0"  id="table1" cellpadding="2">
            <tr>
              <td class="tb_menu" width="25%">
                <div id="menu">
                  <dl id="myMenu">
                    <dt class="someClass">Сайты</dt>
                      <dd id="menuSites"></dd>
                    <dt class="someClass">Туры</dt>
                      <dd id="menuOBR"></dd>
                    <dt class="someClass">Статьи</dt>
                      <dd id="menuArticle"></dd>
                    <dt class="someClass">Новости</dt>
                      <dd id="menuNews"></dd>
                    <dt class="someClass">Реклама</dt>
                    <dd id="menumedia"></dd>
                    <dt class="someClass">Банеры</dt>
                    <dd id="menubaner"></dd>	
                  </dl>		
                </div>
              </td>
              <td class="tb_menu" width="35%">
                <div id="tree"></div>
              </td>
              <td class="tb_menu"width="40%">
                <div id="content"></div>
              </td>
            </tr>
          </table>
          <input type="checkbox" onClick="changeShowStatus()">
          - показывать удаленые 
        </body>';
    echo $html_out;
  }
  else {
    session_unset();
    echo 'Вероятно вы неправильно ввели логин или пароль <a href="/adm/">повторите</a> попытку пожалуйста';
  }
}



?>
