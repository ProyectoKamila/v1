<div class="row">
               <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading ">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> ( ) </div>
                                    <div>Agregar Saldo</div>
                                </div>
                            </div>
                        </div>
                        <a href="./load-payment">
                            <div class="panel-footer">
                                <span class="pull-left">Ahora</span>
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
                                    <i class="fa fa-money fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo($this->data['coins']); ?></div>
                                    <div>Saldo Actual</div>
                                </div>
                            </div>
                        </div>
                        <a href="./payments">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Recargas</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
    </div>
<div id="page-wrapper" class="custom-login-panel">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Datos del Usuario s</h1> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading custom-panel-heading">
<!--                            DataTables Advanced Tables-->
                                <h1 class="">Datos Personales ss</h1> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body custom-panel-body">
                            <div class="dataTable_wrapper">
                              
                                <table class="table table-striped table-bordered table-hover" id="dataTables-user">
                                    <thead>
                                        <tr>
                                            <th>Nombre y Apellido</th>
                                            <th>N° Identidad</th>
                                            <th>Nickname</th>
                                            <th>Email</th>
                                            <th>Nacionalidad</th>
                                            <th>Saldo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['user'] as $user=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $valor['first_name'].' '.$valor['last_name']; ?></td>
                                            <td><?php echo $valor['identity_card']; ?></td>
                                            <td><?php echo $valor['nickname']; ?></td>
                                            <td><?php echo $valor['email']; ?></td>
                                            <td><?php echo $valor['nationality']; ?></td>
                                            <td><?php echo $valor["coins"]; ?></td>
                                            <td><?php echo $valor['name']; ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <h1 class="">Detalle Apuestas</h1> 
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
<!--                                <h1 class="page-header">Detalle Balance</h1> 
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
                                </table>-->
                                <br>
<!--                                <h1 class="page-header">Detalle Juegos</h1> 
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
                                </table>-->
                                <h1 class="">Detalle Recargas</h1> 
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
<?php // debug($this->data['user'],false); ?>