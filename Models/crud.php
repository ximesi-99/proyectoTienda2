<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";

class Datos extends Conexion{

	/*-------------------------------------
		LOGIN
	---------------------------------------*/
    #Validación Login   
    public function validarLoginModel($datosModel,$tabla){
	   $msg="";
	   if($stmt = Conexion::conectar()->prepare("SELECT usuario,password FROM users WHERE username=:usu AND password=:pss")) 
	   
	   $stmt->bindValue(":usu", $datosModel["usu"], PDO::PARAM_STR);
	   $stmt->bindValue(":pss", $datosModel["pss"], PDO::PARAM_STR);
	   $stmt->execute();

	   $count = $stmt->rowCount();
	   $row   = $stmt->fetch(PDO::FETCH_ASSOC);
	   if($count == 1 && !empty(row)){
		   $usu = $row['idTipoUsuario'];

		   if ($usu == 1) {
			   header("Location: Views/template.php");
		   }
		   else if ($usu == 2) {
			header("Location: Views/templateTec.php");
		   }
		   else if ($usu == 3) {
			header("Location: Views/templateDep.php");
		   }
		   else if ($usu == 4) {
			header("Location: Views/templateRepre.php");
		   }
		   else if ($usu == 5) {
			header("Location: Views/templateMed.php");
		   }

	   }else{
		   $msg = "Datos erroneos";
	   }

	}

