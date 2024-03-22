<?php
	Login::controlAccess([1]);

	$params = new Parametre();
	
	if ( isset($_GET['deleteLogo']) ) {
		$deleteLogo = $params->deleteLogo();
		if ( $deleteLogo['result'] ) {
			setFlash("Opération terminée.",$deleteLogo['response']);
		} else {
			setFlash("Désolé !",$deleteLogo['response'],'danger');
		}
		header("Location:?route=parametres");
		die();
	} elseif ( isset($_POST['subFormParams']) ) {
		unset($_POST['subFormParams']);
		$checkParams = $params->checkParams($_POST, $_FILES);
		$error = $checkParams['error'];
		$_POST = $checkParams['data'];
		
		if ( $error ) {
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			$updateParams = $params->updateParams ( $_POST, $_FILES );
			if ( $updateParams['result'] ) {
				setFlash("Opération terminée.",$updateParams['response']);
			} else {
				setFlash("Désolé !",$updateParams['response'],'danger');
			}
			unset($_POST);
			header("Location:?route=parametres");
			die();
		}
	} else {
		$_POST = $IADN;
	}

	$Title = $Description = "Gestion des ";
	require_once '../views/header.php';
	require_once 'navbarBack1.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-sliders2-vertical"></i>
				Paramètres
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container">
			<form action="#" method="POST" role="form" enctype="multipart/form-data"
				class="row py-4 justify-content-center">
				<div class="col-sm-12 col-md-8 col-lg-4 col-xl-4">
					<div class="form-group">
						<label class="form-label" for="iadnLibelle">libellé</label>
						<input type="text" name="iadnLibelle" class="form-control"
							id="iadnLibelle" value="<?=$_POST['iadnLibelle']??"";?>">
						<div class="form-error"><?= $error['iadnLibelle'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="iadnAdresse">Adresse</label>
						<input type="text" name="iadnAdresse" class="form-control"
							id="iadnAdresse" value="<?=$_POST['iadnAdresse']??"";?>">
						<div class="form-error"><?= $error['iadnAdresse'] ?? ''; ?></div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-12 col-md-4 col-lg-4">
							<div class="form-group">
								<label class="form-label" for="iadnCp">Code
									Postal</label>
								<input type="text" name="iadnCp"
									class="form-control text-center" id="iadnCp"
									maxlength="5"
									onkeypress="return VerifCasse(event,'number')"
									value="<?=$_POST['iadnCp']??"";?>">
								<div class="form-error"><?= $error['iadnCp'] ?? ''; ?>
								</div>
							</div>
						</div>

						<div class="col-12 col-sm-12 col-md-8 col-lg-8">
							<div class="form-group">
								<label class="form-label" for="iadnVille">Ville</label>
								<input type="text" name="iadnVille" class="form-control"
									id="iadnVille"
									value="<?=$_POST['iadnVille']??"";?>">
								<div class="form-error">
									<?= $error['iadnVille'] ?? ''; ?></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-12 col-md-5 col-lg-5">
							<div class="form-group">
								<label class="form-label"
									for="iadnPhone">Téléphone</label>
								<input type="text" name="iadnPhone"
									class="form-control text-center" id="iadnPhone"
									maxlength="10"
									onkeypress="return VerifCasse(event,'number')"
									value="<?=$_POST['iadnPhone']??"";?>">
								<div class="form-error">
									<?= $error['iadnPhone'] ?? ''; ?></div>
							</div>
						</div>

						<div class="col-12 col-sm-12 col-md-7 col-lg-7">
							<div class="form-group">
								<label class="form-label" for="iadnEmail">Email</label>
								<input type="text" name="iadnEmail" class="form-control"
									id="iadnEmail"
									value="<?=$_POST['iadnEmail']??"";?>">
								<div class="form-error">
									<?= $error['iadnEmail'] ?? ''; ?></div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="form-label" for="iadnHttp">URL du site WEB</label>
						<input type="text" name="iadnHttp" class="form-control" id="iadnHttp"
							value="<?=$_POST['iadnHttp']??"";?>">
						<div class="form-error"><?= $error['iadnHttp'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="iadnRepresentant">Représentant</label>
						<input type="text" name="iadnRepresentant" class="form-control"
							id="iadnRepresentant"
							value="<?=$_POST['iadnRepresentant']??"";?>">
						<div class="form-error"><?= $error['iadnRepresentant'] ?? ''; ?></div>
					</div>
				</div>

				<div class="col-sm-12 col-md-8 col-lg-3 col-xl-3">
					<input type="file" id="iadnLogo" name="iadnLogo"
						onchange="showImgLoading(event, 'iadnLogo_view')" accept="image/*"
						style="display: none;" />

					<label class="form-label" for="iadnLogo">Logo</label>
					<div class="divLogo p-3" onclick="document.getElementById('iadnLogo').click();">
						<img id="iadnLogo_view" src="<?= $_SESSION['iadnLogo']; ?>" />
					</div>
					<div class="form-error"><?= $error['iadnLogo'] ?? ''; ?></div>

					<?php if ( $_SESSION['iadnLogo'] != 'assets/img/logo_default.png' ): ?>
					<i onclick="sweetAlert('Vous confirmez ?',
											'Pour la suppression définitive  de ce logo !',
											'?route=parametres&deleteLogo&<?= csrf(); ?>',
											'warning')" class="bi bi-trash bx-sm link" title='Supprimer le logo'></i>
					<?php endif; ?>

					<div class="form-group mt-4">
						<label class="form-label" for="iadnBic">BIC</label>
						<input type="text" name="iadnBic" class="form-control text-center"
							id="iadnBic" maxlength="11"
							onkeypress="return VerifCasse(event,'rib')"
							value="<?=$_POST['iadnBic']??"";?>">
						<div class="form-error"><?= $error['iadnBic'] ?? ''; ?></div>
					</div>

					<div class="form-group">
						<label class="form-label" for="iadnIban">IBAN</label>
						<input type="text" name="iadnIban" class="form-control" id="iadnIban"
							maxlength="34" onkeypress="return VerifCasse(event,'rib')"
							value="<?=$_POST['iadnIban']??"";?>">
						<div class="form-error"><?= $error['iadnIban'] ?? ''; ?></div>
					</div>

					<div class="my-1 text-end">
						<a href="?route=parametres" class="mybtn-light"
							onclick="Processing()">Annuler</a>
						<button type="submit" class="mybtn" onclick="Processing()"
							name="subFormParams">Enregistrer</button>
					</div>
				</div>
		</div>
		</form>
		</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>