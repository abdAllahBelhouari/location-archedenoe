<?php
	$Title = "Détail de l'article ";
	$Description = "Explorez notre catalogue d'articles en location chez Arche de Noé à Dugny. Découvrez une sélection variée de matériel de loisirs, sportif, éducatif et d'animation disponibles à la location. Obtenez des informations détaillées sur chaque article, y compris les caractéristiques, les tarifs et les disponibilités. Faites votre choix parmi notre gamme diversifiée pour enrichir vos événements et activités.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Détails de la location</h2>
				<ol>
					<li><a href="?route">Accueil</a></li>
					<li>Détails</li>
				</ol>
			</div>
		</div>
	</section>

	<section id="portfolio-details" class="portfolio-details">
		<div class="container">
			<div class="row gy-4">
				<div class="col-lg-8">
					<div class="portfolio-details-slider swiper">
						<div class="swiper-wrapper align-items-center">
							<div class="swiper-slide">
								<img src="assets/img/portfolio/portfolio-details-1.jpg"
									alt="">
							</div>
							<div class="swiper-slide">
								<img src="assets/img/portfolio/portfolio-details-2.jpg"
									alt="">
							</div>
							<div class="swiper-slide">
								<img src="assets/img/portfolio/portfolio-details-3.jpg"
									alt="">
							</div>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="portfolio-info">
						<h3>Machine de barbe à papa</h3>
						<ul>
							<li><strong>Categorie</strong>: Cuisine</li>
							<li><strong>Référence</strong>: MBP 1</li>
							<hr>
							<li><strong>à l'heure</strong>: 10 €</li>
							<li><strong>à la journée</strong>: 20 €</li>
							<li><strong>Week-end</strong>: 30 €</li>
						</ul>
						<div class="text-center"><a href='reservation.php'
								class="mybtn">Réserver</a></div>
					</div>
					<div class="portfolio-description">
						<h2>Description</h2>
						<p>
							Autem ipsum nam porro corporis rerum. Quis eos dolorem eos
							itaque inventore commodi
							labore quia quia. Exercitationem repudiandae officiis neque
							suscipit non officia eaque
							itaque enim. Voluptatem officia accusantium nesciunt est omnis
							tempora consectetur
							dignissimos. Sequi nulla at esse enim cum deserunt eius.
						</p>
					</div>
				</div>

			</div>

		</div>
	</section>

	<div class="container">
		<div class="row gy-4">
			<div data-aos="fade-up" data-aos-delay="200">
				<?php require_once 'faq.php'; ?>
			</div>
		</div>
	</div>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>