<?php

// Se incluye el archivo que contiene funciones importantes, como la función de limpieza de cadenas.
require_once "../php/main.php";

// Se obtienen y limpian los datos del formulario.

$nombre = limpiar_cadena($_POST['usuario_nombre']);
$apellido = limpiar_cadena($_POST['usuario_apellido']);

$usuario = limpiar_cadena($_POST['usuario_usuario']);
$usuario=strtolower($usuario);
$email = limpiar_cadena($_POST['usuario_email']);
$email=strtolower($email);

$password1 = limpiar_cadena($_POST['usuario_clave_1']);
$password2 = limpiar_cadena($_POST['usuario_clave_2']);

// Verifica si algún campo requerido está vacío.
if ($nombre == '' || $apellido == '' || $usuario == '' || $email == '' || $password1 == '' || $password2 == '') {
    // Si hay campos vacíos, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            No has llenado los campos requeridos</div>';
    exit();
}

// Validación de formato para el nombre.
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
    // Si el nombre no cumple con el formato requerido, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El Nombre no coincide con el formato requerido</div>';
    exit();
}

// Validación de formato para el apellido.
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)) {
    // Si el apellido no cumple con el formato requerido, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El Apellido no coincide con el formato requerido</div>';
    exit();
}

// Validación de formato para el nombre de usuario.
if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    // Si el nombre de usuario no cumple con el formato requerido, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El Usuario no coincide con el formato requerido</div>';
    exit();
}

// Validación de formato para las contraseñas.
if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $password1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $password2)) {
    // Si alguna de las contraseñas no cumple con el formato requerido, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            Las Claves no coincide con el formato requerido</div>';
    exit();
}

// Validación de formato para el email.
if ($email != '') {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Si el email no cumple con el formato requerido, imprime un mensaje de error y corta la ejecución del script.
        $check_email = conexion();
        $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
        if ($check_email->rowCount() > 0) {
            print '<div class="notification is-danger is-light">
                    <strong>Ocurrió un error inesperado!</strong><br>
                    El Mail ingresado ya esta registrado en nuestra base de datos, por favor usar otro mail.</div>';
            exit();
        }
        $check_email = null;
    } else {
        print '<div class="notification is-danger is-light">
                <strong>Ocurrió un error inesperado!</strong><br>
                El Mail ingresado no coincide con el formato requerido</div>';
        exit();
    }
}

// Verifica si el nombre de usuario ya existe en la base de datos.
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
if ($check_usuario->rowCount() > 0) {
    // Si el nombre de usuario ya existe, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            El usuario ingresado ya se encuentra registrado en nuestra base de datos.</div>';
    exit();
}
$check_usuario = null;

// Verifica si las contraseñas coinciden.
if ($password1 != $password2) {
    // Si las contraseñas no coinciden, imprime un mensaje de error y corta la ejecución del script.
    print '<div class="notification is-danger is-light">
            <strong>Ocurrió un error inesperado!</strong><br>
            Las claves ingresadas no coinciden, volver a intentarlo</div>';
    exit();
} else {
    // Si las contraseñas coinciden, se genera un hash para la contraseña.

    // Este código toma la variable $password1, que es la contraseña proporcionada por el usuario, y la pasa a la función password_hash(). Esta función toma la contraseña como primer argumento y el algoritmo de hash como segundo argumento (en este caso PASSWORD_BCRYPT, que es uno de los algoritmos más seguros disponibles para PHP). El tercer argumento es un array opcional que puede contener opciones adicionales para el algoritmo de hash. En este caso, se establece el COST de trabajo ("cost") en 10, lo que indica cuántas veces se ejecuta el algoritmo de hash para generar el hash final. Un costo mayor implica una mayor seguridad, pero también puede aumentar el tiempo de procesamiento.
    $password = password_hash($password1, PASSWORD_BCRYPT, ["cost" => 10]);
}

// Se guarda el usuario en la base de datos.
// $guardar_usuario = conexion();
// $guardar_usuario = $guardar_usuario->query("INSERT INTO usuario(usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) VALUES('$nombre','$apellido','$usuario','$password','$email')");

$guardar_usuario = conexion();

$consulta=$guardar_usuario->prepare("INSERT INTO usuario(usuario_nombre, usuario_apellido,usuario_usuario,usuario_clave,usuario_email) VALUES(:nombre,:apellido,:usuario,:pass,:email)");

// $consulta->bindParam(':nombre',$nombre);
// $consulta->bindParam(':apellido',$apellido);
// $consulta->bindParam(':usuario',$usuario);
// $consulta->bindParam(':pass',$password);
// $consulta->bindParam(':email',$email);

// $consulta->execute();

$consulta2=[
    ':nombre'=>$nombre,
    ':apellido'=>$apellido,
    ':usuario'=>$usuario,
    ':pass'=>$password,
    ':email'=>$email
];

$consulta->execute($consulta2);

if ($consulta->rowCount()==1) {
    print '<div class="notification is-info is-light">
            <strong>Usuario registrado</strong><br>
            El usuario se registró con éxito</div>'
            ;
} else {
    print '<div class="notification is-info is-light">
            <strong>Error al registrar</strong><br>
            El usuario no pudo ser registrado con éxito</div>'
            ;
}


$consulta=null;
?>