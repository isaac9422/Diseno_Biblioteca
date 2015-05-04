<?php

require('configs/include.php');

class c_administrar extends super_controller {
    
        public function administrar()
    {
        
     
    
        $usuario = new usuario($this->post);
         // print_r2($usuario);
          
                if(is_empty($usuario ->get('identificacion')))
		{throw_exception("Debe ingresar una identificacion");}
	
        
        $this->orm->connect();
        $this->orm->update_data("bloquear",$usuario);
        $this->orm->close();
        
        
        $this->type_warning = "success";
        $this->msg_warning = "Estado de Usuario Cambiado";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);

    }
        
    
        public function display()
    {     
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('administrar_cuenta.tpl');
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


$call = new c_administrar();
$call->run();

?>