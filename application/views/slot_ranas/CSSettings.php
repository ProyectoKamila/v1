<script>

     <?php foreach ($consulta as $fila) { ?>
            var   IDSYMBOL_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['id_symbol'] ?> ;
            var   X1_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['x1'] ?> ;
            var   X2_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['x2'] ?> ;
            var   X3_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['x3'] ?> ;
            var   X4_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['x4'] ?> ;
            var   X5_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['x5'] ?> ;
            var   OC_<?php echo $fila['id_symbol'] ?> = <?php echo $fila['ocurrence'] ?> ;

        
     <?php   } ?>

</script>

