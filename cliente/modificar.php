<?php
include "menu_cliente.php";

$base="diegogarcia"; 

$tabla="compran"; 
$electrodomesticos="electrodomesticos";

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
    $dni=$_REQUEST['dni'];
    $tipo=$_REQUEST['tipo'];
    $marca=$_REQUEST['marca'];
    $codigo=$_REQUEST['codigo'];

    $sql="SELECT * FROM $electrodomesticos WHERE tipo='$tipo' AND marca='$marca'";
    $result=mysqli_query($c,$sql);

    if(empty($dni) || empty($codigo)){
        echo "<br>HAS DEJADO ALGÚN CAMPO VACÍO";
    }else{
        while($mostrar=mysqli_fetch_array($result)){
            $codigo2=$mostrar['codigo_electrodomesticos'];
            mysqli_query($c,"UPDATE $tabla SET codigo_electrodomesticos=$codigo2 WHERE dni='$dni' AND codigo_electrodomesticos=$codigo");
            if (mysqli_errno($c)==0){
                echo '<br>DATOS NUEVOS DE LA COMPRA<br>';
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
                        <td><?php echo $mostrar['tipo']?></td>
                        <td><?php echo $mostrar['marca']?></td>
                        <td><?php echo $mostrar['precio']?></td>
                    </tr>
                <?php    
                echo "<br><br>COMPRA MODIFICADA"; 
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
        }
    }
 ?>
</table>
<br><br>        
<a href="modificar.php" class="enlaces_menu">Volver a modificar compra</a>
<?php
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Introduce el código del electrodoméstico que compraste</label>
    <input name="codigo"/><br>
    <label>Indique el tipo de electrodoméstico que desea comprar:</label>
    <select name="tipo">
        <option value="lavadora">Lavadora</option>
        <option value="frigorifico">Frigorífico</option>
        <option value="lavavajillas">Lavavajillas</option>
    </select><br>
    <label>Indique la marca del electrodoméstico que desea comprar:</label>
    <select name="marca">
        <option value="balay">Balay</option>
        <option value="beko">Beko</option>
        <option value="siemens">Siemens</option>
        <option value="aeg">AEG</option>
        <option value="bosch">Bosch</option>
        <option value="fagor">Fagor</option>
    </select><br>
    <input name="modificar" type="submit" id="modificar" value="Modificar compra"/>
</fieldset>
</form>
';
}