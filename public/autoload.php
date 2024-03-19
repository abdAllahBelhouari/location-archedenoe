<?php
	$dir = '../models/';
	$inc = scandir($dir);
	if ( $inc ) {
		foreach ( $inc as $include ) {
			if ( $include != '' && $include != "." && $include != ".." ) {
				require_once $dir.$include;
			}
		}
	}

	$dir = '../controllers/';
	$inc = scandir($dir);
	if ( $inc ) {
		foreach ( $inc as $include ) {
			if ( $include != '' && $include != "." && $include != ".." ) {
				require_once $dir.$include;            
			}
		}
	}
?>