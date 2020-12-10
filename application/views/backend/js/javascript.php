<?php
	//session_start();
?>

<script type="text/javascript">
// JavaScript Document
//DATE TOGGLE
//Day
function ToggleDay(val){

//YEAR
yr = document.getElementById("yr").value;
	$("#CurrentDay").load('<?php echo base_url() . 'date_format/ToggleDay/'; ?>'+val+"/"+yr)

}
//MONTH
function ToggleMonth(val){
		$("#CurrentMonth").load('<?php echo base_url() . 'date_format/ToggleMonth/'; ?>'+val)

}

///DISPLAY FIELD
function disp(val){
place = "view"+ val;
chk = document.getElementById(place).style.display;
	if(chk == "block"){
	document.getElementById(place).style.display="none";	
	}
	else{
	document.getElementById(place).style.display="block";
	//FOR SEARCH
		if(val == "Find"){
			display=document.getElementById("factorName").value	;
			document.getElementById("searchElement").placeholder=display;
		}
	}	
}
//Convert space to underscore
function underScoreField(val){
	var
	data_text = document.getElementById(val).value;
 	data_text = data_text.replace(" ","_");
	document.getElementById(val).value = data_text;	
	
}

//Release required field
function NoReq(val){
  document.getElementById(val).required=false;	
}
//Get filtered departments
function getDepts(fact_id){
$("#dept_area").load('<?php echo base_url() . 'quota/get_dept/'; ?>'+fact_id)
}
//get staff
function getStaff(dept_id){
	view = document.getElementById("view_type").value;
	staffType = document.getElementById("staff_type").value;
$("#staff_area").load('<?php echo base_url() . 'fetcher/get_staff/'; ?>'+dept_id+"/"+view+'/'+staffType)
}

//Get LGAs
function getLGA(state_id){
$("#lga_area").load('<?php echo base_url() . 'fetcher/get_lga/'; ?>'+state_id)
}

//ACTION BOX

function close_actionBox(){
	document.getElementById("action_box").style.display="none";
	document.getElementById("users_panel").style.display="block";
}
//user account action
function acct_action(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//UserID
		userID = val.replace(button_Acct,"");
		document.getElementById("SID").value=userID;
		
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;
		
		if(button_Acct=="M"){
			document.getElementById("action_box").style.position="relative";
			document.getElementById("action_box").style.left="0px";
			document.getElementById("action_box").style.bottom="0px";
			document.getElementById("users_panel").style.display="none";
			
			document.getElementById("modify_acct").style.display="block";
			$("#roles_area").load('<?php echo base_url() . 'fetcher/get_userFunct/'; ?>'+userID);
		document.getElementById("box_butt_area").innerHTML="<input type='submit' id='edit-submit' name='confirm' value='Done' class='btn-primary btn form-submit' onclick='close_actionBox(this)' />";	
		}
		else{
			document.getElementById("action_box").style.position="fixed";
			document.getElementById("action_box").style.bottom="100px";
			document.getElementById("action_box").style.left="400px";
			document.getElementById("users_panel").style.display="block";
			
			document.getElementById("modify_acct").style.display="none";
			document.getElementById("box_butt_area").innerHTML="<input type='submit' id='edit-submit' name='confirm' value='Save' class='btn-primary btn form-submit' />";			
		}
}
function votebk_action(val){
	document.getElementById("action_box").style.display="block";
	document.getElementById("action_box").style.position="relative";
	document.getElementById("action_box").style.left="0px";
	document.getElementById("action_box").style.bottom="0px";
	document.getElementById("users_panel").style.display="none";
	document.getElementById("vote_bk_id").value=val;
	$("#modify_acct").load('<?php echo base_url() . 'fetcher/get_voteBkInfo/'; ?>'+val);

}
//CHART OF ACCOUNTS
function c_of_a_action(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//ID
		target_ID = val.replace(button_Acct,"");
		document.getElementById("ID").value=target_ID;
		cLevel = document.getElementById(val+"_Level").value//Head or Cat
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;//Desc
		document.getElementById("level").value=cLevel;
		
		if(button_Acct=="E"){
			document.getElementById("details").style.display="block";
			document.getElementById("code_name").required=true;
			document.getElementById("code_no").required=true;
			if(cLevel == "head"){
				$("#details").load('<?php echo base_url() . 'fetcher/get_acctInfoHd/'; ?>'+target_ID);	
			}
			else{
				refID = document.getElementById("refn_cat_id").value
				$("#details").load('<?php echo base_url() . 'fetcher/get_acctInfoCt/'; ?>'+target_ID);	
			}
		}
		else if(button_Acct=="A"){
			document.getElementById("details").style.display="block";
			document.getElementById("code_name").value="";
			document.getElementById("code_no").value="";
			document.getElementById("code_name").required=true;
			document.getElementById("code_no").required=true;
		}
		else{
			document.getElementById("code_name").required=false;
			document.getElementById("code_no").required=false;
			document.getElementById("details").style.display="none";
			
		}


		
		if(button_Acct=="M"){
			document.getElementById("action_box").style.position="relative";
			document.getElementById("action_box").style.bottom="0px";
			document.getElementById("users_panel").style.display="none";
			
			document.getElementById("modify_acct").style.display="block";
			$("#roles_area").load('<?php echo base_url() . 'fetcher/get_userFunct/'; ?>'+userID);
		document.getElementById("box_butt_area").innerHTML="<input type='submit' id='edit-submit' name='confirm' value='Done' class='btn-primary btn form-submit' onclick='close_actionBox(this)' />";	
		}
		else{
			document.getElementById("action_box").style.position="fixed";
			document.getElementById("action_box").style.bottom="100px";
			document.getElementById("users_panel").style.display="block";
			
			document.getElementById("modify_acct").style.display="none";
			document.getElementById("box_butt_area").innerHTML="<input type='submit' id='edit-submit' name='confirm' value='Save' class='btn-primary btn form-submit' /> <input type='submit' id='edit-submit2' name='confirm' value='Cancel' class='btn-primary btn form-submit' />";			
		}
}

