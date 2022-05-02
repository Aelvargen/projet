<?php

session_start();
require_once('config.php');

if (isset($_POST['f-pwd_lost'])) {

    $email = htmlspecialchars($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query_email_validity = mysqli_query($conn, "SELECT * FROM users_accounts WHERE email = '$email'");

        if (mysqli_num_rows($query_email_validity) == 1) {

            $token = bin2hex(random_bytes(16));

            $update = mysqli_query($conn, "UPDATE users_accounts SET pwd_reset = 1, pwd_reset_token = '$token' WHERE email = '$email'");

            $reply_to = 'support@asarra.website';
            $from = 'password-lost@asarra.website';
            $to = $email;
    
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            // En-têtes additionnels
            $headers .= 'Reply-To: ' . $reply_to . "\n"; // Mail de reponse
            $headers .= 'To: ' . $to . ' <' . $to . '>' . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            $headers .= 'Delivered-to: ' . $to . "\n"; // Destinataire
            $returnpath = '-f support@asarra.website';
            $subject = "Tasky : Rénitialisez votre mot de passe";
            $message = "
            <p>Une demande pour changer le mot de passe de votre compte Tasky vient d'être reçue. Cliquez <a href='https://www.asarra.website/pwd_lost_recreation.php?token=$token&email=$email'>ici</a> pour y accéder.</p>
            <p>Si vous n'êtes pas à l'origine de cette demande, ignorez ce mail.</p>
            <br />
            <p>Cordialement,<p>
            <p>L'équipe de gestion Tasky<p>
            ";
        
            if ($update) {
                mail($to, $subject, $message, $headers, $returnpath);
                $sent = 1;
            }
        } else {
            $error = "Votre adresse mail n'est pas valide !";
        }
    } else {
        $error = "Votre adresse mail n'est pas valide !";
    }
}

?>


<?php include('anchors/header.php'); ?>

<style>
    .f-box {
        border-radius: 10px;
        border: 1px solid #333;
    }

    input[type=submit] {
        border-radius: 10px;
        display: block;
        position: relative;
        width: max-content;
        height: 35px;
        text-align: center;
        color: #fff;
        line-height: 35px;
        text-decoration: none;
        float: left;
        background: #528fec;
        transition: background 0.3s;
        padding: 0 5em;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    input[type=submit]:hover {
        background: #417edb;
    }
</style>

<div id="wrapper">
    <div id="top-banner"></div>
    <div id="tb-title" />DAMN
</div>

<?php if (!isset($sent)) { ?>
    <form method="POST" action="" class="box">
        <div class="d-auto-hw abs-center">

            <input type="email" spellcheck="false" name="email" id="email" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Email" value="<?php if (isset($mail)) {echo $mail;} ?>" required /><br />
            <?php
            if (isset($error)) {
                echo '<p style="color: #780a02; font-size: 14px;">' . $error . '</p>';
            }
            ?>

            <input type="submit" name="f-pwd_lost" value="Obtenir un nouveau mot de passe" />
        </div>

    </form>

<?php } else { ?>
    <div class="box">
        <div class="d-auto-hw abs-center">
            <h4 align="center">Vous venez de recevoir un email pour modifier votre mot de passe. Cliquez <a href="https://www.asarra.website">ici</a> pour vous connecter.<h4>
        </div>
    </div>

<?php } ?>

<?php include('anchors/footer.php') ?>
