<?php
	Membre::controlAccess([1]);

    $secteur = new Secteur();

    if(isset($_GET["activate"]) && $_GET["activate"]){
		$readSecteur = $secteur->readSecteur($_GET["activate"]);
		if($readSecteur["result"]){
			$activateSecteur=$secteur->activateSecteur($readSecteur["response"]);
			if($activateSecteur["result"]){ 
				setFlash("Félicitations.",$activateSecteur["response"]);
			} else {
				setFlash("Désolé !",$activateSecteur["response"],"danger");
			}
			header("location:?route=secteurs");
			die();
		} else {
			setFlash("Désolé !",$readSecteur["response"],"danger");
			header("location:?route=secteurs");
			die();
		}
	}elseif (isset($_POST["subFormSecteur"])){
		unset($_POST["subFormSecteur"]);
		$checkData = $secteur->checkData($_POST);
		$error = $checkData["error"];
		$_POST = $checkData["data"];

		if($error){
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			if (isset($_GET["secteur"]) && $_GET["secteur"]){
				$updateSecteur = $secteur->updateSecteur($_GET["secteur"],$_POST["libelleSecteur"]);
				if ($updateSecteur["result"]){
					setFlash("Félicitations.",$updateSecteur["response"]);
				} else {
					setFlash("Désolé !",$updateSecteur["response"], "danger");
				}
			} else {
				$createSecteur = $secteur->createSecteur($_POST["libelleSecteur"]);
				if ($createSecteur["result"]){
					setFlash("Félicitations.",$createSecteur["response"]);
				} else {
					setFlash("Désolé !",$createSecteur["response"], "danger");
				}
			}
			unset($_POST);
			header("location:?route=secteurs");
			die();
		}	
	} elseif (isset($_GET["secteur"]) && $_GET["secteur"]) {
		$readSecteur=$secteur->readSecteur($_GET["secteur"]);
		if ($readSecteur["result"]) {
			$_POST = $readSecteur["response"];
		} else {
			setFlash("Désolé !",$readSecteur["response"],"danger");
			header("location:?route=secteurs");
			die();
		}
	}elseif(isset($_GET["delete"]) && $_GET["delete"]){
		$readSecteur = $secteur->readSecteur($_GET["delete"]);		
		if($readSecteur["result"]){
			checkCsrf();
			$deleteSecteur=$secteur->deleteSecteur($_GET["delete"],$readSecteur["response"]["libelleSecteur"]);
			if($deleteSecteur["result"]){ 
				setFlash("Félicitations.",$deleteSecteur["response"]);
			} else {
				setFlash("Désolé !",$deleteSecteur["response"],"danger");
			}
			header("location:?route=secteurs");
			die();
		} else {
			setFlash("Désolé !",$readSecteur["response"],"danger");
			header("location:?route=secteurs");
			die();
		}
	}

	$Secteurs = $secteur->getSecteurs();

	$Title = $Description = "Gestion des secteurs";
	require_once '../views/header.php';
	require_once 'navbarBack1.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-folder2"></i>
				Gestion des secteurs
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container ">
			<div class="row py-4 justify-content-center">
				<div class="col-sm-12 col-md-6 col-lg-5 col-xl-3">
					<table class="table table-borered table-stripped table-condensed">
						<thead>
							<tr>
								<td>
									<form action="#" method="POST">
										<div class="form-group">
											<label for="libelleSecteur"
												class="form-label">Libellé</label>
											<input type="text"
												name="libelleSecteur"
												class="form-control"
												id="libelleSecteur"
												value="<?=$_POST['libelleSecteur']??"";?>">
											<div class="form-error">
												<?= $error['libelleSecteur'] ?? ''; ?>
											</div>
										</div>
										<div class="text-end">
											<a href="?route=secteurs"
												onclick="Processing()"
												class="mybtn-light">Annuler</a>
											<button type="submit"
												onclick="Processing()"
												class="mybtn"
												name="subFormSecteur"><?= isset($_GET["secteur"]) && $_GET["secteur"]?'Modifier':'Ajouter'; ?></button>
										</div>
									</form>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="w-100">Secteurs</th>
							</tr>
							<?php if ($Secteurs): ?>
							<?php foreach ($Secteurs as $secteur): ?>
							<tr>
								<td>
									<div class="dropdown float-end">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li>
												<a class="dropdown-item"
													onclick="Processing()"
													href="?route=secteurs&secteur=<?= $secteur['idSecteur']?>">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li>
												<a class="dropdown-item"
													onclick="Processing()"
													href="?route=secteurs&activate=<?= $secteur['idSecteur']?>">
													<i
														class="bi bi-eye-<?= is_null($secteur['activerSecteur']) ? 'slash-' : '' ;?>fill sub-bi"></i>
													Rendre
													<?= is_null($secteur['activerSecteur']) ? 'actif' : 'inactif' ;?></a>
											</li>
											<li>
												<a class="dropdown-item"
													href="#"
													onclick="sweetAlert('Vous confirmez ?',
																							'La suppression de ce secteur sera définitive !',
																							'?route=secteurs&delete=<?= $secteur['idSecteur']; ?>&<?= csrf(); ?>',
																							'warning')">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
									<i
										class="bi bi-eye-<?= is_null($secteur['activerSecteur']) ? 'slash-fill sub-bi' : 'fill col-iadn' ;?> bi-lg"></i>

									<?= $secteur['libelleSecteur']?>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td class="text-center py-5">
									Aucun secteur enregistré
								</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>