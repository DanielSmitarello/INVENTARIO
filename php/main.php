<?php

// Conexión a la BD inventario...

include_once 'conexion.php';

//Verificar los datos cargados

include_once 'verificar_datos.php';

//EJEMPLO de la funcion verificar_datos...

// $nombre='Carlos';

// if (verificar_datos('[a-zA-Z]{6,10}',$nombre)) {
//     print 'Los datos no coinciden';
// } else {
//     print 'Perfecto! Vamos bien';
// }


//Función para limpiar cadenas de texto...

include_once 'limpiar_cadena.php';

//Función renombrar fotos.

include_once 'renombrar_foto.php';

//Función de paginador de tablas

include_once 'paginador.php';


?>