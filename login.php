<?php
session_start();//primera sentencia para trabajar con sesiones
//las variables de session son globales al proyecto


if(isset($_REQUEST['btn_login']))//si has pulsado el boton login
{
$email=$_REQUEST['email'];
    //declaro una variable de sesion
$_SESSION['email']=$_REQUEST['email'];    
$pass=$_REQUEST['password'];
if($email=="" && $pass==""){
    header('Location:cliente/menu_cliente.php');//redirigir a otra pagina
}
/*if($email=="" && $pass==""){
    header('Location:admin/menu_admin.php');//redirigir a otra pagina
}*/
}
else{
echo'<!DOCTYPE html>

<html>
<head>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <title>Log in</title>
</head>
<body>
    <form>
        <div class="cuadro">
            <div class="login">
                <h1>LOG IN</h1>
            </div>
            <div class="form">
                <input type="email" name="email" size="30px" class="input" value="" placeholder="email">
                <input type="password" size="30px" class="input" name="password" value="" placeholder="password">
            </div>
            <div>
                <input class="boton" type="submit" value="Log in" name="btn_login">
            </div>
        </div>
    </form>
</body>
</html>';
}
