<?php

require('configs/include.php');

class c_buscarPublicacion extends super_controller {

    protected $publicacion;

    public function display() {

        if ($this->publicacion == NULL) {
            $this->publicacion = array();
        }

        $this->engine->assign('publicacion', $this->publicacion);
        $this->engine->assign('title', 'Buscar');

        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('buscarpublicacion.tpl');
        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function lookup() {

        if (is_empty($this->post->textoBusqueda)) { // cuando el campo esta vacio
            throw_exception("Debe ingresar un criterio de búsqueda.");
        }

        $criterio = $this->post->criterioBusqueda;
        $text = $this->post->textoBusqueda;

//        if($this->post->cantidad_disponible <= 3){
//            throw_exception("No hay ejemplares disponibles");
//        }

        $option['publicacion']['lvl2'] = $criterio;
        $auxiliars['publicacion'] = array("nombreAutor", "cantidad");
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

    public function adicionar() {
        if (!isset($this->post->buscados)) {
            $this->type_warning = "warning";
            $this->msg_warning = "No has seleccionado nada";
            $this->temp_aux = 'message.tpl';
        } else {
            $ejemplar = new ejemplar();
            $buscados = array();
            
            if(isset($this->session['libros'])){
                
                $buscados =$this->session['libros'];
                
            }
            
            
            foreach ($this->post->buscados as $seleccionado){  //se recibe una lista con todos las publicaciones
                
                $ejemplar->set('codigo_publicacion', $seleccionado); 
                
               
                
                array_push($buscados, serialize($ejemplar));
               
            }
            $_SESSION['libros'] = $buscados;
            $this->session = $_SESSION;
        }
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function run() {
        try {
            if (isset($this->get->option)) {
                $this->lookup();
            }
            if (isset($this->post->adicionar)) {
                $this->adicionar();
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
