<?php
	$statuts=["","Administrateur","Agent","Client"];
	$TypeMembre = ['', 'Particulier', 'Association', 'Établissement Scolaire',  'Professionnel', 'Autre'];
	$Paiement = ["", "Carte Bancaire", "Chèque", "Espèces", "Virement", "Exonération"];

	function setFlash($titre,$message,$statut='success'){
		$_SESSION['flash']['titre']=$titre;
		$_SESSION['flash']['message']=$message;
		$_SESSION['flash']['statut']=$statut;
	}

	function flash(){
		if (isset($_SESSION['flash'])){
			extract($_SESSION['flash']);
			unset($_SESSION['flash']);
			return "<div data-aos='fade-right' class='alert alert-".$statut." flash'onclick='this.style.display=`none`'>
			<h4>".$titre."</h4>
			".$message."
			</div>";
		}
	}
	
	if (!isset($_SESSION['csrf'])){
		$_SESSION['csrf']=md5(time()+rand());
	}
	function csrf(){		
		return 'csrf='.$_SESSION['csrf'];
	}

	function checkCsrf(){
		if(!isset($_GET['csrf'])||$_GET['csrf']!=$_SESSION['csrf']){
			session_destroy();
			die("Erreur de jeton CSRF");
		}
	}

	function dateNow() {
		$objTimeZone = new DateTimeZone("Europe/Madrid");
		$objDateTime = new DateTime();
		$objDateTime->setTimezone($objTimeZone);

		if (!empty($strDateTime)) {
			$fltUnixTime = (is_string($strDateTime)) ? strtotime($strDateTime) : $strDateTime;
			if (method_exists($objDateTime, "setTimestamp")) {
				$objDateTime->setTimestamp($fltUnixTime);
			} else {
				$arrDate = getdate($fltUnixTime);
				$objDateTime->setDate($arrDate["year"], $arrDate["mon"], $arrDate["mday"]);
				$objDateTime->setTime($arrDate["hours"], $arrDate["minutes"], $arrDate["seconds"]);
			}
		}
		return $objDateTime->format("Y-m-d H:i:s");
	}


?>