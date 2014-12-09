<?php
require '../require/comun.php';
$nombre = Leer::post("nombre");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloRoot($bd);
$root = $modelo->get($nombre, $clave);
$bd->closeConexion();
if($root->getNombre() == null ){
    $sesion->cerrar();
    header("Location:../index.php");
} else {
    $sesion->setRoot($root);
    header("Location:admin.php");
}