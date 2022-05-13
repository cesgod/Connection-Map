<?php

  $stringv = file_get_contents("../virtualenvs/Cl/soapclient/resultslocation.json");

    if ($stringv === false) {
      echo "No content<br>";
    }

$output = json_decode($stringv, true);
    if ($output === null) {
        // deal with error...
      echo "Parse error<br>";
    }

$cont=0;
$a=0;
$myArray = $output;
#echo "<pre>"; print_r($myArray); echo "</pre>";
$limit = count($myArray);
#echo "<pre>";print_r($myArray);echo "</pre>";

 $stringb = file_get_contents("../virtualenvs/Cl/soapclient/resultslocationdata.json");

    if ($stringb === false) {
      echo "No content<br>";
    }

$outputb = json_decode($stringb, true);
    if ($outputb === null) {
        // deal with error...
      echo "Parse error<br>";
    }

$contb=0;
$b=0;
$myArrayb = $outputb;
#echo "<pre>"; print_r($myArray); echo "</pre>";
$limitb = count($myArrayb);
#echo "<pre>";print_r($myArray);echo "</pre>";
#var_dump('Limite 1: ',$limit,'<br>Limite 2: '.$limitb);

$stringu = file_get_contents("allunreach.json");

if ($stringu === false) {
  echo "No content<br>";
}

$outputu = json_decode($stringu, true);
if ($outputu === null) {
    // deal with error...
  echo "Parse error<br>";
}

$contu=0;
$u=0;
$myArrayu = $outputu;
#echo "<pre>"; print_r($myArrayb); echo "</pre>";
$limitu = count($myArrayu);

#var_dump('Unreach : ',$myArrayu);
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Heatmaps</title>
    <link rel="stylesheet" type="text/css" href="hmstyle.css">
    <!--<script type="text/javascript" src="heat.js"></script>-->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqnRgJb2oTNxvOY7ny9PHvy9OSTDdoX8A&callback=initMap&libraries=visualization&v=weekly"
      defer
    ></script>
    <!-- jsFiddle will insert css and js -->
  </head>
  <body>
    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Heatmap</button>
      <button onclick="changeGradient()">Gradient</button>
      <button onclick="changeRadius()">Radio</button>
      <select id="type" onchange="filterMarkers(this.value);">
    <option value="">ALIMENTADORES</option>
    <option value="AL1">AL1</option>
    <option value="AL2">AL2</option>
    <option value="AL3">AL3</option>
    <option value="AL4">AL4</option>
    <option value="AL5">AL5</option>
    <option value="AL6">AL6</option>
    <option value="TR1">TR1</option>
    <option value="TR2">TR2</option>
    
    
</select>
    </div>
    
    <div id="map"></div>
<script src="allunreach.js"></script>
<script type="text/javascript">  


let map, heatmap;
var markers = [];
var unreach = [

  <?php
  for ($j=0; $j < $limitu; $j++) { 
     echo '"';
     echo $myArrayu[$j];
     echo '",';
   } 
  ?>

,"0"];

var locations = [

<?php
  for ($i=0; $i < $limit; $i++) { 
     echo "[' <h1>".$myArrayb[$i][8]."</h1><br><h3>Última conexión: ".$myArrayb[$i][1]."</h3><br>Barrio: ".$myArrayb[$i][4]."<br>Alimentador: ".$myArrayb[$i][7]."<br>Potencia Nominal: ".$myArrayb[$i][6]."<br>Location: ".$myArray[$i][0]."  ', ".$myArray[$i][0].", '".$myArrayb[$i][7]."'],";
   } 
  ?>

  
];
var ips= [
<?php
  for ($i=0; $i < $limit; $i++) { 
     echo '"'.$myArrayb[$i][0].'",';
   } 
  ?>


"1"];
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14.5,
    center: { lat: -25.775804, lng: -56.448570 },
    mapTypeId: "terrain",
    styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text",
    "stylers": [
      {
        "color": "#00ffff"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#181818"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1b1b1b"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8a8a8a"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#373737"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3c3c3c"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#4e4e4e"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3d3d3d"
      }
    ]
  }
]
  });

