<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/basicQuery.css'; ?>"/>



<style>
    .themiddle .btns{
        
       width:60%;
        margin:10px 0;
        padding:5px;
        background: #14466a;
        text-shadow:none;
  border-radius: 2px 2px 0 0;
  background-image: -webkit-linear-gradient(top, #226797, #0c3452);
  background-image: -moz-linear-gradient(top, #226797, #0c3452);
  background-image: -o-linear-gradient(top, #226797, #0c3452);
  background-image: linear-gradient(to bottom, #226797, #0c3452);
  -webkit-box-shadow: inset 0 1px #2f81ad, 0 2px 1px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(0, 0, 0, 0.5), 0 1px black;
  box-shadow: inset 0 1px #2f81ad, 0 2px 1px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(0, 0, 0, 0.5), 0 1px black;

    }

    .themiddle .btns p{
        width:95%;
        text-align:left;
         font-size:14px;
         margin:auto;
    }

    @media (max-width: 590px){
        .themiddle .btns{
            width:90%;
        }
    }
    @media (max-width: 380px){
        .hasHeight{
            min-height:400px;
        }
        .themiddle .btns p{
            font-size:12px;
        }
    }
</style>

<div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-home"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                        <li>Payment</li>
                        <li>Type</li>
                    </ul>
                    <h4>Choose Your Payment Type</h4>
                </div>
            </div><!-- media -->
        </div><!-- pageheader -->
        <div class="span12">
            <div class="span8 b themiddle hasheight">         	
				<p class="t">Note: For students who want confirm fees for 2014/2015, please choose <a href="<?php echo base_url() . 'index.php?login/regista/regular';?>">E-TRANSACT 2014 / 2015 SESSION</a>, if you intend to confirm an old fee, choose <a href="<?php echo base_url() . 'index.php?login/regista/manual';?>">MANUAL PAYMENT (2009/2010 - 2013/2014 SESSION)</a></p>
            
            
				<div class="btns"><p><a href="<?php echo base_url() . 'index.php?login/regista/regular';?>" style="color:#ffffff;">E-TRANSACT 2014 / 2015 SESSION</a></p></div>
				<div class="btns"><p><a href="<?php echo base_url() . 'index.php?login/regista/manual';?>" style="color:#ffffff;">MANUAL PAYMENT (2009/2010 - 2013/2014 SESSION)</a></p></div>
            </div>
        </div>
    </div>

                