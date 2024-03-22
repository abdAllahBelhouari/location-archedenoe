<?php

	class Parametre {

		public function checkParams ( $data, $file ) {
			$error = [];
			if ( empty($data['iadnLibelle']) ) {
				$error['iadnLibelle'] = "Saisir le libelle";
			} else {
				$data['iadnLibelle'] = mb_convert_case($data['iadnLibelle'], MB_CASE_TITLE, "UTF-8");
			}
			if ( empty($data['iadnAdresse']) ) {
				$error['iadnAdresse'] = "Saisir l'adresse";
			} else {
				$data['iadnAdresse'] = mb_convert_case($data['iadnAdresse'], MB_CASE_TITLE, "UTF-8");
			}
			if ( empty($data['iadnCp']) ) {
				$error['iadnCp'] = "Saisir le code";
			} elseif ( !is_numeric($data['iadnCp']) || strlen($data['iadnCp']) != 5 ) {
				$error['iadnCp'] = "Code à 5 chiffres";
			}
			if ( empty($data['iadnVille']) ) {
				$error['iadnVille'] = "Saisir la ville";
			} else {
				$data['iadnVille'] = mb_convert_case($data['iadnVille'], MB_CASE_TITLE, "UTF-8");
			}
			if ( empty($data['iadnPhone']) ) {
				$error['iadnPhone'] = "Saisir le téléphone";
			} else {
				$data['iadnPhone'] = trim(wordwrap(preg_replace("/\s+/", "", $data['iadnPhone']), 2, " ", 1));
			}
			if ( empty($data['iadnEmail']) ) {
				$error['iadnEmail'] = "Saisir l'email";
			} elseif ( !preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i", $data['iadnEmail']) ) {
				$error['iadnEmail'] = "Format d'email invalide";
			} else {
				$data['iadnEmail'] = mb_convert_case($data['iadnEmail'], MB_CASE_LOWER, "UTF-8");
			}
			if ( empty($data['iadnHttp']) ) {
				$error['iadnHttp'] = "Saisir l'URL du site WEB";
			}
			if ( empty($data['iadnRepresentant']) ) {
				$error['iadnRepresentant'] = "Saisir le nom du representant";
			} else {
				$data['iadnRepresentant'] = mb_convert_case($data['iadnRepresentant'], MB_CASE_TITLE, "UTF-8");
			}
			if ( !empty($data['iadnBic']) ) {
				$data['iadnBic'] = mb_convert_case($data['iadnBic'], MB_CASE_UPPER, "UTF-8");
			}
			if ( !empty($data['iadnIban']) ) {
				$data['iadnIban'] = mb_convert_case($data['iadnIban'], MB_CASE_UPPER, "UTF-8");
				$data['iadnIban'] = trim(wordwrap(preg_replace("/\s+/", "", $data['iadnIban']), 4, " ", 1));
			}

			if ( !empty($file["iadnLogo"]["tmp_name"]) ) {
				$iadnLogo = $file["iadnLogo"];
				$extention = strtolower(pathinfo($iadnLogo["name"], PATHINFO_EXTENSION));
				if ( !in_array( $extention, array('jpg', 'png', 'gif', 'jpeg', 'webp') ) ) {
					$error["iadnLogo"] = "Le format du logo n'est pas valide.";
				} elseif ( $iadnLogo["size"] > 2000000 ) {
					$error["iadnLogo"] = "La taille du logo est trop grande ( 2 Mo max. )";
				}
			}

			return [
					'error' => $error,
					'data' => $data
				];
		}

		public function updateParams ( $data, $files ) {
			/*
			*	SUPPRESSION DE L'ANCIEN LOGO
			*/
				$Last_Infos = ( file_exists("libs/infos_iadn.prs")) ? parse_ini_file("libs/infos_iadn.prs", true) : false;
				if ( $Last_Infos ) {
					if ( !empty($Last_Infos['iadnLogo']) && file_exists('img/'.$Last_Infos['iadnLogo']) ) { 
						unlink('/assets/img/'.$Last_Infos['iadnLogo']); 
					}
				}
			/*
			*	TRAITEMENT DU LOGO
			*/
				$data["iadnLogo"] = "";
				if ( !empty($files["iadnLogo"]["tmp_name"]) ) {
					$extention = strtolower(pathinfo($files["iadnLogo"]["name"], PATHINFO_EXTENSION));
					$iadnLogo_name = "iadnLogo.".$extention;
					move_uploaded_file($files["iadnLogo"]["tmp_name"], "./assets/img/".$iadnLogo_name);
					$data["iadnLogo"] = $iadnLogo_name;
				}
			
			$file = "../libs/infos_iadn.prs";

			$row = "";
			foreach ( $data as $k => $v ) {
				$row .= $k." = '".str_replace("'", "’", $v)."'\n";
			}
			$fichier = fopen($file,"w+");
			$Result = fwrite( $fichier, $row ) ? true : false;
			fclose($fichier);
			if (  $Result ) {
				return [
					'result' => true,
					'response' => "Les informations ont été mis à jour avec succés."
				];
			} else {
				return [
					'result' => true,
					'response' => "Les informations n'ont pas été mis à jour."
				];
			}
		}

		/**
		 * 	SUPPRESSION DU LOGO
		 */
		public function deleteLogo() {
			global $IADN;
			/*
			*	Vérification de l'existance du logo sur le serveur
			*/
			if ( file_exists("assets/img/".$IADN["iadnLogo"]) ) {
				/*
				*	SUPPRESSION DU LOGO SUR LE SERVEUR
				*/
				if ( unlink("assets/img/".$IADN["iadnLogo"]) ) {
					/*
					*	RÉ-ÉCRITURE DU FICHIER 
					*/
					$file = "../libs/infos_iadn.prs";
					file_put_contents($file, str_replace("iadnLogo = 'iadnLogo.png'", ' ',  file_get_contents($file)));
					
					$_SESSION["iadnLogo"] = "assets/img/logo_default.png";
					return [
						'result' => true,
						'response' => "Le logo a été supprimé avec succès."
					];
				} else {
					return [
						'result' => false,
						'response' => "Une erreur est survenue lors de la suppression du logo."
					];
				}
			} else {
				return [
					'result' => false,
					'response' => "Aucun logo correspondant n'a été trouvé."
				];
			}
		}
	}
?>