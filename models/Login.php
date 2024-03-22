<?php
class Login {
    
	public function checkData($data) {
		$error=[];
		if ( empty($data["emailMembre"]) ) {
			$error['emailMembre']="Saisir votre email";
		}
		if ( empty($data["passwordMembre"]) ) {
			$error['passwordMembre']="Saisir votre mot de passe";
		}
		return $error;
	}

	public function connexion ($data){
		global $db;
		$emailMembre=$db->quote($data['emailMembre']);
		$Membre=$db->query("SELECT * FROM membre WHERE emailMembre=$emailMembre")->fetch();
		if ( $Membre ) {
			if ( password_verify($data['passwordMembre'], $Membre['passwordMembre']) ) {
				$_SESSION['Auth']=$Membre;
				$_SESSION['Auth']['username'] = ((int)$_SESSION['Auth']['genreMembre']==1?'Mme ':'Mr ').$_SESSION['Auth']['nomMembre']." ".$_SESSION['Auth']['prenomMembre'];
				$_SESSION['Auth']['level'] = substr($_SESSION['Auth']['levelsMembre'],0,1);
				$_SESSION['Key']="2f6587e7c62d6d73280296d0f3559a93";
				return [
					'result'=>true,
					'response'=>$_SESSION['Auth']['username']." vous êtes maintenant connecté".((int)$_SESSION['Auth']['genreMembre']== 1 ?'e' : '')
				];
			} else {
				return [
					'result'=>false,
					'response'=>"Votre mot de passe incorrect."
				];
			}
		} else {
			return [
				'result'=>false,
				'response'=>"Aucun membre correspondant n'a été trouvé."
			];
		}
	}
	
	public function generatePassword ( $email ) {
		global $db;
		/**
		 * 	RECHERCHE DU MEMBRE
		 */
		$emailMembre = $db->quote($email);
		$Membre = $db->query("SELECT idMembre, genreMembre, nomMembre, prenomMembre 
									FROM membre 
									WHERE emailMembre = $emailMembre
								")->fetch();
		if ( $Membre ) {
			/**
			 * 	GÉNÉRATION DU MOT DE PASSE
			 */
			$characters = array(1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
			$pass = "";
			for ( $i=0 ; $i<8 ; $i++ ) {
				$pass .= $characters[array_rand($characters)];
			}
			/**
			 * 	MISE À JOUR DU MOT DE PASSE + PROVISOIRE
			 */
			$passwordMembre = $db->quote(password_hash($pass, PASSWORD_DEFAULT));
			$provisoireMembre = $db->quote($pass);
			$idMembre = $db->quote($Membre['idMembre']);

			$sql = $db->prepare("UPDATE membre SET 
									provisoireMembre = $provisoireMembre, 
									passwordMembre = $passwordMembre 
									WHERE idMembre = $idMembre
								");
			if ( $sql->execute() ) {
				$nameMembre = ((int)$Membre['genreMembre'] == 1 ? 'Mme ' : 'Mr ').$Membre['nomMembre']." ".$Membre['prenomMembre'];
				/**
				 * 	ENVOI PAR EMAIL
				 */
				$initpass = "Votre mot de passe a été intialisé avec succès.";

				$message = "Félicitations ".$nameMembre.",";
				$message .= "<p>Votre mot de passe a été intialisé avec succès.</p>";
				$message .= "Veuillez trouvez ci-joints vos identifiants de connexion :";
				$message .= "<li><b><small>Votre identifiant : </b></small>".$email."</li>";
				$message .= "<li><b><small>Votre mot de passe provisoire : </b></small>".$pass."</li>";
				$message .= "<p>Votre mot de passe étant provisoire, il vous faudra le mettre à jour lors de votre prochaine connexion.</p>";
				$message .= $_SESSION["Footer_Email"];

				$sendMailing = sendMailing ( "Initialisation du mot de passe", $message, $email);
				$initpass .= "<li>".($sendMailing ? "L'email de confirmation a été envoyé à cette adresse <span>".$email."</span>." : "Cependant, l'email de confirmation n'a pas été envoyé.")."</li>";
				
				return [
					'result' => true,
					'response' => $initpass
				];
			} else {
				return [
					'result' => false,
					'response' => "Votre mot de passe n'a pas été intialisé."
				];
			}			
		} else {
			return [
				'result' => false,
				'response' => "Aucun compte corrrepondant n'a été trouvé."
			];
		}
	}
}


?>