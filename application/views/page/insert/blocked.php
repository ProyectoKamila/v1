<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Usuario esta Bloqueado.</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open("/login") ?>
						<!--     <form role="form" method="post" action="./registering"> -->
						<fieldset>        
								<input type="submit" name="Regresar" class="btn btn-lg btn-success btn-block" value="Regresar"/>
									
						</fieldset>
						<?php echo form_close() ?>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
