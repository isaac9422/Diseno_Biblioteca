<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_login extends super_controller {


    public function verificar() {
         if (is_empty($this->post->email)) {
            throw_exception("Contraseñan no coincide con e-mail");
        } elseif (is_empty($this->post->contraseña)) {
            throw_exception("Contraseñan no coincide con e-mail");
        } elseif (is_empty($this->post->rol)) {
            throw_exception("Usuario no encontrado,favor registrarse");
        }
    }
    
    public function ingresar() {
        $option['usuario']['lvl2'] = 'by_email';
        $data['usuario']['email'] = $this->post->email;
        $tipo_usuario = $this->post->rol;
        $this->orm->connect();
        $this->orm->read_data(array($tipo_usuario), $option, $data);
        $usuario = $this->orm->get_objects("usuario");
        $this->orm->close();
        
        if(is_empty($usuario)){
            {throw_exception("Contraseñan no coincide con e-mail");}
        }

        $usuario = $usuario[0];

        $encriptada = $usuario->get('contraseña');

        $contraseña = $this->post->contraseña;
        $hasher = new PasswordHash(8, FALSE);

        if ($hasher->CheckPassword($contraseña, $encriptada)) {
            $_SESSION['objeto_usuario']=$usuario;
            $_SESSION['tipo_usuario'] = $this->post->rol;
            $_SESSION['email'] = $this->post->email;
            $this->session = $_SESSION;

            header("location: index.php");
        } else {
            {throw_exception("Contraseñan no coincide con e-mail");}
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
        $this->engine->display('index.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if (isset($this->post->btn_ingresar)) {
                $this->verificar();
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


