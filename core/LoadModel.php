<?php

class LoadModel
{
	/*
		solo nos permite cargar nuestro modelo de la carpeta models, recibe como parametro el nombre del modelo
	*/
	function __construct($model)
	{
		require("./models/$model.php");
	}
}