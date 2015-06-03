<?php

require('configs/include.php');

class c_eliminar_ejemplar extends super_controller {
    
    public function eliminar()
    {
        $ejemplar = new ejemplar($this->post);
        if(is_empty($ejemplar->get('codigo_biblioteca')))
		{throw_exception("No se produjo ningún resultado, código incorrecto");}
                
        
		
        $cod['ejemplar']['codigo_biblioteca']=$ejemplar->get('codigo_biblioteca'); //1
        $option['ejemplar']['lvl2']="one";  
        
        $this->orm->connect();
        $this->orm->read_data(array("ejemplar"), $option, $cod);//read_data sirve para leer varias tablas al mismo tiempo
        $ejemplar=$this->orm->get_objects("ejemplar");//recibe 3 campos pero los  ultimos son opcionales
        
        if(count($ejemplar)>0){
            $this->orm->delete_data("normal",$ejemplar[0]);
            $this->orm->read_data(array("ejemplar"), $option, $cod);//read_data sirve para leer varias tablas al mismo tiempo
            $ejemplar=$this->orm->get_objects("ejemplar");//recibe 3 campos pero los  ultimos son opcionales
            
            if(count($ejemplar)>0){
                throw_exception("No se pudo borrar la publicación");
            }else {
                $this->type_warning = "success";
                $this->msg_warning = "Ejemplar eliminado correctamente";
            }
        }else{
            throw_exception("El ejemplar no existe");
        }
        
             
        $this->orm->close();
    
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
                        $codExcepcion= mysqli_errno($this->orm->db->cn);
                       
                        if($codExcepcion==1451){
                            $this->msg_warning= "No se puede borrar el ejemplar porque tiene prestamos asociados o posee un historial de prestamos";
                        }else{
                           $this->msg_warning=$e->getMessage(); 
                        
                        }
                    
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

