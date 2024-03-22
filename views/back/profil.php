<?php

	$membre = new Membre();

	if ( isset($_POST['subFormInitPass']) ) {
		$error = $membre->checkPassword($_POST);
		if ( $error ) {
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			$updatePassword = $membre->updatePassword($_POST['newPass'], $_SESSION['Auth']['idMembre']);
			if ( $updatePassword['result'] ) {
				setFlash("Félicitations.",$updatePassword['response']);
			} else {
				setFlash("Désolé ! ",$updatePassword['response'], "danger");
			}
			unset($_POST);
			header("Location:?route=profil");
			die();
		}
	} elseif ( isset($_POST['subFormProfil']) ) {
		unset($_POST['subFormProfil']);
		$checkData = $membre->checkData($_POST, $_SESSION['Auth']['level'], $_SESSION['Auth']['idMembre']);
		
		$error = $checkData['error'];
		$_POST = $checkData['data'];

		if ( $error ) {
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			$updateMembre = $membre->updateMembre($_POST, $_SESSION['Auth']['idMembre']);
			if ( $updateMembre['result'] ) {
				setFlash("Félicitations.",$updateMembre['response']);
			} else {
				setFlash("Désolé ! ",$updateMembre['response'], "danger");
			}
			unset($_POST);
			header("Location:?route=profil");
			die();
		}
	} else {
		$_POST = $_SESSION['Auth']; 
	}
	
	$Title = $Description = "Infos Perso";
	require_once '../views/header.php';
	require_once "navbarBack".$_SESSION['Auth']['level'].".php";
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-person-bounding-box"></i>
				Mon Profil
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container">
			<div class="row py-4 justify-content-center">
				<form action="#" method="POST" role="form" class="col-sm-12 col-md-8 col-lg-4 col-xl-4">
					<div class="bg-iadn-dark py-3 text-center">
						Mes informations
					</div>
					<?php if ( isset($_POST['subFormInitPass']) ): ?>
					<div class="text-center my-5">
						Modification du mot de passe en cours ...
					</div>
					<?php else: ?>
					<div class="row mt-2">
						<div class="col-md-6 text-center my-2">
							<div class="form-control">
								<input type="radio" name="genreMembre"
									class="form-checkbox" id="mme"
									<?= isset($_POST["genreMembre"]) && (int)$_POST["genreMembre"]==1 ?'checked' : '';?>
									value="1">
								<label class="form-label pointer"
									for="mme">Madame</label>
							</div>
						</div>
						<div class="col-md-6 text-center my-2">
							<div class="form-control">
								<input type="radio" name="genreMembre"
									class="form-checkbox" id="mr"
									<?= isset($_POST["genreMembre"]) && (int)$_POST["genreMembre"]==2 ?'checked' : '';?>
									value="2">
								<label class="form-label pointer"
									for="mr">Monsieur</label>
							</div>
						</div>
						<div class="form-error"><?= $error['genreMembre'] ?? ''; ?>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-md-6 ">
							<div class="form-group">
								<label class="form-label" for="nomMembre">Nom</label>
								<input type="text" name="nomMembre" class="form-control"
									id="nomMembre"
									value="<?=$_POST['nomMembre']??"";?>">
								<div class="form-error">
									<?= $error['nomMembre'] ?? ''; ?></div>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="form-group">
								<label class="form-label"
									for="prenomMembre">Prénom</label>
								<input type="text" name="prenomMembre"
									class="form-control" id="prenomMembre"
									value="<?=$_POST['prenomMembre']??"";?>">
								<div class="form-error">
									<?= $error['prenomMembre'] ?? ''; ?>
								</div>
							</div>
						</div>
					</div>

					<?php if ( $_SESSION['Auth']['level'] == 3 ): ?>
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
						style="display: <?= isset($_POST["typeMembre"])  ? ((int)$_POST["typeMembre"] > 1 ? 'block' : 'none') : 'none'; ?>;">
						<input type="hidden" name="entite" id="entite"
							value="<?= $_POST['entite'] ?? '';?>">
						<label class="form-label" for="entiteMembre">Intitulé de votre
							<span
								id="spanEntite"><?= $_POST['entite'] ?? '';?></span></label>
						<input type="text" name="entiteMembre" class="form-control"
							id="entiteMembre" value="<?=$_POST['entiteMembre']??"";?>">
						<div class="form-error"><?= $error['entiteMembre'] ?? ''; ?>
						</div>
					</div>

					<?php endif; ?>

					<div class="form-group">
						<label class="form-label" for="adresseMembre">Adresse</label>
						<input type="text" name="adresseMembre" class="form-control"
							id="adresseMembre" value="<?=$_POST['adresseMembre']??"";?>">
						<div class="form-error"><?= $error['adresseMembre'] ?? ''; ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 ">
							<div class="form-group">
								<label class="form-label" for="cpMembre">Code
									postal</label>
								<input type="text" name="cpMembre"
									class="form-control text-center" id="cpMembre"
									value="<?=$_POST['cpMembre']??"";?>"
									maxlength="5"
									onkeypress="return VerifCasse(event,'number')">
								<div class="form-error"><?= $error['cpMembre'] ?? ''; ?>
								</div>
							</div>
						</div>
						<div class="col-md-8 ">
							<div class="form-group">
								<label class="form-label"
									for="villeMembre">Ville</label>
								<input type="text" name="villeMembre"
									class="form-control" id="villeMembre"
									value="<?=$_POST['villeMembre']??"";?>">
								<div class="form-error">
									<?= $error['villeMembre'] ?? ''; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-5 sm-12 xs-12">
							<div class="form-group">
								<label class="form-label"
									for="mobileMembre">Téléphone</label>
								<input type="text" name="mobileMembre"
									class="form-control text-center"
									id="mobileMembre"
									value="<?=$_POST['mobileMembre']??"";?>"
									maxlength="10"
									onkeypress="return VerifCasse(event,'number')">
								<div class="form-error">
									<?= $error['mobileMembre'] ?? ''; ?></div>
							</div>
						</div>

						<div class="col-md-7 sm-12 xs-12">
							<div class="form-group">
								<label class="form-label"
									for="emailMembre">Email</label>
								<input type="email" name="emailMembre"
									class="form-control"
									onselectstart="return false"
									onpaste="return false;" onCopy="return false"
									onCut="return false" onDrag="return false"
									onDrop="return false" autocomplete=off
									id="emailMembre"
									value="<?=$_POST['emailMembre']??"";?>">
								<div class="form-error">
									<?= $error['emailMembre'] ?? ''; ?></div>
							</div>
						</div>
					</div>

					<div class="my-1 text-end">
						<a href="?route=profil" class="mybtn-light"
							onclick="Processing()">Annuler</a>
						<button type="submit" class="mybtn" onclick="Processing()"
							name="subFormProfil">Enregistrer</button>
					</div>
					<?php endif; ?>
				</form>

				<form action="#" method="POST" role="form" class="col-sm-10 col-md-6 col-lg-4 col-xl-3">
					<div class="bg-iadn-dark py-3 text-center">
						Changer mon mot de passe
					</div>
					<div class="form-group mt-3">
						<label class="form-label" for="newPass">Nouveau mot de
							passe</label>
						<div class="input-group">
							<input type="password" class="form-control" name="newPass"
								id="newPass" value="<?= $_POST['newPass'] ?? ''; ?>">
							<span class="input-group-text" onclick="showMdp('newPass')"><i
									class="bi bi-eye"></i></span>
						</div>
						<div class="form-error">
							<?= $error['newPass'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="confirmation">Confirmation</label>
						<div class="input-group">
							<input type="password" class="form-control" name="confirmation"
								id="confirmation"
								value="<?= $_POST['confirmation'] ?? ''; ?>">
							<span class="input-group-text"
								onclick="showMdp('confirmation')"><i
									class="bi bi-eye"></i></span>
						</div>
						<div class="form-error">
							<?= $error['confirmation'] ?? ''; ?></div>
					</div>
					<div class="my-1 text-end">
						<a href="?route=profil" class="mybtn-light"
							onclick="Processing()">Annuler</a>
						<button type="submit" class="mybtn" onclick="Processing()"
							name="subFormInitPass">Modifier</button>
					</div>
				</form>
			</div>
		</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>