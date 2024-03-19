<?php


	
	$Title = $Description = "Accès refusé";

	require_once '../views/header.php';
	require_once "navbarBack".$_SESSION['Auth']['level'].".php";
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>
					<i class="bi bi-house-fill"></i>
					Accès refusé
				</h2>
			</div>
		</div>
	</section>
	<?=flash();?>
	<section>
		<div class="container-fluid">
			<div class="row justify-content-center py-4">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
					<img src="../public/assets/img/warning.png" alt="warning">
					<h6 class="col-iadn my-4">Votre niveau d'accès ne vous permet pas d'accéder à
						cette page.</h6>
					<a href="?route" class="mybtn">Retour</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>