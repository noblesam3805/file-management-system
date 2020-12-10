<?php
	
?>

<script type="text/javascript">
	$(document).ready(function(){

		//alert('good');

		function getLGA(){

			  var state = $("#states").val();

			  if(state != ""){
				 $.ajax({
					type:"post",
					url:"<?php echo base_url() . 'index.php?staff_registration/getLGA'; ?>",
					data:"state=" + state,
					success:function(data){
						alert(data);
						$("#lga").html(data);
					 }
				  });
			  }else{
				document.getElementById('result').innerHTML = '';
			  }  
		}
		
		$("#programme").change(function(){
			getProgDept();
		});
		
		$("#staff_school").change(function(){
			getStaffDepartments();
		});
		function getStaffDepartments(){

			  var school = $("#staff_school").val();

			  if(school != ""){
				 $.ajax({
					type:"post",
					url:"<?php echo base_url() . 'index.php?staff_registration/getStaffDepartments'; ?>",
					data:"school=" + school,
					success:function(data){
						//alert(data);
						
						$("#staff_dept").html(data);
					 }
				  });
			  }else{
				document.getElementById('result').innerHTML = '';
			  }  
		}
		
			$("#staff_school2").change(function(){
			getStaffDepartments2();
		});
		function getStaffDepartments2(){

			  var school = $("#staff_school2").val();

			  if(school != ""){
				 $.ajax({
					type:"post",
					url:"<?php echo base_url() . 'index.php?staff_registration/getStaffDepartments'; ?>",
					data:"school=" + school,
					success:function(data){
						//alert(data);
						
						$("#staff_dept2").html(data);
					 }
				  });
			  }else{
				document.getElementById('result').innerHTML = '';
			  }  
		}
		
		$("#programme").change(function(){
			getProgDept();
		});
		
		function getProgDept(){
			
			var prog = $("#programme").val();
			
			if(prog != ""){
				
				$.ajax({
					type:"post",
					url:"<?php echo base_url() . 'index.php?putme/getProgDept/'; ?>" + prog,
					data:"programme=" + prog,
					success:function(data){
						$("#dept").html(data);
					}
				});
				
			}
		}


		$('#states').change(function(e) {
			//alert("Hello");
			getLGA();
		});

		$("#foreign").on('click', function(){
			$('.nigerian-form').fadeOut('slow');
			$('.foreign-form').fadeIn('slow');
		});
		$("#nigerian").on('click', function(){
			$('.nigerian-form').fadeIn('slow');
			$('.foreign-form').fadeOut('slow');
		});

		$('.jambscore').change(function(){
			var eng = $('#eng').val();
			var subj1 = $('#subj1').val();
			var subj2 = $('#subj2').val();
			var subj3 = $('#subj3').val();

			var total = Number(eng) + Number(subj1) + Number(subj2) + Number(subj3);
			var txt = 'Your Jamb Score is : &nbsp; '
			$('#jambresult').html(txt + total);
		});

		$('#continueReg').click(function(){
			$('#continueform').toggle('slow');
			$('#startform').fadeOut('slow');
		});
		$('#startReg').click(function(){
			$('#startform').toggle('slow');
			$('#continueform').fadeOut('slow');
		});
		
		
		// the programme
		$('#programme').change(function(){
			var prog = $("#programme").val();
			showDept(prog);
		});

		function showDept(a){
			if(a == 'DEGREE'){
				
				$('#nceDept').fadeOut();
				$('#degreeDept').fadeIn(4000);
			}else if(a == 'NCE'){
				$('#degreeDept').fadeOut();
				$('#nceDept').fadeIn(4000);
			}else if(a == ''){
				$('#degreeDept').fadeOut();
				$('#nceDept').fadeOut();
			}
		}

	});
	
	
	function checkPass(){
		//Store the password field objects into variables ...
		var pass1 = document.getElementById('pass1');
		var pass2 = document.getElementById('pass2');
		//Store the Confimation Message Object ...
		var message = document.getElementById('confirmMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field
		//and the confirmation field
		if(pass1.value == pass2.value){
			//The passwords match.
			//Set the color to the good color and inform
			//the user that they have entered the correct password
			pass2.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			pass2.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}
	
	function checkPassf(){
		//Store the password field objects into variables ...
		var pass1 = document.getElementById('pass1f');
		var pass2 = document.getElementById('pass2f');
		//Store the Confimation Message Object ...
		var message = document.getElementById('confirmMessagef');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field
		//and the confirmation field
		if(pass1.value == pass2.value){
			//The passwords match.
			//Set the color to the good color and inform
			//the user that they have entered the correct password
			pass2.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			pass2.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}
</script>