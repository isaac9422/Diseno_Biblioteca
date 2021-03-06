<?php

require('configs/include.php');

class c_buscarPublicacion extends super_controller {

    protected $publicacion;

    public function display() {

        $this->engine->assign('title', 'Buscar Publicación');

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
        $this->engine->assign('publicacion', $this->publicacion);
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
            
            $this->type_warning = "success";
            $this->msg_warning = "Has agregado una publicación para ser prestada";
            $this->temp_aux = 'message.tpl';
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
