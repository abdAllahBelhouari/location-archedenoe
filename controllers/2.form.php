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




?>