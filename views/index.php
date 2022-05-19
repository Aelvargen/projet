


<link rel="stylesheet" href="style/index.css" type="text/css">

<?php

session_start();


require_once('config.php');

if (isset($_POST['form.signup'])) {

    $id = htmlspecialchars($_POST['username']);
    $password =  $_POST['password'];
    $query_get_user = "SELECT * FROM users_accounts WHERE (username = '$id' OR email = '$id')";

    $db_password = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['password'];
    if (password_verify($password, $db_password /*mysqli_fetch_array($query_get_user)['password']*/)) {

        if (mysqli_fetch_array(mysqli_query($conn, $query_get_user))['verified'] == 1) {

            $query_profile_informations = "SELECT * FROM users_profiles WHERE (username = '$id' OR email = '$id')";

            $username = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['username'];
            $email = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['email'];

            $_SESSION['user_login_status'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['user_firstname'] = mysqli_fetch_array(mysqli_query($conn, $query_profile_informations))['firstname'];
            $_SESSION['user_surname'] = mysqli_fetch_array(mysqli_query($conn, $query_profile_informations))['surname'];
            $_SESSION['user_age'] = mysqli_fetch_array(mysqli_query($conn, $query_profile_informations))['age'];
        
            header("Location: https://www.asarra.website/profile.php");
        } else {

            $_SESSION['email'] = mysqli_fetch_array(mysqli_query($conn, $query_get_user))['email'];
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
    <form class="form" action="" method="POST">
        <h1 class="form_heading">DAMN</h1>
        <div class="form_field">
            <input type="text" spellcheck="false" name="username" id="username" autocomplete="off" class="f-txt f-box" spellcheck="false" placeholder="Identifiant / Email" required /><br />
        </div>

        <div class="form_field">
            <input type="password" class="f-txt f-box" name="password" id="password" placeholder="Mot de passe" required /><br />
        </div>

        <button class="btn">Connexion</button>
        
    </form>
    <button onclick = "location.href='pwd_lost.php'" class="btn">Mot de passe oublié</button>
</main> 

<?php ?>


<?php include('anchors/footer.php'); ?>