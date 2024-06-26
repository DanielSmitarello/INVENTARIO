<div class="container is-fluid mb-6">
    <h1 class="title">Categoría</h1>
    <h2 class="subtitle">Nueva categoría</h2>
</div>

<div class="container is-fluid pb-6 pt-6">
    <!-- En el archivo ajax.js (linea 73 a 82) se crea el mensaje para que se publique acá-->
    <div class="form-rest mb-6 mt-6"></div>
    
    <form action="./php/categoria_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="categoria_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Ubicación</label>
                    <input class="input" type="text" name="categoria_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,150}" maxlength="150">
                </div>
            </div>
        </div>
        <p class="has-text-centered">
        <button type="submit" class="button is-info  is-rounded">Guardar</button>
        </p>
    </form>
</div>