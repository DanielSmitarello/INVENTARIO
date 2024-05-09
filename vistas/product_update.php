<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
        // Se obtiene el valor del parámetro 'product_id_up' de la URL, o se establece en 0 si no está presente
        $id=(isset($_GET['product_id_up'])) ? $_GET['product_id_up'] : 0;
        $id=limpiar_cadena($id);
	?>

	<div class="form-rest mb-6 mt-6">
        <?php 
            if ($id==$_SESSION['id']) {
            ?>
            <h1 class="title">La cuenta de
                <?php

                // Capitalize the first letter and print
                print ucfirst($_SESSION['usuario']);

                ?>
            </h1>
            <h2 class="subtitle">Actualizar datos de producto</h2>
            <?php
            }else{
            ?>
            <h1 class="title">Producto</h1>
            <h2 class="subtitle">Actualizar Producto</h2>
            <?php 
            }
        ?>
    </div>
    <?php

        include_once "./inc/btn_back.php";

        $check_producto=conexion();
        
        $check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$id'");

        if ($check_producto->rowCount()>0) {
            // Si se encontró al menos un producto, obtiene los datos del primer producto encontrado
            $datos=$check_producto->fetch()

    ?>
    <div class="form-rest mb-6 mt-6"></div>
        


	<form action="./php/producto_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >

        <input type="hidden" name="producto_id" value="<?php print $datos['producto_id']?>" id="producto_id" required>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra</label>
				  	<input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" value="<?php print $datos['producto_codigo']; ?>" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre del Producto</label>
				  	<input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" value="<?php print $datos['producto_nombre'] ?>" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="producto_precio" pattern="[0-9.]{1,25}" maxlength="25" value="<?php print $datos['producto_precio']?>" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
				  	<input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" value="<?php print $datos['producto_stock']; ?>" required >
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select">
				  	<select name="producto_categoria" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
    						$categoria=conexion();
                            // Ejecuta una consulta para seleccionar todas las filas de la tabla 'categoria'
    						$categoria=$categoria->query("SELECT * FROM categoria");
                            // Verifica si la consulta devuelve alguna fila
    						if($categoria->rowCount()>0){
                                 // Si hay filas, obtén todas las filas como un array
    							$categoria=$categoria->fetchAll();
                                // Itera sobre cada fila del resultado
    							foreach($categoria as $row){
                                    // Comprueba si el ID de la categoría actual coincide con el ID de la categoría en los datos
                                    if ($datos['categoria_id']==$row['categoria_id']){
                                        // Si coincide, imprime una opción seleccionada con 'Actual' para mostrar que es la categoría actual
                                        print '<option value="'.$row['categoria_id'].'" selected="" >'.$row['categoria_nombre'].' (Actual)<?option>';
                                    } else {
                                        // Si no coincide, imprime una opción normal
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
              <br><br>
        <p class="has-text-centered is-rounded">
            Para poder actualizar los datos de este usuario, por favor, ingresar usuario y clave con el que inició la sesión...
        </p>
        <br>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Usuario</label>
                    <input type="text" class="input" name="administrador_usuario" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9ñÑ ]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Clave</label>
                    <input type="password" class="input" name="administrador_clave" pattern="[a-zA-Z0-9@$.-]{7,100}" maxlength="100" required>
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
        $check_usuario=null;
    ?>
</div>