<?php
	include '../templates/partials/header.php';
	include '../templates/partials/menu.php';

    // if(isset($_GET['question'])){
    //     $test = $_GET['question'];
    //     echo 'Vraagnummer: ' . $test;
    // }
    var_dump($questionnumber);
?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2>Incident toevoegen</h2>
            <hr>
            <!-- Introduction text -->
           	Welkom bij het meldpunt voor incidenten. Voordat het incident geregistreerd kan worden, dient er eerst een vragenlijst ingevuld te worden. Het is mogelijk dat uw incident in het proces van de vragenlijst wordt opgelost. In dat geval hoeft het incident niet opgenomen te worden in het incidentenmanagement database.

        	<br><br><br>
        	<!-- Button to proceed to questionnaire -->
        	<center><button type="button" class="btn btn-primary">Naar de vragenlijst</button></center>
        </div>
        <div class="col-md-4"></div>
    </div><!--endrow-->

<?php include '../templates/partials/footer.php'; ?>