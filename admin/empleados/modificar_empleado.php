<?php
include "../menu_empleados.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
    $dni=$_REQUEST['dni'];
    $dni2=$_REQUEST['dni2'];
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];
    $contrasena=$_REQUEST['contrasena'];

    $sql="SELECT * FROM $tabla WHERE dni='$dni'";
    $result=mysqli_query($c,$sql);
    
    if($mostrar=mysqli_fetch_array($result)==true){
        if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})+$/",$email)){
            if(preg_match("/^[a-zA-Z0-9._-]+[@admin]+\.([a-zA-Z]{2,4})+$/",$email)){
                mysqli_query($c,"UPDATE $tabla SET dni='$dni2',nombre='$nombre',email='$email' WHERE dni='$dni'");
                if (mysqli_errno($c)==0){
                    echo "<br><br>Registro actualizado"; 
                    print'<br><br>Datos nuevos del empleado:<br>DNI: '.$dni2.'<br>Nombre del empleado: '.$nombre.'<br>Email del empleado: '.$email;
                    ?><br><br>
                    <a href="modificar_empleado.php" class="enlaces_menu">Volver a Modificar</a>
                    <?php
                }else{ 
                    if (mysqli_errno($c)==1062){
                        echo "<br><br><h2>No ha podido modificarse el registro<br>Ya existe un campo con estos datos</h2>"; 
                        ?><br><br>
                        <a href="modificar_empleado.php" class="enlaces_menu">Volver atrás</a>
                        <?php
                    }else{  
                        $numerror=mysqli_errno($c); 
                        $descrerror=mysqli_error($c); 
                        echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>"; 
                    } 
                
                }
            }else{
                echo "<br><br>EL FORMATO DEL EMAIL NO ES CORRECTO";
                ?>
                <br><br><br><br>
                <a href="modificar_empleado.php" class="enlaces_menu">Volver a la página de Modificar</a>
                <?php
            }
        }else{
            echo "<br><br>NO ES POSIBLE QUE UN ADMINISTRADOR TENGA EMAIL DE CLIENTE";?>
            <br><br><br><br>
            <a href="modificar_empleado.php" class="enlaces_menu">Volver a Modificar</a>
            <?php
        }
    }else{
        echo "NO EXISTE UN EMPLEADO CON ESE DNI";?><br><br>

        <a href="modificar_empleado.php" class="enlaces_menu">Volver atrás</a>

        <?php
    }


    mysqli_close($c);     
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR UN EMPLEADO (NO ES POSIBLE MODIFICAR LA CONTRASEÑA)</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del empleado a modificar:</label>
    <input name="dni"/><br><br>
    <h1>Introduce los nuevos datos del empleado</h1>
    <label>Introduce el DNI del empleado:</label>
    <input name="dni2"/><br>
    <label>Indique el nombre del empleado:</label>
    <input name="nombre"/><br>
    <label>Indique el email del empleado:</label>
    <input name="email"/><br>
    <label>Indique la contraseña del empleado:</label>
    <input name="contrasena" type="password"/><br><br>
    <input name="modificar" type="submit" id="modificar" value="MODIFICAR EMPLEADO"/>
</fieldset>
</form>
';
}