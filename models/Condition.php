<?php
	class Condition {
		/**
		 * 	CONTRÔLE DES DONNÉES SAISIES
		 * 	
		 * @param array données saisie dans le formulaire
		 * @param array fichier image
		 * @return array erreurs | formulaire mis à jour
		 */
		public function checkData ( $data ) {
			$error=[];
			if ( empty($data["titreTerme"]) ) {
				$error['titreTerme']="Saisir le titre.";
			} else {
				$data["titreTerme"]=ucfirst(trim($data["titreTerme"]));
			}
			if ( empty($data["contenuTerme"]) ) {
				$error['contenuTerme']="Saisir le contenu.";
			} else {
				$data["contenuTerme"]=ucfirst(trim($data["contenuTerme"]));
			}
			if ( empty($data["indexTerme"]) ) {
				$error['indexTerme']="Saisir l'index.";
			} elseif ( !is_numeric($data["indexTerme"]) ) {
				$error['indexTerme']="Valeur en chiffre.";
			}
			return [
					"error"=>$error,
					"data"=>$data
				];
		}
		/**
		 * CRÉATION D'UNE CONDITION
		 *
		 * @param array données saisie dans le formulaire
		 * @return array  boolean | message
		 */
		public function createCondition( $data ) {
			global $db;
			$titreTerme=$db->quote($data["titreTerme"]);
			$contenuTerme=$db->quote($data["contenuTerme"]);
			$webTerme= isset($data["webTerme"]) ? $db->quote(1) : 'NULL';
			$indexTerme=$db->quote($data["indexTerme"]);

			$sql = $db->prepare("INSERT INTO terme SET
									titreTerme = $titreTerme,
									contenuTerme = $contenuTerme,
									webTerme = $webTerme,
									indexTerme = $indexTerme
								");
			if ( $sql->execute() ) {
				return [
						"result" => true,
						"response" => "La condition ".$data['titreTerme']." a été enregistrée avec succès."
					];
			} else {
				return [
						"result" => false,
						"response" => "La condition ".$data['titreTerme']." n'a pas été enregistrée."
					];
			}                    
		}
		/**
		 * RÉDUPÉRATION D'UNE CONDITION
		 *
		 * @param int identifiant
		 * @return array  boolean | message
		 */
		public function readCondition( $id ) {
			global $db;
			$idTerme=$db->quote($id);
			$sql = $db->query("SELECT * FROM terme WHERE idTerme = $idTerme")->fetch();
			if ( $sql ) {
				return [
						"result" => true,
						"response" => $sql
					];
			} else {
				return [
						"result" => false,
						"response" => "Aucune condition correspondante n'a été trouvée."
					];
			}
		}
		/**
		 * MIS À JOUR D'UNE CONDITION
		 *
		 * @param int identifiant
		 * @param array données saisie dans le formulaire
		 * @return array  boolean | message
		 */
		public function updateCondition( $id, $data ) {
			global $db;
			$idTerme=$db->quote($id);
			$titreTerme=$db->quote($data["titreTerme"]);
			$contenuTerme=$db->quote($data["contenuTerme"]);
			$webTerme= isset($data["webTerme"]) ? $db->quote(1) : 'NULL';
			$indexTerme=$db->quote($data["indexTerme"]);

			$sql = $db->prepare("UPDATE terme SET
									titreTerme = $titreTerme,
									contenuTerme = $contenuTerme,
									webTerme = $webTerme,
									indexTerme = $indexTerme
									WHERE idTerme = $idTerme
								");
			if ( $sql->execute() ) {
				return [
						"result" => true,
						"response" => "La condition ".$data['titreTerme']." a été mise à jour avec succès."
					];
			} else {
				return [
						"result" => false,
						"response" => "La condition ".$data['titreTerme']." n'a pas été mise à jour."
					];
			}                    
		}
		/**
		 * SUPPRESSION D'UNE CONDITION
		 *
		 * @param int identifiant
		 * @return array  boolean | message
		 */
		public function deleteCondition( $id ) {
			global $db;
			$idTerme=$db->quote($id);
			$sql = $db->prepare("DELETE FROM terme WHERE idTerme = $idTerme");
			if ( $sql->execute() ) {
				return [
						"result" => true,
						"response" => "La condition a été supprimée avec succès."
					];
			} else {
				return [
						"result" => false,
						"response" => "La condition n'a pas été supprimée."
					];
			}
		}
		/**
		 * RÉCUPÉRER LA LISTE DES CONDITIONS
		 *
		 * @return array
		 */
		public function getConditions() {
			global $db;
			return $db->query("SELECT * FROM terme ORDER BY indexTerme,titreTerme")->fetchAll();
		}
		/**
		 * VISIBILITÉ D'UNE CONDITION
		 *
		 * @param array condition
		 * @return array  boolean | message
		 */
		public function showWeb ( $data ) {
			global $db;
			$idTerme = $db->quote($data['idTerme']);

			if ( is_null($data["webTerme"]) ) {
				$webTerme=$db->quote(1);
				$txt="visible";
			} else {
				$webTerme = 'NULL';
				$txt = "invisible";
			}
			$sql = $db->prepare("UPDATE terme SET webTerme=$webTerme WHERE idTerme=$idTerme");
			if ( $sql->execute() ) {
				return [
						"result" => true,
						"response" => "La condition ".$data['titreTerme']." est ".$txt." sur le web."
					];
			} else {
				return [
					"result" => false,
					"response" => "La condition ".$data['titreTerme']." n'est pas ".$txt." sur le web."
				];
			} 
		}
		/**
		 * RÉCUPÉRER LA LISTE DES CONDITIONS A AFFICHER SUR LE WEB
		 *
		 * @return array
		 */
		public function getConditionsWeb(){
			global $db;
			return $db->query("SELECT * FROM terme
									WHERE webTerme = 1 
									ORDER BY indexTerme
								")->fetchAll();
		}
		/**
		 * RÉINDEXATION DE LA LISTE DES CONDITIONS
		 *
		 * @param array liste des conditions
		 * @return array liste indexée
		 */
		public function reindexation ( $data ) {
			global $db;
			$maj=0;
			foreach ($data as $id => $value) {
				$idTerme=$db->quote($id);
				$indexTerme=$db->quote($value);
				$sql=$db->prepare("UPDATE terme SET indexTerme=$indexTerme WHERE idTerme=$idTerme");
				if ( $sql->execute() ) {
					$maj++;
				}
			}
			if ( $maj==0 ) {
				return [
					"result" => false,
					"response" => "Les conditions n'ont pas été réindéxées."
				];
			} else {
				return [
					"result" => true,
					"response" => "Les conditions ont été réindéxées avec succès."
				];
			}
		}
	}
?>