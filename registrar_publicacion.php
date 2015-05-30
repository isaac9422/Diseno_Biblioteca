<?php

require('configs/include.php');

class c_registrar_publicacion extends super_controller {
    function validateDate($date){
        $fecha = explode("/",$date);
        if(!checkdate($fecha[1], $fecha[2], $fecha[0])){
            $fecha = explode("-",$date);
            if (!checkdate($fecha[1], $fecha[2], $fecha[0])) {
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
        $mis_autores = $this->post->mis_autores;
        
        if(count($mis_autores) < 1){
            throw_exception("Elija al menos un autor");
        }
        $this->registrar($publicacion);

        
        settype($data, 'object');
        $data->codigo_publicacion = $publicacion->get('codigo_publicacion');
        
        foreach ($mis_autores as $consecutivo ){
            $data ->autor = $consecutivo;
            $colaboracion = new colaboracion($data);
            $this->registrar_colaboracion($colaboracion);
        }
    }

    public function registrar($publicacion) {
        $this->orm->connect();
        $this->orm->insert_data("normal", $publicacion);
        $this->orm->close();

        $this->type_warning = "success";
        $this->msg_warning = "Publicación registrada correctamente";

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning', $this->type_warning);
        $this->engine->assign('msg_warning', $this->msg_warning);
    }
    
    public function registrar_colaboracion($colaboracion){
        $this->orm->connect();
        $this->orm->insert_data("normal", $colaboracion);
        $this->orm->close();
    }

    public function cancelar() {
        //Definir a cual página de inicio debe ser redireccionado
        if ($this->session['tipo_usuario'] == 'usuario') {
            //Llamar index de usuario
            header("location: inicio_usuario.php");
        } else if ($this->session['tipo_usuario'] == 'empleado') {
            //Llamar index de empleado
            header("location: inicio_empleado.php");
        } else if ($this->session['tipo_usuario'] == 'administrador') {
            //Llamar index de administrador
            header("location: inicio_administrador.php");
        } else {
            header("location: index.php");
        }
    }
    
    public function mostrar_autor(){
        $option['autor']['lvl2'] = 'all';
        $this->orm->connect();
        $this->orm->read_data(array("autor"), $option);
        $autor = $this->orm->get_objects("autor");
        $this->orm->close();
        
        $this->engine->assign('autores',$autor);
    }

    public function display() {
        $this->engine->assign('title', 'Registrar publicación');
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('registrar_publicacion.tpl');
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
            $this->mostrar_autor();
            
            if (isset($this->post->btn_registrar_publicacion)) {
                $this->verificar();
            }
            if (isset($this->post->btn_cancelar)) {
                $this->cancelar();
            }
        } catch (Exception $e) {
            $this->error = 1;
            $this->msg_warning = $e->getMessage();
            $this->engine->assign('type_warning', $this->type_warning);
            $this->engine->assign('msg_warning', $this->msg_warning);
            $this->temp_aux = 'message.tpl';
        }
        $this->display();
    }

}

$call = new c_registrar_publicacion();
$call->run();
?>
