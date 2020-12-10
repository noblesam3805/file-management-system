<?php
include("../../OLDfunction.php");
$dept = mysql_query("select deptName from department where dept_code = '$dept_code'") or die ("Error deptname ".mysql_error());
$countD = mysql_num_rows($dept);
if($countD ==0){
	$dept_name = $dept_code;
	
}
else{
	while($dept2 = mysql_fetch_array($dept)){
	$dept_name = $dept2["deptName"];	
	}
}
?>