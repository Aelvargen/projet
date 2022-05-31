<?php



require_once('config.php');





$email_via_get = $_GET['email'];

$token_via_get = $_GET['token'];



$check_if_user_registered = "SELECT * FROM authorized_users WHERE (user_email = '$email_via_get' AND verification = 0 AND verification_token = '$token_via_get')";



if (mysqli_num_rows(mysqli_query($conn, $check_if_user_registered)) == 1) {



    if (isset($_POST['submit-f-newpassword'])){

        $password1 = $_POST['password1'];

        $password2 =  $_POST['password2'];



        if ($password1 != $password2){

            $message = 'Mauvais mot de pase';

            echo '<script type="text/javascript">window.alert("' . $message . '");</script>';

        } else {

            $hash = password_hash($password1, PASSWORD_DEFAULT);



            $update_profile = "UPDATE authorized_users SET user_password = '$hash', verification = 1 WHERE (user_email = '$email_via_get' AND verification_token = '$token_via_get')";



            if (mysqli_query($conn, $update_profile)) {

                ?>



                <script type="text/javascript">

                    window.location = "https://www.asarra.xyz/EndProcessusPage.php";

                </script>



            <?php


                

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



require('views/configure-new-access.php');



?>