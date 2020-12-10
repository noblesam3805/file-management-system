
        <script type="text/javascript">
			$(document).ready(function(){
				//alert('good');
				function search(){

					  var title = $("#search").val();

					  if(title != ""){
						$("#ajaxLoader").html("<img src='gif/preloader.gif' width='60px' height='60px' />");
						//$("#result").html("Loading...");
						 $.ajax({
							type:"post",
							url:"search.php",
							data:"title="+title,
							success:function(data){
								$("#ajaxLoader").html("<i class='glyphicon glyphicon-info-sign'></i>");
								$("#result").html(data);
								//$("#search").val("");
							 }
						  });
					  }else{
						document.getElementById('result').innerHTML = '';
					}
				}
				
				var controller = 'sadmin';
				var base_url = '<?php echo base_url() . 'index.php'; ?>';
				

				function load_data(type){
					var val = $("#search").val();
					$("#ajaxLoader").html("<img src='gif/preloader.gif' width='60px' height='60px' />");
					$.ajax({
						'url' : base_url + '?' + controller + '/do_ajax/search/' + val,
						'type' : 'POST', //the way you want to send data to your URL
						'data' : {'type' : 'value'},
						'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
							var container = $('#result'); //jquery selector (get element by id)
							if(data){
								$("#ajaxLoader").html("<i class='glyphicon glyphicon-info-sign'></i>");
								container.html(data);
							}
						}
					});
				}
				
				function showEditForm(a){
					$.ajax({
					type:"post",
					url:base_url + '?' + controller + '/do_ajax/edit/' + a,
					data:{'type' : 'value'},
					success:function(data){
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#editResult").html(data);
						document.getElementById('result').innerHTML = '';
						
						//$("#search").val("");
					 }
				  });
				}

				/*$("#search").keyup(function(){
				if($('#search').val() == ''){
					document.getElementById('result').innerHTML = '';
				}else{
					search();
				}
				});*/
	  
				  $(document).keyup(function(e){
					if(e.keyCode == 27){
						document.getElementById('result').innerHTML = '';
					}
				  });

				  $('#search').keyup(function(e) {
					 if(e.keyCode == 13) {
						//search();
						load_data();
					  }
					  if(e.keyCode == 8 && $('#search').val() == ''){
						document.getElementById('result').innerHTML = '';
					  }
				  });
				  
				  
				  
				  
				
			});

function printDiv() {

     var printContents = document.getElementById('print').innerHTML;

     var originalContents = document.body.innerHTML;



     document.body.innerHTML = printContents;



     window.print();



     document.body.innerHTML = originalContents;

}
/*
function showEditForm(a){
	$.ajax({
	type:"post",
	url:"editData.php",
	data:"title="+a,
	success:function(data){
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$("#editResult").html(data);
		document.getElementById('result').innerHTML = '';
		
		//$("#search").val("");
	 }
  });
}*/
  function Departments(a){
	
	$.ajax({
	type:"post",
	url:"assets/allDepartments.php",
	data:"q="+a,
	success:function(data){
		$("#departments").html(data);
		//$("#search").val("");
	 }
  });
}

function adda(){
//alert('a');

document.getElementById('gre').innerHTML += "<div class='col-md-12'><div class='col-md-6'><div class='form-group eduportal-form-group p20'><label class='label-control'>Department</label><div class='input-group input-group-lg eduportal-input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-font'></i></span><select name='dpt[]' class='form-control' ><option>Select A Department</option><?php $q5 = mysql_query('select * from department'); while($r5 = mysql_fetch_assoc($q5)){ ?> <option value='<?php echo $r5['deptID']; ?>'> <?php echo $r5['deptName']; ?> </option> <?php } ?></select></div></div></div><div class='col-md-6'><div class='form-group eduportal-form-group p20'><label class='label-control'>Credit Load</label><div class='input-group input-group-lg eduportal-input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-font'></i></span><input type='text' name='cload[]' class='form-control' />    </div></div></div>   </div>";

/*var a = 1;
$.ajax({
	type:"post",
	url:"add.php",
	data:"title="+a,
	success:function(data){
		//$("#result").html(data);
		//$("#search").val("");
		document.getElementById('gre').innerHTML += data;
	 }
});*/
}

function clrall(){
	document.getElementById('gre').innerHTML = '';
}
function clearEdit(){
	document.getElementById('editResult').innerHTML = '';
}

$(function() { //When the document loads
  $("#nceLink").bind("click", function() {
    $(window).scrollTop($("#ncetable").offset().top); //scroll to div with container as ID.
    return false; //Prevent Default and event bubbling.
  });
});

$(function() { //When the document loads
  $("#degreeLink").bind("click", function() {
    $(window).scrollTop($("#degreetable").offset().top); //scroll to div with container as ID.
    return false; //Prevent Default and event bubbling.
  });
});

		var controller = 'sadmin';
		var base_url = '<?php echo base_url() . 'index.php'; ?>';
		
		function showEditForm(a){
			$.ajax({
			type:"post",
			url:base_url + '?' + controller + '/do_ajax/edit/' + a,
			data:{'type' : 'value'},
			success:function(data){
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$("#editResult").html(data);
				document.getElementById('result').innerHTML = '';
				
				//$("#search").val("");
			 }
		  });
		}



</script>

<style type="text/css">
	.row{
		margin-left:0px !important;
		padding:10px 0px 0px 0px;
	}
	thead{
	}
	#nceLink, degreeLink{
		cursor:pointer;
	}
	.nav-tabs.bordered{
		margin:0px 15px !important;
	}
	.tab-content{
		padding:0px 15px !important;
		border:none !important;
	}
</style>


<div class="search-row">
	<div class="col-md-12 search-line" style="float:left;">
		<div class="col-md-2 search-text">
			<p>Search</p>
		</div>
		<div class="col-md-10">
			<div class="form-group form-group-lg search-wrap">
				<input type="text" id="search" class="form-control" placeholder="Keyword... [ press esc to exit results ]" style="height:50px;" />
				<span class="ajax-loader" id="ajaxLoader"><i class="glyphicon glyphicon-info-sign"></i></span>
			</div>
		</div>
		<div class="result-details col-md-12" id="result">
		</div>
	</div></div>
</div>


			
			<?php
			if(isset($_SESSION['report'])){
				unset($_SESSION['report']);
			}
			?>
			
		<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        

        var datatable = $("#degreetable").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
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
    
	
	jQuery(document).ready(function($)
    {
        

        var datatable = $("#ncetable").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
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
    

