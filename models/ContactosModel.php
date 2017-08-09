<?php

class ContactosModel extends Model
{
	public function getContactos()
	{
		$query = $this->db->query("select * from contactos");
		return $query->fetchAll();
	}

	public function setContacto(string $nombres, string $apellidos, string $direccion)
	{
		$pst = $this->db->prepare("insert into contactos values (null, :nombres, :apellidos, :direccion)");
		$pst->bindParam(":nombres", $nombres, PDO::PARAM_STR);
		$pst->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
		$pst->bindParam(":direccion", $direccion, PDO::PARAM_STR);
		return $pst->execute();
	}

	public function updateContacto(int $id_contacto, string $nombres, string $apellidos, string $direccion)
	{
		$pst = $this->db->prepare("update contactos set nombres = :nombres, 
									apellidos = :apellidos,
									direccion = :direccion
									where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->bindParam(":nombres", $nombres, PDO::PARAM_STR);
		$pst->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
		$pst->bindParam(":direccion", $direccion, PDO::PARAM_STR);
		return $pst->execute();
	}

	public function deleteContacto(int $id_contacto)
	{
		$pst = $this->db->prepare("delete from contactos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		return $pst->execute();
	}

	public function getContacto(int $id_contacto)
	{
		$pst = $this->db->prepare("select * from contactos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute();
		return $pst->fetch();
	}
} 
