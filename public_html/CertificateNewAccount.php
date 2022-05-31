<?php

require_once('config.php');

if (isset($_POST['f-validation'])) {


    $token = 0;
    $to = htmlspecialchars($_POST['email']);
    $username = 1;
    $reply_to = 'support@asarra.xyz';
    $from = 'noreply@asarra.xyz';


    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $headers .= 'Reply-To: ' . $reply_to . "\n"; // Mail de reponse
    $headers .= 'To: ' . $to . ' <' . $to . '>' . "\r\n";
    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
    $headers .= 'Delivered-to: ' . $to . "\n"; // Destinataire

    $returnpath = '-f support@asarra.website';
    $subject = "Tasky: Activez votre compte !";
    $message = "<p>" . $username . ",<p><br />
    <p>Il ne vous reste plus qu'une étape afin d'activer votre compte sur Tasky !<p>
    <p>Il vous suffit de cliquer <a href='http://www.asarra.website/verify.php?token=$token&email=$to'>ici</a> pour pouvoir utiliser Tasky.</p>
    <br />
    <p>Cordialement,<p>
    <p>L'équipe de gestion Tasky<p>
    ";

    mail($to, $subject, $message, $headers, $returnpath);
};

require('views/certificate_new_account.php');

?>