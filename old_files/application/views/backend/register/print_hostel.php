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

		$link = "http://www.alvanportal.edu.ng/authenticate?r=$serial";
		// user data
        //$filename = $PNG_TEMP_DIR.'test'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        $filename = 'temp/test'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
?>

<?php

$serial=$this->session->userdata('reg_no');//Reg no
$signature=$this->session->userdata('signature');//Signature
$image=$this->session->userdata('image');//Passpaort
$session='2014/2015';//Current academic session
$fullname=$this->session->userdata('name');

/*
$this->db->select('*');
$this->db->from('counter a,student b');
$this->db->where('a.idno = b.reg_no',NULL,FALSE);
$this->db->where('a.idno',$reg_no);
$query = $this->db->get();
*/

$studentInfo = $this->db->get_where('student', array("reg_no" => $serial))->row();

//joining first name and last name
$date= date('Y - m - d');//date of transaction


$fullname=$studentInfo->othername . ' ' . $studentInfo->name;
$dept=$studentInfo->dept;//students department
$level=$studentInfo->level;//level of user
$phone=$studentInfo->phone;//phone number
$sex=$studentInfo->sex;//Student Sex
//var_dump($sex);

$hostel_name=$studentInfo->hostel_name;//hostel name
$room_no=$studentInfo->room_number;//room number allocated
$space_no = $studentInfo->bed_space_no;

$getserial = $this->db->get_where('counter', array("idno" => $serial, "hostel_name" => $hostel_name, "room_no" => $room_no, "space" => $space_no))->row();


$scratch_serial=$getserial->serial;//serial number on the scratch card

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
      <p><?=$session?> Hostel Allocation Receipt </p>
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
                      <td width="207">Registration No.:&nbsp;&nbsp;</td>
                      <td width="163"><?=$serial?> </td>
                      <td width="152" rowspan="11" valign="top">
                      <div align="center">

<img src="<?=$image?>"  style='width:150px; height:150px; border:1px solid #000;'>

                      </div>
                      <div align="center">
                       <img src="<?=$signature?>"  style="width:150px; height:150px; border:1px solid #ccc; margin-top:4px;" />
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
                      <td></td>
                      <td ></td>
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
                      <td>Sex: </td>
                      <td><?=$sex?></td>
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
                   <p class="spev" style="margin:15px 0; width:80%; font-size:19px;"><strong> </strong> </p>


                 <p class="spev" style="margin:15px 0; border-bottom:1px dashed #000;width:80%; font-size:19px;"> <strong>Hostel Infomation</strong></p>

	                <table width="584"  border="0" align="center" cellpadding="5" cellspacing="5">

   <tr>
                        <td width="211">Hostel Name: </td>
                        <td width="206"><?=$hostel_name?></td>
                        <td width="117" rowspan="4" valign="top"><?php  echo '<img src="'.$filename.'"; />' ?></td>
                      </tr>
                      <tr>
                        <td>Room Number:</td>
                        <td><?=$room_no?></td>
                      </tr>
                      <tr>
                        <td>Space Number:</td>
                        <td><?=$space_no?></td>
                      </tr>
                      <tr>
                        <td>Scratch Card Serial: </td>
                        <td><?=$scratch_serial?></td>
                      </tr>
                      <tr>
                        <td>Date/Time of Print: </td>
                        <td><?=$date?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                  </table>
                 </td>
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
                
                <td width="592" style="font-size:16px; color:#9d0000;">
                  <br/>NOTE: Your Effective Date for moving into your Room and Space begins on the 9th of March 2015
                </td>
                <td width="6"></td>
                <td width="10"></td>
              </tr>
            <tr>
                <td width="86"></td>
                <td width="10"></td>
                <td width="512"><ul class="list-unstyled wizard">
												<li class="pull-right next myclass"><button type="button" style="z-index:999;" onclick="printDiv()" class="btn btn-primary">Print</button></li>
											</ul></td>
              </tr>
            </table>