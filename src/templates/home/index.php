<?php

if($role == 'admin'){
	include 'adminhome.php';
} elseif($role =='member') {
	include 'memberhome.php';
} else {
	include 'guesthome.php';
}

?>