<?php $id=$this->session->userdata('reg_no');
$id = urlencode($id);
?>

<?php

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


$semester=$this->session->userdata('semester');//Current academic session
//$session = '2014/2015';



$fullname=$stdntinfo->name . " " . $stdntinfo->othername; //joining first name and last name

$photo = $stdntinfo->student_id;

$dept=$this->session->userdata('dept');//students department

$prog_type=$this->session->userdata('prog_type');//students department
//$dept = $stdntinfo->dept;

$address=$this->session->userdata('address');//students address
//$address = $stdntinfo->address;

$level=$this->session->userdata('level');//level of user
//$level = $stdntinfo->level;

$phone=$this->session->userdata('phone');//phone number

?>
<style type="text/css">
	.table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
	  color: #202123 !important;
	}
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #B9B5B5 !important;
}
</style>


<table style="background:#fff; box-shadow:1px 1px 1px silver; margin:5px auto;" id="print" width="713" height="217" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="627" height="104"><div align="center"><img src="images/alvan-logo.png"/></div></td>

  </tr>

  <tr>

    <td height="27"><div align="center"><span class="style8"><span class="style11">ALVAN IKOKU UNIVERSITY OF EDUCATION, OWERRI </span></span></div></td>

  </tr>

  <tr>

    <td height="19" valign="top"><div align="center" class="style14">

      <p style="font-size:13px"><strong>Course Registration for the <?=($semester == 1) ? 'First' : 'Second';?> semester of the <?=$session?> Session</strong></p>

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

                      <td width="207">Reg No.:&nbsp;&nbsp;</td>

                      <td width="163"><?=$serial?> </td>

                      <td width="152" rowspan="11" valign="top">

                      <div align="center">



                      <img src="<?=$image?>"  style='width:150px; height:150px; border:1px solid #000;'>



                      </div>

                      <div align="center">

                       <img src="<?=$filename?>"  style="width:150px; height:150px; border:1px solid #ccc; margin-top:4px;" />

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

                      <td>Department:</td>

                      <td><?=$dept?></td>

                    </tr>
<tr>

                      <td>Programme Type:</td>

                      <td><?=$prog_type?></td>

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

                  </table>



                </td>

              </tr>

              <tr>

                <td colspan="3">

                   <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"><strong>Registered Courses </strong> </p>

                      <table  class="table table-bordered datatable">
                    <thead>
                        <tr>
                        <th><div><?php echo get_phrase('#');?></div></th>
                        <th><div><?php echo get_phrase('course_code');?></div></th>
                        <th><div><?php echo get_phrase('course_title');?></div></th>
                        <th><div><?php echo get_phrase('Credit Load');?></div></th>
                        <th><div><?php echo get_phrase('Remarks');?></div></th>
                        </tr>
                    </thead>
                    <tbody><?php $i =1; ?>
                        <?php foreach($courses as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['course_code'];?></td>
                            <td><?php echo $row['course_name'];?></td>
                            <td><?php echo ($row['credit_load'] != '') ? $row['credit_load'] : 'Not Available';?></td>
                            <td></td>
                        </tr><?php $i++;$current_load += $row['credit_load'];?>
                        <?php endforeach;?>
                        <tr ><td></td><td><strong>Total Credit Load</strong></td><td></td><td style="font-size:15px;"><strong><?php echo $current_load;?></strong></td><td></td></tr>
                    </tbody>
                </table>


                <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:94%; font-size:19px;"> <strong> <?php if($confirmed == '1'){ echo 'Confirmed By:'; }else{ echo 'Processed By:'; } ?> </strong> <?=$admin?> on <?=$time?></p>

                 <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"> <strong> <?php if($confirmed == '1'){ echo 'Approved By:' ; }else{ echo 'Signed and Verified By:' ; } ?> </strong> <?=$adviser?> </p>

	                <table width="584"  border="0" align="center" cellpadding="5" cellspacing="5">
                    <tr>
                      <td width="411" style"margin:15px 0; text-align:center; border-bottom:1px dashed #000;width:80%;font-size:18px; ">Academic Advisor</td>
                    </tr>
                    <tr><?php if($confirmed != '1'){ ?>
                      <td><p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"> </td>
                        <?php } ?>
                    </tr>
                    <tr><?php if($confirmed != '1'){ ?>
                      <td width="580" style"margin:15px 0; border-bottom:1px dashed #000;width:80%;font-size:13px; ">**<u>PLEASE NOTE</u> This printout is subject to further review and approval by your academic advisor. After review, your Academic Advisor must sign against his/her name to show approval. You must return the signed copy to the ICT department in order to recieve a final printout. THANK YOU</td> 
                        <?php } ?>
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

<table width="624" style="margin-bottom:5px;" align="center" style="font-family:candara, 'Lucida Grande','Lucida Sans Unicode', sans-serif;padding:10px">

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