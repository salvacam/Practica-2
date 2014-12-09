window.addEventListener("load", function () {    
    var borrarImg = document.getElementsByClassName("borrarImg");
    for (var i = 0; i < borrarImg.length; i++) {
        borrarImg[i].addEventListener("click", confirmarImg);
    }

    function confirmarImg(e) {
        if (!confirm("¿Quieres borrar la imagen ?")) {
            e.preventDefault();
        } 
    }
});