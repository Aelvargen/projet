<?php

require_once('config.php');


$what_page_to_print_title = $_GET['wtp'];


if($what_page_to_print_title == 0){
    $title = "Vos informations ont été enregistrées !";
    $message = "Vous pouvez désormais vous connecter. En cas de problème technique, n'hésitez pas à contacter le support technique."; 
} else {
    $title = "Informations envoyées par email !";
    $message = "Vous allez recevoir un email contenant la suite des instructions. Nous vous conseillons de vérifier vos spams ";
}

require('views/processus-end-page.php');

?>