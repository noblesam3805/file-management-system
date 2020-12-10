<div class="row">
	<div class="col-md-12">

    	<div class="col-md-12">

        </div>

        <!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('_Scratch_Card_Information_list');?>
                    	</a></li>
            <!--li >
                <a href="#slist" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('_school_fees_list');?>
                        </a></li>
            <li >
                <a href="#hlist" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('_hostel_fees_list');?>
                        </a></li-->

		</ul>
    	<!--CONTROL TABS END-->
	  <div class="widget stacked widget-table">
	   <div class="widget-content">

		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">


                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('Payment_#');?></div></th>
                    		<th><div><?php echo get_phrase('Reg_No');?></div></th>
                    		<th><div><?php echo get_phrase('Full_name');?></div></th>
                    		<th><div><?php echo get_phrase('Serial_no');?></div></th>
                            <th><div><?php echo get_phrase('Used_pin_code');?></div></th>
                    		<th><div><?php echo get_phrase('Hostel_Name');?></div></th>
                    		<th><div><?php echo get_phrase('Room_no');?></div></th>

						</tr>
					</thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                    	<?php foreach($hostel as $row):?>
                        <tr>
                            <?php //$name = $this->db->get_where('student',array('reg_no'=> $row['idno']))->row()->name;?>
                            <?php //$oname = $this->db->get_where('student',array('reg_no'=> $row['idno']))->row()->othername;?>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['idno'];?></td>
							<td>
								<?php 
									$name = $this->db->get_where('student', array("reg_no" => $row['idno']))->row();
									echo $name->name .', '.$name->othername;?></td>
							<td><?php echo $row['serial'];?></td>
                            <td><?php echo $row['pin'];?></td>
                            <td><?php echo $row['hostel_name'];?></td>
                            <td><?php echo $row['room_no'];?></td>


                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p>The total number of Scartch Cards used:&nbsp;<?php echo $total; ?></p></b></div>
                <div class="col-md-12"><b><p>The total number of Scartch Cards that are not used:&nbsp;<?php echo $htotal; ?></p></b></div>
                <div class="col-md-12"><b><p>The total number of Scartch Cards available:&nbsp;<?php echo $stotal; ?></p></b></div>
			</div>




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
                        "mColumns": [0, 1, 2, 3, 4, 5,6, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5,6, 7]
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