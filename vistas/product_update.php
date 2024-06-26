<div class="containern is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Actualizar porductos</h2>
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
   

    <div class="form-rest mb-6 mt-6"></div>

    <h2 class="title has-text-left"><?php echo $datos['producto_nombre'] ?></h2>
    <form action="./php/producto_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <input type="hidden" name="producto_id" value="<?php echo $datos['producto_id'] ?>" required>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Codigo de barra</label>
                    <input type="text" class="input" name="producto_codigo" value="<?php echo $datos['producto_codigo'] ?>" pattern="[a-zA-Z0-9- ]" maxlength="70" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="producto_nombre" value="<?php echo $datos['producto_nombre'] ?>" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Precio</label>
                    <input class="input" type="text" name="producto_precio" value="<?php echo $datos['producto_precio'] ?>" pattern="[0-9.]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Stock</label>
                    <input class="input" type="text" name="producto_stock" value="<?php echo $datos['producto_stock'] ?>" pattern="[0-9]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <label>Categoría</label><br>
                <div class="select is-rounded">
                    <select name="producto_categoria">
                        <option value="" selected="">Nombre de categoria</option>
                        <?php
                        $categoria=conexion();
                        $categoria=$categoria->query("SELECT * FROM categoria");
                        if($categoria->rowCount()>0){
                            $categoria=$categoria->fetchAll();
                            foreach($categoria as $row){
                                if ($datos['categoria_id']==$row['categoria_id']) {
                                    echo '<option value="'.$row['categoria_id'].'" selected="" >'.$row['categoria_nombre'].' (Actual)</option>';
                                } else {
                                    echo '<option value="'.$row['categoria_id'].'" >'.$row['categoria_nombre'].'</option>';
                                }  
                            }
                        }
                        $categoria=null;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>
    <?php
        } else {
            include_once "./inc/error_alert.php";
        }
        $check_producto=null;
    ?>

</div>