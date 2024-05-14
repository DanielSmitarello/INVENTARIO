<?php
require_once "main.php";

$product_id=limpiar_cadena($_POST['img_del_id']);

// Comprobamos que exista el producto
$check_producto=conexion();
$check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id'");


if ($check_producto->rowCount()==1) {
    // Si existe el producto lo pasamos a un array fetch.
    $datos=$check_producto->fetch();

}else{
    // Sino existe el producto nos avisa
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            La imagen del porducto que intenta eliminar no existe
        </div>
    ';
    exit();
}
// Cerramos la conexión para ahorrar memoria.
$check_producto=null;

// Definimos ruta y permisos del directorio de imagenes a trabajar...
$img_dir="../img/producto/";
chmod($img_dir,0777);

// Comprobamos que exista el archivo en el sistema...
if (is_file($img_dir.$datos['producto_foto'])) {
    // Otorgamos los paermisos correspondientes a los usuarios
    chmod($img_dir.$datos['producto_foto'],0777);
    // Si da error (FALSE) al eliminar el archivo, entra en la condición...
    if (!unlink($img_dir.$datos['producto_foto'])){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA IMAGEN que intenta eliminar no se pudo eliminar del sistema.
                Intente nuevamente...
            </div>
        ';
        exit();
    };
}

$actualizar_producto=conexion();
// Usamos prepare para evitar injección de codigo malicioso. NO OLVIDAR usar categoria_id=:categoria (ID de la categoría)...
// porque sino no funciona!
$actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_foto=:foto WHERE producto_id=:id");

$marcadores=[
    ":foto"=>"",
    ":id"=>$datos['producto_id']
];

if($actualizar_producto->execute($marcadores)){
    echo '
        <div class="notification is-info is-light">
            <strong>¡IMAGEN ELIMINADA!</strong><br>
            La IMAGEN del producto fue eliminada con éxito, 
            pulse ACEPTAR para que se recarguen los cambios...
            <p class="has-text-centered pt-5 pb-5">
                <a href="index.php?vista=product_img&product_id_up='.$datos['producto_id'].'" class="button is-link is-rounded">Aceptar</a>
            </p>
        </div>
    ';
} else {
    echo '
        <div class="notification is-warning is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El archivo fue eliminado pulse ACEPTAR para que se recarguen los cambios...
            <p class="has-text-centered pt-5 pb-5">
                <a href="index.php?vista=product_img&product_id_up='.$datos['producto_id'].'" class="button is-link is-rounded">Aceptar</a>
            </p>
        </div>
    ';
}
$actualizar_producto=null;

?>