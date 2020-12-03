<?php 
	class MvcController{

		/*-------------------------------------
		LLAMADA A LA PLANTILLA
		---------------------------------------*/

		public function plantilla(){

			#include "Views/modules/login.php";
			include "Views/template.php";

		}

		/*-------------------------------------
		ENLACES
		---------------------------------------*/
		public function enlacesPaginasController(){

			if (isset($_GET["action"])) {
				$enlacesController = $_GET["action"];
			}
			else{

				$enlacesController = "index";
			}

			$respuesta = Paginas::enlacesPaginasModel($enlacesController);

			include $respuesta;
		}

		/*-------------------------------------
		LOGIN
		---------------------------------------*/

		#VALIDACIÓN DEL LOGIN
		#------------------------------------
		public function validarLoginController(){
			session_start();
			if(isset($_POST["usuarioValidacion"])){
				$datosController = array( 
					"usu"=>$_POST["usuarioValidacion"],
					"pss"=>$_POST["passwordValidacion"]);
				$respuesta = Datos::validarLoginModel($datosController, "usuario");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}
	
				else{
	
					header("location:index.php");
				}
	
			}
		}

		/*-------------------------------------
		ESTADO
		---------------------------------------*/
		//mostrar todas los estados en un select
		public function vistaEstadoSelectController(){
			$respuesta = Datos::vistaEstadoModel("estado");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_estado"];
				$e=$item["estado"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		TECNICO
		---------------------------------------*/
		#REGISTRO DE TECNICO 
		#------------------------------------
		public function registroTecnicoController(){

			if(isset($_POST["cedulaRegistro"])){
				$datosController = array( 
					"ced"=>$_POST["cedulaRegistro"],
					"nom"=>$_POST["nombreRegistro"],
					"apl"=>$_POST["apellidoRegistro"],
					"usu"=>$_POST["usuarioRegistro"],
					"pss"=>$_POST["passwordRegistro"],
					"edad"=>$_POST["edadRegistro"],
					"sex"=>$_POST["sexoRegistro"],
					"tel"=>$_POST["telefonoRegistro"],
					"prof"=>$_POST["profesionRegistro"],
					"est"=>$_POST["estadoRegistro"],
					"entre"=>$_POST["PlanEntrenamientoRegistro"]);
				$respuesta = Datos::registroTecnicoModel($datosController, "usuario");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}
	
				else{
	
					header("location:index.php");
				}
	
			}
	
		}
		
		#VISTA DE TECNICOS
		#------------------------------------
		public function vistaTecnicoController(){

			$respuesta = Datos::vistaTecnicoModel("usuario");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$fechaIni=0;
				$fechaFin=0;

				$est=Datos::vistaEstadoModel("estado");
				$plan=Datos::vistaPlanEntreModel("plan_entrenamiento");

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($plan as $row => $item2){
					$fechaIni=$item2["fecha_inicio"];
					$fechaFin=$item2["fecha_fin"];
				}
				

			echo'<tr >
					<td>'.$item["cedula"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["apellido"].'</td>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["edad"].'</td>
					<td>'.$item["sexo"].'</td>
					<td>'.$item["telefono"].'</td>
					<td>'.$item["profesion"].'</td>
					<td>'.$nomEst.'</td>
					<td>'.$fechaIni.' / '.$fechaFin.'</td>
					<td><a href="index.php?action=editarTecnico&idUsu='.$item["id_usuario"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		#EDITAR TECNICO
		#------------------------------------

		public function editarTecniController(){

			$datosController = array(
				"idUsu" => $_GET["id_usuario"]);
			$respuesta = Datos::editarTecnicoModel($datosController, "usuario");

			echo'<input type="hidden" value="'.$respuesta["id_usuario"].'" name="idUsuEditar">
				<label>Cédula: </label><br><br>
				<input type="text" value="'.$respuesta["cedula"].'" name="cedEditar" required><br><br>
				<label>Nombre: </label><br><br>
				<input type="text" value="'.$respuesta["nombre"].'" name="nomEditar" required><br><br>
				<label>Apellido: </label><br><br>
				<input type="text" value="'.$respuesta["apellido"].'" name="apellEditar" required><br><br>
				<label>Usuario: </label><br><br>
				<input type="text" value="'.$respuesta["usuario"].'" name="usuEditar" required><br><br>
				<label>Contraseña: </label><br><br>
				<input type="password" value="'.$respuesta["password"].'" name="pssEditar" required><br><br>
				<label>Edad: </label><br><br>
				<input type="text" value="'.$respuesta["edad"].'" name="edadEditar" required><br><br>
				<label>Sexo: </label><br><br>
				<input type="text" value="'.$respuesta["sexo"].'" name="sexoEditar" required><br><br>
				<label>Telefono: </label><br><br>
				<input type="text" value="'.$respuesta["telefono"].'" name="telEditar" required><br><br>
				<label>Profesion: </label><br><br>
				<input type="text" value="'.$respuesta["profesion"].'" name="profEditar" required><br><br>';
				

		}

		#ACTUALIZAR TECNICO
		#------------------------------------
		public function actualizarTecniController(){

			if(isset($_POST["cedEditar"])){
				$datosController = array("idUsu"=>$_POST["idUsuEditar"],
										"ced"=>$_POST["cedEditar"],
										"nom"=>$_POST["nomEditar"],
										"apell"=>$_POST["apellEditar"],
										"usu"=>$_POST["usuEditar"],
										"pss"=>$_POST["pssEditar"],
										"edad"=>$_POST["edadEditar"],
										"sexo"=>$_POST["sexoEditar"],
										"tel"=>$_POST["telEditar"],
										"prof"=>$_POST["profEditar"],);
						
				$respuesta = Datos::actualizarDepenModel($datosController, "usuario");

				if($respuesta == "success"){

					header("location:index.php?action=cambio");

				}
				else{

					echo "error";

				}
			}
			
		}
		
		
		


		//mostrar todas los tecnicos en un select
		public function vistaTecnicoSelectController(){
			$respuesta = Datos::vistaTecnicoModel("usuario");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_usuario"];
				$e=$item["nombre"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		DEPORTISTA
		---------------------------------------*/
		#REGISTRO DE DEPORTISTA 
		#------------------------------------
		public function registroDeportistaController(){

			if(isset($_POST["cedulaRegistro"])){
				$datosController = array( 
					"ced"=>$_POST["cedulaRegistro"],
					"nom"=>$_POST["nombreRegistro"],
					"apl"=>$_POST["apellidoRegistro"],
					"usu"=>$_POST["usuarioRegistro"],
					"pss"=>$_POST["passwordRegistro"],
					"edad"=>$_POST["edadRegistro"],
					"sex"=>$_POST["sexoRegistro"],
					"tel"=>$_POST["telefonoRegistro"],
					"estatu"=>$_POST["estaturaRegistro"],
					"peso"=>$_POST["pesoRegistro"],
					"tec"=>$_POST["tecnicoRegistro"],
					"bici"=>$_POST["bicicletaRegistro"],
					"plaE"=>$_POST["planEntrenamientoRegistro"],
					"est"=>$_POST["estadoRegistro"],
					"objP"=>$_POST["objPreparacionRegistro"]);
				$respuesta = Datos::registroDeportistaModel($datosController, "usuario");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}

		public function vistaDeportistaController(){

			$respuesta = Datos::vistaDeportistaModel("usuario");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomTec=0;
				$nomBici=0;
				$fechaIni=0;
				$fechaFin=0;

				$est=Datos::vistaEstadoModel("estado");
				$tec=Datos::vistaTecnicoModel("usuario");
				$bici=Datos::vistaBicicletaModel("bicicleta");
				$plan=Datos::vistaPlanEntreModel("plan_entrenamiento");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($tec as $row => $item2){
					$nomTec=$item2["nombre"];
				}
				foreach($bici as $row => $item3){
					$nomBici=$item3["marca"];
				}
				foreach($plan as $row => $item4){
					$fechaIni=$item4["fecha_inicio"];
					$fechaFin=$item4["fecha_fin"];
				}

			echo'<tr >
					<td>'.$item["cedula"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["apellido"].'</td>
					<td>'.$item["edad"].'</td>
					<td>'.$item["sexo"].'</td>
					<td>'.$item["telefono"].'</td>
					<td>'.$item["estatura"].'</td>
					<td>'.$item["peso"].'</td>
					<td>'.$item["objetivoPreparacion"].'</td>
					<td>'.$nomTec.'</td>
					<td>'.$nomBici.'</td>
					<td>'.$fechaIni.' / '.$fechaFin.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarDeportista&idUsu='.$item["id_usuario"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		public function vistaDeportistaSelectController(){
			$respuesta = Datos::vistaDeportistaModel("usuario");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_usuario"];
				$e=$item["nombre"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		#EDITAR DEPORTISTA
		#------------------------------------

		public function editarDepController(){

			$datosController = array(
				"idUsu" => $_GET["id_usuario"]);
			$respuesta = Datos::editarDepModel($datosController, "usuario");

			echo'<input type="hidden" value="'.$respuesta["id_usuario"].'" name="idUsuEditar">
				<label>Cédula: </label><br><br>
				<input type="text" value="'.$respuesta["cedula"].'" name="cedEditar" required><br><br>
				<label>Nombre: </label><br><br>
				<input type="text" value="'.$respuesta["nombre"].'" name="nomEditar" required><br><br>
				<label>Apellido: </label><br><br>
				<input type="text" value="'.$respuesta["apellido"].'" name="apellEditar" required><br><br>
				<label>Usuario: </label><br><br>
				<input type="text" value="'.$respuesta["usuario"].'" name="usuEditar" required><br><br>
				<label>Contraseña: </label><br><br>
				<input type="password" value="'.$respuesta["password"].'" name="pssEditar" required><br><br>
				<label>Edad: </label><br><br>
				<input type="text" value="'.$respuesta["edad"].'" name="edadEditar" required><br><br>
				<label>Sexo: </label><br><br>
				<input type="text" value="'.$respuesta["sexo"].'" name="sexoEditar" required><br><br>
				<label>Telefono: </label><br><br>
				<input type="text" value="'.$respuesta["telefono"].'" name="telEditar" required><br><br>
				<label>Estatura: </label><br><br>
				<input type="text" value="'.$respuesta["estatura"].'" name="estaturaEditar" required><br><br>
				<label>Peso: </label><br><br>
				<input type="text" value="'.$respuesta["peso"].'" name="pesoEditar" required><br><br>
				<label>Objetivo preparación: </label><br><br>
				<input type="text" value="'.$respuesta["objetivoPreparacion"].'" name="objPrepEditar" required><br><br>';
				

		}

		#ACTUALIZAR DEPORTISTA
		#------------------------------------
		public function actualizarDepController(){

			if(isset($_POST["cedEditar"])){
				$datosController = array("idUsu"=>$_POST["idUsuEditar"],
										"ced"=>$_POST["cedEditar"],
										"nom"=>$_POST["nomEditar"],
										"apell"=>$_POST["apellEditar"],
										"usu"=>$_POST["usuEditar"],
										"pss"=>$_POST["pssEditar"],
										"edad"=>$_POST["edadEditar"],
										"sexo"=>$_POST["sexoEditar"],
										"tel"=>$_POST["telEditar"],
										"esta"=>$_POST["estaturaEditar"],
										"peso"=>$_POST["pesoEditar"],
										"obj"=>$_POST["objPrepEditar"]);
						
				$respuesta = Datos::actualizarDepModel($datosController, "usuario");

				if($respuesta == "success"){

					header("location:index.php?action=cambio");

				}
				else{

					echo "error";

				}
			}
		}
		

		/*-------------------------------------
		MEDICO
		---------------------------------------*/
		#REGISTRO DE MEDICO 
		#------------------------------------
		public function registroMedicoController(){

			if(isset($_POST["cedulaRegistro"])){
				$datosController = array( 
					"ced"=>$_POST["cedulaRegistro"],
					"nom"=>$_POST["nombreRegistro"],
					"apl"=>$_POST["apellidoRegistro"],
					"usu"=>$_POST["usuarioRegistro"],
					"pss"=>$_POST["passwordRegistro"],
					"edad"=>$_POST["edadRegistro"],
					"sex"=>$_POST["sexoRegistro"],
					"tel"=>$_POST["telefonoRegistro"],
					"esp"=>$_POST["especialidadRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroMedicoModel($datosController, "usuario");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}

		public function vistaMedicoController(){

			$respuesta = Datos::vistaMedicoModel("usuario");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;

				$est=Datos::vistaEstadoModel("estado");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				

			echo'<tr >
					<td>'.$item["cedula"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["apellido"].'</td>
					<td>'.$item["edad"].'</td>
					<td>'.$item["sexo"].'</td>
					<td>'.$item["telefono"].'</td>
					<td>'.$item["especialidad"].'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarMedico&codigo='.$item["id_usuario"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		public function vistaMedicoSelectController(){
			$respuesta = Datos::vistaMedicoModel("medico");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_medico"];
				$e=$item["nombre"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		REPRESENTANTE LEGAL
		---------------------------------------*/
		#REGISTRO DE REPRESENTANTE LEGAL 
		#------------------------------------
		public function registroRepreLegalController(){

			if(isset($_POST["cedulaRegistro"])){
				$datosController = array( 
					"ced"=>$_POST["cedulaRegistro"],
					"nom"=>$_POST["nombreRegistro"],
					"apl"=>$_POST["apellidoRegistro"],
					"usu"=>$_POST["usuarioRegistro"],
					"pss"=>$_POST["passwordRegistro"],
					"edad"=>$_POST["edadRegistro"],
					"sex"=>$_POST["sexoRegistro"],
					"tel"=>$_POST["telefonoRegistro"],
					"prof"=>$_POST["profesionRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroRepreLegalModel($datosController, "usuario");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaRepreLegalController(){

			$respuesta = Datos::vistaRepreLegalModel("usuario");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;

				$est=Datos::vistaEstadoModel("estado");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				

			echo'<tr >
					<td>'.$item["cedula"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["apellido"].'</td>
					<td>'.$item["edad"].'</td>
					<td>'.$item["sexo"].'</td>
					<td>'.$item["telefono"].'</td>
					<td>'.$item["profesion"].'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarRepLegal&codigo='.$item["id_usuario"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los tecnicos en un select
		public function vistaRepreSelectController(){
			$respuesta = Datos::vistaRepreLegalModel("usuario");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_usuario"];
				$e=$item["nombre"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}


		/*-------------------------------------
		BICICLETA
		---------------------------------------*/
		#REGISTRO DE BICICLETA 
		#------------------------------------
		public function registroBicicletaController(){

			if(isset($_POST["modeloRegistro"])){
				$datosController = array( 
					"mar"=>$_POST["marcaRegistro"],
					"mod"=>$_POST["modeloRegistro"],
					"tall"=>$_POST["tallaRegistro"],
					"peso"=>$_POST["pesoRegistro"],
					"grup"=>$_POST["grupoRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroBicicletaModel($datosController, "bicicleta");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaBicicletaController(){

			$respuesta = Datos::vistaBicicletaModel("bicicleta");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;

				$est=Datos::vistaEstadoModel("estado");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				

			echo'<tr >
					<td>'.$item["marca"].'</td>
					<td>'.$item["modelo"].'</td>
					<td>'.$item["talla"].'</td>
					<td>'.$item["peso"].'</td>
					<td>'.$item["grupo"].'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarBicicleta&codigo='.$item["id_bicicleta"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los modelos de bicicleta en un select
		public function vistaBicicletaSelectController(){
			$respuesta = Datos::vistaBicicletaModel("bicicleta");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_bicicleta"];
				$e=$item["marca"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		ADAPTACIÓN BICICLETA
		---------------------------------------*/
		#REGISTRO DE BICICLETA 
		#------------------------------------
		public function registroAdapBiciController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaI"=>$_POST["fechaInicioRegistro"],
					"fechaF"=>$_POST["fechaFinRegistro"],
					"rut"=>$_POST["rutinaRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroAdapBiciModel($datosController, "adaptacion_bicicleta");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaAdapBicicletaController(){

			$respuesta = Datos::vistaAdapBicicletaModel("adaptacion_bicicleta");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomRut=0;
				$est=Datos::vistaEstadoModel("estado");
				$rut=Datos::vistaRutinaModel("rutina");

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($rut as $row => $ite){
					$nomRut=$ite["recorrido"];
				}

			echo'<tr >
					<td>'.$item["codigo"].'</td>
					<td>'.$item["fecha_inicio"].'</td>
					<td>'.$item["fecha_fin"].'</td>
					<td>'.$nomRut.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarAdapBici&codigo='.$item["id_adaptacionBici"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas las adaptaciones de bicicleta en un select
		public function vistaAdapBicicletaSelectController(){
			$respuesta = Datos::vistaAdapBicicletaModel("adaptacion_bicicleta");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_adaptacionBici"];
				$e=$item["codigo"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		PLAN ENTRENAMIENTO
		---------------------------------------*/
		#REGISTRO DE PLAN ENTRENAMIENTO 
		#------------------------------------
		public function registroPlanEntreController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaI"=>$_POST["fechaInicioRegistro"],
					"fechaF"=>$_POST["fechaFinRegistro"],
					"intr"=>$_POST["introduccionRegistro"],
					"preF"=>$_POST["prepFisicaRegistro"],
					"adap"=>$_POST["adapBiciRegistro"],
					"test"=>$_POST["testRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroPlanEntreModel($datosController, "plan_entrenamiento");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaPlanEntreController(){

			$respuesta = Datos::vistaPlanEntreModel("plan_entrenamiento");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$idLecc=0;
				$idPrep=0;
				$fechaTest=0;
				$fechaIni=0;
				$fechaFin=0;

				$est=Datos::vistaEstadoModel("estado");
				$intro=Datos::vistaIntroduccionModel("introduccion");
				$prep=Datos::vistaPrepFisicaModel("preparacion_fisica");
				$test=Datos::vistaTestModel("test");
				$adap=Datos::vistaAdapBicicletaModel("adaptacion_bicicleta");			

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($intro as $row => $item2){
					$nomLecc=0;
					$lecc=Datos::vistaLeccionModel("leccion");
					$idLecc=$item2["idLeccion"];
					foreach($lecc as $row => $item3){
						$nomLecc=$item3["leccion"];
					}
				}
				foreach($prep as $row => $item3){
					$nomEjer=0;
					$ejer=Datos::vistaEjercicioModel("ejercicio");
					$idEjer=$item3["idEstado"];
					foreach($ejer as $row => $item3){
						$nomEjer=$item3["nombre"];
					}
				}
				foreach($test as $row => $item4){
					$fechaTest=$item4["fecha_realizacion"];
				}
				foreach($adap as $row => $item5){
					$fechaIni=$item5["fecha_inicio"];
					$fechaFin=$item5["fecha_fin"];
				}

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["fecha_inicio"].'</td>
					<td>'.$item["fecha_fin"].'</td>
					<td>'.$nomLecc.'</td>
					<td>'.$nomEjer.'</td>
					<td>'.$fechaIni.' / '.$fechaFin.'</td>
					<td>'.$fechaTest.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarPlan&codigo='.$item["id_planEntrenamiento"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los plan entrenamiento en un select
		public function vistaPlanEntreSelectController(){
			$respuesta = Datos::vistaPlanEntreModel("plan_entrenamiento");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_planEntrenamiento"];
				$e=$item["codigo"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		EJERCICIO
		---------------------------------------*/
		#REGISTRO DE EJERCICIO 
		#------------------------------------
		public function registroEjercicioController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"nom"=>$_POST["nombreRegistro"],
					"rep"=>$_POST["repeticionesRegistro"],
					"tiem"=>$_POST["tiempoRegistro"],
					"fechaR"=>$_POST["fechaRealRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroEjercicioModel($datosController, "ejercicio");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaEjercicioController(){

			$respuesta = Datos::vistaEjercicioModel("ejercicio");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;

				$est=Datos::vistaEstadoModel("estado");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["repeticiones"].'</td>
					<td>'.$item["tiempo"].'</td>
					<td>'.$item["fecha_realizacion"].'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarEjercicio&codigo='.$item["id_ejercicio"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los ejercicios en un select
		public function vistaEjercicioSelectController(){
			$respuesta = Datos::vistaEjercicioModel("ejercicio");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_ejercicio"];
				$e=$item["nombre"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		TEST
		---------------------------------------*/
		public function registroTestController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaR"=>$_POST["fechaRealRegistro"],
					"rut"=>$_POST["rutinaRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroTestModel($datosController, "test");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}

		public function vistaTestController(){

			$respuesta = Datos::vistaTestModel("test");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomRut=0;

				$est=Datos::vistaEstadoModel("estado");
				$rut=Datos::vistaRutinaModel("rutina");

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($rut as $row => $item2){
					$nomRut=$item2["recorrido"];
				}

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["fecha_realizacion"].'</td>
					<td>'.$nomRut.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarTest&codigo='.$item["id_test"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los test en un select
		public function vistaTestSelectController(){
			$respuesta = Datos::vistaTestModel("test");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_test"];
				$e=$item["codigo"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		PREPARACIÓN FISICA
		---------------------------------------*/
		public function registroPrepFisicaController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaI"=>$_POST["fechaInicioRegistro"],
					"fechaF"=>$_POST["fechaFinRegistro"],
					"ejer"=>$_POST["ejercicioRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroPrepFisicaModel($datosController, "preparacion_fisica");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaPrepFisicaController(){

			$respuesta = Datos::vistaPrepFisicaModel("preparacion_fisica");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomEjer=0;

				$est=Datos::vistaEstadoModel("estado");
				$ejer=Datos::vistaEjercicioModel("ejercicio");

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($ejer as $row => $item2){
					$nomEjer=$item2["nombre"];
				}

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["fecha_inicio"].'</td>
					<td>'.$item["fecha_fin"].'</td>
					<td>'.$nomEjer.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarPrepFisica&codigo='.$item["id_preparacionFisica"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		public function vistaPrepFisicaSelectController(){
			$respuesta = Datos::vistaPrepFisicaModel("preparacion_fisica");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_preparacionFisica"];
				$e=$item["codigo"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		RUTINA
		---------------------------------------*/
		public function registroRutinaController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"rec"=>$_POST["recorridoRegistro"],
					"terre"=>$_POST["terrenoRegistro"],
					"inte"=>$_POST["intensidadRegistro"],
					"tiemA"=>$_POST["tiempoAproximadoRegistro"],
					"tiemD"=>$_POST["tiempoDuracionRegistro"],
					"fechaR"=>$_POST["fechaRealRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroRutinaModel($datosController, "rutina");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaRutinaController(){

			$respuesta = Datos::vistaRutinaModel("rutina");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;

				$est=Datos::vistaEstadoModel("estado");
				

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["recorrido"].'</td>
					<td>'.$item["terreno"].'</td>
					<td>'.$item["intensidad"].'</td>
					<td>'.$item["tiempo_aprox"].'</td>
					<td>'.$item["tiempo_duracion"].'</td>
					<td>'.$item["fecha_realizacion"].'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarRutina&codigo='.$item["id_rutina"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los Rutina en un select
		public function vistaRutinaSelectController(){
			$respuesta = Datos::vistaRutinaModel("rutina");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_rutina"];
				$e=$item["recorrido"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		INTRODUCCION
		---------------------------------------*/
		public function registroIntroduccionController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaR"=>$_POST["fechaRealRegistro"],
					"lecc"=>$_POST["leccionRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroIntroduccionModel($datosController, "introduccion");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaIntroduccionController(){

			$respuesta = Datos::vistaIntroduccionModel("introduccion");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomLecc=0;

				$est=Datos::vistaEstadoModel("estado");
				$lecc=Datos::vistaLeccionModel("leccion");

				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($lecc as $row => $item2){
					$nomLecc=$item2["leccion"];
				}

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["fecha_realizacion"].'</td>
					<td>'.$nomLecc.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarIntroduccion&codigo='.$item["id_introduccion"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas los introduccion en un select
		public function vistaIntroduccionSelectController(){
			$respuesta = Datos::vistaIntroduccionModel("introduccion");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_introduccion"];
				$e=$item["codigo"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		LECCION
		---------------------------------------*/
		public function registroLeccionController(){

			if(isset($_POST["leccionRegistro"])){
				$datosController = array( 
					"lecc"=>$_POST["leccionRegistro"]);
				$respuesta = Datos::registroLeccionModel($datosController, "leccion");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaLeccionController(){

			$respuesta = Datos::vistaLeccionModel("leccion");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				

			echo'<tr>
					<td>'.$item["leccion"].'</td>
					<td><a href="index.php?action=editarLeccion&codigo='.$item["id_leccion"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		//mostrar todas las lecciones en un select
		public function vistaLeccionSelectController(){
			$respuesta = Datos::vistaLeccionModel("leccion");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_leccion"];
				$e=$item["leccion"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		EXAMEN MEDICO
		---------------------------------------*/
		public function registroExamenMedController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"med"=>$_POST["medicoRegistro"],
					"elec"=>$_POST["electroRegistro"],
					"lecc"=>$_POST["laboratorioRegistro"],
					"nut"=>$_POST["nutricionRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroExamenMedModel($datosController, "examenmedico");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaExamenMedicoController(){

			$respuesta = Datos::vistaExamenMedicoModel("examenmedico");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				$nomEst=0;
				$nomMed=0;
				$resElec=0;
				$resLab=0;
				$resNutr=0;

				$est=Datos::vistaEstadoModel("estado");
				$med=Datos::vistaMedicoModel("usuario");
				$ele=Datos::vistaElectrocardiogramaModel("electrocardiograma");
				$lab=Datos::vistaLaboratorioModel("laboratorio");
				$nut=Datos::vistaNutricionModel("nutricion");


				foreach($est as $row => $ite){
					$nomEst=$ite["estado"];
				}
				foreach($med as $row => $item2){
					$nomMed=$item2["nombre"];
				}
				foreach($ele as $row => $item3){
					$resEle=$item3["resultado"];
				}
				foreach($lab as $row => $item4){
					$resLab=$item4["resultado"];
				}
				foreach($nut as $row => $item5){
					$resNut=$item5["resultado"];
				}

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$nomMed.'</td>
					<td>'.$resEle.'</td>
					<td>'.$resLab.'</td>
					<td>'.$resNut.'</td>
					<td>'.$nomEst.'</td>
					<td><a href="index.php?action=editarExamen&codigo='.$item["id_examen"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}

		/*-------------------------------------
		ELECTROCARDIOGRAMA
		---------------------------------------*/

		public function vistaElectrocardiogramaController(){

			$respuesta = Datos::vistaElectrocardiogramaModel("electrocardiograma");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
				

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["resultado"].'</td>
					<td>'.$item["recomendaciones"].'</td>
					<td><a href="index.php?action=editarElectro&codigo='.$item["id_electro"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}
		#Muestra los electrocardiogramas en un select
		public function vistaElectroSelectController(){
			$respuesta = Datos::vistaElectroModel("electrocardiograma");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_electro"];
				$e=$item["resultado"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}

		/*-------------------------------------
		LABORATORIO
		---------------------------------------*/
		public function registroLaboratorioController(){

			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"res"=>$_POST["resultadoRegistro"],
					"rec"=>$_POST["recomendacionesRegistro"]);
				$respuesta = Datos::registroLaboratorioModel($datosController, "laboratorio");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}
		public function vistaLaboratorioController(){

			$respuesta = Datos::vistaLaboratorioModel("laboratorio");

			
			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
					

			echo'<tr>
					<td>'.$item["codigo"].'</td>
					<td>'.$item["resultado"].'</td>
					<td>'.$item["recomendaciones"].'</td>
					<td><a href="index.php?action=editarLaboratorio&codigo='.$item["id_laboratorio"].'"><button class="btn btn-success">Editar</button></a> </td>	
					</tr>';
					

			}

		}
		//mostrar todas los laboratorios en un select
		public function vistaLaboratorioSelectController(){
			$respuesta = Datos::vistaLaboratorioModel("laboratorio");
			$a="";

		
			foreach($respuesta as $row => $item){
				$id=$item["id_laboratorio"];
				$e=$item["resultado"];

			
			echo'<option value='.$id.'>'.$e.'</option>';
		

			}
		}
	
		/*-------------------------------------
		NUTRICION
		---------------------------------------*/
		public function registroNutricionController(){
			
			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"res"=>$_POST["resultadoRegistro"],
					"rec"=>$_POST["recomendacionesRegistro"]);
				$respuesta = Datos::registroNutricionModel($datosController, "nutricion");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}

	public function vistaNutricionController(){

		$respuesta = Datos::vistaNutricionModel("nutricion");

		
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			

		echo'<tr>
				<td>'.$item["codigo"].'</td>
				<td>'.$item["resultado"].'</td>
				<td>'.$item["recomendaciones"].'</td>
				<td><a href="index.php?action=editarNutricion&codigo='.$item["id_nutricion"].'"><button class="btn btn-success">Editar</button></a> </td>	
				</tr>';
				

		}

	}

	//mostrar todos los campos de nutricion en un select
	public function vistaNutricionSelectController(){
		$respuesta = Datos::vistaNutricionModel("nutricion");
		$a="";

	
		foreach($respuesta as $row => $item){
			$id=$item["id_nutricion"];
			$e=$item["resultado"];

		
		echo'<option value='.$id.'>'.$e.'</option>';
	

		}
	}

	/*-------------------------------------
		CLAUSULA
	---------------------------------------*/
	public function registroClausulaController(){
			
		if(isset($_POST["acuerdoRegistro"])){
			$datosController = array( 
				"acu"=>$_POST["acuerdoRegistro"],
				"est"=>$_POST["estadoRegistro"]);
			$respuesta = Datos::registroClausulaModel($datosController, "clausula");

			if($respuesta == "success"){

				echo "Registro Exitoso";

				
			}	
			else{	
				header("location:index.php");
			}

		}

	}

public function vistaClausulaController(){

	$respuesta = Datos::vistaClausulaModel("clausula");

	
	#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

	foreach($respuesta as $row => $item){
		$nomEst=0;
		$est= Datos::vistaEstadoModel("estado");
		foreach($est as $row => $ite){
			$nomEst=$ite["estado"];
		}
	echo'<tr>
			<td>'.$item["acuerdo"].'</td>
			<td>'.$nomEst.'</td>
			<td><a href="index.php?action=editarClausula&codigo='.$item["id_clausula"].'"><button class="btn btn-success">Editar</button></a> </td>	
			</tr>';
			

	}

}

//mostrar todos los campos de clausulas en un select
public function vistaClausulasSelectController(){
	$respuesta = Datos::vistaClausulaModel("clausula");
	$a="";


	foreach($respuesta as $row => $item){
		$id=$item["id_clausula"];
		$e=$item["acuerdo"];

	
	echo'<option value='.$id.'>'.$e.'</option>';


	}
}

	/*-------------------------------------
		CONTRATO
	---------------------------------------*/
		public function registroContratoController(){
			
			if(isset($_POST["codigoRegistro"])){
				$datosController = array( 
					"cod"=>$_POST["codigoRegistro"],
					"fechaI"=>$_POST["fechaInicioRegistro"],
					"fechaF"=>$_POST["fechaFinRegistro"],
					"repre"=>$_POST["repreRegistro"],
					"dep"=>$_POST["deportistaRegistro"],
					"clau"=>$_POST["clausulaRegistro"],
					"est"=>$_POST["estadoRegistro"]);
				$respuesta = Datos::registroContratoModel($datosController, "contrato");
	
				if($respuesta == "success"){
	
					echo "Registro Exitoso";
	
					
				}	
				else{	
					header("location:index.php");
				}
	
			}
	
		}

	public function vistaContratoController(){

		$respuesta = Datos::vistaContratoModel("contrato");

		
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			$nomEst=0;
			$repre=0;
			$depo=0;
			$clau=0;
			$est=Datos::vistaEstadoModel("estado");
			$rep=Datos::vistaRepreLegalModel("usuario");
			$dep=Datos::vistaDeportistaModel("usuario");
			$claus=Datos::vistaClausulaModel("clausula");
			foreach($est as $row => $ite){
				$nomEst=$ite["estado"];
			}
			foreach($rep as $row => $item2){
				$repre=$item2["nombre"];
			}
			foreach($dep as $row => $item3){
				$depo=$item3["nombre"];
			}
			foreach($claus as $row => $item4){
				$clau=$item4["acuerdo"];
			}
		echo'<tr>
				<td>'.$item["codigo"].'</td>
				<td>'.$item["fechaInicio"].'</td>
				<td>'.$item["fechaFin"].'</td>
				<td>'.$repre.'</td>
				<td>'.$depo.'</td>
				<td>'.$clau.'</td>
				<td>'.$nomEst.'</td>				
				<td><a href="index.php?action=editarContrato&codigo='.$item["id_contrato"].'"><button class="btn btn-success">Editar</button></a> </td>	
				</tr>';
				

		}

	}

	/*-------------------------------------
		INFORMES
	---------------------------------------*/
	public function generarInformeController(){
		if(isset($_POST["mesReporte"])){
			$datosController = array( 
				"mes"=>$_POST["mesReporte"]);
			$respuesta = Datos::vistaReportesModel($datosController);

			if($respuesta == "success"){

				echo "Informe Exitoso";

				
			}

		}
	}
}
?>