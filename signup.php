<?php

require('config.php');

if (isset($_POST['f-signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $password =  $_POST['pwd'];
    $password2 =  $_POST['pwd2'];
    $date = date('Y-m-d H:i:s');
    //$token = md5(time() . $username);
    $token = bin2hex(random_bytes(16));
    $username_lenght = strlen($username);
    
    if ($username_lenght <= 255) {

        $username_already_used = mysqli_query($conn, "SELECT username FROM users_accounts WHERE username = '$username' LIMIT 1");

        if (mysqli_num_rows($username_already_used) == 0) {

            if ($email == $email2) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $resultSet = mysqli_query($conn, "SELECT email FROM users_accounts WHERE email = '$email' LIMIT 1");

                    if (mysqli_num_rows($resultSet) == 0) {

                        if ($password == $password2) {

                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            $res = mysqli_query($conn, "INSERT INTO users_accounts (username, email, password, registration_date, verified, verification_token, pwd_reset, pwd_reset_token) VALUES ('$username', '$email', '$hash', '$date', 0, '$token', 0, '')");

                            if ($res) {
                                session_start();
                                $_SESSION['email'] = $_POST['email'];
                                $_SESSION['token'] = $token; 
                                $_SESSION['username'] = $username;
                                header('Location: thankyou.php');
                            }
                        } else {
                            $error = "Vos mots de passes ne correspondent pas !";
                        }
                    } else {
                        $error = "Adresse mail déjà utilisée !";
                    }
                } else {
                    $error = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $error = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $error = "Identifiant déjà utilisé !";
        }   
    } else {
        $error = "Votre pseudo ne doit pas dépasser 255 caractères !";
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
        padding: 0 10.5em;
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


<form method="POST" action="" class="box" name='f-signup' id='f-signup'>
    <div class="d-auto-hw abs-center">

        <input type="text" spellcheck="false" name="username" id="username" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Identifiant" value="<?php if (isset($username)) {echo $username;} ?>" required /><br />

        <input type="email" spellcheck="false" name="email" id="email" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Email" value="<?php if (isset($email)) {echo $email;} ?>" required /><br />

        <input type="email" spellcheck="false" name="email2" id="email2" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Confirmez votre email" value="<?php if (isset($email2)) {echo $email2;} ?>" required /><br />

        <input type="password" class="f-txt f-box" name="pwd" id="pwd" placeholder="Mot de passe" title="Au moins un chiffre et une lettre majuscule et minuscule, et au moins 5 caractères ou plus" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" /><br />

        <input type="password" class="f-txt f-box" name="pwd2" id="pwd2" placeholder="Confirmez votre mot de passe" title="Merci de renseigner le même mot de passe qu'au dessus" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" /><br />

        <?php
        if (isset($error)) {
            echo '<p style="color: #780a02; font-size: 14px;">' . $error . '</p>';
        }
        ?>
        <!--<a href="#" name="f-signup" class="f-btn-p ext" onclick="document.getEl<br />ementById('f-signup').submit()">Je m'inscris<a><br />-->
        <input type="submit" name="f-signup" value="Créer un compte" /><br /><br />
        <a href="https://www.asarra.website" class="f-sublink">Vous avez déjà un compte ? Se connecter</a>
    </div>

</form>
</div>
<?php include('anchors/footer.php') ?>