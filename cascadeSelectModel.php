<?php
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	
	if($_GET['category']==1) {
        switch($_GET['brend']) {
        	case '1':
        	print '[{value:"",text:"Выбрать модель"},{value:"CL",text:"CL"},{value:"CSX",text:"CSX"},{value:"EL",text:"EL"},{value:"Integra",text:"Integra"},{value:"Legend",text:"Legend"},{value:"MDX",text:"MDX"},{value:"RDX",text:"RDX"},{value:"RL",text:"RL"},{value:"RSX",text:"RSX"},{value:"TL",text:"TL"},{value:"TSX",text:"TSX"},{value:"ZDX",text:"ZDX"}]';
        	break;
        	case '2':
        	print '[{value:"",text:"Выбрать модель"},{value:"145",text:"145"},{value:"147",text:"147"},{value:"155",text:"155"},{value:"156",text:"156"},{value:"159",text:"159"},{value:"164",text:"164"},{value:"166",text:"166"},{value:"169",text:"169"},{value:"1750",text:"1750"},{value:"2000",text:"2000"},{value:"2600",text:"2600"},{value:"33",text:"33"},{value:"33 Stradale",text:"33 Stradale"},{value:"75",text:"75"},{value:"8C Completizione",text:"8C Completizione"},{value:"90",text:"90"},{value:"Alfa 6",text:"Alfa 6"},{value:"Alfasud",text:"Alfasud"},{value:"Alfetta",text:"Alfetta"},{value:"Arna",text:"Arna"},{value:"Brera",text:"Brera"},{value:"Giulia",text:"Giulia"},{value:"Giulia TZ",text:"Giulia TZ"},{value:"Giulia",text:"Giulia"},{value:"GT",text:"GT"},{value:"GTA",text:"GTA"},{value:"GTV & Spider",text:"GTV & Spider"},{value:"MiTo",text:"MiTo"},{value:"Montreal",text:"Montreal"},{value:"Spider",text:"Spider"},{value:"Sprint",text:"Sprint"},{value:"Sprint GT",text:"Sprint GT"},{value:"SZ",text:"SZ"},{value:"Tipo 33",text:"Tipo 33"}]';
        	break;
        	case '3':
        	print '[{value:"",text:"Выбрать модель"},{value:"2-Litre Sports",text:"2-Litre Sports"},{value:"DB AR1",text:"DB AR1"},{value:"DB Mark III",text:"DB Mark III"},{value:"DB2",text:"DB2"},{value:"DB2/4",text:"DB2/4"},{value:"DB4",text:"DB4"},{value:"DB4 GT Zagato",text:"DB4 GT Zagato"},{value:"DB5",text:"DB5"},{value:"DB6",text:"DB6"},{value:"DB7",text:"DB7"},{value:"DB7 Zagato",text:"DB7 Zagato"},{value:"DB9",text:"DB9"},{value:"DBS",text:"DBS"},{value:"DBS V12",text:"DBS V12"},{value:"Lagonda",text:"Lagonda"},{value:"One-77",text:"One-77"},{value:"V12 Vanquish",text:"V12 Vanquish"},{value:"V8",text:"V8"},{value:"V8 Vantage",text:"V8 Vantage"},{value:"V8 Zagato",text:"V8 Zagato"},{value:"Vantage",text:"Vantage"},{value:"Virage",text:"Virage"}]';
        	break;
			case '4':
        	print '[{value:"",text:"Выбрать модель"},{value:"100",text:"100"},{value:"4000CS Quattro",text:"4000CS Quattro"},{value:"80",text:"80"},{value:"90",text:"90"},{value:"A1",text:"A1"},{value:"A2",text:"A2"},{value:"A3",text:"A3"},{value:"A4",text:"A4"},{value:"A5",text:"A5"},{value:"A6",text:"A6"},{value:"A8",text:"A8"},{value:"Allroad",text:"Allroad"},{value:"Avantissimo",text:"Avantissimo"},{value:"Avus Quattro",text:"Avus Quattro"},{value:"Coupe",text:"Coupe"},{value:"Coupe GT",text:"Coupe GT"},{value:"Coupe Quattro",text:"Coupe Quattro"},{value:"Le Mans quattro",text:"Le Mans quattro"},{value:"Nuvolari Quattro",text:"Nuvolari Quattro"},{value:"Q3",text:"Q3"},{value:"Q5",text:"Q5"},{value:"Q7",text:"Q7"},{value:"Quattro",text:"Quattro"},{value:"R4",text:"R4"},{value:"R8",text:"R8"},{value:"Roadjet",text:"Roadjet"},{value:"Rosemeyer",text:"Rosemeyer"},{value:"RS2",text:"RS2"},{value:"RS2 Avant",text:"RS2 Avant"},{value:"RS4",text:"RS4"},{value:"RS6",text:"RS6"},{value:"RSQ",text:"RSQ"},{value:"S2",text:"S2"},{value:"S3",text:"S3"},{value:"S4",text:"S4"},{value:"S6",text:"S6"},{value:"Shooting Brake",text:"Shooting Brake"},{value:"Sportback concept",text:"Sportback concept"},{value:"TT",text:"TT"},{value:"V8",text:"V8"}]';
        	break;
			case '5':
        	print '[{value:"",text:"Выбрать модель"},{value:"Arnage",text:"Arnage"},{value:"Azure",text:"Azure"},{value:"Brooklands",text:"Brooklands"},{value:"Continental Flying Spur",text:"Continental Flying Spur"},{value:"Continental GT",text:"Continental GT"},{value:"Eight",text:"Eight"},{value:"Mulsanne",text:"Mulsanne"},{value:"Turbo R",text:"Turbo R"},{value:"Turbo RT",text:"Turbo RT"}]';
        	break;
			case '6':
        	print '[{value:"",text:"Выбрать модель"},{value:"1 Series",text:"1 Series"},{value:"116",text:"116"},{value:"118",text:"118"},{value:"120",text:"120"},{value:"123",text:"123"},{value:"125",text:"125"},{value:"130",text:"130"},{value:"135",text:"135"},{value:"3 Series",text:"3 Series"},{value:"315",text:"315"},{value:"316",text:"316"},{value:"318",text:"318"},{value:"320",text:"320"},{value:"323",text:"323"},{value:"324",text:"324"},{value:"325",text:"325"},{value:"327",text:"327"},{value:"328",text:"328"},{value:"330",text:"330"},{value:"335",text:"335"},{value:"5 Series",text:"5 Series"},{value:"518",text:"518"},{value:"520",text:"520"},{value:"523",text:"523"},{value:"524",text:"524"},{value:"525",text:"525"},{value:"528",text:"528"},{value:"530",text:"530"},{value:"530 Gran Turismo",text:"530 Gran Turismo"},{value:"535",text:"535"},{value:"535 Gran Turismo",text:"535 Gran Turismo"},{value:"540",text:"540"},{value:"545",text:"545"},{value:"550",text:"550"},{value:"6 Series",text:"6 Series"},{value:"628",text:"628"},{value:"630",text:"630"},{value:"632",text:"632"},{value:"633",text:"633"},{value:"635",text:"635"},{value:"645",text:"645"},{value:"650",text:"650"},{value:"7 Series",text:"7 Series"},{value:"725",text:"725"},{value:"728",text:"728"},{value:"730",text:"730"},{value:"732",text:"732"},{value:"735",text:"735"},{value:"740",text:"740"},{value:"745",text:"745"},{value:"750",text:"750"},{value:"760",text:"760"},{value:"8 Series",text:"8 Series"},{value:"840",text:"840"},{value:"850",text:"850"},{value:"M Series",text:"M Series"},{value:"M1",text:"M1"},{value:"M2",text:"M2"},{value:"M3",text:"M3"},{value:"M5",text:"M5"},{value:"M6",text:"M7"},{value:"X Series",text:"X Series"},{value:"X1",text:"X1"},{value:"X3",text:"X3"},{value:"X5",text:"X5"},{value:"X5 M",text:"X5 M"},{value:"X6",text:"X6"},{value:"X6 M",text:"X6 M"},{value:"Z Series",text:"Z Series"},{value:"Z1",text:"Z1"},{value:"Z3",text:"Z3"},{value:"Z3 M",text:"Z3 M"},{value:"Z4",text:"Z4"},{value:"Z4 M",text:"Z4 M"},{value:"Z8",text:"Z8"}]';
        	break;
			case '7':
        	print '[{value:"",text:"Выбрать модель"},{value:"Allante",text:"Allante"},{value:"BLS",text:"BLS"},{value:"Catera",text:"Catera"},{value:"CTS",text:"CTS"},{value:"DeVille",text:"DeVille"},{value:"DTS",text:"DTS"},{value:"Eldorado",text:"Eldorado"},{value:"Escalade",text:"Escalade"},{value:"Fleetwood",text:"Fleetwood"},{value:"Seville",text:"Seville"},{value:"SRX",text:"SRX"},{value:"STS",text:"STS"},{value:"Vizon",text:"Vizon"},{value:"XLR",text:"XLR"}]';
        	break;
			case '8':
        	print '[{value:"",text:"Выбрать модель"},{value:"2500",text:"2500"},{value:"Alero",text:"Alero"},{value:"Astro",text:"Astro"},{value:"Avalanche",text:"Avalanche"},{value:"Aveo",text:"Aveo"},{value:"Bel Air",text:"Bel Air"},{value:"Beretta",text:"Beretta"},{value:"Blazer",text:"Blazer"},{value:"C 1500",text:"C 1500"},{value:"Camaro",text:"Camaro"},{value:"Caprice",text:"Caprice"},{value:"Captiva",text:"Captiva"},{value:"Cavalier",text:"Cavalier"},{value:"Chevelle",text:"Chevelle"},{value:"Chevy Van",text:"Chevy Van"},{value:"Citation",text:"Citation"},{value:"Cobalt",text:"Cobalt"},{value:"Clolorado",text:"Clolorado"},{value:"Corsica",text:"Corsica"},{value:"Cruze",text:"Cruze"},{value:"El Camino",text:"El Camino"},{value:"Epica",text:"Epica"},{value:"Equinox",text:"Equinox"},{value:"Evanda",text:"Evanda"},{value:"Express",text:"Express"},{value:"HHR",text:"HHR"},{value:"Impala",text:"Impala"},{value:"Ipanema",text:"Ipanema"},{value:"Kalos",text:"Kalos"},{value:"Lacetti",text:"Lacetti"},{value:"Lumina",text:"Lumina"},{value:"M-1009",text:"M-1009"},{value:"Malibu",text:"Malibu"},{value:"Matiz",text:"Matiz"},{value:"Metro",text:"Metro"},{value:"Monte Carlo",text:"Monte Carlo"},{value:"Monza",text:"Monza"},{value:"Nubira",text:"Nubira"},{value:"Orlando",text:"Orlando"},{value:"Pickup",text:"Pickup"},{value:"Prizm",text:"Prizm"},{value:"Rezzo",text:"Rezzo"},{value:"S-10",text:"S-10"},{value:"Silverado",text:"Silverado"},{value:"Spark",text:"Spark"},{value:"SSR",text:"SSR"},{value:"Suburban",text:"Suburban"},{value:"Tacuma",text:"Tacuma"},{value:"Tahoe",text:"Tahoe"},{value:"Tracker",text:"Tracker"},{value:"TrailBlazer",text:"TrailBlazer"},{value:"Trans Sport",text:"Trans Sport"},{value:"Traverse",text:"Traverse"},{value:"Uplander",text:"Uplander"},{value:"Venture",text:"Venture"},]';
        	break;
			case '9':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '10':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '11':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '12':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '13':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '14':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '15':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '16':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '17':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '18':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '19':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '20':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '21':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '22':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '23':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '24':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '25':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '26':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '27':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '28':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '29':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '30':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '31':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '32':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '33':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '34':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '35':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '36':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '37':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '38':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '39':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '40':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '41':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '42':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '43':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '44':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '45':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '46':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '47':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '48':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '49':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '50':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '51':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '52':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '53':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '54':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '55':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '56':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '57':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '58':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;
			case '59':
        	print '[{value:"",text:"Выбрать модель"},{value:"1",text:"Astra"},{value:"2",text:"Corsa"},{value:"3",text:"Vectra"}]';
        	break;     	
			default:
        	print '[{value:"",text:"Выбрать модель"}]';
        	break;
        }
	} else {
		print '[{value:"",text:"Выбрать модель"}]';
	}
}
?>