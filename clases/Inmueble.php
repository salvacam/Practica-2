<?php

class Inmueble {
    //orden de las variables en el orden de la tabla
    private $id;	
    private $precio;
    private $habitaciones;
    private $banos;
    private $metros;
    private $provincia;
    private $direccion;
    private $ciudad;
    private $estado;
    private $tipo;
    private $descripcion;
    private $horaContacto;
    private $telefono;
    private $email;
    private $isalquiler;
    private $isactivo;

    //orden igual que las variables, parametros por defecto null
    function __construct($id = null, $precio = null, $habitaciones = null, 
            $banos = null, $metros = null, $provincia = null, $direccion = null,
            $ciudad = null, $estado = null, $tipo = null, $descripcion = null,
            $horaContacto = null, $telefono = null, $email = null,
            $isalquiler = null, $isactivo = null) {
        $this->id = $id;
        $this->precio = $precio;
        $this->habitaciones = $habitaciones;
        $this->banos = $banos;
        $this->metros = $metros;
        $this->provincia = $provincia;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
        $this->estado = $estado;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->horaContacto = $horaContacto;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->isalquiler = $isalquiler;
        $this->isactivo = $isactivo;
    }
    
    //array de datos y posicion inicial
    function set($datos, $inicio=0){
        $this->id= $datos[0 + $inicio];
        $this->precio = $datos[1 + $inicio];  
        $this->habitaciones = $datos[2 + $inicio];
        $this->banos = $datos[3 + $inicio];
        $this->metros = $datos[4 + $inicio];
        $this->provincia = $datos[5 + $inicio];
        $this->direccion = $datos[6 + $inicio];
        $this->ciudad = $datos[7 + $inicio];
        $this->estado = $datos[8 + $inicio];
        $this->tipo = $datos[9 + $inicio];
        $this->descripcion = $datos[10 + $inicio];
        $this->horaContacto = $datos[11 + $inicio];
        $this->telefono = $datos[12 + $inicio];
        $this->email = $datos[13 + $inicio];
        $this->isalquiler = $datos[14 + $inicio];
        $this->isactivo = $datos[15 + $inicio];
    }
    
    function getId() {
        return $this->id;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getHabitaciones() {
        return $this->habitaciones;
    }

    function getBanos() {
        return $this->banos;
    }

    function getMetros() {
        return $this->metros;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getHoraContacto() {
        return $this->horaContacto;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getIsalquiler(){
        return $this->isalquiler;        
    }

    function getIsactivo() {
        return $this->isactivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setHabitaciones($habitaciones) {
        $this->habitaciones = $habitaciones;
    }

    function setBanos($banos) {
        $this->banos = $banos;
    }

    function setMetros($metros) {
        $this->metros = $metros;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setHoraContacto($horaContacto) {
        $this->horaContacto = $horaContacto;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIsalquiler($isalquiler){
        $this->isalquiler = $isalquiler;
    }
    
    function setIsactivo($isactivo) {
        $this->isactivo = $isactivo;
    }


}
