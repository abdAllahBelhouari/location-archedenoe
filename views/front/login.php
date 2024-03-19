<?php
	
	$login = new Login();

	if ( isset ($_POST['subFormLogin']) ) {
		unset($_POST['subFormLogin']);
		$error=$login->checkData($_POST);
		if ( $error ) {
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			$connexion=$login->connexion($_POST);
			if ( $connexion ) {
				setFlash("Félicitations.",$_SESSION['Auth']['username'].", vous êtes maintenant connecté".((int)$_SESSION['Auth']['genreMembre']==1?'e':"").".");
				header("location:?route=index".$_SESSION['Auth']['level']);
				die();
			} else {
				setFlash("Désolé !","Aucun compte correspondant n'a été trouvé.","danger");
			}
		}
	}
	
	$Title = "Se connecter";
	$Description = "Connectez-vous à votre compte Arche de Noé à Dugny pour accéder à nos services de location de matériel de loisirs, sportif, éducatif et d'animation. Gérez facilement vos réservations, locations et profitez d'une expérience personnalisée.";

	require_once('../views/header.php');
	require_once('navbarFront.php');
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Espace Membre</h2>
				<ol>
					<li><a href="index.php">Accueil</a></li>
					<li>Mon Espace</li>
				</ol>
			</div>
		</div>
	</section>

	<section id="page-wrapper">
		<?=flash();?>
		<div class="container pt-4 pb-5">
			<form action="#" method="POST" role="form" class="row justify-content-center py-5">
				<h4 class="text-center py-4" data-aos="fade-down">Se connecter</h4>

				<div class="col-md-3">
					<div class="form-group" data-aos="fade-right">
						<label class="form-label">Email</label>
						<input type="email" name="emailMembre" class="form-control"
							id="emailMembre" placeholder="Votre email"
							value="<?=$_POST['emailMembre']??"";?>">
						<div class="form-error"><?= $error['emailMembre'] ?? ''; ?></div>
					</div>
					<div class="form-group" data-aos="fade-left">
						<label class="form-label">Mot de passe</label>
						<div class="input-group">
							<input type="password" class="form-control"
								name="passwordMembre" id="passwordMembre"
								placeholder="Mot de passe">
							<span class="input-group-text"
								onClick="showMdp('passwordMembre')" role="button"><i
									class="bi bi-eye"></i></span>
						</div>
						<div class="form-error"><?= $error['passwordMembre'] ?? ''; ?></div>
					</div>
					<div class="my-3 text-center" data-aos="fade-up" data-aos-delay="200">
						<a href="?route" class="mybtn-light" onclick="Processing()">Retour au
							site</a>
						<button type="submit" class="mybtn" name="subFormLogin"
							onclick="Processing()">Valider</button>
						<div class="mt-5 text-center">
							<button type="submit" class="mybtn" name="subFormForget"
								id="btnForget">Mot de
								passe oublié</button><br>
							<a href='?route=register' onclick="Processing();">S'inscrire</a>
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