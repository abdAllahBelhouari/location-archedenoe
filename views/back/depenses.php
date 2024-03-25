<?php
	Membre::controlAccess([1]);

	$depense = new Depense();
	$secteur = new Secteur();
	$Secteurs = $secteur->getSecteurs(); 
	// $Depenses = $depense->getDepenses();

	$Title = $Description = "Gestion des dépenses";
	require_once '../views/header.php';
	require_once 'navbarBack1.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<h2>
				<i class="bi bi-wallet2"></i>
				Gestion des dépenses
			</h2>
		</div>
	</section>

	<?=flash();?>

	<section id="page-wrapper">
		<div class="container-fluid">
			<div class="row py-4">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<form action="#" method="POST">

						<div class="form-group">
							<label for="dateDepense"
								class="form-label">Date</label>
							<input type="date"
								name="dateDepense"
								class="form-control"
								id="dateDepense"
								value="<?=$_POST['dateDepense']??"";?>">
							<div class="form-error">
								<?= $error['dateDepense'] ?? ''; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="montantDepense"
								class="form-label">Montant</label>
							<input type="text"
								name="montantDepense"
								class="form-control"
								id="montantDepense"
								maxlength="7"
								value="<?=$_POST['montantDepense']??"";?>">
							<div class="form-error">
								<?= $error['montantDepense'] ?? ''; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="modeDepense" class="form-label">Mode</label>
							<select name="modeDepense" id="modeDepense" class="form-control"
								onchange="checkModeDepense(this.options[selectedIndex].value);">
								<option value="" selected></option>
								<?php for ( $t=1 ; $t < count($Paiement) ; $t++ ) :?>
								<option <?= (isset($_POST["modeDepense"])  && $_POST["modeDepense"]==$t) ? "selected" : ""; ?>
									value="<?= $t; ?>">
									<?= $Paiement[$t]; ?>
								</option>
								<?php endfor; ?>
							</select>
							<div class="form-error">
								<?= $error['modeDepense'] ?? ''; ?></div>
							</div>
						</div>	

						<div class="form-group">
							<label for="idSecteur"
								class="form-label">Secteur</label>
							<select name="idSecteur" id="idSecteur"
								class="form-control">
								<option value="" selected></option>
								<?php foreach ($Secteurs as $secteur) :?>
								<option <?= (isset($_POST["idSecteur"])  && $_POST["idSecteur"]==$secteur["idSecteur"]) ? "selected" : ""; ?>
									value="<?= $secteur["idSecteur"]; ?>">
									<?= $secteur["libelleSecteur"]; ?>
								</option>
								<?php endforeach; ?>
							</select>
							<div class="form-error">
								<?= $error['idSecteur'] ?? ''; ?></div>
							</div>
						</div>

						<div class="form-group">
							<label for="infoDepense" class="form-label">Informations</label>
							<textarea name="infoDepense" id="infoDepense" rows="5"
								class="form-control"><?=$_POST['infoDepense']??"";?></textarea>
							<div class="form-error"><?= $error['infoDepense'] ?? ''; ?></div>
						</div>

						<div class="text-end">
							<a href="?route=depenses"
								onclick="Processing()"
								class="mybtn-light">Annuler</a>
							<button type="submit"
								onclick="Processing()"
								class="mybtn"
								name="subFormDepense"><?= isset($_GET["depense"]) && $_GET["depense"]?'Modifier':'Ajouter'; ?></button>
						</div>
					</form>
				</div>

				<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
					<h5>
						Liste des dépenses
						<!-- <span class="badge bg-dark mx-3"><?=count($Depenses);?></span> -->
					</h5>
					<div class="table-responsive">
						<table class="table table-borered table-stripped table-condensed">
							<thead>
								<tr>
									<th>Date</th>
									<th class="w-200p">Montant</th>
									<th class="w-100p">Mode</th>
									<th class="w-100p">Informations</th>
									<th class="w-100p">Secteur</th>
								</tr>
							</thead>
							<tbody>
								<?php if($Depenses):?>
								<?php foreach ($Depenses as $depense):?>
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
														href="?route=depenses&depense=<?= $depense['idDepense']?>">
														<i
															class="bi bi-pencil-fill sub-bi"></i>
														Modifier</a>
												</li>
												
												<li>
													<a class="dropdown-item"
														href="#"
														onclick="sweetAlert('Vous confirmez ?',
																					'La suppression de cette dépense sera définitive !',
																					'?route=depenses&delete=<?= $depense['idDepense']; ?>&<?= csrf(); ?>',
																					'warning')">
														<i
															class="bi bi-trash-fill sub-bi"></i>
														Supprimer</a>
												</li>
											</ul>
										</div>
										
										<?= $depense['dateDepense']; ?>
									</td>
									<td>
										<?= $depense['montantDepense']; ?>
									</td>
									<td class="text-end">
										<?= $depense['modeDepense']; ?>
									</td>
									<td class="text-end">
										<?= $depense['infoDepense']; ?>
									</td>
									<td class="text-end">
										<?= $depense['secteurDepense']; //Jointure??>
									</td>
								</tr>
								<?php endforeach; ?>
								<?php else: ?>
								<tr>
									<td colspan="5" class="text-center py-4">
										Aucune dépense enregistrée
									</td>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>