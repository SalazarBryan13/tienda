<?php
session_start();

# 1.- Obtengo los datos enviados por POST
# 3.- Rediccionarle a la parte privada (Bienvenido!)
if($_POST['usuario'] != "" && $_POST['clave']!= ""){
    // Creo las Sesiones
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['clave'] = $_POST['clave'];
    $recordar = isset($_POST['recordar']) ? $_POST['recordar'] : '';

    // Si el checkbox "Recordarme" está marcado, creamos las cookies
    if($recordar == 'true'){ 
        // Las cookies durarán 30 días
        $expiration_time = time() + (86400 * 30);
    } else {
        // Si no está marcado, eliminamos las cookies si existen
        $expiration_time = time() - 3600; // Expira en el pasado
        setcookie('lang', '',time() - 3600, "/");

    }
    setcookie('c_usuario', $_POST['usuario'], $expiration_time, "/");
    setcookie('c_clave', $_POST['clave'], $expiration_time, "/");
    setcookie('recordar', $recordar, $expiration_time, "/");
    
    
    header("Location:mipanel.php");
} else {
    header("Location:index.php");
}
?>