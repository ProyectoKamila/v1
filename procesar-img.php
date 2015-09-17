	<script type="text/javascript">
	
 $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            //var ruta = "<?php bloginfo('template_url'); ?>/procesar-img.php";
            var ruta = "http://wedomedia.net/musicodisponible/procesar-img.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#img-c").html(datos);
                }
            });
        });
     });

	</script>