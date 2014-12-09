<?php
require '../require/comun.php';

$enlace = Leer::get("enlace");
echo $enlace . "<br/>";
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$r = $modelo->desactivarUser($enlace);

if ($r > 0) {
    $inmueble= $modelo->getEnlace($enlace);
    $email = $inmueble->getEmail();
    $mensaje = "Ha borrado un anuncio."; 
    $correo = Correo::enviarGmail(NULL, $email, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
}
header("Location:../index.php");
