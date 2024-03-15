<?php
    class Categorie {
        /**
         * Method to check if categorie's data are correct
         *
         * @param array $data
         * @return array
         */
        public function checkData($data) {
            global $db;
            $error=[];
            if(empty($data["libelleCategorie"])){
                $error['libelleCategorie']="Saisir la catégorie.";
            }else{
                $data["libelleCategorie"]=ucfirst(trim($data["libelleCategorie"]));
                $libelleCategorie =$db->quote($data["libelleCategorie"]);
                $exist = $db->query("SELECT * FROM categorie 
                                        WHERE libelleCategorie = $libelleCategorie
                                    ")->fetch();
                if ($exist) {
                    $error['libelleCategorie']="Cette catégorie existe déjà.";
                }
            }
            return [
                "error"=>$error,
                "data"=>$data
            ];
        }
        /**
         * Method to create a category
         *
         * @param string $libelle
         * @return array
         */
        public function createCategorie($libelle) {
            global $db;
            $libelleCategorie = $db->quote($libelle);
            $sql=$db->prepare("INSERT INTO categorie SET 
                                    libelleCategorie=$libelleCategorie,
                                    webCategorie='1'
                                ");
            if ($sql->execute()) {
                return [
                    "result" => true,
                    "response" => "La catégorie ".$libelle." a été enregistrée avec succès."
                ];
            } else {
                return [
                    "result" => false,
                    "response" => "La catégorie ".$libelle." n'a pas été enregistrée."
                ];
            }
        }
        /**
         * Method to read categories
         *
         * @param int $id
         * @return array
         */
        public function readCategorie($id) {
            global $db;
            $idCategorie=$db->quote($id);
            $sql=$db->query("SELECT * FROM categorie WHERE idCategorie = $idCategorie")->fetch();
            if($sql){
                return [
                    "result" => true,
                    "response" => $sql
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "Aucune catégorie correspondante n'a été trouvée."
                ];
            }
        }
        /**
         * Method to update a category
         *
         * @param int $id
         * @param string $libelle
         * @return array
         */
        public function updateCategorie($id,$libelle) {
            global $db;
            $idCategorie = $db->quote($id);
            $libelleCategorie = $db->quote($libelle);
            $sql=$db->prepare("UPDATE categorie SET 
                                    libelleCategorie=$libelleCategorie
                                    WHERE idCategorie=$idCategorie
                                ");
            if ($sql->execute()) {
                return [
                    "result" => true,
                    "response" => "La catégorie ".$libelle." a été mise à jour avec succès."
                ];
            } else {
                return [
                    "result" => false,
                    "response" => "La catégorie ".$libelle." n'a pas été mise à jour."
                ];
            }  
        }
        /**
         * Method to delete a category
         *
         * @param int $id
         * @param string $libelle
         * @return array
         */
        public function deleteCategorie($id,$libelle) {
            global $db;
            $idCategorie=$db->quote($id);
            $sql=$db->prepare("DELETE FROM categorie WHERE idCategorie = $idCategorie");
            if($sql->execute()){
                return [
                    "result" => true,
                    "response" => "La catégorie ".$libelle." a été supprimée avec succès."
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "La catégorie ".$libelle." n'a pas été supprimée."
                ];
            }
        }
        /**
         * Method to get categories
         *
         * @param boolean $web
         * @return array
         */
        public function getCategories($web=false) {
            global $db;
            $WEB = $web ? "WHERE webCategorie = '1'" : "" ;
            return $db->query("SELECT * FROM categorie $WEB ORDER BY libelleCategorie")->fetchAll();
        }
        /**
         * Method to show or display a category on the web
         *
         * @param array $data
         * @return array
         */
        public function showWeb($data){
            global $db;
            $idCategorie = $db->quote($data['idCategorie']);
    
           if(is_null($data["webCategorie"])){
                $webCategorie=$db->quote(1);
                $txt="visible";
           } else {
                $webCategorie = 'NULL';
                $txt = "invisible";
           }
           $sql = $db->prepare("UPDATE categorie SET webCategorie=$webCategorie WHERE idCategorie=$idCategorie");
           if($sql->execute()){
                return [
                    "result" => true,
                    "response" => "La catégorie ".$data['libelleCategorie']." est ".$txt." sur le web."
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "La catégorie ".$data['libelleCategorie']." n'est pas ".$txt." sur le web."
                ];
            }  
    
        }
    }
?>