	/*-------------------------------------
		TECNICOS
	---------------------------------------*/
    #Registro Técnicos
    public function registroTecnicoModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cedula,nombre,apellido,usuario,password,edad,sexo,telefono,profesion,idTipoUsuario,idEstado,idPlanEntrenamiento) 
															VALUES (:ced,:nom,:apl,:usu,:pss,:edad,:sex,:tel,:prof,2,:est,:entre)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		#$stmt->bindParam(":null", $datosModel["id_tecnico"], PDO::PARAM_STR);
		$stmt->bindParam(":ced", $datosModel["ced"], PDO::PARAM_STR);
		$stmt->bindParam(":nom", $datosModel["nom"], PDO::PARAM_STR);
		$stmt->bindParam(":apl", $datosModel["apl"], PDO::PARAM_STR);
		$stmt->bindParam(":usu", $datosModel["usu"], PDO::PARAM_STR);
		$stmt->bindParam(":pss", $datosModel["pss"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sex", $datosModel["sex"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["tel"], PDO::PARAM_STR);
		$stmt->bindParam(":prof", $datosModel["prof"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
		$stmt->bindParam(":entre", $datosModel["entre"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}

	#Vista tecnico
	public function vistaTecnicoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,edad,sexo,telefono,profesion,idTipoUsuario,idEstado, idPlanEntrenamiento FROM $tabla WHERE idTipoUsuario=2");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDITAR TECNICO
	#-------------------------------------

	public function editarTecnicoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,password,edad,sexo,telefono,profesion,cargo,idEstado,idPlanEntrenamiento FROM $tabla WHERE id_usuario = :idUsu");
		$stmt->bindParam(":idUsu", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	public function actualizarTecniModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  cedula = :ced, nom = :apell, usuario = :usu, password = :pss,edad=:edad, sexo=:sexo, telefono=:tel, profesion=:prof WHERE id_usuario = :idUsu");

		$stmt->bindParam(":ced", $datosModel["cedula"], PDO::PARAM_INT);
		$stmt->bindParam(":nom", $datosModel["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apell", $datosModel["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":usu", $datosModel["usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":pss", $datosModel["password"], PDO::PARAM_BOOL);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datosModel["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":prof", $datosModel["profesion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	/*-------------------------------------
		ESTADO
	---------------------------------------*/
	#Vista estados
	public function vistaEstadoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_estado,estado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		DEPORTISTA
	---------------------------------------*/
	#Registro Deportista
    public function registroDeportistaModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cedula,nombre,apellido,usuario,password,edad,sexo,telefono,estatura,peso,objetivoPreparacion,idTipoUsuario,idEstado,idUsuario,idBicicleta,idPlanEntrenamiento)
															VALUES (:ced,:nom,:apl,:usu,:pss,:edad,:sex,:tel,:estatu,:peso,:objP,3,:est,:tec,:bici,:plaE)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":ced", $datosModel["ced"], PDO::PARAM_STR);
		$stmt->bindParam(":nom", $datosModel["nom"], PDO::PARAM_STR);
		$stmt->bindParam(":apl", $datosModel["apl"], PDO::PARAM_STR);
		$stmt->bindParam(":usu", $datosModel["usu"], PDO::PARAM_STR);
		$stmt->bindParam(":pss", $datosModel["pss"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sex", $datosModel["sex"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["tel"], PDO::PARAM_STR);
		$stmt->bindParam(":estatu", $datosModel["estatu"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datosModel["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":objP", $datosModel["objP"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
		$stmt->bindParam(":tec", $datosModel["tec"], PDO::PARAM_STR);
		$stmt->bindParam(":bici", $datosModel["bici"], PDO::PARAM_STR);
		$stmt->bindParam(":plaE", $datosModel["plaE"], PDO::PARAM_STR);
				
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista deportista
	public function vistaDeportistaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,edad,sexo,telefono,estatura,peso,objetivoPreparacion,idEstado,idUsuario,idBicicleta,idPlanEntrenamiento FROM $tabla WHERE idTipoUsuario=3");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDITAR DEPORTISTA
	#-------------------------------------

	public function editarDepModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,edad,sexo,telefono,estatura,peso,objetivoPreparacion,idEstado,idUsuario,idBicicleta,idPlanEntrenamiento FROM $tabla WHERE id_usuario = :idUsu");
		$stmt->bindParam(":idUsu", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	public function actualizarDepxModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  cedula = :ced, nom = :apell, usuario = :usu, password = :pss,edad=:edad, sexo=:sexo, telefono=:tel, profesion=:prof WHERE id_usuario = :idUsu");

		$stmt->bindParam(":ced", $datosModel["cedula"], PDO::PARAM_INT);
		$stmt->bindParam(":nom", $datosModel["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apell", $datosModel["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":usu", $datosModel["usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":pss", $datosModel["password"], PDO::PARAM_BOOL);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datosModel["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":esta", $datosModel["estatura"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datosModel["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":obj", $datosModel["objetivoPreparacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	/*-------------------------------------
		MEDICO
	---------------------------------------*/
	#Registro Deportista
    public function registroMedicoModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cedula,nombre,apellido,usuario,password,edad,sexo,telefono,especialidad,idTipoUsuario,idEstado)
															VALUES (:ced,:nom,:apl,:usu,:pss,:edad,:sex,:tel,:esp,5,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		#$stmt->bindParam(":null", $datosModel["id_deportista"], PDO::PARAM_STR);
		$stmt->bindParam(":ced", $datosModel["ced"], PDO::PARAM_STR);
		$stmt->bindParam(":nom", $datosModel["nom"], PDO::PARAM_STR);
		$stmt->bindParam(":apl", $datosModel["apl"], PDO::PARAM_STR);
		$stmt->bindParam(":usu", $datosModel["usu"], PDO::PARAM_STR);
		$stmt->bindParam(":pss", $datosModel["pss"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sex", $datosModel["sex"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["tel"], PDO::PARAM_STR);
		$stmt->bindParam(":esp", $datosModel["esp"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
				
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista medico
	public function vistaMedicoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,edad,sexo,telefono,especialidad,idEstado FROM $tabla WHERE idTipoUsuario=5");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		REPRESENTANTE LEGAL
	---------------------------------------*/
	#Registro representante legal
    public function registroRepreLegalModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cedula,nombre,apellido,usuario,password,edad,sexo,telefono,profesion,idTipoUsuario,idEstado)
															VALUES (:ced,:nom,:apl,:usu,:pss,:edad,:sex,:tel,:prof,4,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		#$stmt->bindParam(":null", $datosModel["id_deportista"], PDO::PARAM_STR);
		$stmt->bindParam(":ced", $datosModel["ced"], PDO::PARAM_STR);
		$stmt->bindParam(":nom", $datosModel["nom"], PDO::PARAM_STR);
		$stmt->bindParam(":apl", $datosModel["apl"], PDO::PARAM_STR);
		$stmt->bindParam(":usu", $datosModel["usu"], PDO::PARAM_STR);
		$stmt->bindParam(":pss", $datosModel["pss"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":sex", $datosModel["sex"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel["tel"], PDO::PARAM_STR);
		$stmt->bindParam(":prof", $datosModel["prof"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
				
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista representante legal
	public function vistaRepreLegalModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario,cedula,nombre,apellido,usuario,edad,sexo,telefono,profesion,idEstado FROM $tabla WHERE idTipoUsuario=4");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		BICICLETA
	---------------------------------------*/
	#Registro bicicleta
    public function registroBicicletaModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (marca,modelo,talla,peso,grupo,idEstado)
															VALUES (:mar,:mod,:tall,:peso,:grup,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":mar", $datosModel["mar"], PDO::PARAM_STR);
		$stmt->bindParam(":mod", $datosModel["mod"], PDO::PARAM_STR);
		$stmt->bindParam(":tall", $datosModel["tall"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datosModel["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":grup", $datosModel["grup"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
				
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista bicicleta
	public function vistaBicicletaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_bicicleta,marca,modelo,talla,peso,grupo,idEstado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		ADAPTACION BICICLETA
	---------------------------------------*/
	#Registro adaptacion bicicleta
    public function registroAdapBiciModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fecha_inicio,fecha_fin,idEstado,idRutina)
															VALUES (:cod,:fechaI,:fechaF,:rut,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaI", $datosModel["fechaI"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaF", $datosModel["fechaF"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datosModel["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
						
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista adaptacion bicicleta
	public function vistaAdapBicicletaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_adaptacionBici,codigo,fecha_inicio,fecha_fin,idEstado, idRutina FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		PLAN ENTRENAMIENTO
	--------------------------------------*/
	#Registro plan entrenamiento
    public function registroPlanEntreModel($datosModel, $tabla){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fecha_inicio,fecha_fin,idEstado,idIntroduccion,idPreFisica,idAdaBici,idTest)
															VALUES (:cod,:fechaI,:fechaF,:intr,:preF,:adap,:test,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaI", $datosModel["fechaI"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaF", $datosModel["fechaF"], PDO::PARAM_STR);
		$stmt->bindParam(":intr", $datosModel["intr"], PDO::PARAM_STR);
		$stmt->bindParam(":preF", $datosModel["preF"], PDO::PARAM_STR);
		$stmt->bindParam(":adap", $datosModel["adap"], PDO::PARAM_STR);
		$stmt->bindParam(":test", $datosModel["test"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
						
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista plan entrenamiento
	public function vistaPlanEntreModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_planEntrenamiento,codigo,fecha_inicio,fecha_fin,idEstado, idIntroduccion, idPreFisica, idAdaBici, idTest FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#Vista nombre plan entrenamiento
	public function vistaNomPlanEntreModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_planEntrenamiento,estado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	

	/*-------------------------------------
		EJERCICIO
	---------------------------------------*/
		#Registro Ejercicio
		public function registroEjercicioModel($datosModel, $tabla){
			#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
	
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,nombre,repeticiones,tiempo,fecha_realizacion,idEstado)
																VALUES (:cod,:nom,:rep,:tiem,:fechaR,:est)");	
	
			#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
			$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
			$stmt->bindParam(":nom", $datosModel["nom"], PDO::PARAM_STR);
			$stmt->bindParam(":rep", $datosModel["rep"], PDO::PARAM_STR);
			$stmt->bindParam(":tiem", $datosModel["tiem"], PDO::PARAM_STR);
			$stmt->bindParam(":fechaR", $datosModel["fechaR"], PDO::PARAM_STR);
			$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
							
			if($stmt->execute()){
				return "success";
			}
			else{
				return "error";
			}
	
			$stmt->close();
	
		}
	#Vista ejercicio
	public function vistaEjercicioModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_ejercicio,codigo,nombre,repeticiones,tiempo,fecha_realizacion,idEstado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		TEST
	---------------------------------------*/
	#Registro Test
	public function registroTestModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fecha_realizacion,idEstado,idRutina)
															VALUES (:cod,:fechaR,:est,:rut)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaR", $datosModel["fechaR"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datosModel["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista test
	public function vistaTestModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_test,codigo,fecha_realizacion,idEstado,idRutina FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		PREPARACION FISICA
	---------------------------------------*/
	#Registro preparacion fisica
	public function registroPrepFisicaModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fecha_inicio,fecha_fin,idEstado,idEjercicio)
															VALUES (:cod,:fechaI,:fechaF,:est,:ejer)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaI", $datosModel["fechaI"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaF", $datosModel["fechaF"], PDO::PARAM_STR);
		$stmt->bindParam(":ejer", $datosModel["ejer"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista preparacion fisica
	public function vistaPrepFisicaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_preparacionFisica,codigo,fecha_inicio,fecha_fin,idEstado,idEjercicio FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		RUTINA
	---------------------------------------*/
	public function registroRutinaModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,recorrido,terreno,intensidad,tiempo_aprox,tiempo_duracion,fecha_realizacion,idEstado)
															VALUES (:cod,:rec,:terre,:inte,:tiemA,:tiemD,:fechaR,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":rec", $datosModel["rec"], PDO::PARAM_STR);
		$stmt->bindParam(":terre", $datosModel["terre"], PDO::PARAM_STR);
		$stmt->bindParam(":inte", $datosModel["inte"], PDO::PARAM_STR);
		$stmt->bindParam(":tiemA", $datosModel["tiemA"], PDO::PARAM_STR);
		$stmt->bindParam(":tiemD", $datosModel["tiemD"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaR", $datosModel["fechaR"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista rutina
	public function vistaRutinaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_rutina,codigo,recorrido,terreno,intensidad,tiempo_aprox,tiempo_duracion,fecha_realizacion,idEstado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		INTRODUCCION
	---------------------------------------*/
	public function registroIntroduccionModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fecha_realizacion,idEstado,idLeccion)
															VALUES (:cod,:fechaR,:est,:lecc)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaR", $datosModel["fechaR"], PDO::PARAM_STR);
		$stmt->bindParam(":lecc", $datosModel["lecc"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista introduccion
	public function vistaIntroduccionModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_introduccion,codigo,fecha_realizacion,idEstado,idLeccion FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		LECCION
	---------------------------------------*/
	public function registroLeccionModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (leccion)
															VALUES (:lecc)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":lecc", $datosModel["lecc"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista leccion
	public function vistaLeccionModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_leccion,leccion FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		EXAMEN MEDICO
	---------------------------------------*/
	public function registroExamenMedModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,idEstado,idUsuario,idElectrocardiograma,idLaboratorio,idNutricion)
															VALUES (:cod,:est,:med,:elec,:lab,:nut)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
		$stmt->bindParam(":med", $datosModel["med"], PDO::PARAM_STR);
		$stmt->bindParam(":elec", $datosModel["elec"], PDO::PARAM_STR);
		$stmt->bindParam(":lab", $datosModel["lab"], PDO::PARAM_STR);
		$stmt->bindParam(":nut", $datosModel["nut"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista examen medico
	public function vistaExamenMedicoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_examen,idEstado,codigo,idUsuario,idElectrocardiograma,idLaboratorio,idNutricion FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		ELECTROCARDIOGRAMA
	---------------------------------------*/
	#Vista electrocardiograma
	public function vistaElectrocardiogramaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_electro,codigo,resultado,recomendaciones FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		LABORATORIO
	---------------------------------------*/
	public function registroLaboratorioModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,resultado,recomendaciones)
															VALUES (:cod,:res,:rec)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":res", $datosModel["res"], PDO::PARAM_STR);
		$stmt->bindParam(":rec", $datosModel["rec"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}
	#Vista laboratorio
	public function vistaLaboratorioModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_laboratorio,codigo,resultado,recomendaciones FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		NUTRICION
	---------------------------------------*/
	public function registroNutricionModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,resultado,recomendaciones)
															VALUES (:cod,:res,:rec)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":res", $datosModel["res"], PDO::PARAM_STR);
		$stmt->bindParam(":rec", $datosModel["rec"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}

	#Vista nutricion
	public function vistaNutricionModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_nutricion,codigo,resultado,recomendaciones FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		CLAUSULA
	---------------------------------------*/
	public function registroClausulaModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (acuerdo,idEstado)
															VALUES (:acu,:est)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":acu", $datosModel["acu"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}

	#Vista clausula
	public function vistaClausulaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_clausula,acuerdo,idEstado FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		CONTRATO
	---------------------------------------*/
	public function registroContratoModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,fechaInicio,fechaFin,idEstado,idUsuarioRepre,idUsuarioDep,idClausula)
															VALUES (:cod,:fechaI,:fechaF,:est,:repre,:dep,:clau)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":cod", $datosModel["cod"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaI", $datosModel["fechaI"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaF", $datosModel["fechaF"], PDO::PARAM_STR);
		$stmt->bindParam(":est", $datosModel["est"], PDO::PARAM_STR);
		$stmt->bindParam(":repre", $datosModel["repre"], PDO::PARAM_STR);
		$stmt->bindParam(":dep", $datosModel["dep"], PDO::PARAM_STR);
		$stmt->bindParam(":clau", $datosModel["clau"], PDO::PARAM_STR);
								
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();

	}

	#Vista contrato
	public function vistaContratoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_contrato,codigo,fechaInicio,fechaFin,idEstado,idUsuarioRepre,idUsuarioDep,idClausula FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	/*-------------------------------------
		REPORTES
	---------------------------------------*/
	public function vistaReportesModel($mes){

		include 'Controllers/plantilla.php';

		$stmt = Conexion::conectar()->prepare("SELECT p.fecha_inicio, p.fecha_fin, e.estado, d.id_deportista, d.nombre, d.apellido, d.obetivo_preparacion 
		FROM deportista AS d INNER JOIN estado AS e ON d.idEstado = e.id_estado 
		INNER JOIN plan_entrenamiento AS p ON d.idPlanEntrenamiento = p.id_planEntrenamiento WHERE MONTH(p.fecha_fin) = :mes");
		$stmt->bindParam(":mes", $mes["mes"], PDO::PARAM_STR);
		$stmt->execute();
	
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
	
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(70,6,'NOMBRE',1,0,'C',1);
		$pdf->Cell(70,6,'APELLIDO',1,0,'C',1);
		$pdf->Cell(20,6,'OBJETIVO PREPARACION',1,0,'C',1);
		$pdf->Cell(70,6,'TECNICO',1,0,'C',1);
		$pdf->Cell(70,6,'FECHA INICIO PLAN ENTRENAMIENTO',1,1,'C',1);
		$pdf->Cell(70,6,'ESTADO',1,1,'C',1);
	
		$pdf->SetFont('Arial','',10);
	/*
		while($row = $stmt->fetch_assoc())
		{
			$pdf->Cell(70,6,utf8_decode($row['nombre']),1,0,'C');
			$pdf->Cell(20,6,$row['apellido'],1,0,'C');
			$pdf->Cell(70,6,utf8_decode($row['obetivo_preparacion']),1,1,'C');
			$pdf->Cell(70,6,utf8_decode($row['idEstado']),1,1,'C');
			$pdf->Cell(70,6,utf8_decode($row['idPlanEntrenamiento']),1,1,'C');
		}
			$pdf->Output("reporte.pdf","F");*/
	}
}
?>