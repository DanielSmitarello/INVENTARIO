<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Lista de productos</h2>
</div>

<div class="container pb-6 pt-6">

    <?php

    require_once "./php/main.php";

    # Eliminar producto #
    
    // Verifica si se ha recibido un valor para 'product_id_del' en la solicitud GET
    if (isset($_GET['product_id_del'])) {
        // Si se ha recibido un valor para 'product_id_del', incluye el archivo "producto_eliminar.php"
        require_once "./php/producto_eliminar.php";
    }

    // Verifica si no se ha recibido un valor para 'page' en la solicitud GET
    if (!isset($_GET['page'])) {
        // Si no se ha recibido ningún valor, establece la página actual como 1
        $pagina = 1;
    } else {
        // Si se ha recibido un valor para 'page' en la solicitud GET, conviértelo a entero
        $pagina = (int) $_GET['page'];
        // Verifica si el valor de la página es menor o igual a 1
        if ($pagina <= 1) {
            // Si es menor o igual a 1, establece la página actual como 1
            $pagina = 1;
        }
    }

    // Verifica si se ha recibido un valor para 'category_id' en la solicitud GET
    // Si se ha recibido, asigna ese valor a la variable $categoria_id, de lo contrario, asigna 0
    $categoria_id=(isset($_GET['category_id'])) ? $_GET['category_id']:0;

    // Limpia la cadena contenida en $pagina utilizando la función limpiar_cadena()
    $pagina = limpiar_cadena($pagina);
    // Establece la URL base para la paginación
    // 'vista' está configurado como 'product_list' y 'page' se reemplazará por el número de página
    $url = "index.php?vista=product_list&page=";
    // Establece el número de registros por página
    $registros = 15;
    // Inicializa la variable de búsqueda como una cadena vacía
    $busqueda = "";

    # Paginador usuario #
    require_once "./php/producto_lista.php";
    ?>
</div>