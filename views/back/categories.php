<?php
	Login::controlAccess([1]);

	$categorie = new Categorie();

	if(isset($_GET["show"]) && $_GET["show"]){
		$readCategorie = $categorie->readCategorie($_GET["show"]);
		if($readCategorie["result"]){
			$showWeb=$categorie->showWeb($readCategorie["response"]);
			if($showWeb["result"]){ 
				setFlash("Félicitations.",$showWeb["response"]);
			} else {
				setFlash("Désolé !",$showWeb["response"],"danger");
			}
			header("location:?route=categories");
			die();
		} else {
			setFlash("Désolé !",$readCategorie["response"],"danger");
			header("location:?route=categories");
			die();
		}
	}elseif (isset($_POST["subFormCategorie"])){
		unset($_POST["subFormCategorie"]);
		$checkData = $categorie->checkData($_POST);
		$error = $checkData["error"];
		$_POST = $checkData["data"];

		if($error){
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			if (isset($_GET["categorie"]) && $_GET["categorie"]){
				$updateCategorie = $categorie->updateCategorie($_GET["categorie"],$_POST["libelleCategorie"]);
				if ($updateCategorie["result"]){
					setFlash("Félicitations.",$updateCategorie["response"]);
				} else {
					setFlash("Désolé !",$updateCategorie["response"], "danger");
				}
			} else {
				$createCategorie = $categorie->createCategorie($_POST["libelleCategorie"]);
				if ($createCategorie["result"]){
					setFlash("Félicitations.",$createCategorie["response"]);
				} else {
					setFlash("Désolé !",$createCategorie["response"], "danger");
				}
			}
			unset($_POST);
			header("location:?route=categories");
			die();
		}	
	} elseif (isset($_GET["categorie"]) && $_GET["categorie"]) {
		$readCategorie=$categorie->readCategorie($_GET["categorie"]);
		if ($readCategorie["result"]) {
			$_POST = $readCategorie["response"];
		} else {
			setFlash("Désolé !",$readCategorie["response"],"danger");
			header("location:?route=categories");
			die();
		}
	}elseif(isset($_GET["delete"]) && $_GET["delete"]){
		$readCategorie = $categorie->readCategorie($_GET["delete"]);		
		if($readCategorie["result"]){
			checkCsrf();
			$deleteCategorie=$categorie->deleteCategorie($_GET["delete"],$readCategorie["response"]["libelleCategorie"]);
			if($deleteCategorie["result"]){ 
				setFlash("Félicitations.",$deleteCategorie["response"]);
			} else {
				setFlash("Désolé !",$deleteCategorie["response"],"danger");
			}
			header("location:?route=categories");
			die();
		} else {
			setFlash("Désolé !",$readCategorie["response"],"danger");
			header("location:?route=categories");
			die();
		}
	}

	$Categories = $categorie->getCategories();

	$Title = $Description = "Gestion des catégories";
	
	require_once('../views/header.php');
	require_once('navbarBack1.php');
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>
					<i class="bi bi-diagram-3-fill"></i>
					Gestion des catégories
				</h2>
			</div>
		</div>
	</section><!-- End Breadcrumbs Section -->
	<?=flash();?>
	<section id="page-wrapper">
		<div class="container-fluid">
			<div class="row py-4">
				<div class="col-sm-12 col-md-6 col-lg-5 col-xl-3">
					<table class="table table-borered table-stripped table-condensed">
						<thead>
							<tr>
								<td>
									<form action="#" method="POST">
										<div class="form-group">
											<label for="libelleCategorie"
												class="form-label">Libellé</label>
											<input type="text"
												name="libelleCategorie"
												class="form-control"
												id="libelleCategorie"
												value="<?=$_POST['libelleCategorie']??"";?>">
											<div class="form-error">
												<?= $error['libelleCategorie'] ?? ''; ?>
											</div>
										</div>
										<div class="text-end">
											<a href="?route=categories"
												class="mybtn-light">Annuler</a>
											<button type="submit"
												name="subFormCategorie"><?= isset($_GET["categorie"]) && $_GET["categorie"]?'Modifier':'Ajouter'; ?></button>
										</div>
									</form>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="w-100">Catégories</th>
							</tr>
							<?php if ($Categories): ?>
							<?php foreach ($Categories as $categorie): ?>
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
													href="?route=categories&categorie=<?= $categorie['idCategorie']?>">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li>
												<a class="dropdown-item"
													href="?route=categories&show=<?= $categorie['idCategorie']?>">
													<i
														class="bi bi-eye-<?= is_null($categorie['webCategorie']) ? 'slash-' : '' ;?>fill sub-bi"></i>
													Rendre
													<?= is_null($categorie['webCategorie']) ? 'visible' : 'invisible' ;?></a>
											</li>
											<li>
												<a class="dropdown-item"
													href="#"
													onclick="sweetAlert('Vous confirmez ?',
																							'La suppression de cette catégorie sera définitive !',
																							'?route=categories&delete=<?= $categorie['idCategorie']; ?>&<?= csrf(); ?>',
																							'warning')">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
									<i
										class="bi bi-eye-<?= is_null($categorie['webCategorie']) ? 'slash-fill sub-bi' : 'fill col-iadn' ;?> bi-lg"></i>

									<?= $categorie['libelleCategorie']?>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td class="text-center py-5">
									Aucune catégorie enregistrée
								</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</section>

</main>
<?php
	require_once('../views/scripts.php');
	require_once('footer.php');
?>