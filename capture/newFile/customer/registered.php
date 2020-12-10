<?php include_once "header.php"; ?>

<?php
include_once("../config.php");

if(isset($_POST['create_account'])) {
  $surname = $_POST['surname'];
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];
  $maiden_name = $_POST['maiden_name'];
  $occupation = $_POST['occupation'];
  $bio_pass = $_POST['bio_pass']; echo "boi = $bio_pass";
  $gender = $_POST['gender'];
  $marital_status = $_POST['marital_status'];
  $bio_data = $_POST['bio_data'];
 $account_num = generate_account_number("savings"); //echo " account num = ".$account_num;
 $passport_url = "../upload/profile/".$account_num.".png";
  $address = $_POST['address'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

//video capture Data
$content = base64_decode($_POST['imageFile']); //echo $_POST['imageFile'];
$file = fopen($passport_url,'w'); //echo $content;
fwrite($file,$content);
fclose($file);


//echo "completed";
  $result = $db->prepare("INSERT INTO `$dbname`.`customer`(first_name,middle_name,last_name,gender,address,email,phone,dob,passport,bio_data,account_number)
          VALUES('$surname','$first_name','$middle_name','$gender','$address','$email','$phone','$dob','$passport_url','$bio_pass','$account_num');");
  $result = $result->execute();

$details = <<<EOP
Your account has been successfully created with the following details:
Account Name: $surname $first_name $middle_name
Account Number: $account_num
Bio Data: $bio_pass

EOP;

echo $details;
}
?>
