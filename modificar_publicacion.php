<?php

require('configs/include.php');

class c_modificar_publicacion extends super_controller {

    function validateDate($date,$format = 'Y-m-d'){
        $fecha = explode("/",$date);
        print_r2($fecha);
        var_dump(!checkdate($fecha[1], $fecha[0], $fecha[2]));
        if(!checkdate($fecha[1], $fecha[0], $fecha[2])){
            return FALSE;
        }
        try{
            $d_system = new DateTime("now");
            $d_publicacion = new DateTime($date);
        } catch (Exception $ex) {
            throw_exception("Ingrese Fecha publicación correctamente");
        }
        return $d_publicacion <= $d_system;
    }
    
        public function verificar() {
        $publicacion = new publicacion($this->post);
        if(is_empty($publicacion->get('codigo_publicacion'))){
            throw_exception("Ingrese Código publicación correctamente");
        }else if(is_empty($publicacion->get('nombre'))){
            throw_exception("Ingrese nombre correctamente");
        }else if(is_empty($publicacion->get('categoria'))){
            throw_exception("Ingrese categoría correctamente");
        }else if(is_empty($publicacion->get('tipo'))){
            throw_exception("Ingrese tipo correctamente");
        }else if(is_empty($publicacion->get('clasificacion'))){
            throw_exception("Ingrese clasificación correctamente");
        }else if(is_empty($publicacion->get('fecha_publicacion'))){
            throw_exception("Ingrese Fecha publicación correctamente");
        }

        if(!($this->validateDate($publicacion->get('fecha_publicacion')))){
            throw_exception("Ingrese Fecha publicación correctamente");
        }
    }
    
    public function add() {
        $options['publicacion']['lvl2'] = "one";
        $cods['publicacion']['codigo_publicacion'] = $this->post->codigo_publicacion;


        $this->orm->connect();
        $this->orm->read_data(array('publicacion'), $options, $cods);
        $publicacion = $this->orm->get_objects("publicacion");
        $this->orm->close();

        if (!isset($publicacion[0])) {

            throw_exception("Debe ingresar un código válido");
        } else {
            $this->engine->assign('object',$publicacion[0]);
            $this->temp_aux2 = 'modificar_publicacion1.tpl';
            
            //print_r2($publicacion[0]);
        }

//        
//        $this->type_warning = "success";
//        $this->msg_warning = "Publicacion actualizada correctamente";
//        
        $this->temp_aux = 'message.tpl';
//        $this->engine->assign('type_warning',$this->type_warning);
//        $this->engine->assign('msg_warning',$this->msg_warning);
    }
    
    public function modificar(){
        
        $publicacion = new publicacion($this->post);
        if (is_empty($publicacion->get('codigo_publicacion'))) {
            throw_exception("No se produjo ningún resultado, código incorrecto");
        }
        
        $this->verificar();

        $this->orm->connect();
        $this->orm->update_data("normal", $publicacion);

        $this->orm->close();

        $this->type_warning = "success";
        //$this->msg_warning = "Publicacion editada correctamente";
        throw_exception("Publicacion editada correctamente");
        

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
        
    }

    public function display() {
        
        $this->engine->assign('title', 'Modificar publicacion');
        $this->engine->display('header.tpl');
        if ($this->error == 1) {
            $this->engine->display($this->temp_aux);          
        }        
        $this->engine->display($this->temp_aux2);
        $this->engine->display('footer.tpl');
    }

    public function run() {
        $this->temp_aux2 = 'modificar_publicacion.tpl';
        try {
            if (isset($this->get->option)) {
                $this->{$this->get->option}();
            }
        } catch (Exception $e) {
            $this->error = 1;
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }

        //if(isset($this->get->Actualizar)){
        //}


        $this->display();
    }

}

$call = new c_modificar_publicacion ();
$call->run();
?>


