<?php

class TelefonosModel extends Model
{
	public function getTelefonos(int $id_contacto)
	{
		$pst = $this->db->prepare("select telefono from telefonos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute();
		return $pst->fetchAll();
	}

	public function setTelefonos(int $id_contacto, string $telefono)
	{
		$pst = $this->db->prepare("insert into telefonos values (null, :id_contacto, :telefono)");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->bindParam(":telefono", $telefono, PDO::PARAM_STR);
		return $pst->execute();
	}

	public function deleteTelefonos(int $id_contacto)
	{
		$pst = $this->db->prepare("delete from telefonos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		return $pst->execute();
	}
} 
