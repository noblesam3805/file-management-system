<?php
/***********************************configuration script**************************************/
$servername = "localhost";
$username = "root";
$password = 'mr cheat';
$dbname = "zenith";
$db;

try {
	$db = new PDO("mysql:host=$servername;dbname = $dbname",$username,$password);
}
catch(PDOExceptin $e) {
	echo "Error".$sql.$e->getMessage();
}



//function that fetches data from DB and returns result as associative array
function fetchAssoc($table,$col,$condition="non") {
    global $db, $dbname;
    $socket = $db;
    $select_db = $dbname;

    $query = "SELECT ".$col." FROM `$select_db`.`$table`"; //echo "$query <br/>";
    if($condition != "non") $query .= " WHERE ".$condition;
    $stm = $socket->prepare($query);
    $stm->execute();
    $stm = $stm->fetchAll(PDO::FETCH_ASSOC); //echo "query = $query ".count($stm);
    if(!isset($stm) || count($stm) == 0) return -1;

		//return data
    return $stm;
}

//function to get maximum insert id from the db table
function get_max_id($table_name) {
	global $db, $dbname;
   $stmt = $db->prepare("SELECT MAX(id) AS max_id FROM `$dbname`.`$table_name`");
  $stmt->execute();
  $invNum = $stmt->fetch(PDO::FETCH_ASSOC);
  return $invNum['max_id'];
}

function write_log($transaction_type,$admin_id = -1, $account_number) {
	global $db, $dbname;
	$stm = $db->prepare("INSERT INTO `$dbname`.`transaction`(transaction_type,admin_id,account_number)
	VALUES('$transaction_type','$admin_id','$account_number')");
	$stm->execute();
}

function generate_account_number($account_type) {
	global $db, $dbname;
	$id1 = get_max_id("account"); !isset($id1)?$id1=0:$id1;
	$id2 = get_max_id("customer");//echo " id1 = ".$id1;
	$account_num = "00".$id1.$id2."124".$d1."65".$d2;
	$stm = $db->prepare("INSERT INTO `$dbname`.`account`(account_number,account_type)
		VALUES('$account_num','$account_type');");
	$stm->execute();
	return $account_num;
}

function check_balance($account_number) {
	global $db, $dbname;
	$balance = fetchAssoc("account","account_balance","account_number = '$account_number'");
	if($balance != -1) {
		return $balance[0]['account_balance'];
	}
	return -1;
}

function transaction($account_number, $amount,$type,$admin_id = -1) {
	global $db, $dbname;
	$balance = check_balance($account_number);
	if($type == 'deposit') $mount += $balance;
	else {
		if($balance >= $amount) {
			$balance -= $amount;
			$amount = $balance;
		}
		else return 0;
	}
	$stm = $db->prepare("UPDATE `$dbname`.`account` SET account_balance = '$amount'
		WHERE account_number = '$account_number'");
	$stm->execute();
	write_log($type,$admin_id,$account_number);
	return 1;
}

function list_data($table_name,$fields_list){
	$data = fetchAssoc($table_name,"*");
	if(count($data) > 0) {
		$table = "<table style='width:800px; height:300px; font-family:verdana, serif; font-size:20px; border-style:solid; border-left:0; border-right:0;'>";
		$th = '<th>';
		for($i = 1; $i < count($fields_list); $i++) {
			$th = $th."<td>".$fields_list[$i]."</td>";
		}
		$th = $th.'</th>';
		$table = $table.$th;
		$tr = '<tr>';

		for($i = 0; $i < count($data); $i++) {
			$table .= '<tr>';
			for($j = 0; $j < count($fields_list); $j++)
				$table .= '<td>'.$data[$i][$fields_list[$j]].'</td>';
			$table .= '</tr>';
		}
		$table .= '</table>';
		return $table;
	}
	return '<table></table>';
}


function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
		//return "197.211.63.164";
		//return "105.112.10.108";
}

function getUserGPScoord () {
	$ip = getUserIpAddr();
	//$ip = '197.211.63.158';

	$location = file_get_contents('http://freegeoip.net/json/'.$ip);
	$loc = json_decode($location,true);
	$coord = '{"lng":"'.$loc['longitude'].'","lat":"'.$loc['latitude'].'"}';
	return $coord;
 //print_r($location;
}


//function to send the refill token via sms
function send_sms($phone, $msg) {
 $message = urlencode($msg);
	$url = 'http://smsexperience.com/components/com_spc/smsapi.php?username=israel&password=mr_cheat&sender=IntelliBanking&recipient='.$phone.'&message='.$message;
	//get request
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	//echo $url;
  $response = curl_exec($client);
	//close connection
	curl_close($client);
   if(!$response) return 0;
	 //echo $response;
	 return 1;
}




?>
