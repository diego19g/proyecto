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

    print'<br>Datos de la compra:<br>DNI:'.$dni.'<br>Tipo: '.$tipo.'<br>Marca: '.$marca;
    $resultado=mysqli_query($c,"SELECT * FROM $tabla  WHERE (dni='$dni') AND (codigo_electrodomesticos=$codigo)");

    echo "<table align=center border=2>";



    while ($registro = mysqli_fetch_row($resultado)){

       echo "<tr>";
       foreach($registro  as $clave){
       echo "<td>",$clave,"</td>";
        }
    }
    echo "</table>";

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