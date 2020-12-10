<?php
 
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$login_details->sadmin_id;
$dept_id=$login_details->dept_id;
$desig_id=$login_details->desig_id;


$erp_documents=$this->db->query("select* from erp_documents where addressed_to_id='$sid' or uploaded_by='$sid' or waiting_approval_by='$sid'")->result_array();
?>
<script type="text/javascript">
function checkdel()

{
var check = confirm("Do you want to delete name from admissions list?");
if(check==true)
{
	
}
else
{
	return false;
}
}
</script>
<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <!-- button starts -->
                <div class="btn-group pull-right">
                    
                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">

                      
                                </a>
                                        </li>-->
                    </ul>
                </br>
                </div>
                <!-- button ends-->
        </div>

        <!--CONTROL TABS START-->
  
		

		
        <!--CONTROL TABS END-->
	 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                       <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							
							<th><div><?php echo get_phrase('Document_title');?></div></th>
							<th><div><?php echo get_phrase('Document_type');?></div></th>
							<th><div><?php echo get_phrase('file_no');?></div></th>
							<th><div><?php echo get_phrase('file_size');?></div></th>
							<th><div><?php echo get_phrase('addressed_to');?></div></th>
                          <th><div><?php echo get_phrase('minutes');?></div></th>
						    <th><div><?php echo get_phrase('mda_&_unit');?></div></th>
							 
								<th><div><?php echo get_phrase('Date_Added');?></div></th>
												
							<th><div><?php echo get_phrase('status');?></div></th>
								<th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($erp_documents as $row){?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['document_name'];
							?></td>
							<td><?php
							echo $row['document_type'];
							
							?></td>
							<td><?php
							echo $row['file_no'];
							
							?></td>
							<td><?php
							echo number_format($row['size']/1000000,2)."Mb";
							
							?></td>
							<td><?php
							echo $row['address_to_details'];
							
							?></td>
							<td><?php
							echo $row['minutes'];
							
							?></td>
							 <td><?php
							 echo $this->db->get_where('faculty',array('faculty_id'=>$row['ministry_id']))->row()->faculty_name." - ".$this->db->get_where('department',array('deptID'=>$row['unit_dept_id']))->row()->deptName;;
							?></td>
							<td><?php
							echo $row['date_uploaded'];
							
							?></td>
						
							<td><b><?php
							echo $row['status']; if($row['status']=="untreated" || $row['status']=="MINUTED" || $row['status']=="KIV" || $row['status']=="AWAITING MINUTING/APPROVAL" ){ echo "<br/>"."<span style='color: red'> (WAITING FOR ". $this->db->get_where('sadmin',array('sadmin_id'=>$row['waiting_approval_by']))->row()->name.")</span>";}
							
							?></b></td>
							
                           
							
                           
							<td><a href="<?php echo $row['upload_doc_path'];?>" class="btn btn-info btn-sm " style="margin-left: 7px">Download File  </a><br/><br/>
                  <a href="index.php?sadmin/filedms/filedetails/<?php echo $row['id'];?>" class="btn btn-primary btn-sm " style="margin-left: 7px"> View File Details </a><br/><br/>
    <?php if($row['waiting_approval_by']==$sid && $row['status']!="ARCHIVED")
	{
		if($row['status']!="APPROVAL GRANTED" ){
		?>
		
	<a href="index.php?sadmin/filedms/treatfile/<?php echo $row['id'];?>" class="btn btn-primary btn-sm " style="margin-left: 7px"> Treat File </a><br/><br/>
 
			
		<?php }
		if($row['status']=="APPROVAL GRANTED"){ 
	
			?> 
			<a href="index.php?sadmin/filedms/sendtoarchive/<?php echo $row['id'];?>" class="btn btn-primary btn-sm " style="margin-left: 7px"> Send File to Archieve</a><br/><br/>
  
		 
	<?php }?>
		
	  <?php }?> 
	<a href="index.php?sadmin/filedms/sharefile/<?php echo $row['id'];?>" class="btn btn-primary btn-sm " style="margin-left: 7px"> Share File </a>			<?php $i++;?>
                          
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p></p></b></div>
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
