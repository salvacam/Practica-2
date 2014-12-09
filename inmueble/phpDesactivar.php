<?php
require '../require/comun.php';
$sesion->root("../index.php");
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$r = $modelo->desactivar($id);
header("Location:admin.php");
