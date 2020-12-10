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
            	<?php echo form_open('sadmin/export_etranzact/exp' , array('id'=>'payment_data','class' => 'form-horizontal validate','target'=>'_top'));?>
            	<!--ul-->
            	<div>
            	<?php
            		foreach($data as $index=>$row):?>
            		<!--li-->
            			
                            <input type="checkbox" class="checkbox1" name="payments[<?= $row?>]" id="payment_<?= $index?>">
                            <label for="payment_<?= $index?>" class="control-label"><?php echo ucwords(str_replace('_', ' ', $row));?></label>
                            
                            <?php echo "\t";?>
                        <!--/div-->
                    <!--/li-->

            		<?php endforeach;?>
            	</div>
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



