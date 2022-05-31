<?php

require_once('config.php');

if (isset($_POST['f-pwd_lost'])) {

    $email = htmlspecialchars($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $query_email_validity = "SELECT * FROM authorized_users WHERE user_email = '$email'";

        if (mysqli_num_rows(mysqli_query($conn, $query_email_validity)) == 1) {

            $token = bin2hex(random_bytes(16));

            $update_user_password_request = "UPDATE authorized_users SET password_reset = 1, password_reset_token = '$token' WHERE (user_email = '$email')";

            $username = mysqli_fetch_array(mysqli_query($conn, $query_email_validity))['user_username'];

            $reply_to = 'support@asarra.xyz';
            $from = 'noreply-damn@asarra.xyz';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            // Additional headers
            $headers .= 'From: Damn Support <' . $from . '>' . "\r\n";
            $returnpath = '' . $reply_to . '';
            $subject = "Damn Panel : Rénitialiser votre mot de passe";
            $message = "<p>" . $username . ",<p>
                <p>Vous avons reçu votre demande de changement de mot de passe.<p>
                <p>Il vous suffit de cliquer <a href='http://www.asarra.xyz/NewPassword.php?token=$token&email=$email'>ici</a> pour y accéder.</p>
                <p>Si vous n'êtes pas à l'origine de cette demande, ignorez ce mail.</p>
                <br />
                <p>Cordialement,<p>
                <p>Le support technique DAMN<p>";

            if (mysqli_query($conn, $update_user_password_request)) {
                mail($email, $subject, $message, $headers, $returnpath);
?>
                <script type="text/javascript">
                    window.location = "https://www.asarra.xyz/EndProcessusPage.php?wtp=1";
                </script>
<?php
            }
        } else {
            $error = "Votre adresse mail n'est pas valide !";
        }
    } else {
        $error = "Votre adresse mail n'est pas valide !";
    }
}

require('views/password_lost_request.php');