function new_utility_action(tab_name){
		document.getElementById("action_box").style.display="block";
		document.getElementById("action_name").innerHTML=document.getElementById("actionName").value;
		document.getElementById("table").value=tab_name;
}


//DEPT
function dept_action(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//ID
		target_ID = val.replace(button_Acct,"");
		document.getElementById("ID").value=target_ID;
		cLevel = document.getElementById(val+"_Level").value//Head or Cat
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;//Desc
		document.getElementById("level").value=cLevel;
		
		if(button_Acct=="E"){
			document.getElementById("details").style.display="block";
			document.getElementById("code_name").required=true;
			if(cLevel == "head"){
				$("#details").load('<?php echo base_url() . 'fetcher/get_acctInfoHd/'; ?>'+target_ID);	
			}
			else{
				$("#details").load('<?php echo base_url() . 'fetcher/get_deptInfo/'; ?>'+target_ID);	
			}
		}
		else if(button_Acct=="A"){
			document.getElementById("details").style.display="block";
			document.getElementById("code_name").value="";
			document.getElementById("code_name").required=true;
			document.getElementById("codeArea").style.display="none";
		}
		else{
			document.getElementById("code_name").required=false;
			document.getElementById("details").style.display="none";
			
		}


		
}

function open_box(){
document.getElementById("action_box").style.display="block";	
}
//Alert Types
function alert_action(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//ID
		target_ID = val.replace(button_Acct,"");
		document.getElementById("ID").value=target_ID;
		cLevel = document.getElementById(val+"_Level").value//Head or Cat
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;//Desc
		document.getElementById("level").value=cLevel;
		
		if(button_Acct=="E"){
			document.getElementById("details").style.display="block";
				$("#details").load('<?php echo base_url() . 'fetcher/get_alertInfo/'; ?>'+target_ID);	
		}
		else if(button_Acct=="A"){
			document.getElementById("details").style.display="block";
			document.getElementById("details").innerHTML="<table width='80%' align='center' cellpadding='5' cellspacing='5' rules='none'><tr><td valign='top'><textarea name='alert_name' cols='auto' class='form_box_style' id='alert_name' required='required' placeholder='Enter Alert name'></textarea></td><td valign='top'><input type='text' onkeydown='underScoreField(this.id);' onkeypress='underScoreField(this.id);' onkeyup='underScoreField(this.id);' name='alert_common_name'  placeholder='Enter Alert Common name'id='alert_common_name' class='form_box_style' required='required' width='auto' ></td><td valign='top'><select name='alert_path_name' id='alert_path_name'  required='required' class='dropDown_box'><option value=''>Select</option><option value='reversed'>reversed</option><option value='reclassed'>reclassed</option><option value='normal'>normal</option></select></td><td valign='top'><div id='alertArea'></div></td></tr></table>";
			$("#alertArea").load('<?php echo base_url() . 'fetcher/getAlerts'; ?>');	
			document.getElementById("alert_name").value="";
			document.getElementById("alert_common_name").value="";
			document.getElementById("alert_name").required=true;
			document.getElementById("alert_common_name").required=true;
		}
		else{
			document.getElementById("alert_name").required=false;
			document.getElementById("alert_common_name").required=false;
			document.getElementById("details").style.display="none";
			
		}
}
//Error types
function error_action(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//ID
		target_ID = val.replace(button_Acct,"");
		document.getElementById("ID").value=target_ID;
		//cLevel = document.getElementById(val+"_Level").value//Head or Cat
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;//Desc
		//document.getElementById("level").value=cLevel;
		
		if(button_Acct=="E"){
			document.getElementById("details").style.display="block";
				$("#details").load('<?php echo base_url() . 'fetcher/get_errorInfo/'; ?>'+target_ID);	
		}
		else if(button_Acct=="A"){
			document.getElementById("details").style.display="block";
			document.getElementById("details").innerHTML="<table width='80%' align='center' cellpadding='5' cellspacing='5' rules='none'><tr><td valign='top'><input name='error_title' type='text' class='form_box_style' id='error_title' value='' size='auto' required='required' placeholder='Error title'></td><td valign='top'><textarea name='error_notes' cols='50' rows='5' class='form_box_style' id='error_notes'  placeholder='Error Notes' required='required' width='auto'></textarea></td><td valign='top'></td></tr></table>";
			document.getElementById("error_title").required=true;
			document.getElementById("error_notes").required=true;
		}
		else{
			document.getElementById("alert_name").required=false;
			document.getElementById("alert_common_name").required=false;
			document.getElementById("details").style.display="none";
			
		}
}
//RETIREMENT ACTION BOX
function ret_acct_action(val){
	
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//UserID
		userID = val.replace(button_Acct,"");
		document.getElementById("SID").value=userID;
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;
		
			document.getElementById("action_box").style.position="relative";
			document.getElementById("action_box").style.left="0px";
			document.getElementById("action_box").style.bottom="0px";
			document.getElementById("users_panel").style.display="none";
			
			$("#details_area").load('<?php echo base_url() . 'fetcher/ret_details/'; ?>'+userID);
		
}

