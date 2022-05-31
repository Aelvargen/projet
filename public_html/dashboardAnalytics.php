<?php

session_start();


require_once('config.php');

if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
} else {
    session_destroy();
?>
    <script type="text/javascript">
        window.location = "https://www.asarra.xyz";
    </script>
<?php
}

$get_current_user = "SELECT * FROM authorized_users WHERE user_email = '$user_email'";

$query_get_current_user = mysqli_query($conn, $get_current_user);

foreach ($query_get_current_user as $row) {
    $username = stripslashes($row['user_username']);
}


require('views/dashboard_analytics.php');
?>