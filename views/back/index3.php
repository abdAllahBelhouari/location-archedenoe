<?php
	Membre::controlAccess([1,3]);


	
	$Title = $Description = "Accueil";

	require_once '../views/header.php';
	require_once 'navbarBack3.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-house-fill"></i>
				Mon Espace Membre
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container-fluid">
			<div class="row py-4">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					colonne de gauche

				</div>
				<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
					colone de droite

				</div>
			</div>
		</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>