function getSubFunct(function_id){//Populate user's subfunctions
var
user_data_id = document.getElementById("SID").value;

$("#subFunctArea").load('<?php echo base_url() . 'fetcher/get_sub_funct/'; ?>'+function_id+"/"+user_data_id)
}

function chgDiv(div_id){//Change user's division
var
user_data_id = document.getElementById("SID").value;
$("#roles_area").load('<?php echo base_url() . 'setup/chg_div/'; ?>'+div_id+"/"+user_data_id)
}

function chgPost(post_val){//Change user's Post
var
user_data_id = document.getElementById("SID").value;
$("#roles_area").load('<?php echo base_url() . 'setup/chg_post/'; ?>'+post_val+"/"+user_data_id)
}


function check_exist(target){//Check if username already exist
var

page_mode = document.getElementById("mode").value;
cond = document.getElementById("condition").value;
 value = document.getElementById(target).value;
 table = document.getElementById(target+"_table").value;
 place = target+"_area";
 label = document.getElementById(target+"_label").value;
 value = value.replace("/","__________");
 $("#"+place).load('<?php echo base_url() . 'fetcher/check_exist/'; ?>'+table+'/'+target+'/'+value+'/'+label+'/'+page_mode+'/'+cond);//Table:Column name:value:Label:Mode:Condition

}

