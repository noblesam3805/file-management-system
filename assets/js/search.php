<?php

	require_once('../../application/config/z.php');

	$title=$_POST["title"];
 
  
	$result=mysql_query("SELECT * FROM courses where course_name like '%$title%' or course_code like '%$title%' or prog_type like '%$title%'");
	$found=mysql_num_rows($result);
 
	if($found>0){ ?>
		<div class="col-md-8 middle"> 
			<table class="table table-striped table-bordered mytable">
				<tbody>
	<?php
		while($row=mysql_fetch_array($result)){ ?>
			
			<tr>
				<td><?php echo $row['course_name']; ?></td>
				<td><?php echo $row['course_code']; ?></td>
				<td class="td-actions">
					<a href="javascript:;">
						<i class="glyphicon glyphicon-pencil"></i> &nbsp; Edit 									
					</a>
				</td>
			</tr>
		<?php } ?>
				</tbody>
			</table>
		</div>
		<?php
	}else{
		echo "<li>No Record Found<li>";
	}
 ?>