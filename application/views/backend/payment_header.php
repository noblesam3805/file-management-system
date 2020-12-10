<header style="background:#303641;" id="heada">
    <div class="col-md-10 middle header-div" style="border-right:1px groove silver;">
		<div class="col-md-3 logo-div heada-divs no-p" style="text-align:center;">
				<a href="<?php echo base_url(); ?>">
					<img src="assets/images/eduportal.png" width="150px"/>
				</a>
		</div>
		<div class="col-md-6 heada-divs">
			<p><?php echo $sys->description; ?></p>
		</div>
		<div class="col-md-3 heada-divs" style="text-align:center;">
			<ul class="list-inline">			
			    <li>
					<a href="<?php echo base_url();?>index.php?login/logout">
						<i class="glyphicon glyphicon-share" style="font-size:14px;"></i> 
						<?php echo get_phrase('Exit'); ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</header>