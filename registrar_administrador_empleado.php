<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_registrar_administrador_empleado extends super_controller {

    public function verificar($usuario) {
        
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
        
        return $usuario;
        //que no este insertado en la base

    }

    public function registrarEmpleado($usuario) {
        
        $hasher = new PasswordHash(8, FALSE);
        $encriptada = $hasher->HashPassword($usuario->get('contraseña'));
        unset($hasher);

        $usuario->set('contraseña', $encriptada);
   
        
        $this->orm->connect();
        $this->orm->insert_data("normal", $usuario);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Empleado registrado correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }
    
        public function registrarAdministrador($usuario) {
        
        $hasher = new PasswordHash(8, FALSE);
        $encriptada = $hasher->HashPassword($usuario->get('contraseña'));
        unset($hasher);

        $usuario->set('contraseña', $encriptada);

        
        $this->orm->connect();
        $this->orm->insert_data("normal", $usuario);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Administrador registrado correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function display() {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('registrar_administrador_empleado.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if(!isset($this->session)){
             //   header("location: index.php");
            }
            if (isset($this->post->btn_registrar_empleado)) {
                $empleado = new empleado($this->post);
                $aux = $this->verificar($empleado);
                $this->registrarEmpleado($aux);
            }
            if (isset($this->post->btn_registrar_administrador)) {
                $administrador = new administrador($this->post);
                $aux = $this->verificar($administrador);
                $this->registrarAdministrador($aux);
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

$call = new c_registrar_administrador_empleado();
$call->run();
?>
