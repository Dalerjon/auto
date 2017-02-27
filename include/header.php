<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php
//echo '<meta name=\"keywords\" content=\" '$metakey " />
// <meta name="description" content="$metades" />
?>
 <meta name="author" content="Muhamedov Daler" />
 <meta name="robots" content="all" />
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="../css/style.css">
 
 <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.3.2.js"></script> 
<script type="text/javascript" src="../js/jquery.jcarousel.min.js"></script>

 <script type="text/javascript" src="../js/cycle.js"></script>
  <script type="text/javascript" src="../js/slideshow.js"></script>
  <script type="application/javascript" src="../js/selectwork.js"></script>
 
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
require_once '../logsql.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());

?>

</head>
<body>

<div id="status-bar">
 <div id="status-bar-content">
 <p id="welcome">Добро пожаловать</p>
 <p id="action-bar" >
 <a href="#Enter" title="Enter">Вход</a>
 <a href="#Registration" title="Registration">Регистрация</a>
 <a href="#Help" title="Help">Справка</a>
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
 <a href="#info" title="Информация">Информация</a>
 </li>
 <li id="mysalon">
 <a href="#mysalon" title="Мой салон">Мой салон</a>
 </li>
 <li id="contact">
 <a href="#contact" title="Контакты">Контакты</a>
 </li>
 </ul>
 