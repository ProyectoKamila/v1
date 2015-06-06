<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Sus Datos Fueron Insertados Correctamente. Revise su correo para activar el usuario.</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open("/newest") ?>
						<!--     <form role="form" method="post" action="./registering"> -->
						<fieldset>
							<input type="hidden" class="form-control" name="nickname" value="<?php echo set_value('nickname') ?>" placeholder="Username" required="" pattern=".{5,12}"title="5 a 12 caracteres">
                                        
										<input type="submit" name="Regresar" class="btn btn-lg btn-success btn-block" value="Ingresar"/>
									
						</fieldset>
						<?php echo form_close() ?>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
