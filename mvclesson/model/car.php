<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/

class Car
{
    // Campos de la tabla.
    protected  $id;
    protected  $name;
    protected  $version;
    protected  $year;
    protected  $manufacturer_id;
    protected  $manufacturer_name;
    private $dbConnection;


    // Constructor para asignar los valores por default.
    function __construct($consetup)
    {
        $this->id=0;
        $this->version="";
        $this->name="";
        $this->year="";
        $this->manufacturer_name="";
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
    * Función retrieveRecord
    * Función que se encarga de obtener un `registro en especifico basado en su id.
    * Parametro $id
    */
    public function retrieveRecord($id)
    {

        try
        {
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare("SELECT * FROM cars WHERE id=?");
            //Se sustituyen las variables en el query.
            $query->bind_param("i",$id);
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query.
            $res=$query->get_result();
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el resultado.
            return $res;

        }
        catch(Exception $e)
        {
            $this->close_db();
            throw $e;
        }

    }

    /*
    * Función retrieveRecords
    * Función que se encarga de obtener los registros de la tabla Cars.
    * En este caso no se regresan todos los registros si no unos cuantos para la páginación de la página.
    * Parametro $page
    */
    public function retrieveRecords($page)
    {
        $resultArray = array();
        /*
         * Se calcula el valor del offset.
         */
        $rowsPage = (($page-1)*25);
        try
        {
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare(
                "SELECT cars.id,cars.name,cars.type,cars.year,manufacturers.name as 'manufacturerName' 
                        FROM cars INNER JOIN manufacturers WHERE cars.manufacturer_id = manufacturers.id LIMIT ? , 25 ");
            //Se sustituyen las variables en el query.
            $query->bind_param("i",$rowsPage);
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
            $this->close_db();
            throw $e;
        }

    }
    /*
     * Funcion totalRows
     *  Función que se encarga únicamente de regresar la cantidad de registros totales se cuenta en la tabla cars.
     */
    public function totalRows(){
        try {
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query = $dbConnect->prepare("SELECT * FROM cars ");
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query.
            $res = $query->get_result();
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el numero de registros.
            return $res->num_rows;
        }
        catch (Exception $e){
            $this->close_db();
            throw $e;
        }
    }
    /*
     * Función deleteRecord
     * Función que se encarga de eliminar el registro en base al id.
     * param: $id
     */
    public function deleteRecord($id)
    {
        try{
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare("DELETE FROM cars WHERE id=?");
            $query->bind_param("i",$id);
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query
            $res=$query->get_result();
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el resultado.
            return true;
        }
        catch (Exception $e)
        {
            $this->dbConnection->close_db();
            throw $e;
        }
    }

    /*
    * Función updateRecord
    * Función que se encarga de actualizar el registro en base al id.
    * param: $obj (arreglo con nuevos valores).
    */
    public function updateRecord($obj)
    {
        try
        {
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare("UPDATE cars SET type=?,name=?,year=?,manufacturer_id=? WHERE id=?");
            $query->bind_param("ssiii", $obj->type,$obj->name,$obj->year,$obj->manufacturer_id,$obj->id);
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query.
            $res=$query->get_result();
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el resultado.
            return true;
        }
        catch (Exception $e)
        {
            $this->dbConnection->close_db();
            throw $e;
        }
    }
    /*
     * Función insertRecord
     * Función que se encarga de insertar un nuevo el registro en base al id.
     * param: $obj (arreglo con nuevos valores).
     */
    public function insertRecord($obj)
    {
        try
        {
            //Se abre la conexión a la base de datos.
            $dbConnect = $this->dbConnection->open_db();
            //Se prepara el query a ejecutar.
            $query=$dbConnect->prepare("INSERT INTO cars (type,name,year,manufacturer_id) VALUES (?, ?,?,?)");
            $query->bind_param("ssii",$obj->type,$obj->name,$obj->year,$obj->manufacturer_id);
            //Se ejecuta el query.
            $query->execute();
            //Se obtiene los resultados del query.
            $res= $query->get_result();
            $last_id=$dbConnect->insert_id;
            //Se cierra la conexión a la base de datos.
            $this->dbConnection->close_db();
            //Se regresa el resultado.
            return $last_id;
        }
        catch (Exception $e)
        {
            $this->dbConnection->close_db();
            throw $e;
        }
    }
}
?>