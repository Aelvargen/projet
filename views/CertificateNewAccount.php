<?php

session_start();


require_once('config.php');

if (isset($_POST['f-certification'])) {

    $email = htmlspecialchars($_POST['email']);
    $password_1 = $_POST['password-1'];
    $password_2 = $_POST['password-2'];


    if ($password_1 != $password_2) {
        $message = "Les mots de passe ne correspondent pas !";
        echo '<script type="text/javascript">window.alert("' . $password_1 . '");</script>';
    } else {

        $q_check_if_email_exists = "SELECT COUNT(*) FROM authorized_users WHERE (user_email = '$email_adress')";
        if (mysqli_query($conn, $q_check_if_email_exists) == 1) {
            echo '<script type="text/javascript">window.alert("' . "parfait" . '");</script>';
        } else {
            echo '<script type="text/javascript">window.alert("' . "problème" . '");</script>';
        };
    };
};
?>

<?php include('anchors/header.php'); ?>


<style>
    main.container {
        display: block;
        text-align: center;
    }

    form {
        display: inline-block;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
    }
</style>


<main class="container">
    <form class="form" name="f-certification" action="" method="POST">
        <h1 class="form_heading">DAMN</h1>

        <div class="form_field">
            <input type="password" class="f-txt f-box" name="password-1" id="password-1" placeholder="Nouveau mot de passe" required /><br />
        </div>

        <div class="form_field">
            <input type="password" class="f-txt f-box" name="password-2" id="password-2" placeholder="Confirmez le nouveau mot de passe" required /><br />
        </div>

        <div class="form_field">
            <input type="email" spellcheck="false" name="email" id="email" autocomplete="off" class="f-txt f-box" spellcheck="false" autocomplete="off" placeholder="Email" value="<?php if (isset($email)) {
                                                                                                                                                                                        echo $email;
                                                                                                                                                                                    } ?>" required /><br />
        </div>

        <input type="submit" name="f-certification" class="btn">

    </form>
</main>

<?php ?>


<?php include('anchors/footer.php'); ?>