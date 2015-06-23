<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>
<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">Hardware <a class="pull-right btn btn-success" href="/configs/hardware/create">Nieuwe hardware toevoegen</a></h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Jaar van aanschaf</th>
							<th>Soort</th>
							<th>Merk</th>
							<th>Locatie</th>
							<th>Relatie</th>
							<th>Actie</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($hardware as $hard): ?>
							<tr>
								<td><?=$hard['id']?></td>
								<td><?=$hard['jaar_van_aanschaf']?></td>
								<td><?=$hard['soort']?></td>
								<td><?=$hard['merk']?></td>
								<td><?=$hard['locatie']?></td>
								<td><?=$hard['relatie']?></td>
								<td><a href="/configs/hardware/show/<?=$hard['id']?>" class="btn btn-default">Wijzig</button></td>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>