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
    <title>Dashboard</title>
    <!-- Se agregan todos los estilos y javascript a utilizar en la vista.-->
    <!-- Se añade el css de font-awesome. -->
    <link href="~/../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Se añade el js de jquery -->
    <script src="~/../libs/jquery.min.js"></script>
    <!-- Se añade el js y css de bootstrap. -->
    <link rel="stylesheet" href="~/../libs/bootstrap.css">


    <script src="~/../libs/bootstrap.js"></script>
    <!-- Se modifican unos estilos en la página web -->
    <link rel="stylesheet" href="~/../libs/styles.css">
    <!-- Se agrega la funcion tooltip al link -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left text-center">Lista de Carros</h2>
                        <a href="index.php?act=form" class="btn btn-success pull-right">Agregar un carro</a>

                    </div>
                    <!-- Se realiza un ciclo para llenar la tabla con los datos obtenidos -->
                    <?php
                        if(count($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre del Carro</th>";
                                        echo "<th>Categoría</th>";
                                        echo "<th>Año</th>";
                                        echo "<th>Fabricante</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach($result as $row) {
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";                                        
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . $row['year'] . "</td>";
                                        echo "<td>" . $row['manufacturerName'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?act=form&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                                        echo "<a href='index.php?act=delete&pageNumber=".$page."&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' 
                                                onclick=\"if(!confirm('Are you sure that you want to permanently delete the selected element?'))return false\" 
                                                class=\"msgbox-confirm\"><i class='fa fa-trash'></i></a>";

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
                <!-- HTML/PHP para la paginación de la pantalla -->
                 <ul class="pagination">
                    <li><a href="index.php?pageNumber=1">First</a></li>
                    <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">

                        <a href="<?php if($page <= 1){ echo '#'; } else { echo "index.php?pageNumber=".($page - 1); } ?>">Prev</a>
                    </li>
                    <li class="<?php if($page >= $pageTotal){ echo 'disabled'; } ?>">
                        <a href="<?php if($page >= $pageTotal){ echo '#'; } else { echo "index.php?pageNumber=".($page + 1); } ?>">Next</a>
                    </li>
                    <li><a href="?pageNumber=<?php echo $pageTotal; ?>">Last</a></li>
                </ul>

            </div>        
        </div>
    </div>
</body>
</html>