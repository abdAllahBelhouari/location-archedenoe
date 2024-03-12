<?php
    $statuts=["","Administrateur","Agent","Client"];


	function setFlash($titre,$message,$statut='success'){
		$_SESSION['flash']['titre']=$titre;
		$_SESSION['flash']['message']=$message;
		$_SESSION['flash']['statut']=$statut;
	}
	function flash(){
		if (isset($_SESSION['flash'])){
			extract($_SESSION['flash']);
			unset($_SESSION['flash']);
			return "<div data-aos='fade-right' class='alert alert-".$statut." flash'onclick='this.style.display=`none`'>
			<h4>".$titre."</h4>
			".$message."
			</div>";
		}
	}
	
	if (!isset($_SESSION['csrf'])){
		$_SESSION['csrf']=md5(time()+rand());
	}
	function csrf(){		
		return 'csrf='.$_SESSION['csrf'];
	}

	function checkCsrf(){
		if(!isset($_GET['csrf'])||$_GET['csrf']!=$_SESSION['csrf']){
			session_destroy();
			die("Erreur de jeton CSRF");
		}
	}



?>