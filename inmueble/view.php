<?php
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$modeloProvincia = new ModeloProvincia($bd);
$objeto = $modelo->get($id);
if ($objeto->getIsactivo() == 0) {
    header("Location:../index.php");
    exit();
}
$provNumero = $objeto->getProvincia();
$objetoProv = $modeloProvincia->get(1);
$bd->closeConexion();

$ruta = "../entradas/" . $objeto->getId();
$directorio = opendir($ruta);
$imagenPrincipal = "";
$imagen = array();
while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
    if ($archivo != ".." && $archivo != ".") {
        if ($imagenPrincipal == "") {
            $imagenPrincipal = $archivo;
        } else {
            $imagen[] = $archivo;
        }
    }
}
?>

<!doctype html>
<html lang="es">

    <head>
        <title>Foto Casa</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/vivienda.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/practica2.js"></script>
    </head>

    <body>
        <div id="contenedor">           
            <?php include "../include/header.php"; ?>

            <div id="body">
                <div id="body-center">						
                    <a class="enlace" href="../"><span id="simbolo">&lt;</span>&nbsp;Volver</a>
                    <br/>
                    <div id="imagen-principal">
                        <?php
                        if($imagenPrincipal!= ""){                            
                            echo "<img src='$ruta/$imagenPrincipal' alt='imagen principal' id='imgP'/>";
                        }
                        ?>

                    </div>

                    <div id="contacto">
                        Para contactar 
                        <?php
                        if ($objeto->getTelefono() != "0") {
                            echo "por telefono
                            <br/><span id = 'tlf'>" . $objeto->getTelefono() . "</span>
                            <br/>preferiblemente llamar
                            <span id = 'horaContacto'>de " . $objeto->getHoraContacto() . "</span>
                            <br/><br/>o";
                        }
                        ?>
                        rellena el formulario
                        <form id="contacto" name="contacto" method="post" action="phpCorreo.php">
                            <input type="text" name="nombre" id="nombre" value="" placeholder="nombre" required>
                            <input type="email" name="mail" id="mail" value="" placeholder="mail" required>
                            <input type="text" name="telefono" id="telefono" value="" placeholder="telefono" >
                            <input type="hidden" name="destino" id="destino" value="<?php echo $objeto->getEmail(); ?>">                            
                            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            <textarea id="mensaje" name="mensaje"
                                      rows="3" cols="30">Me gustaría recibir más información del <?php echo $objeto->getTipo()." en ".$objeto->getDireccion().", ".$objeto->getCiudad();?></textarea>
                            <input type="submit" id="enviar" value="Contactar">   
                        </form>
                    </div>

                    <div id="imagenes">                                    
                        <?php
                        if($imagenPrincipal!= ""){                            
                            echo "<img src='$ruta/$imagenPrincipal' alt='imagen' class='imagen'/>";
                        }
                        foreach ($imagen as $value) {
                            echo "<img src='$ruta/$value' alt='imagen' class='imagen'/>";
                        }
                        ?>
                    </div>

                    <div id="datos">
                        <span id="tituloDatos"><?php echo $objeto->getTipo(); ?>, 
                            <?php echo $objeto->getEstado(); ?>, 
                            <?php echo $objeto->getHabitaciones(); ?> habitaciones, 
                            <?php echo $objeto->getBanos(); ?> baños, 
                            <?php echo $objeto->getMetros(); ?> m2</span>
                        <p><?php echo (($objeto->getIsalquiler() == 0) ? "Venta " : "Alquiler "); ?> 
                            <?php echo number_format($objeto->getPrecio(), 0, ",", "."); ?> €
                            <?php echo (($objeto->getIsalquiler() == 1) ? " al mes" : "");?></p>
                        <p>Direccion: <?php echo $objeto->getDireccion(); ?></p>
                        <p>Ciudad: <?php echo $objeto->getCiudad(); ?> (<?php
                            echo $objetoProv->getNombreProvincia();
                            ?>) </p>
                    </div>

                    <div id="descripcion">
                        <span id="tituloDescripcion">Descripcion:</span>
                        <p><?php echo $objeto->getDescripcion(); ?></p>
                    </div>
                </div>
            </div>
            <?php include "../include/footer.php"; ?>
    </body>

</html>
