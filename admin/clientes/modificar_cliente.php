<?php
include "../menu_clientes.php";

$base="diegogarcia"; 

$tabla="clientes"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
    $dni=$_REQUEST['dni'];
    $dni2=$_REQUEST['dni2'];
    $nombre=$_REQUEST['nombre'];
    $email=$_REQUEST['email'];

    $sql="SELECT * FROM $tabla WHERE dni='$dni'";
    $result=mysqli_query($c,$sql);
    
    if($mostrar=mysqli_fetch_array($result)==true){
        if(!preg_match("/^[a-zA-Z0-9._-]+[@admin]+\.([a-zA-Z]{2,4})+$/",$email)){
            if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})+$/",$email)){
                mysqli_query($c,"UPDATE $tabla SET dni='$dni2',nombre='$nombre',email='$email' WHERE dni='$dni'");
                if (mysqli_errno($c)==0){
                    echo "<br><br>CLIENTE MODIFICADO"; 
                    print'<br><br>Datos nuevos del cliente:<br>DNI:'.$dni2.'<br>Nombre del cliente: '.$nombre.'<br>Email del cliente: '.$email;
                    ?><br><br>
                    <a href="modificar_cliente.php" class="enlaces_menu">Volver a Modificar</a>
                    <?php
                }else{ 
                    if (mysqli_errno($c)==1062){
                        echo "<br><br><h2>No ha podido modificarse el registro<br>Ya existe algún campo con estos datos</h2>"; 
                        ?><br><br>
                        <a href="modificar_cliente.php" class="enlaces_menu">Volver atrás</a>
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
                <a href="modificar_cliente.php" class="enlaces_menu">Volver a la página de Modificar</a>
                <?php
            }
    
        }else{
            echo "<br><br>NO ES POSIBLE QUE UN CLIENTE TENGA EMAIL DE ADMINISTRADOR";?>
            <br><br><br><br>
            <a href="modificar_cliente.php" class="enlaces_menu">Volver a Modificar</a>
            <?php
        }
    }else{
        echo "<br><br>NO EXISTE UN CLIENTE CON ESE DNI";?><br><br>
        <a href="modificar_cliente.php" class="enlaces_menu">Volver atrás</a>
        <?php
    }

    mysqli_close($c);     
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR UN CLIENTE (NO ES POSIBLE MODIFICAR LA CONTRASEÑA)</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del cliente a modificar:</label>
    <input name="dni"/><br>
    <h1>Introduce los nuevos datos del cliente</h1>
    <label>Introduce el DNI del cliente:</label>
    <input name="dni2"/><br><br>
    <label>Indique el nombre del cliente:</label>
    <input name="nombre"/><br><br>
    <label>Indique el email del cliente:</label>
    <input name="email"/><br><br>
    <input name="modificar" type="submit" id="modificar" value="MODIFICAR CLIENTE"/>
</fieldset>
</form>
';
}