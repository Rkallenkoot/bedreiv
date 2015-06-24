<?php
	include '../templates/partials/header.php';
	include '../templates/partials/menu.php';
?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <br><br>
        <!-- Check if the question variable exists. If that's a case: show question. If not: show intro text. -->
        <h2>Incident is opgelost</h2><hr>
        Het incident is bij het invullen van de vragenlijst opgelost. Het incident hoeft dus niet worden opgenomen in het systeem.
        <br><br><br>
        <center><a href="/incidents/all"><button type="button" class="btn btn-primary">Keer terug naar incidentenoverzicht</button></a></center>';    
        </div>
        <div class="col-md-4"></div>
    </div><!--endrow-->

<?php include '../templates/partials/footer.php'; ?>