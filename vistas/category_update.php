<?php

require_once "./php/main.php";
// Se obtiene el valor del parámetro 'user_id_up' de la URL, o se establece en 0 si no está presente
$id=(isset($_GET['category_id_up'])) ? $_GET['category_id_up'] : 0;
$id=limpiar_cadena($id);

?>

<div class="container is-fluid mb-6">
    <?php 
    if ($id==$_SESSION['id']) {
    ?>
    <h1 class="title">La cuenta de
        <?php

        // Capitalize the first letter and print
        echo ucfirst($_SESSION['usuario']);

        ?>
    </h1>
    <h2 class="subtitle">Actualizar datos de cuenta</h2>
    <?php
    }else{
    ?>
    <h1 class="title">Categoria</h1>
    <h2 class="subtitle">Actualizar categorias</h2>
    <?php 
    }
    ?>
</div>
<div class="container pb-6 pt-6">
    <?php

        include_once "./inc/btn_back.php";

        $check_categoria=conexion();
        
        $check_categoria=$check_categoria->query("SELECT * FROM categoria WHERE categoria_id='$id'");

        if ($check_categoria->rowCount()>0) {
            // Si se encontró al menos una categoria, obtener los datos del primera categoria encontrada
            $datos=$check_categoria->fetch()

    ?>
    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/categoria_actualizar.php" method="POST" class="FormularioAjax" autocomplete='off'>
        
        <!-- Este campo es necesario para enviar el ID de la categoria junto con otros datos del formulario al procesar el envío del formulario en el lado del servidor. -->

        <input type="hidden" name="categoria_id" value="<?php echo $datos['categoria_id']?>" id="categoria_id" required>
        <div class="columns">
            <div class="column">
                <label>Nombre de la categoría</label>
                
                <!-- Esta variable asegura que el campo se rellene automáticamente con el nombre de la categoría existente cuando se carga el formulario para actualizar la información del usuario. -->

                <input type="text" class="input" name="categoria_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['categoria_nombre']?>">
            </div>

            <div class="column">
                <label>Ubicación</label>
                <input type="text" class="input" name="categoria_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,150}" maxlength="150" value="<?php echo $datos['categoria_ubicacion']?>">
            </div>
        </div>
       
        <br><br>
        <p class="has-text-centered is-rounded">
            Para poder actualizar los datos de este usuario, por favor, ingresar usuario y clave con el que inició la sesión...
        </p>
        <br>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Usuario</label>
                    <input type="text" class="input" name="administrador_usuario" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9ñÑ ]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Clave</label>
                    <input type="password" class="input" name="administrador_clave" pattern="[a-zA-Z0-9@$.-]{7,100}" maxlength="100" required>
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>
    <?php
        } else {
            include_once "./inc/error_alert.php";
        }
        $check_categoria=null;
    ?>
</div>