﻿<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_devolverPrestamo extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Página inicial Usuario');

        $this->engine->display('header.tpl');

        $this->engine->display('devolver_prestamo.tpl');

        $this->engine->display('inicio_usuario.tpl');

        $this->engine->display($this->temp_aux);

        $this->engine->display('footer.tpl');
    }

    public function prestamosActivos() {
        $user = unserialize($this->session[objeto_usuario]);
        $options['prestamo']['lvl2'] = "for_return";
        $data['prestamo']['usuario'] = $user->get('identificacion');
        $this->orm->connect();
        $this->orm->read_data(array("prestamo"), $options, $data);
        $prestamos = $this->orm->get_objects("prestamo");
        $this->orm->close();
        $this->engine->assign('entregas', $prestamos);
    }

    public function devolver() {

        date_default_timezone_set("America/Bogota");
        $user = unserialize($this->session[objeto_usuario]);
        $prestamo = new prestamo($this->get);
        $prestamo->set('usuario', $user->get('identificacion'));
        $this->orm->connect();
        $prestamo->set('fecha_entrega', date("Y-m-d"));
        $this->orm->update_data("return", $prestamo);

        $fechaFin = strtotime($prestamo->get('fecha_fin'));
        $fechaEntrega = strtotime($prestamo->get('fecha_entrega'));

        if ($fechaEntrega > $fechaFin) {
            $dif = date_diff(date_create($prestamo->get('fecha_entrega')), date_create($prestamo->get('fecha_fin')));
            $array = (array) $dif;
            $options['publicacion']['lvl2'] = "one";
            $data['publicacion']['codigo_biblioteca'] = $prestamo->get('codigo_biblioteca');
            $this->orm->read_data(array("publicacion"), $options, $data);
            $publicacion = $this->orm->get_objects("publicacion");
            $libro = $publicacion[0];
            if ($libro->get('clasificacion') == "Reserva") {
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
            $this->msg_warning = "Prestamo retornado exitosamente, pero tuviste retraso para entregarlo";
        } else {
            $this->type_warning = "success";
            $this->msg_warning = "Prestamo retornado exitosamente";
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
            if (isset($this->get->option)) {
                $this->{$this->get->option}();
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