<?php

require('configs/include.php');



class c_modificar_publicacion extends super_controller {

    function validateDate($date){
        $fecha = explode("-", $date);
        if(!checkdate($fecha[1], $fecha[2], $fecha[0])){
            if(!checkdate($fecha[1], $fecha[0], $fecha[2])){
                return FALSE;
            }
        }   
        try{
            $d_system = new DateTime("now");
            $d_publicacion = new DateTime($date);
        } catch (Exception $ex) {
            throw_exception("Ingrese Fecha publicación correctamente");
        }
         return $d_publicacion < $d_system || $d_publicacion == $d_system;
    }
    
        public function verificar() {
           
        $publicacion = new publicacion($this->post);
        
        //C
        $this->engine->assign('objeto',$publicacion);
        //C
        
        if(is_empty($publicacion->get('codigo_publicacion'))){
            throw_exception("Ingrese Código publicación correctamente");
        }else if(is_empty($publicacion->get('nombre'))){                 
            throw_exception("Ingrese nombre");          
        }else if(is_empty($publicacion->get('categoria'))){
            throw_exception("Ingrese categoría ");
        }else if(is_empty($publicacion->get('tipo'))){
            throw_exception("Ingrese tipo ");
        }else if(is_empty($publicacion->get('clasificacion'))){
            throw_exception("Ingrese clasificación ");
        }else if(is_empty($publicacion->get('fecha_publicacion'))){
            throw_exception("Ingrese Fecha publicación ");
        }

        $newFecha1= str_replace('/', '-', $publicacion->get('fecha_publicacion'));
        $newFecha=date("Y-m-d",strtotime($newFecha1));
        $auxfecha1 = explode("-", $newFecha1);//d-m-Y
        $auxfecha = explode("-", $newFecha);//Y-m-d
        if(!($auxfecha[0] == $auxfecha1[0] && $auxfecha[1] == $auxfecha1[1] && $auxfecha[2] == $auxfecha1[2])){
            if($auxfecha[0] != $auxfecha1[2] || $auxfecha[2] != $auxfecha1[0] || $auxfecha[1] != $auxfecha1[1]){
                throw_exception("Ingrese Fecha publicación correctamente");
            }
        }
        $publicacion->cambiarFecha($newFecha);
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
            $this->temp_aux2 = 'modificar_publicacion1.tpl'; //se cambia al segundo tpl
            
        }

    }
    
    public function modificar(){
        $this->temp_aux2 = 'modificar_publicacion1.tpl';
        $publicacion = new publicacion($this->post);

        $this->engine->assign('object',$publicacion);

        if (is_empty($publicacion->get('codigo_publicacion'))) {
            throw_exception("No se produjo ningún resultado, código incorrecto");
        }

        $this->verificar();
        $this->orm->connect();
        $this->orm->update_data("normal", $publicacion);
        $this->orm->close();

        $this->type_warning = "success";
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

        $this->engine->display('menu.tpl');
        $this->engine->display('footer.tpl');
    }

    public function run() {
        $this->temp_aux2 = 'modificar_publicacion.tpl';
       
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
            
            $this->error = 1;
            if($e->getMessage() == "Debe ingresar un código válido"){
                $this->temp_aux2 = 'modificar_publicacion.tpl';
            }elseif ($e->getMessage() == "Publicacion editada correctamente") {
                 $this->temp_aux2 = 'modificar_publicacion.tpl';
            }else{
                $this->temp_aux2 = 'modificar_publicacion1.tpl';
            }
            
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


