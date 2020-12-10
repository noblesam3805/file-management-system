
<?php include_once "header.php"; ?>

 <div class = "row" id ="loginForm">

   <div class="col-md-4"></div>
   <div class="col-md-4">
     <h3>LOGIN TO INTERNET BANKING</h3>
     <form action = "application.php?Login=1" method = "post" id="login">
       <div class="form-group input-group">
           <input type="text" class="form-control" placeholder="user ID or account number" name="account_num" required="required"/>
       </div>
       <div class="form-group input-group">
           <input type="password" class="form-control" placeholder="Password" name="password"/>
       </div>
       <div class="form-group input-group">
           <input type="text" class="form-control" placeholder="bio data" id = "bio_pass" name="bio_pass" style="color:blue;visibility:hidden"/>
           <div id="bio_data" style="visibility:hidden"></div>
       </div>
       <a href = "#" class="btn btn-success" onclick = "biometricL()" id="bio_button">Continue</a>

</form>
   </div>
   <div class="col-md-4">

   </div>

 </div>


 <div class="row" id = "reg_bio" style="display:none">
       <div class="col-lg-3"></div>
       <div class="col-lg-6">
         <h3>Voice Authentication</h3>
         <div style = "width:80%; height:300px; background-color:black; color:white; font-size:2em; margin-left:70px" id="speech">

         </div>
         <button class="btn btn-success" onclick="bio_backL()" style="margin-left:20%;">Back</a>

         <button class="btn btn-success"  style="margin-left:20%;" onclick="talk()">Click to Record</button>

         <button class="btn btn-success" style="margin-left:80%;" onclick="login()">Login</button>
       </div>

       <div class="col-lg-3"></div>

   </div>

   <script>
    function login(){
      document.getElementById("login").submit();
    }
   </script>
