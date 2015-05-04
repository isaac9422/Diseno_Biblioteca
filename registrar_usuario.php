<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_registrar_usuario extends super_controller {

    public function verificar() {
        $usuario = new usuario($this->post);
        if (is_empty($usuario->get('email'))) {
            throw_exception("Ingrese e-mail correctamente");
        } elseif (is_empty($usuario->get('identificacion'))) {
            throw_exception("Ingrese una identificación");
        } elseif (is_empty($usuario->get('nombre'))) {
            throw_exception("Ingrese un nombre");
        } elseif (is_empty($usuario->get('direccion'))) {
            throw_exception("Ingrese una direccion");
        } elseif (is_empty($usuario->get('telefono'))) {
            throw_exception("Ingrese una telefono");
        } elseif (is_empty($usuario->get('contraseña'))) {
            throw_exception("Ingrese una contraseña");
        } elseif (is_empty($this->post->contraseña2)) {
            throw_exception("Ingrese una contraseña");
        } elseif ($this->post->contraseña2 != $usuario->get('contraseña')) {
            throw_exception("No coincide contraseña");
        }

        //que no este insertado en la base

        $hasher = new PasswordHash(8, FALSE);
        $encriptada = $hasher->HashPassword($usuario->get('contraseña'));
        unset($hasher);
        //echo "registrar" + $encriptada;
        $usuario->set('contraseña', $encriptada);
        $this->registrar($usuario);
    }

    public function registrar($usuario) {
        $this->orm->connect();
        $this->orm->insert_data("normal", $usuario);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Usuario registrado correctamente";

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
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('registrar_usuario.tpl');
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
            if (isset($this->post->btn_registrar_usuario)) {
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

$call = new c_registrar_usuario();
$call->run();
?>
