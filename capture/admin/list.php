<?php
include_once("header.php");
include_once("sidebar.php");
?>

<!--PAGE CONTENT -->
        <div id="content">

            
 <?php

$content = '';
$data="";
 $pagename="Dashboard";
   include_once("../config.php");
  db_connect();
if(isset($_GET['data'])) {

  $data = $_GET['data'];
  $pagename="Dashboard";
  //echo $pagename;
  
  
  if($data == 'admin')
    
	{
		$content = list_data("admin",array('id','admin_name','gender'));
		$pagename="View Administrators ";
		
	}
  else 
  {
	   $pagename="Dashboard";
	//  $content = list_data('customer',array('id','first_name','last_name','phone','account_number'));
	 
  }
 if($data=='customers')
 {
	// $content = list_data("admin",array('id','admin_name','gender'));
		$pagename="View Customers ";
 }
  
}



?>
<div class="inner" style="min-height: 700px;">
               
			   <div class="row">
                    <div class="col-lg-12">
                        <h1> <?php echo $pagename;?> </h1>
                    </div>
                </div>

<?php
if(!$data)
{
  include_once "menu.php";
}
 ?>
 <div class="row">
              <div class="col-lg-12"></div>
              <div class="col-lg-12">
              <div class="row">
			  <?php
			  
			  if($data == 'admin')
    
	{
			  ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Admin Accounts
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length"><label><select name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="col-sm-6"><div id="dataTables-example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" aria-controls="dataTables-example"></label></div></div></div><table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                        <tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending" style="width: 191px;">S/N</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 263px;">Admin Name</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 243px;">Gender</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 166px;">Account Role </th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 123px;"> Status</th></tr>
                                    </thead>
                                    <tbody>
                                        
                                  
                                        
                                        <?php 
										$count= 1;
										$query = mysql_query("select* from admin") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results=mysql_fetch_array($query))
										{
											?>
										
										
                                    <tr class="<?php if(   $count % 2  ) { echo "gradeA odd";} else {echo "gradeA odd";}?>">
                                            <td class="sorting_1"><?php echo $count;?></td>
                                            <td class=" "><?php echo $results["admin_name"];?></td>
                                            <td class=" "><?php echo $results["gender"];?></td>
                                            <td class="center "><?php echo $results["user_role"];?></td>
                                            <td class="center "><?php echo $results["account_stats"];?></td>
                                        </tr>
										
										<?php $count++; }?>
										</tbody>
                                </table><div class="row"><div class="col-sm-6"><div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li></ul></div></div></div></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
				
	<?php }?>
	
	 <?php
			  
			  if($data == 'customers')
    
	{
			  ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Customers 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length"><label><select name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="col-sm-6"><div id="dataTables-example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" aria-controls="dataTables-example"></label></div></div></div><table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                        <tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending" style="width: 21px;">S/N</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 200px;">Fullname</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 123px;">Account No</th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 106px;">Gender </th>
										<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 123px;"> Address</th>
													<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 123px;"> Passport</th>
														<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 123px;"> Status</th></tr>
                                    </thead>
                                    <tbody>
                                        
                                  
                                        
                                        <?php 
										$count= 1;
										$query = mysql_query("select* from customer where account_number<>''") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results=mysql_fetch_array($query))
										{
											?>
										
										
                                    <tr class="<?php if(   $count % 2  ) { echo "gradeA odd";} else {echo "gradeA odd";}?>">
                                            <td class="sorting_1"><?php echo $count;?></td>
                                            <td class=" "><?php echo $results["first_name"].' '.$results["middle_name"].' '.$results["last_name"];?></td>
                                            <td class=" "><?php echo $results["account_number"];?></td>
                                            <td class="center "><?php echo $results["gender"];?></td>
                                            <td class="center "><?php echo $results["address"];?></td>
											<td class="center "><img src="<?php echo $results["passport"];?>" style="height:100px; width:100px"/></td>
											<td class="center "><?php echo $results["status"];?>
											<?php 
											$acct=$results["account_number"];
											if($results["status"]=="Blocked")
											{
												
												?>
										<a href="reactivateacct.php?acct=<?php echo $acct;?>">Re-Activate Account</a>
											<?php }?>
											</td>
                                        </tr>
										
										<?php $count++; }?>
										</tbody>
                                </table><div class="row"><div class="col-sm-6"><div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li></ul></div></div></div></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
				
	<?php }?>
            </div>
              </div>
              <div class="col-lg-3"></div>
                </div>

            </div>

        </div>
<?php


include_once "rsidebar.php";
include_once "footer.php";
?>
