<h1>Clausula</h1>

<a href="index.php?action=regClausula" ><input class="btn btn-success" type="button" value="Agregar Clausula"></a>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombres..">
<br><br>
<table border="1" id="myTable">
    
    <thead>
        
    <tr class="table-success">
            <th>Acuerdo</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>
    <tbody id="p">
			
			<?php

			$vistaClausula = new MvcController();
            $vistaClausula -> vistaClausulaController();

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