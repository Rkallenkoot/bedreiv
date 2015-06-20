<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo array_key_exists('title',$data) ? $data['title'] : 'Bedreiv'; ?></title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<?php echo array_key_exists('head', $data) ? $data['head'] : ''; ?>
</head>
<body>
