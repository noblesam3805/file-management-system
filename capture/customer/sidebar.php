<!-- MENU SECTION -->
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                   <img class="media-object img-thumbnail user-img" alt="User Picture" src=" <?php echo $_SESSION['passport'];?>" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> <?php echo $_SESSION['admin_name']; ?></h5>
                    <ul class="list-unstyled user-info">

                        <li>
                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online

                        </li>

                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">


                <li class="panel active">
                    <a href="index.html" >
                        <i class="icon-table"></i> Dashboard


                    </a>
                </li>

                <li class="panel"><a href="application.php?balance=1"><i class="icon-angle-right"></i> Check Balance </a></li>
                <li class="panel"><a href="application.php?deposit=1"><i class="icon-angle-right"></i> Deposit </a></li>
                <li class="panel"><a href="application.php?withdraw=1"><i class="icon-angle-right"></i> Withdraw </a></li>
                <li class="panel"><a href="application.php?transfer=1"><i class="icon-angle-right"></i> Transfer </a></li>
				  <li class="panel"><a href="../admin/index.php?logout=1"><i class="icon-angle-right"></i> Logout </a></li>
				
              <!--  <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        <i class="icon-pencil"></i> Customer Details

                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success">5</span>&nbsp;
                    </a>
                    <ul class="collapse" id="form-nav">
                        <li class=""><a href="forms_general.html"><i class="icon-angle-right"></i> General </a></li>
                        <li class=""><a href="forms_advance.html"><i class="icon-angle-right"></i> Advance </a></li>
                        <li class=""><a href="forms_validation.html"><i class="icon-angle-right"></i> Validation </a></li>
                        <li class=""><a href="forms_fileupload.html"><i class="icon-angle-right"></i> FileUpload </a></li>
                        <li class=""><a href="forms_editors.html"><i class="icon-angle-right"></i> WYSIWYG / Editor </a></li>
                    </ul>
                </li> -->

                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav">
                        <i class="icon-table"></i> Utitlities

                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-info">6</span>&nbsp;
                    </a>
                    <ul class="collapse" id="pagesr-nav">
                        <li><a href="#"><i class="icon-angle-right"></i> Calendar </a></li>
                        <li><a href="#"><i class="icon-angle-right"></i> Timeline </a></li>
                        <li><a href="#"><i class="icon-angle-right"></i> Social </a></li>
                        <li><a href="#"><i class="icon-angle-right"></i> Pricing </a></li>
                        <li><a href="#"><i class="icon-angle-right"></i> Offline </a></li>

                    </ul>
                </li>



            </ul>

        </div>
        <!--END MENU SECTION -->
