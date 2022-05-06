<?php
    session_start();
    if (!isset($_SESSION['email']) or !($_SESSION['isAdmin'])) {
        header('Location: index.php');
    }
    echo "admin page";
?>