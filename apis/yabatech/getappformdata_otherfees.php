<?php
session_start();
include 'includes/remita_constants_otherfees.php';
include 'kee.php';
error_reporting(E_ALL & ~E_NOTICE);
$payerID=$_POST["payerID"];
$payername=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid=$_POST["orderId"];
$paymentID=$_POST["paymentID"];
$paymentName=$_POST["paymentName"];
$responseurl="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$amt=str_replace(',', '', $_POST["amt"]);
$acadsession=$_POST["acadsession"];
$paymentdescription=$_POST["paymentdescription"];
$programName=$_POST["programName"];
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
echo $_SERVER['HTTP_REFERER'];
if($paymentID==205)
{
$description= $paymentdescription." FOR ".$payername;
}
else
{
	$description= $paymentName." FOR ".$payername;
}
$_SESSION["payment_name"] = $paymentName;
if($_SERVER['HTTP_REFERER'] =="http://erp.yabatech.edu.ng/portal/index.php?register/getappformdata")
{
if($paymentID==65)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
	define("SERVICETYPEID", "2255499418");

}
if($paymentID==205)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255504056");
}



if($paymentID==3)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255371391");
}
if($paymentID==9)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255375055");
}

if($paymentID==10)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255375708");
}

if($paymentID==11)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255375921");
}
if($paymentID==12)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255376107");
}
if($paymentID==13)
{
$ben1amt=$amt - 0;
   $ben2amt=0;
define("SERVICETYPEID", "2255376425");
}
if($paymentID==14)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255376637");
}
if($paymentID==15)
{
	//$ben1amt=$amt - 1000;
    //$ben2amt=1000;
define("SERVICETYPEID", "2255504056");
}
if($paymentID==16)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255376846");
}
if($paymentID==17)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255377037");
}
if($paymentID==18)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255377294");
}
if($paymentID==19)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255378024");
}
if($paymentID==20)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255378252");
}
if($paymentID==21)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255378554");
}
if($paymentID==22)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255378756");
}
if($paymentID==23)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255379049");
}
if($paymentID==24)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255379377");
}
if($paymentID==25)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255380846");
}
if($paymentID==26)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381037");
}
if($paymentID==27)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381327");
}
if($paymentID==28)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381605");
}
if($paymentID==29)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381860");
}
if($paymentID==30)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255383631");
}
if($paymentID==31)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255383837");
}
if($paymentID==32)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255384174");
}
if($paymentID==33)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255385940");
}
if($paymentID==34)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255486562");
}
if($paymentID==35)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255486904");
}
if($paymentID==36)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255487162");
}
if($paymentID==37)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255487351");
}
if($paymentID==38)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255489205");
}
if($paymentID==39)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255490528");
}
if($paymentID==40)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255490753");
}
if($paymentID==41)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255490971");
}
if($paymentID==42)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255491239");
}
if($paymentID==43)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255492037");
}
if($paymentID==44)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255492174");
}
if($paymentID==45)
{
$ben1amt=$amt - 0;
   $ben2amt=0;
define("SERVICETYPEID", "2255492387");
}
if($paymentID==46)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255493610");
}
if($paymentID==47)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255493785");
}

if($paymentID==49)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255495259");
}
if($paymentID==50)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255495485");
}
if($paymentID==51)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255495735");
}
if($paymentID==52)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255495983");
}
if($paymentID==53)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255496221");
}
if($paymentID==54)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255496474");
}
if($paymentID==55)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255496772");
}
if($paymentID==56)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255497456");
}
if($paymentID==57)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255497806");
}
if($paymentID==58)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255498145");
}
if($paymentID==59)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255504056");
}
if($paymentID==60)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255498591");
}
if($paymentID==61)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255499418");
}
if($paymentID==62)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255499669");
}
if($paymentID==63)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255499966");
}
if($paymentID==64)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255500380");
}
if($paymentID==66)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255504056");
}
if($paymentID==201)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255500626");
}
if($paymentID==202)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255500922");
}
if($paymentID==203)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255501186");
}
if($paymentID==204)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255501516");
}
if($paymentID==261)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381037");
}
if($paymentID==262)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255502065");
}
if($paymentID==311)
{
	$ben1amt=$amt - 0;
   $ben2amt=0;
define("SERVICETYPEID", "2255502434");
}
if($paymentID==321)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255502803");
}
if($paymentID==381)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;

}
if($paymentID==391)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;

}
if($paymentID==705)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2977870623");
}
if($paymentID==707)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2977871644");
}
if($paymentID==68)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "2255381037");
}
if($paymentID==709)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "3180340597");
}
if($paymentID==708)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "3180343691");
}
if($paymentID==710)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "3180345039");
}
if($paymentID==713)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "620533563");
}
if($paymentID==69)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "3365005561");
}
if($paymentID==70)
{
	$ben1amt=$amt - 0;
    $ben2amt=0;
define("SERVICETYPEID", "3586612266");
}
	
$query= sqlsrv_query($conn,"select * from applicationinvoice_gen where sid='$Orderid'") or die
(sqlsrv_errors());

						if(sqlsrv_num_rows($query) > 0){
	$query2= sqlsrv_query("select * from applicationinvoice_gen where sid='$Orderid'") or die
(print_r( sqlsrv_errors(), true));
						while(list($id,$payername,$payeremail,
					
$payerphone,$orderid,$paymentid,$amt,$acadsession,$paymentdescription,$paymentName,$rem,$dategenerated)=sqlsrv_fetch_array($query2))
						{
?>
<form action="https://erp.yabatech.edu.ng/portal/index.php?register/choosePaymentMethod" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
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
$responseurl = "https://erp.yabatech.edu.ng/portal/apis/yabatech/getRemitaResponse.php";
$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
$itemid1="itemid1";
$itemid2="34444".$itemtimestamp;
$itemid3="8694".$itemtimestamp;
$beneficiaryName="Yaba College of Technology";
$beneficiaryName2="GTCO Calscan Nigeria Limited";
//$beneficiaryName3="Ogunseye Olarewanju";
if($paymentID==70)
{
$beneficiaryAccount="0230468761039";
$beneficiaryAccount2="1014488172";
}
else{
$beneficiaryAccount="0230468761012";
$beneficiaryAccount2="1014488172";
}
//$beneficiaryAccount3="4017904612";
$bankCode="000";
$bankCode2="057";
//$bankCode3="070";
$beneficiaryAmount =$ben1amt;
$beneficiaryAmount2 =$ben2amt;
//$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
//$deductFeeFrom3=0;
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
{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"}
]}';
$curl = curl_init(GATEWAYURL);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
// Disable SSL verification
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
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
$sql = "INSERT INTO applicationinvoice_gen (payername,payeremail,payerphone,orderid,paymentid,amt,acadsession,paymentdescription,paymentName,rrr,dategenerated,status,sid,payerID,programName) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array("$payerName","$payerEmail","$payerPhone","$orderID","$paymentID","$amt","$acadsession","$description","$paymentName","$rrr","$date","Payment Reference generated","$Orderid","$payerID","$programName");
$query = sqlsrv_query($conn,$sql,$params);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close($conn);
?>
<form action="https://erp.yabatech.edu.ng/portal/index.php?register/choosePaymentMethod" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
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
			}
else
{
	echo "Sorry Request Denied by Remote Server!";
}		

?>