<?php
class Layout
{
	/*
		el constructor recibe dos parámetros:
		$view = el nombre de la vista a cargar
		$data = los datos que enviaremos a nuestra vista
	*/
	function __construct($view, $data = null)
	{
		/*
			incluimos el archivo Config.php ya que en este se encuentra nuestro encabezado y pie del diseño.
		*/
		require("Config.php");
		/*
			verificamos que la vista exista
		*/
		if(file_exists("./views/$view"))
		{
			/*
			verificamos que tanto el encabezado y el pie existan ($header y $footer) y simplemente los incluimos
			*/
			if (file_exists("./views/Layout/$header"))require("./views/Layout/".$header); else die("Encabezado no encontrado.");
			/*
				entre $header y $footer incluimos nuestra vista
			*/
			require("./views/$view");
			if (file_exists("./views/Layout/$footer"))require("./views/Layout/".$footer); else die("Pié de página no encontrado");
		}
		else
		{
			die("Sitio no encontrado.");
		}
	}

} 
 
