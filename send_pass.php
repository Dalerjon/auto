<?php
  require_once 'logsql.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");       
 if    (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') {    unset($email);} } //заносим введенный пользователем e-mail, если он    пустой, то уничтожаем переменную
 if    (isset($email)) {//если существуют необходимые переменные  
                     
                    
                    $result = mysql_query("SELECT * FROM users WHERE e_mail='$email' and activated = 1",$db_server);//такой ли у пользователя е-мейл 
                     if(!$result)
					 {echo " Ploho";}
					 $myrow    = mysql_fetch_array($result);
					 
                     if    (empty($myrow['id_user']) or $myrow['id_user']=='') {
                              //если активированного пользователя с таким логином и е-mail    адресом нет
                              exit ("Пользователя с    таким e-mail адресом не обнаружено ни в одной базе  <a    href='index.php'>Главная страница</a>");
                              }
                     $message = "Здравствуйте,    ".$myrow['username']."! Ваш пароль:\n".$myrow['pass'];//текст сообщения
                     mail($email,    "Восстановление пароля", $message, "Content-type:text/plane;    Charset=windows-1251\r\n");//отправляем сообщение 
                     
                     echo    "<html><head><meta http-equiv='Refresh' content='5;    URL=index.php'></head><body>На Ваш e-mail отправлено письмо с паролем. Вы    будете перемещены через 5 сек. Если не хотите ждать, то <a    href='index.php'>нажмите сюда.</a></body></html>";//перенаправляем    пользователя
                     }
 else    {//если    данные еще не введены
            echo '

            <html>
            <head>
            <title>Забыли пароль?</title>
            </head>
            <body>
            <h2>Забыли пароль?</h2>
            <form action="#"    method="post">
            Мы отправим ваш пароль на E-mail </br>
            Введите Ваш    E-mail: <br><input type="text"    name="email"><br><br>
            <input type="submit"    name="submit" value="Отправить">
            </form>
            </body>
            </html>';

            }
            ?>