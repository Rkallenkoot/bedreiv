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
			Als gast dient u eerst <a href="/login">in te loggen</a> voordat u een incident kan aanmelden.
			</p>
		</div>
	</div>
</div>

<?php
include '../templates/partials/footer.php';
?>