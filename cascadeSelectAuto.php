<?php
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    
	switch($_GET['category']) {
       	case '1':
       	print '[{value:"",text:"Выбрать автомобиль"},{value:"1",text:"Acura"},{value:"2",text:"Alfa Romeo"},{value:"3",text:"Aston Martin"},{value:"4",text:"Audi"},{value:"5",text:"Bentley"},{value:"6",text:"BMW"},{value:"7",text:"Cadillac"},{value:"8",text:"Chevrolet"},{value:"9",text:"Chrysler"},{value:"10",text:"Citroen"},{value:"11",text:"Daewoo"},{value:"12",text:"Dodge"},{value:"13",text:"Ferrari"},{value:"14",text:"Fiat"},{value:"15",text:"Ford"},{value:"16",text:"GAZ"},{value:"17",text:"GMC"},{value:"18",text:"Honda"},{value:"19",text:"Hummer"},{value:"20",text:"Hyundai"},{value:"21",text:"Infiniti"},{value:"22",text:"Isuzu"},{value:"23",text:"Jaguar"},{value:"24",text:"Jeep"},{value:"25",text:"Kia"},{value:"26",text:"Lada"},{value:"27",text:"Lamborghini"},{value:"28",text:"Land Rover"},{value:"29",text:"Lexus"},{value:"30",text:"Lincoln"},{value:"31",text:"Lotus"},{value:"32",text:"LuAZ"},{value:"33",text:"Maserati"},{value:"34",text:"Maybach"},{value:"35",text:"Mazda"},{value:"36",text:"Mercedes-Benz"},{value:"37",text:"Mini"},{value:"38",text:"Mitsubishi"},{value:"39",text:"Moskvich"},{value:"40",text:"Nissan"},{value:"41",text:"Opel"},{value:"42",text:"Peugeot"},{value:"43",text:"Pontiac"},{value:"44",text:"Porsche"},{value:"45",text:"Renault"},{value:"46",text:"Rolls-Royce"},{value:"47",text:"Rover"},{value:"48",text:"Saab"},{value:"49",text:"Seat"},{value:"50",text:"Skoda"},{value:"51",text:"SsangYong"},{value:"52",text:"Subaru"},{value:"53",text:"Suzuki"},{value:"54",text:"Toyota"},{value:"55",text:"UAZ"},{value:"56",text:"VAZ"},{value:"57",text:"Volkswagen"},{value:"58",text:"Volvo"},{value:"59",text:"ZAZ"}]';
       	break;
       	case '2':
       	print '[{value:"",text:"Раздел закрыт"}]';
       	break;
		case '3':
       	print '[{value:"",text:"Раздел закрыт"}]';
       	break;
		case '4':
       	print '[{value:"",text:"Раздел закрыт"}]';
       	break;
		case '5':
       	print '[{value:"",text:"Раздел закрыт"}]';
       	break;       	
       	default:
       	print '[{value:"",text:"Выбрать автомобиль"}]';
       	break;
    }
	
}
?>