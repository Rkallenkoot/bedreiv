<?php
// echo getcwd();
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<h1>Login</h1>
			<form class="form-horizontal" action="/login" method="POST" role="form">
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary"> Log in</button>
					</div>
				</div>
			</form>
			<?php if($flash['error']) : ?>
				<p class="bg-danger"><?=$flash['error']?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>
