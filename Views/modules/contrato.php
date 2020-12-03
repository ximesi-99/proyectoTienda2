<h1>Contrato</h1>

<a href="index.php?action=regContrato" ><input class="btn btn-success" type="button" value="Agregar Contrato"></a>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombres..">
<br><br>
<table border="1" id="myTable">
    
    <thead>
        
    <tr class="table-success">
            <th>Código</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Representante Legal</th>
            <th>Deportista</th>
            <th>Clausula</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>
    <tbody id="p">
			
			<?php

			$vistaContrato = new MvcController();
            $vistaContrato -> vistaContratoController();

			?>

		</tbody>

</table>

<?php

if(isset($_GET["action"])){

if($_GET["action"] == "cambio"){

    echo "Cambio Exitoso";

}

}

?>