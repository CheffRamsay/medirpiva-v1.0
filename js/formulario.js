export function formulario() {

    const formulario = document.getElementById('datos_formulario');
    const inputs = document.querySelectorAll('.label-input-container input');
    const btnSucces = document.querySelector('.swal-button');
    const localidad = document.querySelector('#grupo-localidad');
    const select = document.querySelector('.select-id');
    const comentario = document.querySelector('#mensaje');
    const option = document.querySelector('.select-id option');
    const btnEnviar = document.querySelector("#btn-id");

    
    //¿SOS AFILIADO? Seccion
    const selectorSosAfiliado = document.querySelector(".afiliadoConsulta");
    const form = document.querySelector("#formvisibility");


    const fechaActual = () =>{
        let fecha = new Date();
        const f = fecha.toLocaleString();
        return f;
    }

    fechaActual();
    
    //ValidacionFormualrio
    const expresiones = {
        usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
        nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
        //dni: /^[0-9_.+-]{8,10}$/, // 8 numeros.
        password: /^.{4,12}$/, // 4 a 12 digitos.
        correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        telefono: /^[0-9_.+-]{5,14}$/ // 7 a 14 numeros.
        
    }

    const campos = {
        nombre: false,
        //dni: false,
        correo: false,
        telefono: false,
        localidad: true
    }

    const validarFormulario = (e) =>{
        switch(e.target.name){
            case "nombre":
                validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
            /*
             case "dni":
                validarCampo(expresiones.dni, e.target, 'dni');
            break;
            */
            case "correo":
                validarCampo(expresiones.correo, e.target, 'correo');
            break;
            case "telefono":
                validarCampo(expresiones.telefono, e.target, 'telefono');
            break;
            case "localidad":
                validarCampo(expresiones.localidad, e.target, 'localidad');
            break;
        }

    }

    const validarCampo = (expresion, input, campo) =>{
        if(expresion.test(input.value)){
            document.getElementById(`${campo}`).classList.remove('formulario-incorrecto');
            document.getElementById(`${campo}`).classList.add('formulario-correcto');
            document.querySelector(`#grupo-${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
            campos[campo] = true;
        }else{
            document.getElementById(`${campo}`).classList.add('formulario-incorrecto');
            document.getElementById(`${campo}`).classList.remove('formulario-correcto');
            document.querySelector(`#grupo-${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
            campos[campo] = false;
        }
    }

    inputs.forEach((input) =>{
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    })

//Envio de datos a GoogleSheets y envio de mensaje por Whatsapp
formulario.addEventListener('submit', (e) => {
    
e.preventDefault();

//Aplicando animación de proceso de envio al Boton "Enviar".
btnEnviar.disabled = true;
btnEnviar.innerHTML = "Procesando...";

let peticionGoogleSheets = {
    method: 'POST',
    mode: 'cors',
    headers: {
        'Content-Type': 'application/json'

    },
    body: JSON.stringify({
        "Nombre":     formulario.nombre.value,
        //"Dni":        formulario.dni.value,
        "Email":     formulario.correo.value,
        "Telefono":   formulario.telefono.value,
        "Localidad":  formulario.localidad.value,
        "Fecha":      fechaActual(),
        "Comentario": comentario.value
         
    })
}

let datos = new FormData(formulario);
let peticion = {
    method:'POST',
    body:datos,
}
//console.log(formulario.localidad)
const urlGoogleSheetsDB = 'https://sheetdb.io/api/v1/8pblf8b3eglqi';

if(campos.nombre  /*&& campos.dni*/ && campos.correo && campos.telefono && campos.localidad){
    
    //Se envia el mensaje al numero ws con los datos del formulario
    fetch ('php/envio-ws.php',peticion)  
    .then( respuestaWs =>{
        console.log(respuestaWs.status);
        if(respuestaWs.status==200){
            
            //Si el mensaje de ws se envia correctamente se guarda en la base de datos de Google Sheets
            fetch(urlGoogleSheetsDB, peticionGoogleSheets)
            .then(respuestaGoogleSheets =>{
                console.log(respuestaGoogleSheets);
                if(respuestaGoogleSheets.status==201){
                    //ñwindow.location.href = "https://medipriva.com.ar/mensajeEnviado.html";
                    console.log("Mensaje enviado y subido a la base de datos")
                }
            })
        }else{
            swal({ 
                title: "ERROR INESPERADO",
                text: "Contactese por Whatsapp. haciendo click en el boton 'ok'",
                icon: "error",
            }).then(okay => {
            if (okay) {
                 window.open('https://api.whatsapp.com/send?phone=+5491134212930&text=Quiero%20info', '_blank');
            }
           });
        }
    }).catch(error =>console.warn('error', error));
}else{
    console.log("Formulario incompleo o con errores");
    btnEnviar.disabled = false;
    btnEnviar.innerHTML = "ENVIAR";
    swal({ 
      title: "ATENCÓN",
      text: "El formulario cuenta con errores o esta incompleto.",
      icon: "warning",
    })
}

});

selectorSosAfiliado.addEventListener("change", () => {
    const seleccion = selectorSosAfiliado.options[selectorSosAfiliado.selectedIndex].value;

    enlace.style.display = (seleccion === "1") ? "block" : "none";
    form.style.display = (seleccion === "2") ? "block" : "none";

   
    document.documentElement.clientWidth > 1000 && seleccion === "2"  ? formulario.classList.add("translateToTop") : formulario.classList.remove("translateToTop");
    
    
});
       
	 
}