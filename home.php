<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_index extends super_controller {
    
	public function display()
	{
		$this->engine->assign('title',"Home Tester");
		
		$this->engine->display('header.tpl');

		$this->engine->display('home.tpl');

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

$call = new c_index();
$call->run();

?>