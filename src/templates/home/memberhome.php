<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">Welkom op de Beheertool!</h2>
			<p>
				<span class="bold">Een probleem met uw ICT apparatuur of software?</span></p>
				<p>
					<a class="btn btn btn-primary" href="/questionnaire"> Meld dan een incident aan </a> met behulp van de vragenlijst!
				</p>

				<hr>
				<p>
					Als u al openstaande incidenten heeft kunt u deze<a href="/incidenten/all"> hier </a> vinden</p>
					Deze pagina is ook te bereiken via het menuitem <a href="/incidents/all">incidents</a> aan de linkerkant.
				</p>
			</div>
		</div>
	</div>

	<?php
	include '../templates/partials/footer.php';
	?>