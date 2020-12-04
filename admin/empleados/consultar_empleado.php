<?php
include "../menu_empleados.php";

$base="diegogarcia"; 

$tabla="empleados"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['consultar'])){
    $dni=$_REQUEST['dni'];
?>
	<table border="1" style="margin: auto; margin-top: 200px;" >
		<tr>
			<td>DNI</td>
			<td>NOMBRE</td>
			<td>EMAIL</td>
		</tr>

		<?php 
		$sql="SELECT * FROM $tabla WHERE dni='$dni'";
		$result=mysqli_query($c,$sql);

		if($mostrar=mysqli_fetch_array($result)==true){
			while($mostrar=mysqli_fetch_array($result)){
				?>
	   
			   <tr>
				   <td><?php echo $mostrar['dni'] ?></td>
				   <td><?php echo $mostrar['nombre'] ?></td>
				   <td><?php echo $mostrar['email'] ?></td>
			   </tr>
		   <?php 
		   }
		
		}else{
			echo "NO EXISTE UN EMPLEADO CON ESE DNI";
			?>		
			<br><br>        
			<a href="consultar_compra.php" class="enlaces_menu">Volver a consultar empleado</a>
			<?php
		}

	?>
	</table>
	<br><br>        
    <a href="consultar_compra.php" class="enlaces_menu">Volver a consultar empleado</a>
<?php
 mysqli_close($c); 

}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA CONSULTAR UN EMPLEADO</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce el DNI del empleado a consultar:</label>
    <input name="dni"/><br><br>
    <input name="consultar" type="submit" id="consultar" value="CONSULTAR EMPLEADO"/>
</fieldset>
</form>
';
}