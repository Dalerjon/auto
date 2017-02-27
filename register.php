<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="Arzone, auto, Tajikistan , biseness, " />
 <meta name="description" content="Arzone is a web virtual auto market" />
 <meta name="author" content="Muhamedov Daler" />
 <meta name="robots" content="all" />
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style.css">
 
 <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.js"></script> 
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>



 
<title>Регисирация</title>


<script type="text/javascript">
function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};


jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        auto: 1,
		scroll:1,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});

</script>
<?php
require_once 'logsql.php';
require_once 'police.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");
 if(isset($_POST['name']) &&
isset($_POST['email']) &&
isset($_POST['phone']) &&
isset($_POST['address']) &&
isset($_POST['password']))
{
	$name= trim($_POST['name']);
    $email= trim($_POST['email']);
	$phone= ($_POST['phone']);
	$address= ($_POST['address']);
	$password= ($_POST['password']);
	if($name == '' && $email == '' && $phone == '' &&  $address == '' && $password == '')
	{
	unset($name);unset($email);unset($phone);unset($address);unset($password);
	}
	if (empty($name))
	{
	 $message1="не указанно контактное лицо";
	}
	if (empty($email))
	{
	 $message1=$message1."</br>не указанн e-mail";
	}
	if (empty($phone))
	{
	 $message1=$message1."</br>не указанн телефон";
	}
	if (empty($address))
	{
	 $message1=$message1."</br>не указанн адрес";
	}
	if (empty($password))
	{
	 $message1=$message1."</br>не указанн пароль";
	}
	if    (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) //проверка    е-mail адреса регулярными выражениями на корректность
            {$message2="Пожалуйста заполните все поля корректно";}
	if(!($message1 || $message2))
	{
	$name = stripslashes($name);
    $name = htmlspecialchars($name);
	$email = stripslashes($email);
    $email= htmlspecialchars($email);
	$phone = stripslashes($phone);
    $phone = htmlspecialchars($phone);
	$address = stripslashes($address);
    $address = htmlspecialchars($address);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$mdpass = md5($password);//шифруем пароль  
	
	$result0 = mysql_query("SELECT id_user FROM users WHERE e_mail='$email'",$db_server);
    if(!$result0){
		echo "Возникла ошибка - ".mysql_error()."<br>"; 
  		echo $sql; 
  		exit();}
	$myrow = mysql_fetch_array($result0);
    if (!empty($myrow['id_user'])) {
    $message3= "Извините, введённый вами email уже зарегистрирован.</br> Введите другой email.";
    }
	if(!$message3)
	{
	$query="INSERT INTO `users` (`id_user`, `username`, `e_mail`, `phone`, `address`, `pass`, `activated`, `md5`, `regdate`) VALUES (NULL, '$name', '$email', '$phone', '$address', '$password' , 0, '$mdpass',NOW())";
		$result = mysql_query($query) or die(mysql_error());
			if(!$result)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	if ($result=='TRUE')
    {
  	$result3 = mysql_query ("SELECT id_user FROM users WHERE e_mail='$email'",$db_server);
   		if(!$result3){
		echo "Возникла ошибка - ".mysql_error()."<br>"; 
  		echo $sql; 
  		exit();}	
  
          $myrow3    = mysql_fetch_array($result3);
          $activation    = md5($myrow3['id_user']).md5($email);//код активации аккаунта. Зашифруем    через функцию md5 идентификатор и логин. Такое сочетание пользователь вряд ли    сможет подобрать вручную через адресную строку.
 $subject    = "Подтверждение регистрации";//тема сообщения
            $message    = "Здравствуйте! Спасибо за регистрацию на arzone.tj\nВаш логин:    ".$name."\n
            Перейдите    по ссылке, чтобы активировать ваш    аккаунт:\nhttp://localhost/arzon.com/activation.php?email=".$email."&code=".$activation."\nС    уважением,\n
            Администрация    arzone.tj";//содержание сообщение
            mail($email,    $subject, $message, "Content-type:text/plane;    Charset=windows-1251\r\n");//отправляем сообщение
                     
            echo    "Вам на E-mail выслано письмо с cсылкой, для подтверждения регистрации.    Внимание! Ссылка действительна 1 час. <a href='index.php'>Главная    страница</a>"; //говорим о    отправленном письме пользователю
    }
	else {
    echo "Ошибка! Вы не зарегистрированы.";
	}
	}
	}
            
}
?>

</head>
<body>

<div id="status-bar">
 <div id="status-bar-content">
 <p id="welcome">Добро пожаловать!</p>
 <p id="action-bar" >
 <a href="login.php" title="Enter">Вход</a>
 <a href="register.php" title="Registration"><font color="#FF0000">Регистрация</font></a>
 <a href="help.html" title="Help">Справка</a>
 </p>
 </div>
 </div>
 
 <div id="header">
 <div  id="header-content">
 <div id="logo">
 <a href="http://localhost/arzon.com/" title="Home Page"><img src="img/logo.png"   alt="Arzone"/></a>
  </div>
 <h3>Крупнейшая в Таджикистане торговая онлайн-площадка</br> для поиска, покупки и продажи подержанных и новых транспортных средств</h3>
 </div>
 </div>
 
 
 
 <div id="content">
 
 <ul id="tabs">
 <li id="search">
 <a href="index.php" title="Поиск">Поиск</a>
 </li>
 <li id="offer" >
 <a href="add.php" title="Предложение">Предложение</a>
 </li>
 <li id="info">
 <a href="info.php" title="Информация">Информация</a>
 </li>
 <li id="mysalon">
 <a href="mysalon.php" title="Мой салон">Мой салон</a>
 </li>
 <li id="contact">
 <a href="contact.php" title="Контакты">Контакты</a>
 </li>
 </ul>
 
