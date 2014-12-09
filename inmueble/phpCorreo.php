<?php
require '../require/comun.php';
$id = Leer::post("id");
$destino = Leer::post("destino");
$nombre = Leer::post("nombre");
$mail = Leer::post("mail");
$telefono = "";
if (isset($_POST["telefono"])) {
    $telefono = Leer::post("telefono");
}
$mensaje = Leer::post("mensaje");
$mensaje .= "<br/> Pongase en contacto por email: ".$mail;
if($telefono!=""){
    $mensaje.= "<br/> o al telefono".$telefono;
}

$correo = Correo::enviarGmail(NULL, $destino, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
header("Location:view.php?id=$id");