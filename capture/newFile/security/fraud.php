<?php include_once "header.php" ?>

<?php
  if(!isset($_GET['ready'])) {
    //fetch recent from from db
    include_once "../config.php";
    $dt = fetchAssoc("login","*","status = '0' LIMIT 1");
    if($dt != -1) {
      $coord = $dt[0]['gps']; $coord = json_decode($coord,true);
      $lat = $coord['lat']; $lng = $coord['lng'];
      $ip = $dt[0]['ip_address'];
      $acct = $dt[0]['account_number'];

      $sc = 'ready=1&lat='.$lat.'&lng='.$lng.'&ip='.$ip.'&acct='.$acct;
      echo $sc;
  echo "<script>document.location.href='http://localhost/intelligentbanking.com/security/fraud.php?".$sc."'</script>";

    }

  }
?>


    <div class="row">
      <div class="col-md-2">
        <?php
        //include_once "config.php";

        $lat = isset($_GET['lat'])?$_GET['lat']:4.975716;
        $lng = isset($_GET['lng'])?$_GET['lng']:8.341701;
        $ip = isset($_GET['ip'])?$_GET['ip']:"none";
        $account_n = isset($_GET['acct'])?$_GET['acct']:"none";
        $photo = isset($_GET['photo'])?$_GET['photo']:"";

        $details = <<<EOP
        <p>IP Address: $ip </p>
        <p>Location: $lat, $lng </p>
        <p>Account Number: $account_n </p>
        Photo: <img src='$photo' alt="photo"/>
EOP;
    echo $details;
        ?>
      </div>
      <div id = "map" class="col-md-9"></div>
      <div class="col-md-1"></div>
    </div>






<?php

  $script = <<<EOP
  <script>
      function initMap() {
        var pos = {lat:$lat,lng:$lng};
        var zoomCenter = {zoom:4,center:pos};
        var map = new google.maps.Map(document.getElementById("map"),zoomCenter);
        var marker = new google.maps.Marker({position:pos, map:map});
      }
    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3us0mUrfLH2K7NGmU9CzUZ0vNt94PrtQ&callback=initMap">
      </script>
EOP;
echo $script;
?>

</body>
</html>
