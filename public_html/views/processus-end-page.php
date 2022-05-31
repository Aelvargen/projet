<?php include('anchors/header.php'); ?>





<div class="container" id="container">



    <div class="form-container sign-in-container">



        <form action="" method="POST">







            <h3><?php echo $title ?></h3>

            <span><?php echo $message ?></span>

            <h3></h3>

            <a href="https://www.asarra.xyz/index.php"><?php echo $button_text ?></a>



        </form>

    </div>





</div>





<script>

    const quitButton = document.getElementById('quit-button');



    quitButton.addEventListener('click', () => {

        window.location = "https://www.asarra.xyz/index.php";



    });

</script>

<?php include('anchors/footer.php'); ?>