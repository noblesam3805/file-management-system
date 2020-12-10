<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Customer Registration </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/css/layout2.css" rel="stylesheet" />
       <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />
       <link rel="stylesheet" href="assets/plugins/timeline/timeline.css" />
    <!-- END PAGE LEVEL  STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="customCss/styles.css" />
</head>

    <!-- END HEAD -->
<!--PAGE CONTENT -->
        
            

          <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-5">
                <h3 style="padding-top:30px; text-align:center">Account Opening Form</h3>
                  <form role="form" id = "accountForm" style="padding-top:30px;">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Surname" name="surname"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Mother's maiden Name" name="maiden_name"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Occupation" name="occupation"/>
                                </div>
                                <div class="form-group input-group">
                                    <select name = "gender">
                                      <option value = "gender">Gender</option>
                                      <option value = "male">Male</option>
                                      <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group input-group">
                                    <select name = "gender">
                                      <option value = "gender">Marital Status</option>
                                      <option value = "male">Married</option>
                                      <option value="female">Single</option>
                                      <option value="female">Devorced</option>
                                    </select>
                                </div>

                                 <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Date of Birth" name="dob"/>
                                </div>

                                     <input type="submit" class="btn btn-success" name="create_account" value="Click for Biometric"/>
                            </form>
                </div>
                <div class="col-lg-4"></div>
                
            </div>



     
     </body>
     </html>