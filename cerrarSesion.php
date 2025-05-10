
<?php
session_start();
session_destroy();

// Properly delete the "lang" cookie by setting expiration in the past
// AND specifying the same path as when it was created
if ($_COOKIE['recordar'] != 'true') {
    setcookie('lang', '', time() - 3600, '/');
    setcookie("recordar", '', time() - 3600, "/");

}

$params = session_get_cookie_params();
// Borrar la cookie de sesión estableciéndola en el pasado
setcookie(session_name(), '', time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

header("Location:index.php");
exit(); // Always add exit after redirect to prevent further code execution
?>