function addSubFunct(sub_function_id){//Add  sub function
var
user_id = document.getElementById("SID").value;
$("#roles_area").load('<?php echo base_url() . 'setup/add_sub_funct/'; ?>'+sub_function_id+"/"+user_id)
}

function removeSubFunct(role_id){//Remove user's sub function
var
user_data_id = document.getElementById("SID").value;
$("#roles_area").load('<?php echo base_url() . 'setup/remove_sub_funct/'; ?>'+role_id+"/"+user_data_id)
}


//DIVISION FUNCTIONS
function assigFunct(val){
	var
	val2 = val.replace("A","");
	div_id = document.getElementById("div_id").value;
		

	if(div_id==""){
		alert("Select a division");	
	}
	else{
		if(document.getElementById(val).checked=true){
			$("#functArea").load('<?php echo base_url() . 'setup/add_DivFunct/'; ?>'+div_id+"/"+val2);
		}
		else {
			$("#functArea").load('<?php echo base_url() . 'setup/remove_DivFunct2/'; ?>'+div_id+"/"+val2);
		
		}
	}
	
}
function removeDivFunct(val){
	var
	div_id = document.getElementById(val+"DIV").value;
	$("#functArea").load('<?php echo base_url() . 'setup/remove_DivFunct/'; ?>'+div_id+"/"+val)
	
}

function releaseFunct(){
	var
	num = document.getElementById("numFunct").value;
	for(n=1;n<=num;n++){
		place = document.getElementById(n+"S").value;	
		//place = place +"A";
		document.getElementById(place).checked=false;
	}	
}
//SEARCH DATA
function search_data(val){
	var
	val = val.replace("/","_____");
	search_target = document.getElementById("search_mth").value;
	cond = document.getElementById("search_condition").value;

 $("#search_feedBack").load('<?php echo base_url() . 'fetcher/';?>'+search_target+"/"+val+"/"+cond);
}

function search_any(anyVal){
 $("#search_feedBack2").load('<?php echo base_url() . 'fetcher/search_any/';?>'+anyVal);
}
function closeNo(val){
	document.getElementById("number").innerHTML=val;	
}

//PENDING POST
function pendPostAction(val){
		document.getElementById("action_box").style.display="block";
		//Action type
		button_Acct = val.substr(-1);
		document.getElementById("action_type").value=button_Acct;
		//ID
		target_ID = val.replace(button_Acct,"");
		document.getElementById("ID").value=target_ID;
		document.getElementById("action_name").innerHTML=document.getElementById(val+"_actionName").value;//Desc
		
		if(button_Acct=="P"){
			document.getElementById("action_box").style.position="relative";
			document.getElementById("action_box").style.left="0px";
			document.getElementById("action_box").style.bottom="0px";
			document.getElementById("users_panel").style.display="none";
			
			
			document.getElementById("details").style.display="none";
			document.getElementById("rej_notes").required=false;
			
			console = document.getElementById(val+"_Console").value;//Payment type
			amt = document.getElementById(val+"_Amount").value;//Amount
			pid = document.getElementById(val+"_DbrAcctID").value;//Account ID : Row ID for other payments
			dept = document.getElementById(val+"_dept").value;//Treasury or BE
			$("#console_area").load('<?php echo base_url() . 'fetcher/'; ?>'+dept+'/'+console+'/'+amt+'/'+pid);
		}
		else{
			document.getElementById("console_area").style.display="none";
			document.getElementById("action_box").style.position="fixed";
			document.getElementById("action_box").style.bottom="100px";
			document.getElementById("action_box").style.left="400px";
			document.getElementById("users_panel").style.display="block";

			if(button_Acct=="R"){
				document.getElementById("details").style.display="block";
				document.getElementById("rej_notes").required=true;
			}
			else if(button_Acct=="A"){
				document.getElementById("details").style.display="none";
				document.getElementById("rej_notes").required=false;
			}
		}
}

//Delete Advance
function delete_adv(adv_id){
	document.getElementById("action_box").style.display="block";
		//Action type
		document.getElementById("action_name").innerHTML=document.getElementById(adv_id+"actionName").value; //Desc
		document.getElementById("ID").value=adv_id;
}

