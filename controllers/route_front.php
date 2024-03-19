<?php
	
	//	FRONTEND ROUTER
	
	require_once '../public/autoload.php';

	if ( !isset($_SESSION['Auth']) ) {
		if ( isset($_GET['route']) && $_GET['route'] ) {
			$route="../views/front/".$_GET["route"].".php";
			if ( file_exists($route) ) {
				require_once $route;
			} else {
				require_once "../views/front/introuvable.php";
			}
		} else {
			require_once '../views/front/main.php';
		}
	}
?>