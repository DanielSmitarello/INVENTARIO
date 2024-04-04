<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "./inc/head.php"; ?>
    </head>
    <body>
        <?php

            // Establecer la vista por defecto si no se proporciona ninguna o está vacía
            if (!isset($_GET['vista']) || $_GET['vista'] == "") {
                $_GET['vista'] = "login";
            }

            // Verificar si la vista solicitada es un archivo existente y no es "login" ni "404"
            if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404") {

                // Verificar si la sesión está iniciada correctamente
                if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "")) {
                    // Si la sesión no está iniciada correctamente, incluir el archivo de cierre de sesión y salir del script
                    include "./vistas/logout.php";
                    exit();
                }

                // Incluir la barra de navegación
                include "./inc/navbar.php";

                // Incluir la vista solicitada
                include "./vistas/" . $_GET['vista'] . ".php";

                // Incluir los scripts necesarios
                include "./inc/script.php";

            } else {
                // Si la vista solicitada es "login", incluir el archivo de inicio de sesión
                // Si no, incluir la página de error 404
                if ($_GET['vista'] == "login") {
                    //Este código PHP gestiona la inclusión dinámica de diferentes vistas en función del parámetro vista proporcionado en la URL.
                    include "./vistas/login.php";
                } else {
                    //También verifica si la sesión está iniciada correctamente antes de cargar cualquier vista que no sea la de inicio de sesión (login) o la de error (404).
                    include "./vistas/404.php";
                }
            }
        ?>
    </body>
</html>
