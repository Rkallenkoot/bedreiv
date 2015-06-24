<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>
<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php if($flash['success']): ?>
				<p class="bg-success"><?=$flash['success']?></p>
			<?php elseif($flash['error']): ?>
				<p class="bg-danger"><?=$flash['error']?></p>
			<?php endif;?>
			<h2 class="sub-header">Software <a class="pull-right btn btn-success" href="/configs/software/create">Nieuwe software toevoegen</a></h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Naam</th>
							<th>Soort</th>
							<th>Aantal Licenties</th>
							<th>Actie</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($software as $soft):
							if($soft['aantal'] == 0){
								$lbl = 'label-danger';
							} elseif($soft['aantal'] < 4){
								$lbl = 'label-warning';
							} else {
								$lbl = 'label-success';
							}
							?>
							<tr>
								<td><?=$soft['id']?></td>
								<td><?=$soft['naam']?></td>
								<td><?=$soft['soort']?></td>
								<td><span class="label <?=$lbl?>"><?=$soft['aantal']?></span></td>
								<td>
									<form action="/configs/software/delete" method="POST">
										<input type="hidden" name="id" value="<?=$soft['id']?>">
										<div class="btn-group">
											<a href="/configs/software/show/<?=$soft['id']?>" class="btn btn-default">Wijzig</a>
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