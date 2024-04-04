<div class="container is-fluid mb-6">
    <h1 class="title">Usuario</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
</div>

<div class="container pb-6 pt-6">

   <?php
    // Se incluye el archivo main.php que contiene funciones y configuraciones generales
    require_once './php/main.php';

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
    $url = 'index.php?vista=user_list&page=';
    
    // Número de registros por página
    $registros = 15;
    
    // Variable de búsqueda (no utilizada en este fragmento de código)
    $busqueda = '';

    // Se incluye el archivo usuario_lista.php que probablemente contiene la lógica para mostrar la lista de usuarios
    require_once './php/usuario_lista.php';
    
?>

</div>