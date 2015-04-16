<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_login extends super_controller {

    public function ingresar() {
        $option['usuario']['lvl2'] = 'by_email';
        $data['usuario']['email'] = $this->post->email;
        $this->orm->connect();
        $this->orm->read_data(array("usuario"), $option, $data);
        $usuario = $this->orm->get_objects("usuario");
        $this->orm->close();

        $usuario = $usuario[0];
        //print_r2($usuario);
        $encriptada = $usuario->get('contraseña');

        $contraseña = $this->post->contraseña;
        $hasher = new PasswordHash(8, FALSE);

        if ($hasher->CheckPassword($contraseña, $encriptada)) {
            //session_start();
            //print_r2($encriptada);
            $_SESSION['email'] = $usuario->get('email');
            $_SESSION['nombre'] = $usuario->get('nombre');
            $_SESSION['tipo_usuario'] = $this->post->rol;
            $this->session = $_SESSION;
            //print_r2($this->session);
            header("location: index.php");
        } else {
            print_r2($encriptada);
        }

        unset($hasher);
    }

    public function salir() {
        unset($this->session);
        session_destroy();
        header("location: index.php");
    }

    public function display() {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('login.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if (isset($this->post->btn_ingresar)) {
                $this->ingresar();
            } elseif (isset($this->post->btn_salir)) {
                $this->salir();
            }
        } catch (Exception $e) {
            $this->error = 1;
            $this->engine->assign('object', $this->post);
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_login();
$call->run();
?>


