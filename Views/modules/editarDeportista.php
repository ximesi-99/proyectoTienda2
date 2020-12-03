<h1>Deportistas</h1>
<?php

$editarDep = new MvcController();
$editarDep -> editarDepController();
?>

<form method="post">
    <label>Técnico: </label>
	<select id="tRegistro" name="tecnicoRegistro" selected="">	
		<?php
            
			$vistaTecnico = new MvcController();
            $vistaTecnico -> vistaTecnicoSelectController();
		?>
	</select><br>
    <label>Bicicleta: </label>
	<select id="bRegistro" name="bicicletaRegistro" selected="">	
		<?php
            
			$vistaBici = new MvcController();
            $vistaBici -> vistaBicicletaSelectController();
		?>
	</select><br>
    <label>Plan Entrenamiento: </label>
	<select id="plRegistro" name="planEntrenamientoRegistro" selected="">	
		<?php
            
			$vistaPlanE = new MvcController();
            $vistaPlanE -> vistaPlanEntreSelectController();
		?>
	</select><br>
	<label>Estado: </label>
	<select id="eRegistro" name="estadoRegistro" selected="">	
		<?php
            
			$vistaEst = new MvcController();
            $vistaEst -> vistaEstadoSelectController();
		?>
	</select><br><br>
    	
	<input class="btn btn-success" type="submit" value="Enviar">

</form>

<?php
$editarDep -> actualizarDepController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>