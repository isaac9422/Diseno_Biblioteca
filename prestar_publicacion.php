﻿<?php
require('configs/include.php');

class c_prestarPublicacion extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Prestamos');

        $this->engine->display('header.tpl');

        $this->engine->display($this->temp_aux);

        $this->engine->display('prestar_publicacion.tpl');

        $this->engine->display('menu.tpl');

        $this->engine->display('footer.tpl');
    }

    public function prestar() {
        $user = unserialize($this->session[objeto_usuario]);
        if (strcasecmp($user->get('estado'), "ACTIVO") != 0) {
            throw_exception("En este momento, no puedes realizar prestamos");
        }

        $contadorReserva = 0;
        $contadorNormal = 0;
        $this->orm->connect();
        if (!isset($this->post->prestados)) {
            $this->type_warning = "warning";
            $this->msg_warning = "No has seleccionado nada";
        } else {
            foreach ($this->post->prestados as $ejemplar) {
                $ejemplar = explode(",", $ejemplar);
                $options['publicacion']['lvl2'] = "one";
                $data['publicacion']['codigo_publicacion'] = $ejemplar[1];
                $this->orm->read_data(array("publicacion"), $options, $data);
                $publicacion = $this->orm->get_objects("publicacion");
                $publicacion = $publicacion[0];
                if (strcasecmp($publicacion->get('clasificacion'), "Reserva") == 0) {
                    $contadorReserva++;
                } else {
                    $contadorNormal++;
                }

                $options['prestamo']['lvl2'] = "for_renew";
                $data['prestamo']['usuario'] = $user->get('identificacion');
                $this->orm->read_data(array("prestamo"), $options, $data);
                $prestamos = $this->orm->get_objects("prestamo");

                for ($i = 0; $i < count($prestamos); $i++) {
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
                    if (strcasecmp($publicacion->get('clasificacion'), "Reserva") == 0) {
                        $contadorReserva++;
                    } else {
                        $contadorNormal++;
                    }
                }
            }
        }
        if ($contadorReserva > 1 || $contadorNormal > 3) {
            throw_exception("Excedes el máximo número permitido de ejemplares para prestar");
        }

        date_default_timezone_set("America/Bogota");
        if (!isset($this->post->prestados)) {
            $this->type_warning = "warning";
            $this->msg_warning = "No has seleccionado nada";
        } else {
            foreach ($this->post->prestados as $ejemplar) {
                $ejemplar = explode(",", $ejemplar);
                $prestamo = new prestamo();
                $prestamo->set('codigo_biblioteca', $ejemplar[0]);
                $prestamo->set('usuario', $user->get('identificacion'));
                $prestamo->set('fecha_inicio', date('Y-m-d'));
                $options['publicacion']['lvl2'] = "one";
                $data['publicacion']['codigo_publicacion'] = $ejemplar[1];
                $this->orm->read_data(array("publicacion"), $options, $data);
                $publicacion = $this->orm->get_objects("publicacion");
                $publicacion = $publicacion[0];
                if (strcasecmp($publicacion->get('clasificacion'), "Reserva") == 0) {
                    if (getdate()['wday'] > 4) {
                        $d = strtotime("next Monday");
                        $prestamo->set('fecha_fin', date("Y-m-d", $d));
                    } else {
                        $d = strtotime("tomorrow");
                        $prestamo->set('fecha_fin', date("Y-m-d", $d));
                    }
                } else {
                    $d = strtotime("+14 days");
                    $prestamo->set('fecha_fin', date("Y-m-d", $d));
                }
                $this->orm->insert_data("normal", $prestamo);

                $this->type_warning = "success";
                $this->msg_warning = "Prestamo registrado correctamente";
            }
            unset($_SESSION['libros']);
            $this->session = $_SESSION;
        }
        $this->orm->close();

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }

    public function listarBuscados() {
        $user = unserialize($this->session[objeto_usuario]);

        if (strcasecmp($user->get('estado'), "ACTIVO") != 0) {
            throw_exception("En este momento, no puedes realizar prestamos");
        }

        $options['prestamo']['lvl2'] = "for_return";
        $data['prestamo']['usuario'] = $user->get('identificacion');
        $this->orm->connect();
        $this->orm->read_data(array("prestamo"), $options, $data);
        $prestamos = $this->orm->get_objects("prestamo");
        if (count($prestamos) > 3) {
            throw_exception("Excedes el máximo número permitido de ejemplares prestados");
        }

        if (isset($this->session['libros'])) {
            $buscados = array();
            foreach ($this->session['libros'] as $ejemplar) {
                $ejemplar = unserialize($ejemplar);
                $options['ejemplar']['lvl2'] = "by_publicacion";
                $options['publicacion']['lvl2'] = "one";
                $components['ejemplar']['publicacion'] = array("e_p");
                $data['publicacion']['codigo_publicacion'] = $ejemplar->get('codigo_publicacion');
                $data['ejemplar']['codigo_publicacion'] = $ejemplar->get('codigo_publicacion');
                $this->orm->read_data(array("ejemplar", "publicacion"), $options, $data);

                $ejemplares = $this->orm->get_objects("ejemplar", $components);
                $publicacion = $ejemplares[0]->components['publicacion']['e_p'][0];
                $i = 0;
                do {
                    $ejemplare = $ejemplares[$i];
                    $options['prestamo']['lvl2'] = "by_codigo_biblioteca";
                    $data['prestamo']['codigo_biblioteca'] = $ejemplare->get('codigo_biblioteca');
                    $this->orm->read_data(array("prestamo"), $options, $data);
                    $prestamo = $this->orm->get_objects("prestamo");
                    if (is_empty($prestamo)) {
                        break;
                    }
                    $i++;
                } while (true);
                $ejemplar->set('nombre', $publicacion->get('nombre'));
                $ejemplar->set('clasificacion', $publicacion->get('clasificacion'));
                $ejemplar->set('codigo_biblioteca', $ejemplare->get('codigo_biblioteca'));

                if (!in_array($ejemplar, $buscados)) {
                    array_push($buscados, $ejemplar);
                }
            }
            $this->engine->assign('preview', $buscados);
        }
        $this->orm->close();
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
            if (isset($this->post->cancelar)) {
                header("location: index.php");
            }
            $this->listarBuscados();
            if (isset($this->post->prestar)) {
                $this->prestar();
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

$call = new c_prestarPublicacion();
$call->run();
?>
