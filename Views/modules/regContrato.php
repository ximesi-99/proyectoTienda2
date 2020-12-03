<h1>Contrato</h1>

<form method="post">
    <label>Código </label><br>
	<input type="text" placeholder="Código" name="codigoRegistro" required>
    <div id="fechas">
		<label>Fecha Inicio: </label>
		<input type="date" name="fechaInicioRegistro" required >

		<label>Fecha Fin: </label>
		<input type="date" name="fechaFinRegistro" required>

	</div>
    <label>Representante Legal: </label>
	<select id="eRegistro" name="repreRegistro" selected="">	
		<?php
            
			$vistaRep = new MvcController();
            $vistaRep -> vistaRepreSelectController();
		?>
	</select><br><br>
    <label>Deportista: </label>
	<select id="eRegistro" name="deportistaRegistro" selected="">	
		<?php
            
			$vistaDep = new MvcController();
            $vistaDep -> vistaDeportistaSelectController();
		?>
	</select><br><br>
    <label>Clausula: </label>
	<select id="eRegistro" name="clausulaRegistro" selected="">	
		<?php
            
			$vistaClau = new MvcController();
            $vistaClau -> vistaClausulasSelectController();
		?>
	</select><br><br>
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

$regContrato = new MvcController();
$regContrato -> registroContratoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>