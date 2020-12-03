<h1>Técnicos</h1>

    <?php

	$editarTec = new MvcController();
	$editarTec -> editarTecniController();
	?>

<form method="post">
	<label>Plan de entrenamiento: </label>
	<select id="pRegistro" name="planEntreEditar" selected="">	
		<?php
            
			$vistaPlanEntre = new MvcController();
            $vistaPlanEntre -> vistaPlanEntreSelectController();
		?>
	</select><br><br>
	<label>Estado: </label>
	<select id="eRegistro" name="estadoeditar" selected="">	
		<?php
            
			$vistaEst = new MvcController();
            $vistaEst -> vistaEstadoSelectController();
		?>
	</select><br><br>

		
	<input class="btn btn-success" type="submit" value="Enviar">

	<script type="text/javascript">
		

	</script>    
</form>
<?php

$editarTec -> actualizarTecniController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>