<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2>Nieuw incident registreren</h2>
			<form action="/incident_new" method="post" id="f_new">
				<input name="user_id" type="hidden" value="<?php echo $data['identity']['id'];?>"/>
				<table class="table table-responsive">

					<tr>
						<td>Omschrijving:</td>
						<td><textarea name="omschrijving" cols="30" rows="10"></textarea></td>
						<td></td>
					</tr>
					<tr>
						<td>Software:</td>
						<td>
							<select name="software_id" id="">
								<option value="null">Niet van toepassing</option>
								<?php
								foreach ($software as $software_id){
									echo "<option value=\"".$software_id['id']."\">".$software_id['uitgebreide_naam']."</option>";
								}
								?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Hardware:</td>
						<td><select name="hardware_id" id="">
							<?php
							foreach ($hardware as $hardware_id){
								echo "<option value=\"".$hardware_id['id']."\">".$hardware_id['id']."</option>";
							}
							?>
						</select></td>
						<td></td>
					</tr>
					<tr>
						<td>Categorie:</td>
						<td><select name="categorie_id" id="">

							<?php
							foreach ($categorie as $categorie_id){
								echo "<option value=\"".$categorie_id['id']."\">".$categorie_id['naam']."</option>";

							}

							?>
						</select></td>
						<td></td>
					</tr>
				</table>
			</form>
			<table class="table table-responsive">
				<tr>
					<td><a href="/incidents/all"><button class="btn btn-default">Terug</button></a></td>
					<td></td>
					<td><button class="btn btn-success" form="f_new">Registreren</button></td>
				</tr>
			</table>


		</div><!-- end col-sm-9 -->
	</div><!--endrow-->
</div>


<?php include '../templates/partials/footer.php'; ?>