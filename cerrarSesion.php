<?php
session_start();
session_destroy();

// Elimina correctamente la cookie "lang"
if ($_COOKIE['recordar'] != 'true') {
    setcookie('lang', '', time() - 3600, '/'); // Borra la cookie "lang"
    setcookie("recordar", '', time() - 3600, "/"); // Borra la cookie "recordar"
}

// Obtiene los parámetros de la cookie de sesión
$params = session_get_cookie_params();

// Borra la cookie de sesión 
setcookie(session_name(), '', time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

// Redirecciona a la página principal
header("Location:index.php");
exit();  adicional del código
?>