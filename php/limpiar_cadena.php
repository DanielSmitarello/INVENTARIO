<?php

/**
 * Limpia una cadena eliminando contenido potencialmente peligroso como scripts, comandos SQL y caracteres especiales.
 * La función limpiar_cadena() que has proporcionado parece estar diseñada para limpiar una cadena de entrada de posibles amenazas de seguridad y comandos SQL no deseados. Sin embargo, hay algunas redundancias en el código, ya que las líneas para eliminar espacios en blanco y barras invertidas se repiten innecesariamente.
 
 * @param string $cadena La cadena que se va a limpiar.
 * @return string La cadena limpia.
 */


 function limpiar_cadena($cadena)
 {
 
     $cadena = trim($cadena); // Elimina los espacios en blanco al principio y al final de la cadena.
     $cadena = stripslashes($cadena); // Elimina las barras invertidas (\) que puedan haber sido agregadas por una función de escape.
 
     // Elimina contenido potencialmente peligroso, como scripts, comandos SQL(en especial, la inyección de SQL) y caracteres especiales.
     
     $cadena = str_ireplace('<script>', '', $cadena);
     $cadena = str_ireplace('</script>', '', $cadena);
     $cadena = str_ireplace('<script src', '', $cadena);
     $cadena = str_ireplace('<script type=', '', $cadena);
     $cadena = str_ireplace('SELECT * FROM', '', $cadena);
     $cadena = str_ireplace('DELETE FROM', '', $cadena);
     $cadena = str_ireplace('INSERT INTO', '', $cadena);
     $cadena = str_ireplace('DROP TABLE', '', $cadena);
     $cadena = str_ireplace('DROP DATABASE', '', $cadena);
     $cadena = str_ireplace('TRUNCATE TABLE', '', $cadena);
     $cadena = str_ireplace('SHOW TABLES', '', $cadena);
     $cadena = str_ireplace('SHOW DATABASES', '', $cadena);
     $cadena = str_ireplace('<?php', '', $cadena);
     $cadena = str_ireplace('?>', '', $cadena);
     $cadena = str_ireplace('>', '', $cadena);
     $cadena = str_ireplace('--', '', $cadena);
     $cadena = str_ireplace('^', '', $cadena);
     $cadena = str_ireplace('<', '', $cadena);
     $cadena = str_ireplace('[', '', $cadena);
     $cadena = str_ireplace(']', '', $cadena);
     $cadena = str_ireplace('==', '', $cadena);
     $cadena = str_ireplace(';', '', $cadena);
     $cadena = str_ireplace('::', '', $cadena);
 
     $cadena = trim($cadena); // Elimina los espacios en blanco NUEVAMENTE después de las limpiezas.
 
     // Devuelve la cadena limpia.
     return $cadena;
 }
 

?>