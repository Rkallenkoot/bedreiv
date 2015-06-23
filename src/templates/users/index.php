<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">User Management <a class="pull-right btn btn-success"href="/users/create" role="button">Nieuwe gebruiker toevoegen</a></h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Role</th>
							<th>Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $user): ?>
							<tr>
								<td><?=$user['id']?></td>
								<td><?=$user['username']?></td>
								<td><?=$user['role']?></td>
								<td><?=$user['created']?></td>
								<td>
									<form action="/users/delete" method="POST">
										<input type="hidden" name="id" value="<?=$user['id']?>">
										<div class="btn-group">
											<a class="btn btn-default" href="/users/show/<?=$user['id']?>" role="button">Wijzig</a>
											<button type="submit" class="btn btn-danger">Verwijder</button>
										</div>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>