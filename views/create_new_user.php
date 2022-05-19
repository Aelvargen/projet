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
        $error = "Identifiant déjà utilisé !";

        $username_already_used = mysqli_query($conn, "SELECT user_username FROM authorized_users WHERE user_username = '$username' LIMIT 1");

        if (mysqli_num_rows($username_already_used) == 0) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $resultSet = mysqli_query($conn, "SELECT user_email FROM authorized_users WHERE user_email = '$email' LIMIT 1");

                if (mysqli_num_rows($resultSet) == 0) {

                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    $res = mysqli_query($conn, "INSERT INTO authorized_users (
                        user_username,
                        user_email,
                        user_password,
                        verication,
                        verification_token, 
                        passowrd_reset, 
                        passowrd_reset_token, 
                        ) VALUES (
                            '$username',
                            '$email', 
                            '$hash', 
                            0,  
                            '$token', 
                            0,
                            ''
                            )"
                            );

                    if ($res) {
                        session_start();
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['token'] = $token; 
                        $_SESSION['username'] = $username;
                        
                    }
                   
                } else {
                    $error = "Adresse email déjà utilisée !";
                }
            } else {
                $error = "Adresse adresse email non valide !";
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

<main class="container">
    <form class="form" action="" method="POST" name="f-signup" id="f-signup">
        <h1 class="form_heading">DAMN</h1>
        <div class="form_field">
            <input type="text" spellcheck="false" name="username" id="username" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Identifiant" value="<?php if (isset($username)) {echo $username;} ?>" required /><br />
        </div>

        <div class="form_field">
            <input type="email" spellcheck="false" name="email" id="email" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Email" value="<?php if (isset($email)) {echo $email;} ?>" required /><br />
        </div>

        <div class="form_field">
            <input type="password" class="f-txt f-box" name="password" id="password" placeholder="Mot de passe" required /><br />
        </div>

        <input type="submit" value"Envoyer">
        <button class="btn">Connexion</button>

        <?php
        if (isset($error)) {
            echo '<p style="color: #780a02; font-size: 14px;">' . $error . '</p>';
        }
        ?>
        
    </form>
    <button onclick = "location.href='pwd_lost.php'" class="btn">Mot de passe oublié</button>
</main> 

