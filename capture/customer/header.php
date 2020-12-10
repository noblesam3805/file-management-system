<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Enrollee Registration </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <link rel="stylesheet" href="../assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="../assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="../assets/css/layout2.css" rel="stylesheet" />
       <link href="../assets/plugins/flot/examples/examples.css" rel="stylesheet" />
       <link rel="stylesheet" href="../assets/plugins/timeline/timeline.css" />
    <!-- END PAGE LEVEL  STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="../customCss/styles.css" />

    <script src="../voice.js"></script>
    <script src = "../video.js"></script>


    <script>
        function biometric() {
          document.getElementById("reg").style.display = "none";
          document.getElementById("reg_bio").style.display = "block"; //alert("done")
          document.getElementById("hide_bio").style.display = "none";

        }

        function biometricL() {
          document.getElementById("loginForm").style.display = "none";
         document.getElementById("reg_bio").style.display = "block"; //alert("done")
          //document.getElementById("hide_bio").style.display = "none";

        }

      function  bio_back() {
        document.getElementById("reg").style.display = "block";
        document.getElementById("reg_bio").style.display = "none";
        }

        function  bio_backL() {
          document.getElementById("loginForm").style.display = "block";
         document.getElementById("reg_bio").style.display = "none";
          }

        function submit_bio() {
          document.getElementById("reg").style.display = "block";
          document.getElementById("reg_bio").style.display = "none";
          document.getElementById("hide_bio").style.display = "block";
          document.getElementById("create").style.display = "block";
          document.getElementById("bio_button").style.display = "none";
          img = document.querySelector("img");
          document.getElementById("hide_bio").appendChild(img);

        }
		function createacct()
		{
			
			 document.getElementById("imageFile2").value = getBase64Image(document.getElementById("vvv"));
			 //alert(base64);
		}
    </script>


<style>
      video, img {
        max-width:35%;
      }
</style>
</head>

    <!-- END HEAD -->
