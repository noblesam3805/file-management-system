<?php
function getname($email)
{
if(!isset($_SESSION['oauth_provider']))
{
db_connect();
$result = mysql_query("select id,Firstname, Middlename, Lastname from register
where Email='$email'");
while(list($id,$fname,$mname,$lname)=mysql_fetch_array($result))
 {
$_SESSION['name'] = $fname.' '.$mname.' '.$lname;
echo $_SESSION['name'];
 } 
}
else
{
db_connect();
$result = mysql_query("select id,username from users
where email='$email'");
while(list($id,$fname,$lname,$dd)=mysql_fetch_array($result))
 {
$_SESSION['name'] = $fname.' '.$lname;
echo $_SESSION['name'];
 } 
}
} 

function login($username, $pass)
// check username and password with db
// if yes, return true
// else return false
{
// connect to db
$conn = db_connect();
if (!$conn)
return false;
// check if username is unique
$result = mysql_query("select * from register where (Your_Email='$username') and (Choose_a_password = '$pass')");
if (!$result)
return false;
if (mysql_num_rows($result)>0)
return true;
else
return false;
}
function check_valid_user()
// see if somebody is logged in and notify them if not
{
global $_SESSION;
if (!isset($_SESSION['login']))
{
$_SESSION['error'] = "Please Login to continue!";
 
header('Location:index.php');
} 

}

function autolog()
// see if somebody is logged in and redirect to their home.
{

if (isset($_COOKIE['ValidUser']))
  {
 $username = $_COOKIE['ValidUser'];
 $_SESSION['login'] = $username;
 db_connect();
$result5 = mysql_query("select id,Firstname,Lastname,username from register
where Your_Email='$username'");
while(list($id,$fname,$lname,$un)=mysql_fetch_array($result5))
 {
$_SESSION['fname'] =$fname;
$_SESSION['lname'] = $lname;
$_SESSION['name'] = $fname.' '.$lname;
$_SESSION['username'] = $un;
$pname = $fname.' '.$lname;
$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
db_connect();
$chk =mysql_query("select count(*) from online where email = '$username'") or die (mysql_error());
$result1 = mysql_result($chk,0);
if ($result1>0)
{
}
else
{
mysql_query("insert into online (id,name,email,ip,chat_name) values ('$id','$pname','$username','$ip','$_SESSION[usern]')") or die (mysql_error());
$_SESSION['uid'] = $id;
}
 }
$sid = session_id();
header("Location: home.php?user=$username&sid=$sid");
 }
 }

function change_password($username, $old_password, $new_password)
// change password for username/old_password to new_password
// return true or false
{
// if the old password is right
// change their password to new_password and return true
// else return false
if (login($username, $old_password))
{
if (!($conn = db_connect()))
return false;
$result = mysql_query( "update register
set password = '$new_password'
where username = '$username'");
if (!$result)
return false; // not changed
else
return true; // changed successfully
}
else
return false; // old password was wrong
}
function reset_password($username)
// set password for username to a random value
// return the new password or false on failure
{
// get a random dictionary word b/w 6 and 13 chars in length
$new_password = get_random_word(6, 13);
if($new_password==false)
return false;
// add a number between 0 and 999 to it
// to make it a slightly better password
srand ((double) microtime() * 1000000);
$rand_number = rand(0, 999);
$new_password .= $rand_number;
// set user's password to this in database or return false
if (!($conn = db_connect()))
return false;
$result = mysql_query( "update register
set password = '$new_password'
where username = '$username'");
if (!$result)
return false; // not changed
else
return $new_password; // changed successfully
}
function get_random_word($min_length, $max_length)
// grab a random word from dictionary between the two lengths
// and return it
{
// generate a random word
$word = '';
//remember to change this path to suit your system
$dictionary = '/usr/dict/words'; // the ispell dictionary
$fp = fopen($dictionary, 'r');
if(!$fp)
return false;
$size = filesize($dictionary);
// go to a random location in dictionary
srand ((double) microtime() * 1000000);
$rand_location = rand(0, $size);
fseek($fp, $rand_location);
// get the next whole word of the right length in the file
while (strlen($word)< $min_length || strlen($word)>$max_length
|| strstr($word, "'"))
{
if (feof($fp))
fseek($fp, 0); // if at end, go to start
$word = fgets($fp, 80); // skip first word as it could be partial
$word = fgets($fp, 80); // the potential password
};
$word=trim($word); // trim the trailing \n from fgets
return $word;
}
function notify_password($username, $password)
// notify the user that their password has been changed
{
if (!($conn = db_connect()))
return false;
$result = mysql_query("select email from register
where username='$username'");
if (!$result)
{
return false; // not changed
}
else if (mysql_num_rows($result)==0)
{
return false; // username not in db
}
else
{
$email = mysql_result($result, 0, 'email');
$from = "From: support@phpbookmark \r\n";
$mesg = "Your PHPBookmark password has been changed to $password \r\n"
."Please change it next time you log in. \r\n";
if (mail($email, 'PHPBookmark login information', $mesg, $from))
return true;
else
return false;
}
}

function db_connect()

{

$result = mysql_pconnect('localhost', 'bccmport_vicfen', 'junior5555');

if (!$result)

return false;

if (!mysql_select_db('bccmport_wokon'))

return false;

return $result;

}


function filled_out($form_vars)
{
// test that each variable has a value
foreach ($form_vars as $key => $value)
{
if (!isset($key) || ($value == ''))
return false;
}
return true;
}
function valid_email($email)
{
// check an email address is possibly valid
if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email))
return true;
else
return false;
}

function valid_name($name)
{
// check an name is possibly valid
if (ereg('^[a-zA-Z]+$', $name))
return true;
else
return false;
}
function valid_tel($tel)
{
// check an name is possibly valid
if (ereg('^[0-9]+$', $tel))
return true;
else
return false;
}

function valid_username($username)
{
// check an username is possibly valid
if (ereg('^[a-zA-Z0-9_\.\-]+$', $username))
return true;
else
return false;
}

function display_profile_pic_small(){

if(isset($_SESSION['oauth_provider']))
{

 
    echo "<img name='' src='$_SESSION[profile_pic]' alt='' width = '70' height = '60' style ='border:0px solid #CCCCCC;'/>".'<br>  '; 

 
  }
  else
  {	
  db_connect();

		  $query2 = mysql_query("select `profile_pic` from `register` where `email` = '$_SESSION[wokon_login]'");

while ($query3 = mysql_fetch_array($query2)) {

$user_image = $query3["profile_pic"];
}
if ($user_image =='')

{
 $default_image= "54635ricemd5hty.jpg";

	  echo "<img name='' src='pic/$default_image' alt='' width = '25' height = '25' style ='border:0px solid #CCCCCC;'/>";

			}

	  else

	  {

	 echo "<img name='' src='$_SESSION[userprofile]/profilepics/thumbnails/$user_image' alt='' width = '25' height = '25' style ='border:0px solid #CCCCCC;'/>";  

	   }
	}

	}


function display_profile_pic_big(){

if(isset($_SESSION['oauth_provider']))
{

 
    echo "<img name='' src='$_SESSION[profile_pic]' alt='' width = '70' height = '60' style ='border:0px solid #CCCCCC;'/>".'<br>  '; 

 
  }
  else
  {	
  db_connect();

		  $query2 = mysql_query("select `profile_pic` from `register` where `email` = '$_SESSION[wokon_login]'");

while ($query3 = mysql_fetch_array($query2)) {

$user_image = $query3["profile_pic"];
}
if ($user_image =='')

{
 $default_image= "54635ricemd5hty.jpg";

	  echo "<img name='' src='pic/$default_image' alt='' width = '40' height = '40' style ='border:0px solid #CCCCCC;'/>";

			}

	  else

	  {

	 echo "<img name='' src='$_SESSION[userprofile]/profilepics/thumbnails/$user_image' alt='' width = '40' height = '40' style ='border:0px solid #CCCCCC;'/>";  

	   }
	}

	}


	
	
	
	
	function display_search_pic($email,$id,$name){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  ?>
  
	 <a href="membersprofile.php?profileid=<?php echo $id;?>&name=<?php echo $name;?>" style="font-size: 12.0pt; font-family: &quot;Georgia&quot;,&quot;serif&quot;; mso-fareast-font-family: &quot;Times New Roman&quot;; mso-bidi-font-family: &quot;Times New Roman&quot;; color: #00B0F0"><?php echo "<img name='' src='pic/thumb/$user_image' alt='' width = '125' height = '100' style ='border:3px solid #CCCCCC;'/>".'<br>  ';  
	  ?>
	 </a>
		<?php
		}
	  else
	  {
	  
	  ?>
  
	 <a href="membersprofile.php?profileid=<?php echo $id;?>&name=<?php echo $name;?>" style="font-size: 12.0pt; font-family: &quot;Georgia&quot;,&quot;serif&quot;; mso-fareast-font-family: &quot;Times New Roman&quot;; mso-bidi-font-family: &quot;Times New Roman&quot;; color: #00B0F0">
	 <?php 
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '125' height = '100' style ='border:3px solid #CCCCCC;'/>".'<br>  ';

	   }
	   	   ?>
		   </a>
	 <?php 	   
	}
	
	
	function display_profile_pic2($email){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  
	  echo "<img name='' src='pic/thumb/$user_image' alt='' width = '150' height = '120' style ='border:2px solid #CCCCCC;'/>".'<br>  ';  
	
		}
	  else
	  {
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '150' height = '120' style ='border:2px solid #CCCCCC;'/>".'<br>  ';

	   }
	}
	
		function display_profile_pic3($email){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  
	  echo "<img name='' src='pic/thumb/$user_image' alt='' width = '90' height = '70' style ='border:2px solid #CCCCCC;'/>".'<br>  ';  
	
		}
	  else
	  {
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '90' height = '70' style ='border:2px solid #CCCCCC;'/>".'<br>  ';

	   }
	}
	
		function display_profile_pic4($email){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  
	  echo "<img name='' src='pic/thumb/$user_image' alt='' width = '60' height = '50' style ='border:2px solid #CCCCCC;'/>";  
	
		}
	  else
	  {
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '60' height = '50' style ='border:2px solid #CCCCCC;'/>";

	   }
	}
	
	
	function display_profile_pic5($email){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  
	  echo "<img name='' src='pic/$user_image' alt='' width = '130' height = '100' style ='border:2px solid #CCCCCC;'/>".'<br>  ';  
	
		}
	  else
	  {
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '130' height = '100' style ='border:2px solid #CCCCCC;'/>".'<br>  ';

	   }
	}
	
	
