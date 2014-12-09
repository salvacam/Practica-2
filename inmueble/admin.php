<?php
require '../require/comun.php';
$sesion->root("../index.php");
$resultado = $sesion->get("resultado");
$sesion->delete("resultado");
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}

$bd = new BaseDatos();
$modelo = new ModeloInmueble($bd);
$modeloProvincia = new ModeloProvincia($bd);
$filas = $modelo->getList($pagina, 10);
$total = $modelo->count();
$enlaces = Util::getEnlacesPaginacion($pagina, $total[0], 10);
?>

<!doctype html>
<html lang="es">

    <head>
        <title>Foto Casa Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/main.js"></script>
    </head>

    <body>
        <div id="contenedor">
            <?php include "../include/header.php"; ?>

            <div id="body">
                <div id="body-center">	
                    <p id="resultado"> <?php echo $resultado; ?> </p>
                    <a class="enlace" href="../"><span id="simbolo">&lt;</span>&nbsp;Salir de Adminsitrar</a>
                    <br/>
                    <div id="tabla">
                        <table border="1"><tr>
                                <th>Id</th>  
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>V / A</th>  <!-- alquiler o venta -->
                                <th>Precio</th>
                                <th>Hab.</th>                
                                <th>Baños</th>
                                <th>Provincia</th>
                                <th>Ciudad</th>
                                <th>Direccion</th>
                                <th>Email</th>
                                <th>Tlf</th>
                                <th>Hora</th>                
                                <th>Activo</th>
                                <th>Borrar</th>
                                <th>Editar</th>     
                            </tr>
                            <?php
                            foreach ($filas as $indice => $objeto) {
                                ?>
                                <tr>
                                    <td><?php echo $objeto->getId(); ?></td>
                                    <td><?php echo $objeto->getTipo(); ?></td>
                                    <td><?php echo $objeto->getEstado(); ?></td>
                                    <td><?php echo ($objeto->getIsalquiler()==1?"Alquiler":"Venta"); ?></td>
                                    <td><?php echo $objeto->getPrecio(); ?></td>
                                    <td><?php echo $objeto->getHabitaciones(); ?></td>
                                    <td><?php echo $objeto->getBanos(); ?></td>
                                    <td><?php 
                                        $provNumero = $objeto->getProvincia();
                                        $objetoProv = $modeloProvincia->get($provNumero);
                                        echo $objetoProv->getNombreProvincia();
                                         ?></td>                                    
                                    <td><?php echo $objeto->getCiudad(); ?></td>
                                    <td><?php echo $objeto->getDireccion(); ?></td>
                                    <td><?php echo $objeto->getEmail(); ?></td>
                                    <td><?php echo $objeto->getTelefono(); ?></td>
                                    <td><?php echo $objeto->getHoraContacto(); ?></td>
                                    <td><?php echo $objeto->getIsactivo();
                                                if($objeto->getIsactivo() == 0){
                                                    echo " <a href='phpActivar.php?id=".$objeto->getId()."'>Activar</a>";
                                                } else if($objeto->getIsactivo() == 1){
                                                    echo " <a href='phpDesactivar.php?id=".$objeto->getId()."'>Desact</a>";
                                                }
                                    ?></td>
                                    <td><a href="phpDelete.php?id=<?php echo $objeto->getId(); ?>" class="borrar" data-id="<?php echo $objeto->getId(); ?>"><img src="../img/borrar.png" alt="borrar"></a></td>
                                    <td><a href="viewUpdate.php?id=<?php echo $objeto->getId(); ?>" ><img src="../img/editar.png" alt="editar"></a></td>
                                </tr>
                                <?php
                            }
                            ?>        
                            <tr>
                                <td colspan="16" id="paginacion">                    
                                    <?php echo $enlaces["inicio"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["anterior"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["primero"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["segundo"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["actual"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["cuarto"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["quinto"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["siguiente"]; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $enlaces["ultimo"]; ?>
                                </td>
                            </tr>
                        </table>
                        <br/>



                    </div>
                    <a class="enlace" href="viewAdd.php">Añadir anuncio</a>
                </div>
            </div>
        </div>
        <?php include "../include/footer.php"; ?>
        <?php $bd->closeConexion(); ?>
    </body>

</html>
