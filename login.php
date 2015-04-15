<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_login extends super_controller {
    
   
   public function ingresar()
           
    {
        
        $option['usuario']['lvl2']='by_email';
        $data['usuario']['email'] = $this->post->email;
        $this->orm->connect();
        $this->orm->read_data(array("usuario"),$option);
        $usuario = $this->orm->get_objects("usuario");
        $this->orm->close();
        
        $encriptada = $usuario->get('contraseña');
        
        $contraseña = $this-> post->contraseña;
        $hasher = new PasswordHash(8, FALSE);
        //para encriptar
        
        print_r2($usuario);
        //$encriptada=$hasher->HashPassword($contrasena);
        //para comprobar
        if($hasher->CheckPassword($contraseña, $encriptada)){
            //session_start();
            print_r2($encriptada);
            $_SESSION['usuario']['nombre']=$usuario->get('nombre');
            $this->session=$_SESSION;
            print_r2($this->session);
            header("location: index.php");
        }else{
            print_r2($encriptada);
        } 

        unset($hasher);
        //unset($this->session);
        //session_destroy();
		
        $this->orm->connect();
        $this->orm->insert_data("normal",$usuario);//para insertar en la basededatos
        $this->orm->close();
        
        $this->type_warning = "success";
        $this->msg_warning = "Persona agregada correctamente";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
        
    }

    public function display()
    {
        $this->engine->display('header.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('login.tpl');
        $this->engine->display('footer.tpl');
    }
    
    public function run()
    {
        try {if (isset($this->post->btn_ingresar))
            {$this->ingresar();}   
        }catch (Exception $e) 
		{
			$this->error=1; 
                        $this->engine->assign('object',$this->post); 
                        $this->msg_warning=$e->getMessage();
			$this->engine->assign('type_warning',$this->type_warning);
			$this->engine->assign('msg_warning',$this->msg_warning);
			$this->temp_aux = 'message.tpl';
		}    
        $this->display();
    }
}

$call = new c_login();
$call->run();

?>


