<?php
include "pagina_login.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['registrar'])){
    $dni=$_REQUEST['dni'];
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];
    $contrasena=$_REQUEST['contrasena'];
    $codigo=1900;

    print'<br>Datos del registro:<br>DNI:'.$dni.'<br>NOMBRE: '.$nombre.'<br>EMAIL DEL USUARIO: '.$email;
    mysqli_query($c,"INSERT $tabla (dni,nombre,email,contraseña,codigo_tienda) VALUES ('$dni','$nombre','$email','$contrasena','$codigo')");

    if (mysqli_errno($c)==0){
        echo "<br><br><h2>ADMINISTRADOR AÑADIDO</b></H2>";?>
        <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
        <?php
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
}
else{
echo'<!DOCTYPE html>
<html>
    <head>
        <title>Crear usuario cliente</title>
        <link href="estilos.css" rel="stylesheet" type="text/css">
    </head>    
    <body>    
        <form>
            <fieldset class="usuario">
                <legend>CREAR USUARIO ADMINISTRADOR</legend>
                <label>Introduce tu DNI:</label>
                <input name="dni" type="text"/><br>
                <label>Introduce tu nombre:</label>
                <input name="nombre" type="text"/><br>
                <label>Introduce tu email:</label>
                <input name="email" type="text"/><br>
                <label>Introduce tu contraseña:</label>
                <input name="contrasena" type="password"/><br>
                <input name="registrar" type="submit" id="registrar" value="REGISTRAR ADMINISTRADOR"/><br><br>
                <p>Se le asignará el código de la tienda 1900, que es el código que tiene la tienda sobre la que estamos trabajando</p><br><br>    
            </fieldset>
        </form><br><br>
        <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
    </body>
</html>';
}