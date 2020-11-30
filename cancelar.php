<?php
include "menu.php";

$base="diegogarcia"; 

$tabla="compran"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
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
        case 7:
            $tipo="frigorifico";
            $marca="siemens";
            break;
        case 8:
            $tipo="frigorifico";
            $marca="aeg";
            break;    
        case 7:
            $tipo="frigorifico";
            $marca="bosch";
            break;
         case 8:
            $tipo="frigorifico";
            $marca="fagor";
            break;    
    }

    print'<br>Datos de la cancelación:<br>DNI:'.$dni.'<br>Tipo: '.$tipo.'<br>Marca: '.$marca.'<br>Código del electrodoméstico: '.$codigo2.'<br>¡APUNTA EL CODIGO PARA PODER IDENTIFICAR TU ELECTRODOMÉSTICO EN CASO DE MODIFICACIÓN O CANCELACIÓN DE LA COMPRA!';
    mysqli_query($c,"UPDATE $tabla SET codigo_electrodomesticos=$codigo2 WHERE dni='$dni' AND codigo_electrodomesticos=$codigo");
    if (mysqli_errno($c)==0){
        echo "<br><br>Registro actualizado"; 
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
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR TU COMPRA</h2>
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