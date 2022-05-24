<?php

session_start();
require_once('config.php');

if (isset($_POST['f-pwd_lost'])) {

    $email = htmlspecialchars($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query_email_validity = mysqli_query($conn, "SELECT * FROM users_accounts WHERE email = '$email'");

        if (mysqli_num_rows($query_email_validity) == 1) {

            $token = bin2hex(random_bytes(16));

            $update = mysqli_query($conn, "UPDATE users_accounts SET pwd_reset = 1, pwd_reset_token = '$token' WHERE email = '$email'");

            $reply_to = 'support@asarra.website';
            $from = 'password-lost@asarra.website';
            $to = $email;
    
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            // En-têtes additionnels
            $headers .= 'Reply-To: ' . $reply_to . "\n"; // Mail de reponse
            $headers .= 'To: ' . $to . ' <' . $to . '>' . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            $headers .= 'Delivered-to: ' . $to . "\n"; // Destinataire
            $returnpath = '-f support@asarra.website';
            $subject = "Tasky : Rénitialisez votre mot de passe";
            $message = "
            <p>Une demande pour changer le mot de passe de votre compte Tasky vient d'être reçue. Cliquez <a href='https://www.asarra.website/pwd_lost_recreation.php?token=$token&email=$email'>ici</a> pour y accéder.</p>
            <p>Si vous n'êtes pas à l'origine de cette demande, ignorez ce mail.</p>
            <br />
            <p>Cordialement,<p>
            <p>L'équipe de gestion Tasky<p>
            ";
        
            if ($update) {
                mail($to, $subject, $message, $headers, $returnpath);
                $sent = 1;
            }
        } else {
            $error = "Votre adresse mail n'est pas valide !";
        }
    } else {
        $error = "Votre adresse mail n'est pas valide !";
    }
}

?>


<?php include('anchors/header.php'); ?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
	background: #f6f5f7;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}

h1 {
	font-weight: bold;
	margin: 0;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #FF4B2B;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}
	
	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #FF416C;
	background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
</style>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="#">
			<h3>Récupérer mon compte</h3>
            <span>Un lien vous sera envoyé par email. Attention aux spams.</span>
			<input type="email" placeholder="Adresse email" />
			<a href="/">Se connecter ?</a>
			<button>Confirmer</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>DAMN PANEL</h1>
				<p>Déambulateur à Assistance Motorisée et Numérique.</p>
			</div>
		</div>
	</div>
</div>



<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>

<?php include('anchors/footer.php') ?>