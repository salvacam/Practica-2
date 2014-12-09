<?php
require '../require/comun.php';
$sesion->root("../index.php");
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloInmueble($bd);
$r = $modelo->deletePorId($id);
$bd->closeConexion();
$ruta = "../entradas/" . $id;
foreach (scandir($ruta) as $valor) {//readdir  scandir
    if ($valor == '.' || $valor == '..')
        continue;
    unlink($ruta . DIRECTORY_SEPARATOR . $valor);
}
rmdir($ruta);

$resultado = "Operación: eliminar. Resultado: " . (($r > 0) ? "ok" : "error");
$sesion->set("resultado", $resultado);

header("Location: admin.php");
