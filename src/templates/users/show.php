<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<form class="form-horizontal col-lg-6" role="form" action="/users/create" method="POST">
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" required value="<?=$username?>">
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="col-sm-2 control-label">Role:</label>
					<div class="col-sm-10">
						<select name="role" class="form-control">
						<?php foreach($roles as $role): ?>
							<option value="<?=$role['role']?>"><?=$role['role']?></option>
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
						<div class="col-sm-2">
							<a class="btn btn-default" href="/users/all" role="button">Terug</a>
						</div>
						<div class="col-sm-10">
							<button type="submit" class="btn btn-block btn-success">Opslaan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>