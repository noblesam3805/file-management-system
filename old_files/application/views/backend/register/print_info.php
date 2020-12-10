<?php $id=$this->session->userdata('reg_no');
$id = urlencode($id);

?>




<?php

$serial=$this->session->userdata('serial');//Reg no

$image=$this->session->userdata('image');//Passpaort

$session=$this->session->userdata('session');//Current academic session

$dept=$this->session->userdata('dept');//students department

$fullname=$this->session->userdata('fullname');//students department
//$dept = $stdntinfo->dept;

$address=$this->session->userdata('address');//students address

$level=$this->session->userdata('level');//level of user

$phone=$this->session->userdata('phone');//phone number

$sex=$this->session->userdata('sex');//Student Sex

$email = $this->session->userdata('email');

$dob=   $this->session->userdata('dob');//date of transaction

?>	

			<?php

				session_destroy();

			?>

      <style type="text/css">
    body{
      background:#f0f0f0 !important;
    }
    .document{
      width:100%;
      float:left;
    }
    .document header{
      padding:10px 0;
      float:left;
      width:100%;
      border-bottom:3px solid #616F87;
    }
    .document header img{
      margin-left:100px;
    }
    .no-r{
      border-radius:2px !important;
      padding:10px !important;
      background:#616F87 !important;
      border:1px solid #616F87 !important;
    }
    .row{
      margin:0;
      padding:10px 0;
      float:left;
      width:100%;
    }
    .stud-detail{
      min-height:120px;
      box-shadow:1px 1px 1px silver;
      width:99%;
      margin:-7px auto;
      float:none;
      border-left-bottom-radius:3px;
      border-right-bottom-radius:3px;
      background:#fff;
      /*border-right:1px solid #d4d4d4;
      border-left:1px solid #d4d4d4;
      border-bottom:1px solid #d4d4d4;*/
      
    }
    .no-m{
      margin-bottom:0px;
    }
    .l-minHeight{
      min-height:28px;
    }
    .navbar .s-font{
      font-size:17px;
    }
    .m-top{
      margin-top:10px;
    }
    .m-top p:first-child{
      margin-top:8px;
    }
    .m-top1 img{
      border-radius:3px;
      display:inline-block;
      border:1px solid #f0f0f0;
      padding:2px;
      width:100px;
      float:left;
    }
    .m-top1 p{
      display:inline-block;
    }
    img{
      max-width:inherit;
    }
    .sec-row{
      background:#e4e4e4;
      padding:10px;
      border-radius:5px;
      min-height:200px;
      width:100%;
      float:left;
      margin:20px 0;
    }
  </style>

        <div class="document">

      <header style="background:#303641;">
                <div class="col-md-10 middle header-div" style="border-right:0px groove silver;">
          <div class="col-md-8 logo-div">
            <img src="assets/images/eduportal.png" width="150px"/>
            <a href="<?php echo base_url(); ?>"></a>
          </div>
          <div class="col-md-4">
            
          </div>
        </div>
        </header>
      <div class="row">
        <div class="col-md-10 no-m" style="margin:auto !important; float:none !important;">
          <div class="navbar no-m" >
            <div class="navbar-inner l-minHeight">
            <div class="container">
              <a class="brand s-font" href="#"><span class="icon-user"></span>Student Details</a>
            </div>
            </div>
          </div>
          <div class="col-md-12 stud-detail">
            <div class="col-md-4 m-top1 m-top">
                <img src="<?php echo $image;?>" width="100px" height="100px"/>  
            </div>
            <div class="col-md-4 m-top column2">
              <p><strong>Reg No:</strong> <?php echo $serial;?></p>
              <p><strong>Full Name:</strong><?php echo $fullname;?></p>
              <p><strong>Address:</strong><?php echo $address;?></p>
              <p><strong>Phone:</strong> <?php echo $phone;?></p>
            </div>
            <div class="col-md-4 m-top">
              <p><strong>Birth Date:</strong> <?php echo $dob;?></p>
              <p><strong>Status:</strong> Active</p>
              <p><strong>Sex:</strong> <?php echo $sex;?></p>
              <p><strong>Email:</strong> <?php echo $email;?></p>
            </div>
          </div>
        </div>  
        
        <hr style="border-top:2px groove #fff; width:100%; float:left;"/>
        
        <div class="col-md-10 no-m" style="margin:auto !important; float:none !important;">
          <div class="sec-row">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content"><h4>2014/2015 Payment Information</h4>
                  <div class="tab-pane box active" id="list">
                    <table  class="table table-bordered datatable" id="table_export">
                      <thead>
                        <tr>
                        <th><div><?php echo get_phrase('#');?></div></th>
                        <th><div><?php echo get_phrase('Reg_no');?></div></th>
                        <th><div><?php echo get_phrase('purpose_of_payment');?></div></th>
                        <th><div><?php echo get_phrase('Bank_name');?></div></th>
                        <th><div><?php echo get_phrase('_amount (₦)');?></div></th>
                        <th><div><?php echo get_phrase('_session');?></div></th>
                        <th><div><?php echo get_phrase('date');?></div></th>
                        </tr>
                        </thead>
                        <tbody><?php $i =1; ?>
                        <?php foreach($new_fees as $row):?>
                        <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['customer_id'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['bankname'];?></td>
                        <td>₦ <?php echo $row['amount'];?></td>
                        <td><?php echo $row['session'];?>
                        </td>
                        <!--td><?php //echo date('d M,Y', $row['payment_date']);?></td-->
                        <td><?php echo $row['payment_date'];?></td>
                        </tr><?php $i++;?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <div class="row"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
          <div class="sec-row">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content"><h4>School Fees before 2014/2015 session</h4>
                  <div class="tab-pane box active" id="list">
                    <table  class="table table-bordered datatable" id="table_export">
                      <thead>
                        <tr>
                          <th><div><?php echo get_phrase('#');?></div></th>
                        <th><div><?php echo get_phrase('Reg_no');?></div></th>
                        <th><div><?php echo get_phrase('purpose_of_payment');?></div></th>
                        <th><div><?php echo get_phrase('Bank_name');?></div></th>
                        <th><div><?php echo get_phrase('_amount (₦)');?></div></th>
                        <th><div><?php echo get_phrase('_session');?></div></th>
                        <th><div><?php echo get_phrase('date');?></div></th>
                        </tr>
                        </thead>
                        <tbody><?php $i =1; ?>
                        <?php foreach($old_fees as $row):?>
                        <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['customer_id'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['bankname'];?></td>
                        <td>₦ <?php echo $row['amount'];?></td>
                        <td><?php echo $row['session'];?>
                        </td>
                        <!--td><?php //echo date('d M,Y', $row['payment_date']);?></td-->
                        <td><?php echo $row['payment_date'];?></td>
                        </tr><?php $i++;?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <div class="row"><b><p></p> </b> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="sec-row">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content"><h4>Accomodation Information 2014/2015 session</h4>
                  <div class="tab-pane box active" id="list">
                    <table  class="table table-bordered datatable" id="table_export">
                      <thead>
                      <tr>
                        <th><div><?php echo get_phrase('Reg_NO');?></div></th>
                        <th><div><?php echo get_phrase('Hostel Name');?></div></th>
                        <th><div><?php echo get_phrase('Room_Number');?></div></th>
                        <th><div><?php echo get_phrase('Bed Space');?></div></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($hostel as $row):?>
                      <tr>
                        <td><?php echo $row['idno'];?></td>
                        <td><?php echo $row['hostel_name'];?></td>
                        <td><?php echo $row['room_no'];?></td>
                        <td><?php echo $row['space'];?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                    </table>
                    <div class="row"><b><p></p> </b> </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>  
          
        </div>  
      </div>
    </div>