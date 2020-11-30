<?php
include "menu_cliente.php";

$base="diegogarcia"; 

$tabla="compran"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['cancelar'])){
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

    print'<br>Datos de la cancelación:<br>DNI:'.$dni.'<br>Tipo: '.$tipo.'<br>Marca: '.$marca;
    mysqli_query($c,"DELETE FROM $tabla  WHERE (dni='$dni') AND (codigo_electrodomesticos=$codigo)");
    if (mysqli_errno($c)==0){
        echo "<br><br>Registro actualizado"; 
    }else{ 
        if (mysqli_errno($c)==1062){
            echo "<h2>No ha podido eliminarse el registro<br>No existe un campo con este DNI y este CÓDIGO</h2>"; 
        }else{  
            $numerror=mysqli_errno($c); 
            $descrerror=mysqli_error($c); 
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>"; 
        } 
    
    }
    mysqli_close($c);     
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA CANCELAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Introduce el código del electrodoméstico que compraste y deseas cancelar su compra:</label>
    <input name="codigo"/><br>
    <input name="cancelar" type="submit" id="cancelar" value="Cancelar compra"/>
</fieldset>
</form>
';
}