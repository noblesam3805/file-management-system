<?php
include_once("../config.php");

if(isset($_POST['create_account'])) {

   $id= $_POST['idx'];
// $account_num = generate_account_number("savings"); //echo " account num = ".$account_num;
 $passport_url = "../../uploads/principal/photos/" . $id . '.jpg';
  


//video capture Data
//echo $_POST['imageFile2'];
$st=$_POST['imageFile2'];

$content = base64_decode($_POST['imageFile2']); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);

$path2 = "../../uploads/principal/photos/" . $id . '.jpg';
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data1 = file_get_contents($path2);
$base641 =  base64_encode($data1);
$result = mysql_query("UPDATE `enrolee_registration` set passport='$base641',is_image_capured='1' where id='$id'") or die(mysql_error());

}

?>
<br>
<br>
<br>
<br>

<img src="<?php echo $path2;?>"/> 

<br>
<b>Enrolle Image was Captured and Saved Successfully!</b>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<a href="<?php echo '../../index.php?reg_off/enrollee_view/$id';?>">Close</a>