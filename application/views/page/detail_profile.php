        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Datos del usuario</h1> 
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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-user">
                                    <thead>
                                        <tr>
                                            <th>Id Usuer</th>
                                            <th>nickname</th>
                                            <th>email</th>
                                            <th>Status Account</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($this->data['user'] as $user=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <? print_r($data['user']) ?>
                                            <td><? echo $valor['first_name'].' '.$valor['last_name']; ?></td>
                                            <td><? echo $valor['identity_card']; ?></td>
                                            <td><? echo $valor['gender']; ?></td>
                                            <td><? echo $valor['nationality']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-bet">
                                    <thead>
                                        <tr>
                                            <th>ID Bet</th>
                                            <th>Invesment</th>
                                            <th>Bet</th>
                                            <th>Gain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($this->data['bet'] as $bet=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                        <? print_r($data['bet']) ?>
                                            <td><? echo $valor['id_bet']; ?></td>
                                            <td><? echo $valor['invesment']; ?></td>
                                            <td><? echo $valor['bet']; ?></td>
                                            <td><? echo $valor['gain']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-balance">
                                    <thead>
                                        <tr>
                                            <th>ID Bet</th>
                                            <th>Invesment</th>
                                            <th>Bet</th>
                                            <th>Gain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($this->data['balance'] as $balance=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                        <? print_r($data['balance']) ?>
                                            <td><? echo $valor['id_bet']; ?></td>
                                            <td><? echo $valor['invesment']; ?></td>
                                            <td><? echo $valor['bet']; ?></td>
                                            <td><? echo $valor['gain']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-game">
                                    <thead>
                                        <tr>
                                            <th>ID Bet</th>
                                            <th>Invesment</th>
                                            <th>Bet</th>
                                            <th>Gain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($this->data['game'] as $game=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <? print_r($data['balance']) ?>
                                            <td><? echo $valor['id_bet']; ?></td>
                                            <td><? echo $valor['invesment']; ?></td>
                                            <td><? echo $valor['bet']; ?></td>
                                            <td><? echo $valor['gain']; ?></td>
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
