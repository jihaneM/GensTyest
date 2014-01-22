<?php
session_start();
if(!session_is_registered(myusername)){
header("location:main_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Gentile</title>
	<meta charset="UTF-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css' />
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<style>
	
	* { margin: 0; padding: 0; }
	html { height: 100%; }
	body { background-image: url(images/bg.jpg); font-size: 16px; font-family: 'Open Sans', sans-serif; height: 100%; position: relative; }
	header { background-color: rgba(0,0,0,.88); height: 85px; width: 100%; position: fixed; z-index: 99; box-shadow: 0px 2px 3px #333333; }
	header > img { float: left; }
	header > h1 { display: inline; color: #FFFFFF; font-family: 'Open Sans', sans-serif; font-size: 1.3em; font-weight: normal; float: right; margin-top: 55px; margin-right: 10px; }
	
	#mapa { position: absolute; background: transparent; height: 100%; width: 100%; top: 0; left: 0; right: 0; bottom: 0; }
	#informacion { position: absolute; background: rgba(0,16,27,.85); z-index: 200; top: 13%; width: 20%; height:100%; padding: 12px; }
	
	#informacion h2,
	#informacion h3 { color: #FFFFFF; text-shadow: 1px 1px 1px #000000; font-weight: normal; font-size: .9em; }
	
	#informacion h2 { font-size: 1.1em; margin-bottom: 10px; }
	
	#informacion h3 span { color: #FF5555; }
	
	</style>
	<script type="text/javascript">
	
	function informacion (coordenadas) {
		$("#latitude").html(coordenadas.Lat);
		$("#longitude").html(coordenadas.Lng);
	}
	
	function initialize() {
		
		var coordenadas = {
			Lat: 0,
			Lng: 0
		};
		
		function localizacion (posicion) {
			coordenadas = {
				Lat: posicion.coords.latitude,
				Lng: posicion.coords.longitude
			}
			
			informacion(coordenadas);
			
			var mapOptions = {
				zoom: 16,
				center: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
				disableDefaultUI: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			
			var map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
			
			var infowindow = new google.maps.InfoWindow({
				map: map,
				position: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
				content: 'Devine qui sommes-nous ?'
            });
		}
		
		function errores (error) {
			alert('Erreur de GŽolocalisation');
		}
		
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(localizacion,errores);
		} else {
			alert("Votre navigateur ne supporte pas la geolocalisation");
		}
		
	}
	</script>
</head>
<body onload="initialize()">
	<header>
		<h1>Les Gens t'y est de France</h1>
	</header>
	<section id="informacion">
		<h2>Information:</h2>
		<h3>Latitude: <span id="latitude"></span></h3>
		<h3>Longitude: <span id="longitude"></span></h3>
	<FORM ACTION="inserer.php" METHOD="POST" target="_self">
		<table width="300" border="0" cellspacing="0" cellpadding="5">
			<tr>	
				<td width="218"><input name="name" type="TEXT" id="name" size="20" readonly="readonly" value="Nom"/></td>
			</tr>
			<tr>
				
				<td> <input name="address" type="TEXT" id="address" size="20" value="Prenom"/></td>
			</tr>
			<tr>
				
				<td>
					<label>
						<select name="type" id="type">
						<option value="Opcion 1" selected="selected">Option1</option>
						<option value="Opcion 2">Option 2</option>
						<option value="Opcion 3">Option 3</option>
						</select>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
				<input name="lat" type="text" id="lat" value="Adresse Email" />
					</label>
				</td>
			</tr>
			<tr>
				
				<td>
					<label>
					<input name="lng" type="text" id="lng" value="Nombre de points"/>
					</label>
				</td>
			</tr>
			<tr>
				
				<td><label>
				<input name="lng" type="text" id="lng" value="Type de Traphe"/>
				</label></td>
			</tr>
			<tr>
				
				<td><input type="SUBMIT" value="Valider" /></td>
			</tr>
		</table>
</FORM>
<div id="confirmation"></div>
	</section>
	<section id="mapa"></section>
</body>


<iframe id="google_osd_static_frame_9491447412874" name="google_osd_static_frame" style="display: none; width: 0px; height: 0px;"></iframe>





</html>