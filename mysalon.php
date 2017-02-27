<?
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
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style_mysalon.css">
 
 <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.js"></script> 
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>

 <script type="text/javascript" src="js/cycle.js"></script>
  <script type="text/javascript" src="js/slideshow.js"></script>
  <script type="application/javascript" src="js/selectwork.js"></script>
 
<title>Поиск</title>

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
$iduser=$_SESSION[id];
if(isset($_POST['my_querys']))
{
	$query="SELECT querys FROM my_query WHERE id_user=$iduser";
	$result = mysql_query($query,$db_server) ;
			if(!$result)
			{
			echo "SELECT: $query <br />". mysql_error()."<br />";
			}	
	 $rowCount= mysql_num_rows($result);
	 if($rowCount>10){
	 		$rowCount=$rowCount-10;
	 		$SQL="delete from my_query where id_query<=".$rowCount;	
	  		mysql_query($SQL);
	  		$query1="SELECT querys FROM my_query WHERE id_user=$iduser";
			$resul1 = mysql_query($query1,$db_server) ;
			if(!$result1)
			{
				echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
		 	$rowCount= mysql_num_rows($result1);	 
	  		for($i=0;$i<$rowCount;$i++)
			{
				$myrow[$i] = mysql_fetch_array($result);
			
			}
	 
	 	}
	 	else{
	 		for($i=0;$i<$rowCount;$i++)
			{
				$myrow[$i] = mysql_fetch_array($result);
			}
	 	}
		$GLOBALS['flag']=1;
}
if(isset($_POST['my_autos']) or $_GET['page'])
{
	
	$per_page=10;
	if (isset($_GET['page'])) $CUR_PAGE=($_GET['page']); else $CUR_PAGE=1;
	$start=abs(($CUR_PAGE-1)*$per_page);
	$email=$_SESSION['login'];
	$userid=$_SESSION['id'];
	$query="SELECT SQL_CALC_FOUND_ROWS  my_autos.username,my_autos.memo,advert.id_user,advert.status,auto.id_auto,auto.model,auto.year,auto.price,auto.run,auto.country,auto.fuel,category.NameC,brend.NameB FROM my_autos inner join advert on my_autos.id_advert=advert.id_advert inner join auto on advert.id_auto=auto.id_auto   inner join category on auto.id_category=category.id_category inner join brend on auto.id_brend = brend.id_brend ";
	
		
		$query=$query." WHERE (my_autos.username='$email') AND ( advert.id_user=$userid)  ORDER BY auto.price LIMIT $start,$per_page";
			
	$query_row="SELECT FOUND_ROWS()";
		$result = mysql_query($query,$db_server) ;
			if(!$result)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}	
		
		$uri=strtok($_SERVER['REQUEST_URI'],"?")."?";
			if (count($_GET)) {
  				foreach ($_GET as $k => $v) {
    				if ($k != "page") $uri.=urlencode($k)."=".urlencode($v)."&";
  				}
			}
		$rezult_row=mysql_query($query_row,$db_server);
		$rerow=mysql_fetch_array($rezult_row);
		$max_rows=$rerow[0];
		$num_pages=ceil($max_rows/$per_page);
		for($i=1;$i<=$num_pages;$i++) $PAGES[$i]=$uri.'page='.$i;
		
		
		$rowCount= mysql_num_rows($result);
		for($i=0;$i<$rowCount;$i++)
		{
			$myrow[$i] = mysql_fetch_array($result);
			$idauto=$myrow[$i]['id_auto'];
			$idauto1[$i]=$idauto;
			
			$query1="SELECT puth_min FROM photo WHERE id_auto=$idauto";
			$result1= mysql_query($query1,$db_server);
			if(!$result1)
			{
				echo "Возникла ошибка v photo- ".mysql_error()."<br>"; 
  				exit();
			}
			$myrows[$i] = mysql_fetch_array($result1);
		}
		$GLOBALS['count']=$rowCount;
			
	$GLOBALS['flag1']=1;
}
	

