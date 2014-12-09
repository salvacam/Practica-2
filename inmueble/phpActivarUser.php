<?php

require '../require/comun.php';
$enlace = Leer::get("enlace");
echo $enlace . "<br/>";
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$r = $modelo->activarUser($enlace);

if ($r > 0) {
    $inmueble= $modelo->getEnlace($enlace);
    $email = $inmueble->getEmail();
    $id = $inmueble->getId();
    $mensaje = "Ha activado el <a href='" . Entorno::getEnlaceCarpeta("view.php?id=$id") . "'>anuncio</a><br/>";
    $enlace = md5($email . Configuracion::PEZARANA . $id);    
    $mensaje .= "No borre este correo. Lo necesitara para borrar o editar el anuncio<br/>"
            . "Click aqui para: <a href='" . Entorno::getEnlaceCarpeta("phpBorrarUser.php?enlace=$enlace") . "'>Borrar anuncio</a><br/>"
            . "Click aqui para: <a href='" . Entorno::getEnlaceCarpeta("viewUpdateUser.php?enlace=$enlace") . "'>Editar anuncio</a>";
    $correo = Correo::enviarGmail(NULL, $email, Configuracion::ASUNTO, $mensaje, Configuracion::CLAVEGMAIL);
}
header("Location:../index.php");
