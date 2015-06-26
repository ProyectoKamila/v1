        <div id="page-wrapper"  class="custom-login-panel">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Actividades de apuestas</h1> 
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
                                            <th id="">Id Activity</th>
                                            <th>Juego</th>
                                            <th>Usuario</th>
                                            <th>Fecha hora Inicial</th>
                                            <th>Fecha hora Final</th>
                                            <th>Saldo Inicial</th>
                                            <th>Saldo Final</th>
                                            <th>Horas en juego</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //debug(print_r($this->data['activity']));

                                            foreach ($this->data['activity'] as $activity=>$valor ){ ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['id_activity_bet']; ?></td>
                                            <td><?php echo $valor['id_game']; ?></td>
                                            <td><?php echo $valor['id_user']; ?></td>
                                            <td><?php echo $valor['time_i']; ?></td>
                                            <td><?php echo $valor['time_f']; ?></td>
                                            <td><?php echo $valor['coins_i']; ?></td>
                                            <td><?php echo $valor['coins_f']; ?></td>
                                            <td><?php ?></td>

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
