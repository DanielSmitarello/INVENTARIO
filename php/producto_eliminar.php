<?php

	/*== Almacenando datos ==*/
    // la variable almacena el dato del ID que le llega por medio del GET...
    $product_id_del=limpiar_cadena($_GET['product_id_del']);

    /*== Verificando producto ==*/

    // Establece una conexión a la base de datos y realiza una consulta para verificar la existencia del producto con el ID proporcionado
    $check_producto=conexion(); // Suponiendo que la función conexion() devuelve una conexión a la base de datos
    // La variable $check_producto contendrá el resultado de la consulta. En donde por medio del ID del porudcto se va a seleccionar el porducto que posteriormente se va a eliminar de la BD.
    $check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id_del'");
    
    //Por medio de la condicional se establece que si existe un registro...
    if($check_producto->rowCount()==1){
        
        // Extrae la fila de datos del resultado de la consulta y la almacena en la variable ($datos)...
        $datos=$check_producto->fetch();
    	
        // Establece una conexión a la base de datos y prepara una consulta para eliminar el producto con el ID proporcionado
        $eliminar_producto=conexion(); //concexion que se estableció en ./php/main.php
        // Establecida la conexión: se hace la selección del producto a borrar por medio del ID del producto con el marcador (:id)
        $eliminar_producto=$eliminar_producto->prepare("DELETE FROM producto WHERE producto_id=:id");
        // Se ejecuta el comando para borrarlo de la BD.
        $eliminar_producto->execute([":id"=>$product_id_del]);

        //Si la variable contiene un dato (en este caso eliminado) se imprime por pantalla el mensaje...
        if($eliminar_producto->rowCount()==1){
            //Linea para borrar el archivo foto del directorio... Si contiene archivo en el directorio indicado...
            if (is_file("./img/producto/".$datos['producto_foto'])) {
                //Si existe, cambio los permisos (chmod) a 0777 (escritura, lectura y ejecución) para TODOS los usuarios...
                chmod("./img/producto/".$datos['producto_foto'],0777);
                //Borra (unlink) el archivo especificado en la variable...
                unlink("./img/producto/".$datos['producto_foto']);
            }

            echo '
                <div class="notification is-info is-light">
                    <strong>PRODUCTO ELIMINADO!</strong><br>
                    El producto se eliminó con exito.
                </div>
            ';
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar el producto, por favor intente nuevamente.
                </div>
            ';
        }
        $eliminar_producto=null;

    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRODUCTO que intenta eliminar no existe
            </div>
        ';
    }
    $check_producto=null;