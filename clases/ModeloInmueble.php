<?php

class ModeloInmueble {

    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd;
    private $tabla = "casa_inmueble";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Inmueble $objeto) {
        $sql = "insert into $this->tabla values (null, :precio, :habitaciones,"
                . " :banos, :metros, :provincia, :direccion, :ciudad, :estado, "
                . ":tipo, :descripcion, :horaContacto, :telefono, :email,"
                . ":isalquiler, :isactivo);";
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["habitaciones"] = $objeto->getHabitaciones();
        $parametros["banos"] = $objeto->getBanos();
        $parametros["metros"] = $objeto->getMetros();
        $parametros["provincia"] = $objeto->getProvincia();
        $parametros["direccion"] = $objeto->getDireccion();
        $parametros["ciudad"] = $objeto->getCiudad();
        $parametros["estado"] = $objeto->getEstado();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["descripcion"] = $objeto->getDescripcion();
        $parametros["horaContacto"] = $objeto->getHoraContacto();
        $parametros["telefono"] = $objeto->getTelefono();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isalquiler"] = $objeto->getIsalquiler();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //return 0 si no fuera autonumerico        
    }

    function delete(Inmueble $objeto) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function deletePorId($id) {
        return $this->delete(new Inmueble($id));
    }

    //clave principal autonumérica
    function edit(Inmueble $objeto) {
        $sql = "update $this->tabla set precio=:precio, habitaciones=:habitaciones,"
                . "banos=:banos, metros=:metros, provincia=:provincia, "
                . "direccion=:direccion, ciudad=:ciudad, estado=:estado, "
                . "tipo=:tipo, descripcion=:descripcion, horaContacto=:horaContacto,"
                . "telefono=:telefono, email=:email, isalquiler=:isalquiler, "
                . "isactivo=:isactivo where id=:id;";
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["habitaciones"] = $objeto->getHabitaciones();
        $parametros["banos"] = $objeto->getBanos();
        $parametros["metros"] = $objeto->getMetros();
        $parametros["provincia"] = $objeto->getProvincia();
        $parametros["direccion"] = $objeto->getDireccion();
        $parametros["ciudad"] = $objeto->getCiudad();
        $parametros["estado"] = $objeto->getEstado();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["descripcion"] = $objeto->getDescripcion();
        $parametros["horaContacto"] = $objeto->getHoraContacto();
        $parametros["telefono"] = $objeto->getTelefono();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isalquiler"] = $objeto->getIsalquiler();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function activarUser($enlace) {
        $sql = "update $this->tabla "
                . "set isactivo = 1 "
                . "where isactivo = 0 and md5(concat(email,'" . Configuracion::PEZARANA . "',id))=:enlace;";
        $parametros["enlace"] = $enlace;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    //le paso el id y me devuelve el objeto inmueble
    function getEnlace($enlace) {
        $sql = "select * from $this->tabla where md5(concat(email,'" . Configuracion::PEZARANA . "',id))=:enlace;";
        $parametros["enlace"] = $enlace;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $inmueble = new Inmueble();
            $inmueble->set($this->bd->getFila());
            return $inmueble;
        }
        return null;
    }

    function activar($id) {
        $sql = "update $this->tabla "
                . "set isactivo = 1 "
                . "where isactivo = 0 and id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function desactivar($id) {
        $sql = "update $this->tabla "
                . "set isactivo = 0 "
                . "where isactivo = 1 and id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function desactivarUser($enlace) {
        $sql = "update $this->tabla "
                . "set isactivo = 0 "
                . "where isactivo = 1 and md5(concat(email,'" . Configuracion::PEZARANA . "',id))=:enlace;";
        $parametros["enlace"] = $enlace;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            //return $this->bd->getFila()[0];
            return $this->bd->getFila();
        }
        return -1;
    }

    function getNumeroPaginas($rpp = Configuracion::RPP) {
        $lista = $this->count();
        return (ceil($lista[0] / $rpp) - 1);
        //return (ceil($this->count()[0] / $rpp) - 1);
    }

    //le paso el id y me devuelve el objeto completo
    function get($id) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $inmueble = new Inmueble();
            $inmueble->set($this->bd->getFila());
            return $inmueble;
        }
        return null;
    }

    function getList($pagina = 0, $rpp = Configuracion::RPP, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $inmueble = new Inmueble();
                $inmueble->set($fila);
                $list[] = $inmueble;
            }
        } else {
            return null;
        }
        return $list;
    }

    function getListSinPaginar($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $inmueble = new Inmueble();
                $inmueble->set($fila);
                $list[] = $inmueble;
            }
        } else {
            return null;
        }
        return $list;
    }

    function selectHtml($id, $name, $condicion, $parametros, $orderBy = "1", $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getListSinPaginar($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getId() . "'>"
                    . $objeto->getDescripcion() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

    function getListColumna($columna) {
        $list = array(); //$list = [];
        $sql = "select distinct $columna from $this->tabla";
        $r = $this->bd->setConsulta($sql, array());
        if ($r) {
            while ($list[] = $this->bd->getFila()) {
                $list[] = $this->bd->getFila();
            }
        } else {
            return null;
        }
        return $list;
    }

    function getListColumnaExt($tablaExt, $nombreColExt, $colExtComp, $columna) {
        $list = array(); //$list = [];
        $sql = "select distinct $columna, $nombreColExt "
                . "from $this->tabla, $tablaExt "
                . "where $this->tabla.$columna=$tablaExt.$colExtComp";
        $r = $this->bd->setConsulta($sql, array());
        if ($r) {
            while ($list[] = $this->bd->getFila()) {
                $list[] = $this->bd->getFila();
            }
        } else {
            return null;
        }
        return $list;
    }

    function selectHTMLColumna($columna, $id, $name, $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        $lista = $this->getListColumna($columna);
        foreach ($lista as $valor) {
            if ($valor) {
                $select .= "<option value='" . $valor[0] . "'>"
                        . $valor[0] . "</option>";
            }
        }
        $select .= "</select>";
        return $select;
    }

    function selectHTMLColumnaExt($tablaExt, $nombreColExt, $colExtComp, $columna, $id, $name, $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        $lista = $this->getListColumnaExt($tablaExt, $nombreColExt, $colExtComp, $columna);
        foreach ($lista as $valor) {
            if ($valor) {
                $select .= "<option value='" . $valor[0] . "'>"
                        . $valor[1] . "</option>";
            }
        }
        $select .= "</select>";
        return $select;
    }

}
