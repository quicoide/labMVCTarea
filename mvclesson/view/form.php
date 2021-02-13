<?php
/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar datos</title>
    <link rel="stylesheet" href="~/../libs/bootstrap.css">
    <script src="~/../libs/functions.js"></script>
    <script type="text/javascript" src="~/../libs/jquery.min.js"></script>
    <link rel="stylesheet" href="~/../libs/styles.css">
</head>
<body>
    <div class="wrapperF">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <!-- Se verifica si la variable id_car no es nula, para actualizar el titulo de la forma de la manera que corresponde -->
                        <h2><?php echo is_null($id_car) ? 'Agregar Nuevo Carro': 'Modificar Carro'; ?></h2>
                    </div>
                    <!-- Se verifica si la variable id_car no es nula, para actualizar el texto de la forma de la manera que corresponde -->
                    <p>Llenar esta forma para <?php echo is_null($id_car)? 'agregar':'modificar';?> la información.</p>
                    <!-- Se verifica si la variable id_car no es nula, para actualizar el action de la forma de la manera que corresponde -->
                    <form name="insertForm" action="index.php?act=<?php echo is_null($id_car)?'add':'update';?>" onsubmit="return validateForm()" method="post" >
                        <!-- Se verifica si la variable id_car no es nula, para guardar el id en elemento escondido -->
                        <input type="hidden" name="carID" value="<?php echo (is_null($id_car)?'0':$id_car);?>" >
                        <!-- Div para el nombre-->
                        <div id="carNameDiv" class="form-group">
                            <!--Label para el input -->
                            <label>Nombre del Carro *</label>
                            <!--Input tipo texto para el nombre del carro -->
                            <input type="text" name="carName" class="form-control" value="<?php echo $carName; ?>">
                            <!-- Span para desplegar errores-->
                            <span id="nameError" class="help-block" style="display: none;">Favor de agregar este dato.</span>
                        </div>
                        <!-- Div para el tipo de carro-->
                        <div id="carTypeDiv" class="form-group">
                            <label>Tipo de carro * </label>
                            <input type="text" name="carType" class="form-control" value="<?php echo $carType; ?>">
                            <span id="typeError" class="help-block" style="display: none;">Favor de agregar este dato.</span>
                        </div>
                        <!-- Div para el año-->
                        <div id="carYearDiv" class="form-group">
                            <label>Año del carro *</label>
                            <input type="text" name="carYear" class="form-control" value="<?php echo $carYear; ?>" onkeypress="return onlyNumbers(this);">
                            <span id="yearError" class="help-block" style="display: none;">Favor de agregar este dato.</span>
                        </div>
                        <!-- Div para el fabricante-->
                        <div class="form-group">
                            <label>Fabricante</label>
                            <select name="manufacturerID" class="form-control"  >
                                <?php
                                foreach($resultManufacturer as $row) {

                                    echo '<option value="'.$row['id'].'" '.(($row['id'] == $carManufacturer) ? 'selected = "selected"':'').'>'.$row['name'].'</option>';
                                }
                                ?>
                            </select>
                            <span id="manufacturerError" class="help-block" style="display: none;">Favor de seleccionar un fabricante.</span>
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>