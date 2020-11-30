<?php
include "../menu_clientes.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
    $dni=$_REQUEST['dni'];
    $dni2=$_REQUEST['dni2']
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];

    print'<br>Datos nuevos del empleado:<br>DNI:'.$dni.'<br>Nombre del empleado: '.$nombre.'<br>Email del empleado'.$email.'<br>';
    mysqli_query($c,"UPDATE $tabla SET dni=$dni2 nombre=$nombre email=$email contraseña=$contrasena WHERE dni='$dni'");
    if (mysqli_errno($c)==0){
        echo "<br><br>Registro actualizado"; 
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
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR UN CLIENTE (NO ES POSIBLE MODIFICAR LA CONTRASEÑA)</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del cliente a modificar:</label>
    <input name="dni"/><br><br>
    <h1>Introduce los nuevos datos del cliente</h1><br><br>
    <label>Introduce el DNI del cliente:</label>
    <input name="dni2"/><br><br>
    <label>Indique el nombre del cliente:</label>
    <input name="nombre"/><br>
    <label>Indique el email del cliente:</label>
    <input name="email"/><br>
    <input name="modificar" type="submit" id="modificar" value="Modificar compra"/>
</fieldset>
</form>
';
}