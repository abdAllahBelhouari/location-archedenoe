<?php
    class Article {
        /**
         * Method to check if article's data are correct
         *
         * @param array $data
         * @param array $files
         * @return array [form error, form corrected]
         */
        public function checkData($data,$files) {
            global $db;
            $error=[];
            if(empty($data["idCategorie"])){
                $error['idCategorie']="Choisir la catégorie";
            }
            if(empty($data["libelleArticle"])){
                $error['libelleArticle']="Saisir le libellé";
            }else{
                $data["libelleArticle"]=ucfirst(trim($data["libelleArticle"]));
            }
            if(empty($data["descriptionArticle"])){
                $error['descriptionArticle']="Saisir la description";
            }else{
                $data["descriptionArticle"]=ucfirst(trim($data["descriptionArticle"]));
            }
            if(!empty($data["achatArticle"]) && !is_numeric($data["achatArticle"])){
                $error['achatArticle']="En chiffres";
            }
            if(!empty($data["cautionArticle"]) && !is_numeric($data["cautionArticle"])){
                $error['cautionArticle']="En chiffres";
            }
            if(!empty($data["tarifHeureArticle"]) && !is_numeric($data["tarifHeureArticle"])){
                $error['tarifHeureArticle']="En chiffres";
            }
            if(!empty($data["tarifJourArticle"]) && !is_numeric($data["tarifJourArticle"])){
                $error['tarifJourArticle']="En chiffres";
            }
            if(!empty($data["tarifWeekArticle"]) && !is_numeric($data["tarifWeekArticle"])){
                $error['tarifWeekArticle']="En chiffres";
            }
            if ($files) {
                for ($p=1; $p < 4 ; $p++) {                     
                    if (!empty($files["photo".$p."Article"]["name"]) && substr($files["photo".$p."Article"]["type"],0,5)!="image") {
                        $error['photo'.$p.'Article'] = "Ce fichier n'est pas une photo";
                    }
                } 
            }
            return [
                "error"=>$error,
                "data"=>$data
            ];
        }
        /**
         * Method to create an article
         *
         * @param array $data
         * @param array $files
         * @return array [bool, response]
         */
        public function createArticle($data,$files) {
            global $db;
            $idCategorie = $db->quote($data["idCategorie"]);
            $libelleArticle = $db->quote($data["libelleArticle"]);
            $descriptionArticle = $db->quote($data["descriptionArticle"]);
            $achatArticle = empty($data["achatArticle"]) ? 'NULL' : $db->quote($data["achatArticle"]);
            $cautionArticle = empty($data["cautionArticle"]) ? 'NULL' : $db->quote($data["cautionArticle"]);
            $tarifHeureArticle = empty($data["tarifHeureArticle"]) ? 'NULL' : $db->quote($data["tarifHeureArticle"]);
            $tarifJourArticle = empty($data["tarifJourArticle"]) ? 'NULL' : $db->quote($data["tarifJourArticle"]);
            $tarifWeekArticle = empty($data["tarifWeekArticle"]) ? 'NULL' : $db->quote($data["tarifWeekArticle"]);

            $sql=$db->prepare("INSERT INTO article SET 
                                    libelleArticle = $libelleArticle,
                                    descriptionArticle = $descriptionArticle,
                                    achatArticle = $achatArticle,
                                    cautionArticle = $cautionArticle,
                                    tarifHeureArticle = $tarifHeureArticle,
                                    tarifJourArticle = $tarifJourArticle,
                                    tarifWeekArticle = $tarifWeekArticle,
                                    idCategorie = $idCategorie,
                                    disponibleArticle = '1'
                                ");
            if ($sql->execute()) {
                /**
                 * photos processing
                 */
                $id = $db->lastInsertId();
                $idArticle = $db->quote($id);
                if ($files) {
                    $folder = "assets/pictures/";
                   for ($p=1; $p < 4 ; $p++) {                     
                       if (!empty($files["photo".$p."Article"]["name"])) {
                           $pathinfo = pathinfo($files["photo".$p."Article"]["name"]);
                           $newName = "art_".$id."_".$p.".".$pathinfo['extension'];
                            if(move_uploaded_file($files["photo".$p."Article"]["tmp_name"],$folder.$newName)) {
                                $photoArticle = $db->quote($newName);
                                $ref = "photo".$p."Article";   
                                $db->query("UPDATE article SET
                                                $ref=$photoArticle
                                                WHERE idArticle=$idArticle 
                                            ");
                            }
                        }
                    } 
                }
                return [
                    "result" => true,
                    "response" => "L'article ".$data['libelleArticle']." a été enregistré avec succès."
                ];
            } else {
                return [
                    "result" => false,
                    "response" => "L'article ".$data['libelleArticle']." n'a pas été enregistré."
                ];
            }
        }
        /**
         * Method to read articles
         *
         * @param int $id
         * @return array
         */
        public function readArticle($id) {
            global $db;
            $idArticle=$db->quote($id);
            $sql=$db->query("SELECT * FROM article WHERE idArticle = $idArticle")->fetch();
            if($sql){
                return [
                    "result" => true,
                    "response" => $sql
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "Aucun article correspondant n'a été trouvé."
                ];
            }
        }
        /**
         * Method to update an article
         *
         * @param int $id
         * @param array $data
         * @return array
         */
        public function updateArticle($id,$data) {
            global $db;
            $idArticle = $db->quote($id);
            $idCategorie = $db->quote($data["idCategorie"]);
            $libelleArticle = $db->quote($data["libelleArticle"]);
            $descriptionArticle = $db->quote($data["descriptionArticle"]);
            $achatArticle = empty($data["achatArticle"]) ? 'NULL' : $db->quote($data["achatArticle"]);
            $cautionArticle = empty($data["cautionArticle"]) ? 'NULL' : $db->quote($data["cautionArticle"]);
            $tarifHeureArticle = empty($data["tarifHeureArticle"]) ? 'NULL' : $db->quote($data["tarifHeureArticle"]);
            $tarifJourArticle = empty($data["tarifJourArticle"]) ? 'NULL' : $db->quote($data["tarifJourArticle"]);
            $tarifWeekArticle = empty($data["tarifWeekArticle"]) ? 'NULL' : $db->quote($data["tarifWeekArticle"]);

            $sql=$db->prepare("UPDATE article SET 
                                    libelleArticle = $libelleArticle,
                                    descriptionArticle = $descriptionArticle,
                                    achatArticle = $achatArticle,
                                    cautionArticle = $cautionArticle,
                                    tarifHeureArticle = $tarifHeureArticle,
                                    tarifJourArticle = $tarifJourArticle,
                                    tarifWeekArticle = $tarifWeekArticle,
                                    idCategorie = $idCategorie
                                    WHERE idArticle = $idArticle
                                ");
            if ($sql->execute()) {
                return [
                    "result" => true,
                    "response" => "L'article ".$data['libelleArticle']." a été mis à jour avec succès."
                ];
            } else {
                return [
                    "result" => false,
                    "response" => "L'article ".$data['libelleArticle']." n'a pas été mis à jour."
                ];
            }
        }
        /**
         * Method to delete an article
         *
         * @param int $id
         * @param string $libelle
         * @return array
         */
        public function deleteArticle($id,$libelle) {
            global $db;
            $idArticle=$db->quote($id);
            $sql=$db->prepare("DELETE FROM article WHERE idArticle = $idArticle");
            if($sql->execute()){
                return [
                    "result" => true,
                    "response" => "L'article ".$libelle." a été supprimé avec succès."
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "L'article ".$libelle." n'a pas été supprimé."
                ];
            }
        }
        /**
         * Method to get articles
         *
         * @return array
         */
        public function getArticles() {
            global $db;
            return $db->query("SELECT article.*,libelleCategorie 
                                    FROM article,categorie
                                    WHERE article.idCategorie=categorie.idCategorie  
                                    ORDER BY libelleArticle
                                ")->fetchAll();
        }
        /**
         * Method to set or unset available an article
         *
         * @param array $data
         * @return array
         */
        public function dispoArticle($data){
            global $db;
            $idArticle = $db->quote($data['idArticle']);
    
           if(is_null($data["disponibleArticle"])){
                $disponibleArticle=$db->quote(1);
                $txt="disponible";
           } else {
                $disponibleArticle = 'NULL';
                $txt = "indisponible";
           }
           $sql = $db->prepare("UPDATE article SET disponibleArticle=$disponibleArticle WHERE idArticle=$idArticle");
           if($sql->execute()){
                return [
                    "result" => true,
                    "response" => "L'article ".$data['libelleArticle']." est désormais ".$txt."."
                ];
            }else{
                return [
                    "result" => false,
                    "response" => "L'article ".$data['libelleCategorie']." n'a pas été rendu ".$txt."."
                ];
            }  
    
        }
    }

?>