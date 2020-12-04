<?php
include "menu_cliente.php";

$base="diegogarcia"; 

$tabla="compran"; 
$electrodomesticos="electrodomesticos";

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['consultar'])){
    $dni=$_REQUEST['dni'];
    $codigo=$_REQUEST['codigo'];


    ?>
	<table border="1" style="margin: auto; margin-top: 200px; text-align:center;" >
		<tr>
			<td>DNI</td>
			<td>CODIGO ELECTRODOMÉSTICO</td>
            <td>TIPO</td>
            <td>MARCA</td>
            <td>PRECIO</td>
		</tr>

		<?php 
		$sql="SELECT * FROM $tabla WHERE dni='$dni'";
		$result=mysqli_query($c,$sql);
        if($mostrar=mysqli_fetch_array($result)==true){
            $sql2="SELECT tipo,marca,precio FROM $electrodomesticos WHERE codigo_electrodomesticos='$codigo'";
            $result2=mysqli_query($c,$sql2);
            while($mostrar2=mysqli_fetch_array($result2)){
                ?>                                   
               <tr>
                    <td><?php echo $dni ?></td>
                    <td><?php echo $codigo ?></td>			                           
                    <td><?php echo $mostrar2['tipo'] ?></td>
                    <td><?php echo $mostrar2['marca'] ?></td>			
                    <td><?php echo $mostrar2['precio'] ?></td>	
                </tr>
                <?php
            }
   
        }else{            
            echo "NO EXISTE UNA COMPRA CON ESE DNI Y ELECTRODOMÉSTICO";
            ?>
            <br><br>        
            <a href="consultar_compra.php" class="enlaces_menu">Volver a consultar compra</a>
            <?php
	    }
	 ?>
    </table>
    <br><br>        
    <a href="consultar_compra.php" class="enlaces_menu">Volver a consultar compra</a>
<?php

 mysqli_close($c); 

}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA CONSULTAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Introduce el código del electrodoméstico que compraste:</label>
    <input name="codigo"/><br>
    <input name="consultar" type="submit" id="consultar" value="Consultar compra"/>
</fieldset>
</form>
';
}