<?php

class Provincia {
    //orden de las variables en el orden de la tabla
    private $idProvincia;	
    private $nombreProvincia;
    
    //orden igual que las variables, parametros por defecto null
    function __construct($idProvincia = null, $nombreProvincia = null) {
        $this->idProvincias = $idProvincia;
        $this->nombreProvincias = $nombreProvincia;
    }
    
    //array de datos y posicion inicial
    function set($datos, $inicio=0){
        $this->idProvincia= $datos[0 + $inicio];
        $this->nombreProvincia = $datos[1 + $inicio];  
    }
    
    function getIdProvincia() {
        return $this->idProvincia;
    }

    function getNombreProvincia() {
        return $this->nombreProvincia;
    }

    function setIdProvincia($idProvincias) {
        $this->idProvincia = $idProvincia;
    }

    function setNombreProvincia($nombreProvincia) {
        $this->nombreProvincia = $nombreProvincia;
    }


}
