<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Map</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

  <link rel="stylesheet" href="./CSS/main.css">
  <style>
    #map {
      margin: 100px auto;
      height: 500px;
      width: 1000px;
    }

    .map-label{
      line-height: 10px;
      margin-top: 0;
    }
  </style>
</head>

<body>
  <h3>Map of your current location</h3>

  <?php
  $ip = $_REQUEST['REMOTE_ADDR'];
  $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
  if ($query && $query['status'] == 'success') {
    $latitude = $query['lat'];
    $longitude = $query['lon'];
    $ip_address = $query['query'];
  } else {
    echo 'Location error';
  }
  ?>
  <div id="map"></div>

  <script>

    var latitude = <?php echo $latitude ?>;
    var longitude = <?php echo $longitude ?>;

    const mymap = L.map('map').setView([latitude, longitude], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    var myIcon = L.divIcon({ 
    iconSize: new L.Point(100, 50), 
    html: '<div class="map-label"> <p>Latitude: <?php echo $latitude ?></p><p>Longtitude: <?php echo $longitude ?></p> </div>'
    });
    L.marker([latitude, longitude]).addTo(mymap).bindPopup('<p>IP Address: <?php echo $ip_address ?> </p>');
    L.marker([latitude, longitude ],{icon: myIcon} ).addTo(mymap);
  </script>

  <a href="index.php">Click here to proceed to main page</a>
</body>

</html>