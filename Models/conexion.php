<?php

class Conexion{

	/*public static function conectar(){
		$link = new PDO('mysql:host=localhost;dbname=db_tienda','root', 'root');
		return $link;
	}*/

	static function conectar(){
		$mysqli = null;
		$mysqli = new mysqli('localhost', 'root', 'root', 'db_tienda');
		if($mysqli -> connect_error){
			die('Connect Error('.$mysqli->connect_errno.')'.$mysqli->connect_error);

		}
		return $mysqli;
	}

	static function ejecutarSQL($conexion, $sql){
		$result_query = $conexion->query($sql);
		return $result_query;
	}
	

}

?>

