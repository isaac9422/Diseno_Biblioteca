<?php

require('configs/include.php');

class c_eliminar_publicacion extends super_controller {

    public function eliminar() {
        $publicacion = new publicacion($this->post);
        if (is_empty($publicacion->get('codigo_publicacion'))) {
            throw_exception("No se produjo ningún resultado, código incorrecto");
        }


        $cod['publicacion']['codigo_publicacion'] = $publicacion->get('codigo_publicacion'); //1
        $option['publicacion']['lvl2'] = "one";

        $this->orm->connect();
        $this->orm->read_data(array("publicacion"), $option, $cod); //read_data sirve para leer varias tablas al mismo tiempo
        $publicacion = $this->orm->get_objects("publicacion"); //recibe 3 campos pero los  ultimos son opcionales

        if (count($publicacion) > 0) {
            $this->orm->delete_data("normal", $publicacion[0]);
            $this->orm->read_data(array("publicacion"), $option, $cod); //read_data sirve para leer varias tablas al mismo tiempo
            $publicacion = $this->orm->get_objects("publicacion"); //recibe 3 campos pero los  ultimos son opcionales

            if (count($publicacion) > 0) {
                throw_exception("No se pudo borrar la publicación");
            } else {
                $this->type_warning = "success";
                $this->msg_warning = "Publicacion eliminada correctamente";
            }
        } else {
            throw_exception("La publicación no existe");
        }



        $this->orm->close();


        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function display() {
        $this->engine->assign('title', 'Eliminar publicacion');

        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('eliminar_publicacion.tpl');

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
                       
            if (isset($this->post->cancelar)) {
                header("location: index.php");
            }
            if (isset($this->get->option)) {
                $this->{$this->get->option}();
            }
        } catch (Exception $e) {
            $codExcepcion = mysqli_errno($this->orm->db->cn);

            if ($codExcepcion == 1451) {
                $this->msg_warning = "No se puede borrar la publicación porque tiene ejemplares asociados";
            } else {
                $this->msg_warning = $e->getMessage();
            }
            $this->error = 1;
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_eliminar_publicacion();
$call->run();
?>

