<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");


?>
 <div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-home"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                     
                       <li><a href="<?php echo base_url().'index.php?login';?>">Return Home</a></li>
                    </ul>
                    <h4>Step 2:  Acceptance Fee Payment/Confirmation </h4>
                </div>
            </div><!-- media -->
        </div>
	  <div class="span12" >
            <div class="span8 b themiddle hasheight" style="background-color:#FFF;">
                <div class="" style="border:none;">
		<?php  echo form_open('register/processRemitaAcceptancePayment', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="col-md-12 no-p" style="background-color:#FFF; margin: 10px;"  >
			<?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?>
            <div class="col-md-10 no-p" style="background-color:#FFF; margin-left: 20px;" >
         
		
			<div >
				<label class="label-control" for="course name">Application No</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<input type="text"  name="portalID" class="form-control eduportal-input" required="required" />
				</div>
			</div>
            <div >
				<label class="label-control" for="course name">RRR / Confirmation Code</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<input type="text"  name="confirmcode" class="form-control eduportal-input" required="required" />
				</div>
			</div>
			<div >
				<label class="label-control" for="course name">Year</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="year" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
					
					    
                        <option value="ND I">ND I</option>
                     
              
                        <option value="HND I">HND I</option>
						<option value="YEAR I">YEAR I</option>
						<option value="YEAR II">YEAR II</option>
						
						
                   
						
					</select>
				</div>
			</div>
			<div>
				<label class="label-control" for="course name">Payment Platform</label>
			<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="pmode" required class="form-control eduportal-input">
						<option value="0">Select An Option</option>
                       
                        <option value="2">Remita</option>
				
					</select>
				</div>
			</div>
			<div>
				<label class="label-control" for="course name">Payment Type</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="paymentType" required class="form-control eduportal-input">
						<option value="1">ACCEPTANCE FEES</option>
					</select>
				</div>
			</div>
			<div  style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Proceed</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div></div></div></div></div><?php unset($_SESSION['fee_type']);?>
  