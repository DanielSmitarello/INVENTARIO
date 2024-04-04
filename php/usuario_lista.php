<?php

// $inicio: Esta variable calcula el índice de inicio para la paginación. Si la página es MAYOR a 0, se calcula como el producto de la página y el número de registros por página, menos el número de registros por página. Esto asegura que la paginación comience desde el registro correcto. Si la página es 0 o menos, se establece $inicio en 0, asegurando que la paginación comience desde el primer registro.

// OPERADOR TERNARIO...

//---- condición ----   ?   ------ valor si es verdadero ------ : -valor si es falso-

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// $tabla: Esta variable se utiliza para almacenar el contenido HTML de la tabla que se mostrará en la página. Se inicializa como una cadena vacía.

$tabla = '';

// Ambas variables se utilizan como parte del proceso de generación y visualización de la tabla de usuarios paginada.

// "ESTO ES ÚTIL PARA ASEGURAR QUE EL ÍNDICE DE INICIO PARA LA PAGINACIÓN COMIENCE CORRECTAMENTE."


// Comprobamos si la variable $busqueda está definida y no está vacía
if (isset($busqueda) && $busqueda != '') {
    // Consulta SQL para obtener datos de usuarios filtrados por búsqueda
    $consulta_datos = "SELECT * FROM usuario WHERE ((usuario_id != '".$_SESSION['id']."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio, $registros";

    // Consulta SQL para contar el número total de registros con filtro de búsqueda
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id != '".$_SESSION['id']."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%'))";
} else {
    // Consulta SQL para obtener todos los datos de usuarios sin filtro de búsqueda
    $consulta_datos = "SELECT * FROM usuario WHERE usuario_id != '".$_SESSION['id']."' ORDER BY usuario_nombre ASC LIMIT $inicio, $registros";

    // Consulta SQL para contar el número total de registros sin filtro de búsqueda
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id != '".$_SESSION['id']."'";
}

// Establecer conexión a la base de datos
$conexion = conexion();

// Ejecutar la consulta SQL para obtener los datos de usuarios

//Se realiza una consulta a la base de datos utilizando el objeto de conexión $conexion y la consulta almacenada en la variable $consulta_datos.
$datos = $conexion->query($consulta_datos);
//Los resultados de la consulta se almacenan en la variable $datos utilizando el método fetchAll() del objeto resultado devuelto por $conexion->query($consulta_datos).
$datos = $datos->fetchAll();
//El método fetchAll() DEVUELVE todas las filas resultantes de la consulta como un ARRAY ASOCIATIVO donde cada elemento del array representa una fila de resultados. En este caso, $datos contendrá todas las filas de resultados obtenidas de la consulta a la base de datos.



// Ejecutar la consulta SQL para obtener el número total de registros
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

// Calcular el número total de páginas para la paginación
$Npaginas = ceil($total / $registros);

// Construir la estructura de la tabla HTML
$tabla .= '<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">#</th>
                    <th class="has-text-centered">Nombres</th>
                    <th class="has-text-centered">Apellidos</th>
                    <th class="has-text-centered">Usuario</th>
                    <th class="has-text-centered">Email</th>
                    <th class="has-text-centered" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>';

// Agregar filas de datos a la tabla si hay registros
if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '<tr class="has-text-centered">
                    <td>'.$contador.'</td>
                    <td>'.$rows['usuario_nombre'].'</td>
                    <td>'.$rows['usuario_apellido'].'</td>
                    <td>'.$rows['usuario_usuario'].'</td>
                    <td>'.$rows['usuario_email'].'</td>
                    <td>
                        <a href="index.php?vista=user_update&user_id_up='.$rows['usuario_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&user_id_del='.$rows['usuario_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    // Mostrar mensaje de registros vacíos o recargar listado si hay registros
    if ($total >= 1) {
        $tabla .= '<tr class="has-text-centered">
                    <td colspan="7">
                        <a href="'.$url.'1" class="button is-link is-rounded -is-small mt-4 mb-4">
                            Haga clic aquí para recargar el listado
                        </a>
                    </td>
                </tr>';
    } else {
        $tabla .= '<tr class="has-text-centered">
                    <td colspan="7">
                        No hay registros en el sistema
                    </td>
                </tr>';
    }
}

// Cerrar la estructura de la tabla HTML
$tabla .= '</tbody></table></div>';

// Mostrar resumen de registros mostrados si hay registros
if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando usuario <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un total de <strong>'.$total.'</strong></p>';
}

// Cerrar conexión a la base de datos
$conexion = null;

// Imprimir la tabla resultante
print $tabla;

// Imprimir paginador si hay registros
if ($total >= 1 && $pagina <= $Npaginas) {
    print paginador_tablas($pagina, $Npaginas, $url, 2);
}


?>