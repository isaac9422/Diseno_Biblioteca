<?php

require('configs/include.php');

class c_administrar extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Administrar cuenta');
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('administrar_cuenta.tpl');

        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function administrar() {
        $usuario = new usuario($this->post);
        // print_r2($usuario);

        if (is_empty($usuario->get('identificacion'))) {
            throw_exception("Debe ingresar una identificacion");
        }

        $id = ($usuario->get('identificacion'));

        $cod['usuario']['identificacion'] = $id;
        $options['usuario']['lvl2'] = "id"; //Para que salga todo con todo -> Cambiar Aqui a all.

        $this->orm->connect();
        $this->orm->read_data(array("usuario"), $options, $cod);  // Arreglo de nombre de las tablas que voy a leer. 
        $usuario_existe = $this->orm->get_objects("usuario");
        $this->orm->close();



        if (!isset($usuario_existe)) {
            throw_exception("Usuario No encontrado");
        }

        $this->orm->connect();
        $this->orm->update_data("bloquear", $usuario);
        $this->orm->close();


        $this->type_warning = "success";
        $this->msg_warning = "Estado de Usuario Cambiado";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
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
            if (isset($this->post->cancelar)) {
                header("location: index.php");
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

$call = new c_administrar();
$call->run();
?>
