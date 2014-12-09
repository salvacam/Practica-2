<?php

require '../require/comun.php';

$enlace = Leer::post("enlace");
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$inmueble = $modelo->getEnlace($enlace);
if ($inmueble->getId()== null) {
    header("Location:../index.php");
    exit();
}
$id = Leer::post("id");
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

if (!Validar::isAltainmueble($precio, $habitaciones, $banos, $metros, $provincia, 
        $direccion, $ciudad, $estado, $estados, $tipo, $tipos, $descripcion, 
        $telefono, $horaContacto, $horas, $email, $isactivo)) {
    //Guardar el mensaje en la cookie de sesion
    $resultado = "Operación: actualizar. Resultado: error, valores invalidos";
    echo $resultado;
    $sesion->set("resultado", $resultado);
    header("Location: admin.php");
    exit();
}
$objeto = new Inmueble($id, $precio, $habitaciones, $banos, $metros, $provincia, $direccion, $ciudad, $estado, $tipo, $descripcion, $horaContacto, $telefono, $email, $isalquiler, $isactivo);
//$modelo = new ModeloInmueble($bd);
//$r = $modelo->add($objeto);
$r = $modelo->edit($objeto);
$bd->closeConexion();

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
$mensaje = "Ha actualizado el anuncio.<br/>"
        . "<a href='" . Entorno::getEnlaceCarpeta("view.php?id=$id") . "'>anuncio</a>";
$correo = Correo::enviarGmail(NULL, $email, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
header("Location: ../index.php");

