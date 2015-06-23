<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<form class="form-horizontal col-sm-8" action="/configs/software/create" method="POST">
				<legend>Software toevoegen</legend>
				<div class="form-group">
					<label for="id" class="col-sm-2 control-label">Software ID:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="id" id="id" placeholder="Software ID" required>
					</div>
				</div>

				<div class="form-group">
					<label for="naam" class="col-sm-2 control-label">Naam:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="naam" id="naam" placeholder="Naam" required>
					</div>
				</div>

				<div class="form-group">
					<label for="soort" class="col-sm-2 control-label">Soort:</label>
					<div class="col-sm-10">
						<select class="form-control" name="soort">
							<?php foreach ($data['soorten'] as $soort):?>
								<option value="<?=$soort['id']?>"><?=$soort['naam']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="aantallicenties" class="col-sm-2 control-label">Aantal Licenties:</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="aantallicenties" id="aantallicenties" min="0" required value="0">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="col-sm-2">
							<a class="btn btn-default" href="/configs/software/all">Terug</a>
						</div>
						<div class="col-sm-10">
							<button type="submit" class="btn btn-block btn-success">Opslaan</button>
						</div>
					</div>
				</div>
				<?php if($flash['error']): ?>
					<p class="bg-danger"><?=$flash['error']?></p>
				<?php endif; ?>
			</form>
		</div>

	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>
