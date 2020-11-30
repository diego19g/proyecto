<?php
include "../menu_empleados.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['insertar'])){
    $dni=$_REQUEST['dni'];
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];
    $contrasena=$_REQUEST['contrasena'];


    print'<br>Datos del empleado:<br>DNI:'.$dni.'<br>Nombre del empleado: '.$nombre.'<br>Email del empleado'.$email.'<br>Contraseña del empleado: '.$contrasena.'<br>';
    mysqli_query($c,"INSERT $tabla (dni,nombre,email,contraseña) VALUES ('$codigo','$dni','$email','$contrasena')");

    if (mysqli_errno($c)==0){
        echo "<br><br><h2>Registro AÑADIDO</b></H2>";
    }else{
        if (mysqli_errno($c)==1062){
            echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con estos datos</h2>";
        }else{ 
            $numerror=mysqli_errno($c);
            $descrerror=mysqli_error($c);
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
        }
    }

    mysqli_close($c); 
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA INSERTAR UN EMPLEADO</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI:</label>
    <input name="dni"/><br>
    <label>Indique el nombre del empleado:</label>
    <input name="nombre"/><br>
    <label>Indique el email del empleado:</label>
    <input name="email"/><br>
    <label>Indique la contraseña del empleado:</label>
    <input name="contrasena" type="password"/><br>    
    <input name="insertar" type="submit" id="insertar" value="INSERTAR DATOS"/>
</fieldset>
</form>
';
}

