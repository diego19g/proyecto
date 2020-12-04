<?php
include "menu_cliente.php";

$base="diegogarcia"; 

$tabla="compran"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['consultar'])){
    $dni=$_REQUEST['dni'];
    $codigo=$_REQUEST['codigo'];

    switch ($codigo) {
        case 1:
            $tipo="lavadora";
            $marca="balay";
            break;
        case 2:
            $tipo="lavadora";
            $marca="beko";
            break;    
        case 3:
            $tipo="lavadora";
            $marca="siemens";
            break;
        case 4:
            $tipo="lavadora";
            $marca="aeg";
            break; 
        case 5:
            $tipo="lavadora";
            $marca="bosch";
            break;
        case 6:
            $tipo="lavadora";
            $marca="fagor";
            break;   
        case 7:
            $tipo="frigorifico";
            $marca="balay";
            break;
        case 8:
            $tipo="frigorifico";
            $marca="beko";
            break;    
        case 9:
            $tipo="frigorifico";
            $marca="siemens";
            break;
        case 10:
            $tipo="frigorifico";
            $marca="aeg";
            break;    
        case 11:
            $tipo="frigorifico";
            $marca="bosch";
            break;
         case 12:
            $tipo="frigorifico";
            $marca="fagor";
            break;    
        case 13:
            $tipo="lavavajillas";
            $marca="balay";
            break;    
        case 14:
            $tipo="lavavajillas";
            $marca="beko";
            break;    
        case 15:
            $tipo="lavavajillas";
            $marca="siemens";
            break;    
        case 16:
            $tipo="lavavajillas";
            $marca="aeg";
            break;    
        case 17:
            $tipo="lavavajillas";
            $marca="bosch";
            break;    
        case 18:
            $tipo="lavavajillas";
            $marca="fagor";
            break;    
    }

    ?>
	<table border="1" style="margin: auto; margin-top: 200px;" >
		<tr>
			<td>DNI</td>
			<td>CÓDIGO ELECTRODOMÉSTICO</td>
			<td>TIPO</td>
            <td>MARCA</td>
           
		</tr>

		<?php 
		$sql="SELECT * FROM $tabla WHERE dni='$dni' AND codigo_electrodomesticos='$codigo'";
		$result=mysqli_query($c,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['dni'] ?></td>
			<td><?php echo $mostrar['codigo_electrodomesticos'] ?></td>
			<td><?php echo $tipo?></td>
            <td><?php echo $marca?></td>
           
		</tr>
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