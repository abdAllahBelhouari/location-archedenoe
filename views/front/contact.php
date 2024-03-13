<?php


	$Title = "Nous contacter";
	$Description = "Besoin d'aide ou d'informations supplémentaires ? Contactez l'équipe d'Arche de Noé à Dugny. Nous sommes là pour répondre à toutes vos questions concernant la location de matériel de loisirs, sportif, éducatif et d'animation. N'hésitez pas à nous contacter via notre formulaire en ligne ou par téléphone.";

	require_once('../views/header.php');
	require_once('navbarFront.php');
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Nous contacter</h2>
				<ol>
					<li><a href="?route">Accueil</a></li>
					<li>Contact</li>
				</ol>
			</div>
		</div>
	</section>

	<section id="contact" class="pt-4 pb-5">
		<div class="container">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2620.197250050689!2d2.4147363558197066!3d48.94972985952054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66b9c0dca7879%3A0xf620ea681b83a458!2zSW5zdGl0dXQgbOKAmUFyY2hlIGRlIE5vw6k!5e0!3m2!1sfr!2sfr!4v1704807135937!5m2!1sfr!2sfr"
				width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>

			<div class="row justify-content-center py-5">
				<div class="col-lg-3 col-md-4" data-aos="fade-right">
					<div class="info">
						<div>
							<i class="bi bi-geo-alt"></i>
							<p>12 Av. du Général de Gaulle,<br>93440 Dugny</p>
						</div>

						<div>
							<i class="bi bi-envelope"></i>
							<p><a href="mailto:contact@example.com"
									target="_blank">contact@example.com</a></p>
						</div>

						<div>
							<i class="bi bi-phone"></i>
							<p><a href="tel:01 83 37 75 84">01 83 37 75 84</a></p>
						</div>
						<div>
							<i class="bi bi-clock"></i>
							<p>
								Permanence<br>
								Mercredi de <b>10h00</b> à <b>15h00</b><br>
								Samedi de <b>11h00</b> à <b>16h00</b>
							</p>
						</div>
					</div>
				</div>

				<div class="col-lg-5 col-md-8" data-aos="fade-left">
					<div class="form">
						<form action="#" method="POST" role="form" class="php-email-form">
							<div class="form-group">
								<input type="text" name="name" class="form-control"
									id="name" placeholder="Votre Nom" required>
							</div>
							<div class="form-group mt-3">
								<input type="email" class="form-control" name="email"
									id="email" placeholder="Votre Email" required>
							</div>
							<div class="form-group mt-3">
								<input type="text" class="form-control" name="subject"
									id="subject" placeholder="Sujet" required>
							</div>
							<div class="form-group mt-3">
								<textarea class="form-control" name="message" rows="5"
									placeholder="Votre Message" required></textarea>
							</div>
							<div class="my-3 text-center" data-aos="fade-up"
								data-aos-delay="100"><button
									type="submit">Envoyer</button></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
	require_once('../views/scripts.php');
	require_once('footer.php');
?>