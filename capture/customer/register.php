<?php include_once "header.php"; ?>
<!--PAGE CONTENT -->



          <div class="row" id ="reg">
                <div class="col-lg-3"></div>
                <div class="col-lg-5">
                <h3 style="padding-top:30px; text-align:center">Virtual Meeting</h3>
                  <form role="form" id = "accountForm" style="padding-top:10px;" action="registered.php" method = "post">
                                
 <input type="hidden" name="idx" value="<?php echo $_GET["id"];?>"/>
                                

                              	   <a href = "#" class="btn btn-success" onclick = "biometric()" id="bio_button" >Click to Enable Video</a>

                               

                         

 </form>
                </div>

                <div class="col-lg-4">
                  <div id ="hide_bio" style="display:none">
                    <h3>Biometric Data</h3>
                    <div style = "width:100%; height:250px; background-color:black; color:white; font-size:2em; margin-left:70px" id="bio_data">
                    </div>
                </div>

            </div>
          </div>


            <div class="row" id = "reg_bio" >
                  <div class="col-lg-1"></div>
                  <div class="col-lg-4">
                    <h3>Voice Input</h3>
                 
                    </div>
               

                    <button class="btn btn-success"  style="margin-left:20%;" onclick="talk()">Enable Audio</button>

                  
                  </div>
                  <div class="col-lg-6" id="vid">
                    <video autoplay></video>
                    <img id = "vvv"/>
                      <button onclick = "videoCapture()" class="btn btn-success">Start Camera</button>
					    <button onclick = "takeSnapshot()" class="btn btn-success">Take snapshot</button>
                  </div>
                  <div class="col-lg-1"></div>
				      
              </div>


     



     </body>
     </html>
