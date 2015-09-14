        <div id="page-wrapper"  class="custom-login-panel">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detalle de Balance Casino</h1> 
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
                                            <th id="">Id jackpot</th>
                                            <th>Disponible</th>
                                            <th>Casino</th>
                                            <th>Porcentaje</th>
                                            <th>Juego</th>
                                            <th>Juegos Gratis</th>
                                            <th>Porcentaje Juego Gratis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //debug(print_r($this->data['balance_casino']));

                                            foreach ($this->data['balance_casino'] as $balance_casino=>$valor ){ ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['id_jackpot']; ?></td>
                                            <td><?php echo $valor['jackpot']; ?></td>
                                            <td><?php echo $valor['debt']; ?></td>
                                            <td><?php echo $valor['percent']; ?></td>
                                            <td><?php echo $valor['casino_jackpotcol']; ?></td>
                                            <td><?php echo $valor['jackpotfree']; ?></td>
                                            <td><?php echo $valor['percentfreegame']; ?></td>
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
