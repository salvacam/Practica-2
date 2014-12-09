<?php
require './require/comun.php';
$bd = new BaseDatos();
$sesion->delete("__root");
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$modeloProvincia = new ModeloProvincia($bd);
$modeloInmueble = new ModeloInmueble($bd);
$tipo = Leer::get("tipo");
$isalquiler = Leer::get("isalquiler");
$rangoPrecio = Leer::get("rangoPrecio");
$provincia = Leer::get("provincia");
$ciudad = Leer::get("ciudad");
$condiciones = "isActivo =:isActivo";
$parametros["isActivo"] = 1;
$ordenar = "1 DESC";
if ($tipo != "") {
    $condiciones .= " and tipo =:tipo";
    $parametros["tipo"] = $tipo;
}
if ($isalquiler == "0" || $isalquiler == "1") {
    $condiciones .= " and isalquiler =:isalquiler";
    $parametros["isalquiler"] = $isalquiler;
}
if ($provincia != "") {
    $condiciones .= " and provincia =:provincia";
    $parametros["provincia"] = $provincia;
}
if ($ciudad != "") {
    $condiciones .= " and ciudad =:ciudad";
    $parametros["ciudad"] = $ciudad;
}
if ($rangoPrecio != "") {
    $rango = explode(";", $rangoPrecio);
    $condiciones .= " and precio >=:rango0";
    if ($rango[1] != "1000000") {
        $condiciones.=" and precio <=:rango1";
        $parametros["rango1"] = $rango[1];
    }
    $parametros["rango0"] = $rango[0];
}
$filas = $modeloInmueble->getList($pagina, 5, $condiciones, $parametros, $ordenar);
$total = $modeloInmueble->count("isActivo = 1");
$enlaces = Util::getEnlacesPaginacion($pagina, $total[0], 5);
?>

<!doctype html>
<html lang="es">

    <head>
        <title>Foto Casa</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./font/font.css">
        <link rel="stylesheet" href="./css/front-end.css">
        <link rel="shortcut icon" href="./img/favicon.ico">
    </head>

    <body>
        <div id="contenedor">
            <?php include "./include/headerIndex.php"; ?>

            <div id="body">
                <div id="body-center">
                    <div id="centro">
                        <div id="busqueda">
                            <span id="tituloBusqueda">Buscar por:</span>
                            <form id="busqueda" name="busqueda">
                                <?php
                                echo $modeloInmueble->selectHTMLColumna("tipo", "tipo", "tipo", TRUE, "Tipo de Inmueble");
                                ?>			
                                <label for="venta">Venta</label>
                                <input name="isalquiler" id="venta" value="0" type="radio">
                                <label for="alquiler">Alquiler</label>
                                <input name="isalquiler" id="alquiler" value="1" type="radio">

                                <select id="rangoPrecio" name="rangoPrecio">                            
                                    <option value="">Precio</option>                                                              
                                    <option value="0;500">0 - 500</option>                          
                                    <option value="501;1000">501 - 1.000</option>                          
                                    <option value="1001;5000">1.001 - 5.000</option>                          
                                    <option value="5001;100000">5.001 - 100.000</option>                          
                                    <option value="100001;200000">100.001 - 200.000</option>
                                    <option value="200001;400000">200.001 - 400.000</option>
                                    <option value="400001;600000">400.001 - 600.000</option>
                                    <option value="600001;1000000">600.001 - 1.000.000 (o más)</option>
                                </select>							
                                <br/><br/>
                                <?php
                                echo $modeloInmueble->selectHTMLColumnaExt("casa_provincia", "nombreProvincia", "idProvincia", "provincia", "provincia", "provincia", TRUE, "Provincia");
                                ?>
                                <?php
                                echo $modeloInmueble->selectHTMLColumna("ciudad", "ciudad", "ciudad", TRUE, "Ciudad");
                                ?>
                                <input type="submit" id="buscar" value="Buscar"/>
                            </form>
                        </div>

                        <div id="acceso">
                            <a href="inmueble/viewLogin.php">Adminsitrar</a>
                            <a href="inmueble/viewAddUser.php">Publica tu anuncio</a>
                        </div>   
                    </div>

                    <div id="resultado">
                        Resultado:
                        <?php
                        foreach ($filas as $indice => $objeto) {
                            $ruta = "./entradas/" . $objeto->getId();
                            if ($directorio = opendir($ruta)) {
                                $imagenPrincipal = "";
                                while ($archivo = readdir($directorio)) {
                                    if ($archivo != ".." && $archivo != ".") {
                                        $imagenPrincipal = $archivo;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <a class="entrada" href="./inmueble/view.php?id=<?php echo $objeto->getId(); ?>">

                                <img src="<?php echo $ruta . "/" . $imagenPrincipal; ?>" alt="foto Principal">
                                <div class="precio">
                                    <?php echo (($objeto->getIsalquiler() == 0) ? "Venta " : "Alquiler "); ?>                                    
                                    <?php echo number_format($objeto->getPrecio(), 0, ",", ".");
                                    ?> €<?php echo (($objeto->getIsalquiler() == 1) ? " al mes" : ""); ?>
                                </div>
                                <div class="descripcion">
                                    <p class="arriba"><?php echo $objeto->getTipo(); ?>
                                        &nbsp; <?php echo $objeto->getCiudad(); ?>                                        
                                        &nbsp; (<?php
                                $provNumero = $objeto->getProvincia();
                                $objetoProv = $modeloProvincia->get($provNumero);
                                echo $objetoProv->getNombreProvincia();
                                    ?>)
                                        &nbsp; <?php echo $objeto->getDireccion(); ?></p>
                                    <p class="centro"><?php echo $objeto->getDescripcion(); ?></p>
                                    <p class="abajo"><span class="metros"><?php echo $objeto->getMetros(); ?> 
                                            <spam class="gris">m2</spam></span>
                                        <span class="hab"><?php echo $objeto->getHabitaciones(); ?></span>    
                                        <span class="banos"><?php echo $objeto->getBanos(); ?></span>
                                    </p>
                                </div>
                            </a>
                            <?php
                        }
                        ?>    
                        <br/>
                        <div id="paginacion"> 
                            <?php echo $enlaces["inicio"]; ?>
                            &nbsp;&nbsp;
                            <?php echo $enlaces["anterior"]; ?>
                            &nbsp;&nbsp;
                            <?php echo $enlaces["primero"]; ?>
                            &nbsp;
                            <?php echo $enlaces["segundo"]; ?>
                            &nbsp;
                            <?php echo $enlaces["actual"]; ?>
                            &nbsp;
                            <?php echo $enlaces["cuarto"]; ?>
                            &nbsp;
                            <?php echo $enlaces["quinto"]; ?>
                            &nbsp;&nbsp;
                            <?php echo $enlaces["siguiente"]; ?>
                            &nbsp;&nbsp;
                            <?php echo $enlaces["ultimo"]; ?>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        <?php
        $bd->closeConexion();
        include "./include/footer.php";
        ?>
    </body>

</html>
