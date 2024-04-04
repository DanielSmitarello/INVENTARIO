<nav class="navbar" role="navigation" aria-label="main navigation">
    <!-- Contenedor de la marca y el botón de hamburguesa -->
    <div class="navbar-brand">
        <!-- Enlace con el logotipo -->
        <a class="navbar-item" href="index.php?vista=home">
            <img src="./img/logo.png" width="65" height="38">
        </a>
        <!-- Botón de hamburguesa para dispositivos móviles -->
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <!-- Iconos de la hamburguesa -->
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <!-- Menú de navegación -->
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <!-- Elemento de menú desplegable "Usuarios" -->
            <div class="navbar-item has-dropdown is-hoverable">
                <!-- Enlace de menú "Usuarios" -->
                <a class="navbar-link">
                    Usuarios
                </a>
                <!-- Contenido desplegable del menú de "Usuarios" -->
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=user_new">
                        Nuevo
                    </a>
                    <a class="navbar-item" href="index.php?vista=user_list">
                        Lista
                    </a>
                    <a class="navbar-item" href="index.php?vista=user_search">
                        Buscar
                    </a>
                </div>
            </div>
            <!-- Elemento de menú desplegable "Categorias" -->
            <div class="navbar-item has-dropdown is-hoverable">
                <!-- Enlace de menú "Categorias" -->
                <a class="navbar-link">
                    Categorias
                </a>
                <!-- Contenido desplegable del menú de "Categorias" -->
                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        Nuevo
                    </a>
                    <a class="navbar-item">
                        Lista
                    </a>
                    <a class="navbar-item">
                        Buscar
                    </a>
                </div>
            </div>
            <!-- Elemento de menú desplegable "Productos" -->
            <div class="navbar-item has-dropdown is-hoverable">
                <!-- Enlace de menú "Productos" -->
                <a class="navbar-link">
                    Productos
                </a>
                <!-- Contenido desplegable del menú de "Productos" -->
                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        Nuevo
                    </a>
                    <a class="navbar-item">
                        Lista
                    </a>
                    <a class="navbar-item">
                        Categoría
                    </a>
                    <a class="navbar-item">
                        Buscar
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Elementos del extremo derecho de la barra de navegación -->
        <div class="navbar-end">
            <div class="navbar-item">
                <!-- Botones de acción -->
                <div class="buttons">
                    <!-- Botón para acceder a la cuenta del usuario -->
                    <a class="button is-primary is-rounded">Mi Cuenta</a>
                    <!-- Botón para salir o cerrar sesión -->
                    <a href="index.php?vistas=logout" class="button is-link is-rounded">Salir</a>
                </div>
            </div>
        </div>
    </div>
</nav>
