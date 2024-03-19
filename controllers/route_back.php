<?php
	
	//	BACKEND ROUTER
	
	require_once '../public/autoload.php';
	
	if ( isset($_SESSION["Auth"]) ) {
		if ( isset($_GET['route']) && $_GET['route'] ) {
			$route = "../views/back/".$_GET["route"].'.php';
			if ( file_exists($route) ) {
				require_once $route;
			} else {
				require_once "../views/back/index".$_SESSION['Auth']['level'].".php";
			}
		} else {
			require_once "../views/back/index".$_SESSION['Auth']['level'].".php";
		} 
	}
?>