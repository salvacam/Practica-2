<?php
require '../require/comun.php';

$bd = new BaseDatos();
$enlace = Leer::request("enlace");
$modelo = new ModeloInmueble($bd);
$inmueble = $modelo->getEnlace($enlace);
if ($inmueble->getId()== null) {
    header("Location:../index.php");
    exit();
}

$inmueble = $modelo->getEnlace($enlace);
$modeloProvincia = new ModeloProvincia($bd);
$ruta = "../entradas/" . $inmueble->getId();
$directorio = opendir($ruta);
$imagenPrincipal = "";
$imagen = array();
while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
    if ($archivo != ".." && $archivo != ".") {
        $imagen[] = $archivo;
    }
}
?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Foto Casa Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/update.js"></script>
        <script src="../js/formulario.js"></script>
    </head>

    <body>
        <div id="contenedor">
            <?php include "../include/header.php"; ?>

            <div id="body">
                <div id="body-center">	
                    <a class="enlace" href="../index.php"><span id="simbolo">&lt;</span>&nbsp;Volver</a>
                    <div class="campo">
                        <br/>
                        <form action="phpUpdateUser.php" method="POST" enctype="multipart/form-data">                                                       
                            <select name="tipo" id="tipo">
                                <option value="">Tipo de inmueble</option>
                                <option value="Piso" <?php if ($inmueble->getTipo() == "Piso") echo "selected"; ?> >Piso</option>
                                <option value="Chalet" <?php if ($inmueble->getTipo() == "Chalet") echo "selected"; ?> >Chalet</option>
                                <option value="Duplex" <?php if ($inmueble->getTipo() == "Duplex") echo "selected"; ?> >Duplex</option>
                                <option value="Unifamiliar" <?php if ($inmueble->getTipo() == "Unifamiliar") echo "selected"; ?> >Unifamiliar</option>   
                                <option value="Estudio" <?php if ($inmueble->getTipo() == "Estudio") echo "selected"; ?> >Estudio</option>
                                <option value="Local" <?php if ($inmueble->getTipo() == "Local") echo "selected"; ?> >Local</option>
                                <option value="Trastero" <?php if ($inmueble->getTipo() == "Trastero") echo "selected"; ?> >Trastero</option>
                                <option value="Garaje" <?php if ($inmueble->getTipo() == "Garaje") echo "selected"; ?> >Garaje</option>                          
                            </select>  
                            <label for="venta">Venta</label>
                            <input name="isalquiler" id="venta" value="0" type="radio" <?php if ($inmueble->getIsalquiler() == 0) echo "checked=''"; ?>>
                            <label for="alquiler">Alquiler</label>
                            <input name="isalquiler" id="alquiler" value="1" type="radio" <?php if ($inmueble->getIsalquiler() == 1) echo "checked=''"; ?>>
                            <input type="text" name="precio" value="<?php echo $inmueble->getPrecio(); ?>" id="precio" placeholder="precio"/>
                            <input type="number" name="metros" value="<?php echo $inmueble->getMetros(); ?>" id="metros" placeholder="metros" />
                            <br/>
                            <br/>
                            <select name="habitaciones" id="habitaciones">
                                <option value="">Nº de habitaciones</option>
                                <option value="0" <?php if ($inmueble->getHabitaciones() == 0) echo "selected"; ?> >0</option>
                                <option value="1" <?php if ($inmueble->getHabitaciones() == 1) echo "selected"; ?> >1</option>
                                <option value="2" <?php if ($inmueble->getHabitaciones() == 2) echo "selected"; ?> >2</option>
                                <option value="3" <?php if ($inmueble->getHabitaciones() == 3) echo "selected"; ?> >3</option>
                                <option value="4" <?php if ($inmueble->getHabitaciones() == 4) echo "selected"; ?> >4</option>   
                                <option value="5" <?php if ($inmueble->getHabitaciones() == 5) echo "selected"; ?> >5</option>
                                <option value="6" <?php if ($inmueble->getHabitaciones() == 6) echo "selected"; ?> >6</option>
                                <option value="7" <?php if ($inmueble->getHabitaciones() == 7) echo "selected"; ?> >7 o más</option>                         
                            </select>
                            <select name="banos" id="banos">
                                <option value="">Nº de baños</option>                                
                                <option value="0" <?php if ($inmueble->getBanos() == 0) echo "selected"; ?> >0</option>
                                <option value="1" <?php if ($inmueble->getBanos() == 1) echo "selected"; ?> >1</option>
                                <option value="2" <?php if ($inmueble->getBanos() == 2) echo "selected"; ?> >2</option>
                                <option value="3" <?php if ($inmueble->getBanos() == 3) echo "selected"; ?> >3</option>
                                <option value="4" <?php if ($inmueble->getBanos() == 4) echo "selected"; ?> >4 o más</option>   
                            </select>                    
                            <select name="estado" id="estado">
                                <option value="">Estado del inmueble</option>
                                <option value="A estrenar" <?php if ($inmueble->getEstado() == "A estrenar") echo "selected"; ?> >A estrenar</option>
                                <option value="Reformado" <?php if ($inmueble->getEstado() == "Reformado") echo "selected"; ?> >Reformado</option>
                                <option value="En buen estado" <?php if ($inmueble->getEstado() == "En buen estado") echo "selected"; ?> >En buen estado</option>
                                <option value="A reformar" <?php if ($inmueble->getEstado() == "A reformar") echo "selected"; ?> >A reformar</option>                            
                            </select>    
                            <br/>
                            <br/>
                            <?php echo $modeloProvincia->selectHtml("provincia", "provincia", "1=1", array(), "1", $inmueble->getProvincia(), TRUE, "Elige Provincia"); ?>
                            <input type="text" name="direccion" value="<?php echo $inmueble->getDireccion(); ?>" id="direccion" placeholder="direccion" />
                            <input type="text" name="ciudad" value="cd" id="<?php echo $inmueble->getCiudad(); ?>" placeholder="ciudad" />    
                            <br/>
                            <br/>
                            <textarea name="descripcion" id="descripcion" rows="5" cols="70" ><?php echo $inmueble->getDescripcion(); ?></textarea>      
                            <br/>
                            <br/>                 
                            <input type="text" id="telefono" name="telefono" value="<?php echo ($inmueble->getTelefono()==0?"": $inmueble->getTelefono()); ?>" placeholder="telefono" />
                            <select name="horaContacto" id="horaContacto">
                                <option value="">Elige Hora de contacto</option>
                                <option value="10:00 - 14:00" <?php if ($inmueble->getHoraContacto() == "10:00 - 14:00") echo "selected"; ?> >10:00 - 14:00</option>
                                <option value="14:00 - 17:00" <?php if ($inmueble->getHoraContacto() == "14:00 - 17:00") echo "selected"; ?> >14:00 - 17:00</option>
                                <option value="17:00 - 21:00" <?php if ($inmueble->getHoraContacto() == "17:00 - 21:00") echo "selected"; ?> >17:00 - 21:00</option>
                            </select>   
                            <input type="email" name="email" value="<?php echo $inmueble->getEmail(); ?>" id="email" placeholder="email" />  
                            <br/>
                            <br/>
                            <label for="archivos">Selecciona los archivos a subir (usa Mayúscula o Control para seleccion multiple)</label>
                            <input type="file" id="archivos" name="archivos[]" multiple>
                            <div id="list"></div>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" id="id" value="<?php echo $inmueble->getId(); ?>">
                            <input type="hidden" name="isactivo" id="isactivo" value="<?php echo $inmueble->getIsactivo(); ?>">
                            <input type="hidden" name="enlace" id="enlace" value="<?php echo $enlace; ?>">
                            <br/>
                            <br/>                            
                            <input type="submit"id="enviar" value="Actualizar" />
                        </form>	
                        <div id="imagenes">                                    
                            <?php
                            foreach ($imagen as $value) {
                                ?>
                                <div class="imagenBorrar">
                                    <img src="<?php echo $ruta . DIRECTORY_SEPARATOR . $value; ?>" alt='imagen' class='imagen'/>
                                    <a href="phpBorrarFoto.php?id=<?php echo $inmueble->getId(); ?>&foto=<?php echo $value; ?>" 
                                       class='borrarImg'>Borrar</a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>									
                </div>
            </div>
        </div>
        <?php
        $bd->closeConexion();
        include "../include/footer.php";
        ?>
    </body>
</html>

