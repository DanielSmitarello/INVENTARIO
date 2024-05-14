// Selecciona todos los elementos del DOM que tienen la clase CSS utilizando document.querySelectorAll(".FormularioAjax")
const formularios_ajax=document.querySelectorAll(".FormularioAjax");

// Función para manejar el envío del formulario Ajax. La función enviar_formulario_ajax se define para manejar el envío
// del formulario cuando se envía.
function enviar_formulario_ajax(e){
    e.preventDefault(); // Toma un evento como argumento (e) y lo previene de realizar la acción predeterminada (enviar el formulario) usando e.preventDefault().

    // Muestra una ventana de confirmación al usuario y guarda la respuesta en la variable "enviar"
    let enviar=confirm("Quiéres enviar el formulario?");

    // Si el usuario confirma que quiere enviar el formulario
    if(enviar==true){

        // Crea un objeto FormData que recopila los datos del formulario actual
        let data= new FormData(this);
        // Obtiene el método y la acción del formulario actual
        let method=this.getAttribute("method");
        let action=this.getAttribute("action");

        // Crea un objeto Headers vacío
        let encabezados= new Headers();

        // Configura la solicitud Fetch con el método, encabezados, modo, caché y datos del cuerpo
        let config={
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        // Envía la solicitud Fetch al servidor con la acción y la configuración proporcionadas
        fetch(action,config)
        // Convierte la respuesta del servidor a texto
        .then(respuesta => respuesta.text())
        // Maneja la respuesta del servidor
        .then(respuesta =>{ 
            // Selecciona un contenedor con la clase CSS ".form-rest" y reemplaza su contenido con la respuesta del servidor
            let contenedor=document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta;
        });
    }

}

// Asocia la función "enviar_formulario_ajax" al evento "submit" de cada formulario seleccionado
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviar_formulario_ajax);
});
