<?php


	
	$Title = $Description = "Accueil";

	require_once('../views/header.php');
	require_once('navbarBack1.php');
	
?>
<main id="main">
	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>
					<i class="bi bi-house-fill"></i>
					Menu Principal
				</h2>
			</div>
		</div>
	</section><!-- End Breadcrumbs Section -->
	<?=flash();?>
	<section>
		<div class="container-fluid">
			<div class="row justify-content-center py-4">
				<div class="col-sm-12 col-md-10 col-lg-6 col-xl-7">
					<div class="group-form mb-3" style="width:300px;">
						<input type="week" class="form-control">
					</div>
					<table class="table table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th></th>
								<th>Lundi</th>
								<th>Mardi</th>
								<th>Mercredi</th>
								<th>Jeudi</th>
								<th>Vendredi</th>
								<th>Samedi</th>
								<th>Dimanche</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i=0; $i <= 23; $i++): ?>
							<tr>
								<td><?= str_pad($i, 2, '0', STR_PAD_LEFT); ?> h</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12 col-md-10 col-lg-6 col-xl-5">
					<li class="subtitle">Réservations en cours</li>
					<table class="table table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>Date</th>
								<th>Client</th>
								<th>Réservations</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Piscine à balles</td>
								<td>
									<div class="dropdown pull-end">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-check-circle-fill sub-bi"></i>
													Valider</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Machine de barbe à papa</td>
								<td>
									<div class="dropdown">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-check-circle-fill sub-bi"></i>
													Valider</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Piscine à balle</td>
								<td>
									<div class="dropdown">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-check-circle-fill sub-bi"></i>
													Valider</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<li class="subtitle">Locations en cours</li>
					<table class="table table-striped table-condensed">
						<thead>
							<th>Date</th>
							<th>Client</th>
							<th>Réservations</th>
							<th></th>
						</thead>
						<tbody>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Piscine à balles</td>
								<td>
									<div class="dropdown">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Machine de barbe à papa</td>
								<td>
									<div class="dropdown">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>12/12/2023</td>
								<td>Abouayoub Khalid</td>
								<td>Piscine à balle</td>
								<td>
									<div class="dropdown">
										<i class="bi bi-three-dots-vertical action"
											id="dropdownMenuBtn"
											data-bs-toggle="dropdown"
											aria-expanded="false"></i>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuBtn">
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-pencil-fill sub-bi"></i>
													Modifier</a>
											</li>
											<li><a class="dropdown-item"
													href="#">
													<i
														class="bi bi-trash-fill sub-bi"></i>
													Supprimer</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
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