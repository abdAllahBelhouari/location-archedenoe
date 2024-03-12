<?php
//Backend router
require_once('../public/autoload.php');
if(isset($_SESSION["Auth"]) && $_SESSION['Auth']['level']<3){
    if(isset($_GET['route']) && $_GET['route']){
    
        require_once("../views/back/".$_GET["route"].'.php');
        
    }else{
        require_once("../views/back/index".$_SESSION['Auth']['level'].".php");
    } 
}
?>