 <div id="page-wrapper"  class="custom-login-panel">
            
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Saldo</h1> 
                </div>
                <!-- /.col-lg-12 -->
            <div class="panel-body custom-panel-body">
                               <?php if ($this->session->flashdata('message')!= null){
                                    echo "<div id='infoMessage' class='alert alert-info' role='alert'>". $this->session->flashdata('message') ."</div>";
                                    }
                                ?>
                                <?php 
                                    echo form_open_multipart("/load-payment") ?>
                                <!--     <form role="form" method="post" action="./registering"> -->
                                <fieldset>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="id_user" id= 'id_user' type="hidden" value="<?php if(isset($this->data)){ echo  $this->data['id_user']; }?>" required=""> 
                                        <input class="form-control" placeholder="N° Referencia" name="nume_ref" id='nume_ref' type="text" pattern=".{4,10}" title="4 a 12 digitos"></font>
                                        <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('nume_ref'); ?></font>

                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                        <select class="form-control" name="type" id="type" >
                                            <option selected value="">Tipo De Instrumento</option>
                                            <option value="Transferencia">Transferencia</option>
                                            <option value="Deposito">Deposito</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input type="text" class="form-control" name="bank" placeholder="Banco" required="">
                                        <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('bank'); ?></font>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="Monto" name="amount" id ="amount" type="text" required=""> 
                                        <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('amount'); ?></font>

                                    </div>                            

                                      <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->

                                    <input type="submit" name="register_payment" class="btn btn-lg btn-success btn-block" value="Registrar"/>

                                </fieldset>
                                <?php echo form_close() ?>
                            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
