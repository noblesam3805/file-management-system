<?php
$progtype = $this->db->query("select * from application_type where activated=1");
?>
<div role="main" class="main">
	
	  	  <section class="page-top breadcrumb-wrap">
		  <div class="container">
		    				<div class="row">
					<div class="span12">
						<h1>EBSU Admission Status</h1>
						<span style="font-size:23px; color:#F90;">(Please Enter Your Details.)</span>
					</div>
				</div>
			</div>
		</section>
	  	  
	  	  <div id="content" class="content full">
	    <div class="container">
	      <div class="row">
	      
			    			
					<div class="span12">
					  
					  					  
			     				      			      			
					    <div class="region region-content">
    <div id="block-system-main" class="block block-system">

    
  <div class="content">
    <div id="node-6" class="node node-page clearfix" about="/contact-us" typeof="foaf:Document">

  
      <span property="dc:title" content="Contact Us" class="rdf-meta element-hidden"></span><span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span>
  <h4 class="short">&nbsp;</h4>
  <span style="color:#900; margin-left:20px;"><?php echo validation_errors(); ?><?php if(isset($_SESSION["error"])){echo $_SESSION["error"]; 
  }?></span>
  <div class="content">
    <div class="row">
  <h4><?php echo form_open('admissions/verify_hnd_appno');?>
  </h4>
  <div class="span3">
    
    
    <div>
  <div class="form-item webform-component webform-component-textfield" id="webform-component-name">
    <h4>
     Choose your program type
    </h4>
  </div> <div class="form-item webform-component webform-component-textfield" id="webform-component-name">
  <h4>Search Pattern</h4>
</div> 
<div id="appnoLabel" style="display:none">  
<div class="form-item webform-component webform-component-textfield" id="webform-component-name">
  <h4>Jamb Reg No </h4>
</div></div>
<div id="candNameLabel"  style="display:none">  
<div class="form-item webform-component webform-component-textfield" id="webform-component-name">
  <h4>Type First name, middle name or last name and search </h4>
</div></div>




 <div class="form-actions form-wrapper span4" id="edit-actions"><input type="submit" id="edit-submit" name="op" value="Check Admission Status" class="btn-primary btn form-submit" /></div>
 	



</div>
    
   
</div><div class="span4">
<div class="form-item webform-component webform-component-select" id="webform-component-subject"><table width="auto" rules="none">
    <tr>
    <?php
	foreach($progtype->result() as $progtype2){?>
      <td width="auto"><label>
        <input type="radio" name="program_code" value="<?php echo $progtype2->program_code; ?>" id="program_code_0" required="required" />
        <?php echo $progtype2->application_type; ?></label></td><? } ?>
    
      
    </tr>
</table></div><div class="form-item webform-component webform-component-select" id="webform-component-subject">
  <table width="357" rules="none">
    <tr>
      <td width="192"><label>
        <input type="radio" name="searchpatt" value="appno" id="searchpatt_0" onclick="checkP(this.value);" required="required" />
        By Jamb Reg. Number</label></td>
    
      <td width="153"><label>
        <input type="radio" name="searchpatt" value="candName" id="searchpatt_1" onclick="checkP(this.value);" required="required"  />
        By Name</label></td>
    </tr>
  </table>
  <input type="hidden" name="application_no2" id="hidden" />
</div>
<div id="appno" style="display:none">
<div class="form-item webform-component webform-component-select" id="webform-component-subject"><input type="text" id="application_no" name="application_no" value="<?php echo set_value('application_no'); ?>"  style="width:90%;" maxlength="70" class="form-text required" required="required" placeholder="" /></div></div>

<div id="candName" style="display:none"><div class="form-item webform-component webform-component-select" id="webform-component-subject">
  <label for="name"></label>
  <input type="text" name="name" id="name" required="required"; /> 
  <input type="button" id="edit-submit2" name="edit-submit" value="Search" class="btn-primary btn form-submit2" onclick="dispName(this);"/><div id="name_area"></div></div></div>
</p></div>

<?php echo form_close(); unset($_SESSION["error"]);?>
</div>
   </div>

 
  
</div>
  </div>
</div>
  </div>
					</div>
			  
				  			    
			  </div>
	    </div>  
	  </div>  
 
		 
	  
	</div><?php }?>