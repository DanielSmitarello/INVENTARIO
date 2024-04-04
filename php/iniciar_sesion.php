<?php

// Captura (del POST) y almacena los datos en las variables...
$usuario=limpiar_cadena($_POST['login_usuario']);
$usuario=strtolower($usuario);
$clave=limpiar_cadena($_POST['login_clave']);

// Si hay campos vacíos...

if ($usuario=='' || $clave=='') {

    //...imprime un mensaje de error y corta la ejecución del script.
    
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            No has llenado los campos requeridos</div>';
    exit(); 
}

// Validación de formato para el nombre. Si el nombre no cumple con el formato requerido...

if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {

    // ...imprime un mensaje de error y corta la ejecución del script.
    
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El Usuario no coincide con el formato requerido</div>';
    exit();
}

// Validación de formato para el nombre. Si la clave no cumple con el formato requerido...

if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {

    // ...imprime un mensaje de error y corta la ejecución del script.

    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            La Clave no coincide con el formato requerido</div>';
    exit();
}

// // Se realiza la conexión a la base de datos
// $check_usuario = conexion(); // Función que probablemente establece una conexión a la base de datos

// // Se ejecuta una consulta para buscar el usuario en la base de datos
// $check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");

// // Se verifica si se encontró exactamente un registro de usuario

// if ($check_usuario->rowCount() == 1) {

//     // Se obtienen los datos del usuario

//     $check_usuario = $check_usuario->fetch();
    
//     // Se verifica si el nombre de usuario y la contraseña coinciden

//     if ($check_usuario['usuario_usuario'] == $usuario && password_verify($clave, $check_usuario['usuario_clave'])) {

//         // Si las credenciales son correctas, se establece la sesión del usuario

//         $_SESSION['id'] = $check_usuario['usuario_id'];
//         $_SESSION['nombre'] = $check_usuario['usuario_nombre'];
//         $_SESSION['apellido'] = $check_usuario['usuario_apellido'];
//         $_SESSION['usuario'] = $check_usuario['usuario_usuario'];

//         // Se redirige al usuario a la página de inicio
//         if (headers_sent()) {
//             // Si las cabeceras ya se han enviado, se utiliza JavaScript para redirigir
//             print "<script>window.location.href='index.php?vista=home';</script>";
//         } else {
//             // De lo contrario, se utiliza la función header() para redirigir
//             header('Location:index.php?vista=home');
//         }
//     } else {
//         // Si las credenciales son incorrectas, se muestra un mensaje de error y se detiene la ejecución del script
//         print '<div class="notification is-danger is-light">
//                 <strong>Ocurrió un error inesperado!</strong><br>
//                 El Usuario o la clave son incorrectos</div>';
//         exit();
//     }
// } else {
//     // Si no se encontró ningún usuario con el nombre de usuario proporcionado, se muestra un mensaje de error y se detiene la ejecución del script
//     print '<div class="notification is-danger is-light">
//             <strong>Ocurrió un error inesperado!</strong><br>
//             El Usuario ingresado es incorrecto</div>';
// }
// // Se libera la variable para liberar la memoria y cerrar la conexión a la base de datos
// $check_usuario = null;


// Se realiza la conexión a la base de datos

$conexion = conexion(); // Función que probablemente establece una conexión a la base de datos

// Se prepara la consulta SQL con una sentencia preparada

$consulta = $conexion->prepare("SELECT * FROM usuario WHERE usuario_usuario=:usuario");

// Se vincula el parámetro de usuario a la variable $usuario
$consulta->bindParam(':usuario', $usuario);

// Se ejecuta la consulta
$consulta->execute();

// Se obtiene la fila resultante
$check_usuario = $consulta->fetch();

// Se verifica si se encontró exactamente un registro de usuario

if ($consulta->rowCount() == 1) {

    // Se verifica si el nombre de usuario y la contraseña coinciden con los registrados
    
    if ($check_usuario['usuario_usuario'] == $usuario && password_verify($clave, $check_usuario['usuario_clave'])) {
        
        // Si las credenciales son correctas, se establece la sesión del usuario
        
        $_SESSION['id'] = $check_usuario['usuario_id'];
        $_SESSION['nombre'] = $check_usuario['usuario_nombre'];
        $_SESSION['apellido'] = $check_usuario['usuario_apellido'];
        $_SESSION['usuario'] = $check_usuario['usuario_usuario'];

        // Se redirige al usuario a la página de inicio
        
        if (headers_sent()) {

            // Si las cabeceras ya se han enviado, se utiliza JavaScript para redirigir
            
            print "<script>window.location.href='index.php?vista=home';</script>";

        } else {
            
            // De lo contrario, se utiliza la función header() para redirigir
            
            header('Location:index.php?vista=home');

        }
    } else {

        // Si las credenciales son incorrectas, se muestra un mensaje de error y se detiene la ejecución del script
        
        print '<div class="notification is-danger is-light">
                <strong>Ocurrió un error inesperado!</strong><br>
                El Usuario o la clave son incorrectos</div>';
        exit();
    }
} else {

    // Si no se encontró ningún usuario con el nombre de usuario proporcionado, se muestra un mensaje de error y se detiene la ejecución del script
    
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El Usuario ingresado no se encuentra registrado</div>';

}

// Se cierra la conexión

$conexion = null;

?>

