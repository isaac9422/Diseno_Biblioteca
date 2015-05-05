<?php

require('configs/include.php');

class c_modificar_publicacion extends super_controller {
    
    public function add()
    {
        $publicacion = new publicacion($this->post);
        //$this->engine->assign('id',$this->get->id);
        
        if(is_empty($publicacion->get('codigo_biblioteca')))
		{throw_exception("Debe ingresar un código");}
         
                $auxiliar['id_ant']=a;
                $publicacion->auxiliar['id_ant']=$this->post->id_ant;
        
        
                
//        if(is_numeric($this->get->salary))
//            {
//                $this->{$this->post->option}();
//            } else {
//                echo "Ingrese un valor númerico en Salario por favor";
//            }
//            
//para el punto de auxiliars.
//
//       $auxiliars('finca')=array('nombreg');
//       $finca=$this->orm->get_objects("finca,null,$auxiliars");
//       $finca[0]->auxiliars['nombreg'];
            
		
        $this->orm->connect();
        $this->orm->update_data("normal",$publicacion);
        $this->orm->close();
        
        $this->type_warning = "success";
        $this->msg_warning = "Persona actualizada correctamente";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
    }

    public function display()
    {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('modificar_publicacion.tpl');
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
                
         //if(isset($this->get->Actualizar)){
             
         //}
         
         
        $this->display();
    }
}

$call = new c_modificar_publicacion();
$call->run();

?>


