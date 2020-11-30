<?php
include "../menu_empleados.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['eliminar'])){
    $dni=$_REQUEST['dni'];
    
    mysqli_query($c,"DELETE FROM $tabla  WHERE (dni='$dni')");
    if (mysqli_errno($c)==0){
        echo "<br><br>Registro actualizado"; 
    }else{ 
        if (mysqli_errno($c)==1062){
            echo "<h2>No ha podido eliminarse el registro<br>No existe un campo con este DNI</h2>"; 
        }else{  
            $numerror=mysqli_errno($c); 
            $descrerror=mysqli_error($c); 
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>"; 
        } 
    
    }
    mysqli_close($c);     
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA ELIMINAR UN EMPLEADO</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del empleado a borrar:</label>
    <input name="dni"/><br><br>
    <input name="eliminar" type="submit" id="eliminar" value="ELIMINAR EMPLEADO"/>
</fieldset>
</form>
';
}