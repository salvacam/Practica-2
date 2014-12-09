window.addEventListener("load", function () {
    var lista = document.getElementsByClassName("imagen");
    for (var i = 0; i < lista.length; i++) {
        lista[i].addEventListener("click", function () {
            document.getElementById("imgP").setAttribute("src", this.getAttribute("src"));
        });
    }
    var telefono = document.getElementById("telefono");
    telefono.addEventListener("keypress", filtroEntero, false);

    function filtroEntero(e) {
        var codigo = e.charCode || e.keyCode;
        if (codigo < 32 || codigo == 37 || codigo == 38 || codigo == 39
                || codigo == 40) {
            return;
        }
        var texto = String.fromCharCode(codigo);

        var permitidos = "0123456789";
        if (permitidos.indexOf(texto) == -1) {
            // Es un carácter no permitido
            if (e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }
    }
});