function display_profile_pic6($email){
  db_connect(); 
		  $query2 = mysql_query("select `picname` from `upload` where `email` = '$email'");
while ($query3 = mysql_fetch_array($query2)) {
$user_image = $query3["picname"];


}
$query4 = mysql_query("select count(*) from upload where email ='$email' ") or die ("Cannot Select");
$result4 = mysql_result($query4,0);
if ($result4>0)
{
  
	  echo "<img name='' src='pic/thumb/$user_image' alt='' width = '30' height = '30' style ='border:1px solid #CCCCCC;'/>";  
	
		}
	  else
	  {
	  $default_image= "54635ricemd5hty.jpg";
	  echo "<img name='' src='pic/$default_image' alt='' width = '30' height = '30' style ='border:1px solid #CCCCCC;'/>";

	   }
	}


function display_profile_pics($email){
  db_connect(); 
 
		  $query2 = mysql_query("select `picname`,`caption` from `upload` where `email` = '$email'");
while(list($pics,$cap) = mysql_fetch_array($query2)) {


  ?>
  <a href="pic/mini/<?php echo $pics;?>" class="pirobox_gal1" title="<?php if($cap==''){echo "No Caption";} else{ echo $cap;}?>"><?php echo "<img name='' src='pic/thumb/$pics' alt='' width = '150' height = '120' style ='border:3px solid #CCCCCC;'/>".' ';  
	  ?></a>
	
		
	 <?php 	   
	 }
	}
			
	
	
	
	
	
	function check_activation()
	{
	db_connect();
	$acct =mysql_query("select status from register where Your_Email ='$_SESSION[login]'") or die (mysql_error());
	while(list($status)=mysql_fetch_array($acct))
	{
	if ($status =='not activated')
	{
	$sid = session_id();
	$_SESSION["status"] ="notactivated";
	header("Location: home.php?user=$_SESSION[login]&sid=$sid");
	}
	else
	{
	$sid = session_id();
	header("Location: home.php?user=$_SESSION[login]&sid=$sid");
	}
  }
	
}

