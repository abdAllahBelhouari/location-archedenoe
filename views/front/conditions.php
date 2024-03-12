<?php
	$condition = new Condition();
	$Conditions = $condition->getConditionsWeb();
	

    require_once('../views/header.php');
    require_once('navbarFront.php');
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
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
	</section><!-- End Breadcrumbs Section -->

	<section id="conditions" class="container pt-4 pb-5">
		<div class="row justify-content-center py-5">
			<?php
				$count = $delay = 0; 
				foreach ($Conditions as $condition):
					$count++;
					$delay+100; 
			?>
				<div data-aos="fade-up" data-aos-delay="<?=$delay;?>">
					<h3>
						Article  <?=$count;?>
						<span>: <?=$condition["titreTerme"];?></span>
					</h3>
					<p>
						<?= nl2br($condition["contenuTerme"]);?>
					</p>
				</div>
			<?php endforeach;?>

			

			
		</div>
	</section>
</main>
<?php
    require_once('../views/scripts.php');
    require_once('footer.php');
?>