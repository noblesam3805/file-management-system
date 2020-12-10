<script type="text/javascript">
//alert('here');
/*$(document).ready(function() {
	//alert('here1');
    $('.chk_boxes').click(function(){
    	alert('here2');
            //$('.chk_boxes1').attr('checked',$(this).attr('checked'));
        var chk = $(this).attr('checked')?true:false;
    	$('.chk_boxes1').attr('checked',chk);
    })
});*/
$(document).ready(function() {
    $('#selectall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"  
                $("#etti").html("Unselect all");             
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"    
                $("#etti").html("Select all");                   
            });         
        }
    });
    
});

</script>
<div class="row">

    <div class="col-md-12">

        <!--CONTROL TABS START-->

        <ul class="nav nav-tabs bordered">

            <li class="active">

                <a href="#exp" data-toggle="tab"><i class="entypo-menu"></i>

                    <?php echo get_phrase('Export Data');?>

                </a>
            </li>
        </ul>

        <!--CONTROL TABS END-->
	<div class="widget stacked widget-table">
	 <div class="widget-content">

        <div class="tab-content">

            <!--TABLE LISTING STARTS-->

            <div class="tab-pane box active" id="exp">
            	<?php echo form_open('sadmin/export_student/exp' , array('id'=>'student_data','class' => 'form-horizontal validate','target'=>'_top'));?>
            	<!--ul-->
            	<div>
            	<?php
            		foreach($data as $index=>$row):?>
            		<!--li-->
            			
                            <input type="checkbox" class="checkbox1" name="students[<?= $row?>]" id="student_<?= $index?>">
                            <label for="student_<?= $index?>" class="control-label"><?php echo ucwords(str_replace('_', ' ', $row));?></label>
                            
                            <?php echo "\t";?>
                        <!--/div-->
                    <!--/li-->

					<table  class="table table-bordered datatable" id="table_export">

                    <thead>

                        <tr>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                            <th><div></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($invoices as $row):?>

                        <tr>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td></td>



                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

					
					
            		<?php endforeach;?>
            	</div>
				
				
				
				<!--<div class="panel panel-primary panel-table">
					<div class="panel-heading">
						<div class="panel-title">
							<h3>Top Grossing</h3>
							<span>Weekly statistics from AppStore</span>
						</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					<div class="panel-body">	
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>App Name</th>
									<th>Download</th>
									<th class="text-center">Graph</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td>Flappy Bird</td>
									<td>2,215,215</td>
									<td class="text-center"><span class="top-apps"><canvas height="15" width="50" style="display: inline-block; vertical-align: top; width: 50px; height: 15px;"></canvas></span></td>
								</tr>
								
								<tr>
									<td>Angry Birds</td>
									<td>1,001,001</td>
									<td class="text-center"><span class="top-apps"><canvas height="15" width="50" style="display: inline-block; vertical-align: top; width: 50px; height: 15px;"></canvas></span></td>
								</tr>
								
								<tr>
									<td>Asphalt 8</td>
									<td>998,003</td>
									<td class="text-center"><span class="top-apps"><canvas height="15" width="50" style="display: inline-block; vertical-align: top; width: 50px; height: 15px;"></canvas></span></td>
								</tr>
			
								
								<tr>
									<td>Viber</td>
									<td>512,015</td>
									<td class="text-center"><span class="top-apps"><canvas height="15" width="50" style="display: inline-block; vertical-align: top; width: 50px; height: 15px;"></canvas></span></td>
								</tr>
			
								
								<tr>
									<td>Whatsapp</td>
									<td>504,135</td>
									<td class="text-center"><span class="top-apps"><canvas height="15" width="50" style="display: inline-block; vertical-align: top; width: 50px; height: 15px;"></canvas></span></td>
								</tr>
			
							</tbody>
						</table>
					</div>
				</div>
				-->
				
            		</br>

            		<input type="checkbox" class="chk_boxes" id="selectall" label="check all"  /><label id="etti">Select all</label>

            <!--/ul-->
		        <div class="col-sm-offset-3 col-sm-5">
		            <button type="submit" name="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-download"></i><?php echo get_phrase(' Download Excel File');?></button>
		        </div>
        		</form>
  
            </div>
        </div>
      </div>
	 </div>
    

</div>



