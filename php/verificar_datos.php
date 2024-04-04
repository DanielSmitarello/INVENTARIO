<?php

/**
 * Verifica si una cadena cumple con un filtro dado utilizando una expresión regular.
 *
 * @param string $filtro La expresión regular que define el patrón a cumplir.
 * @param string $cadena La cadena que se va a verificar.
 * @return bool True si la cadena no cumple con el filtro, False si la cadena cumple con el filtro.
 */
function verificar_datos($filtro, $cadena)
{
    // Utiliza preg_match() para verificar si la cadena cumple con el filtro.
    // La función devuelve 1 si hay una coincidencia y 0 si no hay coincidencia.
    // La expresión regular se delimita con delimitadores '/' al principio y al final.
    // El modificador '^' indica que la coincidencia debe ocurrir al principio de la cadena.
    // El modificador '$' indica que la coincidencia debe ocurrir al final de la cadena.
    if (preg_match('/^' . $filtro . '$/', $cadena)) {
        // Si la cadena coincide con el filtro, devuelve false (indicando que los datos son válidos).
        return false;
    } else {
        // Si la cadena no coincide con el filtro, devuelve true (indicando que los datos no son válidos).
        return true;
    }
}

?>