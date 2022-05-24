<?php
session_start();
require('config.php');




if (isset($_POST['f-signup'])) {



    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password =  $_POST['pwd'];
    $token = bin2hex(random_bytes(16));
    $username_lenght = strlen($username);
    
    if ($username_lenght <= 255) {
        
        $username_already_used = mysqli_query($conn, "SELECT user_username FROM authorized_users WHERE user_username = '$username' LIMIT 1");

        if (mysqli_num_rows($username_already_used) == 0) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $resultSet = mysqli_query($conn, "SELECT user_email FROM authorized_users WHERE user_email = '$email' LIMIT 1");

                if (mysqli_num_rows($resultSet) == 0) {

                    $hash = password_hash($password, PASSWORD_DEFAULT);


                    $sql = "INSERT INTO authorized_users (user_username, user_email, user_password, verification, verification_token, password_reset, password_reset_token)
                    VALUES ('$username', '$email', '$hash', 0, '$token', 0, '')";
                    
                    if (mysqli_query($conn, $sql)) {
                        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';

                        session_start();
                        
                    } 
                   
                } else {
                    $error = "Adresse email déjà utilisée !";
                }
            } else {
                $error = "Adresse email non valide !";
            }
        } else {
            $error = "Identifiant déjà utilisé !";
        }   
    } else {
        $error = "L'identifiant ne doit pas dépasser 255 caractères !";
    }      
    
}
?>

<?php include('anchors/header.php'); ?>


<style>

main.container{
    display: block;
    text-align: center;
}

form
{
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}

</style>

<main class="container">
    <form class="form" method="POST" name="f-signup" id="f-signup">

        <input type="text" spellcheck="false" name="username" id="username" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Identifiant" value="<?php if (isset($username)) {echo $username;} ?>" required /><br />

        <input type="email" spellcheck="false" name="email" id="email" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Email" value="<?php if (isset($email)) {echo $email;} ?>" required /><br />

        <input type="password" class="f-txt f-box" name="pwd" id="pwd" placeholder="Mot de passe" title="Au moins un chiffre et une lettre majuscule et minuscule, et au moins 5 caractères ou plus" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" /><br />

        <input type="submit" name="f-signup" class="btn" value="submit">

        <?php
        if (isset($error)) {
            echo '<p style="color: #780a02; font-size: 14px;">' . $error . '</p>';
        }
        ?>
        
    </form>
</main> 

