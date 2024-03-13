<?php


	
	$Title = "Titre de la page";
	$Description = "Description de la page";
	
	require_once('../views/header.php');
	require_once('navbarFront.php');
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Conditions de location</h2>
				<ol>
					<li><a href="?route=">Accueil</a></li>
					<li>Conditions</li>
				</ol>
			</div>
		</div>
	</section>

</main>
<?php
	require_once('../views/scripts.php');
	require_once('footer.php');
?>