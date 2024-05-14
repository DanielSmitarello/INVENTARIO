<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Actualizaar imagen del producto</h2>
</div>

<div class="container pb-6 pt-6">

    <?php

    include_once "./inc/btn_back.php";

    require_once "./php/main.php";

    // Se obtiene el valor del parámetro 'user_id_up' de la URL (viene de producto_lista.php), o se establece en 0 si no está presente
    $id=(isset($_GET['product_id_up'])) ? $_GET['product_id_up'] : 0;
    $id=limpiar_cadena($id);

    $check_producto=conexion();

    $check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$id'");

    if ($check_producto->rowCount()>0) {
        // Si se encontró al menos una categoria, obtener los datos del primera categoria encontrada
        $datos=$check_producto->fetch()

    ?>

    <!-- Un script JavaScript que maneja el evento de clic del botón de regreso -->
    <script type="text/javascript">
        // Selecciona el botón de regreso usando su clase CSS
        let btn_back = document.querySelector(".btn-back");

        // Agrega un event listener para el evento de clic al botón de regreso
        btn_back.addEventListener('click', function(e) {
            // Previene el comportamiento predeterminado del enlace
            e.preventDefault();
            // Navega hacia atrás en el historial del navegador
            window.history.back();
        });
    </script>

        <!-- Mensaje de alerta que se recibe via formaulario Ajax (FormularioAjax) -->
        <div class="form-rest mb-6 mt-6"></div>

        <div class="columns">
            <div class="column is-two-fifths">

                <!-- Eliminar la imagen -->
                
                <?php
                // Comprueba la existe del archivo...
                if (is_file("./img/producto/".$datos['producto_foto'])) {
                ?>

                <figure class="image mb-6">
                    <!-- Si existe la muestra -->
                    <img src="./img/producto/<?php echo $datos['producto_foto'] ?>">
                </figure>

                <!-- Para eliminar, el formulario va a ser enviado (via Ajax, por eso en la clase lo aclaramos) a producto_img_eliminar.php -->
                <form action="./php/producto_img_eliminar.php" class="FormularioAjax" method="POST" autocomplete="off">
                    
                    <!-- este campo de entrada oculto permite enviar el ID de un producto al servidor cuando se envía un formulario, sin que el usuario lo vea o modifique. Esto es útil para enviar datos adicionales junto con el formulario sin interferir con la experiencia del usuario en el sitio web. -->
                    <input type="hidden" name="img_del_id" value="<?php echo $datos['producto_id'] ?>">
                    
                    <p class="has-text-centered">
                        <button type="submit" class="button is-danger is-rounded">Eliminar imagen</button>
                    </p>
                    
                </form>
                
                <!-- Si no existe imagen carga una por defecto -->
                <?php 
                } else { ?>
                    <figure class="image mb-6">
                        <img src="./img/producto.png" alt="">
                    </figure>
                <?php 
                }

                ?>
               
            </div>
            <div class="column">
                <form action="./php/producto_img_actualizar.php" class="mb-6 has-text-centered FormaularioAjax" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <h4 class="title is-4 mb-6"><?php echo $datos['producto_nombre'] ?></h4>
                    <label><?php echo $datos['producto_foto'] ?></label><br>

                    <input type="hidden" name="img_up_id" value="<?php echo $datos['producto_id'] ?>">
                    
                    <div class="file has-name is-horizontal is-justify-content-center mb-6">
                        <label class="file-label">
                            <span class="file-cta">
                                <span class="file-label">Imagen</span>
                            </span>
                            <span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
                        </label>
                    </div>
                    <p class="has-text-centered">
                        <button type="submit" class="button is-succes is-rounded">Actualizar</button>
                    </p>
                </form>
            </div>
        </div>
        
        <?php

        } else {
            include_once "./inc/error_alert.php";
        }
        $check_producto=null;
        
        ?>
</div>
