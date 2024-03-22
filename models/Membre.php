<?php
	class Membre {
		/**
		 * 	CONTRÔLE D'ACCÈS AUX PAGES ET DU MOT DE PASSE PROVISOIRE
		 * 	
		 * @param int niveau d'accès
		 */
		public static function controlAccess( $level ) {
			if ( is_null($_SESSION['Auth']['provisoireMembre']) ) {
				if ( !in_array($_SESSION['Auth']['level'],$level) ) {
					header("location:?route=noaccess");
				}
			} else {
				if ( $_GET['route'] != 'updateMdp' ) {
					setFlash("Mise à jour requise !","Vous utilisez actuellement un mot de passe provisoire.<br>Utiliser le formulaire pour changer ce mot de passe.",'warning');
					header("location:?route=profil");
					die();
				}
			}
		}
		/**
		 * 	CONTRÔLE DES DONNÉES SAISIES
		 * 	
		 * @param array données du formulaire
		 * @param int niveau d'accès
		 * @param int identifiant
		 * @return array erreurs | formulaire mis à jour
		 */
		public function checkData( $data, $level, $id = false ) {
			$error=[];
			global $db;
			global $TypeMembre;
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
			if ( $level == 3 ) {
				if ( empty($data["typeMembre"]) ) {
					$error['typeMembre']="Définir le type de membre";
				} else {
					if ( (int)$data["typeMembre"] > 1 && empty($data["entiteMembre"]) ) {
						$txt = $TypeMembre[$data["typeMembre"]];
						switch ((int)$data["typeMembre"]) {
							case 4:
								$txt = "société";
								break;
							case 5:
								$txt = "structure";
								break;
						}
						$error['entiteMembre']="Saisir l'intitulé de votre  ".$txt;
					}
				}
				if ( !$id ) {
					$data['confirmation'] = trim(mb_convert_case($data['confirmation'], MB_CASE_LOWER, "UTF-8"));
					if ( empty($data["confirmation"]) ) {
						$error['confirmation']="Confirmer votre email";
					} elseif ( $data["confirmation"] != $data['emailMembre'] ) {
						$error['confirmation']="Il y a une erreur de saisie";
					} 
					if ( empty($data["passwordMembre"]) ) {
						$error['passwordMembre']="Saisir votre mot de passe";
					} 
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
				if ( $id ) {
					$idMembre = $db->quote($id);
					$sql = $db->query("SELECT idMembre FROM membre 
											WHERE emailMembre = $emailMembre 
											AND idMembre != $idMembre
										")->fetch();
				} else {
					$sql = $db->query("SELECT idMembre FROM membre WHERE emailMembre = $emailMembre")->fetch();
				}
				if ( $sql ) {
					$error['emailMembre']="Cet email est déjà utilisé";
				} 
			}
			return [
					'error' => $error,
					'data' => $data
				];
		} 
		/**
		 * 	CRÉATION D'UNE FICHE MEMBRE
		 * 	
		 * @param array données du formulaire
		 * @param int niveau d'accès
		 * @return array  boolean | message
		 */
		public function createMembre ( $data, $level ) {
			global $db;
			$genreMembre = $db->quote($data['genreMembre']);
			$nomMembre = $db->quote($data['nomMembre']);
			$prenomMembre = $db->quote($data['prenomMembre']);
			$typeMembre = $db->quote($data['typeMembre']);
			$typeMembre = empty($data['typeMembre']) ? 'NULL' : $db->quote($data['typeMembre']);
			$entiteMembre = empty($data['typeMembre']) ? 'NULL' : $db->quote(ucwords(trim($data['entiteMembre'])));
			$adresseMembre = $db->quote($data['adresseMembre']);
			$cpMembre = $db->quote($data['cpMembre']);
			$villeMembre = $db->quote($data['villeMembre']);
			$emailMembre = $db->quote($data['emailMembre']);
			$mobileMembre = empty($data["mobileMembre"]) ? 'NULL' : $db->quote($data["mobileMembre"]);
			$passwordMembre = $db->quote(password_hash($data['passwordMembre'], PASSWORD_DEFAULT));
			$horodatageMembre = $db->quote(dateNow());
			$levelsMembre = $db->quote($level);

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
									levelsMembre = $levelsMembre,
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
		/**
		 * 	MISE À JOUR D'UNE FICHE MEMBRE
		 * 	
		 * @param array données du formulaire
		 * @param int identifiant
		 * @return array  boolean | message
		 */
		public function updateMembre ( $data, $id ) {
			global $db;
			$idMembre = $db->quote($id);
			$genreMembre = $db->quote($data['genreMembre']);
			$nomMembre = $db->quote($data['nomMembre']);
			$prenomMembre = $db->quote($data['prenomMembre']);
			$typeMembre = empty($data['typeMembre']) ? 'NULL' : $db->quote($data['typeMembre']);
			$entiteMembre = empty($data['entiteMembre']) ? 'NULL' : $db->quote(ucwords(trim($data['entiteMembre'])));
			$adresseMembre = $db->quote($data['adresseMembre']);
			$cpMembre = $db->quote($data['cpMembre']);
			$villeMembre = $db->quote($data['villeMembre']);
			$emailMembre = $db->quote($data['emailMembre']);
			$mobileMembre = empty($data["mobileMembre"]) ? 'NULL' : $db->quote($data["mobileMembre"]);

			$sql = $db->prepare("UPDATE membre SET
									genreMembre = $genreMembre,
									nomMembre = $nomMembre,
									prenomMembre = $prenomMembre,
									typeMembre = $typeMembre,
									entiteMembre = $entiteMembre,
									adresseMembre = $adresseMembre,
									cpMembre = $cpMembre,
									villeMembre = $villeMembre,
									emailMembre = $emailMembre,
									mobileMembre = $mobileMembre
									WHERE idMembre = $idMembre
								");
			if ( $sql->execute() ) {
				$_SESSION['Auth']['genreMembre'] = $data['genreMembre'];
				$_SESSION['Auth']['nomMembre'] = $data['nomMembre'];
				$_SESSION['Auth']['prenomMembre'] = $data['prenomMembre'];
				$_SESSION['Auth']['typeMembre'] = $data['typeMembre'];
				$_SESSION['Auth']['entiteMembre'] = empty($data['typeMembre']) ? NULL : $data['entiteMembre'];
				$_SESSION['Auth']['adresseMembre'] = $data['adresseMembre'];
				$_SESSION['Auth']['cpMembre'] = $data['cpMembre'];
				$_SESSION['Auth']['villeMembre'] = $data['villeMembre'];
				$_SESSION['Auth']['emailMembre'] = $data['emailMembre'];
				$_SESSION['Auth']['mobileMembre'] = $data['mobileMembre'];
				
				return [
					"result" => true,
					"response" => "Votre compte a pas été mis à jour avec succès."
				];
			} else {
				return [
					"result" => false,
					"response" => "Votre compte n'a pas été mis à jour."
				];
			}
		}
		/**
		 * 	CONTRÔLE DES DONNÉES SAISIES POUR LE NOUVEAU MOT DE PASSE
		 * 	
		 * @param array données du formulaire
		 * @return array  boolean | message
		 */
		public function checkPassword ( $data ) {
			$error = [];
			if ( empty($data['newPass']) ) {
				$error['newPass'] = "Saisir le mot de passe";
			}
			if ( empty($data['confirmation']) ) {
				$error['confirmation'] = "Saisir la confirmation";
			} elseif ($data['newPass'] != $data['confirmation'] ) {
				$error['confirmation'] = "La confirmation ne correspond pas";
			}
			return $error;
		}
		/**
		 * 	MISE À JOUR DU NOUVEAU MOT DE PASSE
		 * 	
		 * @param string mdp saisi
		 * @param string identifiant
		 * @return array  boolean | message
		 */
		public function updatePassword ( $pass, $id ) {
			global $db;
			$hash = password_hash($pass, PASSWORD_DEFAULT);
			$passwordMembre = $db->quote($hash);
			$idMembre = $db->quote($id);
			$sql = $db->prepare("UPDATE membre SET 
									provisoireMembre = NULL,
									passwordMembre = $passwordMembre 
									WHERE idMembre = $idMembre
								");
			if ( $sql->execute() ) {
				$_SESSION['Auth']['provisoireMembre'] = NULL;
				$_SESSION['Auth']['passwordMembre'] = $hash;
				return [
					'result' => true,
					'response' => "Votre mot de passe a été mis à jour avec succès."
				];
			} else {
				return [
					'result' => false,
					'response' => "Votre mot de passe n'a pas été mis à jour."
				];
			}
		}
	}
?>