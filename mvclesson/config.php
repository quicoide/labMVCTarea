<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/
//Clase para configurar la información de la Base de Datos
class config  
{

	function __construct() {
		$this->host = "localhost";
		$this->user  = "root";
		$this->pass = "adminpass";
		$this->db = "phpmvctarea";
	}
}

?>