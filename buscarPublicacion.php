<?php

require('configs/include.php');

class c_buscarPublicacion extends super_controller {

    protected $publicacion;

    public function lookup() {

        if (!isset($this->post->textoBusqueda)) { // cuando el campo esta vacio
            throw_exception("Debe ingresar un criterio de búsqueda.");
        }

        $criterio = $this->post->criterioBusqueda;
        $text = $this->post->textoBusqueda;

        $option['publicacion']['lvl2'] = $criterio;
        $auxiliars['publicacion'] = array("nombreAutor");
        $data['publicacion']['textoBusqueda'] = $text;
        $this->orm->connect();
        $this->orm->read_data(array("publicacion"), $option, $data); //read_data sirve para leer varias tablas al mismo tiempo
        $this->publicacion = $this->orm->get_objects("publicacion", NULL, $auxiliars); //recibe 3 campos pero los  ultimos son opcionales  

        $this->orm->close();

        if (count($this->publicacion) <= 0) {   //criterio no produce resultado
            throw_exception("No se produjo algún resultado");
        }
        //print_r2($this->publicacion);
    }

    public function display() {

        if ($this->publicacion == NULL) {
            $this->publicacion = array();
        }


        $criterio = array(array('by_codigo_publicacion', 'codigo publicacion'),
            array('by_autor', 'autor'),
            array('by_nombre', 'nombre publicacion'));

        //left join  en los dos  para las dos primeras si quiero buscar publicaciones sin autor       

        $this->engine->assign('publicacion', $this->publicacion);
        $this->engine->assign('criterio', $criterio);
        $this->engine->assign('title', 'Resultados de la búsqueda');

        $this->engine->display('header.tpl');
        $this->engine->display('message.tpl');
        $this->engine->display('buscarpublicacion.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if (isset($this->get->option)) {
                $this->lookup();
            }
        } catch (Exception $e) {
            $this->error = 1;
            //Se coge el mensaje arrojado por la excepcion
            $this->msg_warning = $e->getMessage();
            $this->type_warning = "error";

            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
        }
        $this->display();
    }

}

$call = new c_buscarPublicacion();
$call->run();
?>
