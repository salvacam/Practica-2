<?php

require '../require/comun.php';
$precio = Leer::post("precio");
$habitaciones = Leer::post("habitaciones");
$banos = Leer::post("banos");
$metros = Leer::post("metros");
$provincia = Leer::post("provincia");
$direccion = Leer::post("direccion");
$ciudad = Leer::post("ciudad");
$estado = Leer::post("estado");
$tipo = Leer::post("tipo");
$descripcion = Leer::post("descripcion");
$telefono = Leer::post("telefono");
$horaContacto = Leer::post("horaContacto");
$email = Leer::post("email");
$isalquiler = Leer::post("isalquiler");
$isactivo = 0;
if (isset($_POST["isactivo"])) {
    $isactivo = 1;
}
//validar php
$estados = ["A estrenar", "Reformado", "En buen estado", "A reformar"];
$tipos = ["Piso", "Chalet", "Duplex", "Unifamiliar", "Estudio", "Local",
    "Trastero", "Garaje"];
$horas = ["10:00 - 14:00", "14:00 - 17:00", "17:00 - 21:00"];

if (!Validar::isAltainmueble($precio, $habitaciones, $banos, $metros, $provincia, $direccion, $ciudad, $estado, $estados, $tipo, $tipos, $descripcion, $telefono, $horaContacto, $horas, $email, $isactivo)) {
    //mandar email
    $mensaje = "Ha intentado publicar un anuncio con valores invalidos."
            . "<br/>Intente publicarlo de nuevo, gracias.";
    $correo = Correo::enviarGmail(NULL, $email, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
    header("Location: ../index.php");
    exit();
}


$bd = new BaseDatos();
$objeto = new Inmueble(null, $precio, $habitaciones, $banos, $metros, $provincia, $direccion, $ciudad, $estado, $tipo, $descripcion, $horaContacto, $telefono, $email, $isalquiler, $isactivo);
$modelo = new ModeloInmueble($bd);
$r = $modelo->add($objeto);
$bd->closeConexion();
//crear carpeta
$ruta = "../entradas/" . $r;
if ($r > 0) {
    mkdir($ruta, Configuracion::PERMISOS);
}

//subir archivos
if ($_FILES["archivos"]["name"][0] != NULL) {
    $subir = new SubirArray("archivos");
    $subir->setAccion("1"); //renombra
    $subir->setDestino($ruta);
    $subir->setNombre();
    $subir->setMaximo("10485760"); //4 megas "4194304" ; 10 megas como máximo por foto "10485760"
    $subir->addTipo("image");
    $subir->subir();
}
$mensaje = "Ha publicado un anuncio.<br/>";
$enlace = md5($email . Configuracion::PEZARANA . $r);
$mensaje .= "Click aqui para: <a href='" . Entorno::getEnlaceCarpeta("phpActivarUser.php?enlace=$enlace") . "'>Activar anuncio</a>";
$correo = Correo::enviarGmail(NULL, $email, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
header("Location: ../index.php");