//Cash book
function mod_Account_Off(cat_id){
	document.getElementById("action_box").style.display="block";
	document.getElementById("details").style.display="block";
		//Action type
		document.getElementById("action_name").innerHTML=document.getElementById(cat_id+"actionName").value; //Desc
		document.getElementById("ID").value=cat_id;
		
		$("#details").load('<?php echo base_url() . 'fetcher/get_AccountStaffInfo/'; ?>'+cat_id);
}




//currency value only
function isNumberKey(evt)
       {
		   //alert(evt);
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
          return true;
       }
//amount validation
function formatAmt1(val){
	place = "formated_"+val;
	amt = document.getElementById(val).value *1;
	document.getElementById(place).innerHTML = amt.toLocaleString();

}
function formatAmt(val){
	var
	place = "formated_"+val;
	amt = document.getElementById(val).value *1;
	
	IfMainAmt = document.getElementById("ifMainAmt").value;
	acctConsole = document.getElementById("acctConsoleType").value;//account console type
	taxDeduction  = document.getElementById("taxDeduction").value;
	

	//for wip
	if(IfMainAmt == "Yes"){
		MainAmt = document.getElementById("MainAmt").value*1;
		if(amt>MainAmt){
		diff = amt - MainAmt;
		document.getElementById("balInfo").innerHTML="Amount cannot be greater than pending amount. Floating amount: =N="+diff.toLocaleString(2);
		document.getElementById(val).value =0;
		document.getElementById("debit_amt").value = 0;
		 document.getElementById("credit_amt").value = 0;	
		 document.getElementById("perNotes").innerHTML=0;
		}	
	}
	if(taxDeduction=="Yes"){
		document.getElementById("taxDeduct").style.display="block";	
		document.getElementById("perNotes").innerHTML= "=N="+amt.toLocaleString();
	}
	else{
		document.getElementById("taxDeduct").style.display="none";	
	}
	
		if(acctConsole == "dbr_cdr"){
		document.getElementById("formated_debit_amt").innerHTML = "=N="+amt.toLocaleString();
		 document.getElementById("formated_credit_amt").innerHTML = "=N="+amt.toLocaleString();
		 document.getElementById("debit_amt").value = amt;
		 document.getElementById("credit_amt").value = amt;
		}
		else if(acctConsole == "cdr"){
		document.getElementById("credit_amt").value = amt;
		document.getElementById("formated_credit_amt").innerHTML = "=N="+amt.toLocaleString();	
		}
		else if(acctConsole == "dbr"){
			document.getElementById("formated_debit_amt").innerHTML ="=N="+ amt.toLocaleString();
		document.getElementById("debit_amt").value = amt;	
		}
	document.getElementById(place).innerHTML = amt.toLocaleString();
	//$("#"+place).load('<?php echo base_url() . 'fetcher/format_amount_word/'; ?>'+amt);
	//$("#perNotes").load('<?php echo base_url() . 'fetcher/format_amount_word/'; ?>'+amt);

}
//FOR WIP
function formatAmt2(val){
	var
	place = "formated_"+val;
	amt = document.getElementById(val).value *1;
	
	ContBal = document.getElementById("ContBal").value *1;
	
	if(amt>ContBal){
		diff = amt - ContBal;
		document.getElementById("balInfo").innerHTML="Amount cannot be greater than pending amount. Floating amount: =N="+diff.toFixed(2);
		document.getElementById(val).value =0;
		document.getElementById("debit_amt").value = 0;
		 document.getElementById("credit_amt").value = 0;	
		 document.getElementById("perNotes").innerHTML=0;
	}
	else{
		rem = ContBal - amt;
		document.getElementById("balInfo").innerHTML="Remaining =N="+ rem.toFixed(2);
		acctConsole = document.getElementById("acctConsoleType").value;//account console type
		taxDeduction  = document.getElementById("taxDeduction").value;
		if(taxDeduction=="Yes"){
			document.getElementById("taxDeduct").style.display="block";	
			document.getElementById("perNotes").innerHTML=amt.toFixed(2);
		}
		else{
			document.getElementById("taxDeduct").style.display="none";	
		}
		
			if(acctConsole == "dbr_cdr"){
			 document.getElementById("debit_amt").value = amt;
			 document.getElementById("credit_amt").value = amt;
			}
			else if(acctConsole == "cdr"){
			document.getElementById("credit_amt").value = amt;	
			}
			else if(acctConsole == "dbr"){
			document.getElementById("debit_amt").value = amt;	
			}
			
		//document.getElementById(place).innerHTML = amt.toFixed(2);
		$("#"+place).load('<?php echo base_url() . 'fetcher/format_amount_word/'; ?>'+amt);
		//$("#perNotes").load('<?php echo base_url() . 'fetcher/format_amount_word/'; ?>'+amt);
	}
}

