<?php

require_once('config.php');

if (isset($_POST['submit-f-login'])) {

    $user_email = htmlspecialchars($_POST['filledemail']);
    $user_password =  $_POST['filledpassword'];
    $get_user_with_email = "SELECT * FROM authorized_users WHERE (user_email = '$user_email')";


    if (mysqli_query($conn, $get_user_with_email)) {

        $password_stored_in_db = mysqli_fetch_array(mysqli_query($conn, $get_user_with_email))['user_password'];

        if (password_verify($user_password, $password_stored_in_db)) {


            if (mysqli_fetch_array(mysqli_query($conn, $get_user_with_email))['verification'] == 1) {

?>

                <script type="text/javascript">
                    window.location = "https://www.asarra.xyz/dashboard.php";
                </script>

            <?php

            } else {
            ?>
                <script type="text/javascript">
                    window.location = "https://www.asarra.xyz/index.php?view=1";
                </script>
        <?php

            }
        } else {

            echo "<script>alert('Mauvais MDP');</script>";
        }
    } else {

        echo "<script>alert('Mauvais email');</script>";
    }
}

if (isset($_POST['f-validation'])) {
    $email_to_verify = htmlspecialchars($_POST['filledemail']);

    $verify_if_user_exists = "SELECT * FROM authorized_users WHERE (user_email = '$email_to_verify')";

    if (mysqli_query($conn, $verify_if_user_exists)) {
        $token_for_verification = mysqli_fetch_array(mysqli_query($conn, $verify_if_user_exists))['verification_token'];
        $username = mysqli_fetch_array(mysqli_query($conn, $verify_if_user_exists))['user_username'];


        $reply_to = 'support@asarra.xyz';
        $from = 'noreply-damn@asarra.xyz';


        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Additional headers
        $headers .= 'From: Damn Support <' . $from . '>' . "\r\n";



        $returnpath = '' . $reply_to . '';
        $subject = "Damn Panel : Activez votre compte !";
        $message = "<p>" . $username . ",<p>
        <p>Il ne vous reste plus qu'une ??tape afin de vous procurer votre acc??s au panel !<p>
        <p>Il vous suffit de cliquer <a href='http://www.asarra.xyz/ConfigureNewAccess.php?token=$token_for_verification&email=$email_to_verify'>ici</a> pour v??rifier votre compte et d??finir votre nouveau mot de passe.</p>
        <br />
        <p>Cordialement,<p>
        <p>Le support technique DAMN<p>
        ";

        mail($email_to_verify, $subject, $message, $headers, $returnpath);
        ?>
        <script type="text/javascript">
            window.location = "https://www.asarra.xyz/EndProcessusPage.php?wtp=1";
        </script>
<?php
    }
}


require('views/index.php');

?>