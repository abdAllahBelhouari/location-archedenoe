<?php


	
	$Title = "Le Blog";
	$Description = "Bienvenue sur le blog de l'Arche de Noé, votre destination en ligne pour tout ce qui concerne la location de matériel de loisirs, sportif, éducatif et d'animation à Dugny. De l'équipement pour des activités en plein air à des outils éducatifs innovants, notre blog est votre guide ultime pour tirer le meilleur parti de chaque location";
	
	require_once '../views/header.php';
	require_once 'navbarFront.php';
?>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Blog</h2>
				<ol>
					<li><a href="?route=">Accueil</a></li>
					<li>Blog</li>
				</ol>
			</div>
		</div>
	</section>

	<section class="container pt-4 pb-5">
		<div class="row justify-content-center py-5">
			<div data-aos="fade-up" data-aos-delay="100">
				<h1 class="col-iadn">Qui sommes nous ?</h1>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, cum iure est
					sint
					rerum aliquam
					eligendi
					beatae officia earum fugit in dolorem? Porro excepturi tempora hic corporis, ea
					aspernatur minima.
				</p>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, cum iure est
					sint
					rerum aliquam
					eligendi
					beatae officia earum fugit in dolorem? Porro excepturi tempora hic corporis, ea
					aspernatur minima.
				</p>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, cum iure est
					sint
					rerum aliquam
					eligendi
					beatae officia earum fugit in dolorem? Porro excepturi tempora hic corporis, ea
					aspernatur minima.
				</p>
			</div>

			<div data-aos="fade-up" data-aos-delay="200">
				<h2 class="col-iadn">Découvrez l'Aventure avec L'Arche de Noé </h2>
				<h3 class="col-iadn">Pourquoi Choisir L'Arche de Noé ?</h3>

				<p>
					Chez L'Arche de Noé, nous nous engageons à fournir à nos clients une expérience
					exceptionnelle à chaque fois.
				</p>

				Voici quelques raisons pour lesquelles vous devriez choisir notre
				association pour votre prochaine aventure à Dugny :

				<ul>
					<li>
						Large Sélection de Matériel : Que vous soyez intéressé par le kayak, le
						VTT, les
						jeux éducatifs ou les équipements d'animation, nous avons une vaste
						gamme de
						matériel de haute qualité à votre disposition.
					</li>

					<li>
						<b>Tarifs Abordables </b> Nous croyons que tout le monde devrait avoir
						accès à
						des activités de loisirs de qualité à des prix abordables. Nos tarifs
						compétitifs vous permettent de profiter pleinement de votre temps à
						Dugny sans
						vous ruiner.
					</li>
					<li>
						Service Client Exceptionnel : Notre équipe dévouée est là pour vous
						aider à chaque étape de votre expérience avec nous. Que vous ayez besoin
						de recommandations sur les activités à faire à Dugny ou d'aide pour
						choisir le bon équipement, nous sommes là pour vous.
					</li>
					<li>
						Respect de l'Environnement : Nous nous engageons à préserver la beauté
						naturelle
						de Dugny et de ses environs. En choisissant L'Arche de Noé, vous
						soutenez une
						entreprise qui valorise la durabilité et la protection de
						l'environnement.
					</li>
				</ul>
			</div>

			<div data-aos="fade-up" data-aos-delay="300">
				<h3 class="col-iadn">Nos Services</h3>

				<h4 class="col-iadn">Location de Matériel de Loisirs : </h4>
				<p>
					<li>
						Explorez les magnifiques paysages de Dugny avec notre équipement de
						plein air, y compris des kayaks, des tentes, des vélos et bien plus
						encore.
					</li>
				</p>

				<h4 class="col-iadn">Matériel Sportif :</h4>
				<p>
					<li>
						Des amateurs de VTT aux passionnés de football, nous avons tout ce dont
						vous
						avez besoin pour profiter de vos activités sportives préférées à Dugny.
					</li>
				</p>

				<h4 class="col-iadn">Équipement Éducatif :</h4>
				<p>
					<li>
						Stimulez l'apprentissage et l'éducation de vos enfants avec notre
						sélection de
						jeux et de matériel éducatif adapté à tous les âges.
					</li>
				</p>

				<h4 class="col-iadn">Animation :</h4>
				<p>
					<li>
						Organisez des événements inoubliables pour votre communauté avec notre
						équipement d'animation, y compris des structures gonflables, des jeux de
						société
						géants et plus encore.
					</li>
				</p>
			</div>

			<div data-aos="fade-up" data-aos-delay="400">
				<?php require_once 'faq.php'; ?>
			</div>
		</div>
	</section>
</main>
<?php
	require_once '../views/scripts.php';
	require_once 'footer.php';
?>