<?php

	$membre = new Membre();

	if ( isset($_POST['subFormRegister']) ) {
		unset($_POST['subFormRegister']);
		$checkData = $membre->checkData($_POST, 3);
		
		$error = $checkData['error'];
		$_POST = $checkData['data'];

		if ( $error ) {
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			$createMembre = $membre->createMembre($_POST, 3);
			if ( $createMembre['result'] ) {
				setFlash("Félicitations.",$createMembre['response']);
				header("Location:?route=login");
			} else {
				setFlash("Désolé ! ",$createMembre['response'], "danger");
				header("Location:?route=register");
			}
			die();
		}
	}
	
	$Title = "S'inscrire";
	$Description = "Inscrivez-vous chez Arche de Noé à Dugny pour bénéficier de nos services de location de matériel de loisirs, sportif, éducatif et d'animation. Créez un compte dès maintenant pour accéder à nos offres exclusives et simplifier vos réservations et locations.";

	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
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
	</section>

	<section id="page-wrapper">
		<?=flash();?>
		<div class="container pt-4 pb-5">
			<form action="#" method="POST" role="form" class="row justify-content-center py-5">
				<h4 class="text-center py-4" data-aos="fade-down">S'incrire</h4>
				<div class="col-md-3" data-aos="fade-right">
					<div class="form-label">Civilité</div>
					<div class="form-group">
						<div class="form-control text-center">
							<input type="radio" name="genreMembre" class="form-checkbox"
								id="mme"
								<?= isset($_POST["genreMembre"]) && (int)$_POST["genreMembre"]==1 ?'checked' : '';?>
								value="1">
							<label class="form-label me-3 pointer" for="mme">Madame</label>

							<input type="radio" name="genreMembre" class="form-checkbox"
								id="mr"
								<?= isset($_POST["genreMembre"]) && (int)$_POST["genreMembre"]==2 ?'checked' : '';?>
								value="2">
							<label class="form-label pointer" for="mr">Monsieur</label>
						</div>
						<div class="form-error"><?= $error['genreMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="nomMembre">Nom</label>
						<input type="text" name="nomMembre" class="form-control" id="nomMembre"
							value="<?=$_POST['nomMembre']??"";?>">
						<div class="form-error"><?= $error['nomMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="prenomMembre">Prénom</label>
						<input type="text" name="prenomMembre" class="form-control"
							id="prenomMembre" value="<?=$_POST['prenomMembre']??"";?>">
						<div class="form-error"><?= $error['prenomMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label for="typeMembre" class="form-label">Vous êtes</label>
						<select name="typeMembre" id="typeMembre" class="form-control"
							onchange="checkTypeMembre(this.options[selectedIndex].value);">
							<option value="" selected></option>
							<?php for ( $t=1 ; $t < count($TypeMembre) ; $t++ ): ?>
							<option <?= (isset($_POST["typeMembre"])  && $_POST["typeMembre"]==$t) ? "selected" : ""; ?>
								value="<?= $t; ?>">
								<?= $TypeMembre[$t]; ?>
							</option>
							<?php endfor; ?>
						</select>
						<div class="form-error">
							<?= $error['typeMembre'] ?? ''; ?></div>
					</div>

					<div id="divEntiteMembre" class="form-group expandable"
						style="display: <?= isset($_POST["typeMembre"])  ? ((int)$_POST["typeMembre"] == 1 ? 'none' : 'block') : 'none'; ?>;">
						<input type="hidden" name="entite" id="entite"
							value="<?= $_POST['entite'] ?? '';?>">
						<label class="form-label" for="entiteMembre">Intitulé de votre <span
								id="spanEntite"><?= $_POST['entite'] ?? '';?></span></label>
						<input type="text" name="entiteMembre" class="form-control"
							id="entiteMembre" value="<?=$_POST['entiteMembre']??"";?>">
						<div class="form-error"><?= $error['entiteMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="adresseMembre">Adresse</label>
						<input type="text" name="adresseMembre" class="form-control"
							id="adresseMembre" value="<?=$_POST['adresseMembre']??"";?>">
						<div class="form-error"><?= $error['adresseMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="cpMembre">Code postal</label>
						<input type="text" name="cpMembre" class="form-control" id="cpMembre"
							value="<?=$_POST['cpMembre']??"";?>" maxlength="5"
							onkeypress="return VerifCasse(event,'number')">
						<div class="form-error"><?= $error['cpMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="villeMembre">Ville</label>
						<input type="text" name="villeMembre" class="form-control"
							id="villeMembre" value="<?=$_POST['villeMembre']??"";?>">
						<div class="form-error"><?= $error['villeMembre'] ?? ''; ?></div>
					</div>
				</div>

				<div class="col-md-3" data-aos="fade-left">
					<div class="form-group">
						<label class="form-label" for="mobileMembre">Téléphone</label>
						<input type="text" name="mobileMembre" class="form-control"
							id="mobileMembre" value="<?=$_POST['mobileMembre']??"";?>"
							maxlength="10" onkeypress="return VerifCasse(event,'number')">
						<div class="form-error"><?= $error['mobileMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="emailMembre">Email</label>
						<input type="email" name="emailMembre" class="form-control"
							onselectstart="return false" onpaste="return false;"
							onCopy="return false" onCut="return false" onDrag="return false"
							onDrop="return false" autocomplete=off id="emailMembre"
							value="<?=$_POST['emailMembre']??"";?>">
						<div class="form-error"><?= $error['emailMembre'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="confirmation">Confirmation</label>
						<input type="email" name="confirmation" class="form-control"
							onselectstart="return false" onpaste="return false;"
							onCopy="return false" onCut="return false" onDrag="return false"
							onDrop="return false" autocomplete=off id="confirmation"
							value="<?=$_POST['confirmation']??"";?>">
						<div class="form-error"><?= $error['confirmation'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="passwordMembre">Votre mot de
							passe</label>
						<div class="input-group">
							<input type="password" class="form-control"
								name="passwordMembre" id="passwordMembre">
							<span class="input-group-text"
								onclick="showMdp('passwordMembre')"><i
									class="bi bi-eye"></i></span>
						</div>
						<div class="form-error"><?= $error['passwordMembre'] ?? ''; ?></div>
					</div>

					<div class="my-3 text-center" data-aos="fade-up" data-aos-delay="200">
						<a href="?route=register" class="mybtn-light"
							onclick="Processing()">Annuler</a>
						<button type="submit" class="mybtn" onclick="Processing()"
							name="subFormRegister">Enregistrer</button>
						<div class="mt-5 text-center">
							<a href='?route=login' onclick="Processing();">Déjà inscrit</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</main>

<?php 
	require_once '../views/scripts.php'; 
?>

</body>

</html>