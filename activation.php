<?php
          
require_once 'logsql.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");
       mysql_query    ("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(regdate) > 3600");//удаляем пользователей из базы
 if    (isset($_GET['code'])) {$code =$_GET['code']; } //код подтверждения 
            else 
            {    exit("Вы    зашли на страницу без кода подтверждения!");} //если не указали code,    то выдаем ошибку
 if (isset($_GET['email'])) {$email=$_GET['email'];    } //логин,который    нужно активировать
            else 
            {    exit("Вы    зашил на страницу без логина!");} //если не указали логин, то выдаем ошибку
 $result = mysql_query("SELECT    id_user    FROM    users WHERE e_mail='$email'",$db_server); //извлекаем    идентификатор пользователя с данным логином
            if(!$result)
			{echo "Возникла ошибка - ".mysql_error()."<br>"; 
  		echo $sql; 
  		exit();
			}
			$myrow    = mysql_fetch_array($result); 
 $activation    = md5($myrow['id_user']).md5($email);//создаем    такой же код подтверждения
 if ($activation == $code) {//сравниваем полученный из url и сгенерированный код 
                    $result1= mysql_query("UPDATE    users SET activated='1' WHERE e_mail='$email'",$db_server);//если равны, то активируем пользователя
					 if(!$result1)
					{echo "Возникла ошибка - ".mysql_error()."<br>"; 
  					echo $sql; 
  					exit();
					}
                     echo "Ваш Е-мейл подтвержден! Теперь вы можете    зайти на сайт под своим логином! <a href='index.php'>Главная    страница</a>";
                     }
            else {echo "Ошибка! Ваш Е-мейл не    подтвержден! <a    href='index.php'>Главная    страница</a>";
            //если    же полученный из url и    сгенерированный код не равны, то выдаем ошибку
            }
            ?>