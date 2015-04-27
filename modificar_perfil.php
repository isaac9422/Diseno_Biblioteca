<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_modificarPerfil extends super_controller {

    public function display() {

        $this->engine->assign('title', "Modificar Perfil");
        $this->asignarDatos();
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('modificarPerfil.tpl');
        $this->engine->display('footer.tpl');
    }

    public function asignarDatos() {
        $option[$this->session['tipo_usuario']]['lvl2'] = 'by_email';
        $data[$this->session['tipo_usuario']]['email'] = $this->session['email'];
        $user;

        $this->orm->connect();
        if ($this->session['tipo_usuario'] == 'usuario') {
            $this->orm->read_data(array("usuario"), $option, $data);
            $user = $this->orm->get_objects("usuario");
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            $this->orm->read_data(array("empleado"), $option, $data);
            $user = $this->orm->get_objects("empleado");
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            $this->orm->read_data(array("administrador"), $option, $data);
            $user = $this->orm->get_objects("administrador");
        }
        $user = $user[0];
        $this->orm->close();

        $this->engine->assign('objeto', $user);
    }

    public function modificar() {
        $user;
        //Verificación de los datos ingresados
        if (is_empty($this->post->contraseña)) {
            throw_exception("Contraseña no puede ser vacio");
        }
        if (is_empty($this->post->contraseñaA)) {
            throw_exception("Contraseña no puede ser vacio");
        }
        if (is_empty($this->post->email)) {
            throw_exception("Email no puede ser vacio");
        }
        if (is_empty($this->post->direccion)) {
            throw_exception("Dirección no puede ser vacia");
        }
        if (is_empty($this->post->telefono)) {
            throw_exception("Teléfono no puede ser vacio");
        } else {
            if (!is_numeric($this->post->telefono)) {
                throw_exception("(“Ingrese teléfono correctamente");
            }
        }
        if (is_empty($this->post->nombre)) {
            throw_exception("Nombre no puede ser vacio");
        }

        //Asignación por el tipo de usuario
        if ($this->session['tipo_usuario'] == 'usuario') {
            $user = new usuario($this->post);
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            $user = new empleado($this->post);
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            $user = new administrador($this->post);
        }

        $hasher = new PasswordHash(8, FALSE);
        if ($hasher->CheckPassword($this->post->contraseñaA, $this->post->contraseñaActual)) {

            $user->set('contraseña', $hasher->HashPassword($user->get('contraseña')));

            $this->orm->connect();
//
//            $option[$this->session['tipo_usuario']]['lvl2'] = 'by_email';
//            $data[$this->session['tipo_usuario']]['email'] = $user->get('email');
//            
//            $this->orm->read_data(array($this->session['tipo_usuario']), $option, $data);
//            $count = $this->orm->get_objects($this->session['tipo_usuario']);
//            if(isset($count)){
//                throw_exception("Email ya se encuentra registrado");
//            }

            $this->orm->update_data("normal", $user);
            $this->orm->close();

            $this->type_warning = "success";
            $this->msg_warning = "Perfil modificado correctamente";
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
        } else {
            throw_exception("Contraseña incorrecta");
        }
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

    public function run() {
        try {
            $tipo = $this->session['tipo_usuario'];
            if ($tipo != 'empleado' && $tipo != "usuario" && $tipo != "administrador") {
                header("location: index.php");
            }
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
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
        }
        $this->display();
    }

}

$call = new c_modificarPerfil();
$call->run();
?>