        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Datos del Usuario</h1> 
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
                              <h1 class="page-header">Datos Personales</h1> 
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
                                        <?php foreach ($this->data['user'] as $user=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['first_name'].' '.$valor['last_name']; ?></td>
                                            <td><?php echo $valor['identity_card']; ?></td>
                                            <td><?php echo $valor['gender']; ?></td>
                                            <td><?php echo $valor['nationality']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <h1 class="page-header">Detalle Apuestas</h1> 
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
                                        <?php foreach ($this->data['bet'] as $bet=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['id_activity_bet']; ?></td>
                                            <td><?php echo $valor['investment']; ?></td>
                                            <td><?php echo $valor['bet']; ?></td>
                                            <td><?php echo $valor['gain']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <h1 class="page-header">Detalle Balance</h1> 
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-balance">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Reload</th>
                                            <th>Withdrawal</th>
                                            <th>Available Bbalance</th>
                                            <th>New Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['balance'] as $balance=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['id_activity_balance']; ?></td>
                                            <td><?php echo $valor['reload']; ?></td>
                                            <td><?php echo $valor['withdrawal']; ?></td>
                                            <td><?php echo $valor['available_balance']; ?></td>
                                            <td><?php echo $valor['new_balance']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <h1 class="page-header">Detalle Juegos</h1> 
                                <table class="table table-striped table-bordered table-hover" id="dataTables-game">
                                    <thead>
                                        <tr>
                                            <th>ID Game</th>
                                            <th>Type</th>
                                            <th>NAme</th>
                                            <th>Minimum Bet</th>
                                            <th>Minimum Bet</th>
                                            <th>Jackpot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['game'] as $game=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['id_game']; ?></td>
                                            <td><?php echo $valor['type']; ?></td>
                                            <td><?php echo $valor['name']; ?></td>
                                            <td><?php echo $valor['minimum_bet']; ?></td>
                                            <td><?php echo $valor['maximum_bet']; ?></td>
                                            <td><?php echo $valor['jackpot']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <h1 class="page-header">Detalle Recargas</h1> 
                                <table class="table table-striped table-bordered table-hover" id="dataTables-game">
                                    <thead>
                                        <tr>
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

                                            <td><?php echo $valor['id_register_payment']; ?></td>
                                            <td><?php echo $valor['type']; ?></td>
                                            <td><?php echo $valor['bank']; ?></td>
                                            <td><?php echo $valor['nume_ref']; ?></td>
                                            <td><?php echo $valor['amount']; ?></td>
                                            <td><?php echo $valor['register_date']; ?></td>
                                            <td><?php echo $valor['name']; ?></td>
                                            <? if($valor['id_register_payment_status'] != 2 ) {
                                            echo "<td><a href='./casino/update_payment/".$valor['id_register_payment']."' class='glyphicon glyphicon-search'></a></td>";
                                            } else {
                                                echo "<td></td>";
                                            }

                                            ?>
                                            
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
