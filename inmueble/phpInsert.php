<?php
require '../require/comun.php';
$sesion->root("../index.php");
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
    //Guardar el mensaje en la cookie de sesion
    $resultado = "Operación: insertar. Resultado: error, valores invalidos";
    $sesion->set("resultado", $resultado);
    header("Location: admin.php");    
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
//Guardar el mensaje en la cookie de sesion
$resultado = "Operación: insertar. Resultado: " . (($r > 0) ? "ok" : "error");

//subir archivos
if ($_FILES["archivos"]["name"][0] != NULL) {
    $subir = new SubirArray("archivos");
    $subir->setAccion("1"); //renombra
    $subir->setDestino($ruta);
    $subir->setNombre();
    $subir->setMaximo("10485760"); //4 megas "4194304" ; 10 megas como máximo por foto "10485760"
    $subir->addTipo("image");
    $subir->subir();
    $resultado .= "<br/>" . $subir->getErrorMensaje();
} else {
    $resultado .= "<br/>No se elegido archivos para subir.";
}

$sesion->set("resultado", $resultado);
header("Location: admin.php");

