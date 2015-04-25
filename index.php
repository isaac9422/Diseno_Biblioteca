<?php
require('configs/include.php');

class c_index extends super_controller {

    public function display() {
        
        $criterio=array(array('by_codigo_publicacion','codigo publicacion'),
                          array('by_autor','autor'),
                            array('by_nombre','nombre autor'));
        
        $this->engine->assign('criterio', $criterio);
        
        $this->engine->assign('title', $this->gvar['n_index']);

        $this->engine->display('header.tpl');

        $this->engine->display('index.tpl');
        
        $this->engine->display('buscarpublicacion.tpl');

        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            
        } catch (Exception $e) {
            $this->error = 1;
            $this->engine->assign('object', $this->post);
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = $this->display();
            'message.tpl';
        }
        $this->display();
    }

}

$call = new c_index();
$call->run();
?>