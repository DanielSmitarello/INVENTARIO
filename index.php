<?php
// Inicia la sesión (session_start.php es responsable de iniciar la sesión)
require "./inc/session_start.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Incluye el archivo de encabezado (head.php) que probablemente contenga metadatos, enlaces a estilos CSS, etc.
    include './inc/head.php';
    ?>
</head>

<body>

    <?php
    // Verifica si la variable GET 'vista' no está establecida o está vacía
    if (!isset($_GET['vista']) || $_GET['vista'] == '') {
        // Si no está establecida o está vacía, se establece la vista predeterminada como 'login'
        $_GET['vista'] = 'login';
    }

    // Verifica si el archivo correspondiente a la vista especificada existe y si la vista no es 'login' ni '404'
    if (is_file('./vistas/' . $_GET['vista'] . '.php') && $_GET['vista'] != 'login' && $_GET['vista'] != '404') {
        // Si la vista existe y no es 'login' ni '404', se incluyen el archivo de la barra de navegación (navbar.php),
        // el archivo de la vista específica y el archivo de scripts (script.php)
        // Verifica si las variables de sesión 'id' y 'usuario' no están establecidas o están vacías
        if ((!isset($_SESSION['id']) || $_SESSION['id']=='') || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=='')) {
          include "./vistas/logout.php";
          exit();  
        };

        include "./inc/navbar.php";
        include "./vistas/".$_GET['vista'].".php"; // Aquí había un error, faltaba un punto (.) para concatenar y un .php al final
        include "./inc/script.php";
    } else {
        // Si la vista no existe o es 'login' o '404', se maneja de acuerdo a su valor
        if ($_GET['vista'] == 'login') {
            // Si la vista es 'login', se incluye el archivo de la vista de inicio de sesión (login.php)
            include "./vistas/login.php";
        } else {
            // Si la vista no es 'login', se incluye el archivo de la vista de error 404 (404.php)
            include "./vistas/404.php";
        }
    }
    ?>

</body>

</html>
