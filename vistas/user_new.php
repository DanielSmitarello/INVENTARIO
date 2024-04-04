<div class="container is-fluid mb-6">
    <h1 class="title">Usuario</h1>
    <h2 class="subtitle">Nuevo Usuario</h2>
</div>
<div class="container pb-6 mt-6">
    <!-- En el archivo ajax.js (linea 73 a 82) se crea el mensaje para que se publique acá-->
    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/usuario_guardar.php" method="POST" autocomplete="off" class="FormularioAjax">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="usuario_nombre" id="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Apellido</label>
                    <input class="input" type="text" name="usuario_apellido" id="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Usuario</label>
                    <input class="input" type="text" name="usuario_usuario" id="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Email</label>
                    <input class="input" type="email" name="usuario_email" id="usuario_email" maxlength="30" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Clave</label>
                    <input class="input" type="password" name="usuario_clave_1" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Repetir clave</label>
                    <input class="input" type="password" name="usuario_clave_2" id="usuario_clave_2" pattern="[a-zA-Z-0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>