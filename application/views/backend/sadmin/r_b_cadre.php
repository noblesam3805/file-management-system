<div class="" style="margin:40px 10%">
<form method="post" action="index.php?sadmin/cadre_report">

    <div class="form-group col-md-6">
                <label for="field-ta" class=" control-label">Select Cadre</label>
                <div class="">
                              <select class="form-control" required name="c_id">
                              <option value="">Select Cadre </option>  
                              <?php foreach($cadres as $cadre=>$val){ ?>                                 
                              <option value="<?php echo $val['ID']; ?>"><?php echo $val['Name']; ?></option>
                              <?php } ?>
                              </select>
                </div>
    </div>
           
            <input style="margin-left:2%; margin-top:25px" type="submit" value="search" class="btn btn-info" id="submit-button">
                            
                         
                            </form></div>

                            <div>
<?php if($q_r_b_c_id) { ?>
<table  class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							
                         
                            <th><div><?php echo get_phrase('Fullname');?></div></th>
							<th><div><?php echo get_phrase('Email');?></div></th>
							<th><div><?php echo get_phrase('Phone');?></div></th>
                           
							<th><div><?php echo get_phrase('Acct.Type');?></div></th>
							<th><div><?php echo get_phrase('MDA');?></div></th>
                            <th><div><?php echo get_phrase('Unit/Dept');?></div></th>
							
                          
                            <th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                        <?php foreach ($q_r_b_c_id as $rep=>$val): ?>
                        
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php echo $val['name'] ?></td>
                            <td><?php echo $val['email'] ?></td>
                            <td><?php echo $val['phone'] ?></td>
                            <td><?php
							$levelName=$this->db->get_where('erp_staff_designations',array('designation_id'=>$val['level']))->row();
							
							echo $levelName->designation_name;
							?></td>
							     
                           
                            <td><?php
$faculty = $this->db->query("SELECT * FROM faculty WHERE faculty_id='".$val['unit_sch_id']."'")->row()->faculty_name;
							echo $faculty;?></td>
                      
							    <td><?php 
						$dept = $this->db->query("SELECT * FROM department WHERE deptID=".$val['dept_id']."")->row();
            echo $dept->deptName;
							?></td>
							<td><a href="index.php?sadmin/edituseraccount/<?php echo $val['sadmin_id'] ?>" class="btn btn-danger btn-sm " >
                       Edit
                     </a> <a href="index.php?sadmin/delete_useraccount/<?php echo $val['sadmin_id'] ?>" class="btn btn-success btn-sm ">
                        Delete  </a></td>
                            <?php $i++;?>
                            
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
<?php } else { echo "<h2>No search made/no available staff for requested option please check another</h2>"; }?>
</div>

