<?php
  $jsondata = file_get_contents("http://54.175.194.45:8028/posts");
  $json = json_decode($jsondata,true);
  $count = count($json);
 for($idx=0;$idx<$count;$idx++){
	echo "<div>";
	echo "<a name=\"".$json[$idx]['id']."\"></a><h1> ".$json[$idx]['body']."</h1>";
	echo "<b>By: </b><i>".$json[$idx]['name']['first']." ".$json[$idx]['name']['last']."</i>";
	echo "  |<b> ".$json[$idx]['install_ts']."</b>";
	echo "<p>".$json[$idx]['title']."</b>";
	echo "<hr></div>";
	
  }
  echo '
	  <!DOCTYPE html>
  	  <html>
	  <head>
	  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	  </head>
	  <body>
	  <div id="map" style="height: 80%; width: 100%;background-color:black;"></div>
	  
	  <script type="text/javascript">
	  var map = new google.maps.Map(document.getElementById(\'map\'), {
	  zoom: 2,
	  center: new google.maps.LatLng(-20.9, -7.29),
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	  });
	';
for($idx = 0;$idx<$count;$idx++){
	$lat = $json[$idx]['user_location']['latitude'];
	$lng = $json[$idx]['user_location']['longitude'];
    $content = "<p><a href=\\\"#".$json[$idx]['id']."\\\">".$json[$idx]['body']."</a></p>".
	"<b>By: </b><i>".$json[$idx]['name']['first']." ".$json[$idx]['name']['last']."</i>";
    echo '	
	  var infowindow = new google.maps.InfoWindow();
	  var marker = new google.maps.Marker({
        position: {lat:'.$lat.', lng:'.$lng.'},
        map: map,
		title: "Click to view..."
      });
	  google.maps.event.addListener(marker, \'click\', function() {
            infowindow.setContent("'.$content.'");
            infowindow.open(map, this);
        });
	';
}

	echo '
      </script>
      </body>
	';	
?>
