<h1>Nutrición</h1>

<form method="post">
    <label>Código: </label><br>
	<input type="text" placeholder="Código" name="cedulaRegistro" required>
    <label>Resultado: </label><br>
	<input type="text" placeholder="Resultado" name="resultadoRegistro" required>
    <label>Recomendaciones: </label><br>
	<input type="text" placeholder="Recomendaciones" name="recomendacionesRegistro" required>
		
	<input class="btn btn-success" type="submit" value="Enviar">

</form>

<?php
$regNut = new MvcController();
$regNut -> registroNutricionController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>