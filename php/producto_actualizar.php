<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

    /*== Almacenando id ==*/

    $id=limpiar_cadena($_POST['producto_id']);
    
    /*== Verificando categoria ==*/
	$check_producto=conexion();
	$check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$id'");

    if($check_producto->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto no existe en el sistema
            </div>
        ';
        exit();
    }else{
        //Array de dato por medio del fetch...
    	$datos=$check_producto->fetch();
    }
    $check_producto=null;
    
    /*== Almacenando datos ==*/
    
    $codigo=limpiar_cadena($_POST['producto_codigo']);
    $nombre=limpiar_cadena($_POST['producto_nombre']);

    $precio=limpiar_cadena($_POST['producto_precio']);
    $stock=limpiar_cadena($_POST['producto_stock']);
    $categoria=limpiar_cadena($_POST['producto_categoria']);

    
     /*== Verificando campos obligatorios del producto ==*/

     if($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $categoria==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos (categoría) ==*/

    if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CÓDIGO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9.]{1,25}",$precio)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRECIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$stock)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El STOCK no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    
    /*== Verificando codigo ==*/

    // Este bloque de código verifica si un código de barras dado es diferente al código de barras de un producto existente en la base de datos. Si es diferente y el código de barras no está duplicado, el script continúa ejecutándose. Si es igual o si el código de barras está duplicado, se muestra un mensaje de error y el script se detiene.

    //Compara el valor de la variable $codigo con el valor de la clave 'producto_codigo' en el array $datos. La comparación verifica si el código es diferente al código de producto almacenado en los datos. Si son diferentes, continúa con la siguiente acción. Si son iguales, no se ejecuta nada más dentro de este bloque.
    if ($codigo!=$datos['producto_codigo']) {

        $check_codigo=conexion();
        // Si los códigos son diferentes, se establece una conexión a la base de datos llamando a la función conexion(). Luego, se ejecuta una consulta SQL para verificar si el código de producto (producto_codigo) ya existe en la base de datos.
        $check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
        if($check_codigo->rowCount()>0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
                </div>
            ';
            //  El script se detiene usando exit() para evitar que se ejecute más código.
            exit();
        }
        $check_codigo=null;
    }

    
    /*== Verificando nombre ==*/
    
    if ($nombre!=$datos['producto_nombre']) {
        $check_nombre=conexion();
        $check_nombre=$check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
        if($check_nombre->rowCount()>0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
                </div>
            ';
            exit();
        }
        $check_nombre=null;
    }

    

    /*== Verificando categoria ==*/
    if($categoria!=$datos['categoria_id']){
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La categoría seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;
    }
    
    /*== Actualizar datos de la categoría ==*/


    $actualizar_producto=conexion();
    // Usamos prepare para evitar injección de codigo malicioso. NO OLVIDAR usar categoria_id=:categoria (ID de la categoría)... porque sino no funciona!
    $actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_codigo=:codigo,producto_nombre=:nombre,producto_precio=:precio,producto_stock=:stock, categoria_id=:categoria WHERE producto_id=:id");

    $marcadores=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":categoria"=>$categoria,
        ":id"=>$id
    ];
   
    if($actualizar_producto->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO ACTUALIZADO!</strong><br>
                El producto se actualizó con exito.
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el producto, por favor intente nuevamente.
            </div>
        ';
    }
    
    $actualizar_producto=null;


    /*== ---------------------------------------------------------------------------------------------------- ==*/