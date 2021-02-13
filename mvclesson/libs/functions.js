/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/

/*
Función en la cuál se validará la forma para que no se guarde ningún campo vacío.
En caso de que algún campo vacío no se enviará la forma y se le solicitará al usuario agregar el dato faltante.
 */
function validateForm(){
    //Declaración de variables a utilizar para la validación.
    var nameValidation = document.forms["insertForm"]["carName"].value;
    var yearValidation = document.forms["insertForm"]["carYear"].value;
    var typeValidation = document.forms["insertForm"]["carType"].value;
    var nameBoolean = false;
    var yearBoolean = false;
    var typeBoolean = false;

    //Condiciones para validar cada campo requerido.
    if(nameValidation==""){

        $("#nameError").show();
        $("#carNameDiv").addClass("has-error");
        nameBoolean = true;
    }
    else {
        $("#nameError").hide();
        $("#carNameDiv").removeClass("has-error");
    }
    if(typeValidation==""){

        $("#typeError").show();
        $("#carTypeDiv").addClass("has-error");
        typeBoolean = true;
    }
    else {
        $("#typeError").hide();
        $("#carTypeDiv").removeClass("has-error");
    }
    if(yearValidation==""){

        $("#yearError").show();
        $("#carYearDiv").addClass("has-error");
        yearBoolean = true;
    }
    else {
        $("#yearError").hide();
        $("#carYearDiv").removeClass("has-error");
    }
    return !(yearBoolean||typeBoolean||nameBoolean);

}

/*
Función que se encarga de que el campo de año sea solo numerico y solo de 4 digitos.
 */
function onlyNumbers(element){

    return (event.charCode >= 48 && event.charCode <= 57) && (element.value.length <=3);
}