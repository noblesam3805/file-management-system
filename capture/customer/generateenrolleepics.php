<?php
include_once("../config.php");

//if(isset($_POST['create_account'])) {

   
/* $type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data1 = file_get_contents($path2);
$base641 =  base64_encode($data1);
$result = mysql_query("UPDATE `enrolee_registration` set passport='$base641',is_image_capured='1' where id='$id'") or die(mysql_error()); */

//}

?>
<table width="100%">
<tr>
<td>SN</td>
<td>NAME</td>
<td>BIO ID</td>
<td>PHOTO</td>
<td>SIGN</td>
<td>THUMB</td>
<tr/>
<?php
$sn=1;
$query1=mysql_query("SELECT `id`,`biometric_id`,`first_name`,`middle_name`,`surname`,`thumprint`,`signature`,`passport` FROM `enrolee_registration` WHERE `passport`<>'' and id>1000") or die ("Error 2");
					while(list($id,$biometric_id,$first_name,$middle_name,$surname,$thumprint,$signature,$passport) =mysql_fetch_array($query1))
					{
					
				
				
?>
<tr>
<td><?php echo $id;?></td>
<td><?php echo $first_name.' '.$middle_name.' '.$surname;?></td>
<td><?php echo $biometric_id;?></td>
<td><img src="<?php 
//$id= $_POST['idx'];
// $account_num = generate_account_number("savings"); //echo " account num = ".$account_num;
 $passport_url = "../../uploads/principal/photos/" . $id . '.jpg';
  


//video capture Data
//echo $_POST['imageFile2'];
//$st=$_POST['imageFile2'];

$content = base64_decode($passport); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);

$path2 = "../../uploads/principal/photos/" . $id . '.jpg';
//echo $path2;?>"/></td>

<td><img src="<?php 


 $passport_url = "../../uploads/principal/signature/" . $id . '.jpg';
  

$content = base64_decode($signature); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);

$path2 = "../../uploads/principal/signature/" . $id . '.jpg';
//echo $path2;?>"/></td>
<td><img src="<?php 

$passport_url = "../../uploads/principal/thumbprint/" . $id . '.jpg';
 
$content = base64_decode($thumprint); 

file_put_contents($passport_url, $content);

$path2 = "../../uploads/principal/thumbprint/" . $id . '.jpg';
//echo $path2;?>"/></td>
<tr/><?php 
$sn++;
}?>
</table>
<br>
<br>
<br>
<br>

 