function val_amt(val){
	var
	formatedAmt  =  "formated_"+val;//Main Value
	note = val+"_note";
	default_amt_id = "default_"+val;
	default_amt = document.getElementById(default_amt_id).value * 1;
	amount = document.getElementById('amount').value *1 - default_amt;//Bulk amount
	amt_val = document.getElementById(val).value *1;//field value
	document.getElementById(formatedAmt).innerHTML = "=N="+amt_val.toLocaleString();//field value
				
	if(amt_val>amount){
		document.getElementById(note).innerHTML="Amount cannot be greater than balance amount '"+amount.toLocaleString()+"'";	
		document.getElementById(val).value=0;
		document.getElementById(formatedAmt).value="";	
	}
	else{
/*		var no = 3456;
 no.toLocaleString();
*/		balance = (amount - amt_val) * 1;
//BalNotes = " <span class='pointers' value='"+val+balance+"' onClick='addTo(this.value);'>Copy</span>";
//balance = balance.toFixed(2);
		balance = "Remaining =N="+balance.toLocaleString();
		//
		document.getElementById(note).innerHTML=balance;
			//$("#"+note).load('<?php echo base_url() . 'fetcher/format_amount_bal/'; ?>'+balance);

		//document.getElementById(note).innerHTML="Balance : "+balance.toFixed(2);		
	}
}
function addTo(val){
alert(val);	
}
//CREDIT SIDE
function Cget_percentage(per){
	val = per;
	
	var
	amount = document.getElementById('amount').value *1 ;
	default_amt = document.getElementById("default_credit_amt").value * 1;
	if(val=="Balance"){
		newVal = amount - default_amt;
	}
	else{
		newVal = ((val/100)*amount) * 1;
		
	}
	document.getElementById("credit_amt").value = newVal;
	document.getElementById("formated_credit_amt").innerHTML = "=N="+newVal.toLocaleString();	
}
//DEBIT SIDE
function Dget_percentage(per){
	val = per;
	
	var
	amount = document.getElementById('amount').value *1 ;
	default_amt = document.getElementById("default_debit_amt").value * 1;
	if(val=="Balance"){
		newVal = amount - default_amt;
	}
	else{
		newVal = ((val/100)*amount) * 1;
		
	}
	document.getElementById("debit_amt").value = newVal;
	document.getElementById("formated_debit_amt").innerHTML = "=N="+newVal.toLocaleString();	

}



	   
function debit_entry(){	
	debit = document.getElementById("debit").value;
	debit_amt = document.getElementById("debit_amt").value * 1;
	itemCode = document.getElementById("item_code").value;
	qty = document.getElementById("qty").value;
		

	if(debit==0){
	alert("Choose a debit account");	
	} 
	else{ 
		if(debit_amt==0){
		alert("Debit amount cannot be 0");	
		}
		else{ 
	$("#output").load('<?php echo base_url() . 'doubleentry/gl_entry_dr/'; ?>'+debit+"/"+debit_amt+"/"+itemCode+"/"+qty)
		}
	}
}
//Credit
function credit_entry(){	
	credit = document.getElementById("credit").value;
	credit_amt = document.getElementById("credit_amt").value * 1;
	if(credit==0){
	alert("Choose a credit account");	
	} 
	else{ 
	if(credit_amt==0){
		alert("Credit amount cannot be 0");	
		}
		else{ 
	
	
$("#output").load('<?php echo base_url() . 'doubleentry/gl_entry_cr/'; ?>'+credit+"/"+credit_amt)
		}
	}
}
//Entry notes
function ins_notes(temp_gl_id){
	var
	notes = document.getElementById(temp_gl_id).value;
	notes = notes.replace(" ","_");
$("#output").load('<?php echo base_url() . 'doubleentry/gl_notes/'; ?>'+temp_gl_id+"/"+notes)
}
//Empty table
function emptyTemp_gl(){
$("#output").load('<?php echo base_url() . 'doubleentry/emptyTable'; ?>')
}

