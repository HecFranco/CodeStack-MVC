<?php
/*
	llamamos todas las clases principales de la estructura mvc de la carpeta core
*/
require("core/Controller.php"); 
require("core/Config.php");
require("core/View.php");
require("core/Model.php");
require("core/LoadModel.php");
require("core/Layout.php");
require("core/Functions.php");
/*
	incluimos cada libreria especificada en el array $libraries
*/
foreach($libraries as $librarie)
{
	if (file_exists("libraries/$librarie".".php"))
	require("libraries/$librarie".".php");
}
/*
	verificamos que se haya especificado el controlador a llamar en la url,
	verificamos que el archivo existe, si no, entonces detenemos la ejecución.
	caso contrario que no se especifique el controlador mostramos el controlador
	por defecto especificado en Config.php
*/
if($_GET && isset($_GET["controller"]))
{
	$default_controller = $_GET["controller"];
	if (file_exists("controllers/".$default_controller.".php"))
		require("controllers/".$default_controller.".php");
	else
		die("Controlador no encontrado.");
}
else
{
	if (file_exists("controllers/".$default_controller.".php"))
		require("controllers/".$default_controller.".php");
	else
		die("Controlador no encontrado.");
}
/*
	instanciamos nuestro controlador
*/
$Codestack = new $default_controller();