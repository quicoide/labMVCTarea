<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/

/*
 * Clase Manufacturer.
 * Atributos: id,name,code.
 */
class Manufacturer
{
    //Campos de la tabla
    private $id;
    private $name;
    private $code;
    private $dbConnection;


    // Constructor para asignar los valores por default.
    function __construct($consetup)
    {
        $this->id=0;
        $this->code="";
        $this->name="";
        $this->dbConnection = new dbConn($consetup);
    }
    /*
     * Método Mágico para asignación de las variables.
     */
    public function __set($name, $value)
    {
       $this->$name = $value;
    }
    /*
     * Método Mágico para obtener las variables.
     */
    public function __get($name)
    {
            return $this->$name;
    }


    /*
     * Función retireveRecords la cual no requiere parametro y obtiene todos los datos de la table a buscar,
     * en este caso la tabla manufacturers.
     */
    public function retrieveRecords()
    {
        try
        {
            $resultArray= array();
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare("SELECT * FROM manufacturers");
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query.
            $res=$query->get_result();
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el resultado.
            while($row = $res->fetch_assoc()){
                $resultArray[]=$row;
            }
            return $resultArray;

        }
        catch(Exception $e)
        {
            //En caso de exceptión se cierra la conexion.
            $this->close_db();
            //Se arroja el error de la excepción.
            throw $e;
        }

    }
}

?>