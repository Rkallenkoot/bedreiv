<?php
use \models\Dashboard;

$app->group('/api', function() use ($app){

	$app->get('/incidentCategoryCount', function() use ($app){
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

		echo json_encode($bami);
	});

	$app->get('/incidentDateCount', function() use ($app){
		$dashboard = new Dashboard();
		$incDateCount = $dashboard->getIncidentDateCount();

		$bami = [];
		// Color - highlight color
		$colors['Netwerk'] = array("#F7464A","#FF5A5E");
		$colors['Software'] = array("#FDB45C","#FFC870");
		$colors['Hardware'] = array("#46BFBD","#5AD3D1");
	});

});

?>