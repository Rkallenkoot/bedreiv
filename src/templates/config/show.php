<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<form class="form-horizontal col-sm-8" action="/configs/hardware/update" method="POST">
				<legend>Hardware wijzingen</legend>
				<div class="form-group">
					<label for="id" class="col-sm-2 control-label">Hardware ID:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="id" id="id" placeholder="Hardware ID" value="<?=$hardware['id']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="jaarvanaanschaf" class="col-sm-2 control-label">Jaar van aanschaf:</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="jaarvanaanschaf" id="jaarvanaanschaf" value="<?=$hardware['jaar_van_aanschaf']?>">
					</div>
				</div>

				<div class="form-group">
					<label for="soort" class="col-sm-2 control-label">Soort:</label>
					<div class="col-sm-10">
						<select class="form-control" name="soort">
							<?php foreach ($data['soorten'] as $soort):?>
								<option value="<?=$soort['id']?>" <?php echo ($soort['id']==$hardware['soort_id']) ? 'selected':'';?>><?=$soort['naam']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="locatie" class="col-sm-2 control-label">Locatie:</label>
					<div class="col-sm-10">
						<select class="form-control" name="locatie">
							<?php foreach ($data['locaties'] as $locatie):?>
								<option value="<?=$locatie['id']?>" <?php echo ($locatie['id']==$hardware['locatie_id']) ? 'selected':'';?>><?=$locatie['lokaal']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="merk" class="col-sm-2 control-label">Merk:</label>
					<div class="col-sm-10">
						<select class="form-control" name="merk">
							<?php foreach ($data['merken'] as $merk):?>
								<option value="<?=$merk['id']?>" <?php echo ($merk['id']==$hardware['merk_id']) ? 'selected':'';?>><?=$merk['naam']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="relatie" class="col-sm-2 control-label">Relatie:</label>
					<div class="col-sm-10">
						<select class="form-control" name="relatie">
							<?php foreach ($data['relaties'] as $relatie):?>
								<option value="<?=$relatie['id']?>" <?php echo ($relatie['id']==$hardware['relatie_id']) ? 'selected':'';?>><?=$relatie['naam']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="col-sm-2">
							<a class="btn btn-default" href="/configs/hardware/all">Terug</a>
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