<?php
require('configs/include.php');

class c_index extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Página Inicial');

        $this->engine->display('header.tpl');

        $this->engine->display('buscarpublicacion.tpl');

        $this->engine->display('menu.tpl');

        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if (isset($this->session['tipo_usuario'])) {
                $tipo = $this->session['tipo_usuario'];
                if ($tipo === 'empleado' || $tipo === "usuario" || $tipo === "administrador") {
                    header("location: inicio_$tipo.php");
                }
            }
        } catch (Exception $e) {
            $this->error = 1;
            $this->engine->assign('object', $this->post);
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = $this->display();
        }
        $this->display();
    }

}

$call = new c_index();
$call->run();
?>