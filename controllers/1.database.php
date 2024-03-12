<?php 
	$host 		= "localhost";
	$dbname 	= "u131861462_location";
	$root 		= "root";
	$password 	= "";

	try {
		$db = new PDO (
			"mysql:host=$host;dbname=$dbname;charset=utf8", "$root", "$password",
			array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'")
		);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$db->exec("SET CHARACTER SET utf8");
	} catch ( Exception $e ) {
		?>
			<div style="text-align: center; margin-top: 100px; font-size: 15pt; color: #f00; font-family: 'Arial';" >
				Désolé ! Erreur de connexion.<br>
				La base des données est inaccessible.
			</div>
		<?php
		die();
	}
?>