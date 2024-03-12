<?php
class Login {
    
    public function checkData($data){
        $error=[];
        if(empty($data["emailMembre"])){
            $error['emailMembre']="Saisir votre email.";
        }
        if(empty($data["passwordMembre"])){
            $error['passwordMembre']="Saisir votre mot de passe.";
        }
        return $error;
    }

    public function connexion ($data){
        global $db;
		$emailMembre=$db->quote($data['emailMembre']);
		$passwordMembre=$db->quote(sha1($data['passwordMembre']));
		$Membre=$db->query("SELECT * FROM membre 
							WHERE emailMembre=$emailMembre
							AND passwordMembre=$passwordMembre
						")->fetch();
		if($Membre){
			$_SESSION['Auth']=$Membre;
			$_SESSION['Auth']['username']=((int)$_SESSION['Auth']['genreMembre']==1?'Mme ':'Mr ').$_SESSION['Auth']['nomMembre']." ".$_SESSION['Auth']['prenomMembre'];
			$_SESSION['Auth']['level']=substr($_SESSION['Auth']['levelsMembre'],0,1);
			$_SESSION['Key']="2f6587e7c62d6d73280296d0f3559a93";
			return true;
		}else{
			return false;
		}
    }
	
    public static function controlAccess($level){
		if(!in_array($_SESSION['Auth']['level'],$level)){
			header("location:?route=noaccess");
			die();
		}
	}
}


?>