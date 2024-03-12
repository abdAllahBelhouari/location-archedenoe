<?php
require_once('../public/autoload.php');
switch(isset($_GET['action']))
{
    case 'add':
        // Enregistrer l'user
        if(!empty($_POST['nom']))
        {
            // requete SQL insertion (ou méthode de la classe users)
        }
    break;
    case 'edit':

    break;
}
?>