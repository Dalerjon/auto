<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="Arzone, auto, Tajikistan , biseness, " />
 <meta name="description" content="Arzone is a  virtual auto market" />
 <meta name="author" content="Muhamedov Daler" />
 <meta name="robots" content="all" />
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style.css">
 
 <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
 <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
 <script type="text/javascript" src="js/cycle.js"></script>
 <script type="text/javascript" src="js/slideshow.js"></script>
 <script type="application/javascript" src="js/selectwork.js"></script>
 
<title>Arzone</title>

<script type="text/javascript">
$(document).ready(function(){

  // выбор автомобиля
  function adjustAuto(){
  	var categoryValue = $('#category').val();
  	var tmpSelect = $('#brend');
  	if(categoryValue.length == 0) {
  		tmpSelect.attr('disabled','disabled');
  		tmpSelect.clearSelect();
  		adjustModel();
  	} else {
  		$.getJSON('cascadeSelectAuto.php',{category:categoryValue},function(data) { tmpSelect.fillSelect(data).attr('disabled',''); adjustModel(); });
  		
  	}
  };
  // выбор модели
  function adjustModel(){
  	var categoryValue = $('#category').val();
  	var brendValue = $('#brend').val();
  	var tmpSelect = $('#model');
  	if(categoryValue.length == 0||brendValue.length == 0) {
  		tmpSelect.attr('disabled','disabled');
  		tmpSelect.clearSelect();
  	} else {
  		$.getJSON('cascadeSelectModel.php',{category:categoryValue,brend:brendValue},function(data) { tmpSelect.fillSelect(data).attr('disabled',''); });
  	}
  };
	
  $('#category').change(function(){
  	adjustAuto();
  }).change();
  $('#brend').change(adjustModel);
  $('#model').change(function(){
  	if($(this).val().length != 0) {  }
  });

});
</script>

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
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");
if    (!empty($_SESSION['login']) and !empty($_SESSION['password']))
            {
            //если существует логин и пароль в сессиях, то проверяем 

            $login    = $_SESSION['login'];
            $password    = $_SESSION['password'];
			//print_r($_SESSION);
			
			}
			
?>

</head>
<body>
<?php
$query="SELECT SQL_CALC_FOUND_ROWS auto.id_auto,auto.model,auto.year,auto.price,auto.run,auto.country,auto.fuel,category.NameC,brend.NameB FROM auto inner join category on auto.id_category=category.id_category inner join brend on auto.id_brend = brend.id_brend  inner join specials on auto.id_specials = specials.id_specials";

		$result = mysql_query($query,$db_server) ;
			if(!$result)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	$rowCount= mysql_num_rows($result);
		for($i=0;$i<$rowCount;$i++)
		{
			$myrow[$i] = mysql_fetch_array($result);
			$idauto=$myrow[$i]['id_auto'];
			$idauto1[$i]=$idauto;
			$query1="SELECT puth_max,puth_min FROM photo WHERE id_auto=$idauto";
			$result1= mysql_query($query1,$db_server);
			if(!$result1)
			{
				echo "Возникла ошибка v photo- ".mysql_error()."<br>"; 
  				exit();
			}
			$myrows[$i] = mysql_fetch_array($result1);		
		}
		
		$GLOBALS['count']=$rowCount;	
		
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
 <li id="search" class="current">
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
 
<div id = "search">
<div id ="search-alt">
<form action="search.php" method="GET" >
<div id="categorys">
<label><h5> Категория</h5></label>
<select name="category" id="category" class="big" >
<option value="">Выбрать категорию</option>
<option value="1">Легковые</option>
<option value="2">Мотоциклы, водный транспорт, одежда</option>
<option value="3">Тяжёлый транспорт</option>
<option value="4">Автобусы, микроавтобусы, туристические домики</option>
<option value="5">Сельскохозяйственная и лесохозяйственная техника, манипуляторы</option>
</select>
</div>
<div id="brends">
<h5> Марка</h5>
<select name= "brend" id="brend" size="1" class="midle" disabled="disabled"></select>
</div>
<div id="models">
<h5> Модель</h5>
<select name= "model"  id="model" size="1"  class="midle" disabled="disabled"> </select>
</div>
<div id="year-start">
<h5> Год от</h5>
<select name= "year-start" size="1"  class="tiny" >
<option value="2012" >2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950" selected="selected">1950</option></select>
</div>
<div id="year-stop">
<h5> Год до</h5>
<select name= "year-stop" size="1"  class="tiny">
<option value="2012" selected="selected">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option>
</select>
</div>
<div id="price-start">
<h5> Цена от</h5>
<select name= "price-start" size="1"  class="tiny">
<option value="0">0</option><option value="1000">1000</option><option value="5000">5000</option><option value="10000">10000</option><option value="25000">25000</option>
</select>
</div>
<div id="price-stop">
<h5> Цена до</h5>
<select name= "price-stop" size="1" class="tiny" >
<option value="1000">1000</option><option value="5000">5000</option><option value="10000">10000</option><option value="25000">25000</option><option value="50000">50000</option><option value="100000">100000</option><option value="200000">200000</option>
</select>
</div>
<div id="fuel">
<h5> Топливо</h5>
<select name= "fuel" size="1"  class="midle">
<option value="Дизель" selected="selected">Дизель</option><option value="Электричество">Электричество</option><option value="Газ">Газ</option><option value="Бензин">Бензин</option><option value="Бензин/Электричество">Бензин / Электричество</option><option value="Бензин/Газ">Бензин / Газ</option><option value="Прочее">Прочее</option>
</select></div>
<div id="run">
<h5> Пробег, км</h5>
<select name= "run" size="1"  class="midle" >
<option value="1000">до 1000</option><option value="2500">до 2500</option><option value="5000">до 5000</option><option value="10000">до 10000</option><option value="25000">до 25000</option><option value="50000">до 50000</option><option value="100000">до 100000</option><option value="100001">более 100000</option>
</select>
</div>
<div id ="button" class="img">
<input type="submit" name="show" value="Показать"  class="button" /> 
</div>

