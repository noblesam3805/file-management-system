<?php


	function get_dept_name($data)
	
	{
		
		$q= sqlsrv_query($conn,"select deptName from department where deptID='$data'") or die(mysql_error());
		while(list($deptName)=mysql_fetch_array($q))
		{
			echo strtoupper($deptName);
		}

	}
	
	function get_school_name($data)
	
	{
		
		$q= sqlsrv_query($conn,"select schoolname from schools where schoolid='$data'") or die(mysql_error());
		while(list($schoolname)=mysql_fetch_array($q))
		{
			echo strtoupper($schoolname);
		}
	
	}
?>

<div class="row">
    <div class="col-md-12">

     
	 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
		
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('#');?></div></th>
							<th><div><?php echo get_phrase('AppNo/JAMB Reg.No.');?></div></th>
							 <th><div><?php echo get_phrase('Full_name');?></div></th>
                             <th><div><?php echo get_phrase('School');?></div></th>
							 <th><div><?php echo get_phrase('Department');?></div></th>
							
							 <th><div><?php echo get_phrase('Programme Type');?></div></th>
                            <th><div><?php echo get_phrase('Programme Details');?></div></th>
                            
                        </tr>
                    </thead>
		        <tbody>
                        
                    <?php $i=1;?>
                      <?php foreach($admitted_list as $row):
					
					  ?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php echo $row['application_no'];?></td>
							<td><?php echo $row['surname'].' '.$row['firstname'].' '.$row['middlename'];?></td>
                            <td><?php
							 $school_id=$row['school_id'];
							 $faculty = $this->db->query("SELECT * FROM schools WHERE id='$school_id'")->row()->schoolname;
							echo $faculty;?></td>
                            <td><?php 
							 $dept_id=$row['dept_id'];
							$dept = $this->db->query("SELECT * FROM department WHERE deptID='$dept_id'")->row()->deptName;
							echo $dept;?></td>
                         
							<td><?php 
							$programme_type_id=$row['programme_type_id'];
							$programme_type = $this->db->query("SELECT * FROM programme_type WHERE programme_type_id='$programme_type_id'")->row()->programme_type_name;
							echo $programme_type;
												
							?></td>
                            <td><?php
							 $program_id=$row['program_id'];
							$programme_type = $this->db->query("SELECT * FROM program_detailed WHERE program_id='$program_id'")->row()->program_name;
							echo $programme_type;
								
							?></td>
                        
                    <?php $i++;?>
                         </tr>
                    <?php endforeach;?>
                </tbody>
                </table>
                <div class="col-md-12"><b><p>The total number of admitted students from the selected options <?php 
				  $i=$i-1;
				echo $i.' STUDENTS'; ?></p></b></div>
            </div>


            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->


        </div>
       </div>
	  </div> 
	</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

    jQuery(document).ready(function($)
    {


        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [

                    {
                        "sExtends": "xls",
                       "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, true);
                            datatable.fnSetColumnVis(5, true);

                            this.fnPrint( true, oConfig );

                            window.print();

                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(1, true);
                                      datatable.fnSetColumnVis(5, true);
                                  }
                            });
                        },

                    },
                ]
            },

        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>