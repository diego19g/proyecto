<?php
include "../menu_empleados.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['consultar'])){
    $dni=$_REQUEST['dni'];

    $resultado=mysqli_query($c,"SELECT * FROM $tabla  WHERE (dni='$dni'))");

    echo "<table align=center border=2>";

    while ($registro = mysqli_fetch_row($resultado)){

       echo "<tr>";
       foreach($registro  as $clave){
       echo "<td>",$clave,"</td>";
        }
    }
    echo "</table>";

 mysqli_close($c); 

}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA CONSULTAR UN EMPLEADO</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del empleado a consultar:</label>
    <input name="dni"/><br>
</fieldset>
</form>
';
}