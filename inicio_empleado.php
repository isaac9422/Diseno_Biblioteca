﻿<?php
require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_inicioEmpleado extends super_controller {

    public function display() {
        //$this->engine->assign('title', $this->gvar['n_index']);
        
        $this->engine->assign('title', 'Página inicial empleado');

        $this->engine->display('header.tpl');
        $this->engine->display('buscarpublicacion.tpl');
        $this->engine->display('menu.tpl');

        $this->engine->display('footer.tpl');
    }

    public function run() {
        try {
            if ($this->session['tipo_usuario'] != 'empleado') {
                $tipo = $this->session['tipo_usuario'];
                if ($tipo != "usuario" && $tipo != "administrador") {
                    header("location: index.php");
                } else {
                    header("location: inicio_$tipo.php");
                }
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

$call = new c_inicioEmpleado();
$call->run();
?>