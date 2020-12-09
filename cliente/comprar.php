<?php
include "menu_cliente.php";

$base="diegogarcia"; 

$tabla="compran"; 
$electrodomesticos="electrodomesticos";

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['comprar'])){
    $dni=$_REQUEST['dni'];
    $tipo=$_REQUEST['tipo'];
    $marca=$_REQUEST['marca'];

    $sql="SELECT * FROM $electrodomesticos WHERE tipo='$tipo' AND marca='$marca'";
    $result=mysqli_query($c,$sql);

    if(empty($dni)){
        echo "<br>HAS DEJADO EL CAMPO DNI VACÍO";
    }else{
        while($mostrar=mysqli_fetch_array($result)){
            ?>
            <table border="1" style="margin: auto; margin-top: 200px;" >
                <tr>
                    <td>DNI</td>
                    <td>CÓDIGO ELECTRODOMÉSTICO</td>
                    <td>TIPO</td>
                    <td>MARCA</td>
                    <td>PRECIO</td>           
                </tr>            
   
                <tr>
                    <td><?php echo $dni?></td>
                    <td><?php echo $mostrar['codigo_electrodomesticos']?></td>
                    <?php $codigo=$mostrar['codigo_electrodomesticos'];?>
                    <td><?php echo $mostrar['tipo']?></td>
                    <td><?php echo $mostrar['marca']?></td>
                    <td><?php echo $mostrar['precio']?></td>
                </tr>
            <?php 
        }
    }
 ?>
</table>
<?php
    mysqli_query($c,"INSERT $tabla (codigo_electrodomesticos,dni) VALUES ('$codigo','$dni')");

    if (mysqli_errno($c)==0){
        echo "<br><br><h2>COMPRA REALIZADA</h2><br><br>¡¡APUNTA EL CÓDIGO DEL ELECTRODOMÉSTICO COMPRADO, TE SERÁ NECESARIO PARA CONSULTAR O MODIFICAR TU COMPRA!!";

    }else{
        if (mysqli_errno($c)==1062){
            echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con este DNI y este ELECTRODOMÉSTICO</h2>";
        }else{ 
            $numerror=mysqli_errno($c);
            $descrerror=mysqli_error($c);
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
        }
    }

    mysqli_close($c); 
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA REALIZAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Indique el tipo de electrodoméstico que desea comprar:</label>
    <select name="tipo">
        <option value="lavadora">Lavadora</option>
        <option value="frigorifico">Frigorífico</option>
        <option value="lavavajillas">Lavavajillas</option>
    </select><br>
    <label>Indique la marca del electrodoméstico:</label>
    <select name="marca">
        <option value="balay">Balay</option>
        <option value="beko">Beko</option>
        <option value="siemens">Siemens</option>
        <option value="aeg">AEG</option>
        <option value="bosch">Bosch</option>
        <option value="fagor">Fagor</option>
    </select><br>
    <input name="comprar" type="submit" id="comprar" value="Realizar compra"/>
</fieldset>
</form>
';
}

