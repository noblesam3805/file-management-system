<?php session_start(); ?>
<?php
  if(isset($_POST['login'])) {
    $usern = $_POST['username'];
    $pswd = $_POST['pswd'];
    include_once "../config.php";
    $login = fetchAssoc("admin","admin_name"," password = '".$pswd."' AND admin_name = '".$usern."'");
    if($login != -1) {
      $_SESSION['admin_name'] = $usern;
    // header("location: list.php");
      echo "<script>window.location.href= 'list.php'</script>";
    }
    else header("location:index.php");
  }
  if(isset($_GET['logout'])) {
    session_destroy();
    $_SESSION = null;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
</head>
<body style="background-image: url(../assets/img/d400b5b6fcf3aa42dfce6268316ec0f8.jpg);
background-size: cover;
">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-5" style="color: #fff; top:100px;" >
      <h2> Admin Login</h2>
        <form role="form" id = "accountForm" action="index.php" method="post">
                  <div class="form-group input-group">
                      <input type="text" class="form-control" placeholder="Admin Username" name="username"/>
                  </div>
                  <div class="form-group input-group">
                      <input type="password" class="form-control" placeholder="Password" name="pswd"/>
                  </div>
  <br/>
		  <b><a href="../eBankingVerifyer.exe"  style="color:red" ><i class="icon-angle-right"></i>  Customer Login</a></b>
                  <input type="submit" class="btn btn-success" name="login" value="Login"/>
          </form>
		
    </div>
    <div class="col-md-3">
	
    </div>

  </div>

  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
     
      <div id="biometric">

      </div>

    </div>
    <div class="col-md-4"></div>

  </div>
</body>
</html>
