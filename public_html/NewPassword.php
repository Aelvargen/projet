<?php



require_once('config.php');


$email_via_get = $_GET['email'];

$token_via_get = $_GET['token'];



$check_if_request_exist = "SELECT * FROM authorized_users WHERE (user_email = '$email_via_get' AND password_reset = 1 AND password_reset_token = '$token_via_get')";

if (mysqli_num_rows(mysqli_query($conn, $check_if_request_exist)) == 1) {


    if (isset($_POST['submit-f-newpassword'])) {

        $password1 = $_POST['password1'];

        $password2 =  $_POST['password2'];


        if ($password1 != $password2) {

            $error = 'Les deux mots de passe ne correspondent pas !';

        } else {

            $password_stored_in_db = mysqli_fetch_array(mysqli_query($conn, $check_if_request_exist))['user_password'];

            if (!(password_verify($password1, $password_stored_in_db))) {



                $hash = password_hash($password1, PASSWORD_DEFAULT);



                $update_profile = "UPDATE authorized_users SET user_password = '$hash', password_reset = 0, password_reset_token = '' WHERE (user_email = '$email_via_get' AND password_reset_token = '$token_via_get')";


                if (mysqli_query($conn, $update_profile)) {
?>
                <script type="text/javascript">
                    window.location = "https://www.asarra.xyz/EndProcessusPage.php";
                </script>
    <?php

                }
            } else {
                $error = "Veuillez saisir un autre mot de passe.";
            }
        }
    }
} else {
        ?>
    <script type="text/javascript">
        window.location = "https://www.asarra.xyz";
    </script>
<?php
}

require('views/create_new_password.php');

?>