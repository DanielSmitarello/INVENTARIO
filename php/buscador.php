<?php

// Se obtiene y limpia el valor del parámetro 'modulo_buscador' enviado mediante POST
$modulo_buscador = limpiar_cadena($_POST['modulo_buscador']);

// Array que contiene los posibles valores que puede tener $modulo_buscador
$modulos = ["usuario", "categoria", "producto"];

// Verifica si el valor de $modulo_buscador está presente en el array $modulos
if (in_array($modulo_buscador, $modulos)) {
	
    // Array que mapea cada valor posible de $modulo_buscador a una URL específica
    $modulos_url = [
        "usuario" => "user_search",
        "categoria" => "category_search",
        "producto" => "product_search"
    ];

    // Obtiene la URL correspondiente al valor de $modulo_buscador
    $modulos_url = $modulos_url[$modulo_buscador];

    // Concatena el prefijo "busqueda_" al valor de $modulo_buscador
    $modulo_buscador = "busqueda_" . $modulo_buscador;

    // Iniciar búsqueda
    if (isset($_POST['txt_buscador'])) {

        // Obtiene y limpia el valor del parámetro 'txt_buscador' enviado mediante POST
        $txt = limpiar_cadena($_POST['txt_buscador']);

        // Verifica si $txt está vacío
        if ($txt == "") {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Introduce el término de búsqueda
                </div>
            ';
        } else {
            // Verifica si el formato de $txt es válido
            if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}", $txt)) {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        El término de búsqueda no coincide con el formato solicitado
                    </div>
                ';
            } else {
                // Asigna el valor de $txt a $_SESSION[$modulo_buscador]
                $_SESSION[$modulo_buscador] = $txt;
                // Redirige al usuario a la página correspondiente utilizando la URL almacenada en $modulos_url
                header("Location: index.php?vista=$modulos_url", true, 303); 
                // Detiene la ejecución del script
                exit();  
            }
        }
    }

    // Eliminar búsqueda
    if (isset($_POST['eliminar_buscador'])) {
        // Elimina la variable de sesión correspondiente a $modulo_buscador
        unset($_SESSION[$modulo_buscador]);
        // Redirige al usuario a la página correspondiente utilizando la URL almacenada en $modulos_url
        header("Location: index.php?vista=$modulos_url", true, 303); 
        // Detiene la ejecución del script
        exit();
    }

} else {
    // Muestra un mensaje de error en caso de que $modulo_buscador no sea válido
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos procesar la petición
        </div>
    ';
}

?>
