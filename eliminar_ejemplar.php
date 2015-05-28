<?php

require('configs/include.php');

class c_eliminar_ejemplar extends super_controller {
    
    public function eliminar()
    {
        $ejemplar = new ejemplar($this->post);
        if(is_empty($ejemplar->get('codigo_biblioteca')))
		{throw_exception("No se produjo ningún resultado, código incorrecto");}
                
        
		
        $this->orm->connect();
        $this->orm->delete_data("normal",$ejemplar);
        $this->orm->close();
        
        $this->type_warning = "success";
        $this->msg_warning = "Ejemplar eliminado correctamente";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
    }

    public function display()
    {
        $this->engine->assign('title', 'Eliminar ejemplar');
        
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('eliminar_ejemplar.tpl');
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

$call = new c_eliminar_ejemplar();
$call->run();

?>

