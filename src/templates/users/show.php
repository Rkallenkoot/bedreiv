<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h2 class="sub-header">User Wijzigen - <small><?=$user['username']?></small></h2>
			<form class="form-horizontal col-lg-6" role="form" action="/users/update" method="POST">
			<input type="hidden" value="<?=$user['id']?>" name="id">
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" required value="<?=$user['username']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="col-sm-2 control-label">Role:</label>
					<div class="col-sm-10">
						<select name="role" class="form-control">
						<?php foreach($roles as $role): ?>
							<option value="<?=$role['role']?>" <?php echo ($role['role']==$user['role']) ? 'selected':'';?>><?=$role['role']?></option>
						<?php endforeach;?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="col-xs-2">
							<a class="btn btn-default" href="/users/all" role="button">Terug</a>
						</div>
						<div class="col-xs-10">
							<button type="submit" class="btn btn-block btn-success">Opslaan</button>
						</div>
					</div>
				</div>
			</form>
			<?php if($flash['error']): ?>
				<p class="bg-danger"><?=$flash['error']?></p>
			<?php endif;?>
		</div>
	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>