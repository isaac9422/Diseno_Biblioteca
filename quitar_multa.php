<?php

require('configs/include.php');

class c_update extends super_controller {

    public function update() {



        $usuario = new usuario($this->post);

        if (is_empty($usuario->get('identificacion'))) {
            throw_exception("Debe ingresar una identificacion");
        }


        $this->orm->connect();
        $this->orm->update_data("multa", $usuario);
        $this->orm->close();


        $this->type_warning = "success";
        $this->msg_warning = "Multa eliminada y estado Activo";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function display() {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('quitar_multa.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {


        try {

            $tipo = $this->session['tipo_usuario'];
            if ($tipo != 'empleado' && $tipo != "usuario" && $tipo != "administrador") {
                header("location: index.php");
            }

            if ($this->session['tipo_usuario'] == 'usuario') {
                //Llamar index de usuario
                header("location: inicio_usuario.php");
            } else if ($this->session['tipo_usuario'] == 'empleado') {
                //Llamar index de empleado
                header("location: inicio_empleado.php");
            }

            if (isset($this->get->option)) {
                $this->{$this->get->option}();
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

$call = new c_update();
$call->run();
?>

