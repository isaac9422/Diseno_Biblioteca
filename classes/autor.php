<?php
 
class autor extends object_standard
{
	//attributes
	protected $consecutivo;
	protected $nombr;
	
	//components
	var $components = array();
	
	//auxiliars for primary key and for files
	var $auxiliars = array();
	
	//data about the attributes
	public function metadata()
	{
		return array("consecutivo" => array(), "nombre" => array()); 
	}

	public function primary_key()
	{
		return array("consecutivo");
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
