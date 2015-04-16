<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_modificarPerfil extends super_controller {

    public function display() {

        $this->engine->assign('title', "Modificar Perfil");
        $option['usuario']['lvl2'] = 'by_email';
        $data['usuario']['email'] = $this->session['email'];
        $user;

        $this->orm->connect();
        if ($this->session['tipo_usuario'] == 'usuario') {
            $this->orm->read_data(array($this->session['tipo_usuario']), $option, $data);
            $user = $this->orm->get_objects("usuario");
            $user = $user[0];
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            $this->orm->read_data(array($this->session['tipo_usuario']), $option, $data);
            $user = $this->orm->get_objects("usuario");
            $user = $user[0];
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            $this->orm->read_data(array($this->session['tipo_usuario']), $option, $data);
            $user = $this->orm->get_objects("usuario");
            $user = $user[0];
        }
        $this->orm->close();

        $this->engine->assign('objeto', $user);
        $this->engine->display('header.tpl');
        $this->engine->display('modificarPerfil.tpl');
        $this->engine->display('footer.tpl');
    }

    public function modificar() {
        $user;

        if ($this->session['tipo_usuario'] == 'usuario') {
            $user = new usuario($this->post);
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            $user = new empleado($this->post);
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            $user = new administrador($this->post);
        }

        $hasher = new PasswordHash(8, FALSE);
        $encriptada = $hasher->HashPassword($user->get('contraseña'));

        if ($hasher->CheckPassword($user->get('contraseña'), $encriptada)) {

            $user->set('contraseña', $encriptada);

            if (is_empty($user->get('email'))) {
                throw_exception("Debe ingresar un email");
            }
            $user->auxiliars['emailViejo'] = $this->post->emailOld;
            $user->auxiliars['password'] = $hasher->HashPassword($user->get('contraseña'));
            
            $this->orm->connect();
            $this->orm->update_data("normal", $user);
            $this->orm->close();

            //Se especifica el tipo y el mensaje de warning(mensaje) que se va a mostrar
            $this->type_warning = "success";
            $this->msg_warning = "Perfil modificado correctamente";
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
        } else {
            throw_exception("Contraseñan no coincide con e-mail");
        }
    }

    public function cancelar() {

        $this->msg_warning = "Has cancelado el proceso de modificaión";
        $this->type_warning = "success";
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
        $this->engine->display('message.tpl');

        if ($this->session['tipo_usuario'] == 'usuario') {
            //Llamar index de usuario
            header("location: inicio_Usuario.php");
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            //Llamar index de empleado
            header("location: inicio_Empleado.php");
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            //Llamar index de administrador
            header("location: inicio_Administrador.php");
        } else {
            header("location: index.php");
        }
    }

    public function run() {
        try {
            if (isset($this->post->modificar)) {
                $this->modificar();
            }
            if (isset($this->post->cancelar)) {
                $this->cancelar();
            }
        } catch (Exception $e) {
            $this->error = 1;
            //Se coge el mensaje arrojado por la excepcion
            $this->msg_warning = $e->getMessage();
            $this->type_warning = "error";
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->engine->display('message.tpl');
        }
        $this->display();
    }

}

$call = new c_modificarPerfil();
$call->run();
?>