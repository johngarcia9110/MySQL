<?php 

    //clear cookie if any exists

    if( isset( $_COOKIE[ session_name()])){
        setcookie( session_name(), '', time()-86400, '/' );
    }
    //clear all session variables
    session_unset();
    session_destroy();
    echo "You've been logged out. See you next time!<br>";

    //print_r($_SESSION);

    echo "<p><a href='login.php'>Log Back In!</a></p>";


?>