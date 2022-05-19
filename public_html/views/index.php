


<link rel="stylesheet" href="style/index.css" type="text/css">

<?php

session_start();


require_once('config.php');

if (isset($_POST['f-login'])) {


    $id = htmlspecialchars($_POST['username']);
    $password =  $_POST['password'];


    $query_get_user = "SELECT * FROM authorized_users WHERE (user_username = '$id' OR user_email = '$id')";

    $db_password = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['user_password'];

    if (password_verify($password, $db_password /*mysqli_fetch_array($query_get_user)['password']*/)) {


        if (mysqli_fetch_array(mysqli_query($conn, $query_get_user))['verification'] == 1) {

            $message = "ok";
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';



            /*header("Location: https://www.asarra.website/profile.php");*/
        } else {
            $message = "non ok";
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';


            $_SESSION['email'] = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['user_email'];
            $_SESSION['token'] = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['verification_token'];

            $message = '<p style="text-decoration: none; color: #780a02; font-size: 14px;">Votre adresse mail n\'a pas été vérifiée, veuillez consulter votre boite mail.</p>
            <a href="thankyou.php" class="f-sublink">Vous n\'avez pas reçu d\'email ?</a>';
        }
    } else {
        $message = '<p style="color: #780a02; font-size: 14px;"> L\'identifiant ou le mot de passe est incorrect !</p>';
    }
}
?>

<?php include('anchors/header.php'); ?>

<main class="container">
    <form class="form" name="f-login" action="" method="POST">
        <h1 class="form_heading">DAMN</h1>
        <div class="form_field">
            <input type="text" spellcheck="false" name="username" id="username" autocomplete="off" class="f-txt f-box" spellcheck="false" placeholder="Identifiant / Email" required /><br />
        </div>

        <div class="form_field">
            <input type="password" class="f-txt f-box" name="password" id="password" placeholder="Mot de passe" required /><br />
        </div>

        <input type="submit" name="f-login" class="btn">
        
    </form>
    <button onclick = "location.href='ResetPassword.php'" class="btn">Mot de passe oublié</button>
</main> 

<?php ?>


<?php include('anchors/footer.php'); ?>