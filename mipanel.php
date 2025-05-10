<?php
session_start();
// Restricción de acceso
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"] == ""){
    header("Location:index.php");
    exit();
}
// Determinar el idioma

// Determinar el idioma
if (isset($_GET['lang'])) {
    $language = $_GET['lang'];
    // Solo guardar la cookie 'lang' si el usuario marcó "Recordarme"
    if (isset($_COOKIE['recordar']) && $_COOKIE['recordar'] === 'true') {
        setcookie('lang', $language, time() + (86400 * 30), "/");
    }
} elseif (isset($_COOKIE['lang']) && isset($_COOKIE['recordar']) && $_COOKIE['recordar'] === 'true') {
    // Usar la cookie 'lang' solo si existe y si "Recordarme" está marcado
    $language = $_COOKIE['lang'];
} else {
    $language = 'es'; // Idioma por defecto
}


// Leer categorías según el idioma
$categories_file = "datos/categorias_{$language}.txt";
$categorias = [];
if (file_exists($categories_file)) {
    $categorias = file($categories_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $categorias = array_map('trim', array_map(function($item) {
        return rtrim($item, ',');
    }, $categorias));
} else {
    $categorias = [$language === 'es' ? 'No hay categorías disponibles' : 'No categories available'];
}

$palabras_clave = [
    'es' => [
        'español' => 'Español',
        'Cambiar idioma' => 'Cambiar idioma',
        'panel' => 'Panel Principal',
        'bienvenido' => 'Bienvenido usuario:',
        'usuario' => 'Usuario',
        'cerrar_sesion' => 'Cerrar Sesión',
        'idioma' => 'Idioma',
        'categorias' => 'Lista de Productos',
        'ingles' => 'Ingles'
    ],
    'en' => [
        'español' => 'Spanish',
        'ingles' => 'English',
        'Cambiar idioma' => 'Change Language',
        'panel' => 'Main Panel',
        'bienvenido' => 'Welcome user:',
        'usuario' => 'User',
        'cerrar_sesion' => 'Log Out',
        'idioma' => 'Language',
        'categorias' => 'Product List'  
    ]
];
?>



<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras_clave[$language]['bienvenido'];  ?> <?php echo htmlspecialchars($_SESSION["usuario"]); ?></title>    <style>
        /* Estilo para que las categorías parezcan clickeables */
        .clickable {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            display: inline-block;
            margin: 5px 0;
        }
        .clickable:hover {
            color: darkblue;
            text-decoration: none;
        }
        li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
     <header>
        <h1><?php echo $palabras_clave[$language]['panel']; ?></h1>
        <h2><?php echo $palabras_clave[$language]['bienvenido']; ?> <?php echo htmlspecialchars($_SESSION["usuario"]); ?></h1>
    </header>
    
    <p>
        <?php echo $palabras_clave[$language]['Cambiar idioma']; ?>: 
        <a href="mipanel.php?lang=es"><?php echo $palabras_clave[$language]['español']; ?></a> | 
        <a href="mipanel.php?lang=en"><?php echo $palabras_clave[$language]['ingles']; ?></a>
        <br>
        <a href="cerrarSesion.php"><?php echo $palabras_clave[$language]['cerrar_sesion']; ?></a>
    </p>
    <hr>
    <h2><?php echo $palabras_clave[$language]['categorias']; ?></h2>
    <ul>
        <?php foreach ($categorias as $category): ?>
            <li>
                <span class="clickable"><?php echo htmlspecialchars($category); ?></span>
            </li>       
             <?php endforeach; ?>
    </ul>
    <footer></footer>
    
</body>
</html>