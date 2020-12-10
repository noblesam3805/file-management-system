<?php
include_once("../config.php");


$id=$_POST["id"];
$signature=$_POST["signature"];
$thumprint=$_POST["thumprint"];
$date_of_expiry=$_POST["date_of_expiry"];
$date_of_issue=$_POST["date_of_issue"];
$type=$_POST["type"];

//$id='39467';
//$type='1';
 $passport_url = "../../uploads/principal/signature/" . $id . '.jpg';
  

$content = base64_decode($signature); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);


$passport_url = "../../uploads/principal/thumbprint/" . $id . '.jpg';
 
$content = base64_decode($thumprint); 

file_put_contents($passport_url, $content);

$passport = base64_encode(file_get_contents("../../uploads/principal/photos/" . $id . '.jpg'));
if($type==1)
{

//require_once '../../assets/bsgateway.php';
//$messageObj = new BSGateway($config);

$query= mysql_query("select staff_id,primary_hcp,first_name,middle_name, surname,sex,birthdate,address,blood_group, phone,nationality,state,lga,email,next_of_kin,next_of_phone, next_of_address,
next_of_kin_relationship,genotype,religion,title,town,plan,password,is_image_capured ,signature, biometric_id, source from enrolee_registration where id='$id'") or die (mysql_error());
while(list($staff_id,$primary_hcp,$first_name,$middle_name, $surname,$sex,$birthdate,$address,$blood_group, $phone,$nationality,$state,$lga,$email,$next_of_kin,$next_of_phone, $next_of_address,
$next_of_kin_relationship,$genotype,$religion,$title,$town,$plan,$password,$is_image_capured ,$sig, $biometric_id, $source)=mysql_fetch_array($query))
{
	$msg = "Hello $first_name, Congratulations you have completed your enrollment with ID: $biometric_id. Call ASHIA on 08021810222 for any challenge with your healthcare provider or any enquiries.";//Follow us on Facebook. http://fb.me/ashcalabar
$tel ='234'.substr($phone,1);

//$response = $messageObj->sendMessage('victor.ofene@gmail.com', 'myloveiskate', 'ASHIA', $tel, $msg, 0);

if($source =="adoption-tree-system"){

$curl = curl_init();
$env='test';
$contents="{\"environment\": \"$env\", 
\"message\": { 
\"enrolleeID\":\"$staff_id\", 
\"primary_hcp\": \"$primary_hcp\", 
\"first_name\": \"$first_name\", 
\"middle_name\": \"$middle_name\", 
\"surname\": \"$surname\", 
\"sex\": \"$sex\", 
\"birthdate\": \"$birthdate\", 
\"address\": \"$address\", 
\"blood_group\": \"$blood_group\", 
\"phone\": \"$phone\", 
\"nationality\": \"$nationality\", 
\"state\": \"$state\", 
\"lga\": \"$lga\", 
\"email\": \"$email\", 
\"next_of_kin\": \"$next_of_kin\", 
\"next_of_phone\": \"$next_of_phone\", 
\"next_of_address\": \"$next_of_address\", 
\"next_of_kin_relationship\": \"$next_of_kin_relationship\", 
\"genotype\": \"$genotype\", 
\"religion\": \"$religion\", 
\"title\": \"$title\", 
\"town\": \"$town\", 
\"plan\": \"$plan\", 
\"password\":\"$password\", 
\"is_image_capured\": \"$is_image_capured\", 
\"passport\": \"$passport\", 
\"signature\": \"$signature\" 
}}";


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://adoptiontree-imshia.ew.r.appspot.com/activation",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$contents,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer I4e361a65aac8b8aeb1c193c9!9e516238182a91c4c70985aaa474ec386b30a464lovecupcakes",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
}
//echo $response;
//echo $status;
$result = mysql_query("UPDATE `enrolee_registration` set status='2', is_uploaded='0', date_of_expiry='$date_of_expiry', date_of_issue='$date_of_issue',dependants='$response' where id='$id'") or die(mysql_error());

}
}
else
{
//	require_once '../../assets/bsgateway.php';
//$messageObj = new BSGateway($config);

$query= mysql_query("select staff_id,primary_hcp,first_name,middle_name, surname,sex,birthdate,address,blood_group, phone,nationality,state,lga,email,next_of_kin,next_of_phone, next_of_address,
next_of_kin_relationship,genotype,religion,title,town,plan,password,is_image_capured ,signature, biometric_id,source from enrolee_registration where id='$id'") or die (mysql_error());
while(list($staff_id,$primary_hcp,$first_name,$middle_name, $surname,$sex,$birthdate,$address,$blood_group, $phone,$nationality,$state,$lga,$email,$next_of_kin,$next_of_phone, $next_of_address,
$next_of_kin_relationship,$genotype,$religion,$title,$town,$plan,$password,$is_image_capured ,$sig, $biometric_id, $source)=mysql_fetch_array($query))
{
	$msg = "Hello $first_name, Congratulations you have completed your enrollment with ID: $biometric_id. Call ASHIA on 08021810222 for any challenge with your healthcare provider or any enquiries.";//Follow us on Facebook. http://fb.me/ashcalabar
$tel ='234'.substr($phone,1);

//$response = $messageObj->sendMessage('victor.ofene@gmail.com', 'myloveiskate', 'ASHIA', $tel, $msg, 0);

if($source =="adoption-tree-system"){


$curl = curl_init();
$env='test';
$contents="{\"environment\": \"$env\", 
\"message\": { 
\"enrolleeID\":\"$staff_id\", 
\"primary_hcp\": \"$primary_hcp\", 
\"first_name\": \"$first_name\", 
\"middle_name\": \"$middle_name\", 
\"surname\": \"$surname\", 
\"sex\": \"$sex\", 
\"birthdate\": \"$birthdate\", 
\"address\": \"$address\", 
\"blood_group\": \"$blood_group\", 
\"phone\": \"$phone\", 
\"nationality\": \"$nationality\", 
\"state\": \"$state\", 
\"lga\": \"$lga\", 
\"email\": \"$email\", 
\"next_of_kin\": \"$next_of_kin\", 
\"next_of_phone\": \"$next_of_phone\", 
\"next_of_address\": \"$next_of_address\", 
\"next_of_kin_relationship\": \"$next_of_kin_relationship\", 
\"genotype\": \"$genotype\", 
\"religion\": \"$religion\", 
\"title\": \"$title\", 
\"town\": \"$town\", 
\"plan\": \"$plan\", 
\"password\":\"$password\", 
\"is_image_capured\": \"$is_image_capured\", 
\"passport\": \"$passport\", 
\"signature\": \"$signature\" 
}}";


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://adoptiontree-imshia.ew.r.appspot.com/activation",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$contents,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer I4e361a65aac8b8aeb1c193c9!9e516238182a91c4c70985aaa474ec386b30a464lovecupcakes",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
}
	$result = mysql_query("UPDATE `enrolee_registration` set status='2', is_uploaded='1',dependants='$response' where id='$id'") or die(mysql_error());
}}

echo "Done";
?>



 

