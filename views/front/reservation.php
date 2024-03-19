<?php



	$Title = "Réservation";
	$Description = "Réservez dès maintenant votre matériel de loisirs, sportif, éducatif et d'animation chez Arche de Noé à Dugny. Profitez d'une expérience de réservation simple et rapide pour garantir le succès de votre événement. Réservez en ligne ou contactez-nous pour obtenir de l'aide et des conseils personnalisés.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Réservation</h2>
				<ol>
					<li><a href="?route">Accueil</a></li>
					<li>Réservation</li>
				</ol>
			</div>
		</div>
	</section>

	<?= flash(); ?>

	<section class="container pt-4 pb-5">
		<div class="row justify-content-center py-5">
			<div class="col-md-5" data-aos="fade-right">
				<h3>Piscine à balles</h3>
				<img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""
					data-aos="fade-up" data-aos-delay="100">
			</div>

			<div class="col-md-5" data-aos="fade-left">
				<h3>Formulaire de réservation</h3>
				<div class="form">
					<form action="#" method="POST" role="form" class="php-email-form">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Nom</label>
									<input type="text" name="name"
										class="form-control" id="name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Prénom</label>
									<input type="text" name="name"
										class="form-control" id="name" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Email</label>
									<input type="email" class="form-control"
										name="email" id="email" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Mobile</label>
									<input type="text" class="form-control"
										name="mobile" id="mobile" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Date de début</label>
									<input type="date"
										class="form-control text-center"
										name="dateDebut" id="dateDebut">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Heure de début</label>
									<input type="time"
										class="form-control text-center"
										name="heureDebut" id="heureDebut">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Date de retour</label>
									<input type="date"
										class="form-control text-center"
										name="dateFin" id="dateFin">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mt-3">
									<label class="form-label">Heure de
										retour</label>
									<input type="time"
										class="form-control text-center"
										name="heureFin" id="heureFin">
								</div>
							</div>
						</div>
						<div class="form-group mt-3">
							<textarea class="form-control" name="message" rows="3"
								placeholder="Un commentaire..."></textarea>
						</div>
						<div class="my-3 text-center" data-aos="fade-up" data-aos-delay="100">
							<button type="submit">Réserver</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>