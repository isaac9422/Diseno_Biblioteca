<?php

require('configs/include.php');

class c_registrar_autor extends super_controller {

    public function verificar() {
        $autor = new autor($this->post);
        if (is_empty($autor->get('nombre'))) {
            throw_exception("Ingrese nombre correctamente");
        }
        $this->registrar($autor);
    }

    public function registrar($autor) {
        $this->orm->connect();
        $this->orm->insert_data("normal", $autor);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Autor registrado correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function cancelar() {
        //Definir a cual página de inicio debe ser redireccionado
        if ($this->session['tipo_usuario'] == 'usuario') {
            //Llamar index de usuario
            header("location: inicio_usuario.php");
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            //Llamar index de empleado
            header("location: inicio_empleado.php");
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            //Llamar index de administrador
            header("location: inicio_administrador.php");
        } else {
            header("location: index.php");
        }
    }

    public function display() {
        $this->engine->assign('title', 'Registrar autor');
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('registrar_autor.tpl');

        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            $tipo = $this->session['tipo_usuario'];
            if ($tipo == "usuario" || $tipo == "administrador") {
                header("location: inicio_$tipo.php");
            }else if($tipo != 'empleado'){
                header("location: index.php");
            }
            if (isset($this->post->btn_registrar_autor)) {
                $this->verificar();
            }
            if (isset($this->post->btn_cancelar)) {
                $this->cancelar();
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

$call = new c_registrar_autor();
$call->run();
?>
