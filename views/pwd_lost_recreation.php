<?php

session_start();
require_once('config.php');
$email = $_GET['email'];
if (isset($_POST['f-pwd_lost_recreation'])) {

    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];
    if ($password == $password2) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "UPDATE users_accounts SET password = '$hash', pwd_reset = 0, pwd_reset_token = '' WHERE email = '$email'");

        if ($query) {
            header('Location: https://www.asarra.website');
        }

    } else {
        $error = "Vos mots de passes ne correspondent pas !";
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
    <div id="tb-title" />Tasky
</div>

<form method="POST" action="" class="box">
    <div class="d-auto-hw abs-center">
        <input type="password" class="f-txt f-box" name="pwd" id="pwd" placeholder="Mot de passe" title="Au moins un chiffre et une lettre majuscule et minuscule, et au moins 5 caractères ou plus" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" /><br />

        <input type="password" class="f-txt f-box" name="pwd2" id="pwd2" placeholder="Confirmez votre mot de passe" title="Merci de renseigner le même mot de passe qu'au dessus" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" /><br />
        <?php
        if (isset($error)) {
            echo '<p style="color: #780a02; font-size: 14px;">' . $error . '</p>';
        }
        ?>

        <input type="submit" name="f-pwd_lost_recreation" value="Enregistrer le nouveau mot de passe" />
    </div>

</form>

</div>
<?php include('anchors/footer.php') ?>