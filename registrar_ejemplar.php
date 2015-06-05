<?php

require('configs/include.php');

class c_registrar_ejemplar extends super_controller {

    public function verificar() {
        $ejemplar = new ejemplar($this->post);
        // print_r2($ejemplar);
        if (is_empty($ejemplar->get('codigo_publicacion'))) {
            throw_exception("Ingrese Código publicación correctamente");
        } else if (is_empty($ejemplar->get('codigo_biblioteca'))) {
            throw_exception("Ingrese Código biblioteca correctamente");
        }

        $this->registrar($ejemplar);
    }

    public function registrar($ejemplar) {
        $this->orm->connect();
        $this->orm->insert_data("normal", $ejemplar);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Ejemplar registrado correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function mostrar_publicacion() {
        $option['publicacion']['lvl2'] = 'all';
        $this->orm->connect();
        $this->orm->read_data(array("publicacion"), $option);
        $publicacion = $this->orm->get_objects("publicacion");
        $this->orm->close();

        function cmp($a, $b) {
            return strcmp($a->get('nombre'), $b->get('nombre'));
        }

        usort($publicacion, "cmp");

        $this->engine->assign('publicaciones', $publicacion);
        //print_r2($publicacion);
    }

    public function display() {
        $this->engine->assign('title', 'Registrar ejemplar');
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('registrar_ejemplar.tpl');

        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            $tipo = $this->session['tipo_usuario'];
            if ($tipo == "usuario" || $tipo == "administrador") {
                header("location: inicio_$tipo.php");
            } else if ($tipo != 'empleado') {
                header("location: index.php");
            }
            $this->mostrar_publicacion();

            if (isset($this->post->btn_registrar_ejemplar)) {
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

$call = new c_registrar_ejemplar();
$call->run();
?>