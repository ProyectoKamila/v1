<fieldset>
	<legend>Formulario de registro</legend>
		<?php echo form_open("/insert_controller/recibirdatos") ?>
			<table>
				<tr>
					<td>
						Seudónimo:
					</td>
					<td>
						<input type="text" name="nickname" value="<?php echo set_value('nickname') ?>" />
					</td>
				</tr>
				<tr><input type="hidden" name="status" value="0" />
					<td>
						Email:
					</td>
					<td>
						<input type="text" name="email" value="<?php echo set_value('email') ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Clave:
					</td>
					<td>
						<input type="password" name="pass" />
					</td>
				</tr>
				<tr>
					<td>
						Confirmar Clave:
					</td>
					<td>
						<input type="password" name="pass" />
					</td>
				</tr>
				<tr>
				<td></td>
				<td>
					 <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo validation_errors(); ?></font>
				</td>
			</tr>
				<tr>
					<td>
					
					</td>
					<td>
						<input type="submit" value="Registrarme" title="Registrarme" />
					</td>
				</tr>
			</table>
		<?php echo form_close() ?>
</fieldset>
</body>
</html>