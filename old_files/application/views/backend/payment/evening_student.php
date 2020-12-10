<?php session_start(); 

	$states = $this->db->get('states')->result_array();
	//$evening = $this->db->query("SELECT DISTINCT (programme)FROM  fees_schedule WHERE programme LIKE  '%evening%' or programme LIKE  '%weekend%'")->result_array();
	//$countries = $this->db->get('countries')->result_array();
	
	$this->db->distinct('programme');
	$this->db->like('programme', 'evening');
	$this->db->or_like('programme', 'weekend');
	$evening = $this->db->get('fees_schedule')->result_array();
?>
<style type="text/css">
	.row{
		margin-left:0px !important;
		padding:10px 0px 0px 0px;
	}
	.foreign-form{
		display:none;
	}
	.country-line{
		padding:10px;
		background:#DEDEDE;
		margin:20px 0 0 0;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line input[type=radio]{
		background-image :    -moz-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :     -ms-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :      -o-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image : -webkit-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :         linear-gradient(rgb(224,224,224),rgb(240,240,240));
		width:20px;
		height:20px;
		font-size:22px;
	}
</style>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="number">
				<p>1.</p>
			</div>
			<div class="page-title">
				<p><?=$page_title?></p>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<p style="font-size:14px; color:#820E29; text-align:center;margin-top:20px;">
			<?php 
				if(isset($_SESSION['error'])){
					echo $_SESSION['error'];
				}
			?>
		</p>
		<p style="font-size:14px; color:#820E29; margin-top:20px;">
			<?php 
				if(isset($_SESSION['formerror'])){
					echo $_SESSION['formerror'];
				}
			?>
		</p>
		<div class="col-md-12 no-p">
		<div class="col-md-8 middle" style="margin-top:10px;">
			<div class="widget stacked">
				<div class="widget-content" style="padding:10px 20px;">
			<?php echo form_open('payment/pay_fees/start', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
			
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Reg Number</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span><input type="text" name="regno" required class="form-control eduportal-input"  placeholder="Enter Reg No."/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Session</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="session" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<option value="2012/2013">2012/2013</option>
								<option value="2013/2014">2013/2014</option>
								<option value="2014/2015">2014/2015</option>
								<option value="2015/2016">2015/2016</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Programme</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="prog" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<?php
									foreach($evening as $prog => $val): ?>
										<option value="<?php echo $val['programme']; ?>" title="<?php echo $val['level']; ?>">(<?php echo $val['level']; ?>)<?php echo $val['programme']; ?></option>
									<?php endforeach;
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Level</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="level" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<option value="HND I">HND I</option>
								<option value="HND II">HND II</option>
								<option value="ND I<">ND I</option>
								<option value="ND II">ND II</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Surname</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<input type="text" name="surname" required class="form-control eduportal-input" data-start-view="2" placeholder="Surname"/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Other Names</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<input type="text" name="fname" required class="form-control eduportal-input" placeholder="First name and middle name"/>
						</div>
					</div>
				</div>
			</div>
			<!--div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">State Of Origin</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="states" id="states" required class="form-control eduportal-input">
								
								<?php
									foreach($states as $state => $val): ?>
										<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
									<?php endforeach;
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">L.G.A</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="lga" id="lga" required class="form-control eduportal-input">
									<option value="abia">Select An Option</option>
							</select>
						</div>
					</div>
				</div>
			</div-->
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Mobile Phone</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<input type="text" name="phone" required class="form-control eduportal-input" placeholder="080xxxxxxxx"/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Email</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<input type="text" name="email" required class="form-control eduportal-input" placeholder="enter email"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group eduportal-form-group p20" style="text-align:center;">
					<label>&nbsp;</label>
					<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp;Generate Invoice</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12" style="text-align:center">
				<img src="assets/images/etranzact_logo.png" />
			</div>
		</div>
	</div>
	</div>
</div>
<?php
	if(isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
	if(isset($_SESSION['formerror'])){
		unset($_SESSION['formerror']);
	}
?>

<script type="text/javascript">

$('#bank_name').keyup(function() {
    var bank_name = $(this).val();
    //alert(bank_name);
    $.ajax({
        type: 'POST',
        url: "<?=base_url('bank_account/bankname')?>",
        data: "bank_name=" + bank_name,
        dataType: "html",
        success: function(data) {
            if(data != "") {
                var width = $("#bank_name").width();
                $(".book").css('width', width+25 + "px").show();
                $(".result").html(data);

                $('.result li').click(function(){
                    var result_value = $(this).text();
                    var result_code = $(this).attr('id');
                    $('#bank_name').val(result_value);
                    $('#bank_code').val(result_code);
                    $('.result').html(' ');
                    $('.book').hide();
                });
            } else {
                $(".book").hide();
            }
           
        }
    });
});

</script>