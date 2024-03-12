<?php
class Condition {
    public function checkData($data){
        $error=[];
        if(empty($data["titreTerme"])){
            $error['titreTerme']="Saisir le titre.";
        }else{
            $data["titreTerme"]=ucfirst(trim($data["titreTerme"]));
        }
        if(empty($data["contenuTerme"])){
            $error['contenuTerme']="Saisir le contenu.";
        }else{
            $data["contenuTerme"]=ucfirst(trim($data["contenuTerme"]));
        }
        if(empty($data["indexTerme"])){
            $error['indexTerme']="Saisir l'index.";
        }elseif(!is_numeric($data["indexTerme"])){
            $error['indexTerme']="Valeur en chiffre.";
        }
        return [
            "error"=>$error,
            "data"=>$data
        ];
    }

    public function createCondition($data){
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
        if($sql->execute()){
            return [
                "result" => true,
                "response" => "La condition ".$data['titreTerme']." a été enregistrée avec succès."
            ];
        }else{
            return [
                "result" => false,
                "response" => "La condition ".$data['titreTerme']." n'a pas été enregistrée."
            ];
        }                    
    }

    public function readCondition($id){
        global $db;
        $idTerme=$db->quote($id);
        $sql=$db->query("SELECT * FROM terme WHERE idTerme = $idTerme")->fetch();
        if($sql){
            return [
                "result" => true,
                "response" => $sql
            ];
        }else{
            return [
                "result" => false,
                "response" => "Aucune condition correspondante n'a été trouvée."
            ];
        }
    }

    public function updateCondition($data,$id){
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
        if($sql->execute()){
            return [
                "result" => true,
                "response" => "La condition ".$data['titreTerme']." a été mise à jour avec succès."
            ];
        }else{
            return [
                "result" => false,
                "response" => "La condition ".$data['titreTerme']." n'a pas été mise à jour."
            ];
        }                    
    }

    public function getConditions(){
        global $db;
        return $db->query("SELECT * FROM terme ORDER BY indexTerme,titreTerme")->fetchAll();
    }

    public function showWeb($data){
        global $db;
        $idTerme = $db->quote($data['idTerme']);

       if(is_null($data["webTerme"])){
            $webTerme=$db->quote(1);
            $txt="visible";
       } else {
            $webTerme = 'NULL';
            $txt = "invisible";
       }
       $sql = $db->prepare("UPDATE terme SET webTerme=$webTerme WHERE idTerme=$idTerme");
       if($sql->execute()){
            return [
                "result" => true,
                "response" => "La condition ".$data['titreTerme']." est ".$txt." sur le web."
            ];
        }else{
            return [
                "result" => false,
                "response" => "La condition ".$data['titreTerme']." n'est pas ".$txt." sur le web."
            ];
        }  

    }

    public function getConditionsWeb(){
        global $db;
        return $db->query("SELECT * FROM terme
                            WHERE webTerme=1 
                            ORDER BY indexTerme
                        ")->fetchAll();
    }
}


?>