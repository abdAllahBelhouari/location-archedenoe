<?php
	Login::controlAccess([1]);

	$Title = $Description = "Gestion des ";
	require_once('../views/header.php');
	require_once('navbarBack1.php');
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-person-bounding-box"></i>
				Mon Profil
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
			</div>
		</div>
	</section>

</main>
<?php
	require_once('../views/scripts.php');
	require_once('footer.php');
?>