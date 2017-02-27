<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="Arzone, auto, Tajikistan , biseness, " />
 <meta name="description" content="Arzone is a web virtual auto market" />
 <meta name="author" content="Muhamedov Daler" />
 <meta name="robots" content="all" />
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style_view.css">
 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.vec.timerGallery_ts.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
 
<script type="text/javascript">
$(document).ready (function(){
	$('#slide1').timerGallery({idPre: 'img' , interval : '7000' });	
	$('#slide2').timerGallery({idPre: 'img_' , interval : '5000'});	
	$("a[class='cboxElement']").colorbox();
});

</script>


<title>Обзор авто</title>

</head>

<body>
<?php
require_once 'logsql.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");
if    (isset($_GET['id'])) {$id =$_GET['id']; }

// izvlekaem obyavleniya

$result = mysql_query("SELECT * FROM advert WHERE id_advert=$id",$db_server);
    if(!$result){
		echo "Возникла ошибка v advert- ".mysql_error()."<br>"; 
  		exit();}
	$myrow = mysql_fetch_array($result);
    if (empty($myrow)) {
    exit ("Нет объявлений.");
    }
//izvlekaem vladeltsa auto
$iduser=$myrow['id_user'];
$result1= mysql_query("SELECT username,e_mail,phone,address,regdate FROM users WHERE id_user=$iduser",$db_server);
if(!$result1){
		echo "Возникла ошибка v user- ".mysql_error()."<br>"; 
  		exit();}
	$myrow1 = mysql_fetch_array($result1);
   
// izvlekaem auto
$idauto=$myrow['id_auto'];
$result2= mysql_query("SELECT auto.type,auto.model,auto.volume,auto.powwer,auto.year,auto.price,auto.run,auto.fuel,auto.transmission,auto.color,auto.broken,auto.control,auto.doors,auto.comfort,auto.comment,auto.VIN,auto.country,category.NameC,brend.NameB,specials.deff,specials.lock_system,specials.au_video,specials.abs,specials.e_glass,specials.multi_control,specials.eps,specials.booster_control,specials.gear,specials.srs,specials.luke,specials.auto_pilot,specials.computer,specials.lift_system FROM auto inner join category on auto.id_category=category.id_category inner join brend on auto.id_brend = brend.id_brend  inner join specials on auto.id_specials = specials.id_specials WHERE id_auto=$idauto",$db_server);
if(!$result2){
		echo "Возникла ошибка v auto - ".mysql_error()."<br>"; 
  		exit();}
	$myrow2 = mysql_fetch_array($result2);
	
  
//izvlekaem photo auto
$result3= mysql_query("SELECT puth_orig,puth_max,puth_min FROM photo WHERE id_auto=$idauto",$db_server);
if(!$result3){
		echo "Возникла ошибка v photo- ".mysql_error()."<br>"; 
  		exit();}
	$rowCount= mysql_num_rows($result3);
	$columnCount 	= mysql_num_fields($result3);
	

	
	for($i=0; $i < $rowCount; $i++)   
	{  
      $myrows = mysql_fetch_array($result3);
	  for ($j=0; $j<$columnCount; $j++)
	{
		$mas[$i][$j]=$myrows[$j];
	}
	}  
	
if(isset($_POST['messmail']))
{
	$messmail= trim($_POST['messmail']);
	if($messmail == '' ){unset($messmail); }
	$messmail = stripslashes($messmail);
	if    (isset($messmail)) {
				// id razmestitela obyavleniya
				$sentmail=$myrow1['e_mail'];
				mail($sentmail,$messmail, 'From:'.$_SESSION['login']);		
                unset($maserror);   
	}
	else
	{
		$maserror="Вы не написали сообщение";
	}
}

if(isset($_POST['add_to_list']))
{
	$idadvert1=$myrow['id_advert'];
	
	if(!isset($_post['memo']) && $_post['memo']=='')
	{
	$query4="INSERT INTO `my_autos` (`id_myauto`,`username`, `id_advert`, `memo`) VALUES (NULL,'$_SESSION[login]', $idadvert1, 'empty')";
		$result4 = mysql_query($query4) or die(mysql_error());
			if(!$result4)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	}
	else
	{
	$memo=$_post['memo'];
	$query4="INSERT INTO `my_autos` (`id_myauto`,`username`, `id_advert`, `memo`) VALUES (NULL,'$_SESSION[login]', $idadvert1, '$memo')";
		$result4 = mysql_query($query4) or die(mysql_error());
			if(!$result4)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	}
	
	
}
$query22="UPDATE advert SET num_views=num_views+1";
$result22 = mysql_query($query22);
			if(!$result22)
			{
			echo "Update Error: $query <br />". mysql_error()."<br />";
			}	
