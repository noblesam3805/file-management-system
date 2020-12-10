<script>
function printDiv() {
     var printContents = document.getElementById('mainwrapper').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
<script>
function printer(){
  var prtContent = document.getElementById("etti");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<div id="mainwrapper" class="mainwrapper">
                <div class="mainpanel" style="">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a><i class="fa fa-home"></i></a></li>
                                    <li>Receipt</li>
                                </ul>
                                <h4>Step 5: Print Receipt</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel contentpanel-wizard centa">

                        <div class="row">
                            <div class="col-md-8 center">

                                <!-- BASIC WIZARD -->
                                <form method="" action="" id="basicWizard" class="panel-wizard">
                                    <ul class="nav nav-justified nav-wizard">
                                        <li><a>Verify Reg No</a></li>
                                        <li><a>Personal Info.</a></li>
                                        <li><a>Upload Data</a></li>
										<li><a>Process Fees</a></li>
										<li class="active"><a class="tab-head">Receipt</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="" id="tab2">
                                            <div class="form-group">
                                                <label class="col-sm-4 dlabel2">Firstname</label>
                                                <div class="col-sm-8">
                                                    <p><?=$fullname?></p>
                                                </div>
                                            </div><!-- form-group -->
											<div class="form-group" style="display:block;" id="screg">
                                                <label class="col-sm-4 dlabel2">Registration Number</label>
                                                <div class="col-sm-8">
                                                    <p><?=$serial?></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 dlabel2">Confirmation number</label>
                                                <div class="col-sm-8">
                                                    <p><?=$conf?></p>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-4 dlabel2">Sex</label>
                                                <div class="col-sm-8">
                                                    <p>Male</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 dlabel2">Address</label>
                                                <div class="col-sm-8">
                                                    <p><?=$address?></p>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-4 dlabel2">Hostel</label>
                                                <div class="col-sm-8">
                                                    <p>Chief Emeka Okigwe</p>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-4 dlabel2">Room</label>
                                                <div class="col-sm-8">
                                                    <p>#15 Corner 2</p>
                                                </div>
                                            </div>
											<div id="result">

											</div>

                                            <div id='etti' class="etti"><!-- start div-->
                                            <!--div class="contentpanel contentpanel-wizard centa"><!-- start div-->

<div class="row">
 Logo appears here
</div>
<div class="row">
  <div class="col-md-4">Student Details</br>
  Reg No: <?=$serial?></br>
  Name: <?=$fullname?></br>
  Address: <?=$address?></br>
  Confirmation order: <?=$order?></br>
  Date: <?=$date?></br>
  </div>
  <div class="col-md-4"><div class="row">Picture</div><div class="row">Signature</div></div>
</div>
<div class="row">
 School info appears here
</div>
<div class="row">
 <div class="col-md-4">Bank Info</div>
 <div class="col-md-4">Gap</div>
 <div class="col-md-4">Qr Code</div>
</div>
<!-- end div-->
<input type="button" onclick="printDiv()" value="print a div!" />
</div>
											<ul class="list-unstyled wizard">
												<li class="pull-right next myclass2"><input type="submit" name="Print" style="height:40px; border-radius:2px;" class="btn btn-info pull-right" value="Print"/></li>
												<li class="pull-right next myclass2"><a href="javascript: window.print();" style="color:#000000" >Print Details </a></li>
											</ul>
                                        </div><!-- tab-pane -->
                                    </div><!-- tab-content -->



                                </form><!-- #basicWizard -->

                            </div><!-- col-md-6 -->



                        </div><!-- row -->



                    </div>

                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->