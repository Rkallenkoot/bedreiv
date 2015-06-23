<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/incidents/all">Beheertool voor Scholengemeenschap De Hondsrug</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav navbar-right">
				<?php if($hasIdentity): ?>
					<li class="navbar-text"> Hallo <?=$identity['username']?></li>
                    <li role="separator" class="divider"></li>
					<li><a href="/logout">
						<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a>
					</li>
			<?php else: ?>
				<li><a href="/login">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
					Login
				</a>
			</li>
		<?php endif;?>
	</ul>
</div>

</div>
</nav>