?>

<div id="status-bar">
 <div id="status-bar-content">
 <p id="welcome">Добро пожаловать!</p>
 <p id="action-bar" >
<?php
 if(!$_SESSION['login']){
 echo ("<a href='login.php' title='Enter'>Вход</a>");
 echo (" <a href='register.php' title='Registration'>Регистрация</a>");
 echo (" <a href='help.php' title='Help'>Справка</a>");
 }
 else
 {
	echo ("$_SESSION[login] <a    href='exit.php'>выход</a><br>");
}



?>
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
 <li id="search" >
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
 
<div id = "view">

<div id ="photo-show">
<div id="wrapper">
<!--start plugin-->
<?php 
echo"<div id='slide1' class='slideshow'>";
	 
   echo '<div class="img_cont">';
  	echo'<ul class="main_images">';
	
    for($i=0; $i <12; $i++){
	if ($rowCount==0)
	{
		echo "<li><a href='img/orig.png' class='cboxElement'> <img src='img/max.png'/></a></li>";
		continue;
	}
	else if ($i<$rowCount)
	{
	echo "<li><a href="."'".$mas[$i][0]."'"."class='cboxElement'><img src=".$mas[$i][1]." /></a></li>";
	}
	else
	{
		echo "<li><a href='img/orig.png' class='cboxElement'> <img src='img/max.png'/></a></li>";
	}
	}

	echo '</ul>';
  	echo '</div>';

 echo <<<END
   <div class="prev_btn"><a href="#" class="prev"><img src="img/previous.png" alt="previous"/></a></div>
  <div class="thumb_holder">
    <ul class="thumbs">
      <li class="section">
        <ul class="sub_section">
END;
		for($i=0; $i <4; $i++){
			if ($rowCount==0)
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
				continue;
			}
        	else if ($i<$rowCount)
			{
				echo "<li><a href='javascript:void(0);'><img src=".$mas[$i][2]." /></a></li>";
        	}
			else
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
			}
		}
  echo <<<END
   </ul>
      </li>
      <li class="section">
        <ul class="sub_section">
END;
		for($i=4; $i <8; $i++){
           if ($rowCount==0)
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
				continue;
			}
        	else if ($i<$rowCount)
			{
				echo "<li><a href='javascript:void(0);'><img src=".$mas[$i][2]." /></a></li>";
        	}
			else
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
			}
		}
		 echo <<<END
		</ul>
		</li>
      <li class="section">
        <ul class="sub_section">
END;
        for($i=8; $i <12; $i++){
		 if ($rowCount==0)
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
				continue;
			}
        	else if ($i<$rowCount)
			{
				echo "<li><a href='javascript:void(0);'><img src=".$mas[$i][2]." /></a></li>";
        	}
			else
			{
				echo "<li><a href='javascript:void(0);'><img src='img/min.png'/></a></li>";
			}
		}
		echo"</ul>";
     echo"</li>";
    echo"</ul>";
 
  echo"</div>";
      echo"<div class='next_btn'><a href='#' class='next'><img src='img/nexts.png' alt='next'/></a></div>";
   
echo"</div>";
 ?> 


</div><!--end wrapper-->
</div> <!-- /div photo-show -->

