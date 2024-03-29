<?php
	include '../templates/partials/header.php';
	include '../templates/partials/menu.php';
?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <br><br>
            <!-- Check if the question variable exists. If that's a case: show question. If not: show intro text. -->
            <?php if(isset($questionid)){

                // Incident is opgelost
                if($question_db['type'] == 'solution'){
                    header("Location: /questionnaire_finished");
                    die();
                }

                // Incident is opgelost
                if($question_db['type'] == 'saveincident'){
                    header("Location: /incident_new");
                    die();
                }

                echo '
                <div class="question">
                    <h2>' . $question_db['body'] . '</h2><hr>
                    <font size="4" color="#808080">' . $question_db['beschrijving'] . '</font> 
                    <br>
                </div>
                <br><br>
                <a href="/questionnaire/' . $question_db['yes'] . '"><button type="button" id="bigbutton" class="btn btn-primary">Ja</button></a>
                <a href="/questionnaire/' . $question_db['no'] . '"><button type="button" id="bigbutton" class="btn btn-primary pull-right">Nee</button></a>';
            } else {
                echo '
                <h2>Incident toevoegen</h2><hr>
                Welkom bij het meldpunt voor incidenten. Voordat het incident geregistreerd kan worden, dient er eerst een vragenlijst ingevuld te worden. Het is mogelijk dat uw incident in het proces van de vragenlijst wordt opgelost. In dat geval hoeft het incident niet opgenomen te worden in het incidentenmanagement database
                <br><br>
                <center><a href="/questionnaire/1"><button type="button" class="btn btn-primary">Naar de vragenlijst</button></a></center>';      

                // Add an option to skip the questionnaire when you're an admin
                if($role == "admin"){
                    echo '<center><br><a href="/incident_new">Klik hier om rechtstreeks een incident toe te voegen (admin only)</a></center>';
                }         
            }?>
        </div>
        <div class="col-md-4"></div>
    </div><!--endrow-->

<?php include '../templates/partials/footer.php'; ?>