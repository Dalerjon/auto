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
<LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style_add.css">

<script type="text/javascript" src="js/jquery-1.3.2.js"></script> 
<script type="text/javascript" src="js/data.js" charset="utf-8" ></script> 
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="application/javascript" src="js/selectwork.js"></script>

<title>Предложение</title>
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
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response==="success"){
					flag=true
					for(i=1;i<13;i++)
					{
						str="img"+i
						var myTextField = document.getElementById(str);
						if(myTextField.value == "")
						{
   						str2="./uploads/"+file;
						str3="#img"+i;
						$(str3).val(str2);
						break;
						}
						
						
					}
					if(flag==true){
					file2= file.toLowerCase();
					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file2+'" alt="" /><br />'+file2).addClass('success');}
					
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
				
			}
		});
		
	});
</script>


</head>

<body>
<?php
require_once 'logsql.php';
require_once 'police.php';
require_once 'thumb.php';
$db_server = mysql_connect($db_hostname, $db_username,$db_password);
if (!$db_server) die ("Database error :".mysql_error());
mysql_select_db($db_database, $db_server) or die("Cannot open database". mysql_error());
mysql_query("SET NAMES utf8");
if(isset($_POST['category']) &&
isset($_POST['brend']) &&
isset($_POST['model']) &&
isset($_POST['type']) &&
isset($_POST['volume']) &&
isset($_POST['year']) &&
isset($_POST['fuel']) &&
isset($_POST['price']) &&
isset($_POST['run']) &&
isset($_POST['transmission']) &&
isset($_POST['broken']) &&
isset($_POST['control']) &&
isset($_POST['doors']) &&
isset($_POST['comfort']) &&
isset($_POST['powwer']) &&
isset($_POST['country']) &&
isset($_POST['color']))
{
	$category= $_POST['category'];
    $brend= $_POST['brend'];
	$model= $_POST['model'];
	$type= $_POST['type'];
	$volume= mysql_entities_fix_string($_POST['volume']);
	$year= $_POST['year'];
	$fuel= $_POST['fuel'];
	$price= mysql_entities_fix_string($_POST['price']);
    $run= mysql_entities_fix_string($_POST['run']);
	$transmission= $_POST['transmission'];
	$broken= $_POST['broken'];
	$control= $_POST['control'];
	$doors= $_POST['doors'];
	$comfort= $_POST['comfort'];
	$color= $_POST['color'];
	$country= $_POST['country'];
	$powwer=mysql_entities_fix_string( $_POST['powwer']);
	if(isset($_POST['vin']))
	{ 
	$vin= mysql_entities_fix_string($_POST['vin']);
	if ($vin == '')
	$vin = 'NO';
	}
	//$comment= mysql_entities_fix_string($_POST['comment']);
	$comment= $_POST['comment'];
	if($volume=='' )
	{
		$message = "Вы не заполнили поле Объём двигателя";
	}
	if($price=='' )
	{
		$message = $message."</br>Вы не заполнили поле Цена";
	}
	if($run =='')
	{
		$message =$message."</br>Вы не заполнили поле Пробег";
	}
	if($powwer == '')
	{
		$message =$message."</br>Вы не заполнили поле Мощность";
	}
	if    (!preg_match("/[^0-9]/",$volume )) //проверка    е-mail адреса регулярными выражениями на корректность
            {$message2="Пожалуйста заполните все поля корректно";}
	if    (!preg_match("/[^0-9]/",$price )) //проверка    е-mail адреса регулярными выражениями на корректность
            {$message2="Пожалуйста заполните все поля корректно";}
	if    (!preg_match("/[^0-9]/",$run )) //проверка    е-mail адреса регулярными выражениями на корректность
            {$message2="Пожалуйста заполните все поля корректно";}
	if    (!preg_match("/[^0-9]/",$powwer )) //проверка    е-mail адреса регулярными выражениями на корректность
            {$message2="Пожалуйста заполните все поля корректно";}
	if(!$message|| !$message2)
	{
	//обработка checkbox-ов
 $check = array();
for($i=0;$i<14;$i++)
{
    	 
		$str = "check_box". $i ;
		//echo($str);
		
		if(!isset($_POST[$str]))
		{
			$check[$i] = 'No';
			//$check = $check_box[$i];
		}
		else
		{
			$check[$i] = $_POST[$str];
			//$check = $check_box[$i];
			
		}
			
}


$query1="INSERT INTO `specials` (`id_specials`, `deff`, `lock_system`, `au_video`, `abs`, `e_glass`, `multi_control`, `eps`, `booster_control`, `gear`, `srs`, `luke`, `auto_pilot`, `computer`, `lift_system`) VALUES (NULL, '$check[2]', '$check[6]', '$check[3]', '$check[1]', '$check[11]','$check[0]', '$check[5]',  '$check[10]', '$check[8]','$check[4]','$check[9]', '$check[7]', '$check[13]', '$check[12]')";
		$result1 = mysql_query($query1) or die(mysql_error());
			if(!$result1)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}	
	

	$id_first= mysql_insert_id();
	//обработка авто
	
	$query="INSERT INTO `auto` (`id_auto`, `id_category`, `type`, `id_brend`, `model`, `volume`, `powwer`, `year`, `price`, `run`, `fuel`, `transmission`, `color`, `broken`, `control`, `doors`, `comfort`, `comment`, `VIN`,`country`, `id_specials`) VALUES (NULL, '$category', '$type', '$brend', '$model', $volume,$powwer, $year,  $price,$run, '$fuel','$transmission','$color', '$broken', '$control', '$doors', '$comfort',   '$comment', '$vin','$country',$id_first)";
		$result = mysql_query($query) or die(mysql_error());
			if(!$result)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	$id_first1= mysql_insert_id();
	
//обработка photo-ов
for($i=1;$i<13;$i++)
{
	$string = "image". $i;
	if(isset($_POST[$string]))
	{
		$img= $_POST[$string];
		if($img != '')
		{
		$img = strtolower($img);
		$string = substr($img,10);
		$rescr_min="./uploads/thumb_min_".$string;
		$rescr_max="./uploads/thumb_max_".$string;
		$rescr_orig="./uploads/orig_".$string;
		$width_min="80";
		$height_min="60";
		$width_max="400";
		$height_max="300";
		$width_orig="800";
		$height_orig="600";
		img_resize($img, $rescr_min, $width_min, $height_min,$rgb = 0xFFFFFF, $quality = 100);
		img_resize($img, $rescr_max, $width_max, $height_max,$rgb = 0xFFFFFF, $quality = 100);
		img_resize($img, $rescr_orig, $width_orig, $height_orig,$rgb = 0xFFFFFF, $quality = 100);
		if(file_exists($img)){
		unlink($img);
		}
		$query0="INSERT INTO `photo` VALUES (NULL, $id_first1, '$rescr_orig','$rescr_max','$rescr_min' )";
		$result0 = mysql_query($query0) or die(mysql_error());
			if(!$result0)
			{
			echo "Insert Error: $query0 <br />". mysql_error()."<br />";
			}
		}
		else
		{
			break;
		}
	}
 }
	$login= $_SESSION['login'];
	
	$result9 = mysql_query("SELECT * FROM users WHERE e_mail='$login'",$db_server); 	
    if(!$result9){echo "Error";}
	$myrow9 = mysql_fetch_array($result9);
	$usname = $myrow9['username'];
	$iduser = $myrow9['id_user'];
	
	$query10="INSERT INTO `advert` (`id_advert`, `Username`, `data_insert`, `num_views`, `id_auto`, `id_user`, `status`) VALUES (NULL, '$usname', NOW(), 0, $id_first1, $iduser, 'Продается')";
		$result10 = mysql_query($query10);
			if(!$result10)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}
	
	$id_first2= mysql_insert_id();
	$query11="INSERT INTO `my_autos` (`id_myauto`,`username`, `id_advert`, `memo`) VALUES (NULL,'$_SESSION[login]', $id_first2, 'empty')";
		$result11 = mysql_query($query11);
			if(!$result11)
			{
			echo "Insert Error: $query <br />". mysql_error()."<br />";
			}	
	
}
}
else
{
	$message1="Заполните все поля";
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
 <li id="offer" class="current" >
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

<div id = "add">
<?php 
if($_SESSION['login'])
{
echo <<<END
<form action="add.php" enctype="multipart/form-data" method="POST"   name="InsertForm"  onsubmit="CheckFields(this);">
<input type="hidden" name="inspect" id="insp" value="1" />
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

<fieldset style="border: 1px solid ; padding: 10px; width:800 px;">
<legend  style=" font-size:16px ; color:#00C;"> Главные сведения </legend>
<div id="line">
<div id="brends">
<h5> Марка</h5>
<select name= "brend" id="brend" size="1" class="midle" disabled="disabled"></select>

</div>
<div id="models">
<h5> Модель</h5>
<select name= "model"  id="model" size="1"  class="midle" disabled="disabled"> </select>
</div>
<div id="type">
<h5> Тип кузова</h5>
<select name= "type" size="1"  class="midle" >
<option value="Хечбек" selected="selected">Хечбек</option><option value="Коммерческий">Коммерческий</option><option value="Кабриолет">Кабриолет</option><option value="Купе">Купе</option><option value="Внедорожник">Внедорожник</option><option value="Лимузин">Лимузин</option><option value="Однообъёмный">Однообъёмный</option><option value="Пикап">Пикап</option><option value="Седан">Седан</option><option value="Универсал">Универсал</option><option value="Прочее">Прочее</option>
</select>
</div>
<div id="volume">
<h5> Объём двигателя,см^3</h5>
<input type="text" name= "volume"   class="midle" placeholder="Например: 1800" ></input> 
</div>
</div>

<div id="line">
<div id="year">
<h5> Год </h5>
<select name= "year" size="1"  class="midle" >
<option value="2012" selected="selected">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option>
</select>
</div>
<div id="fuel">
<h5> Топливо </h5>
<select name= "fuel" size="1"  class="midle">
<option value="Дизель" selected="selected">Дизель</option><option value="Электричество">Электричество</option><option value="Газ">Газ</option><option value="Бензин">Бензин</option><option value="Бензин/Электричество">Бензин / Электричество</option><option value="Бензин/Газ">Бензин / Газ</option><option value="Прочее">Прочее</option>
</select>
</div>
<div id="price">
<h5> Цена , дол. </h5>
<input type="text" name= "price"   class="midle"  placeholder="Например: 3500"> </input>
</div>

<div id="run">
<h5> Пробег , км </h5>
<input type="text" name= "run"   class="midle" placeholder="Например: 5000" ></input> 
</div>
</div>

<div id="line">
<div id="transmission">
<h5> Коробка скоростей </h5>
<select name= "transmission" size="1"  class="midle" >
<option value="Автоматическая" selected="selected">Автоматическая</option><option value="Полу автоматическая">Полу автоматическая</option><option value="Механическая">Механическая</option><option value=">Джойстик">Джойстик</option>
</select>
</div>
<div id="broken">
<h5> Битая </h5>
<select name= "broken" size="1"  class="midle">
<option value="Битая">Битая</option><option value="Не битая" selected="selected">Не битая</option> 
</select>
</div>
<div id="control">
<h5> Руль </h5>
<select name= "control" size="1"  class="midle">
<option value="Руль слева" selected="selected">Руль слева</option><option value="Руль справа">Руль справа</option>
</select>
</div>

<div id="color">
<h5> Цвет </h5>
<select name= "color" size="1"  class="midle">
<option value="Прочее" selected="selected">Прочее</option><option value="Песочный">Песочный</option><option value="Черный">Черный</option><option value="Синий">Синий</option><option value="Бронзовый">Бронзовый</option><option value="Коричневый">Коричневый</option><option value="Вишневый">Вишневый</option><option value="Золотой">Золотой</option><option value="Серый">Серый</option><option value="Зелёный">Зелёный</option><option value="Голубой">Голубой</option><option value="Светло-зелeный">Светло-зелeный</option><option value="Светло серый">Светло серый</option><option value="Оранжевый">Оранжевый</option><option value="Фиолетовый">Фиолетовый</option><option value="Красный">Красный</option><option value="Серебряный">Серебряный</option><option value="Белый">Белый</option><option value="Жёлтый">Жёлтый</option>
</select>
</div>
</div>

<div id="line">
<div id="doors">
<h5> Количество дверей </h5>
<select name= "doors" size="1"  class="midle" >
<option value="Прочее">Прочее</option><option value="2/3">2/3</option><option value="4/5" selected="selected">4/5</option>
</select>
</div>
<div id="comfort">
<h5> Комфорт </h5>
<select name= "comfort" size="1"  class="midle">
<option value="Кондиционер" selected="selected">Кондиционер</option><option value="Климат контроль">Климат контроль</option><option value="Климат контроль и Кондиционер">Климат контроль и Кондиционер</option><option value="Нет">Нет</option></select>
</div>

<div id="vin">
<h5> Vin </h5>
<input type="text" name= "vin"   class="midle" placeholder="Например: 1B2367S19J43R2009" > </input>
</div>

<div id="powwer">
<h5> Мощность, ЛШ</h5>
<input type="text" name= "powwer"   class="midle" placeholder="Например: 82" > </input>
</div>
</div>
<div id="line">
<div id="country">
<h5> Местонахождение транспортного средства </h5>
<select name= "country" size="1"  class="big">
<option value="Таджикистан" selected="selected">Таджикистан</option><option value="Латвия">Латвия</option><option value="Литва">Литва</option><option value="Польша">Польша</option><option value="Германия">Германия</option><option value="Франция">Франция</option><option value="Эстония">Эстония</option><option value="Россия">Россия</option></select>
</div>
</div>
<h5>Комментарии</h5>
<textarea name="comment" class="textbox" cols="80" rows="6" ></textarea>
</fieldset>
<div id="border-line"></div>


<fieldset style="border: 1px solid ; padding: 10px; width: 800px;">
<legend style=" font-size:16px ; color:#00C;"> Особенности </legend>
<div id ="multi-control">
<input  type="checkbox" name="check_box0" id="multi-control"  value="Многофункциональный руль" /> <label for="multi-control">Многофункциональный руль</label>
</div>
<div id ="ABS">
<input  type="checkbox" name="check_box1" id="ABS" value="ABS" /> <label for="ABS">ABS</label>
</div>
<div id="deff">
<input  type="checkbox" name="check_box2" id="deff" value="Сигнализация" /> <label for="deff">Сигнализация</label>
</div>

<div id ="au-video">
<input  type="checkbox" name="check_box3" id="au-video" value="аудио - видео" /> <label for="au-video"> аудио - видео</label>
</div>
<div id ="SRS">
<input  type="checkbox" name="check_box4" id="SRS" value="SRS подушки безопасности" /> <label for="SRS">SRS подушки безопасности</label>
</div>
<div id ="EPS">
<input  type="checkbox" name="check_box5" id="EPS" value="EPS" /> <label for="EPS">EPS</label>
</div>
<div id="lock-system">
<input  type="checkbox" name="check_box6" id="lock-system" value="Центральный замок" /> <label for="lock-system">Центральный замок</label>
</div>
<div id ="auto-pilot">
<input  type="checkbox" name="check_box7" id="auto-pilot" value="Автопилот" /> <label for="auto-pilot"> Автопилот</label> </br>
</div>

<div id ="gear">
<input  type="checkbox" name="check_box8" id="gear" value="4Х4 (Все колёса ведущие)" /> <label for="gear">4Х4 (Все колёса ведущие)</label>
</div>

<div id ="luke">
<input  type="checkbox" name="check_box9" id="luke" value="Люк" /> <label for="luke">Люк</label>
</div>

<div id ="booster-control">
<input  type="checkbox" name="check_box10" id="booster-control" value="Усилитель руля" /> <label for="booster-control">Усилитель руля</label>
</div>


<div id ="e-glass">
<input  type="checkbox" name="check_box11" id="e-glass" value="Эл. стёкла" /> <label for="e-glass">Эл. стёкла</label>
</div>

<div id ="lift-system">
<input  type="checkbox" name="check_box12" id="lift-system" value="Электро управляемые седенья" /> <label for="lift-system">Электро управляемые седенья</label>
</div>

<div id ="computer">
<input  type="checkbox" name="check_box13" id="computer" value="Бортовой компьютер" /> <label for="computer">Бортовой компьютер</label>
</div>

</fieldset>
<div id="border-line"></div>
<div id="uploader">
<fieldset style="border: 1px solid ; padding: 10px; width: 800px;">
<legend style=" font-size:16px ; color:#00C;"> Фотографии </legend>
<h5> Вы можете загрузить до 12 фотографий. Максимальный размер фотографии 5MB. Доступные форматы JPG, GIF, PNG.</h5>
<div id="mainbody" >
		<input type="hidden" name="image1" id="img1" value="" />
        <input type="hidden" name="image2" id="img2" value="" />
        <input type="hidden" name="image3" id="img3" value="" />
        <input type="hidden" name="image4" id="img4" value="" />
        <input type="hidden" name="image5" id="img5" value="" />
        <input type="hidden" name="image6" id="img6" value="" />
        <input type="hidden" name="image7" id="img7" value="" />
        <input type="hidden" name="image8" id="img8" value="" />
        <input type="hidden" name="image9" id="img9" value="" />
        <input type="hidden" name="image10" id="img10" value="" />
        <input type="hidden" name="image11" id="img11" value="" />
        <input type="hidden" name="image12" id="img12" value="" />
        <h3>&raquo; AJAX File Upload Form Using jQuery</h3>
		<!-- Upload Button, use any id you wish-->
		<div id="upload" ><span>Загрузить<span></div><span id="status" ></span>
		
		<ul id="files" ></ul>
</div>
</fieldset>
</div>


<div id ="button" >
<input type="submit" name="insert" value="Подать"  class="button"  /> 
</div>


</form>
END;
}
else
{
	echo "Извините раздел только для зарегистрированных пользователей.</br>";
	echo "Пожалуйста <a href='register.php'>Зарегистрируйтесь</a></br>";
	echo "Или зайдите под своим <a href='login.php'>Логином</a></br>";
}

?>


</div> <!-- div add -->

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

<?
if($message)
{
	echo "<font color='red'>".$message."</font>";
	unset($message);
	echo "</br>";
}
else if($message2)
{
	echo "<font color='red'>".$message2."</font>";
	unset($message2);
	echo "</br>";
}
?>

 </div> <!-- div content -->
 
 <div id="footer">
 <div id="footer-image"></div>
 <p id="footer-text"> 
 Copyright © 2012 Muhamedov D.N.<br /> All Rights Reserved
 </p>
 </div>
</body>
</html>