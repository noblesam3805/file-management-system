$(document).ready(function(){
               alert('it works');   
	 /*function search(){

		  var title = $("#search").val();

		  if(title != ""){
			$("#result").html("<img src='ajax-loader.gif'/>");
			 $.ajax({
				type:"post",
				url:"search.php",
				data:"title="+title,
				success:function(data){
					$("#result").html(data);
					//$("#search").val("");
				 }
			  });
		  }else{
			document.getElementById('result').innerHTML = '';
		  }
		   

		  
	 }

	  $("#search").keyup(function(){
		if($('#search').val() == ''){
			document.getElementById('result').innerHTML = '';
		}else{
			search();
		}
	  });
	  
	  $(document).keyup(function(e){
		if(e.keyCode == 27){
			document.getElementById('result').innerHTML = '';
		}
	  });

	  $('#search').keyup(function(e) {
		 if(e.keyCode == 13) {
			search();
		  }
		  if(e.keyCode == 8 && $('#search').val() == ''){
			document.getElementById('result').innerHTML = '';
		  }
	  });*/
});