<div>
 <?php 
session_start();

	
echo form_open('index.php?pay_auth/search_hcp_enrolees_report_daily', array('class' => 'form-horizontal form-groups validate invoice-add', 'enctype' => 'multipart/form-data')); ?>

<b><h1> STATISTICAL RECORDS </h1></b>         



<br>
 <table class="table table-bordered table-striped datatable" id="table-2" style="width: 100%">
   

    <tbody>
     
	
	 <tr>
          <td >1 </td>
		  <td >NO OF ACTIVE FILE </td>
          <td ><?php 
          echo $this->db->count_all_results('erp_documents');
		  ?> </td>        

    </tr>
	
	<tr>
          <td >2 </td>
		  <td >NO OF PENDING FILE </td>
          <td ><?php 
                echo $this->db->query("select* from erp_documents where status ='untreated' OR status = 'MINUTED' OR status='kid' OR status = 'AWAITING MINUTING/APPROVAL'")->num_rows();
            ?> </td>        
                    
                       
    </tr>
		<tr>
          <td >3 </td>
		  <td >NUM OF MEEETINGS </td>
		  <td ><?php echo $this->db->count_all_results('erp_meetings'); ?> </td>        

    </tr>
	
	</tr>
		<tr>
          <td >4 </td>
		  <td >MEETING TRACK NUM </td>
		  <td >2<?php  ?> </td>        

    </tr>
	
	<tr>
          <td >5</td>
		  <td >NUM OF MEMO</td>
		  <td ><?php echo $this->db->count_all_results('erp_memo'); ?> </td>        

    </tr>

    <tr>
          <td >6 </td>
		  <td >NO ON ANNUAL </td>
          <td ><?php 
                echo $this->db->query("select* from sadmin where active_status ='ANNUAL LEAVE'")->num_rows();
            ?> </td>        
                    
                       
    </tr>

    <tr>
          <td >7 </td>
		  <td >NO ON DISCIPLINARY ACTION </td>
          <td ><?php 
                echo $this->db->query("select* from sadmin where active_status ='DISCIPLINARY ACTION'")->num_rows();
            ?> </td>        
                    
                       
    </tr>
    <tr>
          <td >8 </td>
		  <td >NO ON RETIREMENT </td>
          <td ><?php 
                echo $this->db->query("select* from sadmin where active_status ='RETIRED'")->num_rows();
            ?> </td>        
                    
                       
    </tr>
    <tr>
          <td >9 </td>
		  <td >NO ON SICK PERMISSION </td>
          <td ><?php 
                echo $this->db->query("select* from sadmin where active_status ='SICK PERMISSION'")->num_rows();
            ?> </td>        
                    
                       
    </tr>
	 
    </tbody>
</table>
