<?php

//La función renombrar_fotos() esta diseñada para renombrar un nombre de archivo de imagen, reemplazando ciertos caracteres especiales por
//guiones bajos (_) y agregando un número aleatorio al final del nombre para evitar conflictos de nombres de archivo.

/**
 * Renombra un nombre de archivo de imagen.
 *
 * @param string $nombre El nombre de archivo de imagen original.
 * @return string El nombre de archivo de imagen renombrado.
 */
function renombrar_fotos($nombre)
{
    // Reemplaza los caracteres especiales por guiones bajos.
    $nombre = str_ireplace('', '_', $nombre);
    $nombre = str_ireplace('/', '_', $nombre);
    $nombre = str_ireplace('#', '_', $nombre);
    $nombre = str_ireplace('-', '_', $nombre);
    $nombre = str_ireplace('.', '_', $nombre);
    $nombre = str_ireplace(',', '_', $nombre);

    // Agrega un número aleatorio al final del nombre.
    $nombre = $nombre . '_' . rand(0, 100);

    // Retorna el nombre de archivo de imagen renombrado.
    return $nombre;
}

?>