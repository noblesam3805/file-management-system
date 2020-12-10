<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
     session_start();
/*
 *  @author : Emmanuel Etti
 *  @contributor : Sunday Okoi
 *  18th January, 2015
 *  Eduportal
 *  www.autopathgrp.com
 *
 */


class Utility extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

	public function get_depts($schoolid){
		$dept = $this->db->query("select deptName,deptID from department where schoolid = '$schoolid'") or die ("Error deptname ".mysql_error());
		?>
        <select name="dept_id" class="country-line" id="dept_id"  required="required">
        <?php
		foreach($dept->result() as $depts){?>
  <option value="<?php echo $depts->deptID; ?>"><?php echo $depts->deptName; ?></option>
  <?php
		}
		?>
</select>
        <?php
		

	}
	
	function studType($student_type_id){
	$prog = $this->db->query("select * from programme_type where student_type_id = '$student_type_id'") or die ("Error st ".mysql_error());
	?>
        <select name="programme_type_id" class="country-line" id="programme_type_id">
        <?php
		foreach($prog->result() as $progs){?>
  <option value="<?php echo $progs->programme_type_id; ?>"><?php echo $progs->programme_type_name; ?></option>
  <?php
		}
		?>
</select>
        <?php
	}
	
	//Search Student
	function search_stud($param){//Remeber to add to student rec (new rec) on loading of the next page. Also, merge function
		$param = str_replace("__","/",$param);
		$data1 = $this->db->query("select name, othername,reg_no, phone,student_id from student where name like'%$param%' || othername like'%$param%'|| reg_no like'%$param%' || phone like'%$param%'") or die ("Error data1 ".mysql_error());
		
		if($data1->num_rows()>0){
			foreach($data1->result() as $data){
			?>
        <div><a href="<?php echo base_url().'index.php?student_acct/studentProfile/'.$data->student_id;?>"><?php echo $data->name." ".$data->othername." - ".$data->reg_no." - ".$data->phone;?></a></div>
        <?php
			}
		}
		else{
		echo "No record";
		}
	}
}


