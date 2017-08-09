<?php
class View
{
	/*
		Esta es la clase para cargar las vistas.
		El constructor recibe dos parámetros:
		$view = el nombre de la vista a cargar
		$data = los datos que enviaremos a nuestra vista
	*/
	function __construct($view, $data = null)
	{
		//solamente verificamos que la vista exista para incluirla
		if(file_exists("./views/$view"))
		{
			require("./views/$view");
		}
		else
		{
			die("Sitio no encontrado.");
		}
	}

} 

