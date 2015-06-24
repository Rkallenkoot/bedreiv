<?php
use \models\Hardware;
use \models\Dashboard;

// Homepage Router
$app->get('/', function() use ($app){
	$dashboard = new Dashboard();
	$inciCatCount = $dashboard->getIncidentCategoryCount();

	$bami = [];
		// Color - highlight color
	$colors['Netwerk'] = array("#F7464A","#FF5A5E");
	$colors['Software'] = array("#FDB45C","#FFC870");
	$colors['Hardware'] = array("#46BFBD","#5AD3D1");

	for ($i = 0; $i < count($inciCatCount); $i++){

		$bami[$i]['value'] = (int)$inciCatCount[$i]['aantal'];
		$bami[$i]['color'] = $colors[$inciCatCount[$i]['naam']][0];
		$bami[$i]['highlight'] = $colors[$inciCatCount[$i]['naam']][1];
		$bami[$i]['label'] = $inciCatCount[$i]['naam'];
	}

		// encode to json for chart
	$chartCategory = json_encode($bami);

	$app->render('home/index.php',array(
		'chartCategory' => $chartCategory));
});

$app->get('/bami', function() use ($app){
	$hardware = new Hardware();

	$result = $hardware->fetchAll();

	$app->render('home/bami.php', array(
		'bami' => $result[2]['id']
		));
});