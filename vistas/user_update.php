<?php

require_once "./php/main.php";
// Se obtiene el valor del parámetro 'user_id_up' de la URL, o se establece en 0 si no está presente
$id=(isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
$id=limpiar_cadena($id);

?>

<div class="container is-fluid mb-6">
    <?php 
    if ($id==$_SESSION['id']) {
    ?>
    <h1 class="title">La cuenta de
        <?php

        // Capitalize the first letter and print
        print ucfirst($_SESSION['usuario']);

        ?>
    </h1>
    <h2 class="subtitle">Actualizar datos de cuenta</h2>
    <?php
    }else{
    ?>
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Actualizar usuarios</h2>
    <?php 
    }
    ?>
</div>
<div class="container pb-6 pt-6">
    <?php

        include_once "./inc/btn_back.php";

        $check_usuario=conexion();
        
        $check_usuario=$check_usuario->query("SELECT * FROM USUARIO WHERE usuario_id='$id'");

        if ($check_usuario->rowCount()>0) {
            // Si se encontró al menos un usuario, obtener los datos del primer usuario encontrado
            $datos=$check_usuario->fetch()

    ?>
    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete='off'>
        
        <!-- Este campo es necesario para enviar el ID del usuario junto con otros datos del formulario al procesar el envío del formulario en el lado del servidor. -->

        <input type="hidden" name="usuario_id" value="<?php print $datos['usuario_id']?>" id="usuario_id" required>
        <div class="columns">
            <div class="column">
                <label>Nombres</label>
                
                <!-- Esta variable asegura que el campo se rellene automáticamente con el nombre de usuario existente cuando se carga el formulario para actualizar la información del usuario. -->

                <input type="text" class="input" name="usuario_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php print $datos['usuario_nombre']?>">
            </div>

            <div class="column">
                <label>Apellido</label>
                <input type="text" class="input" name="usuario_apellido" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php print $datos['usuario_apellido']?>">
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label>Usuario</label>
                <input type="text" class="input" name="usuario_usuario" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php print $datos['usuario_usuario']?>">
            </div>
       
            <div class="column">
                <label>Email</label>
                <input type="email" class="input" name="usuario_email" maxlength="70" required value="<?php print $datos['usuario_email']?>">
            </div>
        </div>
        <br><br>
        <p class="has-text-centered">
            Si desea actualizar la clave de este usuario por favor rellene los dos campos, sino desea actualizarla dejelos vacios...
        </p>
        <br>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Clave</label>
                    <input type="password" class="input" name="usuario_clave_1" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@$.-]{7,100}" maxlength="100" >
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Repetir Clave</label>
                    <input type="password" class="input" name="usuario_clave_2" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@$.-]{7,100}" maxlength="100" >
                </div>
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
        $check_usuario=null;
    ?>
</div>