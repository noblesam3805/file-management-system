<?php $id=$this->session->userdata('reg_no');
$id = urlencode($id);
?>

<?php

$studentdata = $this->db->get_where('student', array("reg_no" => $serial))->row();

$PNG_TEMP_DIR = base_url().'temp/';

//$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;



    //html PNG location prefix

    $PNG_WEB_DIR = 'temp/';



    include "QR/qrlib.php";



	 //ofcourse we need rights to create temp dir

    if (!file_exists($PNG_TEMP_DIR)){

      //echo 'no folder';

        mkdir($PNG_TEMP_DIR,0777, TRUE);

         $filename = $PNG_TEMP_DIR.'test.png';}

         else{

         echo "impossible";

         var_dump($PNG_TEMP_DIR);}

    //processing form input

    //remember to sanitize user input in real-life solution !!!

    $errorCorrectionLevel = 'L';

    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))

        $errorCorrectionLevel = $_REQUEST['level'];



    $matrixPointSize = 4;

    if (isset($_REQUEST['size']))

        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);



		$link = "http://www.alvanportal.edu.ng/eduportal/index.php?student/qr_check/$id";

		// user data

        //$filename = $PNG_TEMP_DIR.'test'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

        $filename = 'temp/test'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

?>



<?php
$this->crud_model->clear_cache();


$serial=$this->session->userdata('serial');//Reg no



$stdntinfo = $this->db->get_where('student', array('reg_no' => $serial))->row();





$signature=$this->session->userdata('signature');//Signature

$image=$this->session->userdata('image');//Passpaort

$session=$this->session->userdata('session');//Current academic session
//$session = '2014/2015';



$fullname=$stdntinfo->name . " " . $stdntinfo->othername; //joining first name and last name

$photo = $stdntinfo->student_id;







//$date='';//date of transaction

//$dept=$this->session->userdata('dept');//students department
$dept = $stdntinfo->dept;

//$address=$this->session->userdata('address');//students address
$address = $stdntinfo->address;

$level=$this->session->userdata('level');//level of user
//$level = $stdntinfo->level;

//$phone=$this->session->userdata('phone');//phone number
$phone = $stdntinfo->phone;

//$sex=$this->session->userdata('sex');//Student Sex
//$sex = $stdntinfo->sex;

//$fullname = $this->session->userdata('fullname');

$bankcode=  $this->session->userdata('bankcode');

$bankname=  $this->session->userdata('bankname');

$branchcode= $this->session->userdata('branchcode');

$conf =   $this->session->userdata('conff');

$amount=   $this->session->userdata('amount');

$descr = $this->session->userdata('descr');

$date=   $this->session->userdata('date');//date of transaction

?>



<table id="print" width="713" height="217" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="627" height="104"><div align="center"><img src="images/alvan-logo.png"/></div></td>

  </tr>

  <tr>

    <td height="27"><div align="center"><span class="style8"><span class="style11">ALVAN IKOKU FEDERAL COLLEGE OF EDUCATION, OWERRI </span></span></div></td>

  </tr>

  <tr>

    <td height="19" valign="top"><div align="center" class="style14">

      <p><?=$session?> Fee Payment Receipt </p>

      </div></td>

  </tr>

  <tr>

    <td height="19" valign="top" >



    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style=" background-position:center; font-family:'Lucida Grande','Lucida Sans Unicode', sans-serif; font-size:14px; position:relative;">



      <tr>

        <td><table width="624" align="center" style="font-family:candara, 'Lucida Grande','Lucida Sans Unicode', sans-serif; border:0px solid #ccc; padding:10px; position:relative;">

            <tr id="print2"></tr>

            <div style="width:100%; height:500px; position:absolute; top:85px; text-align:center;"><img src="<?php echo base_url() . 'images/ALVAN.png' ?>" style="width:70%;  height:100%" /></div>

              <tr>

                <td  colspan="3">

                  <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"> <strong>PERSONAL INFORMATION</strong></p>

                <table width="580" border="0" align="center" cellpadding="4" cellspacing="5" bordercolor="#CCCCCC" >

                    <tr>

                      <td width="207">Jamb Reg No./Matric No.:&nbsp;&nbsp;</td>

                      <td width="163"><?=$serial?> </td>

                      <td width="152" rowspan="11" valign="top">

                      <div align="center">



