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
					colonne de gauche

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
									<th class="w-100p">Infos</th>
									<th class="w-100p">Secteur</th>
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
													<a class="dropdown-item"
														onclick="Processing()"
														href="?route=articles&article=<?= $article['idArticle']?>">
														<i
															class="bi bi-pencil-fill sub-bi"></i>
														Modifier</a>
												</li>
												<li>
													<a class="dropdown-item"
														onclick="Processing()"
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
			</div>
		</div>
	</section>

</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>