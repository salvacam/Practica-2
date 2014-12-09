window.addEventListener("load", function () {
    var borrar = document.getElementsByClassName("borrar");
    for (var i = 0; i < borrar.length; i++) {
        borrar[i].addEventListener("click", confirmar);
    }
    
    function confirmar(e) {
        if (!confirm("¿Quieres borrar el inmueble con id " + this.getAttribute("data-id") + "?")) {
            e.preventDefault();
        }
    }
});