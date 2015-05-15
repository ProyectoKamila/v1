<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Su cuenta de usuario fue activada satisfactoriamente, ya puede ingresar al sistema.</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open("/nuevo") ?>
						<!--     <form role="form" method="post" action="./registering"> -->
						<fieldset>
							<input type="hidden" class="form-control" name="id_user" value="<?php echo set_value('id_user') ?>" placeholder="Username" required="" pattern=".{5,12}"title="5 a 12 caracteres">
                                        
										<input type="submit" name="Regresar" class="btn btn-lg btn-success btn-block" value="Página de Inicio"/>
									
						</fieldset>
						<?php echo form_close() ?>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
