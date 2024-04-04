// const formulario_ajax = document.querySelectorAll('.FormularioAjax');

// function enviar_formulario_ajax(e) {
//     e.preventDefault();
//     let enviar = confirm('Quieres enviar el formulario?');

//     if (enviar == true) {
//         let data = new FormData(this);
//         let method = this.getAttribute('method');
//         let action = this.getAttribute('action');
//         let encabezados = new Headers();
//         let config = {
//             method: method,
//             headers: encabezados,
//             mode: 'cors',
//             cache: 'no-cache',
//             body: data,
//         };
        
//         fetch(action,config)
//             .then(respuesta => respuesta.text())
//             .then(respuesta => {
//                 let contenedor = document.querySelector('.form-rest');
//                 contenedor.innerHTML = respuesta;
//             })
//     }
// }

// formulario_ajax.forEach(formularios => {
//     formularios.addEventListener('submit', enviar_formulario_ajax);
// });



// Este código es un script JavaScript que maneja el envío de formularios utilizando AJAX (Asynchronous JavaScript and XML) 
// y la API Fetch para realizar peticiones HTTP asíncronas.

// Selecciona todos los elementos del DOM con la clase "FormularioAjax" y los almacena en la variable formularios_ajax
const formularios_ajax = document.querySelectorAll(".FormularioAjax");

// Función para enviar el formulario mediante AJAX
function enviar_formulario_ajax(e) {

    // Evita el comportamiento por defecto del formulario, que es enviar una petición HTTP al servidor y recargar la página
    e.preventDefault();

    // Pide confirmación al usuario antes de enviar el formulario
    let enviar = confirm("Quieres enviar el formulario");
    
    // Si el usuario confirma que quiere enviar el formulario
    if (enviar == true) {
        
        // Crea un nuevo objeto FormData que contiene los datos del formulario
        let data = new FormData(this);
        // Obtiene el método HTTP del formulario (GET o POST)
        let method = this.getAttribute("method");
        // Obtiene la URL a la que se enviará el formulario
        let action = this.getAttribute("action");

        // Crea un nuevo objeto Headers para los encabezados de la petición HTTP
        let encabezados = new Headers();

        // Configura las opciones para la petición fetch
        let config = {
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };
        
        // Crea un mensaje que se viasualiza en cualquier pagina como por ejemplo user_new.php para ver el estado de un procesamiento

        // Realiza la petición fetch con la URL y las opciones de configuración proporcionadas
        fetch(action, config)
            // Una vez que se recibe la respuesta del servidor, se convierte a texto
            .then(respuesta => respuesta.text())
            // Cuando se resuelve la promesa, se ejecuta esta función con la respuesta del servidor
            .then(respuesta => {
                // Encuentra el elemento del DOM con la clase "form-rest" y establece su contenido HTML como la respuesta del servidor
                let contenedor = document.querySelector(".form-rest");
                contenedor.innerHTML = respuesta;
            });
    }
}

// Itera sobre todos los formularios seleccionados y agrega un event listener para el evento "submit" 
// que llamará a la función enviar_formulario_ajax cuando se envíe el formulario
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});
