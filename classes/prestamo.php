<?php

class prestamo extends object_standard {

    //attributes
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $fecha_entrega;
    protected $codigo_biblioteca;
    protected $usuario;
    protected $cantidad_renovacion;
    //components
    var $components = array();
    //auxiliars for primary key and for files
    var $auxiliars = array();

    //data about the attributes
    public function metadata() {
        return array("fecha_inicio" => array(), "fecha_fin" => array(), "usuario" => array("foreign_name" => "p_u",
            "foreign" => "usuario", "foreign_attribute" => "identificacion"),
            "codigo_biblioteca" => array("foreign_name" => "p_p", "foreign" => "publicacion",
                "foreign_attribute" => "codigo_biblioteca"), "cantidad_renovacion" => array(),
            "fecha_entrega" => array());
    }

    public function primary_key() {
        return array("codigo_biblioteca", "usuario", "fecha_inicio");
    }

    public function relational_keys($class, $rel_name) {
        switch ($class) {
            case "usuario":
                switch ($rel_name) {
                    case "p_u":
                        return array("usuario");
                        break;
                }
                break;
            case "publicacion":
                switch ($rel_name) {
                    case "p_p":
                        return array("publicacion");
                        break;
                }
                break;
            default:
                break;
        }
    }

}

?>
