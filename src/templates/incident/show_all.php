<!-- Shows a list of incident items -->
<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
	<div class="row"><button class="btn btn-danger btn-success btn-default btn-info btn-warning"></button>
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">Incidenten <a class="pull-right btn btn-success" href="/incident_new">Nieuw Incident Registreren</a></h2>

			<div class="table-responsive">
				<table class="table table-striped">

					<!-- Table head -->
					<thead>
						<tr>
							<th>Id</th>
							<th>Datum</th>
							<th>Datum Afgerond</th>
							<th>Omschrijving</th>
							<th>Workaround</th>
							<th>Status</th>
							<th>Prioriteit</th>
							<th>Hardware ID</th>
							<th>Software</th>
							<th></th>

						</tr>
					</thead>

					<!-- Table body -->
					<tbody>

						<?php

						foreach ($data as $row) {
							// Fancy buttons showing status
							switch ($row['status']){
								case 'Nieuw':
								$lbl = 'label label-info';
								break;
								case 'Bezig':
								$lbl = 'label label-warning';
								break;
								case 'Opgelost':
								$lbl = 'label label-success';
								break;

								default:
								$lbl = 'label label-danger';
								break;
							}
							?>

							<tr>
								<td><?php echo $row["id"];?></td>
								<td><?php echo $row["datum"];?></td>
								<td><?php echo $row["datum_afgerond"];?></td>
								<td><?php echo $row["omschrijving"];?></td>
								<td><?php echo $row['workaround'];?></td>

								<td>
									<?php echo "<span class=\"$lbl\">$row[status]</span>";?>
								</td>
								<td><?php echo $row['naam'];?></td>
								<td><?php echo $row["hardware_id"];?></td>
								<td><?php echo $row["software_id"];?></td>
								<td>
									<a href="/incidents/show/<?php echo $row["id"];?>">
										<button class="btn btn-default">
											Wijzig
										</button>
									</a>

								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>



		<?php
		include '../templates/partials/footer.php';
		?>