if(isset($_POST['my_spys']) || isset($_GET['page']))
{
		
	$per_page=10;
	if (isset($_GET['page'])) $CUR_PAGE=($_GET['page']); else $CUR_PAGE=1;
	$start=abs(($CUR_PAGE-1)*$per_page);
	$email=$_SESSION['login'];
	$userid=$_SESSION['id'];
	$query="SELECT SQL_CALC_FOUND_ROWS  my_autos.username,my_autos.memo,advert.id_user,advert.status,auto.id_auto,auto.model,auto.year,auto.price,auto.run,auto.country,auto.fuel,category.NameC,brend.NameB FROM my_autos inner join advert on my_autos.id_advert=advert.id_advert inner join auto on advert.id_auto=auto.id_auto   inner join category on auto.id_category=category.id_category inner join brend on auto.id_brend = brend.id_brend ";
	
		
		$query=$query." WHERE (my_autos.username='$email') AND ( advert.id_user!=$userid)  ORDER BY auto.price LIMIT $start,$per_page";
			
	$query_row="SELECT FOUND_ROWS()";
		$result = mysql_query($query,$db_server) ;
			if(!$result)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}	
		
		$uri=strtok($_SERVER['REQUEST_URI'],"?")."?";
			if (count($_GET)) {
  				foreach ($_GET as $k => $v) {
    				if ($k != "page") $uri.=urlencode($k)."=".urlencode($v)."&";
  				}
			}
		$rezult_row=mysql_query($query_row,$db_server);
		$rerow=mysql_fetch_array($rezult_row);
		$max_rows=$rerow[0];
		$num_pages=ceil($max_rows/$per_page);
		for($i=1;$i<=$num_pages;$i++) $PAGES[$i]=$uri.'page='.$i;
		
		
		$rowCount= mysql_num_rows($result);
		for($i=0;$i<$rowCount;$i++)
		{
			$myrow[$i] = mysql_fetch_array($result);
			$idauto=$myrow[$i]['id_auto'];
			$idauto1[$i]=$idauto;
			$query1="SELECT puth_min FROM photo WHERE id_auto=$idauto";
			$result1= mysql_query($query1,$db_server);
			if(!$result1)
			{
				echo "Возникла ошибка v photo- ".mysql_error()."<br>"; 
  				exit();
			}
			$myrows[$i] = mysql_fetch_array($result1);
		}
		$GLOBALS['count']=$rowCount;
			

	
	

	$GLOBALS['flag2']=1;
}

