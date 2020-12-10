
<header style="background:#303641;" id="heada">
    <div class="col-md-10 middle header-div" style="border-right:1px groove silver; margin-top:0px !important;">
		<div class="col-md-3 logo-div heada-divs no-p" style="text-align:center !important;">
				<a href="<?php echo base_url(); ?>">
					<img src="assets/images/eduportal.png" width="150px"/>
				</a>
		</div>
		<div class="col-md-6 heada-divs">
			<p><?php echo $sys->description; ?></p>
		</div>
		<div class="col-md-3 heada-divs" style="text-align:center !important;">
			<ul class="list-inline">			
			   <li class="dropdown language-selector">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
							<?php 
								echo empty($user) ? 'Registration' : $user;
							?> <span class="user-arrow">&rsaquo;</span>
						</a>
					<ul class="dropdown-menu pull-left">
						<li>
							<a href="<?php echo base_url();?>index.php?staff_registration/logoutRegistration">
								<i class="glyphicon glyphicon-log-out"></i>
								<span>&nbsp; <?php echo get_phrase('End Registration'); ?></span> 
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php?registration/logout">
								<i class=" glyphicon glyphicon-share"></i>
								<span>&nbsp; <?php echo get_phrase('log_out'); ?></span> 
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</header>