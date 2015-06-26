        <div id="page-wrapper" class="custom-login-panel">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Aprobar / Rechazar Pagos</h1> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
<!--                            DataTables Advanced Tables-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                        <tr>
                                            <th>ID User</th>
                                            <th>ID Reload</th>
                                            <th>Type</th>
                                            <th>N° Referencia</th>
                                            <th>Banco</th>
                                            <th>Fecha Recarga</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['reload'] as $reload=>$valor ){ ?>
                                        <tr class="odd gradeX">

                                            <td><?php echo $valor['id_user']; ?></td>
                                            <td><?php echo $valor['id_register_payment']; ?></td>
                                            <td><?php echo $valor['type']; ?></td>
                                            <td><?php echo $valor['bank']; ?></td>
                                            <td><?php echo $valor['nume_ref']; ?></td>
                                            <td><?php echo $valor['amount']; ?></td>
                                            <td><?php echo $valor['register_date']; ?></td>
                                            <td><?php echo $valor['name']; ?></td>
                                            <td><a href='./casino/update_payment/<? echo $valor['id_register_payment']; ?>' class='glyphicon glyphicon-search'></a></td>
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
