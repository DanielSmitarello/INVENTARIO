<div class="container is-fluid mb-6">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Buscar usuarios</h2>
</div>

<div class="container pb-6 pt-6">
    <?php

    require_once "./php/main.php";

    if (isset($_POST['modulo_buscador'])) {
        require_once "./php/buscador.php";
    }

    if (!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="usuario" id="modulo_buscador">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" id="txt_buscador" placeholder="Qué desea buscar?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                    </p>
                    <p class="control">
                        <button class="button is-info is-rounded" type="submit">Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php
    }else{
    ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="usuario">
                <input type="hidden" name="eliminar_buscador" value="usuario">
                <p>Estas buscando <strong>"<?php print $_SESSION['busqueda_usuario']; ?>"</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
   
    <?php

     // Verifica si el parámetro 'page' está definido en la URL
     if (!isset($_GET['page'])) {
        // Si no está definido, establece la página en 1 por defecto
        $pagina = 1;
    } else {
        // Si está definido, convierte el valor a un entero
        $pagina = (int)$_GET['page'];
        // Si la página es menor o igual a 1, la establece en 1 para evitar valores negativos o cero
        if ($pagina <= 1) {
            $pagina = 1;
        }
    }
    
    // Limpia la cadena de la variable $pagina para asegurar que sea segura para su uso
    $pagina = limpiar_cadena($pagina);
    
    // URL base para la paginación
    $url = 'index.php?vista=user_search&page=';
    
    // Número de registros por página
    $registros = 15;
    
    // Variable de búsqueda (no utilizada en este fragmento de código)
    $busqueda=$_SESSION['busqueda_usuario'];

    // Se incluye el archivo usuario_lista.php que probablemente contiene la lógica para mostrar la lista de usuarios
    require_once './php/usuario_lista.php';
    }
    ?>
    
</div>