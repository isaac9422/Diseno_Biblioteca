<?php



require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_login extends super_controller {
    
   
    public function add()
           
    {
        
        $hasher = new PasswordHash(8, FALSE);
        //para encriptar
        $contrasena= '12445';
        $encriptada=$hasher->HashPasswod($contrasena);
        //para comprobar
        $password='12445';
        if($hasher->CheckPassword($password, $encriptada))
        {
                //coinciden
        }

        unset($hasher);
        
        $_SESSION['usuario'][nombre]=$usuario->get('nombre');
        $_SESSION['usuario'][apellido]=$usuario->get('direccion');
        $this->session=$_SESSION;
        
        $usuario = new clerk($this->post);
        if(is_empty($usuario->get('identificacion')))
		{throw_exception("Debe ingresar un número de cédula");}
		
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
        try {if (isset($this->get->option)){$this->{$this->get->option}();}}
        catch (Exception $e) 
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


