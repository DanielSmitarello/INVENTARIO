<?php

/** La función paginador_tablas() que has proporcionado parece generar un paginador para tablas HTML. Aquí está la descripción de lo que hace:
 *
 *Toma cuatro parámetros:
 *@param int $pagina La página actual.
 *@param int $pagina_totales El total de páginas.
 *$url: La URL base para los enlaces de paginación.
 *$botones: El número de botones de paginación que se mostrarán a la vez.
 *Crea un contenedor <nav> con clases CSS para estilizar el paginador.
 *Verifica si la página actual es menor o igual a 1. Si lo es, añade un enlace "Anterior" deshabilitado. De lo contrario, añade un enlace *"Anterior" que lleva a la página anterior.
 *Retorna el código HTML generado como una cadena.*/

/**
 * Genera un paginador para tablas HTML.
 * 
 * @param string $url La URL base para los enlaces de paginación.
 * @param int $botones El número de botones de paginación que se mostrarán a la vez.
 * @return string El código HTML del paginador.
 */

# Funcion paginador de tablas #
function paginador_tablas($pagina, $Npaginas, $url, $botones){
    // Inicialización de la variable $tabla que contendrá el código HTML del paginador
    $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

    // Verificar si la página actual es la primera
    if($pagina <= 1){
        // Si es la primera página, se deshabilita el botón "Anterior"
        $tabla .= '<a class="pagination-previous is-disabled" disabled>Anterior</a>';
        // Se inicia la lista de páginas
        $tabla .= '<ul class="pagination-list">';
    } else {
        // Si no es la primera página, se crea el enlace "Anterior" que apunta a la página anterior
        $tabla .= '<a class="pagination-previous" href="'.$url.($pagina-1).'">Anterior</a>';
        // Se inicia la lista de páginas, incluyendo el enlace a la página 1 y un indicador de elipsis
        $tabla .= '<ul class="pagination-list"><li><a class="pagination-link" href="'.$url.'1">1</a></li><li><span class="pagination-ellipsis">&hellip;</span></li>';
    }

    // Inicialización de contador de botones mostrados
    $ci = 0;
    // Bucle para mostrar los botones de las páginas
    for($i = $pagina; $i <= $Npaginas; $i++){
        // Si se han mostrado todos los botones requeridos, se sale del bucle
        if($ci >= $botones){
            break;
        }
        // Si es la página actual, se muestra como enlace activo
        if($pagina == $i){
            $tabla .= '<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
        } else {
            // Si no es la página actual, se muestra como enlace normal
            $tabla .= '<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
        }
        // Incrementar contador de botones mostrados
        $ci++;
    }

    // Verificar si la página actual es la última
    if($pagina == $Npaginas){
        // Si es la última página, se deshabilita el botón "Siguiente"
        $tabla .= '</ul><a class="pagination-next is-disabled" disabled>Siguiente</a>';
    } else {
        // Si no es la última página, se crea el enlace "Siguiente" que apunta a la página siguiente
        $tabla .= '<li><span class="pagination-ellipsis">&hellip;</span></li><li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li></ul><a class="pagination-next" href="'.$url.($pagina+1).'">Siguiente</a>';
    }

    // Cierre de la estructura HTML del paginador
    $tabla .= '</nav>';
    // Se devuelve el código HTML del paginador
    return $tabla;
}

?>