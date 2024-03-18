<?php
    Login::controlAccess([1]);

	$condition = new Condition();
	
	if(isset($_POST["subFormReindexer"])){
		$reindexation=$condition->reindexation($_POST["Indexations"]);
		if($reindexation["result"]){ 
			setFlash("Félicitations.",$reindexation["response"]);
		} else {
			setFlash("Désolé !",$reindexation["response"],"danger");
		}
		header("location:?route=conditions");
		die();
	}elseif(isset($_GET["delete"]) && $_GET["delete"]){
		$readCondition = $condition->readCondition($_GET["delete"]);
		if($readCondition["result"]){
			checkCsrf();
			$deleteCondition=$condition->deleteCondition($_GET["delete"]);
			if($deleteCondition["result"]){ 
				setFlash("Félicitations.",$deleteCondition["response"]);
			} else {
				setFlash("Désolé !",$deleteCondition["response"],"danger");
			}
			header("location:?route=conditions");
			die();
		} else {
			setFlash("Désolé !",$readCondition["response"],"danger");
			header("location:?route=conditions");
			die();
		}
	} elseif(isset($_GET["show"]) && $_GET["show"]){
		$readCondition = $condition->readCondition($_GET["show"]);
		if($readCondition["result"]){
			$showWeb=$condition->showWeb($readCondition["response"]);
			if($showWeb["result"]){ 
				setFlash("Félicitations.",$showWeb["response"]);
			} else {
				setFlash("Désolé !",$showWeb["response"],"danger");
			}
			header("location:?route=conditions");
			die();
		} else {
			setFlash("Désolé !",$readCondition["response"],"danger");
			header("location:?route=conditions");
			die();
		}
	} elseif(isset($_POST["subFormCondition"])){
		unset($_POST["subFormCondition"]);
		$checkData = $condition->checkData($_POST);
		$error = $checkData["error"];
		$_POST = $checkData["data"];

		if($error){
			$e=count($error)==1?"l'erreur contenue":"les ".count($error)." erreurs contenues";
			setFlash("Désolé !","Veuillez corriger ".$e." dans le formulaire.","danger");	
		}else{
			if(isset($_GET["condition"]) && $_GET["condition"]){
				$updateCondition = $condition->updateCondition($_POST,$_GET["condition"]);
				if($updateCondition["result"]){
					setFlash("Félicitations.",$updateCondition["response"]);
				}else{
					setFlash("Désolé !",$updateCondition["response"],"danger");				
				}
			}else{
				$createCondition = $condition->createCondition($_POST);
				if($createCondition["result"]){
					setFlash("Félicitations.",$createCondition["response"]);
				}else{
					setFlash("Désolé !",$createCondition["response"],"danger");				
				}
			}
			unset($_POST);
			header("location:?route=conditions");
			die();
		}
	} elseif (isset($_GET["condition"]) && $_GET["condition"]){
		$readCondition = $condition->readCondition($_GET["condition"]);
		if($readCondition["result"]){
			$_POST=$readCondition["response"];
		} else {
			setFlash("Désolé !",$readCondition["response"],"danger");
			header("location:?route=conditions");
			die();
		}
	}

	$Conditions = $condition->getConditions();
	
	$Title = $Description = "Conditions de location";
	
	require_once('../views/header.php');
	require_once('navbarBack1.php')
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-list-stars"></i>
				Gestion des conditions
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container-fluid">
			<div class="row py-4">
				<form action="#" method="POST" class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="titreTerme" class="form-label">Titre</label>
								<input type="text" name="titreTerme"
									class="form-control" id="titreTerme"
									value="<?=$_POST['titreTerme']??"";?>">
								<div class="form-error">
									<?= $error['titreTerme'] ?? ''; ?></div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
							<div class="form-group">
								<label for="indexTerme" class="form-label">Index</label>
								<input type="text" name="indexTerme"
									class="form-control text-center" maxlength="2"
									onkeypress="return VerifCasse(event,'number')"
									id="indexTerme"
									value="<?=$_POST['indexTerme']??"";?>">
								<div class="form-error">
									<?= $error['indexTerme'] ?? ''; ?></div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
							<div class="form-group">
								<label for="webTerme" class="form-label">Visible sur le
									Web</label>
								<div class="text-center">
									<input type="checkbox" name="webTerme"
										class="form-checkbox" id="webTerme"
										<?= isset($_POST["webTerme"]) && (int)$_POST["webTerme"]==1 ?'checked':NULL;?>
										value="1">
								</div>
								<div class="form-error"><?= $error['webTerme'] ?? ''; ?>
								</div>
							</div>
						</div>

					</div>

					<div class="form-group">
						<label for="contenuTerme" class="form-label">Contenu</label>
						<textarea name="contenuTerme" id="contenuTerme" rows="15"
							class="form-control"><?=$_POST['contenuTerme']??"";?></textarea>
						<div class="form-error"><?= $error['contenuTerme'] ?? ''; ?></div>
					</div>
					<div class="text-end">
						<a href="?route=conditions" onclick="Processing()"
							class="mybtn-light">Annuler</a>
						<button type="submit" onclick="Processing()" class="mybtn"
							name="subFormCondition"><?= isset($_GET["condition"]) && $_GET["condition"]?'Modifier':'Ajouter'; ?></button>
					</div>

				</form>

				<div class="col-sm-12 col-md-6 col-lg-5 col-xl-5">
					<h5>
						Liste des conditions
						<span class="badge bg-dark mx-3"><?=count($Conditions);?></span>
					</h5>
					<div class="table-responsive">
						<form action="#" method="POST">
							<table
								class="table table-borered table-stripped table-condensed">
								<thead>
									<tr>
										<th class="w-100">Titre</th>
										<th>Index</th>
									</tr>
								</thead>
								<tbody>
									<?php if($Conditions):?>
									<?php foreach ($Conditions as $condition):?>
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
															href="?route=conditions&condition=<?= $condition['idTerme']?>">
															<i
																class="bi bi-pencil-fill sub-bi"></i>
															Modifier</a>
													</li>
													<li>
														<a class="dropdown-item"
															onclick="Processing()"
															href="?route=conditions&show=<?= $condition['idTerme']?>">
															<i
																class="bi bi-eye-<?= is_null($condition['webTerme']) ? 'slash-' : '' ;?>fill sub-bi"></i>
															Rendre
															<?= is_null($condition['webTerme']) ? 'visible' : 'invisible' ;?></a>
													</li>
													<li>
														<a class="dropdown-item"
															href="#"
															onclick="sweetAlert('Vous confirmez ?',
																							'La suppression de cette condition sera définitive !',
																							'?route=conditions&delete=<?= $condition['idTerme']; ?>&<?= csrf(); ?>',
																							'warning')">
															<i
																class="bi bi-trash-fill sub-bi"></i>
															Supprimer</a>
													</li>
												</ul>
											</div>
											<i
												class="bi bi-eye-<?= is_null($condition['webTerme']) ? 'slash-fill sub-bi' : 'fill col-iadn' ;?> bi-lg"></i>

											<?= $condition['titreTerme']?>
										</td>
										<td class="text-center">
											<input type="text"
												name="Indexations[<?= $condition['idTerme']?>]"
												class="form-control text-center"
												maxlength="2"
												onkeypress="return VerifCasse(event,'number')"
												id="indexTerme_<?= $condition['idTerme']?>"
												value="<?= $condition['indexTerme'];?>">
										</td>
									</tr>

									<?php endforeach; ?>
									<?php else: ?>
									<tr>
										<td colspan="2"
											class="text-center py-4">
											Aucune condition enregistrée
										</td>
									</tr>
									<?php endif; ?>

								</tbody>
							</table>
							<div class="text-end">
								<button type="submit" class="mybtn"
									name="subFormReindexer">Réindexer</button>
							</div>
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