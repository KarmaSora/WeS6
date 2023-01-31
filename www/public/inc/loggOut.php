<?php
    session_start();

    $_SESSION = array(); // Tömmer sessionsarrayen    
    session_destroy();
    
    header("Location: ../index.php");
?>