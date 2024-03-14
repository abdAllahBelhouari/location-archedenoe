<?php
    class Article {
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
            $txt = "";
            foreach ($files["photos"]["type"] as $index => $type) {              
                if (substr($type,0,5)!="image") {
                    $txt.="<li>Le fichier <span style='color:#00f'>".$files["photos"]["name"][$index]."</span> n'est pas une photo</li>";
                }
            }
            if($txt !=""){
                $error['photos'] = $txt;
            }
            return [
                "error"=>$error,
                "data"=>$data
            ];
        }

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
            echo"<pre>";
            var_dump($files);
            echo"</pre>";
            die();
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

        public function getArticles() {
            global $db;
            return $db->query("SELECT article.*,libelleCategorie 
                                    FROM article,categorie
                                    WHERE article.idCategorie=categorie.idCategorie  
                                    ORDER BY libelleArticle
                                ")->fetchAll();
        }

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