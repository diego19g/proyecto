<?php
include "pagina_login.php";

$base="diegogarcia"; 

$tabla="clientes"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['registrar'])){
    $dni=$_REQUEST['dni'];
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];
    $contrasena=$_REQUEST['contrasena'];

    if(!preg_match("/^[a-zA-Z0-9._-]+[@admin]+\.([a-zA-Z]{2,4})+$/",$email)){
        if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})+$/",$email)){
            mysqli_query($c,"INSERT $tabla (dni,nombre,email,contraseña) VALUES ('$dni','$nombre','$email','$contrasena')");
        
            if (mysqli_errno($c)==0){
                echo "<br><br><h2>USUARIO AÑADIDO</b></H2><br><br>";
                print'<br>Datos del registro:<br>DNI:'.$dni.'<br>NOMBRE: '.$nombre.'<br>EMAIL DEL USUARIO'.$email;?><br><br>
                <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
                <?php
            }else{
                if (mysqli_errno($c)==1062){
                    echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con estos datos</h2>";
                    ?>
                    <br><br><br><br>
                    <a href="crear_cliente.php" class="enlaces_menu">Volver a la página de registro</a>
                    <br><br><br><br><br>
                    <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
                    <?php
                }else{ 
                    $numerror=mysqli_errno($c);
                    $descrerror=mysqli_error($c);
                    echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
                }
            }
        }else{
            echo "EL FORMATO DEL EMAIL NO ES CORRECTO";
            ?>
            <br><br><br><br>
            <a href="crear_cliente.php" class="enlaces_menu">Volver a la página de registro</a>
            <br><br><br><br><br>
            <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
            <?php
        }
    }else{
        echo "NO ES POSIBLE CREAR UN USUARIO CLIENTE COMO ADMINISTRADOR";?>
        <br><br><br><br>
        <a href="crear_cliente.php" class="enlaces_menu">Volver a la página de registro</a>
        <br><br><br><br><br>
        <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
        <?php
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
                <legend>CREAR USUARIO</legend>
                <label>Introduce tu DNI:</label>
                <input name="dni" type="text"/><br>
                <label>Introduce tu nombre:</label>
                <input name="nombre" type="text"/><br>
                <label>Introduce tu email:</label>
                <input name="email" type="text"/><br>
                <label>Introduce tu contraseña:</label>
                <input name="contrasena" type="password"/><br>
                <input name="registrar" type="submit" id="registrar" value="REGISTRAR USUARIO"/>
            </fieldset>
        </form><br><br>
        <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>
    </body>
</html>';
}