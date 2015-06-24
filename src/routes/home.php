<?php
use \models\Hardware;
use \models\Dashboard;

// Homepage Router
$app->get('/', function() use ($app){
	$dashboard = new Dashboard();
	$inciCatCount = $dashboard->getIncidentCategoryCount();

	$bami = [];
		// Color - highlight color
	$colors['Netwerk'] = array("rgb(247,70,74)","#FF5A5E", "rgba(247,70,74,0.7)", "rgba(247,70,74,0.4)");
	$colors['Software'] = array("rgb(253,180,92)","#FFC870", "rgba(253,180,92,0.7)", "rgba(253,180,92,0.4)");
	$colors['Hardware'] = array("rgb(70,191,189)","#5AD3D1", "rgba(70,191,189,0.7)", "rgba(70,191,189,0.4)");

	$d = count($inciCatCount);
	for ($i = 0; $i < $d; $i++){

		$bami[$i]['value'] = (int)$inciCatCount[$i]['aantal'];
		$bami[$i]['color'] = $colors[$inciCatCount[$i]['naam']][0];
		$bami[$i]['highlight'] = $colors[$inciCatCount[$i]['naam']][1];
		$bami[$i]['label'] = $inciCatCount[$i]['naam'];
	}

		// encode to json for chart
	$chartCategory = json_encode($bami);

	$nasi = [];

	$inciDateCount = $dashboard->getIncidentDateCount();

	$nasi['labels'] = [];
	$nasi['datasets'] = []; // hier moeten de Dataseries in

	$c = count($inciDateCount);

	$data['Hardware'] = [];
	$data['Software'] = [];
	$data['Netwerk'] = [];
	// Vul data dingen want erg lastig
	foreach($inciDateCount as $inc){
		$cate = $inc['naam'];
		if($cate == "Hardware"){
			$data['Hardware'][] = (int)$inc['aantal'];
			$data['Software'][] = 0;
			$data['Netwerk'][] = 0;
		} elseif ($cate =="Software") {
			$data['Hardware'][] = 0;
			$data['Software'][] = (int)$inc['aantal'];
			$data['Netwerk'][] = 0;
		} elseif ($cate == "Netwerk"){
			$data['Hardware'][] = 0;
			$data['Software'][] = 0;
			$data['Netwerk'][] = (int)$inc['aantal'];
		}
	}

	for($a = 0; $a < $c; $a++){
		$datum = $inciDateCount[$a]['datum'];
		$nasi['labels'][] = $datum;
	}
	array_unique($nasi['labels']); // Vanaf hier unieke labels, nu de data

	$i = 0;
	foreach(array_keys($data) as $label){
		$nasi['datasets'][$i]['label'] = $label;
		$nasi['datasets'][$i]['data'] = $data[$label];
		$nasi['datasets'][$i]['fillColor'] = $colors[$label][2];
		$nasi['datasets'][$i]['strokeColor'] = $colors[$label][3];
		$nasi['datasets'][$i]['pointColor'] = $colors[$label][3];
		$nasi['datasets'][$i]['pointStrokeColor'] = "#fff";
		$nasi['datasets'][$i]['pointHighlightFill'] = "#fff";
		$nasi['datasets'][$i]['pointHighlightStroke'] = $colors[$label][3];
		$i++;
	}

	$chartDate = json_encode($nasi);

	$app->render('home/index.php',array(
		'chartCategory' => $chartCategory,
		'chartDate' => $chartDate));
});

$app->get('/bami', function() use ($app){
	$hardware = new Hardware();

	$result = $hardware->fetchAll();

	$app->render('home/bami.php', array(
		'bami' => $result[2]['id']
		));
});