<div id = "info-main">
<font color="#0033FF">Главные сведения</font>
<div id="border-line"></div>
<table border="1" width="380" height="350">
<?php
echo <<<END
<tr><td width="190">Марка:</td><td>$myrow2[NameB]</td></tr>
<tr><td width="190">Модель:</td><td>$myrow2[model]</td></tr>
<tr><td width="190">Тип Кузова:</td><td>$myrow2[type]</td></tr>
<tr><td width="190">Объём двигателя: </td><td>$myrow2[volume]</td></tr>
<tr><td width="190">Год:</td><td>$myrow2[year]</td></tr>
<tr><td width="190">Топливо:</td><td>$myrow2[fuel]</td></tr>
<tr><td width="190">Цена , дол:</td><td>$myrow2[price]</td></tr>
<tr><td width="190">Пробег , км:</td><td>$myrow2[run]</td></tr>
<tr><td width="190">Коробка скоростей:</td><td>$myrow2[transmission]</td></tr>
<tr><td width="190">Битая:</td><td>$myrow2[broken]</td></tr>
<tr><td width="190">Руль:</td><td>$myrow2[control]</td></tr>
<tr><td width="190">Цвет:</td><td>$myrow2[color]</td></tr>
<tr><td width="190">Количество дверей:</td><td>$myrow2[doors]</td></tr>
<tr><td width="190">Комфорт:</td><td>$myrow2[comfort]</td></tr>
<tr><td width="190">Vin:</td><td>$myrow2[VIN]</td></tr>
<tr><td width="190">Мощность, ЛШ:</td><td>$myrow2[powwer]</td></tr>
<tr><td width="190">Местонахождение т.с.:</td><td>$myrow2[country]</td></tr>
END;
?>
</table>
<div id="border-line"></div>
</div> <!--  div info-main -->

<div id="contacts">
<font color="#0033FF">Контакты</font>
<div id="border-line"></div>
<table border="1" width="380" height="100">
<?php
echo <<<END
<tr><td width="190">Контактное лицо:</td><td>$myrow1[username]</td></tr>
<tr><td width="190">E-Mail:</td><td>$myrow1[e_mail]</td></tr>
<tr><td width="190">Телефон:</td><td>$myrow1[phone]</td></tr>
<tr><td width="190">Адрес: </td><td>$myrow1[address]</td></tr>
<tr><td width="190">Дата регистрации:</td><td>$myrow1[regdate]</td></tr>
END;
?>
</table>
<form action="view.php" method="post">
<fieldset style="border: 1px solid ; padding: 10px; width: 380px;">
<legend style=" font-size:16px ; color:#00C;"> Сообщение: </legend>
<textarea name="messmail" class="textbox" cols="44" rows="8" ></textarea>
<div id ="button" >
<?php
if(!$_SESSION['login'])
{
echo"<input type='submit' name='send' value='Отправить'  class='button' disabled='disabled' />"; 
}
else{
echo"<input type='submit' name='send' value='Отправить'  class='button'  enebled='enebled'/>"; 
}
echo "</br>";
if($maserror)
{
	echo($maserror);
}
?>
</div>

</fieldset>
</form>
<div id="border-line"></div>

</div> <!-- div contacts -->

<div id = "info-specials">
<font color="#0033FF">Особенности</font>
<div id="border-line"></div>
<table border="1" width="380"  >
<?php
for($i=19; $i <33; $i++){
if($myrow2[$i]!='No'){
echo '<tr><td width="280" height="20">'.$myrow2[$i].'</td></tr>';}
}
echo'<tr><td width="380" height="20">Конментарии:</td></tr>';
echo'<tr><td width="380" >'.'"'.$myrow2[comment].'"'.'</td></tr>';
?>
</table>
<div id="border-line"></div>
</div> <!-- div info-specials -->
<div id="adding">
<div id="border-line"></div>
<h5>Добавьте  это объявление в свой список, и вы сможете следить за изменениями в объявлении из раздела "Мой салон".</h5>

<form action="view.php" method="post">

<?php
if(!$_SESSION['login'])
{
echo "Напишите заметку";
echo"<textarea name='memo' class='textbox' cols='44' rows='4' ></textarea>";
echo"<input type='submit' name='add_to_list' value='Добавить в список'  class='button' disabled='disabled' />"; 
}
else{
echo "Напишите заметку";
echo"<textarea name='memo' class='textbox' cols='44' rows='4' ></textarea>";
echo"<input type='submit' name='add_to_list' value='Добавить в список'  class='button' enebled='enebled' />"; 
}
echo "</br>";

?>
</form>
<div id="border-line"></div>
</div>
</div> <!-- div view -->


 </div> <!-- div content -->
 
 <div id="footer">
 <div id="footer-image"></div>
 <p id="footer-text"> 
 Copyright © 2012 Muhamedov D.N.<br /> All Rights Reserved
 </p>
 </div>
</body>
</html>