</form>
<div id="large-search">
<img src="img/poisk-znachok.png"  class="search-icon"/> 
<a href "#rashiriniy-poisk" class= "rashireniy"> Расширенный поиск </a>
</div>


</div>
 

<div id ="slideshow">
<div id ="slides">
<a href "#raklam.site1" title = "arzone rec1"  class= "thumb default-slide">
<img src="img/rec1.png"  alt="Arzone ваш навигатор по дорогам  авто-бизнеса" class="slideshow-image"/> </a>
<a href "#raklam.site2" title = "arzone rec2"  class= "thumb">
<img src="img/rec2.png"  alt="Arzone правильная дорога к покупке авто" class="slideshow-image"/> </a>
<a href "#raklam.site2" title = "arzone rec2"  class= "thumb">
<img src="img/rec3.png"  alt="Arzone оправдывает своё название" class="slideshow-image"/> </a>
</div>
</div>


 
</div> <!-- div search -->
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
<!--  tut eksp

-->


<div id="preview">
<div id="preview-promo">
<?php

		$i=$GLOBALS['count']-1;
		$idauto=$idauto1[$i];	
		$result2= mysql_query("SELECT id_advert FROM advert WHERE id_auto=$idauto",$db_server);
		if(!$result2){
			echo "Возникла ошибка v user- ".mysql_error()."<br>"; 
  			exit();}
		$myrow2 = mysql_fetch_array($result2);
		$idadvert=$myrow2['id_advert'];
		$temp=$myrows[$i]['puth_max'];
 		$brends=$myrow[$i]['NameB'];
		$models=$myrow[$i]['model'];
		$prices=$myrow[$i]['price'];
		if ($temp)
			{
				echo "<table><tr width='400' higth='300'><td ><a href='view.php?id=".$idadvert."'"."><img src=".$temp." /></a></td></tr><tr hight='20' width='400'><td ><a href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr></table>";
								
        	}
			else
			{	
				echo "<table><tr width='400' higth='300'><td ><a href='view.php?id=".$idadvert."'"."><img src='img/max.png'/></a></td></tr><tr hight='20' width='400'><td ><a href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr></table>";
			}
?>

</div>

<div id="preview-avto">
 <?php
	$j=$GLOBALS['count']-2;
	$k=$GLOBALS['count']-5;
	for($i=$j;$i>$k;$i--)
	{
		$idauto=$idauto1[$i];	
		$result2= mysql_query("SELECT id_advert FROM advert WHERE id_auto=$idauto",$db_server);
		if(!$result2){
			echo "Возникла ошибка v user- ".mysql_error()."<br>"; 
  			exit();}
		$myrow2 = mysql_fetch_array($result2);
		$idadvert=$myrow2['id_advert'];
		$temp=$myrows[$i]['puth_min'];
 		$brends=$myrow[$i]['NameB'];
		$models=$myrow[$i]['model'];
		$prices=$myrow[$i]['price'];
		$years=$myrow[$i]['year'];
		$runs=$myrow[$i]['run'];
		$fuels=$myrow[$i]['fuel'];
		$countrys=$myrow[$i]['country'];
		echo"<div id='border-line'></div>";
		if ($temp)
			{
				echo'<div id="element">';
				echo "<table><tr width='400' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src=".$temp." /></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
				
        	}
			else
			{	
				echo'<div id="element">';
				echo "<table><tr width='400' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src='img/min.png'/></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
				
			}
	
		echo"<div id='border-line'></div>";
	}
?>
</div>
</div><!-- div preview -->
 </div> <!-- div content -->
 
 <div id="footer">
 <div id="footer-image"></div>
 <p id="footer-text"> 
 Copyright &copy; 2012 Muhamedov D.N.<br /> All Rights Reserved
 </p>
 </div>
</body>
</html>
