<?php
	Login::controlAccess([1]);

	$article = new Article();
	$folder = "assets/pictures/";
	$backPhotoArticle = $imgPhoto[1] = $imgPhoto[2] = $imgPhoto[3] = "assets/img/back_800x600.jpg";

	if(isset($_GET["delete"]) && $_GET["delete"]){
		$readArticle = $article->readArticle($_GET["delete"]);
		if($readArticle["result"]){
			checkCsrf();
			$deleteArticle=$article->deleteArticle($_GET["delete"],$readArticle["response"]["libelleArticle"]);
			if($deleteArticle["result"]){ 
				setFlash("Félicitations.",$deleteArticle["response"]);
			} else {
				setFlash("Désolé !",$deleteArticle["response"],"danger");
			}
			header("location:?route=articles");
			die();
		} else {
			setFlash("Désolé !",$readArticle["response"],"danger");
			header("location:?route=articles");
			die();
		}
	} elseif(isset($_GET["disponible"]) && $_GET["disponible"]){
		$readArticle = $article->readArticle($_GET["disponible"]);
		if($readArticle["result"]){
			$dispoArticle = $article->dispoArticle($readArticle["response"]);
			if($dispoArticle["result"]){ 
				setFlash("Félicitations.",$dispoArticle["response"]);
			} else {
				setFlash("Désolé !",$dispoArticle["response"],"danger");
			}
			header("location:?route=articles");
			die();
		} else {
			setFlash("Désolé !",$readArticle["response"],"danger");
			header("location:?route=articles");
			die();
		}
	} elseif (isset($_POST["subFormArticle"])){
		unset($_POST["subFormArticle"]);

		$checkData = $article->checkData($_POST,$_FILES);
		$error = $checkData["error"];
		$_POST = $checkData["data"];
		
		if($error){
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		} else {
			if (isset($_GET["article"]) && $_GET["article"]){
				$updateArticle = $article->updateArticle($_GET["article"],$_POST);
				if ($updateArticle["result"]){
					setFlash("Félicitations.",$updateArticle["response"]);
				} else {
					setFlash("Désolé !",$updateArticle["response"], "danger");
				}
			} else {
				$createArticle = $article->createArticle($_POST,$_FILES);
				if ($createArticle["result"]){
					setFlash("Félicitations.",$createArticle["response"]);
				} else {
					setFlash("Désolé !",$createArticle["response"], "danger");
				}
			}
			unset($_POST);
			header("location:?route=articles");
			die();
		}

	} elseif (isset($_GET["article"]) && $_GET["article"]){
		$readArticle = $article->readArticle($_GET["article"]);
		if($readArticle["result"]){
			$_POST=$readArticle["response"];
			for ($p=1; $p < 4; $p++) { 
				if (!is_null($_POST["photo".$p."Article"])) {
					if (file_exists($folder.$_POST["photo".$p."Article"])) {
						$imgPhoto[$p] = $folder.$_POST["photo".$p."Article"];
					} else {
						$imgPhoto[$p] = $backPhotoArticle;
					}
				}
			}
		} else {
			setFlash("Désolé !",$readArticle["response"],"danger");
			header("location:?route=articles");
			die();
		}
	}
	for ($p=1; $p < 4; $p++) { 
		$_POST["namePhoto"][$p] = is_null($_POST["photo".$p."Article"])? $backPhotoArticle : $_POST["photo".$p."Article"];
	}



	$categorie = new Categorie();
	$Categories = $categorie->getCategories(); 
	$Articles = $article->getArticles();

	$Title = $Description = "Gestion des articles";
	require_once('../views/header.php');
	require_once('navbarBack1.php');
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>
					<i class="bi bi-basket2"></i>
					Gestion des articles
				</h2>
			</div>
		</div>
	</section><!-- End Breadcrumbs Section -->
	<?=flash();?>
	<section id="page-wrapper">
		<div class="container-fluid">
			<div class="row py-4">
				<?php if($Categories): ?>
					<form action="#" method="POST" enctype="multipart/form-data" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-5">
								<div class="form-group">
									<label for="idCategorie" class="form-label">Catégorie</label>
									<select name="idCategorie" id="idCategorie" class="form-control">
										<option value="" selected></option>
										<?php foreach ($Categories as $categorie) :?>
											<option <?= (isset($_POST["idCategorie"]) 
																&& $_POST["idCategorie"]==$categorie["idCategorie"]) ?
																 "selected" 
																 : ""; ?>
																 value="<?= $categorie["idCategorie"]; ?>">
																 <?= $categorie["libelleCategorie"]; ?></option>
										<?php endforeach; ?> 
									</select>
									<div class="form-error"><?= $error['idCategorie'] ?? ''; ?></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-7">
								<div class="form-group">
									<label for="libelleArticle" class="form-label">Libellé</label>
									<input type="text" name="libelleArticle" class="form-control"
										id="libelleArticle" value="<?=$_POST['libelleArticle']??"";?>">
									<div class="form-error"><?= $error['libelleArticle'] ?? ''; ?></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="descriptionArticle" class="form-label">Description</label>
							<textarea name="descriptionArticle" id="descriptionArticle" rows="5" class="form-control"><?=$_POST['descriptionArticle']??"";?></textarea>
							<div class="form-error"><?= $error['descriptionArticle'] ?? ''; ?></div>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="achatArticle" class="form-label">Prix d'achat</label>
									<input type="text" name="achatArticle" class="form-control text-center"
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="achatArticle" value="<?= isset($_POST['achatArticle']) ? (float)$_POST['achatArticle'] : "";?>">
									<div class="form-error"><?= $error['achatArticle'] ?? ''; ?></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="cautionArticle" class="form-label">Caution</label>
									<input type="text" name="cautionArticle"
										class="form-control text-center" 
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="cautionArticle" value="<?=isset($_POST['cautionArticle']) ? (float)$_POST['cautionArticle'] : "";?>">
									<div class="form-error"><?= $error['cautionArticle'] ?? ''; ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="tarifHeureArticle" class="form-label">Tarif Heure</label>
									<input type="text" name="tarifHeureArticle" class="form-control text-center"
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="tarifHeureArticle" value="<?=isset($_POST['tarifHeureArticle']) ? (float)$_POST['tarifHeureArticle'] : "";?>">
									<div class="form-error"><?= $error['tarifHeureArticle'] ?? ''; ?></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="tarifJourArticle" class="form-label">Tarif Jour</label>
									<input type="text" name="tarifJourArticle"
										class="form-control text-center" 
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="tarifJourArticle" value="<?=isset($_POST['tarifJourArticle']) ? (float)$_POST['tarifJourArticle'] : "";?>">
									<div class="form-error"><?= $error['tarifJourArticle'] ?? ''; ?></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="tarifWeekArticle" class="form-label">Tarif W-end</label>
									<input type="text" name="tarifWeekArticle"
										class="form-control text-center" 
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="tarifWeekArticle" value="<?=isset($_POST['tarifWeekArticle']) ? (float)$_POST['tarifWeekArticle'] : "";?>">
									<div class="form-error"><?= $error['tarifWeekArticle'] ?? ''; ?></div>
								</div>
							</div>
						</div>
						<div class="row">
							<?php for ($p=1; $p <4 ; $p++) : ?>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<label for="photo<?= $p; ?>Article" class="form-label">Photo <?= $p; ?></label>
									<div class="p-1 border rounded text-center">									
										<input type="text" name="namePhoto[<?= $p; ?>]" value="<?= $_POST["namePhoto"][$p]; ?>">
										<input type="file" accept="image/*" class="photoArticle" id="photo<?= $p; ?>Article" name="photo<?= $p; ?>Article"
										onchange="showImgLoading(event, 'imgPhoto<?= $p; ?>Article');">
										<img id="imgPhoto<?= $p; ?>Article" src="<?= $imgPhoto[$p]; ?>" class='imgPhotoArticle'
										onclick="document.getElementById('photo<?= $p; ?>Article').click();">
										<div class="form-error"><?= $error['photo'.$p.'Article'] ?? ''; ?></div>
									</div>					
								</div>
							<?php endfor; ?>
						</div>
						<div class="text-end mt-3">
							<a href="?route=articles" onclick="Processing()" class="mybtn-light">Annuler</a>
							<button type="submit" onclick="Processing()" 
								name="subFormArticle"><?= isset($_GET["article"]) && $_GET["article"]?'Modifier':'Ajouter'; ?></button>
						</div>
					</form>

					<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
						<h5>
							Liste des articles
							<span class="badge bg-dark mx-3"><?=count($Articles);?></span>
						</h5>
						<div class="table-responsive">
							<table class="table table-borered table-stripped table-condensed">
								<thead>
									<tr>
										<th>Libellé</th>
										<th class="w-200p">Catégorie</th>
										<th class="w-100p">Heure</th>
										<th class="w-100p">Jour</th>
										<th class="w-100p">Week-end</th>
									</tr>
								</thead>
								<tbody>
									<?php if($Articles):?>
									<?php foreach ($Articles as $article):?>
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
														<a class="dropdown-item" onclick="Processing()"
															href="?route=articles&article=<?= $article['idArticle']?>">
															<i
																class="bi bi-pencil-fill sub-bi"></i>
															Modifier</a>
													</li>
													<li>
														<a class="dropdown-item" onclick="Processing()"
															href="?route=articles&disponible=<?= $article['idArticle']?>">
															<i
																class="bi bi-database-fill-<?= is_null($article['disponibleArticle']) ? 'slash' : 'check' ;?> sub-bi"></i>
															Rendre
															<?= is_null($article['disponibleArticle']) ? 'disponible' : 'indisponible' ;?></a>
													</li>
													<li>
														<a class="dropdown-item"
															href="#"
															onclick="sweetAlert('Vous confirmez ?',
																				'La suppression de cet article sera définitive !',
																				'?route=articles&delete=<?= $article['idArticle']; ?>&<?= csrf(); ?>',
																				'warning')">
															<i
																class="bi bi-trash-fill sub-bi"></i>
															Supprimer</a>
													</li>
												</ul>
											</div>
											<i
												class="bi bi-database-fill-<?= is_null($article['disponibleArticle']) ? 'slash sub-bi' : 'check col-iadn' ;?> bi-lg"></i>
											<?= $article['libelleArticle']; ?>
										</td>
										<td>
											<?= $article['libelleCategorie']; ?>
										</td>
										<td class="text-end">
											<?= empty($article['tarifHeureArticle'])? "" : number_format($article['tarifHeureArticle'], 2, ',', ' ' ); ?>
										</td>
										<td class="text-end">
											<?= empty($article['tarifJourArticle'])? "" : number_format($article['tarifJourArticle'], 2, ',', ' ' ); ?>
										</td>
										<td class="text-end">
											<?= empty($article['tarifWeekArticle'])? "" : number_format($article['tarifWeekArticle'], 2, ',', ' ' ); ?>
										</td>
									</tr>
									<?php endforeach; ?>
									<?php else: ?>
									<tr>
										<td colspan="5" class="text-center py-4">
											Aucun article enregistré
										</td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php else:?>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
						<img class="imgWarning" src="../public/assets/img/warning.png" alt="alerte">
						<p>Aucune catégorie n'a été enregistrée</p>
						<a href="?route=categories" class="mybtn">Catégories</a>
					</div>				
				<?php endif;?>				
			</div>
		</div>
	</section>

</main>
<?php
	require_once('../views/scripts.php');
	require_once('footer.php');
?>