<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_devolverPrestamo extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Devoluciones');

        $this->engine->display('header.tpl');

        $this->engine->display($this->temp_aux);

        $this->engine->display('devolver_prestamo.tpl');

        $this->engine->display('menu.tpl');

        $this->engine->display('footer.tpl');
    }

    public function prestamosActivos() {
        $user = unserialize($this->session[objeto_usuario]);
        $options['prestamo']['lvl2'] = "for_return";
        $data['prestamo']['usuario'] = $user->get('identificacion');
        $this->orm->connect();
        $this->orm->read_data(array("prestamo"), $options, $data);
        $prestamos = $this->orm->get_objects("prestamo");

        for ($i=0;$i<count($prestamos);$i++) {
            $prestamo = $prestamos[$i];
            $options['ejemplar']['lvl2'] = "one";
            $options['publicacion']['lvl2'] = "one";
            $data['ejemplar']['codigo_biblioteca'] = $prestamo->get('codigo_biblioteca');
            $this->orm->read_data(array("ejemplar"), $options, $data);
            $ejemplar = $this->orm->get_objects("ejemplar");
            $ejemplar = $ejemplar[0];
            $data['publicacion']['codigo_publicacion'] = $ejemplar->get('codigo_publicacion');
            $this->orm->read_data(array("publicacion"), $options, $data);
            $publicacion = $this->orm->get_objects("publicacion");
            $publicacion = $publicacion[0];
            $prestamos[$i]->set('nombre',$publicacion->get('nombre'));
        }
        $this->orm->close();
        $this->engine->assign('entregas', $prestamos);
    }

    public function devolver() {
        date_default_timezone_set("America/Bogota");
        $user = unserialize($this->session[objeto_usuario]);
        $this->orm->connect();
        if (!isset($this->post->devoluciones)) {
            $this->type_warning = "warning";
            $this->msg_warning = "No has seleccionado nada";
        } else {
            foreach ($this->post->devoluciones as $seleccion) {
                $seleccion = explode(",", $seleccion);
                $prestamo = new prestamo();
                $prestamo->set("codigo_biblioteca", $seleccion[0]);
                $prestamo->set("fecha_inicio", $seleccion[1]);
                $prestamo->set("fecha_fin", $seleccion[2]);
                $prestamo->set("cantidad_renovacion", 1 + $seleccion[3]);
                $prestamo->set('usuario', $user->get('identificacion'));
                $prestamo->set('fecha_entrega', date("Y-m-d"));
                $this->orm->update_data("return", $prestamo);

                $fechaFin = strtotime($prestamo->get('fecha_fin'));
                $fechaEntrega = strtotime($prestamo->get('fecha_entrega'));

                if ($fechaEntrega > $fechaFin) {
                    $dif = date_diff(date_create($prestamo->get('fecha_entrega')), date_create($prestamo->get('fecha_fin')));
                    $array = (array) $dif;

                    $options['ejemplar']['lvl2'] = "one";
                    $options['publicacion']['lvl2'] = "one";
                    $data['ejemplar']['codigo_biblioteca'] = $prestamo->get('codigo_biblioteca');
                    $this->orm->read_data(array("ejemplar"), $options, $data);
                    $ejemplar = $this->orm->get_objects("ejemplar");
                    $ejemplar = $ejemplar[0];
                    $data['publicacion']['codigo_publicacion'] = $ejemplar->get('codigo_publicacion');
                    $this->orm->read_data(array("publicacion"), $options, $data);
                    $publicacion = $this->orm->get_objects("publicacion");
                    $publicacion = $publicacion[0];

                    if (strcasecmp($publicacion->get('clasificacion'), "Reserva") == 0) {
                        $user->set('multa', 5000 * $array[d]);
                    } else {
                        $user->set('multa', 1000 * $array[d]);
                    }
                    $user->set('estado', "INACTIVO");
                    unset($this->session[objeto_usuario]);
                    $_SESSION['objeto_usuario'] = serialize($user);
                    $_SESSION['tipo_usuario'] = $this->session[tipo_usuario];
                    $_SESSION['email'] = $this->session[email];
                    $this->session = $_SESSION;

                    $this->orm->update_data("multar", $user);
                    $this->type_warning = "warning";
                    $this->msg_warning = "Prestamo(s) retornado(s) exitosamente, pero tuviste retraso para entregarlo";
                } else {
                    $this->type_warning = "success";
                    $this->msg_warning = "Prestamo(s) retornado(s) exitosamente";
                }
            }
        }
        $this->orm->close();
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function run() {
        try {
            if ($this->session['tipo_usuario'] != 'usuario') {
                $tipo = $this->session['tipo_usuario'];
                if ($tipo != "administrador" && $tipo != "empleado") {
                    header("location: index.php");
                } else {
                    header("location: inicio_$tipo.php");
                }
            }
            if (isset($this->post->devolver)) {
                $this->devolver();
            }
            if (isset($this->post->cancelar)) {
                header("location: index.php");
            }
            $this->prestamosActivos();
        } catch (Exception $e) {
            $this->error = 1;
            $this->type_warning = "error";
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_devolverPrestamo();
$call->run();
?>