<div class="col-lg-10 col-lg-offset-1">
	<center><h2><label class="label label-info">Agenda Telefónica</label></h2></center>

	<form method="post" action="Contactos/setContacto">

		<div class="form-group col-lg-5">
			<label>Nombres</label>
			<input type="text" class="form-control" name="nombres" placeholder="Nombres" required="true">
		</div>
		<div class="form-group col-lg-5">
			<label>Apellidos</label>
			<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required="true">
		</div>
		<div class="clearfix"></div>
		<div class="form-group col-lg-8">
			<label>Dirección</label>
			<input type="text" class="form-control" name="direccion" placeholder="Dirección" required="true">
		</div>
		<div class="clearfix"></div>
		<div class="form-group col-lg-5">
			<label>Teléfonos</label>
			<textarea cols="6" class="form-control" placeholder="Teléfonos" required="true" name="telefonos"></textarea>
		</div>
		<div class="clearfix"></div>
		<div class="btn-group">
			<input type="submit" value="Guardar" class="btn btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-danger">
		</div>
	</form>
	<hr>
	<table class="table table-hover table-striped">
		<tr>
			<td>ID</td>
			<td>Nombres</td>
			<td>Apellidos</td>
			<td>Dirección</td>
			<td>Teléfonos</td>
			<td colspan="2">Opciones</td>
		</tr>

		<?php
			foreach($data["contactos"] as $contacto)
			{
				echo "<tr>
							<td>{$contacto['id_contacto']}</td>
							<td>{$contacto['nombres']}</td>
							<td>{$contacto['apellidos']}</td>
							<td>{$contacto['direccion']}</td>";
				echo "<td>";
				foreach($data["telefonos"][$contacto["id_contacto"]] as $telefono)
				{
					echo "<li>{$telefono["telefono"]}</li>";
				}
				echo "</td>";
				echo "<td><a href='Contactos/modificarContacto?id_contacto={$contacto['id_contacto']}'>Modificar</a></td>
					<td><a href='Contactos/eliminarContacto?id_contacto={$contacto['id_contacto']}'>Eliminar</a></td>
				</tr>";
			}
		?>
	</table>
</div>