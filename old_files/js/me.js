function getXMLHTTP(){
	var xmlHttp=null;
	try{
		xmlHttp=new XMLHttpRequest();}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
	}return xmlHttp;
}
function delay(){
	window.location.href = 'index.php?register/register2';
}

function login(){
	window.location.href = 'index.php?register/register1';
}
function verify(a, b, c){

	var a = document.getElementById(a).value;
	var b = document.getElementById(b).value;
	var c = document.getElementById(c).value;
	 if(a == 'JAMB REG NUMBER' && b == ''){
	   document.getElementById('result').innerHTML = 'Please enter Your JAMB Reg Number.';
	 }else if(a == 'MATRICULATION NUMBER' && c == ''){
		document.getElementById('result').innerHTML = 'Please enter Your Matric Number.';
	 }else if(a == 'JAMB REG NUMBER' && b != ''){
  	document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Loading...";

  	var req = getXMLHTTP(); // fuction to get xmlhttp object

     //	strURL = "js/verify.php?serial=" + a + "&pin=" + b;
  	strURL = "js/verify.php?serial=" + b;
  	if (req){
  		req.onreadystatechange = function(){
  			if (req.readyState == 4){ //data is retrieved from server
  				if (req.status == 200){ // which reprents ok status
  					var result = req.responseText;
  					//document.getElementById('result').innerHTML = result;

  					if(result == 'ok'){
  					   //alert("am here");
  						document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Redirecting, You are a Register User...";
                        //alert("am here");
  						setTimeout('login()', 3);
  					}else if(result != 'ok'){

  						document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Redirecting...";
  						setTimeout('delay()', 3);
  					}
                      //else{document.getElementById('result').innerHTML = result;}
  					//}else{window.location.href = 'index.php?login';}
  				}else{alert("There was a problem while using XMLHTTP:\n");}
  			}
  		}
  		req.open("GET", strURL, true); //open url using get method
  		req.send();
  	}else{alert('failed');}
    }else if(a == 'MATRICULATION NUMBER' && c != ''){
		document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Loading...";

  	var req = getXMLHTTP(); // fuction to get xmlhttp object

     //	strURL = "js/verify.php?serial=" + a + "&pin=" + b;
  	strURL = "js/verify.php?serial=" + c;
  	if (req){
  		req.onreadystatechange = function(){
  			if (req.readyState == 4){ //data is retrieved from server
  				if (req.status == 200){ // which reprents ok status
  					var result = req.responseText;
  					//document.getElementById('result').innerHTML = result;

  					if(result == 'ok'){
  					   //alert("am here");
  						document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Redirecting, You are a Register User...";
                        //alert("am here");
  						setTimeout('login()', 3);
  					}else if(result != 'ok'){

  						document.getElementById('result').innerHTML = "<img src='images/loaders/loader17.gif'> Redirecting...";
  						setTimeout('delay()', 3);
  					}
                      //else{document.getElementById('result').innerHTML = result;}
  					//}else{window.location.href = 'index.php?login';}
  				}else{alert("There was a problem while using XMLHTTP:\n");}
  			}
  		}
  		req.open("GET", strURL, true); //open url using get method
  		req.send();
  	}else{alert('failed');}
	}
}

function processAccommodation(a, b, c, d, e, f){
	var a = document.getElementById(a).value;
	var b = document.getElementById(b).value;
	var c = document.getElementById(c).value;
	var d = document.getElementById(d).value;
	var e = document.getElementById(e).value;
	var f = document.getElementById(f).value;

	//alert(a + b + c + d + e + f);

	var req = getXMLHTTP(); // fuction to get xmlhttp object

	strURL = "processAccommodation.php";//?serial=" + a + "&pin=" + b;
	if (req){
		req.onreadystatechange = function(){
			if (req.readyState == 4){ //data is retrieved from server
				if (req.status == 200){ // which reprents ok status
					var result = req.responseText;
					document.getElementById('result').innerHTML = result;

				}else{alert("There was a problem while using XMLHTTP:\n");}
			}
		}
		req.open("GET", strURL, true); //open url using get method
		req.send();
	}else{alert('failed');}
}

function showReg(a){
	if(a == 'sreg'){
		document.getElementById('screg').style.display = 'block';
		document.getElementById('jareg').style.display = 'none';
	}else if(a == 'jreg'){
		document.getElementById('jareg').style.display = 'block';
		document.getElementById('screg').style.display = 'none';
	}else{
		alert('Please select an option!');
		document.getElementById('jareg').style.display = 'none';
		document.getElementById('screg').style.display = 'none';
	}
}