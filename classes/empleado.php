<?php
 
class user extends object_standard
{
	//attributes
	protected $identificacion;
	protected $nombre;
	protected $contraseña;
	protected $direccion;
	protected $telefono;
	protected $email;
	
	//components
	var $components = array();
	
	//auxiliars for primary key and for files
	var $auxiliars = array();
	
	//data about the attributes
	public function metadata()
	{
		return array("identificacion" => array(), "nombre" => array(), "contraseña" => array(), "direccion" => array(), "telefono" => array(), "email" => array()); 
	}

	public function primary_key()
	{
		return array("identificacion");
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