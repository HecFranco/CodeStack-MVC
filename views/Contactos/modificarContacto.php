<div class="col-lg-10 col-lg-offset-1">
	<center><h2><label class="label label-info">Modificar contacto</label></h2></center>
		<form method="post" action="actualizarContacto">
				<div class="form-group col-lg-2">
					<label>ID</label>
					<input type="text" class="form-control" name="id_contacto" readonly="true" required="true" value="<?php echo $data["contacto"]["id_contacto"] ?>">
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-5">
					<label>Nombres</label>
					<input type="text" class="form-control" name="nombres" placeholder="Nombres" required="true" value="<?php echo $data["contacto"]["nombres"] ?>">
				</div>
				<div class="form-group col-lg-5">
					<label>Apellidos</label>
					<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required="true" value="<?php echo $data["contacto"]["apellidos"] ?>">
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-8">
					<label>Dirección</label>
					<input type="text" class="form-control" name="direccion" placeholder="Dirección" required="true" value="<?php echo $data["contacto"]["direccion"] ?>">
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-5">
					<label>Teléfonos</label>
					<textarea cols="6" class="form-control" placeholder="Teléfonos" required="true" name="telefonos"><?php
						$i = 0;
						$total_telefonos = count($data["telefonos"]);
						foreach($data["telefonos"] as $telefono)
						{
							echo $telefono["telefono"];
							$i++;
							if ($i != $total_telefonos)
							{
								echo ", ";
							}
						}
					?></textarea>
				</div>
				<div class="clearfix"></div>
				<div class="btn-group">
					<input type="submit" value="Actualizar" class="btn btn-primary">
					<input type="reset" value="Cancelar" class="btn btn-danger">
				</div>
			</form> 
			<br>
</div>