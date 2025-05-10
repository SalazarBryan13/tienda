<?php
session_start();
session_destroy();

// Elimina correctamente la cookie "lang"
if ($_COOKIE['recordar'] != 'true') {
    setcookie('lang', '', time() - 3600, '/'); // Borra la cookie "lang"
    setcookie("recordar", '', time() - 3600, "/"); // Borra la cookie "recordar"
}



// Redirecciona a la página principal
header("Location:index.php");
?>