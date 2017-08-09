<?php

function validarTelefono(string $telefono): int
{
	return preg_match("/^\d{4}-?\d{4}$/", $telefono);
}


function verificarTelefonos(array $telefonos):array
{
	$numeroInvalido = [];
	$i = 0;
	foreach($telefonos as $telefono)
	{
		if(!validarTelefono($telefono))
		{
			$numeroInvalido[$i] = $telefono;
			$i++;
		}
	}
	return $numeroInvalido;
}

function verificarString(string $string)
{
	if(strlen($string))
	{
		return preg_match("/^[a-zA-Z\s]+$/", $string);
	}
}