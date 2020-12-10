<?php
include_once "config.php";

if(isset($_POST['locate'])) {
  getUserGPScoord();
  send_sms('08179842529',"Hello from IntelligentBaning");
}
?>



<form action="test.php", method="post">
  <input type="submit" value="Check" name="locate"/>
</form>


<!DOCTYPE html>
<html>
<head>
<title>Geo City Locator by geoip-db.com</title>
</head>
<body>
    <div>Country: <span id="country"></span></div>
    <div>State: <span id="state"></span></div>
    <div>City: <span id="city"></span></div>
    <div>Postal: <span id="postal"></span></div>
    <div>Latitude: <span id="latitude"></span></div>
    <div>Longitude: <span id="longitude"></span></div>
    <div>IP address: <span id="ipv4"></span></div>
</body>
<script>

    var country = document.getElementById('country');
    var state = document.getElementById('state');
    var city = document.getElementById('city');
    var postal = document.getElementById('postal');
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');
    var ip = document.getElementById('ipv4');

    function callback(data)
    {
        country.innerHTML = data.country_name;
        state.innerHTML = data.state;
        city.innerHTML = data.city;
        postal.innerHTML = data.postal;
        latitude.innerHTML = data.latitude;
        longitude.innerHTML = data.longitude;
        ip.innerHTML = data.IPv4;
    }

    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://geoip-db.com/json/geoip.php?jsonp=callback';
    var h = document.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(script, h);

</script>
</html>
