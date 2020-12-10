<?php include_once "header.php"; ?>

<?php
include_once("../config.php");

if(isset($_POST['create_account'])) {

   $id= $_POST['idx'];
// $account_num = generate_account_number("savings"); //echo " account num = ".$account_num;
 $passport_url = "../../uploads/photos/enrollment/" . $id . '.jpg';
  


//video capture Data
//echo $_POST['imageFile2'];
$st=$_POST['imageFile2'];

$content = base64_decode($_POST['imageFile2']); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);

$path2 = "../../uploads/photos/enrollment/" . $id . '.jpg';
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data1 = file_get_contents($path2);
$base641 =  base64_encode($data1);

//echo "completed";
  $result = $db->prepare("UPDATE `biometricsimosg`.`enrolee_registration` set passport='$base641' where id='$id'");
  $result = $result->execute();
echo $result;
header("Location: http://imshiaportal.com/index.php?reg_off/enrollee_view/$id");
}
?>
