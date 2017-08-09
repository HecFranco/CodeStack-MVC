 
<?php

class Controller
{
	function __construct()
	{
		/*
			verificamos que método se esta llamando por medio de la url,
			este se almacena en la variable 'action', si el método dentro
			de la clase existe entonces la ejecutamos, caso contrario mostramos 'Sitio no encontrado'.
			Si no se especifica el 'action' entonces mostramos el método llamado 'index', si no existe
			entonces mostramos 'Indice no definido.'
		*/
		if($_GET && isset($_GET["action"]))
		{
			$action = $_GET["action"];
			if (method_exists($this, $action))
			{
				$this->$action();
			}
			else
			{
				die("Sitio no encontrado.");
			}
		}
		else
		{
			if(method_exists($this, "index"))
			{
				$this->index();
			}
			else
			{
				die("Índice no definido.");
			}
		}
	}
}
