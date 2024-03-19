<?php
	class Client {
	
		public function checkData($data) {
			$error=[];
			global $db;
			if ( empty($data["genreMembre"]) ) {
				$error['genreMembre']="Définir la civilité";
			}
			if ( empty($data["nomMembre"]) ) {
				$error['nomMembre']="Saisir votre nom";
			} else {
				$data['nomMembre'] = trim(mb_convert_case($data['nomMembre'], MB_CASE_TITLE, "UTF-8"));
			}
			if ( empty($data["prenomMembre"]) ) {
				$error['prenomMembre']="Saisir votre prénom";
			} else {
				$data['prenomMembre'] = trim(mb_convert_case($data['prenomMembre'], MB_CASE_TITLE, "UTF-8"));
			}
			if ( empty($data["typeMembre"]) ) {
				$error['typeMembre']="Définir le type de membre";
			} else {
				if ( (int)$data["typeMembre"] > 1 && empty($data["entiteMembre"]) ) {
					$error['entiteMembre']="Saisir l'intitulé";
				}
			}
			if ( empty($data["adresseMembre"]) ) {
				$error['adresseMembre']="Saisir votre adresse";
			} else {
				$data['adresseMembre'] = ucfirst(trim(mb_convert_case($data['adresseMembre'], MB_CASE_LOWER, "UTF-8")));
			}
			if ( empty($data["cpMembre"]) ) {
				$error['cpMembre']="Saisir votre code postal";
			} elseif ( !is_numeric($data["cpMembre"]) ) {
				$error['cpMembre']="Code en chiffres";
			} elseif ( strlen($data["cpMembre"]) != 5 ) {
				$error['cpMembre']="Code à 5 chiffres";
			}
			if ( empty($data["villeMembre"]) ) {
				$error['villeMembre']="Saisir votre ville";
			} else {
				$data['villeMembre'] = trim(mb_convert_case($data['villeMembre'], MB_CASE_TITLE, "UTF-8"));
			}
			if ( !empty($data["mobileMembre"]) && ( !is_numeric($data["mobileMembre"]) || strlen($data["mobileMembre"]) != 10 ) ) {
				$error['mobileMembre']="N° à 10 chiffres";
			}
			if ( empty($data["emailMembre"]) ) {
				$error['emailMembre']="Saisir votre email";
			} else {
				$data['emailMembre'] = trim(mb_convert_case($data['emailMembre'], MB_CASE_LOWER, "UTF-8"));
				$emailMembre = $db->quote($data['emailMembre']);
				$sql = $db->query("SELECT idMembre FROM membre WHERE emailMembre = $emailMembre")->fetch();
				if ( $sql ) {
					$error['emailMembre']="Cette email est déjà utilisée";
				} 
			}
			$data['confirmation'] = trim(mb_convert_case($data['confirmation'], MB_CASE_LOWER, "UTF-8"));
			if ( empty($data["confirmation"]) ) {
				$error['confirmation']="Confirmer votre email";
			} elseif ( $data["confirmation"] != $data['emailMembre'] ) {
				$error['confirmation']="Il y a une erreur de saisie";
			} 
			if ( empty($data["passwordMembre"]) ) {
				$error['passwordMembre']="Saisir votre mot de passe";
			} 
			return [
					'error' => $error,
					'data' => $data
				];
		} 
		
		public function createMembre($data) {
			global $db;
			$genreMembre = $db->quote($data['genreMembre']);
			$nomMembre = $db->quote($data['nomMembre']);
			$prenomMembre = $db->quote($data['prenomMembre']);
			$typeMembre = $db->quote($data['typeMembre']);
			$entiteMembre = empty($data['entiteMembre']) ? 'NULL' : $db->quote(ucwords(trim($data['entiteMembre'])));
			$adresseMembre = $db->quote($data['adresseMembre']);
			$cpMembre = $db->quote($data['cpMembre']);
			$villeMembre = $db->quote($data['villeMembre']);
			$emailMembre = $db->quote($data['emailMembre']);
			$mobileMembre = empty($data["mobileMembre"]) ? 'NULL' : $db->quote(trim(wordwrap(preg_replace("/\s+/", "", $data["mobileMembre"]), 2, " ", 1)));
			$passwordMembre = $db->quote(password_hash($data['passwordMembre'], PASSWORD_DEFAULT));
			$horodatageMembre = $db->quote(dateNow());

			$sql = $db->prepare("INSERT INTO membre SET
									genreMembre = $genreMembre,
									nomMembre = $nomMembre,
									prenomMembre = $prenomMembre,
									typeMembre = $typeMembre,
									entiteMembre = $entiteMembre,
									adresseMembre = $adresseMembre,
									cpMembre = $cpMembre,
									villeMembre = $villeMembre,
									emailMembre = $emailMembre,
									mobileMembre = $mobileMembre,
									levelsMembre = '3',
									passwordMembre = $passwordMembre,
									horodatageMembre = $horodatageMembre
								");
			if ( $sql->execute() ) {
				return [
					"result" => true,
					"response" => "Votre compte a pas été enregistré avec succès. Veuillez vous connecter avec vos identifiants."
				];
			} else {
				return [
					"result" => false,
					"response" => "Votre compte n'a pas été enregistré."
				];
			}
		}
	}
?>