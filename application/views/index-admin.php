<div id="page-wrapper" class="custom-login-panel">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hola, Administrador</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!--opciones superiores-->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary panel-mostaza">
                    <div class="panel-heading ">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">26</div>
                                <div>Usuarios Online</div>
                            </div>
                        </div>
                    </div>
                    <a href="./profile/online">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green panel-mostaza">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $this->data['recent_payments']; ?></div>
                                <div>Pagos sin Aprobar!</div>
                            </div>
                        </div>
                    </div>
                    <a href="./status-payments">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow panel-mostaza">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa  fa-balance-scale fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $this->data['jackpots']; ?></div>
                                <div>Balance disponible</div>
                            </div>
                        </div>
                    </div>
                    <a href="./balance-details">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red panel-mostaza">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $this->data['active_users']; ?></div>
                                <div>Usuarios Registrados</div>
                            </div>
                        </div>
                    </div>
                    <a href="./profile">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
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
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->


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