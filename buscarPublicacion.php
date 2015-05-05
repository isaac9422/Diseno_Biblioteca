<?php

require('configs/include.php');

class c_buscarPublicacion extends super_controller {

    protected $publicacion;

    public function display() {

        if ($this->publicacion == NULL) {
            $this->publicacion = array();
        }
        
        $this->engine->assign('publicacion', $this->publicacion);
        $this->engine->assign('title', 'Resultados de la búsqueda');

        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('buscarpublicacion.tpl');
        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function lookup() {

        if (!isset($this->post->textoBusqueda)) { // cuando el campo esta vacio
            throw_exception("Debe ingresar un criterio de búsqueda.");
        }

        $criterio = $this->post->criterioBusqueda;
        $text = $this->post->textoBusqueda;
        
//        if($this->post->cantidad_disponible <= 3){
//            throw_exception("No hay ejemplares disponibles");
//        }

        $option['publicacion']['lvl2'] = $criterio;
        $auxiliars['publicacion'] = array("nombreAutor");
        $data['publicacion']['textoBusqueda'] = $text;
        $this->orm->connect();
        $this->orm->read_data(array("publicacion"), $option, $data); //read_data sirve para leer varias tablas al mismo tiempo
        $this->publicacion = $this->orm->get_objects("publicacion", NULL, $auxiliars); //recibe 3 campos pero los  ultimos son opcionales  

        $this->orm->close();
        
        //print_r2($auxiliars);

        if (count($this->publicacion) <= 0) {   //criterio no produce resultado
            throw_exception("No se produjo algún resultado");
        }
        //print_r2($this->publicacion);
    }

    public function run() {
        try {
            if (isset($this->get->option)) {
                $this->lookup();
            }
        } catch (Exception $e) {
            $this->error = 1;
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_buscarPublicacion();
$call->run();
?>
