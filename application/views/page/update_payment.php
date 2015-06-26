 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Saldo<?php if(isset($this->data['mensaje'])){echo $this->data['mensaje'];}?></h1> 
                </div>
                <!-- /.col-lg-12 -->
            <div class="panel-body">
                             
                                <?php 
                                    echo form_open_multipart("/update-payment") ?>
                                <!--     <form role="form" method="post" action="./registering"> -->
                                <fieldset>
                                    <input class="form-control" name="id_register_payment" id= 'id_user' type="hidden" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['id_register_payment']; }?>"> 
                                     <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="id_user" id= 'id_user' type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['id_user']; }?>"> 
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="nume_ref" id='nume_ref' type="text" readonly value="<?php if(isset($this->data)){ echo  $this->data['payment'][0]['nume_ref']; }?>"></font>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" name="type" id="type" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['type'];}?>"></font>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input type="text" class="form-control" name="bank" placeholder="Banco" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['bank']; }?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="Monto" name="amount" id ="amount" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['amount'];}?>"> 

                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="" name="register_date" type="text" readonly value="<?php if(isset($this->data)){ echo $this->data['payment'][0]['register_date'];}?>">

                                    </div>
                                    <?php if($this->data["payment"][0]["register_payment_status_id"] != 2){ ?>
                                    <div class="form-group">
                                        <!--<span class="input-group-addon"></span>-->
                                        <select name="register_payment_status_id" id='register_payment_status_id' class="form-control" style="background-color: #eee;">
                                            <?php
                                            foreach ($this->data['status'] as $key => $status) {
                                                
//                                            foreach ($this->data['status'] as $this->data['status']['id_register_payment_status'] => $this->data['status']['name'])
//                                               echo '<option values="',$this->data['status']['id_register_payment_status'],'">',$this->data['status']['name'],'</option>';
                                                if($status['id_register_payment_status'] == $this->data["payment"][0]["register_payment_status_id"]){
                                                
                                                ?>
                                            <option selected="selected" values="<?=$status['id_register_payment_status']?>"><?=$status['name']?></option>
                                               <?php
                                                }else{ ?>
                                                <option values="<?=$status['id_register_payment_status']?>"><?=$status['name']?></option>
                                             <?php }
                                        }
                                            ?>
                                            </select>
                                    </div> 
                                    <?php }else{ ?>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <input class="form-control" placeholder="" name="" type="text" readonly value="
                                            <?php foreach ($this->data["status"] as $status1) {
                                                if($status1['id_register_payment_status'] == $this->data["payment"][0]["register_payment_status_id"]){
                                                    echo $status1['name'];
                                                }
                                                                                               
                                                                                           }?>
                                               ">

                                    </div>
                                    
                                    <?php } ?>

                                      <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->
                                <?php if($this->data["payment"][0]["register_payment_status_id"] != 2){ ?>
                                    <input type="submit" name="update_payment" class="btn btn-lg btn-success btn-block" value="Actualizar"/>
                                <?php } ?>
                                </fieldset>
                                <?php echo form_close() ?>
                            </div>
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
