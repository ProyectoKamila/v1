<div id="page-wrapper" class="custom-login-panel">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hola <?php echo $this->data['first_name'] . ' ' . $this->data['last_name']; ?>. Tienes <?php echo($this->data['coins']); ?> fichas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!--opciones superiores-->

    <!-- /.row -->
    <div class="row">

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">

                </div>
                <div class="clearfix"></div>
                            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://casino4as.com/wp-content/uploads/2015/06/poker.jpg" alt="">
                    <div class="caption">
                        <h3>Poker 4as</h3>
                        <p>


                        </p>
                        <p><a href="poker" class="btn btn-primary" role="button">Jugar Ahora</a> 
                            <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                        </p>
                    </div>
                </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/game-blackjack/game1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>BlackJack 4as</h3>
                            <p>


                            </p>
                            <p><a href="blackjack" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/game-jacks-or-better/game1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>Videopoker 4as</h3>
                            <p>


                            </p>
                            <p><a href="jacks" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-4as/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine 4as</h3>
                            <p>


                            </p>
                            <p><a href="slotmachine-4as" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-egipcio/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Egipto</h3>
                            <p>


                            </p>
                            <p><a href="slotmachine-egipcia" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-espacial/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Espacial</h3>
                            <p>


                            </p>
                            <p><a href="slotmachine-espacial" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-marino/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Marino</h3>
                            <p>


                            </p>
                            <p><a href="slotmachine-marino" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./game-slot-machine/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Frutas</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-ranas/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Ranas</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-ranas" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-deportivo/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Ranas</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-deportivo" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-bebidas/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Bebidas</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-bebidas" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-candy/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Bebidas</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-candy" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-musical/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Musical</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-musical" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-sensual/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Sensual</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-sensual" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./games/slot-diamantes/game_1024x768/sprites/bg_menu.jpg" alt="">
                        <div class="caption">
                            <h3>SlotMachine Diamantes</h3>
                            <p>
                            </p>
                            <p><a href="slotmachine-diamantes" class="btn btn-primary" role="button">Jugar Ahora</a> 
                                <!--            <a href="#" class="btn btn-default" role="button">Button</a>-->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<?php $this->load->view('page/footer2'); ?>
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
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
</body>

</html>