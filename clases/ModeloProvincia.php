<?php

class ModeloProvincia {

    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd;
    private $tabla = "casa_provincia";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Provincia $objeto) {
        $sql = "insert into $this->tabla values (null, :nombreProvincia);";
        $parametros["nombreProvincia"] = $objeto->getNombreProvincia();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //return 0 si no fuera autonumerico        
    }

    function delete(Provincia $objeto) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $objeto->getIdProvincia();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function deletePorId($id) {
        return $this->delete(new Provincia($id));
    }

    //clave principal autonumérica
    function edit(Provincia $objeto) {
        $sql = "update $this->tabla set nombreProvincia=:nombreProvincia "
                . "where id=:id;";
        $parametros["nombreProvincia"] = $objeto->getNombreProvincia();
        $parametros["idProvincia"] = $objeto->getIdProvincia();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    //le paso el id y me devuelve el objeto completo
    function get($idProvincia) {
        $sql = "SELECT * FROM $this->tabla WHERE idProvincia=:idProvincia;";
        $parametros["idProvincia"] = $idProvincia;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $provincia = new Provincia();
            $provincia->set($this->bd->getFila());
            return $provincia;
        }
        return null;
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

    function getListPaginado($pagina = 0, $rpp = Configuracion::RPP, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $provincia = new Provincia();
                $provincia->set($fila);
                $list[] = $provincia;
            }
        } else {
            return null;
        }
        return $list;
    }

    function getList($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $provincia = new Provincia();
                $provincia->set($fila);
                $list[] = $provincia;
            }
        } else {
            return null;
        }
        return $list;
    }

    function selectHtml($id, $name, $condicion = "1=1", $parametros = array(), $orderBy = "1", $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getIdProvincia() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getIdProvincia() . "'>"
                    . $objeto->getNombreProvincia() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

}
