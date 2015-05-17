<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_renovarPrestamo extends super_controller {

    public function display() {
        $this->engine->assign('title', 'Página inicial Usuario');

        $this->engine->display('header.tpl');

        $this->engine->display($this->temp_aux);

        $this->engine->display('renovar_prestamo.tpl');

        $this->engine->display('footer.tpl');
    }

    public function prestamosActivos() {
        $user = unserialize($this->session[objeto_usuario]);

        if (strcasecmp($user->get('estado'), "ACTIVO") != 0) {
            throw_exception("En este momento, no puedes realizar renovaciones");
        }

        $options['prestamo']['lvl2'] = "for_renew";
        $data['prestamo']['usuario'] = $user->get('identificacion');
        $this->orm->connect();
        $this->orm->read_data(array("prestamo"), $options, $data);
        $prestamos = $this->orm->get_objects("prestamo");
        $this->orm->close();
        if (is_empty($prestamos)) {
            throw_exception("No tienes prestamos activos");
        } else {
            $this->engine->assign('prestamos', $prestamos);
        }
    }

    public function renovar() {

        date_default_timezone_set("America/Bogota");
        $user = unserialize($this->session[objeto_usuario]);
        $this->orm->connect();
        if (!isset($this->post->renovaciones)) {
            $this->type_warning = "warning";
            $this->msg_warning = "No has seleccionado nada";
        } else {
            foreach ($this->post->renovaciones as $seleccion) {
                $seleccion = explode(",", $seleccion);
                $prestamo = new prestamo();
                $prestamo->set("codigo_biblioteca", $seleccion[0]);
                $prestamo->set("fecha_inicio", $seleccion[1]);
                $prestamo->set("fecha_fin", $seleccion[2]);
                $prestamo->set("cantidad_renovacion", 1 + $seleccion[3]);
                $prestamo->set('usuario', $user->get('identificacion'));
                
                $options['ejemplar']['lvl2'] = "one";
                $options['publicacion']['lvl2'] = "one";
                $data['ejemplar']['codigo_biblioteca'] = $prestamo->get('codigo_biblioteca');
                $this->orm->read_data(array("ejemplar"), $options, $data);
                $ejemplar = $this->orm->get_objects("ejemplar", $components);
                $ejemplar = $ejemplar[0];
                $data['publicacion']['codigo_publicacion'] = $ejemplar->get('codigo_publicacion');
                $this->orm->read_data(array("publicacion"), $options, $data);
                $publicacion = $this->orm->get_objects("publicacion", $components);
                $publicacion = $publicacion[0];
                
                //Cojo la fecha que tiene parseada actualmente
                $fechaFinDate = $prestamo->get('fecha_fin');
                //Se convierte a timestamp para operar
                $fechaFinLong = strtotime($fechaFinDate);
                if (strcasecmp($publicacion->get('clasificacion'), "Reserva") == 0) {
                    if (getdate($fechaFinLong) . wday > 4) {
                        $d = strtotime("next Monday", $fechaFinLong);
                        $prestamo->set('fecha_fin', date("Y-m-d", $d));
                    } else {
                        $d = strtotime("tomorrow", $fechaFinLong);
                        $prestamo->set('fecha_fin', date("Y-m-d", $d));
                    }
                } else {
                    $d = strtotime("+16 days", $fechaFinLong);
                    $prestamo->set('fecha_fin', date("Y-m-d", $d));
                }
                $this->orm->update_data("normal", $prestamo);
            }

            $this->type_warning = "success";
            $this->msg_warning = "Publicación(es) renovada(s) exitosamente";
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
            if (isset($this->post->renovar)) {
                $this->renovar();
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

$call = new c_renovarPrestamo();
$call->run();
?>
