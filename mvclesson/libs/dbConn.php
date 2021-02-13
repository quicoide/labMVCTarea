<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/
	class dbConn
	{
	    //Declaracion de parametros.
	    private $host,$user,$pass,$db;

		// Asignación de variables en base a la configuración de la Base de datos.
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;
		}

		// Se abre la conexion a la base de datos.
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
			return $this->condb;
		}
		// Se cierra la conexion a la base de datos.
		public function close_db()
		{
			$this->condb->close();
		}	


	}

?>