//delete record
function deleteRec(temp_gl_id){
$("#output").load('<?php echo base_url() . 'doubleentry/deleteRecord/'; ?>'+temp_gl_id)
}

//Check entries before saving
function check_amount(){
	var
	amt = document.getElementById("amount").value *1;
	chkamt = document.getElementById("default_credit_amt").value * 1;
	if(amt != chkamt){
		diff = amt - chkamt;
		if(diff <0){
			diff = diff * -1;	
		}
	document.getElementById("button_area").innerHTML="The bulk amount has changed from "+chkamt.toFixed(2)+" to "+ amt.toFixed(2)+". Difference = "+diff.toFixed(2)+" <img name='' src='<?php echo base_url();?>assets/images/icons/sync.png' width='16' height='16' alt='refesh' onclick='resetAmt(this);' class='pointers' />";
	}	
}

function resetAmt(){
	var
	normalamt = document.getElementById("default_credit_amt").value;
 document.getElementById("amount").value = normalamt;	
document.getElementById("button_area").innerHTML="<input type='submit' name='button2' id='button2' value='Save' class='btn-primary btn form-submit' onFocus='check_amount(this);' onMouseOver='check_amount(this);' />";
}


function ErrorMsg(val){
	alert(val);
}

//Check for duplicate values
function checkDup(val){
	var
	place = document.getElementById(val+"_area").value;
	table = document.getElementById(val+"_table").value;//Table
	data = document.getElementById(val).value;
	//alert(table);
	$("#trans_idArea").load('<?php echo base_url() . 'fetcher/dup_checker/'; ?>'+table+'/'+val+'/'+data);
}

function LoadDbrCdr(){
	$("#console_area").load('<?php echo base_url() . 'fetcher/dbr_cdr_table'; ?>');//for account
}

function search_dbr_acct(val){
	val = val.replace(" ","_______");
 $("#DA").load('<?php echo base_url() . 'fetcher/search_c_of_acct/debit/';?>'+val);
}

function search_cdr_acct(val){
	val = val.replace(" ","_______");
 $("#CA").load('<?php echo base_url() . 'fetcher/search_c_of_acct/credit/';?>'+val);
}

//Recieve
function getStockData(stock){
 $("#stock_details").load('<?php echo base_url() . 'fetcher/getStockData/';?>'+stock);
}

//Issue
function getStockDataIssue(stock){
 $("#stock_details").load('<?php echo base_url() . 'fetcher/getStockDataIssue/';?>'+stock);
}
//Check Available Stock
function checkAvailStock(stock){
 $("#stock_diary_area").load('<?php echo base_url() . 'fetcher/checkAvailStock/';?>'+stock);
}
function calculateIss(qty){
	document.getElementById("req_notes").innerHTML="";
var
	qty_avail = document.getElementById("qty_available").value *1;
	qty = qty * 1;
	if(qty>qty_avail){
		document.getElementById("qty").value = "";	
		document.getElementById("req_notes").innerHTML="Quantity available '"+qty_avail+"' cannot be exceeded!";
		document.getElementById("amount").innerHTML="=N= 0.00";
		document.getElementById("credit").value = 0;
	}
	else{
		amt = document.getElementById("price").value * 1;
		total = qty * amt;
		document.getElementById("credit").value = total;
		document.getElementById("amount").innerHTML="=N= "+total.toLocaleString();
	}
}
function issueStock(){
	var
	stockId = document.getElementById("cs_stock_id").value;//Stock ID
	cs_stock_id = stockId;
	cat_id = document.getElementById("debit").value;
	qty = document.getElementById("qty").value * 1;
	amount = document.getElementById("credit").value * 1;
	price_unit = document.getElementById("price").value * 1;
	action0 = "Out";
/*	if(qty>0 and stock >0){*/
	$("#stock_diary_area").load('<?php echo base_url() . 'doubleentry/cs_calculator/'; ?>'+stockId+'/'+qty+'/'+amount+'/'+price_unit+'/'+action0+'/'+cat_id+'/'+cs_stock_id);//stock:'also for cs_stock_id';qty;amount;price unit;action;account
	//}
}


