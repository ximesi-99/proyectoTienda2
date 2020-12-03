<h1>Clausula</h1>

<form method="post">
    <label>Acuerdo </label><br>
	<input type="text" placeholder="acuerdo" name="acuerdoRegistro" required>
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

$regClausula = new MvcController();
$regClausula -> registroClausulaController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>