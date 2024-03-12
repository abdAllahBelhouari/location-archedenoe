<?php
	Login::controlAccess([1]);

	
	require_once('../views/header.php');
	require_once('navbarBack1.php');
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>
					<i class="bi bi-house-fill"></i>
					Menu Principal
				</h2>
			</div>
		</div>
	</section><!-- End Breadcrumbs Section -->
	<?=flash();?>
	<section>
		<div class="container-fluid">
			<div class="row justify-content-center py-4">
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
	require_once('../views/scripts.php');
	require_once('footer.php');
?>