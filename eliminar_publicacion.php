<?php

require('configs/include.php');

class c_eliminar_publicacion extends super_controller {
    
    public function add()
    {
        $publicacion = new publicacion($this->post);
        if(is_empty($publicacion->get('codigo_biblioteca')))
		{throw_exception("Debe ingresar un código");}
                
        
		
        $this->orm->connect();
        $this->orm->delete_data("normal",$publicacion);
        $this->orm->close();
        
        $this->type_warning = "success";
        $this->msg_warning = "Publicacion eliminada correctamente";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
    }

    public function display()
    {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('eliminar_publicacion.tpl');
        $this->engine->display('footer.tpl');
    }
    
    public function run()
    {
        try {if (isset($this->get->option)){$this->{$this->get->option}();}}
        catch (Exception $e) 
		{
			$this->error=1; $this->msg_warning=$e->getMessage();
			$this->engine->assign('type_warning',$this->type_warning);
			$this->engine->assign('msg_warning',$this->msg_warning);
			$this->temp_aux = 'message.tpl';
		}    
        $this->display();
    }
}

$call = new c_eliminar_publicacion();
$call->run();

?>

