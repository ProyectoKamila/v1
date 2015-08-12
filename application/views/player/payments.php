<div id="page-wrapper" class="custom-login-panel">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mis Recargas</h1> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default ">
                        <!-- /.panel-heading -->
                        <div class="panel-body custom-panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-user">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Tipo de Instrumento</th>
                                            <th>Banco</th>
                                            <th>N° referencia</th>
                                            <th>Monto</th>
                                            <th>Fecha de Registro</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['data'] as $recarga=>$data ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data['id_register_payment']; ?></td>
                                            <td><?php echo $data['type']; ?></td>
                                            <td><?php echo $data['bank']; ?></td>
                                            <td><?php echo $data['nume_ref']; ?></td>
                                            <td><?php echo $data['amount']; ?></td>
                                            <td><?php echo $data['register_date']; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
