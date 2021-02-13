<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/

    require_once "libs/dbConn.php";
    require_once 'model/car.php';
    require_once 'model/manufacturer.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    /*
     * Controlador carsController
     */
	class carsController
	{
	    /*
	     * Función que se ejecuta al crear la clase.
	     */
 		function __construct() 
		{          
			$this->objconfig = new config();
            $this->carModel =  new car($this->objconfig);
            $this->manufacturerModel = new manufacturer($this->objconfig);
		}

		/*
		 * Función mvcHandler
		 * Función que se encarga de rutear la pagina de acuerdo al parametro GET "act".
		 *
		 */
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;
                case 'form':
                    $this-> form();
                    break;
				default:
                    $this->listCars();
                    break;
			}
		}		
        /*
         * Función pageRedirect
         * Función con el propósito de redirigir la página.
         */
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        /*
         * Función listCars
         * Función que es llamada en caso que el parametro 'act' este vacío. Se encarga de traer los registros de la tabla
         * para desplegarlos
         */
        public function listCars(){
            //Se valida el numero de la página.
 		    $page = isset($_GET['pageNumber']) ? $_GET['pageNumber']:1;
 		    //Se llama la funcion retrieveRecords del modelo de carro.
            $result=$this->carModel->retrieveRecords($page);
            //Se calcula el total de páginas.
            $pageTotal = ceil($this->carModel->totalRows()/25);
            //Se llama la página list.php para desplegar la información.
            require_once "view/list.php";
        }
        /*
         * Función form
         * Función que es llamada en caso que el valor del parametro 'act' sea form.
         * Se encarga de traer de mandar a llamar al formulario para agregar o modificar un registro.
         */
        public function form()
        {
            //Declaración de variables.
            $carId = '';
            $carType = '';
            $carName = '';
            $carYear = '';
            $carManufacturer='';
            //Se obtienen la información de todos los fabricantes de automoviles.
            $resultManufacturer = $this->manufacturerModel->retrieveRecords();
            //Se valida si es un nuevo registro o un registro viejo para modificar.
            if (isset($_GET['id']))
            {
                //Caso del registro sea viejo y se modifique.
                //Se guarda el id del carro.
                $id_car = $_GET['id'];
                //Se obtiene la información del carro a modificar.
                $result = $this->carModel->retrieveRecord($_GET['id']);
                //Se obtiene la información del registro en el arreglo row.
                $row = mysqli_fetch_array($result);
                //Asignacion de datos.
                $carId = $row['id'];
                $carType = $row['type'];
                $carName = $row['name'];
                $carYear = $row['year'];
                $carManufacturer = $row['manufacturer_id'];
            } else{
                //Se asigna id_car como nulo.
                $id_car = null;
            }
            //Se llama la página list.php para desplegar el formulario.
            require_once "view/form.php";

        }
        /*
         * Función delete
         * Función que es llamada en caso que el valor del parametro 'act' sea delete.
         * Se encarga de eliminar el registro solicitado.
         */
        public function delete()
        {
            try
            {
                if (isset($_GET['id']))
                {
                    //Se llama la función deleteRecord para borrar el registro.
                    $res=$this->carModel->deleteRecord($_GET['id']);
                    //Se valida si fue exitosa la petición.
                    if($res){
                        //Si es exitosa, se redirige a la página del index.
                        $this->pageRedirect('index.php?pageNumber='.$_GET['pageNumber']);
                    }else{
                        //Si fallo se despliega el siguiente mensaje.
                        echo "Algo salio mal, volver a intentar.";
                    }
                }else{
                    //Si el id falta, desplegará la siguiente información.
                    echo "Operación Inválida.";
                }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }
        /*
         * Función insert
         * Función que es llamada en caso que el valor del parametro 'act' sea insert.
         * Se encarga de agregar un registro en la base de datos.
         */
        public function insert(){
            //Arreglo con la información.
            $newCar = new car($this->objconfig);
            //Se le asignan valores a las propiedades del objeto.
            $newCar->name= $_POST["carName"];
            $newCar->type= $_POST["carType"];
            $newCar->year= $_POST["carYear"];
            $newCar->manufacturer_id= $_POST["manufacturerID"];
           try
            {
                //Se manda a llamar la función para agregar el registro.
                    $res=$this->carModel->insertRecord($newCar);
                    if($res){
                        //Si es exitosa, se redirige a la página del index.
                        $this->pageRedirect('index.php');
                    }else{
                        //Si fallo se despliega el siguiente mensaje.
                        echo "Algo salio mal, volver a intentar.";
                    }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }
        /*
       * Función update
       * Función que es llamada en caso que el valor del parametro 'act' sea update.
       * Se encarga de actualizar el registro seleccionado.
       */
        public function update(){

            //Se crea un nuevo objeto Carro.
            $newCar = new car($this->objconfig);
            //Se le asignan los valores al objeto.
            $newCar->id = $_POST["carID"];
            $newCar->name= $_POST["carName"];
            $newCar->type= $_POST["carType"];
            $newCar->year= $_POST["carYear"];
            $newCar->manufacturer_id= $_POST["manufacturerID"];
            try
            {
                //Se manda a llamar la función para agregar el registro.
                $res=$this->carModel->updateRecord($newCar);
                if($res){
                    //Si es exitosa, se redirige a la página del index.
                    $this->pageRedirect('index.php');
                }else{
                    //Si fallo se despliega el siguiente mensaje.
                    echo "Algo salio mal, volver a intentar.";
                }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }
    }
?>