<img src="<?php echo base_url() . 'uploads/student_image/' . $photo . '.jpg'; ?>"  style='width:150px; height:150px; border:1px solid #000;'>



                      </div>

                      <div align="center">

                       <img src="<?php echo base_url() . 'uploads/student_signature/' . $photo . '.jpg'; ?>"  style="width:150px; height:150px; border:1px solid #ccc; margin-top:4px;" />

                      </div></td>

                    </tr>

                    <tr>



                    </tr>

                    <tr>

                      <td>Name: </td>

                      <td><?=$fullname?></td>

                    </tr>

                    <tr>

                      <td>Session: &nbsp;</td>

                      <td><?=$session?></td>

                    </tr>

                    <tr>

                      <td>Etranzact Confirmation Number:</td>

                      <td ><?=$conf?></td>

                    </tr>



                    <tr>

                      <td>Department:</td>

                      <td><?=$dept?></td>

                    </tr>

                    <tr>

                      <td>Level: </td>

                      <td><?=$level?></td>

                    </tr>

                    <!--tr>

                      <td>LGA:</td>

                      <td><?php echo $row['lga']; ?></td>

                    </tr-->

                   <tr>



                      </tr>



                    <tr>

                      <td>Home Address: </td>

                      <td><?=$address?></td>

                    </tr>

                    <tr>

                      <td>Mobile No: &nbsp;</td>

                      <td><?=$phone?></td>

                    </tr>



                  </table>



                </td>

              </tr>

              <tr>

                <td colspan="3">

                   <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"><strong>School Information </strong> </p>

                      <table width="597" border="0" align="center" cellpadding="4" cellspacing="5" bordercolor="#CCCCCC">

                      <!--tr>

                        <td><div align="center"><strong>SUBJECT</strong></div></td>

                        <td><div align="left"><strong>SCORE</strong></div></td>

                      </tr-->



				      <tr style="margin-bottom:15px; float:left;">

                        <td width="220">School Name:</td>

                        <td width="336">ALVAN IKOKU FEDERAL COLLEGE OF EDUCATION, OWERRI</td>

                      </tr>

                      <tr style="margin-bottom:15px; float:left;">

                        <td width="220">Purpose of Payment : </td>

                        <td width="336"><?=$descr?></td>

                      </tr>

                      <!--tr>

                        <td>Location : </td>

                        <td><?=$location?></td>

                      </tr-->









                    </table>



                 <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"> <strong>Bank Details</strong></p>



	                <table width="584"  border="0" align="center" cellpadding="5" cellspacing="5">



   <tr>

                        <td width="211">Bank Name: </td>

                        <td width="206"><?=$bankname?></td>

                        <td width="117" rowspan="4" valign="top"><?php  echo '<img src="'.$filename.'"; />' ?></td>

                      </tr>

                      <tr>

                        <td>Bank Branch:</td>

                        <td><?=$branchcode?></td>

                      </tr>

                      <tr>

                        <td>Transaction Amount: </td>

                        <td><?=$amount?></td>

                      </tr>

                      <tr>

                        <td>Date/Time of Transaction: </td>

                        <td><?=$date?></td>

                      </tr>

                      <tr>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                      </tr>

                  </table>

                 </td>

              </tr>

              <tr>

                <td colspan="2"></td>

                <td width="212"></td>

              </tr>

              <tr>

                <td colspan="2"></td>

                <td></td>

              </tr>



            </table>

            <table width="624" align="center" style="font-family:candara, 'Lucida Grande','Lucida Sans Unicode', sans-serif;padding:10px">

            <tr>

                <td width="86"></td>

                <td width="10"></td>

                <td width="512"></td>

              </tr>

            </table>

            </td>

      </tr>

    </table>



    </td>

    </tr>

</table>

<table width="624" align="center" style="font-family:candara, 'Lucida Grande','Lucida Sans Unicode', sans-serif;padding:10px">

            <tr>

                <td width="86"></td>

                <td width="10"></td>

                <td width="512"><ul class="list-unstyled wizard">

												<li class="pull-right next myclass"><button type="button" onclick="printDiv()" class="btn btn-primary">Print</button></li>

											</ul></td>

              </tr>

            </table>

			

			<?php

				session_destroy();

			?>