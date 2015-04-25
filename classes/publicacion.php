<?php
 
class publicacion extends object_standard
{
	//attributes
	protected $codigo_publicacion;
	protected $codigo_biblioteca;
	protected $categoria;
	protected $tipo;
	protected $nombre;
	protected $fecha_publicacion;
	
	//components
	var $components = array();
	
	//auxiliars for primary key and for files
	var $auxiliars = array();
	
	//data about the attributes
	public function metadata()
	{
		return array("codigo_publicacion" => array(), "codigo_biblioteca" => array(), "categoria" => array(),
                    "tipo" => array(), "nombre" => array(), "fecha_publicacion" => array()); 
	}

	public function primary_key()
	{
		return array("codigo_publicacion,codigo_biblioteca");
	}
	
	public function relational_keys($class, $rel_name)
	{
		switch($class)
		{		
		    default:
			break;
		}
	}
}

?>
