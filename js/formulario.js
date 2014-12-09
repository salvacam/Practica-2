window.addEventListener("load", inicio);

window.addEventListener("beforeunload", confirmarSalida);

function confirmarSalida(e) {
    var confirmationMessage = "Vas a abandonar esta pagina. Si has hecho algún cambio sin grabar perderás los datos";
    (e || window.event).returnValue = confirmationMessage;
}

function inicio() {
    var tipo = document.getElementById("tipo");
    var precio = document.getElementById("precio");
    var metros = document.getElementById("metros");
    var habitaciones = document.getElementById("habitaciones");
    var bano = document.getElementById("banos");
    var estado = document.getElementById("estado");
    var provincia = document.getElementById("provincia");
    var direccion = document.getElementById("direccion");
    var ciudad = document.getElementById("ciudad");
    var descripcion = document.getElementById("descripcion");
    var telefono = document.getElementById("telefono");
    var horaContacto = document.getElementById("horaContacto");
    var email = document.getElementById("email");
    var imagenes = document.getElementById("imagenes");
    //validar si ha elegido fotos
    limpiar();
    filtrarTeclas();

    document.getElementById("reset").addEventListener("click", function (evento) {
        if (!confirm("¿Reiniciar valores del formulario?\nSi acepta perdera todos los datos introducidos")) {
            evento.preventDefault();
        } else {
            limpiar();
        }
    });

    document.getElementById('archivos').addEventListener('change', mostrarArchivos, false);

    function limpiar() {
        tipo.removeAttribute("class");
        precio.removeAttribute("class");
        metros.removeAttribute("class");
        habitaciones.removeAttribute("class");
        bano.removeAttribute("class");
        estado.removeAttribute("class");
        provincia.removeAttribute("class");
        direccion.removeAttribute("class");
        ciudad.removeAttribute("class");
        descripcion.removeAttribute("class");
    }

    document.getElementById("enviar").addEventListener("click", function (evt) {
        enviar(evt);
    });

    function enviar(evt) {
        var error = "";
        if (tipo.value.length < 1) {
            error += "Debe seleccionar un tipo de inmueble\n";
            tipo.setAttribute("class", "error");
        } else {
            tipo.removeAttribute("class");
        }
        if (precio.value.length < 2) {
            error += "El precio debe ser al menos 2 cifras\n";
            precio.setAttribute("class", "error");
        } else {
            precio.removeAttribute("class");
        }
        if (metros.value.length < 1) {
            error += "Metros debe ser al menos 1 cifra\n";
            metros.setAttribute("class", "error");
        }
        else {
            metros.removeAttribute("class");
        }
        if (habitaciones.value.length < 1) {
            error += "Debe selecionar un número de habitaciones\n";
            habitaciones.setAttribute("class", "error");
        }
        else {
            habitaciones.removeAttribute("class");
        }
        if (bano.value.length < 1) {
            error += "Debe selecionar un número de baños\n";
            bano.setAttribute("class", "error");
        }
        else {
            bano.removeAttribute("class");
        }
        if (estado.value.length < 1) {
            error += "Debe selecionar un estado del inmueble\n";
            estado.setAttribute("class", "error");
        }
        else {
            estado.removeAttribute("class");
        }
        if (provincia.value.length < 1) {
            error += "Debe selecionar una provincia\n";
            provincia.setAttribute("class", "error");
        }
        else {
            provincia.removeAttribute("class");
        }
        if (ciudad.value.length < 2) {
            error += "Ciudad debe ser al menos 2 caracteres\n";
            ciudad.setAttribute("class", "error");
        }
        else {
            ciudad.removeAttribute("class");
        }
        if (direccion.value.length < 5) {
            error += "Direccion debe ser al menos 5 caracteres\n";
            direccion.setAttribute("class", "error");
        }
        else {
            direccion.removeAttribute("class");
        }
        if (descripcion.value.length < 15) {
            error += "Descripcion debe ser al menos 15 caracteres\n";
            descripcion.setAttribute("class", "error");
        }
        else {
            descripcion.removeAttribute("class");
        }
        var expMail = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
        if (!expMail.test(email.value)) {
            error += "Email debe ser valido\n";
            email.setAttribute("class", "error");
        } else {
            email.removeAttribute("class");
        }

        if (telefono.value > 0) {
            var expTelefono = /^\d{9}$/;
            if (!expTelefono.test(telefono.value)) {
                error += "Si el telefono se introduce debe ser valido (Ej:958123456)\n";
                telefono.setAttribute("class", "error");
            } else {
                telefono.removeAttribute("class");
            }
            //comrpobar hora
            if (horaContacto.value.length < 1) {
                error += "Si el telefono se introduce selecciona una hora de contacto\n";
                horaContacto.setAttribute("class", "error");
            }
            else {
                horaContacto.removeAttribute("class");
            }
        }
        if (error != "") {
            alert(error);
            evt.preventDefault();
            return false;
        }
        var pregunta = ""
        if (telefono.value <= 0) {
            pregunta += "Telefono vacio\n";
        }
        if (imagenes.value <= 0) {
            pregunta += "No ha seleccionado imagenes\n";
        }
        if (pregunta.length > 0) {
            if (!confirm(pregunta + "¿Enviar formulario?"))
                evt.preventDefault();
        }
    }

    function filtrarTeclas() {
        precio.addEventListener("keypress", filtroEntero, false);
        metros.addEventListener("keypress", filtroEntero, false);

        function filtroEntero(e) {
            var codigo = e.charCode || e.keyCode;
            if (codigo < 32 || codigo == 37 || codigo == 38 || codigo == 39
                    || codigo == 40) {
                return;
            }
            var texto = String.fromCharCode(codigo);

            var permitidos = "0123456789";
            if (permitidos.indexOf(texto) === -1) {
                // Es un carácter no permitido
                if (e.preventDefault) {
                    e.preventDefault();
                }
                return false;
            }
        }
    }

    function mostrarArchivos(evt) {
        var files = evt.target.files; // FileList object
        var lista = document.getElementById('list');
        lista.innerHTML="";
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    lista.insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
}





