<hr>
<div class="myaccordion">
	<h2>Une question ?</h2>
	<dl>
		<dt>
			<a href="#myaccordion1" aria-expanded="false" aria-controls="myaccordion1"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">1. Comment puis-je
				contacter l’Arche de Noé ?</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion1" aria-hidden="true">
			<p>
				Rendez-vous sur notre site web pour plus d’informations ou contactez-nous par
				téléphone au XX XX XX XX XX.
			</p>
		</dd>
		<dt>
			<a href="#myaccordion2" aria-expanded="false" aria-controls="myaccordion2"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">
				2. Comment puis-je réserver du matériel avec L'Arche de Noé ?</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion2" aria-hidden="true">
			<p>
				Pour réserver du matériel avec nous, il vous suffit de consulter notre site web ou de
				nous contacter directement
				via le formulaire de réservation, par téléphone ou par e-mail. Notre équipe se fera un
				plaisir de vous aider à choisir
				le matériel parfait pour
				votre sortie ou votre évènement.
			</p>
		</dd>
		<dt>
			<a href="#myaccordion3" aria-expanded="false" aria-controls="myaccordion3"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">
				3. Y a-t-il des frais de réservation ?
			</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion3" aria-hidden="true">
			<p>
				Non, nous ne facturons pas de frais de réservation. Vous ne payez que le montant de la
				location du matériel que
				vous avez choisi.
			</p>
		</dd>
		<dt>
			<a href="#myaccordion4" aria-expanded="false" aria-controls="myaccordion4"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">
				4. Puis-je annuler ma réservation ?
			</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion4" aria-hidden="true">
			<p>
				Oui, vous pouvez annuler votre réservation, mais veuillez nous en informer dès que
				possible. Des frais
				d'annulation peuvent s'appliquer selon nos conditions générales.
			</p>
		</dd>
		<dt>
			<a href="#myaccordion5" aria-expanded="false" aria-controls="myaccordion5"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">
				5. Comment puis-je récupérer et retourner le matériel ?
			</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion5" aria-hidden="true">
			<p>
				Vous pouvez récupérer le matériel loué à notre emplacement à Dugny aux heures convenues
				lors de votre
				réservation. Pour le retour, veuillez vous assurer de ramener le matériel à l'heure
				convenue pour éviter des
				frais de retard.
			</p>
		</dd>
		<dt>
			<a href="#myaccordion6" aria-expanded="false" aria-controls="myaccordion6"
				class="myaccordion-title myaccordionTitle js-myaccordionTrigger">
				6. Le matériel est-il assuré ?
			</a>
		</dt>
		<dd class="myaccordion-content myaccordionItem is-collapsed" id="myaccordion6" aria-hidden="true">
			<p>
				Oui, tous nos équipements sont assurés. Cependant, veuillez noter que vous serez
				responsable de tout dommage ou
				perte pendant la durée de la location, selon nos conditions générales.
			</p>
		</dd>
	</dl>
</div>

<script>
(function() {
	var d = document,
		myaccordionToggles = d.querySelectorAll('.js-myaccordionTrigger'),
		setAria,
		setmyAccordionAria,
		switchmyAccordion,
		touchSupported = ('ontouchstart' in window),
		pointerSupported = ('pointerdown' in window);

	skipClickDelay = function(e) {
		e.preventDefault();
		e.target.click();
	}

	setAriaAttr = function(el, ariaType, newProperty) {
		el.setAttribute(ariaType, newProperty);
	};
	setmyAccordionAria = function(el1, el2, expanded) {
		switch (expanded) {
			case "true":
				setAriaAttr(el1, 'aria-expanded', 'true');
				setAriaAttr(el2, 'aria-hidden', 'false');
				break;
			case "false":
				setAriaAttr(el1, 'aria-expanded', 'false');
				setAriaAttr(el2, 'aria-hidden', 'true');
				break;
			default:
				break;
		}
	};
	//function
	switchmyAccordion = function(e) {
		console.log("triggered");
		e.preventDefault();
		var thisAnswer = e.target.parentNode.nextElementSibling;
		var thisQuestion = e.target;
		if (thisAnswer.classList.contains('is-collapsed')) {
			setmyAccordionAria(thisQuestion, thisAnswer, 'true');
		} else {
			setmyAccordionAria(thisQuestion, thisAnswer, 'false');
		}
		thisQuestion.classList.toggle('is-collapsed');
		thisQuestion.classList.toggle('is-expanded');
		thisAnswer.classList.toggle('is-collapsed');
		thisAnswer.classList.toggle('is-expanded');

		thisAnswer.classList.toggle('animateIn');
	};
	for (var i = 0, len = myaccordionToggles.length; i < len; i++) {
		if (touchSupported) {
			myaccordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
		}
		if (pointerSupported) {
			myaccordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
		}
		myaccordionToggles[i].addEventListener('click', switchmyAccordion, false);
	}
})();
</script>