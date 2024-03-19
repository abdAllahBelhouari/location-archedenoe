<?php
	$condition = new Condition();
	$Conditions = $condition->getConditionsWeb();
	
	$Title = "Conditions de location";
	$Description = "Découvrez nos conditions de location complètes et transparentes. Que vous recherchiez des informations sur la durée, les tarifs ou les modalités, notre page détaille tout ce dont vous avez besoin de savoir pour une expérience de location fluide. Louez en toute confiance avec location-archedenoe.fr.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
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

	<section id="conditions" class="container pt-4 pb-5">
		<div class="row justify-content-center py-5">
			<?php
				$count = $delay = 0; 
				foreach ($Conditions as $condition):
					$count++;
					$delay+=100; 
			?>
			<div data-aos="fade-up" data-aos-delay="<?=$delay;?>">
				<h3>
					Article <?=$count;?>
					<span>: <?=$condition["titreTerme"];?></span>
				</h3>
				<p>
					<?= nl2br($condition["contenuTerme"]);?>
				</p>
			</div>
			<?php endforeach;?>
			<li>
				Ces conditions générales peuvent être adaptées en fonction des besoins spécifiques de
				notre association et des types de matériel que nous proposons à la location.
			</li>
			<div data-aos="fade-up" data-aos-delay="<?=$delay;?>">
				<?php require_once 'faq.php'; ?>
			</div>
		</div>
	</section>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>