 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Saldo</h1> 
                </div>
                <!-- /.col-lg-12 -->
            <div class="panel-body">
                             
                                <?php 
                                    echo form_open_multipart("/update-payment") ?>
                                <!--     <form role="form" method="post" action="./registering"> -->
                                <fieldset>

                                     <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="id_user" id= 'id_user' type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['id_user']; }?>"> 
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="nume_ref" id='nume_ref' type="text" readonly value="<?php if(isset($this->data)){ echo  $this->data['payment'][0]['nume_ref']; }?>"></font>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="type" id="type" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['type'];}?>"></font>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input type="text" class="form-control" name="bank" placeholder="Banco" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['bank']; }?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="Monto" name="amount" id ="amount" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['amount'];}?>"> 

                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="" name="register_date" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['register_date'];}?>">

                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" title="Estatus Actual" placeholder="" name="status_id" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['name'];}?>">

                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                        <select class="form-control" name="type" id="type" >
                                            <option selected value="">Cambiar Estatus</option>
                                            <option value="2">Aprobar</option>
                                            <option value="3">Rechazar</option>
                                        </select>
                                    </div>                     

                                      <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->

                                    <input type="submit" name="update_payment" class="btn btn-lg btn-success btn-block" value="Actualizar"/>

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
