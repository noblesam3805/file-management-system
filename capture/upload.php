<?php
//echo $_POST['imageFile'];
//file_put_contents("image.jpg",base64_decode($_POST['imageFile']));
$content = base64_decode($_POST['imageFile']);
$file = fopen("upload/imgg.png",'w');
fwrite($file,$content);
fclose($file);
echo "thanks alot";
?>
