<?php

class Contactos extends Controller
{
	public function index()
	{
		//cargamos e instanciamos nuestros modelos para mostrar los contactos y numeros de telefono
		$Model = new LoadModel("ContactosModel");
		$Model = new LoadModel("TelefonosModel");
		$ContactosModel = new ContactosModel();
		$TelefonosModel = new TelefonosModel();
		//obtenemos todos los contactos
		$contactos = $ContactosModel->getContactos();
		/*
			Creamos un array para almacenar los numeros de telefono de cada contacto.
			El número de indice indicara el id del contacto
		*/
		$telefonos = [];
		//recorremos cada contacto
		foreach($contactos as $contacto)
		{
			/*
				extraemos los numeros de telefono de cada contacto y los almacenamos en el array $telefonos,
				el indice indicará el id del contacto.
				Ej. $telefonos[235] significa que en ese indice se almacenan los numeros de telefono del contacto con id 235
			*/
			$telefonos[$contacto["id_contacto"]] = $TelefonosModel->getTelefonos($contacto["id_contacto"]);
		}
		//llamamos nuestra vista con plantilla
		$Layout = new Layout("Contactos/index.php", compact("contactos", "telefonos"));
	}

	public function setContacto()
	{
		if ($_POST)
		{
			$nombres = ucwords(strtolower($_POST["nombres"]));
			$apellidos = ucwords(strtolower($_POST["apellidos"]));
			$direccion = ucwords(strtolower($_POST["direccion"]));
			$telefonos = str_replace(" ", "", $_POST["telefonos"]);
			$cada_telefono = explode(",", $telefonos);
			$numerosInvalidos = verificarTelefonos($cada_telefono);
			if (!verificarString($nombres))
				{
					echo "Nombre inválido o vacío, solo se aceptan letras.";
					die();
				}
			if (!verificarString($apellidos))
				{
					echo "Apellido inválido o vacío, solo se aceptan letras.";
					die();
				}
			
			if($numerosInvalidos)
			{
				echo "Los siguientes números son inválidos:";
				foreach($numerosInvalidos as $n)
				{
					echo "<li>$n</li>";
				}
				die();
			}
			$LoadModelContacto = new LoadModel("ContactosModel");
			$ContactosModel = new ContactosModel();
			$LoadModelTelefono = new LoadModel("TelefonosModel");
			$TelefonosModel = new TelefonosModel();
			try
			{
				$TelefonosModel->db->beginTransaction();
				$ContactosModel->setContacto($nombres, $apellidos, $direccion);
				$id_contacto_guardado = $ContactosModel->db->lastInsertId();			
				
				foreach($cada_telefono as $telefono)
				{	
					$TelefonosModel->setTelefonos($id_contacto_guardado, $telefono);
				}
				
				$TelefonosModel->db->commit();
				echo "<script>window.location = '".url_base()."'</script>";
			}
			catch(PDOException $ex)
			{
				$TelefonosModel->db->rollback();
			}

		}
	}

	public function modificarContacto()
	{
		if($_GET)
		{
			$id_contacto = $_GET["id_contacto"];
			$ContactosModel = new LoadModel("ContactosModel");
			$TelefonosModel = new LoadModel("TelefonosModel");
			$ContactosModel = new ContactosModel();
			$TelefonosModel = new TelefonosModel();
			$contacto = $ContactosModel->getContacto($id_contacto);
			$telefonos = $TelefonosModel->getTelefonos($id_contacto);
			$Layout = new Layout("Contactos/modificarContacto.php", compact("contacto", "telefonos"));
		}
	}

	public function actualizarContacto()
	{
		if ($_POST)
		{
			$id_contacto = $_POST["id_contacto"];
			$nombres = ucwords(strtolower($_POST["nombres"]));
			echo $nombres;
			$apellidos = ucwords(strtolower($_POST["apellidos"]));
			$direccion = ucwords(strtolower($_POST["direccion"]));
			$telefonos = str_replace(" ", "", $_POST["telefonos"]);
			$cada_telefono = explode(",", $telefonos);
			$numerosInvalidos = verificarTelefonos($cada_telefono);
			if (!verificarString($nombres))
				{
					echo "Nombre inválido o vacío, solo se aceptan letras.";
					die();
				}
			if (!verificarString($apellidos))
				{
					echo "Apellido inválido o vacío, solo se aceptan letras.";
					die();
				}
			
			if($numerosInvalidos)
			{
				echo "Los siguientes números son inválidos:";
				foreach($numerosInvalidos as $n)
				{
					echo "<li>$n</li>";
				}
				die();
			}
			$LoadModelContacto = new LoadModel("ContactosModel");
			$ContactosModel = new ContactosModel();
			$LoadModelTelefono = new LoadModel("TelefonosModel");
			$TelefonosModel = new TelefonosModel();
			try
			{
				$TelefonosModel->db->beginTransaction();
				$ContactosModel->updateContacto($id_contacto, $nombres, $apellidos, $direccion);			
				$TelefonosModel->deleteTelefonos($id_contacto);
				foreach($cada_telefono as $telefono)
				{	
					$TelefonosModel->setTelefonos($id_contacto, $telefono);
				}
				
				$TelefonosModel->db->commit();
				echo "<script>window.location = '".url_base()."'</script>";
			}
			catch(PDOException $ex)
			{
				$TelefonosModel->db->rollback();
				die("El contacto no pudo ser actualizado.");
			}

		}
	}

	public function eliminarContacto()
	{
		if($_GET)
		{
			$id_contacto = $_GET["id_contacto"];
			$LoadModelContacto = new LoadModel("ContactosModel");
			$ContactosModel = new ContactosModel();
			$LoadModelTelefono = new LoadModel("TelefonosModel");
			$TelefonosModel = new TelefonosModel();
			try
			{
				$TelefonosModel->db->beginTransaction();
				
				$TelefonosModel->deleteTelefonos($id_contacto);
				$TelefonosModel->db->commit();
				$ContactosModel->deleteContacto($id_contacto);
				
				
				echo "<script>window.location = '".url_base()."'</script>";
			}
			catch(PDOException $ex)
			{
				print_r($ex);
				$TelefonosModel->db->rollback();
			}
		}
	}
}