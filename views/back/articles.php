<?php
	Login::controlAccess([1]);





	$categorie = new Categorie();
	$Categories = $categorie->getCategories(); 
	
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
	<section>
		<div class="container-fluid">
			<div class="row py-4">
				<?php if($Categories): ?>
					<form action="#" method="POST" enctype="multipart/form-data" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="idCategorie" class="form-label">Catégorie</label>
							<select name="idCategorie" id="idCategorie" class="form-control">
								<option value="" selected></option>
								<?php foreach ($Categories as $categorie) :?>
									<option value="<?= $categorie["idCategorie"]; ?>"><?= $categorie["libelleCategorie"]; ?></option>
								<?php endforeach; ?> 
							</select>
							<div class="form-error"><?= $error['idCategorie'] ?? ''; ?></div>
						</div>
								
						<div class="form-group">
							<label for="libelleArticle" class="form-label">Libellé</label>
							<input type="text" name="libelleArticle" class="form-control"
								id="libelleArticle" value="<?=$_POST['libelleArticle']??"";?>">
							<div class="form-error"><?= $error['libelleArticle'] ?? ''; ?></div>
						</div>
								
						<div class="form-group">
							<label for="descriptionArticle" class="form-label">Description</label>
							<textarea name="" id="" rows="5" class="form-control"><?=$_POST['descriptionArticle']??"";?></textarea>
							<div class="form-error"><?= $error['descriptionArticle'] ?? ''; ?></div>
						</div>
								
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="achatArticle" class="form-label">Prix d'achat</label>
									<input type="text" name="achatArticle" class="form-control text-center"
										onkeypress="return VerifCasse(event,'float')"
										maxlength="7"
										id="achatArticle" value="<?=$_POST['achatArticle']??"";?>">
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
										id="cautionArticle" value="<?=$_POST['cautionArticle']??"";?>">
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
										id="tarifHeureArticle" value="<?=$_POST['tarifHeureArticle']??"";?>">
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
										id="tarifJourArticle" value="<?=$_POST['tarifJourArticle']??"";?>">
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
										id="tarifWeekArticle" value="<?=$_POST['tarifWeekArticle']??"";?>">
									<div class="form-error"><?= $error['tarifWeekArticle'] ?? ''; ?></div>
								</div>
							</div>
						</div>
								
						<div class="form-group">
							<label for="photos" class="form-label">Photos</label>
							<input type="file" name="photos"
								class="form-control" 
								multiple accept="image/*"									
								id="photos" value="<?=$_POST['photos']??"";?>">
							<div class="form-error"><?= $error['photos'] ?? ''; ?></div>
						</div>
						<div class="text-end">
							<a href="?route=articles" class="mybtn-light">Annuler</a>
							<button type="submit"
								name="subFormArticle"><?= isset($_GET["article"]) && $_GET["article"]?'Modifier':'Ajouter'; ?></button>
						</div>
					</form>

					<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
					colone de droite
				
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