<?php
require('configs/include.php');

class c_modificarPerfil extends super_controller {

    public function display() {
        $this->engine->assign('title', $this->gvar['n_index']);

        $this->engine->display('header.tpl');
        if(isset($this->msg_warning)){
            $this->engine->display('message.tpl');
        }
        $this->engine->display('modificarPerfil.tpl');
        $this->engine->display('footer.tpl');
    }

    public function modificar() {
        
            $this->msg_warning = "Hola Mundo";
            $this->type_warning = "success";
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            //$this->engine->display('message.tpl');
    }

    public function run() {
        try {
            if (!isset($this->get->option)) {
                throw_exception("No estas accediendo a un lugar disponible ");
            } else {
                if ($this->get->option === "modificar") {
                    $this->{$this->get->option}();
                } else {
                    throw_exception("No estas accediendo a un lugar disponible");
                }
            }
        } catch (Exception $e) {
            $this->error = 1;
            //Se coge el mensaje arrojado por la excepcion
            $this->msg_warning = $e->getMessage();
            $this->type_warning = "error";
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_modificarPerfil();
$call->run();
?>