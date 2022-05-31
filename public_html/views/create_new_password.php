<?php include('anchors/header.php'); ?>


<div class="container" id="container">

    <div class="form-container sign-in-container">

        <form action="" method="POST">

            <h3>Nouveau mot de passe</h3>

            <span>Veuillez saisir un mot de passe différent de l'ancien.</span>

            <input type="password" placeholder="Mot de passe" name="password1" title="Au moins un chiffre et une lettre majuscule et minuscule, et au moins 5 caractères ou plus." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" />

            <input type="password" placeholder="Confirmez le mot de passe" name="password2" title="Au moins un chiffre et une lettre majuscule et minuscule, et au moins 5 caractères ou plus." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '')" />

            <span style='color: red'><?php echo $error ?></span>
</br>
            <button name="submit-f-newpassword">Connexion</button>

        </form>

    </div>



    <div class="overlay-container">

        <div class="overlay">

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