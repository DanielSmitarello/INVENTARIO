<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Buscar producto</h2>
</div>

<div class="container pb-6 pt-6">

    <?php
        require_once "./php/main.php";

        // Verifica si se ha enviado un formulario con el nombre de módulo 'modulo_buscador' mediante el método POST
        if (isset($_POST['modulo_buscador'])) {
            // Si se ha enviado el formulario, incluye y ejecuta el archivo "buscador.php"
            require_once "./php/buscador.php";
        }
        
        // Verifica si la variable de sesión 'busqueda_producto' no está definida o está vacía
        if (!isset($_SESSION['busqueda_producto']) && empty($_SESSION['busqueda_producto'])) {
            // Si la variable de sesión no está definida o está vacía, ejecuta el siguiente bloque de código
    ?>

    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="producto">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="Qué producto estas buscando?" pattern="[a-z-A-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit">Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="producto">
                <input type="hidden" name="eliminar_buscador" value="producto">
                <!-- Por medio de ´sta linea se imprime por pantalla lo que se esta buscando -->
                <p>Estas buscando <strong>"<?php echo $_SESSION['busqueda_producto']; ?>"</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar</button>
            </form>
        </div>
    </div>


    <?php
        //eliminar el producto
        if (isset($_GET['product_id_del'])) {
            require_once "./php/producto_eliminar.php";
        }

        if (!isset($_GET['page'])) {
            $pagina=1;
        }else{
            $pagina=(int)$_GET['page'];
            if ($pagina<=1) {
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=product_search&page=";
        $registros=15;
        $busqueda=$_SESSION['busqueda_producto'];

        //paginador producto
        require_once "./php/producto_lista.php";
    }    
    ?>

</div>