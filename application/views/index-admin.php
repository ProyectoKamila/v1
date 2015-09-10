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
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
<!--                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Actions
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Action</a>
                                    </li>
                                    <li><a href="#">Another action</a>
                                    </li>
                                    <li><a href="#">Something else here</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     /.panel-heading 
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                     /.panel-body 
                </div>-->
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Ultimos recargas sin aprobar
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Actions
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Action</a>
                                    </li>
                                    <li><a href="#">Another action</a>
                                    </li>
                                    <li><a href="#">Something else here</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     <!--/.panel-heading--> 
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                                <td>3:29 PM</td>
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                                <td>3:20 PM</td>
                                                <td>$234.34</td>
                                            </tr>
                                            <tr>
                                                <td>3324</td>
                                                <td>10/21/2013</td>
                                                <td>3:03 PM</td>
                                                <td>$724.17</td>
                                            </tr>
                                            <tr>
                                                <td>3323</td>
                                                <td>10/21/2013</td>
                                                <td>3:00 PM</td>
                                                <td>$23.71</td>
                                            </tr>
                                            <tr>
                                                <td>3322</td>
                                                <td>10/21/2013</td>
                                                <td>2:49 PM</td>
                                                <td>$8345.23</td>
                                            </tr>
                                            <tr>
                                                <td>3321</td>
                                                <td>10/21/2013</td>
                                                <td>2:23 PM</td>
                                                <td>$245.12</td>
                                            </tr>
                                            <tr>
                                                <td>3320</td>
                                                <td>10/21/2013</td>
                                                <td>2:15 PM</td>
                                                <td>$5663.54</td>
                                            </tr>
                                            <tr>
                                                <td>3319</td>
                                                <td>10/21/2013</td>
                                                <td>2:13 PM</td>
                                                <td>$943.45</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                 <!--/.table-responsive--> 
                            </div>
                             <!--/.col-lg-4 (nested)--> 
                            <div class="col-lg-8">
                                <div id="morris-bar-chart"></div>
                            </div>
                             <!--/.col-lg-8 (nested)--> 
                        </div>
                         <!--/.row--> 
                    </div>
                     <!--/.panel-body--> 
                </div>
                
            </div>
            <!-- /.col-lg-8 -->
<!--            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Notifications Panel
                    </div>
                     /.panel-heading 
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small"><em>11:32 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                <span class="pull-right text-muted small"><em>11:13 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                <span class="pull-right text-muted small"><em>10:57 AM</em>
                                </span>
                            </a>
               ƒ             <a href="#" class="list-group-item">
                                <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                <span class="pull-right text-muted small"><em>9:49 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-money fa-fw"></i> Payment Received
                                <span class="pull-right text-muted small"><em>Yesterday</em>
                                </span>
                            </a>
                        </div>
                         /.list-group 
                        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                    </div>
                     /.panel-body 
                </div>
                 /.panel 
        
                 /.panel 
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        Chat
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-refresh fa-fw"></i> Refresh
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-check-circle fa-fw"></i> Available
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-times fa-fw"></i> Busy
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-clock-o fa-fw"></i> Away
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                     /.panel-heading 
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                        </small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                     /.panel-body 
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Send
                                </button>
                            </span>
                        </div>
                    </div>
                     /.panel-footer 
                </div>
                 /.panel .chat-panel 
            </div>-->
            <!-- /.col-lg-4 -->
        </div>
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