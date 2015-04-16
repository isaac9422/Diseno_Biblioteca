<?php

require('configs/include.php');

class c_buscar extends super_controller
{
    
    public function display()
    {
        $option['publicacion']['lvl2']="all";  //boss se mete por case boss
        $this->orm->connect();
        $this->orm->read_data(array("publicacion"), $option);//read_data sirve para leer varias tablas al mismo tiempo
        $publicacion=$this->orm->get_objects("publicacion");//recibe 3 campos pero los  ultimos son opcionales
        $this->orm->close();
        
        //print_r2($boss);
        
        $this->engine->assign('boss', $publicacion);
        $this->engine->assign('title', 'Buscar Publicación');
                
        $this->engine->display('header.tpl');
        $this->engine->display('buscar.tpl');
        $this->engine->display('footer.tpl');
        
        
    }
    
    public function run()
    {
        $this->display();      
    }
    
    
}
        $call =new c_buscar();
        $call->run();
        ?>
