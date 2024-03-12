<?php


	
	require_once('../views/header.php');
	require_once('navbarFront.php');
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Espace Membre</h2>
				<ol>
					<li><a href="?route">Accueil</a></li>
					<li>S'inscrire</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs Section -->

	<section id="register" class="pt-4 pb-5">
		<div class="container">
			<form action="#" method="POST" role="form" class="row justify-content-center py-5">
				<h4 class="text-center py-4" data-aos="fade-down">S'incrire</h4>
				<div class="col-md-3" data-aos="fade-right">
					<div class="form-group">
						<label class="form-label">Nom</label>
						<input type="text" name="nom" class="form-control" id="nom" required>
					</div>
					<div class="form-group">
						<label class="form-label">Prénom</label>
						<input type="text" name="prenom" class="form-control" id="prenom"
							required>
					</div>
					<div class="form-group">
						<label class="form-label">Adresse</label>
						<input type="text" name="adresse" class="form-control" id="adresse"
							required>
					</div>
					<div class="form-group">
						<label class="form-label">Code Postal</label>
						<input type="text" name="code" class="form-control" id="code" required>
					</div>
					<div class="form-group">
						<label class="form-label">Ville</label>
						<input type="text" name="ville" class="form-control" id="ville"
							required>
					</div>
				</div>

				<div class="col-md-3" data-aos="fade-left">
					<div class="form-group">
						<label class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email"
							required>
					</div>
					<div class="form-group">
						<label class="form-label">Confirmation</label>
						<input type="email" name="confirmation" class="form-control"
							id="confirmation" required>
					</div>
					<div class="form-group">
						<label class="form-label">Mot de passe</label>
						<div class="input-group">
							<input type="password" class="form-control" name="motdepasse"
								id="motdepasse" placeholder="Mot de passe">
							<span class="input-group-text" onclick="showMdp('motdepasse')"><i class="bi bi-eye"></i></span>
						</div>
					</div>
					<div class="my-3 text-center" data-aos="fade-up" data-aos-delay="200">
						<button type="submit">Enregistrer</button>
						<div class="mt-5 text-center">
							<a href='?route=login'>Déjà inscrit ...</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</main>
<?php
	require_once('../views/scripts.php');
?>
</body>

</html>