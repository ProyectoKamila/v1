
<div id="page-wrapper" class="custom-login-panel">
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Perfiles <?php if($this->data['message'] == 'online'){ echo 'El L&iacute;nea';}elseif($this->data['message'] == 'online'){ echo 'Desconectados'; }else{echo $this->data['message'];} ?></h1> 
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
                                            <!--<th>Id Usuer</th>-->
                                            <th>Nickname</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Status Account</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data['users'] as $user=>$valor ){ ?>
                                        <tr class="odd gradeX">
                                            <td><a href='./detail-profile/<?php echo $valor['id_user']; ?>' class='glyphicon glyphicon-search'></a></td>
                                            <td><?php echo $valor['nickname']; ?></td>
                                            <td><?php echo $valor['email']; ?></td>
                                            <td><?php echo $valor['name']; ?></td>
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
