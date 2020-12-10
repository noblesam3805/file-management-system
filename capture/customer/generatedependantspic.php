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

<tr/>
<?php
$sn=1;
$query1=mysql_query("SELECT `id`,`biometric_id`,`name`,`passport`,identification_no FROM `children`") or die ("Error 2");
					while(list($id,$biometric_id,$name,$passport,$idn) =mysql_fetch_array($query1))
					{
					
				
				
?>
<tr>
<td><?php echo $idn;?></td>
<td><?php echo $name;?></td>
<td><?php echo $biometric_id;?></td>
<td><img src="<?php 
//$id= $_POST['idx'];
// $account_num = generate_account_number("savings"); //echo " account num = ".$account_num;
 $passport_url = "../../uploads/children/" . $idn . '.jpg';
  


//video capture Data
//echo $_POST['imageFile2'];
//$st=$_POST['imageFile2'];

$content = base64_decode($passport); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);

//$path2 = "../../uploads/principal/photos/" . $id . '.jpg';
//echo $path2;?>"/></td>


<tr/><?php 
$sn++;
}?>
</table>
<br>
<br>
<br>
<br>

 