function returnDate($querydate){ 

$minusdate = date('ymdHi') - $querydate; 

if($minusdate > 88697640 && $minusdate < 100000000){ 
    $minusdate = $minusdate - 88697640; 
} 

    switch ($minusdate) { 

        
		case ($minusdate < 99): 
                    if($minusdate < 1){ 
                        $date_string = 'just now'; 
                    } 
					  elseif($minusdate ==1){ 
                        $date_string = '1 minute ago'; 
                    } 
                    elseif($minusdate > 59){ 
                        $date_string =  ($minusdate - 40).' minutes ago'; 
                    } 
                    elseif($minusdate > 1 && $minusdate < 59){ 
                        $date_string = $minusdate.' minutes ago'; 
                    } 
        break; 

        case ($minusdate > 99 && $minusdate < 2359): 
                    $flr = floor($minusdate * .01); 
                    if($flr == 1){ 
                        $date_string = '1 hour ago'; 
                    }
                     
                    else{  if($minusdate < 1){ 
                        $date_string = 'just now'; 
                    } 
else
{
                        $date_string =  $flr.' hours ago'; 
}                   
 } 
        break; 
        
        case ($minusdate > 2359 && $minusdate < 310000): 
                    $flr = floor($minusdate * .0001); 
                    if($flr == 1){ 
                        $date_string = '1 day ago'; 
                    } 
                    else{ 
					if($flr < 1)
					{
					 $date_string = 'almost a day now'; 
					 
					}
					 else
					 {
                        $date_string =  $flr.' days ago'; 
					 }
                    } 
        break; 
        
        case ($minusdate > 310001 && $minusdate < 12320000): 
                    $flr = floor($minusdate * .000001); 
                    if($flr == 1){ 
                        $date_string = "1 month ago"; 
                    } 
                    else{
					if($flr < 1)
					{
					 $date_string = 'less than a month ago'; 

					 
					 }
					 else
					 {
                        $date_string =  $flr.' months ago'; 
                    }
					} 
        break; 
        
        case ($minusdate > 100000000): 
                $flr = floor($minusdate * .00000001); 
                if($flr == 1){ 
                        $date_string = '1 year ago.'; 
                } 
                else{
				if($flr < 1)
					{
					 $date_string = 'less than a year'; 
					 
					 }
					 else
					 { 
                        $date_string = $flr.' years ago'; 
						}
                } 
        } 
        

    
    echo $date_string;
	
} 

	
	?>