function trans_code(code){
	document.getElementById("suppl_cont_ref_no").disabled=false;
	document.getElementById("suppl_cont_ref_no").value=code;	
}

function calculate(qty){
var
	qty = qty * 1;
	amt = document.getElementById("price").value * 1;
	total = qty * amt;
	document.getElementById("debit").value = total;
	document.getElementById("amount").innerHTML="=N="+total.toLocaleString();
}

function receiveStock(){
	var
	stock = document.getElementById("utility_cs_stock_list_id").value;//Also for cs_stock_id
	cat_id = 0;
	cs_stock_id = 0;
	qty = document.getElementById("qty").value * 1;
	amount = document.getElementById("debit").value * 1;
	price_unit = document.getElementById("price").value * 1;
	action0 = "In";
/*	if(qty>0 and stock >0){*/
	$("#view_area").load('<?php echo base_url() . 'doubleentry/cs_calculator/'; ?>'+stock+'/'+qty+'/'+amount+'/'+price_unit+'/'+action0+'/'+cat_id+'/'+cs_stock_id);//stock:'also for cs_stock_id';qty;amount;price unit;action;account
	//}
}
//Empty Calculator
function emptycs_calculator(){
	actionType = document.getElementById("actionType").value
	$("#view_area").load('<?php echo base_url() . 'doubleentry/emptycs_calculator/'; ?>'+actionType);//
}

function removeCSCalRow(cal_id){
		actionType = document.getElementById("actionType").value
	$("#view_area").load('<?php echo base_url() . 'doubleentry/removeCSCalRow/'; ?>'+cal_id+'/'+actionType);//
}
//WIP
function initiateNewCont(){
		document.getElementById("action_box").style.display="block";
		//Action type
			document.getElementById("action_box").style.position="relative";
			document.getElementById("action_box").style.left="0px";
			document.getElementById("action_box").style.bottom="0px";
			document.getElementById("users_panel").style.display="none";
	
}
//make target not required
function  make_target_notrequired(val){
	//var
/*	target = val+"_target";
	document.getElementById(val+"_class").className="";
	target = document.getElementById(target).value;
	document.getElementById(target+"_class").className="hide";
 document.getElementById(val).required=true;
 document.getElementById(target).value="";
 document.getElementById(target).required=false;
 	
*/}

function triggerRecData(val){//
var
actionType = document.getElementById("actionType").value
place = document.getElementById(val+"PLACE").value;
val = val.replace("__","/");
	$("#"+place).load('<?php echo base_url(); ?>'+val+'/'+actionType);//
}

function copyTo(col){
	val = document.getElementById(col).value;
	dest = document.getElementById(col+"_dest").value;
	document.getElementById(dest).value = val;	
}
//ADVANCES
	//search unretired advances
function populate_ret_data(val){
 $("#retireArea").load('<?php echo base_url() . 'fetcher/unretired_adv';?>'+"/"+val);
}

//images
$('#photoimg').change(function(e)			{ 
			           $("#preview").html('');
			    $("#preview").html('<img src="<?php echo base_url(); ?>assets/images/spin_32.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		});
		
		 $('#file1').change(function(e)			{ 
			           $("#preview_file1").html('');
			    $("#preview_file1").html('<img src="<?php echo base_url(); ?>assets/images/spin_32.gif" alt="Uploading...."/>');
			$("#imageform_file1").ajaxForm({
						target: '#preview_file1'
		}).submit();
		});
		
		 $('#file2').change(function(e)			{ 
			           $("#preview_file2").html('');
			    $("#preview_file2").html('<img src="<?php echo base_url(); ?>assets/images/spin_32.gif" alt="Uploading...."/>');
			$("#imageform_file2").ajaxForm({
						target: '#preview_file2'
		}).submit();
		});
</script>