if(isset($_POST['change_list']))
{
	$country=$_POST['country'];
	$status=$_POST['status'];
	$query22="UPDATE advert SET status='$status'";
$result22 = mysql_query($query22);
			if(!$result22)
			{
			echo "Update Error: $query <br />". mysql_error()."<br />";
			}	
			$query33="UPDATE auto SET country='$country'";
$result33 = mysql_query($query33);
			if(!$resuly33)
			{
			echo "Update Error: $query <br />". mysql_error()."<br />";
			}	
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
 <li id="mysalon" class="current">
 <a href="mysalon.php" title="Мой салон">Мой салон</a>
 </li>
 <li id="contact">
 <a href="contact.php" title="Контакты">Контакты</a>
 </li>
 </ul>
 
<div id = "salon">
<?php 
if($_SESSION['login'])
{
echo <<<END
<div id="salon-menu">
<form action="mysalon.php" method="post">
<input type='submit' name='my_querys' value='Мои запросы'  class="button"/> 
<div id="border-line"></div>
<input type='submit' name='my_autos' value='Мои объявления' class="button"/>
<div id="border-line"></div> 
<input type='submit' name='my_spys' value='Список слежки'  class="button"/> 
</form>
</div>
<div id="salon-content">
END;
if($GLOBALS['flag']==1)
{
	if(!empty($myrow))
	{
	echo"<table border='1' cellpadding='5' width='300' 
style='border-collapse: collapse; border: 1px solid black;'>";
	for ($i=0;$i<$rowCount;$i++)
	{
		$hrefs=$myrow[$i]['querys'];
		echo"<tr border='1' cellpadding='5' 
style='border-collapse: collapse; border: 1px solid black;'><td align='center'><a href='".$hrefs."'>Запрос&nbsp;".$i."</a></td><tr>";
	}
	echo"</table>";
	$GLOBALS['flag']==0;
	}
	else
	{
		echo"У вас нет запросов!";
	}
}
if($GLOBALS['flag1']==1)
{
	if($GLOBALS[count] != 0 )
	{
		for($i=0;$i<$GLOBALS[count];$i++)
	
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
		$statuss=$myrow[$i]['status'];
		$countrys=$myrow[$i]['country'];
		if ($temp)
			{
				echo'<div id="advele">';
				echo'<div id="element">';
				echo "<table><tr width='500' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src=".$temp." /></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
				echo"<table><form action='mysalon.php' method='post'><tr><td>
				Местонахождение т.с :<select name= 'country' size='1'  >
<option value='Таджикистан' selected='selected'>Таджикистан</option><option value='Латвия'>Латвия</option><option value='Литва'>Литва</option><option value='Польша'>Польша</option><option value='Германия'>Германия</option><option value='Франция'>Франция</option><option value='Эстония'>Эстония</option><option value='Россия'>Россия</option></select>
				</td></tr>
				<tr><td>
				Статус :<select name= 'status' size='1'  >
<option value='Продается' selected='selected'>Продается</option><option value='Внесен залог'>Внесен залог</option><option value='Аренда'>Аренда</option><option value='Продан'>Продан</option></select>
				</td><td>
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Изменить'  name='change_list'>
				</td></tr>
				</form></table>";
				echo"</div>";
        	}
			else
			{	
				echo'<div id="advele">';
				echo'<div id="element">';
				echo "<table><tr width='500' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src='img/min.png'/></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
				echo"<table><form action='mysalon.php' method='post'><tr><td>
				Местонахождение т.с :<select name= 'country' size='1'  >
<option value='Таджикистан' selected='selected'>Таджикистан</option><option value='Латвия'>Латвия</option><option value='Литва'>Литва</option><option value='Польша'>Польша</option><option value='Германия'>Германия</option><option value='Франция'>Франция</option><option value='Эстония'>Эстония</option><option value='Россия'>Россия</option></select>
				</td></tr>
				<tr><td>
				Статус :<select name= 'status' size='1'  >
<option value='Продается' selected='selected'>Продается</option><option value='Внесен залог'>Внесен залог</option><option value='Аренда'>Аренда</option><option value='Продан'>Продан</option></select>
				</td><td>
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Изменить' name='change_list'>
				</td></tr>
				</form></table>";
				echo"</div>";
			}
	
		}
		 echo "<br />";

	 foreach ($PAGES as $i => $link): 

     if ($i == $CUR_PAGE): 

    echo"<b>&nbsp;$i</b>";

     else: 

    echo "<a href=".$link.">&nbsp;$i</a>";

     endif ;

    endforeach;
	}
	
}
if($GLOBALS['flag2']==1)
{
		if($GLOBALS[count] != 0 )
	{
		for($i=0;$i<$GLOBALS[count];$i++)
	
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
		$statuss=$myrow[$i]['status'];
		$countrys=$myrow[$i]['country'];
		if ($temp)
			{
				echo'<div id="element">';
				echo "<table><tr width='500' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src=".$temp." /></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
	     	}
			else
			{	
				echo'<div id="element">';
				echo "<table><tr width='500' higth='60'><td width='80' higth='60'><a href='view.php?id=".$idadvert."'"."><img src='img/min.png'/></a></td><td style='vertical-align:top;' width='80' higth='60'><table width='400' higth='60'><tr hight='30'><td ><a class='viewer' href='view.php?id=".$idadvert."'".">"."&nbsp;&nbsp;".$brends."&nbsp;&nbsp;".$models."</a></td></tr><tr hight='20'><td>&nbsp;&nbsp;Цена:&nbsp;&nbsp;&nbsp;&nbsp;".$prices."$"."</td></tr><tr hight='20'><td>&nbsp;&nbsp;".$countrys."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$fuels."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$runs."km&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$years."&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;".$statuss."&nbsp;&nbsp;"."</td></tr></table></td></tr></table>";
				echo"</div>";
			}
	
		}
		 echo "<br />";

	 foreach ($PAGES as $i => $link): 

     if ($i == $CUR_PAGE): 

    echo"<b>&nbsp;$i</b>";

     else: 

    echo "<a href=".$link.">&nbsp;$i</a>";

     endif ;

    endforeach;
	}
}
echo "</div>";

}
else
{
	echo "Извините раздел только для зарегистрированных пользователей.</br>";
	echo "Пожалуйста <a href='register.php'>Зарегистрируйтесь</a></br>";
	echo "Или зайдите под своим <a href='login.php'>Логином</a></br>";
}
?>
</div> <!-- div salon -->
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
