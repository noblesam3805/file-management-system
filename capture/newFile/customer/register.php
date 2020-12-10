<?php include_once "header.php"; ?>
<!--PAGE CONTENT -->



          <div class="row" id ="reg">
                <div class="col-lg-3"></div>
                <div class="col-lg-5">
                <h3 style="padding-top:30px; text-align:center">Account Opening Form</h3>
                  <form role="form" id = "accountForm" style="padding-top:30px;" action="registered.php" method = "post">
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
                                    <input type="text" class="form-control" placeholder="Address" name="address"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="email" class="form-control" placeholder="Email Address" name="email"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="phone" name="phone"/>
                                </div>

                                <div class="form-group input-group">
                                    <select name = "gender">
                                      <option value = "gender">Gender</option>
                                      <option value = "male">Male</option>
                                      <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group input-group">
                                    <select name = "marital_status">
                                      <option value = "gender">Marital Status</option>
                                      <option value = "male">Married</option>
                                      <option value="female">Single</option>
                                      <option value="female">Devorced</option>
                                    </select>
                                </div>

                                 <div class="form-group input-group">
                                    <input type="date" class="form-control" placeholder="Date of Birth" name="dob"/>
                                </div>

                                <input type="submit" class="btn btn-success" name="create_account" value="Create Account" id ="create" style="display:none"/>
                                <a href = "#" class="btn btn-success" onclick = "biometric()" id="bio_button">Click for Biometric</a>

                                <div class="form-group input-group" style="visibility:hidden">
                                   <input type="file" class="form-control"  name="passport"/>
                               </div>
                               <div class="form-group input-group" style="visibility:hidden">
                                   <input type="text" class="form-control"  name="bio_pass" id="bio_pass"/>
                               </div>

                            </form>

                </div>

                <div class="col-lg-4">
                  <div id ="hide_bio" style="display:none">
                    <h3>Biometric Data</h3>
                    <div style = "width:80%; height:300px; background-color:black; color:white; font-size:2em; margin-left:70px" id="bio_data">
                    </div>
                </div>

            </div>
          </div>


            <div class="row" id = "reg_bio" style="display:none">
                  <div class="col-lg-1"></div>
                  <div class="col-lg-4">
                    <h3>Voice Input</h3>
                    <div style = "width:80%; height:300px; background-color:black; color:white; font-size:2em; margin-left:70px" id="speech">

                    </div>
                    <button class="btn btn-success" onclick="bio_back()" style="margin-left:20%;">Back</a>

                    <button class="btn btn-success"  style="margin-left:20%;" onclick="talk()">Click to Record</button>

                    <button class="btn btn-success" style="margin-left:80%;" onclick="submit_bio()">Submit</button>
                  </div>
                  <div class="col-lg-6" id="vid">
                    <video autoplay></video>
                    <img id = "vvv"/>
                      <button onclick = "videoCapture()" class="btn btn-success">Click to snapshot</button>
                  </div>
                  <div class="col-lg-1"></div>
              </div>


              <input type="text" id = "imageFile" name="imageFile" />


     </body>
     </html>
