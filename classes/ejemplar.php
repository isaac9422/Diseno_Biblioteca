<?php

class ejemplar extends object_standard {

    //attributes
    protected $codigo_biblioteca;
    protected $codigo_publicacion;
    //components
    var $components = array();
    //auxiliars for primary key and for files
    var $auxiliars = array();

    //data about the attributes
    public function metadata() {
        return array("codigo_biblioteca" => array(), "codigo_publicacion" => array("foreign_name" => "e_p",
                          "foreign" => "publicacion", "foreign_attribute" => "codigo_publicacion"));
    }

    public function primary_key() {
        return array("codigo_publicacion", "codigo_biblioteca");
    }

    public function relational_keys($class, $rel_name) {
        switch ($class) {
            case "publicacion":
                switch ($rel_name) {
                    case "e_p":
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
