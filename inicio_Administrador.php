<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_inicioAdministrador extends super_controller {

    public function display() {
        $this->engine->assign('title', $this->gvar['n_index']);

        $this->engine->display('header.tpl');

        $this->engine->display('index.tpl');

        if (!is_null($this->msg_warning)) {
            $this->engine->display('message.tpl');
            unset($this->msg_warning);
        }

        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            $this->display();
        } catch (Exception $e) {
            $this->error = 1;
            $this->engine->assign('object', $this->post);
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
    }

}

$call = new c_inicioAdministrador();
$call->run();
?>