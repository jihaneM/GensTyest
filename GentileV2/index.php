<?php session_start(); ?>
<!doctype html>
<html>
<head>
 <meta charset="UTF-8"/>
 <meta http-equiv="Content-Type" content="text/html">
 <title>Jouer et Trouver les gentiles</title>
    
   
    <link rel="pingback" href="http://www.bufa.es/xmlrpc.php" />
    <link rel="shortcut icon" type="image/x-icon" href="http://www.bufa.es/favicon.ico">
    <meta property="og:image" content="../wp-content/themes/bufa/images/thumbnail_latitud.jpg">

    
</head>

<body >

<header id="header">
	<div class="infos">
	  <?php echo'Bonjour :'.$_SESSION['login'];?>
 	<br>
    	<?php 
    		echo'nbr points : '.$_SESSION['nbscore']; 
    	?> <br>
    	<?php
    		echo'Email : '.$_SESSION['email'];	
    	?> <br>
    	<?php 
    		echo'Pays : '.$_SESSION['pays'];		
		?>
		<div class="deco">
		<a href="deco.php">Deconnexion</a>
	</div>
	</div>
	
	
	

</header>
<style type="text/css">
body {
				background: #e1c192 url(images/3.jpg);
			}
.infos {
	width : 250px;
	border: solid 2px yellow;
	font-size: 14px;
	font-weight: bold;
	color: white;
}
.deco {
	width : 100px;
	height: 20px;
	float : right;
	font-size: 14px;
	font-weight: bold;
	color: white;
}
.jeu {
	
	float: left;
	font-size: 14px;
	font-weight: bold;
	color: #e1c192;
}


div#map {
	position: relative;
  width:100%;
  height:600px;
  margin-top: 70px;
  margin-bottom:40px;
  border-top: 4px solid #333;
  border-bottom: 4px solid #333;
}

div#map_canvas {
  width:100%;
  height:600px;
}

div#map .zoom{
  display: none;
}

div#map .form{
  position: absolute;
  top: -54px;
  left: 50%;
  width:980px;
  height:50px;
  margin:0 0 0 -490px;
  text-align: center;
  line-height: 50px;
  color: #e1c192 ;
  background: #FFFD8B;
  -webkit-border-bottom-right-radius: 2px;
  -webkit-border-bottom-left-radius: 2px;
  -moz-border-radius-bottomright: 2px;
  -moz-border-radius-bottomleft: 2px;
  border-bottom-right-radius: 2px;
  border-bottom-left-radius: 2px;
  z-index: 1;
}

div#map .form .google{
  position: absolute;
  top: 7px;
  left: 14px;
  height: 30px;
  z-index: 1;
}
div#map .coordinates{
  position: absolute;
  bottom: 20px;
  left: 50%;
  width:499px;
  height:40px;
  margin:0 0 0 -250px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  z-index: 1;
}
div#map .coordinates em{
  position: absolute;
  top: -20px;
  width: 249px;
  height: 20px;
  background: #6BAB96;
  color: #000;
  font-style: normal;
  letter-spacing: 1px;
  font-size: 10px;
  line-height: 20px;
  text-transform: uppercase;
  font-weight: normal;
}
div#map .coordinates em.lat{
  left: 0;
}
div#map .coordinates em.lon{
  right: 0;
}
div#map .coordinates span{
  display: block;
  float: left;
  width: 249px;
  font-size: 18px;
  line-height: 40px;
  background: #333;
}
div#map .coordinates span#lng{
  float: right;
}
div#map .coordinates span:hover{
  background: #111;
}

div#map .address{
  position: absolute;
  bottom: -44px;
  left: 0;
  width:100%;
  height:40px;
  text-align: center;
  line-height: 40px;
  font-weight: bold;
}

div#crosshair {
	display: block;
	position: absolute;
	top: 50%;
  left: 50%;
	height: 17px;
	width: 16px;
	margin-left: -8px;
  margin-top: -8px;
	background-image: url(../wp-content/themes/bufa/images/bg-sprite.png);
	background-position: 0 -23px;
	background-repeat: no-repeat;
}

