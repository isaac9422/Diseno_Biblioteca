<?php

require('configs/include.php');

class c_registrar_publicacion extends super_controller {

    public function verificar() {
        $publicacion = new publicacion($this->post);
        if (is_empty($publicacion->get('codigo_biblioteca'))) {
            throw_exception("Ingrese Código Biblioteca correctamente");
        }else if(is_empty($publicacion->get('codigo_publicacion'))){
            throw_exception("Ingrese Código publicación correctamente");
        }else if(is_empty($publicacion->get('nombre'))){
            throw_exception("Ingrese nombre correctamente");
        }else if(is_empty($publicacion->get('categoria'))){
            throw_exception("Ingrese categoría correctamente");
        }else if(is_empty($publicacion->get('tipo'))){
            throw_exception("Ingrese tipo correctamente");
        }else if(is_empty($publicacion->get('fecha_publicacion'))){
            throw_exception("Ingrese Fecha publicación correctamente");
        }
        $this->registrar($publicacion);
    }

    public function registrar($publicacion) {
        $this->orm->connect();
        $this->orm->insert_data("normal", $publicacion);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Publicación registrada correctamente";

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
        $this->engine->display('registrar_publicacion.tpl');
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
            if (isset($this->post->btn_registrar_publicacion)) {
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

$call = new c_registrar_publicacion();
$call->run();
?>
