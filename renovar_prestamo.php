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
        if ($user->get('estado') != "ACTIVO") {
            throw_exception("En este momento, no puedes realizar renovaciones");
        }

        $options['prestamo']['lvl2'] = "for_renew";
        $data['prestamo']['usuario'] = $user->get('identificacion');
        $this->orm->connect();
        $this->orm->read_data(array("prestamo"), $options, $data);
        $prestamos = $this->orm->get_objects("prestamo");
        $this->orm->close();
        $this->engine->assign('prestamos', $prestamos);
    }

    public function renovar() {

        date_default_timezone_set("America/Bogota");
        $user = unserialize($this->session[objeto_usuario]);
        $prestamo = new prestamo($this->get);
        $prestamo->set('cantidad_renovacion', 1 + $prestamo->get('cantidad_renovacion'));
        $prestamo->set('usuario', $user->get('identificacion'));
        $this->orm->connect();

        $options['publicacion']['lvl2'] = "one";
        $data['publicacion']['codigo_biblioteca'] = $prestamo->get('codigo_biblioteca');
        $this->orm->read_data(array("publicacion"), $options, $data);
        $publicacion = $this->orm->get_objects("publicacion");
        $libro = $publicacion[0];
        //Cojo la fecha que tiene parseada actualmente
        $dt = $prestamo->get('fecha_fin');
        //Se convierte a timestamp para operar
        $st = strtotime($dt);
        if ($libro->get('clasificacion') == "Reserva") {
            if (getdate($st) . wday > 4) {
                $d = strtotime("next Monday", $st);
                $prestamo->set('fecha_fin', date("Y-m-d", $d));
            } else {
                $d = strtotime("tomorrow", $st);
                $prestamo->set('fecha_fin', date("Y-m-d", $d));
            }
        } else {
            $d = strtotime("+16 days", $st);
            $prestamo->set('fecha_fin', date("Y-m-d", $d));
        }
        $this->orm->update_data("normal", $prestamo);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Publicación renovada exitosamente";
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

$call = new c_renovarPrestamo();
$call->run();
?>