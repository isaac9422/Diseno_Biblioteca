﻿<?php
require('configs/include.php');

class c_prestarPublicacion extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Página inicial Usuario');

        $this->engine->display('header.tpl');

        $this->engine->display($this->temp_aux);

        $this->engine->display('prestar_publicacion.tpl');

        $this->engine->display('footer.tpl');
    }

    public function prestar() {
        $user = unserialize($this->session[objeto_usuario]);
        if (strcasecmp($user->get('estado'), "ACTIVO") != 0) {
            throw_exception("En este momento, no puedes realizar prestamos");
        }

        $contadorReserva = 0;
        $contadorNormal = 0;
        $publicaciones = $this->session['libros'];
        foreach ($publicaciones as $libro) {
            $libro = unserialize($libro);
            if (strcasecmp($libro->get('clasificacion'), "Reserva") == 0) {
                $contadorReserva++;
            } else {
                $contadorNormal++;
            }
        }
        if ($contadorReserva > 1 || $contadorNormal > 3) {
            throw_exception("Excedes el máximo permitido para prestar");
        }

        date_default_timezone_set("America/Bogota");
        $this->orm->connect();
        foreach ($publicaciones as $libro) {
            $libro = unserialize($libro);
            $prestamo = new prestamo();
            $prestamo->set('codigo_biblioteca', $libro->get('codigo_biblioteca'));
            $prestamo->set('usuario', $user->get('identificacion'));
            $prestamo->set('fecha_inicio', date('Y-m-d'));
            if (strcasecmp($libro->get('clasificacion'), "Reserva") == 0) {
                if (getdate() . wday > 4) {
                    $d = strtotime("next Monday");
                    $prestamo->set('fecha_fin', date("Y-m-d", $d));
                } else {
                    $d = strtotime("tomorrow");
                    $prestamo->set('fecha_fin', date("Y-m-d", $d));
                }
            } else {
                $d = strtotime("+16 days");
                $prestamo->set('fecha_fin', date("Y-m-d", $d));
            }
            $this->orm->insert_data("normal", $prestamo);
        }
        $this->orm->close();
        unset($_SESSION['libros']);
        $this->session = $_SESSION;

        $this->type_warning = "success";
        $this->msg_warning = "Prestamo registrado correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function listarBuscados() {

        if (!isset($this->session['libros'])) {
            
        } else {
            $buscados = array();
            foreach ($this->session['libros'] as $publicacion){
                $publicacion = unserialize($publicacion);
                array_push($buscados, $publicacion);
            }
            $this->engine->assign('preview', $buscados);
        }
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
            $this->listarBuscados();
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

$call = new c_prestarPublicacion();
$call->run();
?>
