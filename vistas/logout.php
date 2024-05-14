<?php
session_destroy();

if (headers_sent()) {

    // Si las cabeceras ya se han enviado, se utiliza JavaScript para redirigir
    
    echo "<script>window.location.href='index.php?vista=home';</script>";

} else {
    
    // De lo contrario, se utiliza la función header() para redirigir
    
    header('Location:index.php?vista=login');

}
?>