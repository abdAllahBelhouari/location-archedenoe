<?php
	$categorie = new Categorie();
	$Categories = $categorie->getCategories(true);
	



	
	$Title = "La location en toute simplicité";
	$Description= "Bienvenue chez Arche de Noé à Dugny, votre partenaire de confiance pour la location de matériel de loisirs, sportif, éducatif et d'animation. Découvrez notre large gamme de produits de qualité pour rendre vos événements inoubliables. Contactez-nous dès maintenant pour une expérience exceptionnelle.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
	<section id="portfolio" class="portfolio">
		<div class="container" data-aos="fade-up">
			<div class="section-header">
				<h3 class="section-title">&nbsp;</h3>
				<h1 class="text-center section-description">Location de Matériel de Loisirs, Sportif,
					Éducatif et d'Animation</h1>
			</div>

			<div class="row" data-aos="fade-up" data-aos-delay="100">
				<div class="col-lg-12 d-flex justify-content-center">
					<ul id="portfolio-flters">
						<?php if(count($Categories)>1) : ?>
							<li data-filter="*" class="filter-active">Tous</li>
						<?php endif ?>	
						<?php foreach ($Categories as $categorie): ?> 
							<li data-filter=".filter-<?= $categorie["idCategorie"] ;?>"><?= $categorie["libelleCategorie"] ;?></li>
						<?php endforeach; ?>	
					</ul>
				</div>
			</div>

			<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
				<div class="col-lg-4 col-md-6 portfolio-item filter-<?= $categorie["idCategorie"] ;?>">
					<img src="assets/pictures/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Piscine à balles</h4>
						<p>Loisir</p>
						<a href="assets/pictures/portfolio/portfolio-1.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Piscine à balles"><i class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=1" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-sport">
					<img src="assets/pictures/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Vélo Adulte</h4>
						<p>Sports</p>
						<a href="assets/pictures/portfolio/portfolio-2.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link" title="Vélo Adulte"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=2" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-<?= $categorie["idCategorie"] ;?>">
					<img src="assets/pictures/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Structure gonflable - Le Médiéval</h4>
						<p>Loisir</p>
						<a href="assets/pictures/portfolio/portfolio-3.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Structure gonflable - Le Médiéval"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=3" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-cuisine">
					<img src="assets/pictures/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Machine de barbe à papa</h4>
						<p>Cuisine</p>
						<a href="assets/pictures/portfolio/portfolio-4.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Machine de barbe à papa"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=4" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-sport">
					<img src="assets/pictures/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Baby Vélo</h4>
						<p>Sports</p>
						<a href="assets/pictures/portfolio/portfolio-5.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link" title="Baby Vélo"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=5" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-<?= $categorie["idCategorie"] ;?>">
					<img src="assets/pictures/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Structure gonflable - Tobogan</h4>
						<p>Loisir</p>
						<a href="assets/pictures/portfolio/portfolio-6.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Structure gonflable - Tobogan"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=6" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-cuisine">
					<img src="assets/pictures/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Machine à crèpes</h4>
						<p>Cuisine</p>
						<a href="assets/pictures/portfolio/portfolio-7.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Machine à crèpes"><i class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=7" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-cuisine">
					<img src="assets/pictures/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Machine à gauffres</h4>
						<p>Cuisine</p>
						<a href="assets/pictures/portfolio/portfolio-8.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link"
							title="Machine à gauffres"><i class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=8" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-sport">
					<img src="assets/pictures/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
					<div class="portfolio-info">
						<h4>Trotinette</h4>
						<p>Sports</p>
						<a href="assets/pictures/portfolio/portfolio-9.jpg"
							data-gallery="portfolioGallery"
							class="portfolio-lightbox preview-link" title="Trotinette"><i
								class="bi bi-eye-fill"></i></a>
						<a href="?route=article&article=1" class="details-link"
							title="Détails"><i class="bi bi-basket2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>