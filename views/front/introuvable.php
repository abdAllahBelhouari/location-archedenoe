<?php
	$Title = "Page introuvable";
	$Description = "La page que vous recherchez est introuvable chez Arche de Noé à Dugny. Il semble que le lien que vous avez suivi soit incorrect ou que la page ait été supprimée. Retournez à notre page d'accueil pour explorer nos services de location de matériel de loisirs, sportif, éducatif et d'animation, ou contactez-nous si vous avez besoin d'aide pour trouver ce que vous cherchez.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Oops !</h2>
				<ol>
					<li><a href="?route">Accueil</a></li>
				</ol>
			</div>
		</div>
	</section>

	<div class="introuvable">
		<h1>Page Introuvable !</h1>
		<p>La page à laquelle vous souhaitez accéder est introuvable.</p>
	</div>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>