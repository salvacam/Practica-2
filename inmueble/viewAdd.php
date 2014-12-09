<?php
require '../require/comun.php';
$sesion->root("../index.php");
$bd = new BaseDatos();
$modeloProvincia = new ModeloProvincia($bd);
$modeloInmueble = new ModeloInmueble($bd);
?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Foto Casa Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/formulario.js"></script>
    </head>

    <body>
        <div id="contenedor">
            <?php include "../include/header.php"; ?>

            <div id="body">
                <div id="body-center">	
                    <a class="enlace" href="admin.php"><span id="simbolo">&lt;</span>&nbsp;Volver</a>
                    <div class="campo">
                        <br/>
                        <form action="phpInsert.php" method="POST" enctype="multipart/form-data">                                                       
                            <select name="tipo" id="tipo">
                                <option value="">Tipo de inmueble</option>
                                <option value="Piso" >Piso</option>
                                <option value="Chalet">Chalet</option>
                                <option value="Duplex">Duplex</option>
                                <option value="Unifamiliar">Unifamiliar</option>   
                                <option value="Estudio">Estudio</option>
                                <option value="Local">Local</option>
                                <option value="Trastero">Trastero</option>
                                <option value="Garaje">Garaje</option>                          
                            </select>  
                            <label for="venta">Venta</label>
                            <input name="isalquiler" id="venta" value="0" type="radio" >
                            <label for="alquiler">Alquiler</label>
                            <input name="isalquiler" id="alquiler" value="1" type="radio">
                            <input type="text" name="precio" value="" id="precio" placeholder="precio"/>
                            <input type="number" name="metros" value="" id="metros" placeholder="metros" />
                            <br/>
                            <br/>
                            <select name="habitaciones" id="habitaciones">
                                <option value="">Nº de habitaciones</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>   
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7 o más</option>                         
                            </select>
                            <select name="banos" id="banos">
                                <option value="">Nº de baños</option>                                
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4 o más</option>   
                            </select>                    
                            <select name="estado" id="estado">
                                <option value="">Estado del inmueble</option>
                                <option value="A estrenar">A estrenar</option>
                                <option value="Reformado">Reformado</option>
                                <option value="En buen estado">En buen estado</option>
                                <option value="A reformar">A reformar</option>                            
                            </select>    
                            <br/>
                            <br/>
                            <?php echo $modeloProvincia->selectHtml("provincia", "provincia", "1=1", array(), "1", "", TRUE, "Elige Provincia"); ?>
                            <input type="text" name="direccion" value="" id="direccion" placeholder="direccion" />
                            <input type="text" name="ciudad" value="" id="ciudad" placeholder="ciudad" />    
                            <br/>
                            <br/>
                            <textarea name="descripcion" id="descripcion" rows="5" cols="70" >Descripcion</textarea>      
                            <br/>
                            <br/>                 
                            <input type="text" id="telefono" name="telefono" value="" placeholder="telefono" />
                            <select name="horaContacto" id="horaContacto">
                                <option value="">Elige Hora de contacto</option>
                                <option value="10:00 - 14:00">10:00 - 14:00</option>
                                <option value="14:00 - 17:00">14:00 - 17:00</option>
                                <option value="17:00 - 21:00">17:00 - 21:00</option>
                            </select>   
                            <input type="email" name="email" value="" id="email" placeholder="email" />  
                            <br/>
                            <br/>
                            <label for="archivos">Selecciona los archivos a subir (usa Mayúscula o Control para seleccion multiple)</label>
                            <input type="file" id="archivos" name="archivos[]" multiple>
                            <div id="list"></div>
                            <br/>
                            <br/>
                            <label for="isactivo">Activo</label>   
                            <input type="checkbox" name="isactivo" id="isactivo"/>
                            <input type="reset" id="reset" value="Limpiar" />
                            <input type="submit"id="enviar" value="Insertar" />
                        </form>	
                    </div>									
                </div>
            </div>
        </div>
        <?php include "../include/footer.php"; ?>
    </body>
</html>
