<?php
include "pagina_login.php";

$base="diegogarcia"; 

$empleados="empleados"; 
$clientes="clientes";

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 


session_start();//primera sentencia para trabajar con sesiones
//las variables de session son globales al proyecto


if(isset($_REQUEST['btn_login']))//si has pulsado el boton login
{
$email=$_REQUEST['email'];
    //declaro una variable de sesion
$_SESSION['email']=$_REQUEST['email'];    
$pass=$_REQUEST['password'];

if(empty($email) && empty($pass)){
    echo "HA DEJADO LOS CAMPOS VACIOS";
}else{
    $sql="SELECT * FROM $empleados WHERE email='$email' AND contraseña='$pass'";
    $result=mysqli_query($c,$sql);
    
    if($mostrar=mysqli_fetch_array($result)==true){
        header('Location:crear_admin.php');//redirigir a otra pagina
    
    }else{
        echo "NO EXISTE UN ADMINISTRADOR CON ESTE EMAIL Y CONTRASEÑA";?><br><br>

        <a href="index.php" class="enlaces_menu">Volver a la página de inicio</a>

        <?php
    }
}
}
else{
echo'<!DOCTYPE html>

<html>
<head>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>
<body>
    <form>
        <div class="cuadro">
            <div class="login_admin">
                <p>PARA PODER CREAR UN USUARIO ADMINISTRADOR PRIMERO INICIE SESIÓN CON UN USUARIO ADMINISTRADOR</p>
            </div>
            <div class="form">
                <input type="email" name="email" size="30px" class="input" value="" placeholder="email">
                <input type="password" size="30px" class="input" name="password" value="" placeholder="password">
            </div>
            <div>
                <input class="boton" type="submit" value="Log in" name="btn_login">
            </div>
            <a href="index.php">Volver atrás</a><br>
        </div>
    </form>
</body>
</html>';
}
