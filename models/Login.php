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
		$Membre=$db->query("SELECT * FROM membre 
							WHERE emailMembre=$emailMembre
						")->fetch();
		if($Membre){
			if (password_verify($data['passwordMembre'],$Membre['passwordMembre'])){
				$_SESSION['Auth']=$Membre;
				$_SESSION['Auth']['username']=((int)$_SESSION['Auth']['genreMembre']==1?'Mme ':'Mr ').$_SESSION['Auth']['nomMembre']." ".$_SESSION['Auth']['prenomMembre'];
				$_SESSION['Auth']['level']=substr($_SESSION['Auth']['levelsMembre'],0,1);
				$_SESSION['Key']="2f6587e7c62d6d73280296d0f3559a93";
				return [
					'result'=>true,
					'response'=>$_SESSION['Auth']['username']." vous êtes maintenant connecté".((int)$_SESSION['Auth']['genreMembre']== 1 ?'e' : '')
				];;
			} else {
				return [
					'result'=>false,
					'response'=>"Mot de passe incorrect."
				];
			}
		}else{
			return [
				'result'=>false,
				'response'=>"Aucun membre correspondant n'a été trouvé."
			];
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