<div id = "register">
<?
if($message1)
{
	echo "<font color='red'>".$message1."</font>";
	unset($message1);
	echo "</br>";
}
else if($message2)
{
	echo "<font color='red'>".$message2."</font>";
	unset($message2);
	echo "</br>";
}
?>
<span>Регистрация нового пользователя </span>
<div id="border-line"></div>
<H5>Все поля обязательны для заполнения!</H5>
</br>
<form action="register.php" method="post" >
<p>
<label> Контактное лицо </label></br>
<input type="text" name="name" class="text" />
</p>
<p>
<label> E-Mail </label></br>
<input type="text" name="email" class="text" />
</p>
<p>
<label> Телефон </label></br>
<input type="text" name="phone" class="text" />
</p>
<p>
<label> Адрес </label><br>
<input type="text" name="address" class="text" />
</p>
<p>
<label> Пароль </label><br>
<input type="password" name="password" class="text" />
</p>
<div id="regbutton">
<input type="submit" value="Зарегистрироваться"/>
</div>
</form>
<?php
if($message3)
{
	echo "<font color='red'>".$message3."</font>";
	unset($message3);
	echo "</br>";
}
?>

</div> <!-- div register -->
<div id = "list">
<ul id="mycarousel" class="jcarousel-skin-tango">
		<li><a href "#icon-search1" title = "icon-search1">
		<img src="img/1.jpg"  alt="icon1" width="100" height="100"/> </a></li>
		<li><a href "#icon-search2" title = "icon-search2">
		<img src="img/2.jpg"  alt="icon3" width="100" height="100"/> </a></li>
        <li><a href "#icon-search3" title = "icon-search3"  >
		<img src="img/3.jpg"  alt="icon3" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search4" title = "icon-search4" >
		<img src="img/4.jpg"  alt="icon4" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search5" title = "icon-search5"  >
		<img src="img/5.jpg"  alt="icon5" width="100" height="100"/> </a></li>
        <li><a href "#icon-search6" title = "icon-search6"  >
		<img src="img/6.jpg"  alt="icon6" width="100" height="100"/> </a></li>
        <li><a href "#icon-search7" title = "icon-search7"  >
		<img src="img/7.jpg"  alt="icon7" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search8" title = "icon-search8"  >
		<img src="img/8.jpg"  alt="icon8" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search9" title = "icon-search9"  >
		<img src="img/9.jpg"  alt="icon9" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search10" title = "icon-search10"  >
		<img src="img/10.jpg"  alt="icon10" width="100" height="100"/> </a></li>
        <li> <a href "#icon-search11" title = "icon-search11"  >
		<img src="img/11.jpg"  alt="icon11" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search12" title = "icon-search12" >
		<img src="img/12.jpg"  alt="icon12" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search13" title = "icon-search13"  >
		<img src="img/13.jpg"  alt="icon13" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search14" title = "icon-search14"  >
		<img src="img/14.jpg"  alt="icon14" class="icon-image"/> </a></li>
        <li ><a href "#icon-search15" title = "icon-search15" >
		<img src="img/15.jpg"  alt="icon15" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search16" title = "icon-search16"  >
		<img src="img/16.jpg"  alt="icon16" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search17" title = "icon-search17"  >
		<img src="img/17.jpg"  alt="icon17" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search18" title = "icon-search18"  >
		<img src="img/18.jpg"  alt="icon18" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search19" title = "icon-search19"  >
		<img src="img/19.jpg"  alt="icon19" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search20" title = "icon-search20" >
		<img src="img/20.jpg"  alt="icon20" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search21" title = "icon-search21"  >
		<img src="img/21.jpg"  alt="icon21" width="100" height="100"/> </a></li>
        <li><a href "#icon-search22" title = "icon-search22"  >
		<img src="img/22.jpg"  alt="icon22" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search23" title = "icon-search23"  >
		<img src="img/23.jpg"  alt="icon23" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search24" title = "icon-search24"  >
		<img src="img/24.jpg"  alt="icon24" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search25" title = "icon-search25"  >
		<img src="img/25.jpg"  alt="icon25" width="100" height="100"/> </a></li>
        <li><a href "#icon-search26" title = "icon-search26"  >
		<img src="img/26.jpg"  alt="icon26" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search27" title = "icon-search27" >
		<img src="img/27.jpg"  alt="icon27" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search28" title = "icon-search28"  >
		<img src="img/28.jpg"  alt="icon28" width="100" height="100"/> </a></li>
        <li><a href "#icon-search29" title = "icon-search29"  >
		<img src="img/29.jpg"  alt="icon29" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search30" title = "icon-search30"  >
		<img src="img/30.jpg"  alt="icon30" width="100" height="100"/> </a></li>
        <li ><a href "#icon-search31" title = "icon-search31"  >
		<img src="img/31.jpg"  alt="icon31" width="100" height="100"/> </a></li>
        <li><a href "#icon-search32" title = "icon-search32"  >
		<img src="img/32.jpg"  alt="icon32" width="100" height="100"/> </a></li>
</ul>
</div> <!-- div list-->



 </div> <!-- div content -->
 
 <div id="footer">
 <div id="footer-image"></div>
 <p id="footer-text"> 
 Copyright &copy; 2012 Muhamedov D.N.<br /> All Rights Reserved
 </p>
 </div>
</body>
</html>