setMarkers(map);
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: getPoints(),
    map: map,
  });
  
/*const ctaLayer = new google.maps.KmlLayer({
    url: "http://clyfsa.com/images/aps.kml",
    map: map,
  });*/


}
//var status = var/www/html/Charts_Data/dash-master/checkping.json
var dummy = locations[0][3];
  //console.log(dummy);
function setMarkers(map) {

  var mkr=1;
  for (var i = 0; i < locations.length; i++) {
    
    dicon= 'images/power.png';
    mkr=mkr+1;
    //console.log('Numm: ',mkr);
    var ipsn=ips[i];
    //console.log('IP:',ipsn)
    for (var j = 0; j < unreach.length; j++) {
      var unreachn=unreach[j];
      if (ipsn==unreachn) {
        dicon= 'images/nosignal.png';
        
      }
      //console.log('ipsn:',ipsn,' unreachn: ',unreach[j],'i: ',i,'j: ',j);
    }
    
    var location = locations[i];
    var locationInfowindow = new google.maps.InfoWindow({
      content: location[0],
    });
   
    var marker = new google.maps.Marker({
      position: {lat: location[1], lng: location[2]},
      icon: dicon,
      category: location[3],
      map: map,
      title: location[0],
      infowindow: locationInfowindow
    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'click', function() {
      hideAllInfoWindows(map);
      this.infowindow.open(map, this);
    });

  }
}

function hideAllInfoWindows(map) {
   markers.forEach(function(marker) {
     marker.infowindow.close(map, marker);
  }); 
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}
toggleHeatmap();
function toggleMarker() {
  ctaLayer.setMap(null);
}

function changeGradient() {
  const gradient = [
    "rgba(0, 255, 255, 0)",
    "rgba(0, 255, 255, 1)",
    "rgba(0, 191, 255, 1)",
    "rgba(0, 127, 255, 1)",
    "rgba(0, 63, 255, 1)",
    "rgba(0, 0, 255, 1)",
    "rgba(0, 0, 223, 1)",
    "rgba(0, 0, 191, 1)",
    "rgba(0, 0, 159, 1)",
    "rgba(0, 0, 127, 1)",
    "rgba(63, 0, 91, 1)",
    "rgba(127, 0, 63, 1)",
    "rgba(191, 0, 31, 1)",
    "rgba(255, 0, 0, 1)",
  ];
  heatmap.set("gradient", heatmap.get("gradient") ? null : gradient);
}
function filterMarkers (category) {
    for (i = 0; i < markers.length; i++) {
        nmarker = markers[i];
        // If is same category or category not picked
        //console.log('Marker ',nmarker);
        if (nmarker.category == category || category.length === 0) {
            nmarker.setVisible(true);
        }
        // Categories don't match 
        else {
            nmarker.setVisible(false);
        }
    }
}

function changeRadius() {
  heatmap.set("radius", heatmap.get("radius") ? null : 50);
}

function changeOpacity() {
  heatmap.set("opacity", heatmap.get("opacity") ? null : 0.2);
}
changeGradient();

// Heatmap data: 500 Points
function getPoints() {
  return [
  <?php
  for ($i=0; $i < $limit; $i++) { 
     echo "new google.maps.LatLng(".$myArray[$i][0]."),";
   } 
  ?>
  ];
}




</script> 
<script type="text/javascript">
  function dissheat(){
    heatmap.setMap(null);
  }
  setTimeout('dissheat()',900);
</script>
<script type="text/javascript">

  function mapupdate(){
    window.location="http://201.222.49.29//projects/MAPS/maps/";

  }
  setTimeout('mapupdate()',60000);
  

</script>

  </body>
</html>
<script>
if(document.getElementById('ftnt_topbar_script')) {
    document.getElementById('ftnt_topbar_script').remove()
} else {
   var pluginHolder = document.createElement('div');
   document.body.appendChild(pluginHolder);
}
