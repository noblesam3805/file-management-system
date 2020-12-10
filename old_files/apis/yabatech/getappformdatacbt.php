<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL & ~E_NOTICE);
include 'remita_constants.php';
include 'kee.php';
$payerID=$_POST["payerID"];
$payername=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid=$_POST["orderId"];
$paymentID=$_POST["paymentID"];
$paymentName=$_POST["paymentName"];
$responseurl="http://www.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$amt=$_POST["amt"];
$acadsession=$_POST["acadsession"];
$paymentdescription=$_POST["paymentdescription"];
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $paymentName." FOR ".$payername;
$_SESSION["payment_name"] = $paymentName;
//if($_SERVER['HTTP_REFERER'] =="http://localhost:21235/ALVAN_UTMECBT_APP/Webservice.aspx")
if($_SERVER['HTTP_REFERER'] =="http://www.yabatech.edu.ng/yctpay/" || $_SERVER['HTTP_REFERER'] =="http://www.yabatech.edu.ng/yctpay/default.aspx")
{
if($paymentID==21)
{
$query= sqlsrv_query($conn,"select * from applicationinvoice_gen where sid='$Orderid'") or die
(sqlsrv_errors());

						if(sqlsrv_num_rows($query) > 0){
	$query2= sqlsrv_query("select * from applicationinvoice_gen where sid='$Orderid' limit 1") or die
(print_r( sqlsrv_errors(), true));
						while(list($id,$payername,$payeremail,
					
$payerphone,$orderid,$paymentid,$amt,$acadsession,$paymentdescription,$paymentName,$rem,$dategenerated)=sqlsrv_fetch_array($query2))
						{
?>
<form action="choosePaymentMethod.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rem;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
                  <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
                       </form>

  <?php
						}?>
                            <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm1").submit();</script>
  <?php
						
					}
						else	
				{

$totalAmount = $amt;
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = $_POST["payerName"];
$payerEmail = $_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$responseurl = "http://45.34.15.68/getRemitaResponse.php";
//$responseurl = "http://45.34.15.68/apis/yabatech/getRemitaResponse.php";
$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
$itemid1="itemid1";
$itemid2="34444".$itemtimestamp;
$itemid3="8694".$itemtimestamp;
$beneficiaryName="Oshadami Mke";
$beneficiaryName2="Mujib Ishola";
$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0360883515";
$beneficiaryAccount2="4017904612";
$beneficiaryAccount3="4017904612";
$bankCode="011";
$bankCode2="050";
$bankCode3="070";
$beneficiaryAmount ="900";
$beneficiaryAmount2 ="50";
$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
$deductFeeFrom3=0;
//The JSON data.
$content = '{"merchantId":"'. MERCHANTID
.'"'.',"serviceTypeId":"'.SERVICETYPEID
.'"'.",".'"totalAmount":"'.$totalAmount
.'","hash":"'. $hash
.'"'.',"orderId":"'.$orderID
.'"'.",".'"responseurl":"'.$responseurl
.'","payerName":"'. $payerName
.'"'.',"payerEmail":"'.$payerEmail
.'"'.",".'"payerPhone":"'.$payerPhone
.'","lineItems":[
{"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"},
{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"},
{"lineItemsId":"'.$itemid3.'","beneficiaryName":"'.$beneficiaryName3.'","beneficiaryAccount":"'.$beneficiaryAccount3.'","bankCode":"'.$bankCode3.'","beneficiaryAmount":"'.$beneficiaryAmount3.'","deductFeeFrom":"'.$deductFeeFrom3.'"}
]}';
$curl = curl_init(GATEWAYURL);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
// Disable SSL verification
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$jsonData = substr($json_response, 6, -1);
$response = json_decode($jsonData, true);
$statuscode = $response['statuscode'];
$statusMsg = $response['status'];
if($statuscode=='025'){
$rrr = trim($response['RRR']);
$new_hash_string = MERCHANTID . $rrr . APIKEY;
$new_hash = hash('sha512', $new_hash_string);
//echo $response;
$date =date('Y-m-d H:i:s');
$sql = "INSERT INTO applicationinvoice_gen (payername,payeremail,payerphone,orderid,paymentid,amt,acadsession,paymentdescription,paymentName,rrr,dategenerated,status,sid,payerID) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array("$payerName","$payerEmail","$payerPhone","$orderID","$paymentID","$amt","$acadsession","$description","$paymentName","$rrr","$date","Payment Reference generated","$Orderid","$payerID");
$query = sqlsrv_query($conn,$sql,$params);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close($conn);
?>
<form action="choosePaymentMethod.php" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="http://localhost/YABATECH/apis/yabatech/getRemitaResponse.php" type="hidden"> 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
<?php }
else{
	
	?>
<form action="rrrgen.php" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>
<?php
}

			}
	exit;		
}
if($paymentID==1)
{
	?>
    <form action="getappformdata_putme.php" name="SubmitRemitaForm3" id="SubmitRemitaForm3" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm3").submit();</script>
    
    <?php
	exit;
}
if($paymentID==3)
{
	?>
   <form action="getappformdata_changecourse.php" name="SubmitRemitaForm4" id="SubmitRemitaForm4" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm4").submit();</script> 
    <?php
	exit;
}
if($paymentID==6)
{
	?>
       <form action="getappformdata_hostelapp.php" name="SubmitRemitaForm5" id="SubmitRemitaForm5" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm5").submit();</script> 
    <?php
	exit;
}
if($paymentID==7)
{
	?>
      <form action="getappformdata_hostelfee.php" name="SubmitRemitaForm6" id="SubmitRemitaForm6" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm6").submit();</script> 
    <?php
	exit;
}
if($paymentID==18)
{
	?>
      <form action="getappformdata_putme.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}

if($paymentID==5)
{
	?>
      <form action="getappformdata_schoolfee.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}

if($paymentID==4)
{
	?>
      <form action="getappformdata_acpfee.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}
if($paymentID==48)
{
?>
      <form action="getappformdata_damagefee.php" name="SubmitRemitaForm8" id="SubmitRemitaForm8" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm8").submit();</script> 
    <?php
	exit;
	

}
if($paymentID==2)
{
?>
      <form action="getappformdata_applicationform.php" name="SubmitRemitaForm9" id="SubmitRemitaForm9" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm9").submit();</script> 
    <?php
	exit;
	

}

if($paymentID==701)
{
?>
      <form action="getappformdata_hostelfeebalance.php" name="SubmitRemitaForm10" id="SubmitRemitaForm10" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm10").submit();</script> 
    <?php
	exit;
	

}
if($paymentID !=21 || $paymentID !=1 || $paymentID !=2 || $paymentID !=3 || $paymentID !=6 || $paymentID !=7 || $paymentID !=18 || $paymentID !=5 || $paymentID !=4 || $paymentID !=48 || $paymentID !=701)
{
	?>
 <form action="getappformdata_otherfees.php" name="SubmitRemitaForm8" id="SubmitRemitaForm8" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm8").submit();</script> 

<?php
}
}
else
{
	echo "Sorry Request Denied by Remote Server! Please Try Again Later";
}
sqlsrv_close($conn);
?>