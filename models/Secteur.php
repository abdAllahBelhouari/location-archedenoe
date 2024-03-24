<?php
class Secteur {
    /**
     * 	CONTRÔLE DES DONNÉES SAISIES
     * 	
     * @param array données saisie dans le formulaire
     * @return array erreurs | formulaire mis à jour
     */
    public function checkData ( $data ) {
        global $db;
        $error=[];
        if ( empty($data["libelleSecteur"]) ) {
            $error['libelleSecteur']="Saisir le secteur.";
        } else {
            $data["libelleSecteur"]=ucfirst(trim($data["libelleSecteur"]));
            $libelleSecteur =$db->quote($data["libelleSecteur"]);
            $exist = $db->query("SELECT * FROM secteur 
                        WHERE libelleSecteur = $libelleSecteur
                        ")->fetch();
            if ($exist) {
                $error['libelleSecteur']="Ce secteur existe déjà.";
            }
        }
        return [
                "error"=>$error,
                "data"=>$data
            ];
    }
    /**
     * CRÉATION D'UN SECTEUR
     *
     * @param string libellé
     * @return array boolean | message
     */
    public function createSecteur ( $libelle ) {
        global $db;
        $libelleSecteur = $db->quote($libelle);
        $sql=$db->prepare("INSERT INTO secteur SET 
                    libelleSecteur=$libelleSecteur,
                    activerSecteur='1'
                ");
        if ( $sql->execute() ) {
            return [
                "result" => true,
                "response" => "Le secteur ".$libelle." a été enregistré avec succès."
            ];
        } else {
            return [
                "result" => false,
                "response" => "Le secteur ".$libelle." n'a pas été enregistré."
            ];
        }
    }
    /**
     * RÉCUPÉRATION D'UN SECTEUR
     *
     * @param int identifiant
     * @return array secteur | message
     */
    public function readSecteur ( $id ) {
        global $db;
        $idSecteur = $db->quote($id);
        $sql = $db->query("SELECT * FROM secteur WHERE idSecteur = $idSecteur")->fetch();
        if ( $sql ) {
            return [
                "result" => true,
                "response" => $sql
            ];
        }else{
            return [
                "result" => false,
                "response" => "Aucun secteur correspondant n'a été trouvé."
            ];
        }
    }
    /**
     * MISE À JOUR  D'UN SECTEUR
     *
     * @param int identifiant
     * @param string libellé
     * @return array boolean | message
     */
    public function updateSecteur ( $id, $libelle ) {
        global $db;
        $idSecteur = $db->quote($id);
        $libelleSecteur = $db->quote($libelle);
        $sql = $db->prepare("UPDATE secteur SET 
                                libelleSecteur=$libelleSecteur
                                WHERE idSecteur=$idSecteur
                            ");
        if ( $sql->execute() ) {
            return [
                    "result" => true,
                    "response" => "Le secteur ".$libelle." a été mis à jour avec succès."
                ];
        } else {
            return [
                    "result" => false,
                    "response" => "Le secteur ".$libelle." n'a pas été mis à jour."
                ];
        }  
    }
    /**
     * SUPPRESSION  D'UN SECTEUR
     *
     * @param int identifiant
     * @param string libellé
     * @return array boolean | message
     */
    public function deleteSecteur ( $id, $libelle ) {
        global $db;
        $idSecteur = $db->quote($id);
        $sql = $db->prepare("DELETE FROM secteur WHERE idSecteur = $idSecteur");
        if ( $sql->execute() ) {
            return [
                    "result" => true,
                    "response" => "Le secteur ".$libelle." a été supprimé avec succès."
                ];
        }else{
            return [
                    "result" => false,
                    "response" => "Le secteur ".$libelle." n'a pas été supprimé."
                ];
        }
    }
    /**
     * RÉCUPÉRATION DE LA LISTE DES SECTEURS
     *
     * @param boolean activé/désactivé
     * @return array liste des secteurs
     */
    public function getSecteurs ( $activate = false ) {
        global $db;
        $ACTIVATE = $activate ? "WHERE activerSecteur = '1'" : "" ;
        return $db->query("SELECT * FROM secteur $ACTIVATE ORDER BY libelleSecteur")->fetchAll();
    }
    /**
     * ACTIVATION D'UN SECTEUR
     *
     * @param array secteur
     * @return array boolean | message
     */
    public function activateSecteur ( $data ) {
        global $db;
        $idSecteur = $db->quote($data['idSecteur']);

        if ( is_null($data["activerSecteur"]) ) {
            $activerSecteur = $db->quote(1);
            $txt="actif";
        } else {
            $activerSecteur = 'NULL';
            $txt = "inactif";
        }
        $sql = $db->prepare("UPDATE secteur SET activerSecteur=$activerSecteur WHERE idSecteur=$idSecteur");
        if ( $sql->execute() ) {
            return [
                "result" => true,
                "response" => "Le secteur ".$data['libelleSecteur']." est ".$txt."."
            ];
        }else{
            return [
                "result" => false,
                "response" => "Le secteur ".$data['libelleSecteur']." n'est pas ".$txt."."
            ];
        } 
    }
    
}



?>