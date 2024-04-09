<?php
require_once 'main.php';

/*== Almacenando datos ==*/
$nombre=limpiar_cadena($_POST['categoria_nombre']);
$ubicacion=limpiar_cadena($_POST['categoria_ubicacion']);

/*== Verificando campos obligatorios ==*/
if($nombre==""){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

 /*== Verificando integridad de los datos ==*/
 if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El NOMBRE no coincide con el formato solicitado
        </div>
    ';
    exit();
}

//Ubicación es un campo opcional
// Verifica si la variable $ubicacion no está vacía

if ($ubicacion!=="") {

    // Llama a la función verificar_datos() para validar $ubicacion contra un patrón regex

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,150}",$ubicacion)){
    
    // Si $ubicacion no coincide con el patrón, muestra un mensaje de error
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            La UBICACIÓN no coincide con el formato solicitado
        </div>
    ';
    exit();
    }
}

 /*== Verificando nombre ==*/
 // Conexión a la base de datos
$check_nombre = conexion();

// Ejecuta una consulta para verificar si el nombre ya existe en la tabla 'categoria'
$check_nombre = $check_nombre->query("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");

// Si el resultado de la consulta contiene al menos una fila (el nombre ya existe)
if ($check_nombre->rowCount() > 0) {
    // Muestra un mensaje de error
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El NOMBRE ingresado ya está registrado, por favor elija otro.
        </div>
    ';
    // Termina el script
    exit();
}

// Cierra la conexión a la base de datos para liberar recursos
$check_nombre = null;


 /*== Guardando datos ==*/
 $guardar_categoria=conexion();
 $guardar_categoria=$guardar_categoria->prepare("INSERT INTO categoria(categoria_nombre,categoria_ubicacion) VALUES(:nombre,:ubicacion)");

 $marcadores=[
    ":nombre"=>$nombre,
    ":ubicacion"=>$ubicacion
];

$guardar_categoria->execute($marcadores);

if($guardar_categoria->rowCount()==1){
    echo '
        <div class="notification is-info is-light">
            <strong>¡CATEGOÍA REGISTRADa!</strong><br>
            La categoría se registró con exito
        </div>
    ';
}else{
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo registrar la categoría ingresada, por favor intente nuevamente
        </div>
    ';
}
$guardar_categoria=null;


?>