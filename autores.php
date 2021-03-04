<?php


/**
* funcion get_libros.
*
* @param conexión con la base de datos, al detectar que esta accionado "q" empieza la conexion y realiza la setencia.
*
* @return retorna los datos de la sentencia y los muestra en pantalla.
*/
function get_libros(){
	$salida = "";

	if (isset($_GET["q"])){
	$nombre = $_GET["q"];

	$mysqli = new mysqli("localhost", "id16085474_jjtrigo", "!BRaJ4pWfAp7N3WA", "id16085474_libros");
	if (!$mysqli->connect_error){
	$mysqli->set_charset("utf8");

	$sql ="SELECT libro.titulo,autor.nombre, autor.apellidos FROM libro join autor on libro.id_autor=autor.id WHERE nombre LIKE '%$nombre%' ORDER BY nombre";

	if (($resultado = $mysqli->query($sql)) && (!$mysqli->error)){

		while ($fila = $resultado->fetch_assoc()){
		//Procesar result set como asociativo
			$salida = $salida . "<br/>" . " Nombre :" . "  " . $fila["nombre"] . " / ";
			$salida = $salida . " Apellidos : " . "  " . $fila["apellidos"] . " / ";
			$salida = $salida . " Titulo del libro : " . "  " . $fila["titulo"]  . "<br/>";
		}

		$resultado->free();
		$mysqli->close();
		//echo json_encode($final);
	}
	}	

	}
		echo $salida;
}

	$posibles_URL = array("get_libros");
	$valor = "Ha ocurrido un error";

	if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
	{
	  switch ($_GET["action"])
		{
		  case "get_libros":
			$valor = get_libros();
			break;
			
		}
	}

?>
