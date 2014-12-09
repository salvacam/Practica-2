<?php
require '../require/comun.php';
$sesion->root("../index.php");
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$r = $modelo->activar($id);
header("Location:admin.php");
