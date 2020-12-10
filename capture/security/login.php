<?php session_start(); ?>
<?php
$username = 'dddd';
$password = 'aaaaa';

$login_form = <<<EOP
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
</head>
<body>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-5">
      <h2> Monitoring Team Login</h2>
       <form role="form" id = "accountForm" action = 'login.php' method = 'post'>
                 <div class="form-group input-group">
                     <input type="text" class="form-control" placeholder="Unit name" name="unit_name"/>
                 </div>
                 <div class="form-group input-group">
                     <input type="password" class="form-control" placeholder="Password" name="password"/>
                 </div>

                 <input type="submit" class="btn btn-success" name="login"/>
         </form>
    </div>
    <div class="col-md-3">
    </div>

  </div>

</body>
</html>
EOP;

  if(isset($_POST['login'])) {

    $usern = $_POST['unit_name'];
    $pswd = $_POST['password'];

    include_once "../config.php";
    $login = fetchAssoc("monitoring_team","unit_name"," password = '".$pswd."' AND unit_name = '".$usern."'");

    if($login != -1) {
      $_SESSION['admin_name'] = $usern;
      echo "<script>window.location.href= 'list.php'</script>";
     //header("location: list.php");
    }
    else {
        echo "<h2 style='color:red;'>INVALID USERNAME/PASSWORD</h2>";
        echo $login_form;
      //header("location:login.php");
    }
  }
  else if(isset($_GET['logout'])) {
    session_destroy();
    $_SESSION = null;
  }
  else echo $login_form;

?>
