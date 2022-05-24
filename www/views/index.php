<?php include('anchors/header.php'); ?>


<div class="container" id="container">

	<div class="form-container sign-up-container">

		<form action="" method="POST">

			<h1>Vérifier mon compte</h1>

			<span>Vous receverez un lien par email. Attention aux spams.</span>

			<input type="email" name="filledemail" placeholder="Email avec laquelle j'ai été enregistré" />

			<button id="" name="f-validation" class="animation-button">Vérifier</button>

		</form>

	</div>



	<div class="form-container sign-in-container">

		<form action="" method="POST">

			<h3>Me connecter</h3>

			<input type="email" placeholder="Email" name="filledemail" />

			<input type="password" placeholder="Mot de passe" name="filledpassword" />

			<a href="PasswordLost.php">Mot de passe oublié ?</a>

			<button name="submit-f-login">Connexion</button>

		</form>

	</div>



	<div class="overlay-container">

		<div class="overlay">

			<div class="overlay-panel overlay-left">

				<h1>Compte déjà vérifié ?</h1>

				<p></p>

				<button class="ghost" id="signIn">Me connecter</button>

			</div>

			<div class=" overlay-panel overlay-right">

				<h1>DAMN PANEL</h1>

				<p>Déambulateur à Assistance Motorisée et Numérique.</p>



			</div>

		</div>

	</div>


</div>

<script type="text/javascript">
	const signInButton = document.getElementById('signIn');

	const container = document.getElementById('container');



	signInButton.addEventListener('click', () => {

		container.classList.remove("right-panel-active");

	});

	function findGetParameter(parameterName) {
		var result = null,
			tmp = [];
		location.search
			.substr(1)
			.split("&")
			.forEach(function(item) {
				tmp = item.split("=");
				if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
			});
		return result;
	};

	if (findGetParameter("view") == 1) {
		if (!(performance.navigation.type == performance.navigation.TYPE_RELOAD)) {
			container.classList.remove("right-panel-active");
			container.offsetWidth;
			container.classList.add("right-panel-active");
		} else {
			container.classList.add("right-panel-active");
		}
	};
</script>


<?php include('anchors/footer.php'); ?>