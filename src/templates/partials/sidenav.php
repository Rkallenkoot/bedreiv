<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li class="<?php echo ($uri == '/')?'active':'';?>"><a href="/">Dashboard</a></li>
		<li class="<?php echo (strstr($uri,'incidents'))?'active':'';?>"><a href="/incidents/all">Incidents <span class="badge pull-right"><?=$open?></span></a></li>
		<?php if($role == 'admin'): ?>
		<li class="<?php echo (strstr($uri,'users'))?'active':'';?>"><a href="/users/all">Users</a></li>
		<li class="<?php echo (strstr($uri,'hardware'))?'active':'';?>"><a href="/configs/hardware/all">Hardware</a></li>
		<li class="<?php echo (strstr($uri,'software'))?'active':'';?>"><a href="/configs/software/all">Software</a></li>
	<?php endif;?>
	</ul>
</div>