.logohtml5 {
  display: none;
}
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var map;
  var geocoder;
  var centerChangedLast;
  var reverseGeocodedLast;
  var currentReverseGeocodeResponse;

  function initialize() {
    var latlng = new google.maps.LatLng(32.5468,-23.2031);
    var myOptions = {
      zoom: 3,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    geocoder = new google.maps.Geocoder();
    setupEvents();
    centerChanged();
  }

  function setupEvents() {
    reverseGeocodedLast = new Date();
    centerChangedLast = new Date();

    setInterval(function() {
      if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
        if(reverseGeocodedLast.getTime() < centerChangedLast.getTime())
          reverseGeocode();
      }
    }, 1000);

    google.maps.event.addListener(map, 'zoom_changed', function() {
      document.getElementById("zoom_level").innerHTML = map.getZoom();
    });

    google.maps.event.addListener(map, 'center_changed', centerChanged);

    google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() {
       map.setZoom(map.getZoom() + 1);
    });

  }

  function getCenterLatLngText() {
    return '(' + map.getCenter().lat() +', '+ map.getCenter().lng() +')';
  }

  function centerChanged() {
    centerChangedLast = new Date();
    var latlng = getCenterLatLngText();
    var lat = map.getCenter().lat();
    var lng = map.getCenter().lng();
    document.getElementById('lat').innerHTML = lat;
    document.getElementById('lng').innerHTML = lng;
    document.getElementById('formatedAddress').innerHTML = '';
    currentReverseGeocodeResponse = null;
  }

  function reverseGeocode() {
    reverseGeocodedLast = new Date();
    geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
  }
  function affiche(id){

		if(document.getElementById(id).style.visibility == "hidden"){
			document.getElementById(id).style.visibility = "visible";
		}
		else{
			document.getElementById(id).style.visibility = "hidden";
		
		}

		
	}

  function reverseGeocodeResult(results, status) {
    currentReverseGeocodeResponse = results;
    if(status == 'OK') {
      if(results.length == 0) {
        document.getElementById('formatedAddress').innerHTML = 'None';
      } else {
        document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
      }
    } else {
      document.getElementById('formatedAddress').innerHTML = 'Error';
    }
  }

  function geocode() {
			
    var address = document.getElementById("address").value;
    geocoder.geocode({
      'address': address,
      'partialmatch': true}, geocodeResult);

  }

  function geocodeResult(results, status) {
    if (status == 'OK' && results.length > 0) {
      map.fitBounds(results[0].geometry.viewport);
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  }

  function addMarkerAtCenter() {
    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map
    });

    var text = 'Lat/Lng: ' + getCenterLatLngText();
    if(currentReverseGeocodeResponse) {
      var addr = '';
      if(currentReverseGeocodeResponse.size == 0) {
        addr = 'None';
      } else {
        addr = currentReverseGeocodeResponse[0].formatted_address;
      }
      text = text + '<br>' + 'Dirección: <br>' + addr;
    }

    var infowindow = new google.maps.InfoWindow({ content: text });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }
</script>



<div id="map">
    <div id="map_canvas"></div>
    <div id="crosshair">
    	
    </div>
    <div class="form">
		    	<div class="jeu" id="jeu">
				<form method="post" action="chercher.php">
		       		<input type="text" name="gentile" id="gentile" placeholder="Nom des Habitants" class="input">
		        	 OU
		        	<select name="pro">
						<option value="default">Selectionnez un gentile</option>
						
				<?php
				//On selectionne les donn�es
					mysql_connect("localhost", "root", "")or die("cannot connect"); 
					mysql_select_db("gentile")or die("cannot select DB");
					$sq="SELECT * FROM commune ";
					$profil = mysql_query($sq);
		 
				while($affiche = mysql_fetch_array($profil))
				   {
					echo '<option value="'.$affiche['nom_gentile'].'">'.$affiche['nom_gentile'].'</option>';
					}	
				
				?>
				</select>
		        <input type="submit" value="Jouer" name="submit" id="submit" class="button">
		        </form>
			</div>
       		<div>
        <input type="checkbox" name="jeu" checked="checked" id="jeu" onClick="affiche('jeu')"  id="check"><label for="check"><strong>Jouer</strong></label></input>
        
        <input type="text" id="address" placeholder="Le lieu à chercher .." value="" class="input"> 
        <input type="button" value="Chercher" onclick="geocode()" class="button"> 
        <input type="button" value="Marquer ce lieu" onclick="addMarkerAtCenter()" class="button">
     
        </div>
       
      
    </div>
    
   		 <div class="coordinates">
      		<em class="lat">Latitude</em>
      		<em class="lon">Longitude</em>
     		<span id="lat"></span>
      		<span id="lng"></span>
  		  </div>
    
    <div class="address">
      <span id="formatedAddress">-</span>
    </div>
    <span id="zoom_level"></span>
</div>


<script type="text/javascript" src="./ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
<script type="text/javascript" src="./wp-content/themes/bufa/js/scripts.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9981803-1");
pageTracker._trackPageview();
} catch(err) {}
</script>


</body>


<!-- Mirrored from www.bufa.es/google-maps-latitud-longitud/ by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 17 Jan 2014 14:12:22 GMT -->
</html>
<script>
$(document).ready(function(){
  initialize();
});


</script>