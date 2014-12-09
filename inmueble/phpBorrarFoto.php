<?php
require '../require/comun.php';
$sesion->root("../index.php");
$id = Leer::request("id");
$foto = Leer::get("foto");
$ruta = "../entradas/" . $id;
unlink($ruta . DIRECTORY_SEPARATOR . $foto);

header("Location: viewUpdate.php?id=$id");
